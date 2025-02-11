<?php

namespace App\Livewire;

use Livewire\Component;

class HeaderLayout extends Component
{
    public $isProfileButtonVisible;
    public $isSetting = false;


    // public function mount()
    // {
    //     request()->is('user-management') ? $this->isSetting = true : $this->isSetting = false;
    // }

    public function profileToggle()
    {
        $this->isProfileButtonVisible = !$this->isProfileButtonVisible;
    }

    // public function logout()
    // {
    //     Auth::logout();

    //     return redirect(route('login'));
    // }

    public function render()
    {
        return view('livewire.header-layout');
    }
}
