<?php

namespace App\Livewire;

use App\Models\CookingHistory;
use Livewire\Component;
use Livewire\WithPagination;
use Masmerise\Toaster\Toaster;

class CookingHistoryList extends Component
{
    use WithPagination;

    public $search = '';
    public $sortBy = 'latest';
    public $filterBy = 'all'; // all, today, week, month

    protected $queryString = [
        'search' => ['except' => ''],
        'sortBy' => ['except' => 'latest'],
        'filterBy' => ['except' => 'all']
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingFilterBy()
    {
        $this->resetPage();
    }

    public function updatingSortBy()
    {
        $this->resetPage();
    }

    public function removeFromHistory($historyId)
    {
        $history = CookingHistory::where('id', $historyId)
            ->where('user_id', auth()->id())
            ->first();

        if ($history) {
            $history->delete();
            Toaster::success('Riwayat berhasil dihapus');
        } else {
            Toaster::error('Riwayat tidak ditemukan');
        }
    }

    public function render()
    {
        $query = CookingHistory::with(['recipe.category', 'recipe.user'])
            ->where('user_id', auth()->id());

        // Search filter
        if ($this->search) {
            $query->whereHas('recipe', function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%');
            });
        }

        // Date filter
        switch ($this->filterBy) {
            case 'today':
                $query->whereDate('cooked_at', today());
                break;
            case 'week':
                $query->whereBetween('cooked_at', [now()->startOfWeek(), now()->endOfWeek()]);
                break;
            case 'month':
                $query->whereMonth('cooked_at', now()->month)
                    ->whereYear('cooked_at', now()->year);
                break;
        }

        // Sort
        switch ($this->sortBy) {
            case 'latest':
                $query->orderBy('cooked_at', 'desc');
                break;
            case 'oldest':
                $query->orderBy('cooked_at', 'asc');
                break;
            case 'recipe_name':
                $query->join('recipes', 'cooking_histories.recipe_id', '=', 'recipes.id')
                    ->orderBy('recipes.name', 'asc')
                    ->select('cooking_histories.*');
                break;
        }

        $histories = $query->paginate(12);
        $totalCount = CookingHistory::where('user_id', auth()->id())->count();

        return view('livewire.cooking-history-list', [
            'histories' => $histories,
            'totalCount' => $totalCount
        ]);
    }
}
