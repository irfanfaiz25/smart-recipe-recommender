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

    public $showDeleteConfirmationModal = false;
    public $deleteId = '';
    public $deleteName = '';

    public $showDetailRejection = false;
    public $rejectedRecipe = null;



    public function handleOpenDetailRejection($id)
    {
        $this->selectedRecipeIdRejection = $id;
        $recipe = Recipe::with([
            'moderation' => function ($moderation) {
                $moderation->with('approver');
            }
        ])->find($this->selectedRecipeIdRejection);
        if (!$recipe) {
            Toaster::error('Resep tidak ditemukan');
            return;
        }

        $this->rejectedRecipe = $recipe;
        $this->showDetailRejection = true;
    }

    public function handleCloseDetailRejection()
    {
        $this->selectedRecipeIdRejection = null;
        $this->rejectedRecipe = null;
        $this->showDetailRejection = false;
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
        $recipes = Recipe::query();

        if ($user->hasRole('creators')) {
            $recipes->where('user_id', $user->id);
        }

        $recipes = $recipes->with(['user', 'ratings', 'moderation'])
            ->when($this->search, function ($query) {
                $query->where('name', 'like', "%$this->search%");
            })->latest()->paginate(10);

        return view('livewire.admin.recipes-table', [
            'recipes' => $recipes
        ]);
    }
}
