<?php

namespace App\Livewire;

use App\Models\Creator;
use App\Models\Ingredient;
use App\Models\Recipe;
use App\Models\RecipeCategory;
use Livewire\Component;

class ExploreDashboard extends Component
{
    public $todayTrending;
    public $totalDessert;
    public $totalMainCourse;
    public $totalRecipe;
    public $totalCreators;
    public $averageRating;
    public $totalNewRecipeInWeek;


    public function mount()
    {
        // today trending
        $this->todayTrending = $this->getTodayTrendingRecipe();

        // total dessert, total main course
        $this->totalDessert = $this->getTotalRecipeBasedOnCategory(3);
        $this->totalMainCourse = $this->getTotalRecipeBasedOnCategory(2);

        // total recipe, total creators, average rating, total new recipe in week
        $totalRecipe = Recipe::where('is_published', true)
            ->whereHas('moderation', function ($query) {
                $query->where('status', 'approved');
            })->count();
        $totalCreators = Creator::count();
        $averageRating = Recipe::where('is_published', true)
            ->whereHas('moderation', function ($query) {
                $query->where('status', 'approved');
            })
            ->whereHas('ratings')
            ->withAvg('ratings', 'rating')
            ->get()
            ->avg('ratings_avg_rating');
        $totalNewRecipeInWeek = Recipe::where('is_published', true)
            ->whereHas('moderation', function ($query) {
                $query->where('status', 'approved');
            })
            ->where('created_at', '>=', now()->subDays(7))
            ->count();

        $this->totalRecipe = $totalRecipe;
        $this->totalCreators = $totalCreators;
        $this->averageRating = $averageRating;
        $this->totalNewRecipeInWeek = $totalNewRecipeInWeek;



        // dd($todayTrending);
    }

    public function getTodayTrendingRecipe()
    {
        // Today's trending
        $todayTrending = Recipe::approved()
            ->where('created_at', '>=', now()->startOfDay())
            ->withCount(['bookmarkedBy', 'ratings'])
            ->having('views_count', '>', 0)
            ->orderByRaw('(views_count * 0.5) + (bookmarked_by_count * 0.3) + (ratings_count * 0.2) DESC')
            ->limit(1)
            ->get();

        if ($todayTrending->count() > 0) {
            return [
                'recipes' => $todayTrending->first(),
                'title' => '🔥 Trending Hari Ini',
            ];
        }

        // Fallback: this week's trending
        $weekTrending = Recipe::approved()
            ->where('created_at', '>=', now()->startOfWeek())
            ->withCount(['bookmarkedBy', 'ratings'])
            ->having('views_count', '>', 0)
            ->orderByRaw('(views_count * 0.5) + (bookmarked_by_count * 0.3) + (ratings_count * 0.2) DESC')
            ->limit(1)
            ->get();

        if ($weekTrending->count() > 0) {
            return [
                'recipes' => $weekTrending->first(),
                'title' => '🔥 Trending Minggu Ini',
            ];
        }

        // Falback: 30 days trending
        $monthTrending = Recipe::approved()
            ->where('created_at', '>=', now()->subDays(30))
            ->withCount(['bookmarkedBy', 'ratings'])
            ->having('views_count', '>', 0)
            ->orderByRaw('(views_count * 0.5) + (bookmarked_by_count * 0.3) + (ratings_count * 0.2) DESC')
            ->limit(1)
            ->get();

        if ($monthTrending->count() > 0) {
            return [
                'recipes' => $monthTrending->first(),
                'title' => '🔥 Resep Fresh',
            ];
        }

        // Fallback: all time trending
        $allTimeTrending = Recipe::approved()
            ->withCount(['bookmarkedBy', 'ratings'])
            ->having('views_count', '>', 0)
            ->orderByRaw('(views_count * 0.5) + (bookmarked_by_count * 0.3) + (ratings_count * 0.2) DESC')
            ->limit(1)
            ->get();

        if ($allTimeTrending->count() > 0) {
            return [
                'recipes' => $allTimeTrending->first(),
                'title' => '🔥 Resep Populer',
            ];
        }

        // Fallback: empty
        return [
            'recipes' => [],
            'title' => 'Tidak ada resep yang ditemukan',
        ];
    }

