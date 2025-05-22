<?php

namespace App\Livewire;

use App\Models\Ingredient;
use App\Models\Recipe;
use App\Models\RecipeStep;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;
use Masmerise\Toaster\Toaster;

class RecipesTable extends Component
{
    use WithPagination;

    public $search = '';
    public $showDetailModal = false;
    public $detailName = '';
    public $detailContent = [];

    public $showDeleteConfirmationModal = false;
    public $deleteId = '';
    public $deleteName = '';


    public function handleShowDetailModal($name, $id)
    {
        $this->showDetailModal = true;
        $this->detailName = $name;

        $recipe = Recipe::with([
            'ingredients' => function ($query) {
                $query->withPivot(['amount', 'unit']);
            }
        ])->find($id);
        $this->detailContent = $name === 'ingredient' ? $recipe->ingredients->toArray() : $recipe->steps->toArray();
    }

    public function handleCloseDetailModal()
    {
        $this->showDetailModal = false;
        $this->detailName = '';
        $this->detailContent = [];
    }

    public function handleShowDeleteModal($id, $name)
    {
        $this->deleteId = $id;
        $this->deleteName = $name;

        $this->showDeleteConfirmationModal = true;
    }

    public function handleCloseDeleteModal()
    {
        $this->reset('deleteId', 'deleteName');

        $this->showDeleteConfirmationModal = false;
    }

    public function handleDelete()
    {
        $recipe = Recipe::find($this->deleteId);

        if ($recipe->image && Storage::disk('public')->exists(str_replace('storage/', '', $recipe->image))) {
            Storage::disk('public')->delete(str_replace('storage/', '', $recipe->image));
        }

        $recipe->delete();
        $this->handleCloseDeleteModal();
        Toaster::success('Resep berhasil di hapus');
    }

    public function render()
    {
        $user = auth()->user();
        $recipes = Recipe::where('user_id', $user->id)
            ->with(['user', 'ratings'])
            ->when($this->search, function ($query) {
                $query->where('name', 'like', "%$this->search%");
            })->latest()->paginate(10);

        return view('livewire.admin.recipes-table', [
            'recipes' => $recipes
        ]);
    }
}
