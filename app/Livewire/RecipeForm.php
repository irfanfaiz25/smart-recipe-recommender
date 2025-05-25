<?php

namespace App\Livewire;

use App\Models\Ingredient;
use App\Models\Recipe;
use App\Models\RecipeCategory;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\WithPagination;
use Masmerise\Toaster\Toaster;
use OpenAI;

class RecipeForm extends Component
{
    use WithPagination, WithFileUploads;

    public $newImage = null;
    public $existingImagePath = null;
    public $name = '';
    public $description = '';
    public $cookingTime = '';
    public $difficulty = '';
    public $servings = '';
    public $recipeCategory;
    public $ingredient = '';
    public $ingredients = [];
    public $selectedIngredients = [];
    public $isPrimary;
    public $steps = [];
    public $status;
    public $recipe = null;
    public $units = [
        'pcs',
        'siung',
        'ikat',
        'butir',
        'ruas',
        'lembar',
        'batang',
        'gram',
        'kg',
        'ml',
        'sdm',
        'sdt',
        'buah',
        'piring',
        'gelas',
    ];
    public $searchIngredients = '';


    public function mount($recipeId = null)
    {
        if ($recipeId) {
            $this->recipe = Recipe::with('ingredients', 'steps')->find($recipeId);
            $this->name = $this->recipe->name;
            $this->recipeCategory = $this->recipe->category_id;
            $this->description = $this->recipe->description;
            $this->cookingTime = $this->recipe->cooking_time;
            $this->difficulty = $this->recipe->difficulty;
            $this->servings = $this->recipe->servings;
            $this->existingImagePath = $this->recipe->image;
            $this->status = $this->recipe->is_published;

            // Load ingredients with pivot data
            $this->selectedIngredients = $this->recipe->ingredients->map(function ($ingredient) {
                return [
                    'id' => $ingredient->id,
                    'name' => $ingredient->name,
                    'image' => $ingredient->image,
                    'amount' => (int) $ingredient->pivot->amount,
                    'unit' => $ingredient->pivot->unit,
                    'isPrimary' => $ingredient->pivot->is_primary === 1 ? true : false,
                ];
            })->toArray();
            // dd($this->selectedIngredients);

            // Load steps
            $this->steps = $this->recipe->steps->pluck('description')->toArray();
        }

        $ingredients = Ingredient::select('id', 'name', 'image')->get()->toArray();
        $this->ingredients = $ingredients;
    }

    // OLD METHOD
    // public function updatedIngredient($value)
    // {
    //     $ingredient = json_decode($value, true);
    //     $ingredient['amount'] = '';
    //     $ingredient['unit'] = 'pcs';

    //     $this->selectedIngredients[] = $ingredient;
    //     $this->ingredient = '';
    // }

    public function selectIngredient($ingredientId)
    {
        $ingredient = Ingredient::select(['id', 'name', 'image'])
            ->where('id', $ingredientId)
            ->first()
            ->toArray();
        $ingredient['amount'] = '';
        $ingredient['unit'] = 'pcs';
        $ingredient['isPrimary'] = false;

        $this->selectedIngredients[] = $ingredient;
        $this->searchIngredients = '';
    }

    public function updateIngredientIsPrimary($id, $value)
    {
        foreach ($this->selectedIngredients as $key => $ingredient) {
            if ($ingredient['id'] === $id) {
                $this->selectedIngredients[$key]['isPrimary'] = $value;
                break;
            }
        }
    }

    public function increaseIngredientAmount($id)
    {
        foreach ($this->selectedIngredients as $key => $ingredient) {
            if ($ingredient['id'] === $id) {
                $this->selectedIngredients[$key]['amount']++;
                break;
            }
        }
    }

    public function decreaseIngredientAmount($id)
    {
        foreach ($this->selectedIngredients as $key => $ingredient) {
            if ($ingredient['id'] === $id) {
                $this->selectedIngredients[$key]['amount']--;
                break;
            }
        }
    }

    public function updateIngredientAmount($id, $amount)
    {
        foreach ($this->selectedIngredients as $key => $ingredient) {
            if ($ingredient['id'] === $id) {
                $this->selectedIngredients[$key]['amount'] = $amount;
                break;
            }
        }
    }

    public function removeIngredient($id)
    {
        $this->selectedIngredients = collect($this->selectedIngredients)->reject(function ($ingredient) use ($id) {
            return $ingredient['id'] === $id;
        })->values()->toArray();
    }

