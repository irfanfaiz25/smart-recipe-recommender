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
            'link' => '/'
        ],
        [
            'name' => 'SavoryAI',
            'link' => '/savoryai'
        ],
        [
            'name' => 'Bookmarks',
            'link' => '/bookmarks'
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
