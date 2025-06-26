<?php

namespace App\Livewire;

use App\Models\Recipe;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class ModerationRecipeDetail extends Component
{
    public $showFormRejection = false;
    public $selectedRecipeId;
    public $reason = '';

    public $showDetailRejection = false;
    public $rejectedRecipe;

    public $recipe;

    public function mount($recipeId)
    {
        $this->recipe = Recipe::with(['ingredients', 'moderation', 'user', 'steps', 'category'])->findOrFail($recipeId);
    }

    public function handleOpenFormRejection()
    {
        $this->selectedRecipeId = $this->recipe->id;
        $this->showFormRejection = true;
    }

    public function handleCloseFormRejection()
    {
        $this->reason = '';
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

    public function handleOpenDetailRejection()
    {
        $recipe = Recipe::with([
            'moderation' => function ($moderation) {
                $moderation->with('approver');
            }
        ])->find($this->recipe->id);
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

    public function handleApproveRecipe()
    {
        $recipe = Recipe::find($this->recipe->id);
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

    public function render()
    {
        return view('livewire.admin.moderation-recipe-detail');
    }
}
