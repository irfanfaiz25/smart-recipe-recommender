<?php

namespace Database\Seeders;

use App\Models\RecipeCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RecipeCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RecipeCategory::create([
            'name' => 'hidangan pembuka (appetizer)',
            'description' => 'Makanan pembuka yang disajikan dalam porsi kecil untuk merangsang nafsu makan.'
        ]);

        RecipeCategory::create([
            'name' => 'hidangan utama (main course)',
            'description' => 'Hidangan pokok dari suatu susunan menu lengkap yang dihidangkan pada waktu lunch atau dinner.'
        ]);

        RecipeCategory::create([
            'name' => 'hidangan penutup (dessert)',
            'description' => 'Hidangan penutup yang disajikan setelah hidangan utama untuk menyegarkan dan menghilangkan rasa amis dari hidangan utama.'
        ]);
    }
}
