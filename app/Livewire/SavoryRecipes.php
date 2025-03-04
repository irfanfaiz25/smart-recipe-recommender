<?php

namespace App\Livewire;

use App\Models\Recipe;
use Livewire\Attributes\On;
use Livewire\Component;

class SavoryRecipes extends Component
{
    public $selectedIngredientsId = [];
    public $matchedRecipes = [];

    public function mount()
    {
        $this->initializeRecipes();
    }

    #[On('selected-ingredient')]
    public function updateSelectedIngredients($ingredient)
    {
        $this->selectedIngredientsId[] = $ingredient['id'];

        $this->updateMatchedRecipes();
    }

    #[On('detected-ingredient')]
    public function updateDetectedIngredeints($ingredients)
    {
        foreach ($ingredients as $ingredient) {
            $this->selectedIngredientsId[] = $ingredient['id'];
        }

        $this->updateMatchedRecipes();
    }

    public function getRecipesWithPartialMatch()
    {
        $recipes = Recipe::whereHas('ingredients', function ($query) {
            $query->whereIn('ingredients.id', $this->selectedIngredientsId);
        })->with(['ingredients', 'bookmarkedBy'])->get();

        $recipeWithPercentage = $recipes->map(function ($recipe) {
            $matchingIngredients = $recipe->ingredients->whereIn('id', $this->selectedIngredientsId)->count();
            $percentage = ($matchingIngredients / count($this->selectedIngredientsId)) * 100;

            $missingIngredients = $recipe->ingredients->whereNotIn('id', $this->selectedIngredientsId);

            return [
                'recipe' => $recipe,
                'matching_percentage' => $percentage,
                'missing_ingredients' => $missingIngredients
            ];
        });

        return $recipeWithPercentage->where('matching_percentage', '>=', 75)->sortByDesc('matching_percentage');
    }

    #[On('remove-selected-ingredient')]
    public function removeIngredient($id)
    {
        $this->selectedIngredientsId = collect($this->selectedIngredientsId)
            ->reject(fn($ingredient) => $ingredient === $id)
            ->values()
            ->toArray();

        $this->updateMatchedRecipes();
    }

    #[On('reset-ingredients')]
    public function resetIngredients()
    {
        $this->selectedIngredientsId = [];

        $this->updateMatchedRecipes();
    }

    public function viewRecipeDetail($id)
    {
        $recipe = Recipe::find($id);
        $recipe->views_count += 1;
        $recipe->save();

        $this->redirectRoute('savoryai.show', ['id' => $id], navigate: true);
    }

    public function toggleBookmark($recipeId)
    {
        $recipe = Recipe::find($recipeId);
        $user = auth()->user();

        if ($recipe->bookmarkedBy->contains($user)) {
            $recipe->bookmarkedBy()->detach($user);
            toastr()->success('Resep dihapus dari bookmarks');
        } else {
            $recipe->bookmarkedBy()->attach($user);
            toastr()->success('Resep dimasukkan ke bookmarks.');
        }

        $this->updateMatchedRecipes();
        $this->dispatch('updated-bookmarks');
    }


    private function initializeRecipes()
    {
        $recipes = Recipe::with(['ingredients', 'bookmarkedBy'])->get();
        $this->matchedRecipes = $recipes->map(function ($recipe) {
            return [
                'recipe' => $recipe,
                'matching_percentage' => false
            ];
        });
    }

    private function updateMatchedRecipes()
    {
        if (empty($this->selectedIngredientsId)) {
            $this->initializeRecipes();
        } else {
            $this->matchedRecipes = $this->getRecipesWithPartialMatch();
        }
    }

    public function render()
    {
        return view('livewire.user.savory-recipes');
    }
}
