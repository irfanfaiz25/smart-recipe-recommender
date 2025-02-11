<?php

namespace Database\Seeders;

use App\Models\Ingredient;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IngredientsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ingredients = [
            ['name' => 'Bawang Merah', 'category' => 'Bumbu'],
            ['name' => 'Bawang Putih', 'category' => 'Bumbu'],
            ['name' => 'Telur', 'category' => 'Protein'],
            ['name' => 'Nasi Putih', 'category' => 'Karbohidrat'],
        ];

        foreach ($ingredients as $ingredient) {
            Ingredient::create($ingredient);
        }
    }
}
