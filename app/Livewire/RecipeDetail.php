<?php

namespace App\Livewire;

use App\Models\CookingHistory;
use App\Models\Rating;
use App\Models\Recipe;
use Livewire\Attributes\On;
use Livewire\Component;
use Masmerise\Toaster\Toaster;
use Illuminate\Support\Str;

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
        $recipe = Recipe::with(['ingredients', 'ratings'])->find($recipeId);
        if (!$recipe) {
            abort(404);
        }

        $recipe->views_count += 1;
        $recipe->save();
        $this->recipe = $recipe;
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

    public function addToCookingHistory()
    {
        if (!auth()->check()) {
            Toaster::error('Silakan login terlebih dahulu');
            return;
        }

        $user = auth()->user();
        $recipeId = $this->recipeId;

        // Cek apakah sudah ada di riwayat hari ini
        $existingHistory = CookingHistory::where('user_id', $user->id)
            ->where('recipe_id', $recipeId)
            ->whereDate('cooked_at', today())
            ->first();

        if ($existingHistory) {
            Toaster::info('Resep ini sudah ada di riwayat masak hari ini');
            return;
        }

        // Simpan ke riwayat masak
        CookingHistory::create([
            'user_id' => $user->id,
            'recipe_id' => $recipeId,
            'cooked_at' => now(),
            'notes' => null, // Bisa ditambahkan form untuk catatan nanti
        ]);

        Toaster::success('Resep berhasil ditambahkan ke riwayat masak!');
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
