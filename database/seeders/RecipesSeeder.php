<?php

namespace Database\Seeders;

use App\Models\Recipe;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RecipesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $nasiGoreng = Recipe::create([
            'name' => 'Nasi Goreng Spesial',
            'description' => 'Nasi goreng dengan telur dan sayuran.',
            'cooking_time' => 20,
            'difficulty' => 'medium',
            'servings' => 1
        ]);

        // attach ingredients
        $nasiGoreng->ingredients()->attach([
            1 => ['amount' => '3', 'unit' => 'siung'], // Bawang Merah
            2 => ['amount' => '2', 'unit' => 'siung'], // Bawang Putih
            3 => ['amount' => '1', 'unit' => 'butir'], // Telur
            4 => ['amount' => '2 1/2', 'unit' => 'piring'], // Nasi Putih
        ]);

        // create steps
        $nasiGoreng->steps()->createMany([
            ['step_number' => 1, 'description' => 'Siapkan bahan-bahan'],
            ['step_number' => 2, 'description' => 'Tumis bumbu hingga harum'],
            ['step_number' => 3, 'description' => 'Goreng telur bersama dengan bumbu'],
            ['step_number' => 4, 'description' => 'Masukkan sayur-sayuran (opsional)'],
            ['step_number' => 5, 'description' => 'Masukkan nasi'],
            ['step_number' => 6, 'description' => 'Berikan penyedap rasa secukupnya'],
            ['step_number' => 7, 'description' => 'Masak hingga nasi goreng terlihat sudah matang'],
            ['step_number' => 8, 'description' => 'Sajikan ke dalam piring saji'],
        ]);
    }
}
