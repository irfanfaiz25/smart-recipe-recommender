<?php

namespace App\Livewire;

use App\Models\Recipe;
use Livewire\Component;
use Livewire\WithPagination;

class ExploreList extends Component
{
    use WithPagination;

    // Properties for filtering and pagination
    public $search = '';
    public $category = '';
    public $sortBy = 'latest';
    public $perPage = 12;
    public $loadMore = false;

    // Category ID mapping for cleaner code
    private const CATEGORY_MAPPING = [
        'utama' => 2,
        'dessert' => 3,
    ];

    protected $queryString = [
        'search' => ['except' => ''],
        'category' => ['except' => ''],
        'sortBy' => ['except' => 'latest'],
    ];

    public function updatedSearch()
    {
        $this->resetPage();
        $this->perPage = 12; // Reset per page when searching
    }

    public function updatedSortBy()
    {
        $this->resetPage();
        $this->perPage = 12; // Reset per page when sorting
    }

    public function setCategory($category)
    {
        $this->category = $category;
        $this->resetPage();
        $this->perPage = 12; // Reset per page when filtering
    }

    public function clearCategory()
    {
        $this->category = '';
        $this->resetPage();
        $this->perPage = 12; // Reset per page when clearing filter
    }

    public function loadMoreRecipes()
    {
        $this->perPage += 12; // Load 12 more recipes
    }

    public function render()
    {
        $query = Recipe::approved()
            ->with(['category', 'user', 'ratings'])
            ->withCount(['bookmarkedBy', 'ratings'])
            ->withAvg('ratings', 'rating');

        // Apply search filter
        if ($this->search) {
            $query->where('name', 'like', '%' . trim($this->search) . '%');
        }

        // Apply category filter
        if (isset(self::CATEGORY_MAPPING[$this->category])) {
            $query->where('category_id', self::CATEGORY_MAPPING[$this->category]);
        } elseif ($this->category === 'diet') {
            $query->whereBetween('calories', [0, 400]);
        }

        // Apply sorting
        if ($this->sortBy === 'popular') {
            $query->orderByRaw('(views_count * 0.5) + (bookmarked_by_count * 0.3) + (ratings_count * 0.2) DESC');
        } elseif ($this->sortBy === 'rating') {
            $query->orderBy('ratings_avg_rating', 'desc');
        } elseif ($this->sortBy === 'fastest') {
            $query->orderBy('cooking_time', 'asc');
        } else {
            $query->latest();
        }

        $recipes = $query->paginate($this->perPage);

        return view('livewire.user.explore.explore-list', compact('recipes'));
    }
}