    public function getTotalRecipeBasedOnCategory($categoryId)
    {
        // Base query for recipes in the given category
        $baseQuery = Recipe::approved()->whereHas('category', fn($q) => $q->where('id', $categoryId));

        // Get total recipes and new recipes this week
        $recipeData = [
            'total' => (clone $baseQuery)->count(),
            'new' => (clone $baseQuery)->where('created_at', '>=', now()->subDays(7))->count()
        ];

        return $recipeData;
    }

    public function getTrendingCategories()
    {
        return RecipeCategory::withCount([
            'recipes' => function ($query) {
                $query->approved()
                    ->where('created_at', '>=', now()->subWeek());
            }
        ])
            ->having('recipes_count', '>', 0)
            ->orderBy('recipes_count', 'desc')
            ->get()
            ->map(function ($category) {
                return [
                    'name' => $category->name,
                    'count' => $category->recipes_count,
                    'color' => $this->getCategoryColor($category->name)
                ];
            });
    }

    private function getCategoryColor($categoryName)
    {
        return match (true) {
            str_contains(strtolower($categoryName), 'pembuka') => 'from-green-500 to-emerald-500',
            str_contains(strtolower($categoryName), 'utama') => 'from-blue-500 to-cyan-500',
            str_contains(strtolower($categoryName), 'penutup') => 'from-pink-500 to-rose-500',
            default => 'from-purple-500 to-violet-500'
        };
    }

    public function getTrendingIngredients()
    {
        return Ingredient::whereHas('recipes', function ($query) {
            $query->approved()
                ->where('created_at', '>=', now()->subWeek())
                ->where('is_primary', true);  // Check if THIS ingredient is primary in the recipe
        })
            ->withCount([
                'recipes' => function ($query) {
                    $query->approved()
                        ->where('created_at', '>=', now()->subWeek())
                        ->where('is_primary', true);  // Same condition for counting
                }
            ])
            ->orderBy('recipes_count', 'desc')
            ->limit(8)
            ->get()
            ->map(function ($ingredient) {
                return [
                    'name' => '#' . str_replace(' ', '', $ingredient->name),
                    'count' => $ingredient->recipes_count,
                    'color' => $this->getIngredientColor($ingredient->category)
                ];
            });
    }

    private function getIngredientColor($category)
    {
        return match ($category) {
            'protein' => 'from-red-500 to-pink-500',
            'sayuran' => 'from-green-500 to-emerald-500',
            'karbohidrat' => 'from-yellow-500 to-orange-500',
            'bumbu' => 'from-purple-500 to-violet-500',
            'produk susu' => 'from-blue-500 to-cyan-500',
            default => 'from-gray-500 to-slate-500'
        };
    }

    public function getTrendingCookingTime()
    {
        return Recipe::approved()
            ->where('created_at', '>=', now()->subWeek())
            ->get()
            ->groupBy(function ($recipe) {
                return match (true) {
                    $recipe->cooking_time <= 15 => 'QuickMeals',
                    $recipe->cooking_time <= 30 => '30MinuteMeals',
                    $recipe->cooking_time <= 60 => 'HourlyMeals',
                    default => 'SlowCooking'
                };
            })
            ->map(function ($recipes, $timeCategory) {
                return [
                    'name' => '#' . $timeCategory,
                    'count' => $recipes->count(),
                    'color' => match ($timeCategory) {
                        'QuickMeals' => 'from-green-500 to-emerald-500',
                        '30MinuteMeals' => 'from-blue-500 to-cyan-500',
                        'HourlyMeals' => 'from-orange-500 to-amber-500',
                        'SlowCooking' => 'from-purple-500 to-violet-500'
                    }
                ];
            })
            ->sortByDesc('count')
            ->take(4);
    }

    public function render()
    {
        return view('livewire.user.explore.explore-dashboard');
    }
}
