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
            'name' => 'Beranda',
            'route' => 'home.index',
            'request' => '/'
        ],
        [
            'name' => 'Resep Masakan',
            'route' => 'recipes.index',
            'request' => 'recipes*',
            'dropdown' => [
                [
                    'name' => 'Rekomendasi Cerdas',
                    'route' => 'savoryai.index',
                    'request' => 'savoryai*',
                ],
                [
                    'name' => 'Jelajahi Resep',
                    'route' => 'explore-recipes.index',
                    'request' => 'explore*',
                ]
            ]
        ],
        [
            'name' => 'Creators',
            'route' => 'creators.index',
            'request' => 'creators*'
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
