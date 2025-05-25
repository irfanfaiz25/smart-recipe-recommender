<?php

namespace App\Livewire;

use App\Models\Recipe;
use Livewire\Component;
use Livewire\WithPagination;
use Masmerise\Toaster\Toaster;

class ModerationRecipe extends Component
{
    use WithPagination;

    public $showFormRejection = false;
    public $selectedRecipeId;
    public $reason = '';

    public $showDetailRejection = false;
    public $selectedRecipeIdRejection;
    public $rejectedRecipe;

    public $search = '';
    public $status = 'all';


    public function handleOpenFormRejection($id)
    {
        $this->selectedRecipeId = $id;
        $this->showFormRejection = true;
    }

    public function handleCloseFormRejection()
    {
        $this->selectedRecipeId = null;
        $this->showFormRejection = false;
    }

    public function handleRejectRecipe()
    {
        $this->validate([
            'reason' => 'required|string|max:255',
        ]);

        $recipe = Recipe::find($this->selectedRecipeId);
        if (!$recipe) {
            Toaster::error('Resep tidak ditemukan');
            return;
        }

        // update moderation status to rejected
        $recipe->moderation()->update([
            'approver_id' => auth()->user()->id,
            'status' => 'rejected',
            'notes' => $this->reason,
        ]);

        // close the modal and show success toaster alert
        $this->handleCloseFormRejection();
        Toaster::success('Penolakan resep berhasil dilakukan');
    }

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

    public function handleApproveRecipe($id)
    {
        $recipe = Recipe::find($id);
        if (!$recipe) {
            Toaster::error('Resep tidak ditemukan');
            return;
        }

        $recipe->moderation()->update([
            'approver_id' => auth()->user()->id,
            'status' => 'approved',
            'notes' => null,
        ]);

        Toaster::success('Resep berhasil disetujui');
    }

    public function updatedStatus()
    {
        $this->resetPage();
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $recipes = Recipe::query()
            ->where('name', 'like', '%' . $this->search . '%')
            ->when($this->status === 'all', function ($query) {
                $query->has('moderation');
            })
            ->when($this->status !== 'all', function ($query) {
                $query->whereHas('moderation', function ($query) {
                    $query->where('status', $this->status);
                });
            })
            ->with('moderation')
            ->latest()
            ->paginate(10);

        return view('livewire.admin.moderation-recipe', [
            'recipes' => $recipes,
        ]);
    }
}
