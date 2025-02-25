<?php

namespace App\Livewire;

use App\Models\Ingredient;
use Livewire\Attributes\On;
use Livewire\Component;

class SavoryIngredients extends Component
{
    public $ingredients;
    public $selectedIngredients = [];
    public $search = '';

    public function mount()
    {
        $this->ingredients = Ingredient::select(['id', 'name', 'image', 'category'])
            ->get();
    }

    public function removeIngredient($id)
    {
        $this->selectedIngredients = collect($this->selectedIngredients)
            ->reject(fn($ingredient) => $ingredient['id'] === $id)
            ->values()
            ->toArray();

        $this->ingredients = Ingredient::select(['id', 'name', 'image'])
            ->whereNotIn('id', collect($this->selectedIngredients)->pluck('id'))
            ->get();

        $this->dispatch('remove-selected-ingredient', $id);
    }

    public function selectIngredient($value)
    {
        $ingredient = json_decode($value, true);
        $this->selectedIngredients[] = $ingredient;

        $this->ingredients = Ingredient::select(['id', 'name', 'image'])
            ->whereNotIn('id', collect($this->selectedIngredients)->pluck('id'))
            ->get();

        $this->dispatch('selected-ingredient', $ingredient);
    }

    public function render()
    {
        $searchTerm = '%' . $this->search . '%';

        $this->ingredients = Ingredient::select(['id', 'name', 'image', 'category'])
            ->whereNotIn('id', collect($this->selectedIngredients)->pluck('id'))
            ->where('name', 'like', $searchTerm)
            ->orderBy('category')
            ->get()
            ->groupBy('category')
            ->toBase();

        return view('livewire.user.savory-ingredients');
    }
}
