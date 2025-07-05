<?php

namespace App\Livewire;

use App\Models\Recipe;
use Livewire\Component;

class ExplorePopular extends Component
{
    public $popularRecipes = [];

    public function mount()
    {
        $popularRecipes = Recipe::approved()->with('ratings')->withCount(['bookmarkedBy', 'ratings'])->where('views_count', '>', 0)
            ->where('created_at', '>', now()->subDays(7))->orderByRaw('(views_count * 0.5) + (bookmarked_by_count * 0.3) + (ratings_count * 0.2) DESC')->take(8)->get();

        // check if there are any popular recipes in a week
        if ($popularRecipes->count() > 5) {
            $this->popularRecipes = $popularRecipes;
        } else {
            $this->popularRecipes = Recipe::approved()->with('ratings')->withCount(['bookmarkedBy', 'ratings'])->where('views_count', '>', 0)->orderByRaw('(views_count * 0.5) + (bookmarked_by_count * 0.3) + (ratings_count * 0.2) DESC')->take(8)->get();
        }
    }

    public function render()
    {
        return view('livewire.user.explore.explore-popular');
    }
}
