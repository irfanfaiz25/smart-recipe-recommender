<?php

namespace App\Livewire;

use Livewire\Component;

class SidebarToggle extends Component
{
    public $isSidebarVisible = false;
    public $sidebarMenu = [];

    public function mount()
    {

        if (auth()->user()->hasRole('admin')) {
            $this->sidebarMenu = [
                [
                    'name' => 'Dashboard',
                    'route' => 'admin-dashboard.index',
                    'icon' => 'fa-solid fa-house',
                    'request' => 'admin/dashboard*'
                ],
                [
                    'name' => 'Ingredient',
                    'route' => 'admin-ingredients.index',
                    'icon' => 'fa-solid fa-wheat-awn',
                    'request' => 'admin/ingredients*'
                ],
                [
                    'name' => 'Resep',
                    'route' => 'admin-recipes.index',
                    'icon' => 'fa-solid fa-utensils',
                    'request' => 'admin/recipes*'
                ],
            ];
        } else {
            $this->sidebarMenu = [
                [
                    'name' => 'Dashboard',
                    'route' => 'dashboard.index',
                    'icon' => 'fa-solid fa-house',
                    'request' => 'creators/dashboard*'
                ],
                [
                    'name' => 'Resep',
                    'route' => 'recipes.index',
                    'icon' => 'fa-solid fa-utensils',
                    'request' => 'creators/recipes*'
                ],
            ];
        }
    }

    public function toggleSidebar()
    {
        $this->isSidebarVisible = !$this->isSidebarVisible;
    }

    public function render()
    {
        return view('livewire.admin.sidebar-toggle');
    }
}
