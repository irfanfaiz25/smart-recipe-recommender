<?php

namespace App\Livewire;

use App\Models\Ingredient;
use App\Models\Recipe;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class SavoryRecipes extends Component
{
    public $selectedIngredientsId = [];
    public $matchedRecipes = [];
    public $caloriesCategory;

    public function mount()
    {
        $this->initializeRecipes();
    }

    #[On('selected-ingredient')]
    public function updateSelectedIngredients($ingredient)
    {
        $this->selectedIngredientsId[] = $ingredient['id'];

        $this->updateMatchedRecipes();
    }

    public function updatedCaloriesCategory($category)
    {
        $this->updateMatchedRecipes($category);
    }

    #[On('detected-ingredient')]
    public function updateDetectedIngredeints($ingredients)
    {
        // give condition here if the ingredient array doesnt have id
        if (empty($ingredients)) {
            Toaster::error('Tidak ada bahan yang terdeteksi');
            return;
        }

        foreach ($ingredients as $ingredient) {
            $this->selectedIngredientsId[] = $ingredient['id'];
        }

        $this->updateMatchedRecipes();
    }

    // public function getRecipesWithPartialMatch()
    // {
    //     $recipes = Recipe::whereHas('ingredients', function ($query) {
    //         $query->whereIn('ingredients.id', $this->selectedIngredientsId);
    //     })->with(['ingredients', 'bookmarkedBy'])->get();

    //     $recipeWithPercentage = $recipes->map(function ($recipe) {
    //         $matchingIngredients = $recipe->ingredients->whereIn('id', $this->selectedIngredientsId)->count();
    //         $percentage = ($matchingIngredients / count($this->selectedIngredientsId)) * 100;

    //         $missingIngredients = $recipe->ingredients->whereNotIn('id', $this->selectedIngredientsId);

    //         return [
    //             'recipe' => $recipe,
    //             'matching_percentage' => $percentage,
    //             'missing_ingredients' => $missingIngredients
    //         ];
    //     });

    //     return $recipeWithPercentage->where('matching_percentage', '>=', 75)->sortByDesc('matching_percentage');
    // }

    public function getRecipesWithCosineSimilarity($category = '')
    {
        // Collect all ingredients in the database
        $allIngredients = Ingredient::all();
        $totalRecipes = Recipe::count();

        // Count IDF for each ingredient
        $ingredientIdf = [];
        foreach ($allIngredients as $ingredient) {
            // Count the number of recipes containing the ingredient
            $recipesWithIngredient = DB::table('recipe_ingredients')
                ->where('ingredient_id', $ingredient->id)
                ->distinct('recipe_id')
                ->count('recipe_id');

            // Calculate IDF using the formula: log(total_recipes / recipes_with_ingredient)
            $idf = log(($totalRecipes + 1) / ($recipesWithIngredient + 1));

            // Apply weight to IDF for primary ingredients
            if ($ingredient->is_primary) {
                $idf *= 2;
            }

            $ingredientIdf[$ingredient->id] = $idf;
        }

        $caloriesCategory = [
            'rendah' => '0-400',
            'sedang' => '401-800',
            'tinggi' => '801-9999'
        ];

        if ($category) {
            $caloriesRange = $caloriesCategory[$category];
            [$minCalories, $maxCalories] = explode('-', $caloriesRange);

            $query = Recipe::query()
                ->where(DB::raw('calories / servings'), '>=', $minCalories)
                ->where(DB::raw('calories / servings'), '<=', $maxCalories)
                ->whereHas('ingredients', function ($query) {
                    $query->whereIn('ingredients.id', $this->selectedIngredientsId);
                })
                ->with(['ingredients', 'bookmarkedBy']);

            $recipes = $query->get();
        } else {
            // Get recipes that contain at least one of the selected ingredients
            $recipes = Recipe::whereHas('ingredients', function ($query) {
                $query->whereIn('ingredients.id', $this->selectedIngredientsId);
            })->with(['ingredients', 'bookmarkedBy'])->get();
        }


        $userVector = [];
        foreach ($this->selectedIngredientsId as $ingredientId) {
            // Default weight for ingredient
            $weight = 1;

            // Check if the ingredient is primary
            $ingredient = $allIngredients->firstWhere('id', $ingredientId);
            if ($ingredient && $ingredient->is_primary) {
                $weight = 2;
            }

            // Calculate TF-IDF for the ingredient
            $tf = 1 / count($this->selectedIngredientsId);
            $userVector[$ingredientId] = $tf * $ingredientIdf[$ingredientId];
        }

        $recipeWithPercentage = $recipes->map(function ($recipe) use ($userVector, $ingredientIdf) {
            // Create a vector for the recipe using TF-IDF 
            $recipeVector = [];
            $totalIngredientsInRecipe = $recipe->ingredients->count();

            // Count TF-IDF for each ingredient in the recipe
            foreach ($recipe->ingredients as $ingredient) {
                // TF is 1/total_ingredients_in_recipe
                $tf = 1 / $totalIngredientsInRecipe;

                // Give more weight to primary ingredients
                $weight = $ingredient->is_primary ? 2 : 1;

                // Calculate TF-IDF for the ingredient in the recipe
                $recipeVector[$ingredient->id] = $tf * $weight * $ingredientIdf[$ingredient->id];
            }

            // Calculate cosine similarity between user vector and recipe vector
            $similarity = $this->calculateCosineSimilarity($userVector, $recipeVector);

            // Calculate complexity score for the recipe
            $complexityFactor = 100 - min(($totalIngredientsInRecipe / 20) * 100, 100);

            // Calculate popularity score for the recipe based on views_count and rating
            $viewsScore = min(($recipe->views_count / 1000) * 100, 100);
            $ratingScore = ($recipe->ratings->avg('rating') / 5) * 100;
            $popularityScore = ($viewsScore * 0.6) + ($ratingScore * 0.4);

            // Calculate final score for the recipe
            $finalScore = ($similarity * 0.6) + ($complexityFactor * 0.2) + ($popularityScore * 0.2);

            // Calculate missing ingredients for the recipe
            $missingIngredients = $recipe->ingredients->whereNotIn('id', $this->selectedIngredientsId);

            return [
                'recipe' => $recipe,
                'matching_percentage' => $finalScore,
                'cosine_similarity' => $similarity,
                'missing_ingredients' => $missingIngredients,
                'ratings' => number_format($recipe->ratings->avg('rating'), 1),
                // 'complexity_factor' => $complexityFactor,
                // 'popularity_score' => $popularityScore,
                // 'rating_score' => $ratingScore,
                // 'views_score' => $viewsScore,
            ];
        });

        // Set the dynamic threshold based on the number of selected ingredients
        $threshold = 50; // Default threshold
        if (count($this->selectedIngredientsId) <= 3) {
            $threshold = 30;
        } elseif (count($this->selectedIngredientsId) >= 8) {
            $threshold = 60;
        }

        // Filter recipes based on the threshold
        return $recipeWithPercentage->where('matching_percentage', '>=', $threshold)
            ->sortByDesc('matching_percentage')
            ->values();
    }

    private function calculateCosineSimilarity($vectorA, $vectorB)
    {
        // Calculate the dot product of the two vectors
        $dotProduct = 0;
        foreach ($vectorA as $key => $value) {
            if (isset($vectorB[$key])) {
                $dotProduct += $value * $vectorB[$key];
            }
        }

        // Calculate magnitude of vector A
        $magnitudeA = 0;
        foreach ($vectorA as $value) {
            $magnitudeA += $value * $value;
        }
        $magnitudeA = sqrt($magnitudeA);

        // Calculate magnitude of vector B
        $magnitudeB = 0;
        foreach ($vectorB as $value) {
            $magnitudeB += $value * $value;
        }
        $magnitudeB = sqrt($magnitudeB);

        // Avoid division by zero
        if ($magnitudeA === 0 || $magnitudeB === 0) {
            return 0;
        }

        // Return the cosine similarity
        return ($dotProduct / ($magnitudeA * $magnitudeB)) * 100;
    }

    #[On('remove-selected-ingredient')]
    public function removeIngredient($id)
    {
        $this->selectedIngredientsId = collect($this->selectedIngredientsId)
            ->reject(fn($ingredient) => $ingredient === $id)
            ->values()
            ->toArray();

        $this->updateMatchedRecipes();
    }

    #[On('reset-ingredients')]
    public function resetIngredients()
    {
        $this->selectedIngredientsId = [];

        $this->updateMatchedRecipes();
    }

    public function viewRecipeDetail($id)
    {
        $recipe = Recipe::find($id);
        $recipe->views_count += 1;
        $recipe->save();

        $this->redirectRoute('savoryai.show', ['id' => $id], navigate: true);
    }

    public function toggleBookmark($recipeId)
    {
        $recipe = Recipe::find($recipeId);
        $user = auth()->user();

        if ($recipe->bookmarkedBy->contains($user)) {
            $recipe->bookmarkedBy()->detach($user);
            Toaster::success('Resep berhasil dihapus dari daftar favorit');
        } else {
            $recipe->bookmarkedBy()->attach($user);
            Toaster::success('Resep berhasil ditambahkan ke daftar favorit');
        }

        $this->updateMatchedRecipes();
        $this->dispatch('updated-bookmarks');
    }


    private function initializeRecipes($category = '')
    {
        $caloriesCategory = [
            'rendah' => '0-400',
            'sedang' => '401-800',
            'tinggi' => '801-99999'
        ];

        if ($category) {
            $caloriesRange = $caloriesCategory[$category];
            [$minCalories, $maxCalories] = array_map('intval', explode('-', $caloriesRange));

            $query = Recipe::where(DB::raw('calories / servings'), '>=', $minCalories)
                ->where(DB::raw('calories / servings'), '<=', $maxCalories)
                ->with(['ingredients', 'bookmarkedBy', 'ratings']);

            $recipes = $query->get();
        } else {
            $recipes = Recipe::with(['ingredients', 'bookmarkedBy', 'ratings'])->get();
        }

        $this->matchedRecipes = $recipes->map(function ($recipe) {
            return [
                'recipe' => $recipe,
                'matching_percentage' => false,
                'ratings' => number_format($recipe->ratings->avg('rating'), 1),
            ];
        });
    }

    private function updateMatchedRecipes($category = '')
    {
        if (empty($this->selectedIngredientsId)) {
            $this->initializeRecipes($category);
        } else {
            $this->matchedRecipes = $this->getRecipesWithCosineSimilarity($category);
        }
    }

    public function render()
    {
        return view('livewire.user.savory-recipes');
    }
}
