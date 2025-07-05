<?php

namespace App\Livewire;

use App\Models\Ingredient;
use App\Models\Recipe;
use App\Models\RecipeCategory;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
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
        'liter',
        'sdm',
        'sdt',
        'buah',
        'ekor',
        'piring',
        'mangkok',
        'gelas',
    ];
    public $searchIngredients = '';

    public $quickAdd = '';
    public $quickAddStatus = null;
    public $searchResults = [];
    public $suggestedIngredients = [];
    public $selectedCategoryName = '';

    public function mount($recipeId = null)
    {
        if ($recipeId) {
            $this->recipe = Recipe::with('ingredients', 'steps')->find($recipeId);

            if (!$this->recipe) {
                Toaster::error('Resep tidak ditemukan');
                return $this->redirect(route(auth()->user()->hasRole('admin') ? 'admin-recipes.index' : 'recipes.index'));
            }

            // Check if user is owner
            if ((int) $this->recipe->user_id !== (int) auth()->user()->id) {
                Toaster::error('Anda tidak memiliki akses untuk mengedit resep ini');
                return $this->redirect(route(auth()->user()->hasRole('admin') ? 'admin-recipes.index' : 'recipes.index'));
            }

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
                    'category' => $ingredient->category,
                    'image' => $ingredient->image,
                    'amount' => (int) $ingredient->pivot->amount,
                    'unit' => $ingredient->pivot->unit,
                    'isPrimary' => $ingredient->pivot->is_primary === 1 ? true : false,
                ];
            })->toArray();

            // Load steps
            $this->steps = $this->recipe->steps->pluck('description')->toArray();
        }

        $ingredients = Ingredient::select('id', 'name', 'image', 'category')->get()->toArray();
        $this->ingredients = $ingredients;
    }

    // Simplified search-only method
    public function updatedQuickAdd()
    {
        $this->quickAddStatus = null;

        if (strlen($this->quickAdd) > 1) {
            // Search for ingredients
            $this->searchResults = Ingredient::where('name', 'like', '%' . $this->quickAdd . '%')
                ->whereNotIn('id', collect($this->selectedIngredients)->pluck('id'))
                ->limit(8)
                ->get()
                ->map(function ($ingredient) {
                    return [
                        'id' => $ingredient->id,
                        'name' => $ingredient->name,
                        'image' => $ingredient->image,
                        'category' => $ingredient->category ?? 'Umum'
                    ];
                })
                ->toArray();
        } else {
            $this->searchResults = [];
        }
    }

    // Remove the complex parsing logic, keep it simple
    public function addQuickIngredient()
    {
        // This method is now only triggered by Enter key
        // It will add the first search result if available
        if (!empty($this->searchResults)) {
            $firstResult = $this->searchResults[0];
            $this->selectSearchResult($firstResult['id'], $firstResult['name']);
        } else if (!empty($this->quickAdd)) {
            $this->quickAddStatus = [
                'type' => 'warning',
                'message' => 'Bahan tidak ditemukan, coba kata kunci lain'
            ];
        }
    }

    public function selectSearchResult($ingredientId, $ingredientName)
    {
        $ingredient = Ingredient::find($ingredientId);
        if ($ingredient) {
            $this->addIngredientToSelection($ingredient);
            $this->quickAdd = '';
            $this->searchResults = [];
            $this->quickAddStatus = [
                'type' => 'success',
                'message' => $ingredientName . ' ditambahkan!'
            ];
        }
    }

    public function addSuggestedIngredient($ingredientName, $amount = '', $unit = '')
    {
        $ingredient = Ingredient::where('name', $ingredientName)
            ->whereNotIn('id', collect($this->selectedIngredients)->pluck('id'))
            ->first();

        if ($ingredient) {
            $this->addIngredientToSelection($ingredient, $amount, $unit);
        }
    }

    private function addIngredientToSelection($ingredient, $amount = '', $unit = '')
    {
        $this->selectedIngredients[] = [
            'id' => $ingredient->id,
            'name' => $ingredient->name,
            'image' => $ingredient->image,
            'amount' => $amount ?: '',
            'unit' => $unit ?: ($this->units[0] ?? 'gram'),
            'isPrimary' => false,
            'category' => $ingredient->category ?? 'Umum'
        ];
    }

    public function updatedRecipeCategory($value)
    {
        $this->loadSuggestedIngredients($value);

        if ($this->recipeCategory) {
            $category = RecipeCategory::find($this->recipeCategory);
            $this->selectedCategoryName = $category ? $category->name : '';
        }
    }

    private function loadSuggestedIngredients($categoryId)
    {
        if (!$categoryId) {
            $this->suggestedIngredients = [];
            return;
        }

        // Ambil bahan yang sering digunakan berdasarkan kategori dari database
        $popularIngredients = \DB::table('recipe_ingredients')
            ->join('recipes', 'recipes.id', '=', 'recipe_ingredients.recipe_id')
            ->join('ingredients', 'ingredients.id', '=', 'recipe_ingredients.ingredient_id')
            ->where('recipes.category_id', $categoryId)
            ->select('ingredients.name', \DB::raw('COUNT(*) as usage_count'))
            ->groupBy('ingredients.name')
            ->orderBy('usage_count', 'desc')
            ->limit(6)
            ->get();

        $this->suggestedIngredients = $popularIngredients->map(function ($item) {
            return ['text' => $item->name, 'amount' => '', 'unit' => ''];
        })->toArray();

        // Fallback ke suggestions manual jika tidak ada data
        if (empty($this->suggestedIngredients)) {
            // Define suggestions based on recipe category
            $suggestions = [
                // hidangan pembuka (appetizer)
                1 => [
                    ['text' => 'selada', 'amount' => '100', 'unit' => 'gram'],
                    ['text' => 'tomat', 'amount' => '2', 'unit' => 'buah'],
                    ['text' => 'timun', 'amount' => '1', 'unit' => 'buah'],
                    ['text' => 'garam', 'amount' => '1', 'unit' => 'sdt'],
                    ['text' => 'lemon', 'amount' => '1', 'unit' => 'buah'],
                    ['text' => 'mayonaise', 'amount' => '2', 'unit' => 'sdm'],
                ],
                // hidangan utama (main course)
                2 => [
                    ['text' => 'daging sapi', 'amount' => '500', 'unit' => 'gram'],
                    ['text' => 'nasi putih', 'amount' => '4', 'unit' => 'piring'],
                    ['text' => 'kentang', 'amount' => '3', 'unit' => 'buah'],
                    ['text' => 'bawang merah', 'amount' => '3', 'unit' => 'siung'],
                    ['text' => 'bawang putih', 'amount' => '2', 'unit' => 'siung'],
                    ['text' => 'bawang bombay', 'amount' => '1', 'unit' => 'buah']
                ],
                // hidangan penutup (dessert)
                3 => [
                    ['text' => 'tepung terigu', 'amount' => '250', 'unit' => 'gram'],
                    ['text' => 'gula', 'amount' => '200', 'unit' => 'gram'],
                    ['text' => 'telur', 'amount' => '2', 'unit' => 'butir'],
                    ['text' => 'susu cair', 'amount' => '200', 'unit' => 'ml'],
                    ['text' => 'mentega', 'amount' => '100', 'unit' => 'gram']
                ]
            ];

            if (isset($suggestions[$categoryId])) {
                $this->suggestedIngredients = $suggestions[$categoryId];
                return;
            }

            // Default suggestions
            $this->suggestedIngredients = [
                ['text' => 'garam', 'amount' => '1', 'unit' => 'sdt'],
                ['text' => 'merica', 'amount' => '1/2', 'unit' => 'sdt'],
                ['text' => 'minyak goreng', 'amount' => '2', 'unit' => 'sdm']
            ];
        }
    }

    public function clearAllIngredients()
    {
        $this->selectedIngredients = [];
        $this->quickAddStatus = [
            'type' => 'success',
            'message' => 'Semua bahan telah dihapus'
        ];
    }

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
        try {
            // Set execution time limit
            set_time_limit(60);

            $recipeName = $this->name;

            // Validate inputs
            if (empty($recipeName)) {
                Toaster::error('Nama resep tidak boleh kosong.');
                return 0;
            }

            if (empty($this->selectedIngredients)) {
                Toaster::error('Pilih bahan-bahan terlebih dahulu.');
                return 0;
            }

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

            // Send the request to OpenAI with error handling
            try {
                $response = $client->chat()->create($payload);
            } catch (\OpenAI\Exceptions\ErrorException $e) {
                Toaster::error('Gagal menghitung kalori: ' . $e->getMessage());
                return 0;
            } catch (\GuzzleHttp\Exception\RequestException $e) {
                if ($e->hasResponse() && $e->getResponse()->getStatusCode() === 429) {
                    Toaster::error('Terlalu banyak permintaan. Silakan tunggu sebentar.');
                } else {
                    Toaster::error('Koneksi bermasalah. Periksa internet Anda.');
                }
                return 0;
            } catch (\Exception $e) {
                Toaster::error('Terjadi kesalahan: ' . $e->getMessage());
                return 0;
            }

            // Validate response
            if (!isset($response->choices[0]->message->content)) {
                Toaster::error('Respons tidak valid dari layanan AI.');
                return 0;
            }

            $detectedCalories = $response->choices[0]->message->content;

            // Validate content
            if (empty(trim($detectedCalories))) {
                Toaster::error('Tidak dapat menghitung kalori untuk resep ini.');
                return 0;
            }

            // remove non-numeric characters
            $detectedCalories = preg_replace('/\D/', '', $detectedCalories);

            // Validate numeric result
            if (empty($detectedCalories)) {
                Toaster::error('Format kalori tidak valid.');
                return 0;
            }

            // convert to integer
            $detectedCalories = (int) $detectedCalories;

            // Validate reasonable calorie range (0-10000 kcal)
            if ($detectedCalories < 0 || $detectedCalories > 10000) {
                Toaster::warning('Kalori yang dihitung mungkin tidak akurat: ' . $detectedCalories . ' kcal');
            }

            return $detectedCalories;

        } catch (\Throwable $e) {
            Toaster::error('Kesalahan sistem: ' . $e->getMessage());
            return 0;
        }
    }

    public function uploadImage($image)
    {
        try {
            // Upload ke Cloudinary menggunakan UploadApi
            $uploadApi = new \Cloudinary\Api\Upload\UploadApi();

            // Generate unique public_id
            $publicId = 'recipe_' . uniqid();

            $uploadResult = $uploadApi->upload($image->getRealPath(), [
                'folder' => 'recipes',
                'public_id' => $publicId,
                'transformation' => [
                    'quality' => 'auto:good',
                    'format' => 'auto',
                    'width' => 800,
                    'height' => 600,
                    'crop' => 'fill'
                ]
            ]);

            return $uploadResult['secure_url'];
        } catch (\Exception $e) {
            // Fallback ke penyimpanan lokal jika Cloudinary gagal
            \Log::warning('Cloudinary upload failed, using local storage: ' . $e->getMessage());
            return 'storage/' . $image->store('img/recipes', 'public');
        }
    }

    public function deleteImageFromCloudinary($imageUrl)
    {
        try {
            // Extract public_id dari URL Cloudinary
            $publicId = $this->extractPublicIdFromUrl($imageUrl);

            if ($publicId) {
                Cloudinary::destroy($publicId);
            }
        } catch (\Exception $e) {
            \Log::error('Gagal hapus gambar dari Cloudinary: ' . $e->getMessage());
        }
    }

    private function extractPublicIdFromUrl($url)
    {
        // Extract public_id dari URL Cloudinary
        // Format: https://res.cloudinary.com/cloud_name/image/upload/v1234567890/folder/filename.jpg
        $pattern = '/\/upload\/(?:v\d+\/)?(.+)\.[a-zA-Z]{3,4}$/';
        preg_match($pattern, $url, $matches);
        return $matches[1] ?? null;
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

        // Handle image upload to Cloudinary
        $imageUrl = $this->existingImagePath ?? null;
        if ($this->newImage) {
            try {
                // Delete old image from Cloudinary if exists
                if ($this->recipe && $this->recipe->image && str_contains($this->recipe->image, 'cloudinary.com')) {
                    $this->deleteImageFromCloudinary($this->recipe->image);
                }

                // Upload new image to Cloudinary
                $imageUrl = $this->uploadImage($this->newImage);
            } catch (\Exception $e) {
                Toaster::error('Gagal upload gambar: ' . $e->getMessage());
                return;
            }
        }

        // if recipe doesn't have image and new image is null, delete the image
        if (!$this->newImage && !$this->existingImagePath) {
            if ($this->recipe && $this->recipe->image && str_contains($this->recipe->image, 'cloudinary.com')) {
                $this->deleteImageFromCloudinary($this->recipe->image);
            }
            $imageUrl = null;
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

            // update recipe - sesuaikan dengan struktur tabel
            $this->recipe->update([
                'name' => $validated['name'],
                'category_id' => $validated['recipeCategory'],
                'description' => $validated['description'],
                'cooking_time' => $validated['cookingTime'],
                'difficulty' => $validated['difficulty'],
                'servings' => $validated['servings'],
                'image' => $imageUrl, // Simpan URL Cloudinary
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

            // recreate steps - sesuaikan dengan struktur tabel recipe_steps
            foreach ($this->steps as $index => $step) {
                $this->recipe->steps()->create([
                    'step_number' => $index + 1,
                    'description' => $step // field 'description' sesuai dengan migrasi
                ]);
            }
        } else {
            // count calories for each portion
            $calories = $this->countTotalCalories();

            // insert field to recipes table - sesuaikan dengan struktur tabel
            $recipe = Recipe::create([
                'name' => $validated['name'],
                'user_id' => $user->id,
                'category_id' => $validated['recipeCategory'],
                'description' => $validated['description'],
                'cooking_time' => $validated['cookingTime'],
                'difficulty' => $validated['difficulty'],
                'servings' => $validated['servings'],
                'image' => $imageUrl, // Simpan URL Cloudinary
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

            // create steps - sesuaikan dengan struktur tabel recipe_steps
            foreach ($this->steps as $index => $step) {
                $recipe->steps()->create([
                    'step_number' => $index + 1,
                    'description' => $step // field 'description' sesuai dengan migrasi
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

    public function getFormProgress()
    {
        $totalFields = 8; // Total field yang harus diisi
        $filledFields = 0;

        if (!empty($this->name))
            $filledFields++;
        if (!empty($this->description))
            $filledFields++;
        if (!empty($this->cookingTime))
            $filledFields++;
        if (!empty($this->difficulty))
            $filledFields++;
        if (!empty($this->servings))
            $filledFields++;
        if (!empty($this->recipeCategory))
            $filledFields++;
        if (count($this->selectedIngredients) > 0)
            $filledFields++;
        if (count(array_filter($this->steps)) > 0)
            $filledFields++;

        return round(($filledFields / $totalFields) * 100);
    }
}
