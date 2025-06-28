<?php

namespace App\Livewire;

use App\Models\Creator;
use App\Models\Recipe;
use App\Models\RecipeModeration;
use App\Models\Suggestion;
use App\Models\User;
use App\Models\RecipeCategory;
use Livewire\Component;
use Carbon\Carbon;

class AdminDashboard extends Component
{
    public $metrics = [];
    public $recentRecipes = [];
    public $pendingModerations = [];
    public $categoryStats = [];
    public $monthlyStats = [];
    public $topCreators = [];
    public $ratingsDistribution = [];
    public $engagementMetrics = [];

    private function loadMetrics()
    {
        $this->metrics = [
            'total_recipes' => Recipe::approved()->count(),
            'pending_moderation' => RecipeModeration::where('status', 'pending')->count(),
            'total_suggestions' => Suggestion::where('status', 'pending')->count(),
            'total_creators' => Creator::count(),
            'total_users' => User::role('user')->count(),
            'recipes_this_month' => Recipe::approved()->whereMonth('created_at', now()->month)->count(),
            'avg_rating' => round(Recipe::approved()->withAvg('ratings', 'rating')->get()->avg('ratings_avg_rating') ?? 0, 1),
            'total_views' => Recipe::approved()->sum('views_count'),
            'total_bookmarks' => Recipe::approved()->withCount('bookmarkedBy')->get()->sum('bookmarked_by_count'),
        ];
    }

    private function loadRecentActivity()
    {
        $this->recentRecipes = Recipe::with(['user', 'category'])
            ->latest()
            ->take(5)
            ->get();

        $this->pendingModerations = Recipe::with(['user', 'moderation'])
            ->whereHas('moderation', function ($query) {
                $query->where('status', 'pending');
            })
            ->latest()
            ->take(5)
            ->get();
    }

    private function loadCategoryStats()
    {
        $this->categoryStats = RecipeCategory::withCount([
            'recipes' => function ($query) {
                $query->approved();
            }
        ])->get();
    }

    private function loadMonthlyStats()
    {
        $this->monthlyStats = collect(range(0, 5))->map(function ($i) {
            $date = now()->subMonths($i);
            return [
                'month' => $date->format('M Y'),
                'recipes' => Recipe::approved()
                    ->whereYear('created_at', $date->year)
                    ->whereMonth('created_at', $date->month)
                    ->count()
            ];
        })->reverse()->values();
    }

    private function loadTopCreators()
    {
        $this->topCreators = User::role('creators')
            ->withCount([
                'recipes' => function ($query) {
                    $query->approved();
                }
            ])
            ->withAvg('recipes', 'views_count')
            ->orderByDesc('recipes_count')
            ->take(5)
            ->get();
    }

    private function loadRatingsDistribution()
    {
        // Get ratings distribution data
        $this->ratingsDistribution = collect(range(1, 5))->map(function ($rating) {
            return [
                'rating' => $rating,
                'count' => \App\Models\Rating::where('rating', $rating)->count()
            ];
        });
    }

    private function loadEngagementMetrics()
    {
        // Calculate engagement metrics as percentages
        $totalRecipes = Recipe::approved()->count();
        $this->engagementMetrics = [
            'views' => $totalRecipes > 0 ? (Recipe::approved()->where('views_count', '>', 0)->count() / $totalRecipes) * 100 : 0,
            'bookmarks' => $totalRecipes > 0 ? (Recipe::approved()->has('bookmarkedBy')->count() / $totalRecipes) * 100 : 0,
            'ratings' => $totalRecipes > 0 ? (Recipe::approved()->has('ratings')->count() / $totalRecipes) * 100 : 0,
            'comments' => 65, // Replace with actual comment data when available
        ];
    }

    // Update the mount method to include these new data loads
    public function mount()
    {
        $this->loadMetrics();
        $this->loadRecentActivity();
        $this->loadCategoryStats();
        $this->loadMonthlyStats();
        $this->loadTopCreators();
        $this->loadRatingsDistribution(); // Add this
        $this->loadEngagementMetrics(); // Add this
    }

    public function render()
    {
        return view('livewire.admin.admin-dashboard');
    }
}
