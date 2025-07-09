<?php

namespace App\Livewire;

use App\Models\Ingredient;
use App\Models\Recipe;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use Masmerise\Toaster\Toaster;

class SavoryRecipes extends Component
{
    use WithPagination;

    public $selectedIngredientsId = [];
    public $caloriesCategory;
    public $perPage = 6;

    protected $queryString = [
        'caloriesCategory' => ['except' => ''],
    ];


    public function mount()
    {
        $this->initializeRecipes();
    }

    public function loadMoreRecipes()
    {
        $this->perPage += 6;
    }

    #[On('selected-ingredient')]
    public function updateSelectedIngredients($ingredient)
    {
        $this->selectedIngredientsId[] = $ingredient['id'];
        $this->resetPage(); // Reset pagination when ingredients change
        $this->perPage = 6; // Reset perPage
    }

    public function updatedCaloriesCategory($category)
    {
        $this->resetPage(); // Reset pagination when category changes
        $this->perPage = 6; // Reset perPage
    }

    #[On('detected-ingredient')]
    public function updateDetectedIngredeints($ingredients)
    {
        if (empty($ingredients)) {
            Toaster::error('Tidak ada bahan yang terdeteksi. Silakan coba lagi.');
            return;
        }

        foreach ($ingredients as $ingredient) {
            $this->selectedIngredientsId[] = $ingredient['id'];
        }

        $this->resetPage(); // Reset pagination
        $this->perPage = 6; // Reset perPage
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
        $totalRecipes = Recipe::approved()->count();

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

            $query = Recipe::approved()
                ->where(DB::raw('calories / servings'), '>=', $minCalories)
                ->where(DB::raw('calories / servings'), '<=', $maxCalories)
                ->whereHas('ingredients', function ($query) {
                    $query->whereIn('ingredients.id', $this->selectedIngredientsId);
                })
                ->with(['ingredients', 'bookmarkedBy']);

            $recipes = $query->get();
        } else {
            // Get recipes that contain at least one of the selected ingredients
            $recipes = Recipe::approved()->whereHas('ingredients', function ($query) {
                $query->whereIn('ingredients.id', $this->selectedIngredientsId);
            })->with(['ingredients', 'bookmarkedBy'])->get();
        }


        $userVector = [];
        foreach ($this->selectedIngredientsId as $ingredientId) {
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

            // Scale similarity to 0-100 for consistent calculation
            $similarityScore = $similarity * 100;

            // Calculate complexity score for the recipe (improved formula)
            // Lower complexity is better, but not too simple
            $optimalIngredientCount = 8; // Sweet spot for recipe complexity
            $complexityDifference = abs($totalIngredientsInRecipe - $optimalIngredientCount);
            $complexityFactor = max(0, 100 - ($complexityDifference * 10));

            // Calculate popularity score with cold start handling
            $viewsScore = min(($recipe->views_count / 1000) * 100, 100);
            $avgRating = $recipe->ratings->avg('rating');

            // Handle cold start problem for new recipes
            if ($recipe->ratings->count() == 0) {
                // Give new recipes a neutral rating score
                $ratingScore = 60; // Neutral score for unrated recipes
            } else {
                $ratingScore = ($avgRating / 5) * 100;
            }

            // Add freshness bonus for new recipes (created within last 30 days)
            $freshnessBonus = 0;
            if ($recipe->created_at->diffInDays(now()) <= 30) {
                $freshnessBonus = 10; // 10 point bonus for fresh recipes
            }

            // Calculate popularity score with cold start consideration
            if ($recipe->views_count == 0 && $recipe->ratings->count() == 0) {
                // For completely new recipes, use baseline + freshness bonus
                $popularityScore = 50 + $freshnessBonus;
            } else {
                $popularityScore = ($viewsScore * 0.6) + ($ratingScore * 0.4) + $freshnessBonus;
            }

            // Calculate final score with new weights (70% similarity, 15% complexity, 15% popularity)
            $finalScore = ($similarityScore * 0.7) + ($complexityFactor * 0.15) + ($popularityScore * 0.15);

            // Calculate missing ingredients for the recipe
            $missingIngredients = $recipe->ingredients->whereNotIn('id', $this->selectedIngredientsId);

            return [
                'recipe' => $recipe,
                'matching_percentage' => $finalScore,
                'cosine_similarity' => $similarity,
                'missing_ingredients' => $missingIngredients,
                'ratings' => number_format($avgRating ?: 0, 1),
                'complexity_factor' => $complexityFactor,
                'popularity_score' => $popularityScore,
                'rating_score' => $ratingScore,
                'views_score' => $viewsScore,
                'freshness_bonus' => $freshnessBonus,
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
        return ($dotProduct / ($magnitudeA * $magnitudeB));
    }

    #[On('remove-selected-ingredient')]
    public function removeIngredient($id)
    {
        $this->selectedIngredientsId = collect($this->selectedIngredientsId)
            ->reject(fn($ingredient) => $ingredient === $id)
            ->values()
            ->toArray();

        $this->resetPage(); // Reset pagination
        $this->perPage = 6; // Reset perPage
    }

    #[On('reset-ingredients')]
    public function resetIngredients()
    {
        $this->selectedIngredientsId = [];
        $this->resetPage(); // Reset pagination
        $this->perPage = 6; // Reset perPage
    }

    public function toggleBookmark($recipeId)
    {
        $recipe = Recipe::approved()->find($recipeId);
        $user = auth()->user();

        if ($recipe->bookmarkedBy->contains($user)) {
            $recipe->bookmarkedBy()->detach($user);
            Toaster::success('Resep berhasil dihapus dari daftar favorit');
        } else {
            $recipe->bookmarkedBy()->attach($user);
            Toaster::success('Resep berhasil ditambahkan ke daftar favorit');
        }

        $this->dispatch('updated-bookmarks');
        // Don't reset pagination for bookmark toggle
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

            $query = Recipe::approved()->where(DB::raw('calories / servings'), '>=', $minCalories)
                ->where(DB::raw('calories / servings'), '<=', $maxCalories)
                ->with(['ingredients', 'bookmarkedBy', 'ratings']);

            $allRecipes = $query->get();
        } else {
            $allRecipes = Recipe::approved()->with(['ingredients', 'bookmarkedBy', 'ratings'])->get();
        }

        $this->totalRecipes = $allRecipes->count();
        $recipes = $allRecipes->take($this->perPage);
        $this->hasMoreRecipes = $this->totalRecipes > $this->perPage;

        $this->matchedRecipes = $recipes->map(function ($recipe) {
            return [
                'recipe' => $recipe,
                'matching_percentage' => false,
                'cosine_similarity' => false,
                'ratings' => number_format($recipe->ratings->avg('rating'), 1),
            ];
        });
    }

