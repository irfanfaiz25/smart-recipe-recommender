<?php

namespace App\Livewire;

use App\Models\Rating;
use App\Models\User;
use App\Models\Recipe;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;
use Masmerise\Toaster\Toaster;
use Spatie\Permission\Models\Role;

class UserManagement extends Component
{
    use WithPagination;

    // Search and filter properties
    public $search = '';
    public $roleFilter = '';
    public $sortBy = 'created_at';
    public $sortDirection = 'desc';

    // Modal properties
    public $showUserModal = false;
    public $editingUser = null;
    public $selectedUserId = null;

    // Statistics properties
    public $totalUsers;
    public $activeUsers;
    public $newUsersThisMonth;
    public $totalCreators;
    public $totalRecipes;

    protected $queryString = [
        'search' => ['except' => ''],
        'roleFilter' => ['except' => ''],
        'sortBy' => ['except' => 'created_at'],
        'sortDirection' => ['except' => 'desc'],
    ];

    public function mount()
    {
        $this->loadStatistics();
    }

    public function loadStatistics()
    {
        $this->totalUsers = User::count();
        $this->activeUsers = User::where('last_login_at', '>=', now()->subDays(30))->count();
        $this->newUsersThisMonth = User::where('created_at', '>=', now()->startOfMonth())->count();
        $this->totalCreators = User::whereHas('creators')->count();
        $this->totalRecipes = Recipe::count();
    }

    #[Computed]
    public function users()
    {
        return User::query()
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('email', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->roleFilter, function ($query) {
                $query->whereHas('roles', function ($q) {
                    $q->where('name', $this->roleFilter);
                });
            })
            ->with(['roles', 'creators', 'recipes'])
            ->withCount(['recipes', 'bookmarkedRecipes'])
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate(10);
    }

    #[Computed]
    public function roles()
    {
        return Role::all();
    }

    public function sortBy($field)
    {
        dd($field);
        if ($this->sortBy === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $field;
            $this->sortDirection = 'asc';
        }
        $this->resetPage();
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedRoleFilter()
    {
        $this->resetPage();
    }

    public function viewUser($userId)
    {
        $this->selectedUserId = $userId;
        $user = User::with(['roles', 'creators', 'recipes', 'bookmarkedRecipes'])
            ->withCount(['recipes', 'bookmarkedRecipes', 'ratings'])
            ->withSum('recipes', 'views_count')
            ->find($userId);

        if ($user->creators) {
            // Get average ratings for all recipes if user is a creator
            $user->recipes_avg_rating = Recipe::where('user_id', $userId)
                ->withAvg('ratings', 'rating')
                ->get()
                ->avg('ratings_avg_rating');
        }

        $this->editingUser = $user;
        $this->showUserModal = true;
    }

    public function closeModal()
    {
        $this->showUserModal = false;
        $this->editingUser = null;
        $this->selectedUserId = null;
    }

    public function deleteUser($userId)
    {
        $user = User::find($userId);
        if ($user) {
            $user->delete();
            Toaster::success('Data user berhasil dihapus.');
            $this->loadStatistics();
            return;
        }

        Toaster::error('Data user tidak ditemukan.');
    }

    public function render()
    {
        return view('livewire.admin.user-management');
    }
}