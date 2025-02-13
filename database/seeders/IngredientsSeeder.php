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
            ['name' => 'Bawang Merah', 'category' => 'bumbu'],
            ['name' => 'Bawang Putih', 'category' => 'bumbu'],
            ['name' => 'Telur', 'category' => 'protein'],
            ['name' => 'Nasi Putih', 'category' => 'karbohidrat'],
        ];

        foreach ($ingredients as $ingredient) {
            Ingredient::create($ingredient);
        }
    }
}
