<?php

namespace App\Livewire;

use App\Models\Suggestion;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;
use Masmerise\Toaster\Toaster;

class SuggestionManagement extends Component
{
    use WithPagination;

    // Search and filter properties
    public $search = '';
    public $statusFilter = '';
    public $feedbackTypeFilter = '';
    public $priorityFilter = '';
    public $sortBy = 'created_at';
    public $sortDirection = 'desc';

    // Modal properties
    public $showDetailModal = false;
    public $selectedSuggestion = null;
    public $adminNotes = '';
    public $newStatus = '';

    // Statistics properties
    public $totalSuggestions;
    public $pendingSuggestions;
    public $reviewedSuggestions;
    public $implementedSuggestions;
    public $rejectedSuggestions;
    public $averageRating;

    protected $queryString = [
        'search' => ['except' => ''],
        'statusFilter' => ['except' => ''],
        'feedbackTypeFilter' => ['except' => ''],
        'priorityFilter' => ['except' => ''],
        'sortBy' => ['except' => 'created_at'],
        'sortDirection' => ['except' => 'desc'],
    ];

    public function mount()
    {
        $this->loadStatistics();
    }

    public function loadStatistics()
    {
        $this->totalSuggestions = Suggestion::count();
        $this->pendingSuggestions = Suggestion::where('status', 'pending')->count();
        $this->reviewedSuggestions = Suggestion::where('status', 'reviewed')->count();
        $this->implementedSuggestions = Suggestion::where('status', 'implemented')->count();
        $this->rejectedSuggestions = Suggestion::where('status', 'rejected')->count();
        $this->averageRating = Suggestion::avg('rating') ?? 0;
    }

    #[Computed]
    public function suggestions()
    {
        $query = Suggestion::with('user')
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('subject', 'like', '%' . $this->search . '%')
                        ->orWhere('feedback_message', 'like', '%' . $this->search . '%')
                        ->orWhere('name', 'like', '%' . $this->search . '%')
                        ->orWhere('email', 'like', '%' . $this->search . '%')
                        ->orWhereHas('user', function ($userQuery) {
                            $userQuery->where('name', 'like', '%' . $this->search . '%')
                                ->orWhere('email', 'like', '%' . $this->search . '%');
                        });
                });
            })
            ->when($this->statusFilter, function ($query) {
                $query->where('status', $this->statusFilter);
            })
            ->when($this->feedbackTypeFilter, function ($query) {
                $query->where('feedback_type', $this->feedbackTypeFilter);
            })
            ->when($this->priorityFilter, function ($query) {
                $query->where('priority', $this->priorityFilter);
            })
            ->orderBy($this->sortBy, $this->sortDirection);

        return $query->paginate(10);
    }

    #[Computed]
    public function feedbackTypes()
    {
        return Suggestion::select('feedback_type')
            ->distinct()
            ->pluck('feedback_type')
            ->filter()
            ->sort()
            ->values();
    }

    public function sortBy($field)
    {
        if ($this->sortBy === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $field;
            $this->sortDirection = 'asc';
        }
        $this->resetPage();
    }

    public function showDetail($suggestionId)
    {
        $this->selectedSuggestion = Suggestion::with('user')->find($suggestionId);
        $this->adminNotes = $this->selectedSuggestion->admin_notes ?? '';
        $this->newStatus = $this->selectedSuggestion->status;
        $this->showDetailModal = true;
    }

    public function updateSuggestion()
    {
        $this->validate([
            'newStatus' => 'required|in:pending,reviewed,implemented,rejected',
            'adminNotes' => 'nullable|string|max:1000',
        ]);

        $this->selectedSuggestion->update([
            'status' => $this->newStatus,
            'admin_notes' => $this->adminNotes,
        ]);

        $this->showDetailModal = false;
        $this->loadStatistics();

        Toaster::success('Suggestion updated successfully!');
    }

    public function closeModal()
    {
        $this->showDetailModal = false;
        $this->selectedSuggestion = null;
        $this->adminNotes = '';
        $this->newStatus = '';
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedStatusFilter()
    {
        $this->resetPage();
    }

    public function updatedFeedbackTypeFilter()
    {
        $this->resetPage();
    }

    public function updatedPriorityFilter()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.admin.suggestion-management');
    }
}
