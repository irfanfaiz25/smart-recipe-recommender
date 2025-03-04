<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UserHeader extends Component
{
    public $isProfileButtonVisible;
    public $isSetting = false;

    public $menus = [
        [
            'name' => 'Home',
            'route' => 'home.index',
            'request' => '/'
        ],
        [
            'name' => 'SavoryAI',
            'route' => 'savoryai.index',
            'request' => 'savoryai*',
            'dropdown' => [
                [
                    'name' => 'Smart Recommender',
                    'route' => 'savoryai.index',
                    'request' => 'savoryai*',
                ],
                [
                    'name' => 'Recipes',
                    'route' => 'ingredients.index',
                    'request' => 'ingredients*',
                ]
            ]
        ],
        [
            'name' => 'Creators',
            'route' => 'savoryai.index',
            'request' => 'bookmarks*'
        ],
    ];

    // public function mount()
    // {
    //     // request()->is('user-management') ? $this->isSetting = true : $this->isSetting = false;
    //     $this->totalBookmarks = Auth::user()->bookmarkedRecipes()->count();
    // }

    public function profileToggle()
    {
        $this->isProfileButtonVisible = !$this->isProfileButtonVisible;
    }

    public function render()
    {
        return view('livewire.user.user-header');
    }
}
