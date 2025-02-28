<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
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

    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        $this->redirectRoute('home.index', navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.header-layout');
    }
}
