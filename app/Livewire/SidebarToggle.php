<?php

namespace App\Livewire;

use Livewire\Component;

class SidebarToggle extends Component
{
    public $isSidebarVisible = false;
    public $sidebarMenu = [
        [
            'name' => 'Dashboard',
            'route' => 'dashboard.index',
            'icon' => 'fa-solid fa-house',
            'request' => 'admin/dashboard*'
        ],
        [
            'name' => 'Ingredient',
            'route' => 'ingredients.index',
            'icon' => 'fa-solid fa-wheat-awn',
            'request' => 'admin/ingredients*'
        ],
        [
            'name' => 'Resep',
            'route' => 'recipes.index',
            'icon' => 'fa-solid fa-utensils',
            'request' => 'admin/recipes*'
        ],
    ];

    public function toggleSidebar()
    {
        $this->isSidebarVisible = !$this->isSidebarVisible;
    }

    public function render()
    {
        return view('livewire.sidebar-toggle');
    }
}
