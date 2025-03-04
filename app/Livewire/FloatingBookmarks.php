<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class FloatingBookmarks extends Component
{
    public $totalBookmarks;

    public function mount()
    {
        $this->totalBookmarks = Auth::user()->bookmarkedRecipes()->count();
    }

    #[On('updated-bookmarks')]
    public function updateTotalBookmarks()
    {
        $this->totalBookmarks = Auth::user()->bookmarkedRecipes()->count();
    }

    public function render()
    {
        return view('livewire.user.floating-bookmarks');
    }
}