    public function updateIngredientUnit($id, $unit)
    {
        foreach ($this->selectedIngredients as $key => $ingredient) {
            if ($ingredient['id'] === $id) {
                $this->selectedIngredients[$key]['unit'] = $unit;
                break;
            }
        }
    }

    public function addStep()
    {
        $this->steps[] = '';
    }

    public function removeStep($index)
    {
        unset($this->steps[$index]);
        $this->steps = array_values($this->steps);
    }

    private function countTotalCalories()
    {
        $recipeName = $this->name;

        $client = OpenAI::client(config('services.openai.key'));

        // Get and format selected ingredients
        $selectedIngredients = collect($this->selectedIngredients)->map(function ($ingredient) {
            $detailIngredient = $ingredient['name'] . ' ' . $ingredient['amount'] . ' ' . $ingredient['unit'];
            return $detailIngredient;
        })->toArray();

        // separate selected ingredients by comma
        $selectedIngredients = implode(', ', $selectedIngredients);

        // Prompt for getting the total calories
        $prompt = "Calculate the total calories in kcal for the recipe: {$recipeName} with the following ingredients: {$selectedIngredients}. Return only the number of total calories without any text, nothing else";

        // Build the request payload
        $payload = [
            'model' => 'gpt-4o',
            'messages' => [
                [
                    'role' => 'user',
                    'content' => [
                        [
                            'type' => 'text',
                            'text' => $prompt
                        ],
                    ]
                ]
            ],
            'max_tokens' => 300,
        ];

        // Send the request to OpenAI
        try {
            $response = $client->chat()->create($payload);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        $detectedCalories = $response->choices[0]->message->content;
        // remove non-numeric characters
        $detectedCalories = preg_replace('/\D/', '', $detectedCalories);
        // convert to integer
        $detectedCalories = (int) $detectedCalories;

        return $detectedCalories;
    }

    public function save()
    {
        $user = auth()->user();

        // validate the fields
        $validated = $this->validate([
            'name' => 'required|string|max:100',
            'recipeCategory' => 'required|exists:recipe_categories,id',
            'description' => 'required|string',
            'cookingTime' => 'required|integer|min:1',
            'difficulty' => 'required|string|in:mudah,sedang,rumit',
            'servings' => 'required|integer|min:1',
            'newImage' => 'nullable|mimes:jpg,jpeg,png|max:2048',
            'status' => 'required',
            'selectedIngredients' => 'required|array|min:1',
            'selectedIngredients.*.id' => 'required|integer|exists:ingredients,id',
            'selectedIngredients.*.amount' => 'required',
            'selectedIngredients.*.unit' => 'required|string',
            'selectedIngredients.*.isPrimary' => 'required|boolean',
            'steps' => 'required|array|min:1',
            'steps.*' => 'required',
        ], [
            'selectedIngredients.*.amount.required' => 'Jumlah tidak boleh kosong',
            'selectedIngredients.*.isPrimary.required' => 'Bahan utama tidak boleh kosong',
        ]);

        // check if the ingredients has primary ingredient
        $primaryIngredientExists = collect($this->selectedIngredients)->contains(function ($ingredient) {
            return $ingredient['isPrimary'] === true;
        });

        if (!$primaryIngredientExists) {
            Toaster::error('Resep harus memiliki bahan utama, anda belum memilih bahan utama');
            return;
        }

        // storing image to storage
        $imagePath = $this->existingImagePath ?? '';
        if ($this->newImage) {
            if ($this->recipe && $this->recipe->image && Storage::disk('public')->exists(str_replace('storage/', '', $this->recipe->image))) {
                Storage::disk('public')->delete(str_replace('storage/', '', $this->recipe->image));
            }
            $imagePath = 'storage/' . $this->newImage->store('img/recipes', 'public');
        }

        if (!$this->newImage && !$this->existingImagePath) {
            if ($this->recipe && $this->recipe->image && Storage::disk('public')->exists(str_replace('storage/', '', $this->recipe->image))) {
                Storage::disk('public')->delete(str_replace('storage/', '', $this->recipe->image));
            }
        }

        if ($this->recipe) {
            // Check if ingredients have changed by comparing both arrays
            $ingredientsChanged = false;

            // Get current recipe ingredients as collection
            $currentIngredients = collect($this->selectedIngredients);
            $existingIngredients = $this->recipe->ingredients;

            // Check if number of ingredients changed
            if ($currentIngredients->count() !== $existingIngredients->count()) {
                $ingredientsChanged = true;
            } else {
                // Compare each ingredient's properties
                foreach ($currentIngredients as $current) {
                    $existing = $existingIngredients->firstWhere('id', $current['id']);
                    if (
                        !$existing ||
                        $current['amount'] != $existing->pivot->amount ||
                        $current['unit'] !== $existing->pivot->unit ||
                        $current['isPrimary'] !== (bool) $existing->pivot->is_primary
                    ) {
                        $ingredientsChanged = true;
                        break;
                    }
                }
            }

            // Recalculate calories only if ingredients changed and if calories field is not null
            $calories = $ingredientsChanged || $this->recipe->calories === null ? $this->countTotalCalories() : $this->recipe->calories;

            // update recipe
            $this->recipe->update([
                'name' => $validated['name'],
                'category_id' => $validated['recipeCategory'],
                'description' => $validated['description'],
                'cooking_time' => $validated['cookingTime'],
                'difficulty' => $validated['difficulty'],
                'servings' => $validated['servings'],
                'image' => $imagePath ?? null,
                'calories' => $calories,
                'is_published' => (bool) $validated['status'],
            ]);

            // Create/update moderation based on published status
            if ((bool) $this->status) {
                // Create moderation record if it doesn't exist and recipe is published
                if (!$this->recipe->moderation()->exists()) {
                    $this->recipe->moderation()->create([
                        'approver_id' => null,
                        'status' => 'pending',
                        'notes' => null
                    ]);
                } else {
                    // Update moderation record if it exists and recipe is published
                    $this->recipe->moderation()->update([
                        'approver_id' => null,
                        'status' => 'pending',
                        'notes' => null
                    ]);
                }
            } else {
                // Delete moderation record if recipe is unpublished
                $this->recipe->moderation()->delete();
            }

            // delete existing relationships
            $this->recipe->ingredients()->detach();
            $this->recipe->steps()->delete();

            // reattach ingredients
            foreach ($this->selectedIngredients as $ingredient) {
                $this->recipe->ingredients()->attach($ingredient['id'], [
                    'ingredient_id' => $ingredient['id'],
                    'amount' => $ingredient['amount'],
                    'unit' => $ingredient['unit'],
                    'is_primary' => $ingredient['isPrimary']
                ]);
            }

            // recreate steps
            foreach ($this->steps as $index => $step) {
                $this->recipe->steps()->create([
                    'step_number' => $index + 1,
                    'description' => $step
                ]);
            }
        } else {
            // count calories for each portion
            $calories = $this->countTotalCalories();

            // insert field to recipes table
            $recipe = Recipe::create([
                'name' => $validated['name'],
                'user_id' => $user->id,
                'category_id' => $validated['recipeCategory'],
                'description' => $validated['description'],
                'cooking_time' => $validated['cookingTime'],
                'difficulty' => $validated['difficulty'],
                'servings' => $validated['servings'],
                'image' => $imagePath ?? null,
                'calories' => $calories,
                'is_published' => (bool) $validated['status'],
            ]);

            // process recipe moderation if recipe is published
            if ($recipe->is_published) {
                $recipe->moderation()->create([
                    'approver_id' => null,
                    'status' => 'pending',
                    'notes' => null
                ]);
            }

            foreach ($this->selectedIngredients as $ingredient) {
                $recipe->ingredients()->attach($ingredient['id'], [
                    'ingredient_id' => $ingredient['id'],
                    'amount' => $ingredient['amount'],
                    'unit' => $ingredient['unit'],
                    'is_primary' => $ingredient['isPrimary']
                ]);
            }

            foreach ($this->steps as $index => $step) {
                $recipe->steps()->create([
                    'step_number' => $index + 1,
                    'description' => $step
                ]);
            }
        }

        $this->steps = [];
        $this->selectedIngredients = [];
        $this->reset('name', 'recipeCategory', 'description', 'cookingTime', 'difficulty', 'servings', 'newImage', 'existingImagePath', 'status');

        $redirectUrl = auth()->user()->hasRole('admin') ? route('admin-recipes.index') : route('recipes.index');
        $this->redirect($redirectUrl, navigate: true);
        Toaster::success($this->recipe ? 'Resep berhasil di perbarui' : 'Resep berhasil di buat');
        $this->recipe = null;
    }

    public function render()
    {
        $ingredients = Ingredient::select('id', 'name', 'image')->where('name', 'like', "%$this->searchIngredients%")->get()->toArray();
        $this->ingredients = $ingredients;

        $recipeCategories = RecipeCategory::select('id', 'name')->get();
        return view('livewire.admin.recipe-form', [
            'recipeCategories' => $recipeCategories
        ]);
    }
}
