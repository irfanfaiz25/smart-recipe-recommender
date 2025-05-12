<?php

namespace App\Livewire;

use App\Models\Rating;
use App\Models\Recipe;
use Livewire\Attributes\On;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class RecipeDetail extends Component
{
    public $recipe;
    public $averageRating;
    public $sortBy = 'latest';

    public $recipeId;
    public $comment;
    public $rating;


    public function mount($recipeId)
    {
        $this->recipe = Recipe::with(['ingredients', 'ratings'])->find($recipeId);
        $this->recipeId = $recipeId;

        $this->updateAvgRating();
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

        $this->dispatch('updated-bookmarks');
    }

    public function toggleLike($ratingId)
    {
        $rating = Rating::find($ratingId);
        $user = auth()->user();

        if ($rating->likedBy->contains($user)) {
            $rating->likedBy()->detach($user);
        } else {
            $rating->likedBy()->attach($user);
        }
    }

    public function submitRating()
    {
        $this->validate([
            'comment' => 'required|string|min:3',
            'rating' => 'required|integer|min:1|max:5'
        ]);

        Rating::create([
            'user_id' => auth()->user()->id,
            'recipe_id' => $this->recipeId,
            'rating' => $this->rating,
            'comment' => $this->comment,
        ]);

        $this->updateAvgRating();
        $this->reset(['rating', 'comment']);
        $this->dispatch('rating-submitted');
        Toaster::success('Penilaian berhasil disimpan');
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

        return view('livewire.user.recipe-detail', [
            'ratings' => $ratings
        ]);
    }
}
