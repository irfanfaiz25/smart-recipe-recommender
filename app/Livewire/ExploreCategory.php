<?php

namespace App\Livewire;

use App\Models\Recipe;
use App\Models\RecipeCategory;
use App\Models\Ingredient;
use Livewire\Component;
use Livewire\WithPagination;
use Masmerise\Toaster\Toaster;

class ExploreCategory extends Component
{
    use WithPagination;

    public $filterType; // 'category', 'ingredient', 'cooking_time'
    public $filterValue;
    public $filterName;
    public $sortBy = 'trending';
    public $searchTerm = '';
    public $perPage = 12;
    public $ingredientName;


    protected $queryString = [
        'filterType' => ['except' => ''],
        'filterValue' => ['except' => ''],
        'sortBy' => ['except' => 'trending'],
        'searchTerm' => ['except' => '']
    ];

    public function mount($type = null, $value = null, $name = null)
    {
        $this->filterType = $type;
        $this->filterValue = $value;
        $this->filterName = $name ?? $this->getFilterDisplayName();
    }

    public function updatedSearchTerm()
    {
        $this->resetPage();
    }

    public function updatedSortBy()
    {
        $this->resetPage();
    }

    public function loadMore()
    {
        $this->perPage += 12;
    }

    public function toggleBookmark($recipeId)
    {
        $recipe = Recipe::approved()->find($recipeId);
        $user = auth()->user();

        if ($recipe->bookmarkedBy->contains($user)) {
            $recipe->bookmarkedBy()->detach($user);
            Toaster::success('Resep berhasil dihapus dari daftar favorit');
        } else {
            $recipe->bookmarkedBy()->attach($user);
            Toaster::success('Resep berhasil ditambahkan ke daftar favorit');
        }

        $this->dispatch('updated-bookmarks');
    }

    public function getFilterDisplayName()
    {
        if (!$this->filterType || !$this->filterValue) {
            return 'Semua Resep';
        }

        return match ($this->filterType) {
            'category' => $this->filterValue == '3' ? 'Cemilan Manis' : 'Menu Utama',
            'ingredient' => '#' . str_replace(['#', ' '], '', $this->filterValue),
            'cooking_time' => '#' . $this->filterValue,
            default => 'Semua Resep'
        };
    }

    public function getFilteredRecipes()
    {
        $query = Recipe::approved()
            ->with(['user', 'category', 'ingredients'])
            ->withCount(['bookmarkedBy', 'ratings'])
            ->withAvg('ratings', 'rating');

        // Apply filters based on type
        if ($this->filterType && $this->filterValue) {
            switch ($this->filterType) {
                case 'category':
                    $query->whereHas('category', fn($q) => $q->where('id', $this->filterValue));
                    break;
                case 'ingredient':
                    $query->whereHas('ingredients', function ($q) {
                        $q->where('ingredient_id', $this->filterValue)
                            ->where('is_primary', true);
                    });

                    $this->ingredientName = Ingredient::find($this->filterValue)->name; // Set ingredientName sesuai dengan ID yang ditemukan
                    break;
                case 'cooking_time':
                    $timeRanges = [
                        'QuickMeals' => [0, 15],
                        '30MinuteMeals' => [16, 30],
                        'HourlyMeals' => [31, 60],
                        'SlowCooking' => [61, 999]
                    ];
                    if (isset($timeRanges[$this->filterValue])) {
                        [$min, $max] = $timeRanges[$this->filterValue];
                        $query->whereBetween('cooking_time', [$min, $max]);
                    }
                    break;
            }
        }

        // Apply search
        if ($this->searchTerm) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('description', 'like', '%' . $this->searchTerm . '%')
                    ->orWhereHas(
                        'ingredients',
                        fn($subQ) =>
                        $subQ->where('name', 'like', '%' . $this->searchTerm . '%')
                    );
            });
        }

        // Apply sorting
        switch ($this->sortBy) {
            case 'trending':
                $query->orderByRaw('(views_count * 0.5) + (bookmarked_by_count * 0.3) + (ratings_count * 0.2) DESC');
                break;
            case 'newest':
                $query->orderBy('created_at', 'desc');
                break;
            case 'rating':
                $query->orderBy('ratings_avg_rating', 'desc');
                break;
            case 'views':
                $query->orderBy('views_count', 'desc');
                break;
            case 'bookmarks':
                $query->orderBy('bookmarked_by_count', 'desc');
                break;
        }

        return $query->paginate($this->perPage);
    }

    public function getFilterIcon()
    {
        return match ($this->filterType) {
            'category' => $this->filterValue == '3' ? '🍰' : '🍖',
            'ingredient' => '🥘',
            'cooking_time' => '⏱️',
            default => '🍽️'
        };
    }

    public function getFilterColor()
    {
        return match ($this->filterType) {
            'category' => $this->filterValue == '3' ? 'from-pink-500 to-rose-500' : ($this->filterValue == '2' ? 'from-red-500 to-orange-500' : 'from-blue-500 to-cyan-500'),
            'ingredient' => 'from-green-500 to-emerald-500',
            'cooking_time' => 'from-blue-500 to-cyan-500',
            default => 'from-purple-500 to-violet-500'
        };
    }

    public function render()
    {
        $recipes = $this->getFilteredRecipes();

        return view('livewire.user.explore.explore-category', [
            'recipes' => $recipes
        ]);
    }
}
