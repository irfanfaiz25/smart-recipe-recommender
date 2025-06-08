<?php

namespace App\Livewire;

use App\Models\Creator;
use App\Models\Recipe;
use Livewire\Component;

class ExploreDashboard extends Component
{
    public $totalRecipe;
    public $totalCreators;
    public $averageRating;
    public $totalFavorite;


    public function mount()
    {
        $totalRecipe = Recipe::where('is_published', true)->count();
        $totalCreators = Creator::count();
        $averageRating = Recipe::where('is_published', true)
            ->whereHas('ratings')
            ->withAvg('ratings', 'rating')
            ->get()
            ->avg('ratings_avg_rating');
        $totalFavorite = Recipe::where('is_published', true)
            ->whereHas('bookmarkedBy')->count();

        $this->totalRecipe = $totalRecipe;
        $this->totalCreators = $totalCreators;
        $this->averageRating = $averageRating;
        $this->totalFavorite = $totalFavorite;

        // dd($totalFavorit);
    }

    public function render()
    {
        return view('livewire.user.explore.explore-dashboard');
    }
}
