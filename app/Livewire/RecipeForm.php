<?php

namespace App\Livewire;

use App\Models\Ingredient;
use App\Models\Recipe;
use App\Models\RecipeCategory;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\WithPagination;

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
        'sdt',
        'buah',
        'piring',
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
                    'unit' => $ingredient->pivot->unit
                ];
            })->toArray();

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

        $this->selectedIngredients[] = $ingredient;
        $this->searchIngredients = '';
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

    public function save()
    {
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
            'selectedIngredients.*' => 'required',
            'steps' => 'required|array|min:1',
            'steps.*' => 'required',
        ]);

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
            // update recipe
            $this->recipe->update([
                'name' => $validated['name'],
                'category_id' => $validated['recipeCategory'],
                'description' => $validated['description'],
                'cooking_time' => $validated['cookingTime'],
                'difficulty' => $validated['difficulty'],
                'servings' => $validated['servings'],
                'image' => $imagePath ?? null,
                'is_published' => (bool) $validated['status'],
            ]);

            // delete existing relationships
            $this->recipe->ingredients()->detach();
            $this->recipe->steps()->delete();

            // reattach ingredients
            foreach ($this->selectedIngredients as $ingredient) {
                $this->recipe->ingredients()->attach($ingredient['id'], [
                    'ingredient_id' => $ingredient['id'],
                    'amount' => $ingredient['amount'],
                    'unit' => $ingredient['unit']
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
            // insert field to recipes table
            $recipe = Recipe::create([
                'name' => $validated['name'],
                'user_id' => 1,
                'category_id' => $validated['recipeCategory'],
                'description' => $validated['description'],
                'cooking_time' => $validated['cookingTime'],
                'difficulty' => $validated['difficulty'],
                'servings' => $validated['servings'],
                'image' => $imagePath ?? null,
                'is_published' => (bool) $validated['status'],
            ]);

            foreach ($this->selectedIngredients as $ingredient) {
                $recipe->ingredients()->attach($ingredient['id'], [
                    'ingredient_id' => $ingredient['id'],
                    'amount' => $ingredient['amount'],
                    'unit' => $ingredient['unit']
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

        $this->redirect(route('recipes.index'), navigate: true);
        toastr()->success($this->recipe ? 'Resep berhasil di perbarui' : 'Resep berhasil di buat');
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
