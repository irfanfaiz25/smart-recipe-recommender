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
            ['name' => 'Ayam', 'category' => 'protein'],
            ['name' => 'Daging Sapi', 'category' => 'protein'],
            ['name' => 'Ikan', 'category' => 'protein'],
            ['name' => 'Tahu', 'category' => 'protein'],
            ['name' => 'Tempe', 'category' => 'protein'],
            ['name' => 'Wortel', 'category' => 'sayuran'],
            ['name' => 'Brokoli', 'category' => 'sayuran'],
            ['name' => 'Bayam', 'category' => 'sayuran'],
            ['name' => 'Kangkung', 'category' => 'sayuran'],
            ['name' => 'Kentang', 'category' => 'karbohidrat'],
            ['name' => 'Jagung', 'category' => 'karbohidrat'],
            ['name' => 'Mie', 'category' => 'karbohidrat'],
            ['name' => 'Roti', 'category' => 'karbohidrat'],
            ['name' => 'Gula', 'category' => 'bumbu'],
            ['name' => 'Garam', 'category' => 'bumbu'],
            ['name' => 'Merica', 'category' => 'bumbu'],
            ['name' => 'Kecap', 'category' => 'bumbu'],
            ['name' => 'Saus Tomat', 'category' => 'bumbu'],
            ['name' => 'Saus Tiram', 'category' => 'bumbu'],
            ['name' => 'Minyak Goreng', 'category' => 'bumbu'],
            ['name' => 'Mentega', 'category' => 'bumbu'],
            ['name' => 'Cabai Merah', 'category' => 'bumbu'],
            ['name' => 'Cabai Hijau', 'category' => 'bumbu'],
            ['name' => 'Jahe', 'category' => 'bumbu'],
            ['name' => 'Kunyit', 'category' => 'bumbu'],
            ['name' => 'Lengkuas', 'category' => 'bumbu'],
            ['name' => 'Daun Salam', 'category' => 'bumbu'],
            ['name' => 'Serai', 'category' => 'bumbu'],
            ['name' => 'Ketumbar', 'category' => 'bumbu'],
            ['name' => 'Jintan', 'category' => 'bumbu'],
            ['name' => 'Kayu Manis', 'category' => 'bumbu'],
            ['name' => 'Pala', 'category' => 'bumbu'],
            ['name' => 'Cengkeh', 'category' => 'bumbu'],
            ['name' => 'Susu', 'category' => 'produk susu'],
            ['name' => 'Keju', 'category' => 'produk susu'],
            ['name' => 'Yogurt', 'category' => 'produk susu'],
            ['name' => 'Tomat', 'category' => 'sayuran'],
            ['name' => 'Timun', 'category' => 'sayuran'],
            ['name' => 'Paprika', 'category' => 'sayuran'],
            ['name' => 'Terong', 'category' => 'sayuran'],
            ['name' => 'Labu', 'category' => 'sayuran'],
            ['name' => 'Jamur', 'category' => 'sayuran'],
            ['name' => 'Kacang Panjang', 'category' => 'sayuran'],
            ['name' => 'Kacang Merah', 'category' => 'protein'],
            ['name' => 'Kacang Hijau', 'category' => 'protein'],
            ['name' => 'Udang', 'category' => 'protein'],
        ];

        foreach ($ingredients as $ingredient) {
            Ingredient::create($ingredient);
        }
    }
}
