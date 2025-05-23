<?php

namespace App\Livewire;

use App\Models\Recipe;
use DB;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use Masmerise\Toaster\Toaster;

class RecipeBookmark extends Component
{
    use WithPagination;

    public $search = '';
    public $category = '';
    public $sortBy = '';

    public $caloriesCategory = [
        'rendah' => '0-400',
        'sedang' => '401-800',
        'tinggi' => '801-9999'
    ];


    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedCategory()
    {
        $this->resetPage();
    }

    public function updatedSortBy()
    {
        $this->resetPage();
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

    #[On('reload-recipes')]
    public function reload()
    {
        dd('oke');
    }

    public function viewRecipeDetail($id)
    {
        $recipe = Recipe::find($id);
        $recipe->views_count += 1;
        $recipe->save();

        $this->redirectRoute('bookmarks.show', ['id' => $id], navigate: true);
    }

    public function render()
    {
        $recipes = auth()->user()->bookmarkedRecipes()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->when($this->category, function ($query) {
                $caloriesRange = $this->caloriesCategory[$this->category];
                [$minCalories, $maxCalories] = explode('-', $caloriesRange);

                $query->where(DB::raw('calories / servings'), '>=', $minCalories)
                    ->where(DB::raw('calories / servings'), '<=', $maxCalories);
            })
            ->when($this->sortBy, function ($query) {
                switch ($this->sortBy) {
                    // need explanation later
                    case 'higher':
                        $query->withAvg('ratings', 'rating')
                            ->orderBy('ratings_avg_rating', 'desc');
                        break;
                    case 'lower':
                        $query->withAvg('ratings', 'rating')
                            ->orderBy('ratings_avg_rating', 'asc');
                        break;
                    default:
                        $query->latest();
                }
            })
            ->paginate(12);

        return view('livewire.user.recipe-bookmark', [
            'recipes' => $recipes
        ]);
    }
}
