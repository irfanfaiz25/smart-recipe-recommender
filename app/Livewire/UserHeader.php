<?php

namespace App\Livewire;

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
                    'route' => 'savoryai.index'
                ],
                [
                    'name' => 'My Recipes',
                    'route' => 'savoryai.index'
                ]
            ]
        ],
        [
            'name' => 'Bookmarks',
            'route' => 'savoryai.index',
            'request' => 'bookmarks*'
        ],
    ];

    // public function mount()
    // {
    //     request()->is('user-management') ? $this->isSetting = true : $this->isSetting = false;
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
