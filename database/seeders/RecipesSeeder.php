<?php

namespace Database\Seeders;

use App\Models\Recipe;
use Illuminate\Database\Seeder;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class RecipesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define the path to your local images
        $imagePath = '/Users/macbookm1/Documents/IMAGE/SKRIPSI';

        $nasiGorengImage = Storage::disk('public')->putFile('img/recipes', new UploadedFile(
            $imagePath . '/nasi goreng.jpg',
            'nasi_goreng.jpg'
        ));

        $ayamGorengImage = Storage::disk('public')->putFile('img/recipes', new UploadedFile(
            $imagePath . '/ayam goreng.jpg',
            'ayam_goreng.jpg'
        ));

        $sotoAyamImage = Storage::disk('public')->putFile('img/recipes', new UploadedFile(
            $imagePath . '/soto ayam.jpg',
            'soto_ayam.jpg'
        ));

        $rendangDagingImage = Storage::disk('public')->putFile('img/recipes', new UploadedFile(
            $imagePath . '/rendang daging.jpg',
            'rendang_daging.jpg'
        ));

        $tumisKangkungImage = Storage::disk('public')->putFile('img/recipes', new UploadedFile(
            $imagePath . '/tumis kangkung.jpg',
            'tumis_kangkung.jpg'
        ));

        $mieGorengImage = Storage::disk('public')->putFile('img/recipes', new UploadedFile(
            $imagePath . '/mie goreng.jpg',
            'mie_goreng.jpg'
        ));

        $capcayImage = Storage::disk('public')->putFile('img/recipes', new UploadedFile(
            $imagePath . '/capcay.jpg',
            'capcay.jpg'
        ));

        $baksoImage = Storage::disk('public')->putFile('img/recipes', new UploadedFile(
            $imagePath . '/bakso.jpg',
            'bakso.jpg'
        ));

        $sateAyamImage = Storage::disk('public')->putFile('img/recipes', new UploadedFile(
            $imagePath . '/sate ayam.jpeg',
            'sate_ayam.jpeg'
        ));

        $gadogadoImage = Storage::disk('public')->putFile('img/recipes', new UploadedFile(
            $imagePath . '/gado gado.jpg',
            'gado_gado.jpg'
        ));

        // Recipe 1: Nasi Goreng Spesial
        $nasiGoreng = Recipe::create([
            'name' => 'Nasi Goreng Spesial',
            'description' => 'Nasi goreng dengan telur dan sayuran.',
            'cooking_time' => 20,
            'difficulty' => 'sedang',
            'servings' => 1,
            'image' => Storage::url($nasiGorengImage)
        ]);

        $nasiGoreng->ingredients()->attach([
            1 => ['amount' => '3', 'unit' => 'siung'], // Bawang Merah
            2 => ['amount' => '2', 'unit' => 'siung'], // Bawang Putih
            3 => ['amount' => '1', 'unit' => 'butir'], // Telur
            4 => ['amount' => '2 1/2', 'unit' => 'piring'], // Nasi Putih
        ]);

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

        // Recipe 2: Ayam Goreng
        $ayamGoreng = Recipe::create([
            'name' => 'Ayam Goreng',
            'description' => 'Ayam goreng krispi dengan bumbu rempah.',
            'cooking_time' => 30,
            'difficulty' => 'sedang',
            'servings' => 2,
            'image' => Storage::url($ayamGorengImage)
        ]);

        $ayamGoreng->ingredients()->attach([
            5 => ['amount' => '500', 'unit' => 'gram'], // Ayam
            1 => ['amount' => '4', 'unit' => 'siung'], // Bawang Merah
            2 => ['amount' => '3', 'unit' => 'siung'], // Bawang Putih
            29 => ['amount' => '1', 'unit' => 'ruas'], // Kunyit
            30 => ['amount' => '1', 'unit' => 'ruas'], // Lengkuas
        ]);

        $ayamGoreng->steps()->createMany([
            ['step_number' => 1, 'description' => 'Cuci bersih ayam'],
            ['step_number' => 2, 'description' => 'Haluskan bumbu'],
            ['step_number' => 3, 'description' => 'Lumuri ayam dengan bumbu'],
            ['step_number' => 4, 'description' => 'Goreng ayam hingga matang'],
            ['step_number' => 5, 'description' => 'Sajikan dengan sambal dan nasi'],
        ]);

        // Recipe 3: Soto Ayam
        $sotoAyam = Recipe::create([
            'name' => 'Soto Ayam',
            'description' => 'Soto ayam dengan kuah kuning yang gurih.',
            'cooking_time' => 45,
            'difficulty' => 'sedang',
            'servings' => 4,
            'image' => Storage::url($sotoAyamImage)
        ]);

        $sotoAyam->ingredients()->attach([
            5 => ['amount' => '500', 'unit' => 'gram'], // Ayam
            1 => ['amount' => '5', 'unit' => 'siung'], // Bawang Merah
            2 => ['amount' => '4', 'unit' => 'siung'], // Bawang Putih
            29 => ['amount' => '2', 'unit' => 'ruas'], // Kunyit
            30 => ['amount' => '1', 'unit' => 'ruas'], // Lengkuas
            31 => ['amount' => '2', 'unit' => 'lembar'], // Daun Salam
            32 => ['amount' => '1', 'unit' => 'batang'], // Serai
        ]);

        $sotoAyam->steps()->createMany([
            ['step_number' => 1, 'description' => 'Rebus ayam hingga matang'],
            ['step_number' => 2, 'description' => 'Tumis bumbu halus hingga harum'],
            ['step_number' => 3, 'description' => 'Masukkan bumbu ke dalam rebusan ayam'],
            ['step_number' => 4, 'description' => 'Tambahkan garam dan penyedap rasa'],
            ['step_number' => 5, 'description' => 'Sajikan dengan nasi, soun, dan pelengkap lainnya'],
        ]);

        // Recipe 4: Rendang Daging
        $rendangDaging = Recipe::create([
            'name' => 'Rendang Daging',
            'description' => 'Rendang daging sapi dengan bumbu rempah khas Padang.',
            'cooking_time' => 120,
            'difficulty' => 'rumit',
            'servings' => 6,
            'image' => Storage::url($rendangDagingImage)
        ]);

        $rendangDaging->ingredients()->attach([
            6 => ['amount' => '1', 'unit' => 'kg'], // Daging Sapi
            1 => ['amount' => '10', 'unit' => 'siung'], // Bawang Merah
            2 => ['amount' => '8', 'unit' => 'siung'], // Bawang Putih
            29 => ['amount' => '3', 'unit' => 'ruas'], // Kunyit
            30 => ['amount' => '2', 'unit' => 'ruas'], // Lengkuas
            31 => ['amount' => '3', 'unit' => 'lembar'], // Daun Salam
            32 => ['amount' => '2', 'unit' => 'batang'], // Serai
        ]);

        $rendangDaging->steps()->createMany([
            ['step_number' => 1, 'description' => 'Potong daging sesuai selera'],
            ['step_number' => 2, 'description' => 'Haluskan bumbu'],
            ['step_number' => 3, 'description' => 'Tumis bumbu hingga harum'],
            ['step_number' => 4, 'description' => 'Masukkan daging dan santan'],
            ['step_number' => 5, 'description' => 'Masak dengan api kecil hingga kuah mengental'],
            ['step_number' => 6, 'description' => 'Sajikan dengan nasi hangat'],
        ]);

        // Recipe 5: Tumis Kangkung
        $tumisKangkung = Recipe::create([
            'name' => 'Tumis Kangkung',
            'description' => 'Tumis kangkung dengan bawang putih dan cabai.',
            'cooking_time' => 15,
            'difficulty' => 'mudah',
            'servings' => 2,
            'image' => Storage::url($tumisKangkungImage)
        ]);

        $tumisKangkung->ingredients()->attach([
            13 => ['amount' => '1', 'unit' => 'ikat'], // Kangkung
            2 => ['amount' => '3', 'unit' => 'siung'], // Bawang Putih
            26 => ['amount' => '2', 'unit' => 'buah'], // Cabai Merah
            20 => ['amount' => '1', 'unit' => 'sdt'], // Garam
        ]);

        $tumisKangkung->steps()->createMany([
            ['step_number' => 1, 'description' => 'Cuci bersih kangkung'],
            ['step_number' => 2, 'description' => 'Iris bawang putih dan cabai'],
            ['step_number' => 3, 'description' => 'Tumis bawang putih dan cabai hingga harum'],
            ['step_number' => 4, 'description' => 'Masukkan kangkung dan aduk hingga layu'],
            ['step_number' => 5, 'description' => 'Tambahkan garam dan penyedap rasa'],
            ['step_number' => 6, 'description' => 'Sajikan hangat'],
        ]);

        // Recipe 6: Mie Goreng
        $mieGoreng = Recipe::create([
            'name' => 'Mie Goreng',
            'description' => 'Mie goreng dengan sayuran dan telur.',
            'cooking_time' => 15,
            'difficulty' => 'mudah',
            'servings' => 2,
            'image' => Storage::url($mieGorengImage)
        ]);

        $mieGoreng->ingredients()->attach([
            16 => ['amount' => '200', 'unit' => 'gram'], // Mie
            3 => ['amount' => '2', 'unit' => 'butir'], // Telur
            10 => ['amount' => '1', 'unit' => 'buah'], // Wortel
            12 => ['amount' => '1', 'unit' => 'ikat'], // Bayam
            2 => ['amount' => '3', 'unit' => 'siung'], // Bawang Putih
        ]);

        $mieGoreng->steps()->createMany([
            ['step_number' => 1, 'description' => 'Rebus mie hingga matang'],
            ['step_number' => 2, 'description' => 'Tumis bawang putih hingga harum'],
            ['step_number' => 3, 'description' => 'Masukkan telur dan orak-arik'],
            ['step_number' => 4, 'description' => 'Tambahkan sayuran dan mie'],
            ['step_number' => 5, 'description' => 'Bumbui dengan garam, merica, dan kecap'],
            ['step_number' => 6, 'description' => 'Sajikan hangat'],
        ]);

        // Recipe 7: Capcay
        $capcay = Recipe::create([
            'name' => 'Capcay',
            'description' => 'Capcay dengan berbagai sayuran segar.',
            'cooking_time' => 25,
            'difficulty' => 'sedang',
            'servings' => 4,
            'image' => Storage::url($capcayImage)
        ]);

        $capcay->ingredients()->attach([
            10 => ['amount' => '1', 'unit' => 'buah'], // Wortel
            11 => ['amount' => '1', 'unit' => 'buah'], // Brokoli
            12 => ['amount' => '1', 'unit' => 'ikat'], // Bayam
            13 => ['amount' => '1', 'unit' => 'ikat'], // Kangkung
            2 => ['amount' => '4', 'unit' => 'siung'], // Bawang Putih
        ]);

        $capcay->steps()->createMany([
            ['step_number' => 1, 'description' => 'Siapkan semua sayuran'],
            ['step_number' => 2, 'description' => 'Tumis bawang putih hingga harum'],
            ['step_number' => 3, 'description' => 'Masukkan sayuran dan tumis hingga layu'],
            ['step_number' => 4, 'description' => 'Tambahkan air secukupnya'],
            ['step_number' => 5, 'description' => 'Bumbui dengan garam, merica, dan saus tiram'],
            ['step_number' => 6, 'description' => 'Sajikan hangat'],
        ]);

        // Recipe 8: Bakso
        $bakso = Recipe::create([
            'name' => 'Bakso',
            'description' => 'Bakso sapi dengan kuah kaldu gurih.',
            'cooking_time' => 60,
            'difficulty' => 'rumit',
            'servings' => 6,
            'image' => Storage::url($baksoImage)
        ]);

        $bakso->ingredients()->attach([
            6 => ['amount' => '500', 'unit' => 'gram'], // Daging Sapi
            1 => ['amount' => '5', 'unit' => 'siung'], // Bawang Merah
            2 => ['amount' => '4', 'unit' => 'siung'], // Bawang Putih
            29 => ['amount' => '1', 'unit' => 'ruas'], // Kunyit
            31 => ['amount' => '2', 'unit' => 'lembar'], // Daun Salam
        ]);

        $bakso->steps()->createMany([
            ['step_number' => 1, 'description' => 'Haluskan daging sapi dan bumbu'],
            ['step_number' => 2, 'description' => 'Bentuk adonan bakso'],
            ['step_number' => 3, 'description' => 'Rebus bakso hingga matang'],
            ['step_number' => 4, 'description' => 'Siapkan kuah kaldu'],
            ['step_number' => 5, 'description' => 'Sajikan bakso dengan kuah dan pelengkap'],
        ]);

        // Recipe 9: Gado-Gado
        $gadoGado = Recipe::create([
            'name' => 'Gado-Gado',
            'description' => 'Gado-gado dengan sayuran dan bumbu kacang.',
            'cooking_time' => 30,
            'difficulty' => 'sedang',
            'servings' => 4,
            'image' => Storage::url($gadogadoImage)
        ]);

        $gadoGado->ingredients()->attach([
            10 => ['amount' => '1', 'unit' => 'buah'], // Wortel
            11 => ['amount' => '1', 'unit' => 'buah'], // Brokoli
            12 => ['amount' => '1', 'unit' => 'ikat'], // Bayam
            14 => ['amount' => '2', 'unit' => 'buah'], // Kentang
            8 => ['amount' => '200', 'unit' => 'gram'], // Tahu
        ]);

        $gadoGado->steps()->createMany([
            ['step_number' => 1, 'description' => 'Rebus semua sayuran'],
            ['step_number' => 2, 'description' => 'Goreng tahu dan tempe'],
            ['step_number' => 3, 'description' => 'Haluskan bumbu kacang'],
            ['step_number' => 4, 'description' => 'Tata sayuran dan tahu di piring'],
            ['step_number' => 5, 'description' => 'Siram dengan bumbu kacang'],
            ['step_number' => 6, 'description' => 'Sajikan dengan kerupuk'],
        ]);

        // Recipe 10: Sate Ayam
        $sateAyam = Recipe::create([
            'name' => 'Sate Ayam',
            'description' => 'Sate ayam dengan bumbu kacang khas Indonesia.',
            'cooking_time' => 40,
            'difficulty' => 'sedang',
            'servings' => 4,
            'image' => Storage::url($sateAyamImage)
        ]);

        $sateAyam->ingredients()->attach([
            5 => ['amount' => '500', 'unit' => 'gram'], // Ayam
            1 => ['amount' => '5', 'unit' => 'siung'], // Bawang Merah
            2 => ['amount' => '4', 'unit' => 'siung'], // Bawang Putih
            29 => ['amount' => '1', 'unit' => 'ruas'], // Kunyit
            31 => ['amount' => '2', 'unit' => 'lembar'], // Daun Salam
        ]);

        $sateAyam->steps()->createMany([
            ['step_number' => 1, 'description' => 'Potong ayam kecil-kecil'],
            ['step_number' => 2, 'description' => 'Tusuk ayam dengan tusukan sate'],
            ['step_number' => 3, 'description' => 'Bakar sate hingga matang'],
            ['step_number' => 4, 'description' => 'Sajikan dengan bumbu kacang dan lontong'],
        ]);
    }
}
