<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Recipe;
use App\Models\Rating;
use App\Models\RecipeModeration;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CreatorsDashboard extends Component
{
    public $totalRecipes;
    public $publishedRecipes;
    public $pendingRecipes;
    public $totalViews;
    public $totalBookmarks;
    public $averageRating;
    public $thisMonthRecipes;
    public $recentRecipes;
    public $topRecipes;
    public $categoryStats;
    public $monthlyCreatedRecipe;
    public $ratingDistribution;
    public $recentRatings;

    public function mount()
    {
        $this->loadPersonalMetrics();
        $this->loadRecentData();
        $this->loadAnalytics();
    }

    private function loadPersonalMetrics()
    {
        $userId = Auth::id();

        $this->totalRecipes = Recipe::where('user_id', $userId)->count();
        $this->publishedRecipes = Recipe::approved()->where('user_id', $userId)->where('is_published', true)->count();
        $this->pendingRecipes = Recipe::where('user_id', $userId)
            ->whereHas('moderation', function ($query) {
                $query->where('status', 'pending');
            })->count();

        $this->totalViews = Recipe::approved()->where('user_id', $userId)->sum('views_count');
        $this->totalBookmarks = Recipe::approved()->where('user_id', $userId)
            ->withCount('bookmarkedBy')
            ->get()
            ->sum('bookmarked_by_count');

        $this->averageRating = Recipe::approved()->where('user_id', $userId)
            ->withAvg('ratings', 'rating')
            ->get()
            ->avg('ratings_avg_rating') ?? 0;

        $this->thisMonthRecipes = Recipe::where('user_id', $userId)
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();
    }

    private function loadRecentData()
    {
        $userId = Auth::id();

        $this->recentRecipes = Recipe::where('user_id', $userId)
            ->with(['category', 'moderation'])
            ->latest()
            ->take(5)
            ->get();

        $this->topRecipes = Recipe::where('user_id', $userId)
            ->where('is_published', true)
            ->orderBy('views_count', 'desc')
            ->take(5)
            ->get();

        $this->recentRatings = Rating::whereHas('recipe', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })
            ->with(['recipe', 'user'])
            ->latest()
            ->take(5)
            ->get();
    }

    private function loadAnalytics()
    {
        $userId = Auth::id();

        // Category statistics
        $this->categoryStats = Recipe::where('user_id', $userId)
            ->select('recipe_categories.name', DB::raw('count(*) as count'))
            ->join('recipe_categories', 'recipes.category_id', '=', 'recipe_categories.id')
            ->groupBy('recipe_categories.name')
            ->get();

        // Monthly recipe creation for the last 6 months
        $this->monthlyCreatedRecipe = Recipe::where('user_id', $userId)
            ->select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('YEAR(created_at) as year'),
                DB::raw('COUNT(*) as total_recipes')
            )
            ->where('created_at', '>=', now()->subMonths(6))
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        // Rating distribution
        $this->ratingDistribution = Rating::whereHas('recipe', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })
            ->select('rating', DB::raw('count(*) as count'))
            ->groupBy('rating')
            ->orderBy('rating')
            ->get();
    }

    public function render()
    {
        return view('livewire.admin.creators-dashboard');
    }
}
