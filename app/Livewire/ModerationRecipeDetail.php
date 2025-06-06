<?php

namespace App\Livewire;

use App\Models\Recipe;
use Livewire\Component;

class ModerationRecipeDetail extends Component
{
    public $recipe;

    public function mount($recipeId)
    {
        $this->recipe = Recipe::with(['ingredients', 'moderation', 'user', 'steps', 'category'])->findOrFail($recipeId);
    }

    public function render()
    {
        return view('livewire.admin.moderation-recipe-detail');
    }
}
