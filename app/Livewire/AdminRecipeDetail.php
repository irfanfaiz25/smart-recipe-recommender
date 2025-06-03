<?php

namespace App\Livewire;

use App\Models\Rating;
use App\Models\Recipe;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class AdminRecipeDetail extends Component
{

    public $recipe;
    public $averageRating;
    public $sortBy = 'latest';

    public $recipeId;
    public $comment;
    public $rating;

    public $previousRoute;


    public function mount($recipeId)
    {
        $this->recipe = Recipe::with(['ingredients', 'ratings'])->find($recipeId);
        $this->recipeId = $recipeId;
        $this->updateAvgRating();
    }

    private function updateAvgRating()
    {
        $this->averageRating = number_format(Rating::where('recipe_id', $this->recipeId)->avg('rating'), 1);
    }

    public function render()
    {
        $query = Rating::where('recipe_id', $this->recipeId)->with('user');

        if ($this->sortBy === 'latest') {
            $ratings = $query->latest()->get();
        } elseif ($this->sortBy === 'higher') {
            $ratings = $query->orderBy('rating', 'desc')->get();
        } elseif ($this->sortBy === 'lower') {
            $ratings = $query->orderBy('rating', 'asc')->get();
        } else {
            $ratings = $query->withCount('likedBy')->orderBy('liked_by_count', 'desc')->get();
        }

        return view('livewire.admin.admin-recipe-detail', [
            'ratings' => $ratings
        ]);
    }
}
