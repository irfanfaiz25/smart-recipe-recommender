<?php

namespace App\Livewire;

use App\Models\Recipe;
use Livewire\Component;

class HomeSection extends Component
{
    public $categories;
    public $popularRecipes;
    public $colors = [
        'orange' => [
            'from' => 'from-orange-400',
            'to' => 'to-amber-500',
            'text' => 'text-orange-600',
            'bg_light' => 'bg-orange-50',
        ],
        'green' => [
            'from' => 'from-green-400',
            'to' => 'to-emerald-500',
            'text' => 'text-green-600',
            'bg_light' => 'bg-green-50',
        ],
        'red' => [
            'from' => 'from-red-400',
            'to' => 'to-rose-500',
            'text' => 'text-red-600',
            'bg_light' => 'bg-red-50',
        ],
    ];

    public function mount()
    {
        $this->categories = [
            [
                'name' => 'Camilan & Pembuka',
                'desc' => 'Gigitan ringan penuh cita rasa.',
                'icon' => 'fas fa-pepper-hot',
                'color_from' => 'from-green-400',
                'color_to' => 'to-emerald-500',
                'recipes' => Recipe::where('category_id', 1)->count() . '+',
                'delay' => '500',
            ],
            [
                'name' => 'Makanan Utama',
                'desc' => 'Hidangan lezat untuk setiap hari.',
                'icon' => 'fas fa-drumstick-bite',
                'color_from' => 'from-orange-400',
                'color_to' => 'to-red-500',
                'recipes' => Recipe::where('category_id', 2)->count() . '+',
                'delay' => '700',
            ],
            [
                'name' => 'Makanan Penutup',
                'desc' => 'Maniskan harimu dengan dessert.',
                'icon' => 'fas fa-ice-cream',
                'color_from' => 'from-purple-400',
                'color_to' => 'to-pink-500',
                'recipes' => Recipe::where('category_id', 3)->count() . '+',
                'delay' => '900',
            ],
        ];

        $this->popularRecipes = Recipe::select('id', 'name', 'image', 'description', 'cooking_time', 'difficulty')
            ->withAvg('ratings', 'rating')
            ->orderBy('ratings_avg_rating', 'desc')
            ->orderBy('views_count', 'desc')
            ->take(3)
            ->get()
            ->map(function ($recipe, $index) {
                $icons = ['fas fa-bowl-rice', 'fas fa-carrot', 'fas fa-drumstick-bite'];
                $colors = ['orange', 'green', 'red'];
                $delays = ['500', '700', '900'];

                return [
                    'id' => $recipe->id,
                    'name' => $recipe->name,
                    'image' => $recipe->image,
                    'desc' => $recipe->description,
                    'time' => $recipe->cooking_time . ' min',
                    'level' => $recipe->difficulty,
                    'rating' => number_format($recipe->ratings_avg_rating, 1),
                    'icon' => $icons[$index],
                    'color' => $colors[$index],
                    'delay' => $delays[$index]
                ];
            })
            ->toArray();
    }

    public function render()
    {
        return view('livewire.user.home-section');
    }
}
