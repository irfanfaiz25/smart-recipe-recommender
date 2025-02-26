<?php

namespace App\Livewire;

use App\Models\Recipe;
use Livewire\Component;

class RecipeDetail extends Component
{
    public $recipe;


    public function mount($recipeId)
    {
        $this->recipe = Recipe::with('ingredients')->find($recipeId);
    }

    public function render()
    {
        return view('livewire.user.recipe-detail');
    }
}