    private function updateMatchedRecipes($category = '')
    {
        if (empty($this->selectedIngredientsId)) {
            $this->initializeRecipes($category);
        } else {
            $allMatchedRecipes = $this->getRecipesWithCosineSimilarity($category);
            $this->totalRecipes = $allMatchedRecipes->count();
            $this->matchedRecipes = $allMatchedRecipes->take($this->perPage);
            $this->hasMoreRecipes = $this->totalRecipes > $this->perPage;
        }
    }

    private function getRecipesQuery($caloriesCategory = null)
    {
        $query = Recipe::approved()->with(['user', 'ratings', 'ingredients', 'category']);

        if ($caloriesCategory) {
            $caloriesRange = [
                'rendah' => '0-400',
                'sedang' => '401-800',
                'tinggi' => '801-9999'
            ];

            if (isset($caloriesRange[$caloriesCategory])) {
                [$minCalories, $maxCalories] = explode('-', $caloriesRange[$caloriesCategory]);
                $query->where(DB::raw('calories / servings'), '>=', $minCalories)
                    ->where(DB::raw('calories / servings'), '<=', $maxCalories);
            }
        }

        // If ingredients are selected, we'll handle the filtering differently
        if (!empty($this->selectedIngredientsId)) {
            // For ingredient-based filtering, we'll use the similarity algorithm
            // but still return a query builder for pagination
            $allMatchedRecipes = $this->getRecipesWithCosineSimilarity($caloriesCategory);
            $recipeIds = $allMatchedRecipes->pluck('recipe.id')->toArray();

            if (!empty($recipeIds)) {
                $query->whereIn('id', $recipeIds)
                    ->orderByRaw('FIELD(id, ' . implode(',', $recipeIds) . ')');
            } else {
                // No matching recipes found
                $query->whereRaw('1 = 0'); // Return empty result
            }
        } else {
            // Default ordering for recipes without ingredient filtering
            $query->orderBy('created_at', 'desc');
        }

        return $query;
    }

    public function render()
    {
        $recipes = $this->getRecipesQuery($this->caloriesCategory)->paginate($this->perPage);

        // If using matched recipes, add similarity data
        if (!empty($this->selectedIngredientsId)) {
            $allMatchedRecipes = $this->getRecipesWithCosineSimilarity($this->caloriesCategory);
            $similarityData = $allMatchedRecipes->keyBy('recipe.id');

            $recipes->getCollection()->transform(function ($recipe) use ($similarityData) {
                $recipe->similarity_data = $similarityData->get($recipe->id, [
                    'matching_percentage' => false,
                    'cosine_similarity' => false,
                    'ratings' => number_format($recipe->ratings->avg('rating'), 1),
                ]);
                return $recipe;
            });
        } else {
            // For initial recipes without similarity
            $recipes->getCollection()->transform(function ($recipe) {
                $recipe->similarity_data = [
                    'matching_percentage' => false,
                    'cosine_similarity' => false,
                    'ratings' => number_format($recipe->ratings->avg('rating'), 1),
                ];
                return $recipe;
            });
        }

        return view('livewire.user.savoryai.savory-recipes', compact('recipes'));
    }
}
