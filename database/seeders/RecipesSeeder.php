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

        $oseng = Recipe::create([
            'name' => 'Oseng Telur Tempe',
            'description' => 'Oseng telur dengan tempe dan kacang panjang.',
            'cooking_time' => 20,
            'difficulty' => 'sedang',
            'servings' => 1,
            'image' => null,
            'user_id' => rand(2, 3),
            'category_id' => 2, // main course
            'views_count' => rand(5, 20),
            'calories' => 450
        ]);

        $oseng->ingredients()->attach([
            1 => ['amount' => '3', 'unit' => 'siung', 'is_primary' => false], // Bawang Merah
            2 => ['amount' => '2', 'unit' => 'siung', 'is_primary' => false], // Bawang Putih
            3 => ['amount' => '1', 'unit' => 'butir', 'is_primary' => true], // Telur
            9 => ['amount' => '2', 'unit' => 'pcs', 'is_primary' => true], // Tempe
            41 => ['amount' => '2', 'unit' => 'pcs', 'is_primary' => false], // Tomat
            47 => ['amount' => '1', 'unit' => 'ikat', 'is_primary' => false], // Kacang Panjang
            52 => ['amount' => '1', 'unit' => 'gram', 'is_primary' => false], // Kecambah
            59 => ['amount' => '1', 'unit' => 'gram', 'is_primary' => false], // Cabai Rawit
        ]);

        $oseng->steps()->createMany([
            ['step_number' => 1, 'description' => 'Siapkan bahan-bahan'],
            ['step_number' => 2, 'description' => 'Tumis bumbu hingga harum'],
            ['step_number' => 3, 'description' => 'Goreng telur bersama dengan bumbu'],
            ['step_number' => 4, 'description' => 'Masukkan kacang panjang'],
            ['step_number' => 5, 'description' => 'Berikan penyedap rasa secukupnya'],
            ['step_number' => 6, 'description' => 'Sajikan ke dalam piring saji'],
        ]);

        $oseng->moderation()->create([
            'approver_id' => 1,
            'status' => 'approved',
            'notes' => '',
        ]);

        // Recipe 1: Nasi Goreng Spesial
        $nasiGoreng = Recipe::create([
            'name' => 'Nasi Goreng Spesial',
            'description' => 'Nasi goreng dengan telur dan sayuran.',
            'cooking_time' => 20,
            'difficulty' => 'sedang',
            'servings' => 1,
            'image' => Storage::url($nasiGorengImage),
            'user_id' => rand(2, 3),
            'category_id' => 2, // main course
            'views_count' => rand(5, 20),
            'calories' => 450
        ]);

        $nasiGoreng->ingredients()->attach([
            1 => ['amount' => '3', 'unit' => 'siung', 'is_primary' => false], // Bawang Merah
            2 => ['amount' => '2', 'unit' => 'siung', 'is_primary' => false], // Bawang Putih
            3 => ['amount' => '1', 'unit' => 'butir', 'is_primary' => false], // Telur
            4 => ['amount' => '2 1/2', 'unit' => 'piring', 'is_primary' => true], // Nasi Putih
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

        $nasiGoreng->moderation()->create([
            'approver_id' => 1,
            'status' => 'approved',
            'notes' => '',
        ]);

        // Recipe 2: Ayam Goreng
        $ayamGoreng = Recipe::create([
            'name' => 'Ayam Goreng',
            'description' => 'Ayam goreng krispi dengan bumbu rempah.',
            'cooking_time' => 30,
            'difficulty' => 'sedang',
            'servings' => 2,
            'image' => Storage::url($ayamGorengImage),
            'user_id' => rand(2, 3),
            'category_id' => 2, // main course
            'views_count' => rand(5, 20),
            'calories' => 700
        ]);

        $ayamGoreng->ingredients()->attach([
            5 => ['amount' => '500', 'unit' => 'gram', 'is_primary' => true], // Ayam
            1 => ['amount' => '4', 'unit' => 'siung', 'is_primary' => false], // Bawang Merah
            2 => ['amount' => '3', 'unit' => 'siung', 'is_primary' => false], // Bawang Putih
            29 => ['amount' => '1', 'unit' => 'ruas', 'is_primary' => false], // Kunyit
            30 => ['amount' => '1', 'unit' => 'ruas', 'is_primary' => false], // Lengkuas
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
            'image' => Storage::url($sotoAyamImage),
            'user_id' => rand(2, 3),
            'category_id' => 2, // main course
            'views_count' => rand(5, 20),
            'calories' => 310
        ]);

        $sotoAyam->ingredients()->attach([
            5 => ['amount' => '500', 'unit' => 'gram', 'is_primary' => true], // Ayam
            1 => ['amount' => '5', 'unit' => 'siung', 'is_primary' => false], // Bawang Merah
            2 => ['amount' => '4', 'unit' => 'siung', 'is_primary' => false], // Bawang Putih
            29 => ['amount' => '2', 'unit' => 'ruas', 'is_primary' => false], // Kunyit
            30 => ['amount' => '1', 'unit' => 'ruas', 'is_primary' => false], // Lengkuas
            31 => ['amount' => '2', 'unit' => 'lembar', 'is_primary' => false], // Daun Salam
            32 => ['amount' => '1', 'unit' => 'batang', 'is_primary' => false], // Serai
        ]);

        $sotoAyam->steps()->createMany([
            ['step_number' => 1, 'description' => 'Rebus ayam hingga matang'],
            ['step_number' => 2, 'description' => 'Tumis bumbu halus hingga harum'],
            ['step_number' => 3, 'description' => 'Masukkan bumbu ke dalam rebusan ayam'],
            ['step_number' => 4, 'description' => 'Tambahkan garam dan penyedap rasa'],
            ['step_number' => 5, 'description' => 'Sajikan dengan nasi, soun, dan pelengkap lainnya'],
        ]);

        $sotoAyam->moderation()->create([
            'approver_id' => 1,
            'status' => 'approved',
            'notes' => '',
        ]);

        // Recipe 4: Rendang Daging
        $rendangDaging = Recipe::create([
            'name' => 'Rendang Daging',
            'description' => 'Rendang daging sapi dengan bumbu rempah khas Padang.',
            'cooking_time' => 120,
            'difficulty' => 'rumit',
            'servings' => 6,
            'image' => Storage::url($rendangDagingImage),
            'user_id' => rand(2, 3),
            'category_id' => 2, // main course
            'views_count' => rand(5, 20),
            'calories' => 193
        ]);

        $rendangDaging->ingredients()->attach([
            6 => ['amount' => '1', 'unit' => 'kg', 'is_primary' => true], // Daging Sapi
            1 => ['amount' => '10', 'unit' => 'siung', 'is_primary' => false], // Bawang Merah
            2 => ['amount' => '8', 'unit' => 'siung', 'is_primary' => false], // Bawang Putih
            29 => ['amount' => '3', 'unit' => 'ruas', 'is_primary' => false], // Kunyit
            30 => ['amount' => '2', 'unit' => 'ruas', 'is_primary' => false], // Lengkuas
            31 => ['amount' => '3', 'unit' => 'lembar', 'is_primary' => false], // Daun Salam
            32 => ['amount' => '2', 'unit' => 'batang', 'is_primary' => false], // Serai
        ]);

        $rendangDaging->steps()->createMany([
            ['step_number' => 1, 'description' => 'Potong daging sesuai selera'],
            ['step_number' => 2, 'description' => 'Haluskan bumbu'],
            ['step_number' => 3, 'description' => 'Tumis bumbu hingga harum'],
            ['step_number' => 4, 'description' => 'Masukkan daging dan santan'],
            ['step_number' => 5, 'description' => 'Masak dengan api kecil hingga kuah mengental'],
            ['step_number' => 6, 'description' => 'Sajikan dengan nasi hangat'],
        ]);

        $rendangDaging->moderation()->create([
            'approver_id' => 1,
            'status' => 'approved',
            'notes' => '',
        ]);

        // Recipe 5: Tumis Kangkung
        $tumisKangkung = Recipe::create([
            'name' => 'Tumis Kangkung',
            'description' => 'Tumis kangkung dengan bawang putih dan cabai.',
            'cooking_time' => 15,
            'difficulty' => 'mudah',
            'servings' => 2,
            'image' => Storage::url($tumisKangkungImage),
            'user_id' => rand(2, 3),
            'category_id' => 1, // appertizer
            'views_count' => rand(5, 20),
            'calories' => 98
        ]);

        $tumisKangkung->ingredients()->attach([
            13 => ['amount' => '1', 'unit' => 'ikat', 'is_primary' => true], // Kangkung
            2 => ['amount' => '3', 'unit' => 'siung', 'is_primary' => false], // Bawang Putih
            26 => ['amount' => '2', 'unit' => 'buah', 'is_primary' => false], // Cabai Merah
            20 => ['amount' => '1', 'unit' => 'sdt', 'is_primary' => false], // Garam
        ]);

        $tumisKangkung->steps()->createMany([
            ['step_number' => 1, 'description' => 'Cuci bersih kangkung'],
            ['step_number' => 2, 'description' => 'Iris bawang putih dan cabai'],
            ['step_number' => 3, 'description' => 'Tumis bawang putih dan cabai hingga harum'],
            ['step_number' => 4, 'description' => 'Masukkan kangkung dan aduk hingga layu'],
            ['step_number' => 5, 'description' => 'Tambahkan garam dan penyedap rasa'],
            ['step_number' => 6, 'description' => 'Sajikan hangat'],
        ]);

        $tumisKangkung->moderation()->create([
            'approver_id' => 1,
            'status' => 'approved',
            'notes' => '',
        ]);

        // Recipe 6: Mie Goreng
        $mieGoreng = Recipe::create([
            'name' => 'Mie Goreng',
            'description' => 'Mie goreng dengan sayuran dan telur.',
            'cooking_time' => 15,
            'difficulty' => 'mudah',
            'servings' => 2,
            'image' => Storage::url($mieGorengImage),
            'user_id' => rand(2, 3),
            'category_id' => 2, // main course
            'views_count' => rand(5, 20),
            'calories' => 229
        ]);

        $mieGoreng->ingredients()->attach([
            16 => ['amount' => '200', 'unit' => 'gram', 'is_primary' => true], // Mie
            3 => ['amount' => '2', 'unit' => 'butir', 'is_primary' => false], // Telur
            10 => ['amount' => '1', 'unit' => 'buah', 'is_primary' => false], // Wortel
            12 => ['amount' => '1', 'unit' => 'ikat', 'is_primary' => false], // Bayam
            2 => ['amount' => '3', 'unit' => 'siung', 'is_primary' => false], // Bawang Putih
        ]);

        $mieGoreng->steps()->createMany([
            ['step_number' => 1, 'description' => 'Rebus mie hingga matang'],
            ['step_number' => 2, 'description' => 'Tumis bawang putih hingga harum'],
            ['step_number' => 3, 'description' => 'Masukkan telur dan orak-arik'],
            ['step_number' => 4, 'description' => 'Tambahkan sayuran dan mie'],
            ['step_number' => 5, 'description' => 'Bumbui dengan garam, merica, dan kecap'],
            ['step_number' => 6, 'description' => 'Sajikan hangat'],
        ]);

        $mieGoreng->moderation()->create([
            'approver_id' => 1,
            'status' => 'approved',
            'notes' => '',
        ]);

        // Recipe 7: Capcay
        $capcay = Recipe::create([
            'name' => 'Capcay',
            'description' => 'Capcay dengan berbagai sayuran segar.',
            'cooking_time' => 25,
            'difficulty' => 'sedang',
            'servings' => 4,
            'image' => Storage::url($capcayImage),
            'user_id' => rand(2, 3),
            'category_id' => 1, // appertizer
            'views_count' => rand(5, 20),
            'calories' => 120
        ]);

        $capcay->ingredients()->attach([
            10 => ['amount' => '1', 'unit' => 'buah', 'is_primary' => true], // Wortel
            11 => ['amount' => '1', 'unit' => 'buah', 'is_primary' => true], // Brokoli
            12 => ['amount' => '1', 'unit' => 'ikat', 'is_primary' => false], // Bayam
            13 => ['amount' => '1', 'unit' => 'ikat', 'is_primary' => false], // Kangkung
            2 => ['amount' => '4', 'unit' => 'siung', 'is_primary' => false], // Bawang Putih
        ]);

        $capcay->steps()->createMany([
            ['step_number' => 1, 'description' => 'Siapkan semua sayuran'],
            ['step_number' => 2, 'description' => 'Tumis bawang putih hingga harum'],
            ['step_number' => 3, 'description' => 'Masukkan sayuran dan tumis hingga layu'],
            ['step_number' => 4, 'description' => 'Tambahkan air secukupnya'],
            ['step_number' => 5, 'description' => 'Bumbui dengan garam, merica, dan saus tiram'],
            ['step_number' => 6, 'description' => 'Sajikan hangat'],
        ]);

        $capcay->moderation()->create([
            'approver_id' => 1,
            'status' => 'approved',
            'notes' => '',
        ]);

        // Recipe 8: Bakso
        $bakso = Recipe::create([
            'name' => 'Bakso',
            'description' => 'Bakso sapi dengan kuah kaldu gurih.',
            'cooking_time' => 60,
            'difficulty' => 'rumit',
            'servings' => 6,
            'image' => Storage::url($baksoImage),
            'user_id' => rand(2, 3),
            'category_id' => 2, // main course
            'views_count' => rand(5, 20),
            'calories' => 444
        ]);

        $bakso->ingredients()->attach([
            6 => ['amount' => '500', 'unit' => 'gram', 'is_primary' => true], // Daging Sapi
            1 => ['amount' => '5', 'unit' => 'siung', 'is_primary' => false], // Bawang Merah
            2 => ['amount' => '4', 'unit' => 'siung', 'is_primary' => false], // Bawang Putih
            29 => ['amount' => '1', 'unit' => 'ruas', 'is_primary' => false], // Kunyit
            31 => ['amount' => '2', 'unit' => 'lembar', 'is_primary' => false], // Daun Salam
        ]);

        $bakso->steps()->createMany([
            ['step_number' => 1, 'description' => 'Haluskan daging sapi dan bumbu'],
            ['step_number' => 2, 'description' => 'Bentuk adonan bakso'],
            ['step_number' => 3, 'description' => 'Rebus bakso hingga matang'],
            ['step_number' => 4, 'description' => 'Siapkan kuah kaldu'],
            ['step_number' => 5, 'description' => 'Sajikan bakso dengan kuah dan pelengkap'],
        ]);

        $bakso->moderation()->create([
            'approver_id' => 1,
            'status' => 'approved',
            'notes' => '',
        ]);

        // Recipe 9: Gado-Gado
        $gadoGado = Recipe::create([
            'name' => 'Gado-Gado',
            'description' => 'Gado-gado dengan sayuran dan bumbu kacang.',
            'cooking_time' => 30,
            'difficulty' => 'sedang',
            'servings' => 4,
            'image' => Storage::url($gadogadoImage),
            'user_id' => rand(2, 3),
            'category_id' => 2, // main course
            'views_count' => rand(5, 20),
            'calories' => 396
        ]);

        $gadoGado->ingredients()->attach([
            10 => ['amount' => '1', 'unit' => 'buah', 'is_primary' => true], // Wortel
            11 => ['amount' => '1', 'unit' => 'buah', 'is_primary' => true], // Brokoli
            12 => ['amount' => '1', 'unit' => 'ikat', 'is_primary' => false], // Bayam
            14 => ['amount' => '2', 'unit' => 'buah', 'is_primary' => true], // Kentang
            8 => ['amount' => '200', 'unit' => 'gram', 'is_primary' => true], // Tahu
        ]);

        $gadoGado->steps()->createMany([
            ['step_number' => 1, 'description' => 'Rebus semua sayuran'],
            ['step_number' => 2, 'description' => 'Goreng tahu dan tempe'],
            ['step_number' => 3, 'description' => 'Haluskan bumbu kacang'],
            ['step_number' => 4, 'description' => 'Tata sayuran dan tahu di piring'],
            ['step_number' => 5, 'description' => 'Siram dengan bumbu kacang'],
            ['step_number' => 6, 'description' => 'Sajikan dengan kerupuk'],
        ]);

        $gadoGado->moderation()->create([
            'approver_id' => 1,
            'status' => 'approved',
            'notes' => '',
        ]);

        // Recipe 10: Sate Ayam
        $sateAyam = Recipe::create([
            'name' => 'Sate Ayam',
            'description' => 'Sate ayam dengan bumbu kacang khas Indonesia.',
            'cooking_time' => 40,
            'difficulty' => 'sedang',
            'servings' => 4,
            'image' => Storage::url($sateAyamImage),
            'user_id' => rand(2, 3),
            'category_id' => 2, // main course
            'views_count' => rand(5, 20),
            'calories' => 340
        ]);

        $sateAyam->ingredients()->attach([
            5 => ['amount' => '500', 'unit' => 'gram', 'is_primary' => true], // Ayam
            1 => ['amount' => '5', 'unit' => 'siung', 'is_primary' => false], // Bawang Merah
            2 => ['amount' => '4', 'unit' => 'siung', 'is_primary' => false], // Bawang Putih
            29 => ['amount' => '1', 'unit' => 'ruas', 'is_primary' => false], // Kunyit
            31 => ['amount' => '2', 'unit' => 'lembar', 'is_primary' => false], // Daun Salam
        ]);

        $sateAyam->steps()->createMany([
            ['step_number' => 1, 'description' => 'Potong ayam kecil-kecil'],
            ['step_number' => 2, 'description' => 'Tusuk ayam dengan tusukan sate'],
            ['step_number' => 3, 'description' => 'Bakar sate hingga matang'],
            ['step_number' => 4, 'description' => 'Sajikan dengan bumbu kacang dan lontong'],
        ]);

        $sateAyam->moderation()->create([
            'approver_id' => 1,
            'status' => 'approved',
            'notes' => '',
        ]);

        // Recipe 11: Rawon
        $rawon = Recipe::create([
            'name' => 'Rawon',
            'description' => 'Sup daging hitam khas Jawa Timur dengan kluwek.',
            'cooking_time' => 120,
            'difficulty' => 'rumit',
            'servings' => 6,
            'image' => null,
            'user_id' => rand(2, 3),
            'category_id' => 2, // main course
            'views_count' => rand(5, 20),
            'calories' => 352
        ]);

        $rawon->ingredients()->attach([
            6 => ['amount' => '500', 'unit' => 'gram', 'is_primary' => true], // Daging Sapi
            1 => ['amount' => '8', 'unit' => 'siung', 'is_primary' => false], // Bawang Merah
            2 => ['amount' => '5', 'unit' => 'siung', 'is_primary' => false], // Bawang Putih
            33 => ['amount' => '3', 'unit' => 'butir', 'is_primary' => true], // Kluwek
            31 => ['amount' => '2', 'unit' => 'lembar', 'is_primary' => false], // Daun Salam
        ]);

        $rawon->steps()->createMany([
            ['step_number' => 1, 'description' => 'Rebus daging hingga empuk'],
            ['step_number' => 2, 'description' => 'Haluskan bumbu dan kluwek'],
            ['step_number' => 3, 'description' => 'Tumis bumbu hingga harum'],
            ['step_number' => 4, 'description' => 'Masukkan ke dalam rebusan daging'],
            ['step_number' => 5, 'description' => 'Masak hingga bumbu meresap'],
            ['step_number' => 6, 'description' => 'Sajikan dengan tauge dan telur asin']
        ]);

        $rawon->moderation()->create([
            'approver_id' => 1,
            'status' => 'approved',
            'notes' => '',
        ]);

        // Recipe 12: Soto Betawi
        $sotoBetawi = Recipe::create([
            'name' => 'Soto Betawi',
            'description' => 'Soto khas Jakarta dengan kuah santan yang gurih.',
            'cooking_time' => 90,
            'difficulty' => 'sedang',
            'servings' => 6,
            'image' => null,
            'user_id' => rand(2, 3),
            'category_id' => 2, // main course
            'views_count' => rand(5, 20),
            'calories' => 468
        ]);

        $sotoBetawi->ingredients()->attach([
            6 => ['amount' => '500', 'unit' => 'gram', 'is_primary' => true], // Daging Sapi
            1 => ['amount' => '6', 'unit' => 'siung', 'is_primary' => false], // Bawang Merah
            2 => ['amount' => '4', 'unit' => 'siung', 'is_primary' => false], // Bawang Putih
            34 => ['amount' => '500', 'unit' => 'ml', 'is_primary' => true], // Santan
            35 => ['amount' => '2', 'unit' => 'batang', 'is_primary' => false], // Daun Bawang
        ]);

        $sotoBetawi->steps()->createMany([
            ['step_number' => 1, 'description' => 'Rebus daging hingga empuk'],
            ['step_number' => 2, 'description' => 'Tumis bumbu halus'],
            ['step_number' => 3, 'description' => 'Masukkan santan dan daging'],
            ['step_number' => 4, 'description' => 'Masak hingga mendidih'],
            ['step_number' => 5, 'description' => 'Sajikan dengan emping dan acar']
        ]);

        $sotoBetawi->moderation()->create([
            'approver_id' => 1,
            'status' => 'approved',
            'notes' => '',
        ]);

        // Recipe 13: Gulai Kambing
        $gulaiKambing = Recipe::create([
            'name' => 'Gulai Kambing',
            'description' => 'Gulai kambing dengan rempah khas Indonesia.',
            'cooking_time' => 120,
            'difficulty' => 'rumit',
            'servings' => 6,
            'image' => null,
            'user_id' => rand(2, 3),
            'category_id' => 2, // main course
            'views_count' => rand(5, 20),
            'calories' => 425
        ]);

        $gulaiKambing->ingredients()->attach([
            36 => ['amount' => '1', 'unit' => 'kg', 'is_primary' => true], // Daging Kambing
            1 => ['amount' => '8', 'unit' => 'siung', 'is_primary' => false], // Bawang Merah
            2 => ['amount' => '6', 'unit' => 'siung', 'is_primary' => false], // Bawang Putih
            34 => ['amount' => '500', 'unit' => 'ml', 'is_primary' => true], // Santan
            37 => ['amount' => '3', 'unit' => 'buah', 'is_primary' => false], // Kapulaga
        ]);

        $gulaiKambing->steps()->createMany([
            ['step_number' => 1, 'description' => 'Potong daging kambing'],
            ['step_number' => 2, 'description' => 'Haluskan bumbu rempah'],
            ['step_number' => 3, 'description' => 'Tumis bumbu hingga harum'],
            ['step_number' => 4, 'description' => 'Masukkan daging dan santan'],
            ['step_number' => 5, 'description' => 'Masak hingga daging empuk'],
            ['step_number' => 6, 'description' => 'Sajikan dengan nasi putih']
        ]);

        $gulaiKambing->moderation()->create([
            'approver_id' => 1,
            'status' => 'approved',
            'notes' => '',
        ]);

        // Recipe 14: Pecel Lele
        $pecelLele = Recipe::create([
            'name' => 'Pecel Lele',
            'description' => 'Ikan lele goreng dengan sambal pecel.',
            'cooking_time' => 30,
            'difficulty' => 'mudah',
            'servings' => 2,
            'image' => null,
            'user_id' => rand(2, 3),
            'category_id' => 2, // main course
            'views_count' => rand(5, 20),
            'calories' => 285
        ]);

        $pecelLele->ingredients()->attach([
            38 => ['amount' => '2', 'unit' => 'ekor', 'is_primary' => true], // Ikan Lele
            1 => ['amount' => '4', 'unit' => 'siung', 'is_primary' => false], // Bawang Merah
            2 => ['amount' => '3', 'unit' => 'siung', 'is_primary' => false], // Bawang Putih
            29 => ['amount' => '1', 'unit' => 'ruas', 'is_primary' => false], // Kunyit
            26 => ['amount' => '5', 'unit' => 'buah', 'is_primary' => false], // Cabai Merah
        ]);

        $pecelLele->steps()->createMany([
            ['step_number' => 1, 'description' => 'Bersihkan ikan lele'],
            ['step_number' => 2, 'description' => 'Lumuri dengan bumbu'],
            ['step_number' => 3, 'description' => 'Goreng hingga kering'],
            ['step_number' => 4, 'description' => 'Siapkan sambal pecel'],
            ['step_number' => 5, 'description' => 'Sajikan dengan lalapan']
        ]);

        $pecelLele->moderation()->create([
            'approver_id' => 1,
            'status' => 'approved',
            'notes' => '',
        ]);

        // Recipe 15: Sayur Asem
        $sayurAsem = Recipe::create([
            'name' => 'Sayur Asem',
            'description' => 'Sayur asem dengan berbagai sayuran segar.',
            'cooking_time' => 45,
            'difficulty' => 'mudah',
            'servings' => 4,
            'image' => null,
            'user_id' => rand(2, 3),
            'category_id' => 1, // appetizer
            'views_count' => rand(5, 20),
            'calories' => 125
        ]);

        $sayurAsem->ingredients()->attach([
            39 => ['amount' => '2', 'unit' => 'buah', 'is_primary' => true], // Asam Jawa
            10 => ['amount' => '2', 'unit' => 'buah', 'is_primary' => true], // Wortel
            40 => ['amount' => '100', 'unit' => 'gram', 'is_primary' => true], // Kacang Panjang
            41 => ['amount' => '2', 'unit' => 'buah', 'is_primary' => true], // Labu Siam
            1 => ['amount' => '5', 'unit' => 'siung', 'is_primary' => false], // Bawang Merah
        ]);

        $sayurAsem->steps()->createMany([
            ['step_number' => 1, 'description' => 'Potong semua sayuran'],
            ['step_number' => 2, 'description' => 'Rebus air dan asam jawa'],
            ['step_number' => 3, 'description' => 'Masukkan sayuran'],
            ['step_number' => 4, 'description' => 'Tambahkan bumbu'],
            ['step_number' => 5, 'description' => 'Masak hingga sayuran matang']
        ]);

        $sayurAsem->moderation()->create([
            'approver_id' => 1,
            'status' => 'approved',
            'notes' => '',
        ]);

        // Recipe 16: Soto Banjar
        $sotoBanjar = Recipe::create([
            'name' => 'Soto Banjar',
            'description' => 'Soto khas Kalimantan Selatan dengan ketupat dan daging sapi',
            'cooking_time' => 90,
            'difficulty' => 'sedang',
            'image' => null,
            'servings' => 4,
            'user_id' => rand(2, 3),
            'category_id' => 2,
            'views_count' => rand(5, 20),
            'calories' => 420
        ]);

        $sotoBanjar->ingredients()->attach([
            6 => ['amount' => '500', 'unit' => 'gram', 'is_primary' => true],
            1 => ['amount' => '8', 'unit' => 'siung', 'is_primary' => false],
            34 => ['amount' => '500', 'unit' => 'ml', 'is_primary' => true]
        ]);

        $sotoBanjar->steps()->createMany([
            ['step_number' => 1, 'description' => 'Rebus daging hingga empuk'],
            ['step_number' => 2, 'description' => 'Buat kuah soto dengan rempah-rempah'],
            ['step_number' => 3, 'description' => 'Sajikan dengan ketupat dan pelengkap']
        ]);

        $sotoBanjar->moderation()->create([
            'approver_id' => 1,
            'status' => 'approved'
        ]);

        // Recipe 17: Nasi Uduk
        $nasiUduk = Recipe::create([
            'name' => 'Nasi Uduk',
            'description' => 'Nasi yang dimasak dengan santan dan rempah-rempah khas Indonesia.',
            'cooking_time' => 60,
            'difficulty' => 'sedang',
            'servings' => 4,
            'image' => null,
            'user_id' => rand(2, 3),
            'category_id' => 2, // main course
            'views_count' => rand(5, 20),
            'calories' => 300
        ]);

        $nasiUduk->ingredients()->attach([
            4 => ['amount' => '2', 'unit' => 'gelas', 'is_primary' => true], // Nasi Putih
            66 => ['amount' => '200', 'unit' => 'ml', 'is_primary' => true], // Santan
            19 => ['amount' => '1', 'unit' => 'sdt', 'is_primary' => false], // Garam
            31 => ['amount' => '2', 'unit' => 'lembar', 'is_primary' => false], // Daun Salam
            33 => ['amount' => '1', 'unit' => 'batang', 'is_primary' => false], // Serai
        ]);

        $nasiUduk->steps()->createMany([
            ['step_number' => 1, 'description' => 'Cuci beras hingga bersih.'],
            ['step_number' => 2, 'description' => 'Masak beras dengan santan, garam, daun salam, dan serai.'],
            ['step_number' => 3, 'description' => 'Masak hingga nasi matang dan harum.'],
        ]);

        $nasiUduk->moderation()->create([
            'approver_id' => 1,
            'status' => 'approved',
            'notes' => '',
        ]);

        // Recipe 18: Es Teler
        $esTeler = Recipe::create([
            'name' => 'Es Teler',
            'description' => 'Minuman segar khas Indonesia dengan potongan buah dan santan.',
            'cooking_time' => 15,
            'difficulty' => 'mudah',
            'servings' => 2,
            'image' => null,
            'user_id' => rand(2, 3),
            'category_id' => 3, // dessert
            'views_count' => rand(5, 20),
            'calories' => 150
        ]);

        $esTeler->ingredients()->attach([
            37 => ['amount' => '100', 'unit' => 'gram', 'is_primary' => true], // Susu
            66 => ['amount' => '100', 'unit' => 'ml', 'is_primary' => true], // Santan
            67 => ['amount' => '1', 'unit' => 'buah', 'is_primary' => true], // Belimbing Wuluh
            68 => ['amount' => '1', 'unit' => 'buah', 'is_primary' => false], // Kapulaga
        ]);

        $esTeler->steps()->createMany([
            ['step_number' => 1, 'description' => 'Campurkan semua bahan dalam mangkuk.'],
            ['step_number' => 2, 'description' => 'Sajikan dingin dengan es batu.'],
        ]);

        $esTeler->moderation()->create([
            'approver_id' => 1,
            'status' => 'approved',
            'notes' => '',
        ]);

        // Recipe 19: Soto Lamongan
        $sotoLamongan = Recipe::create([
            'name' => 'Soto Lamongan',
            'description' => 'Sup ayam khas Lamongan dengan kuah kuning yang gurih.',
            'cooking_time' => 90,
            'difficulty' => 'rumit',
            'servings' => 5,
            'image' => null,
            'user_id' => rand(2, 3),
            'category_id' => 2, // main course
            'views_count' => rand(5, 20),
            'calories' => 250
        ]);

        $sotoLamongan->ingredients()->attach([
            5 => ['amount' => '500', 'unit' => 'gram', 'is_primary' => true], // Ayam
            1 => ['amount' => '5', 'unit' => 'siung', 'is_primary' => false], // Bawang Merah
            2 => ['amount' => '3', 'unit' => 'siung', 'is_primary' => false], // Bawang Putih
            29 => ['amount' => '1', 'unit' => 'ruas', 'is_primary' => false], // Jahe
            30 => ['amount' => '1', 'unit' => 'ruas', 'is_primary' => false], // Kunyit
        ]);

        $sotoLamongan->steps()->createMany([
            ['step_number' => 1, 'description' => 'Rebus ayam hingga empuk.'],
            ['step_number' => 2, 'description' => 'Tumis bumbu dan masukkan ke dalam kuah.'],
            ['step_number' => 3, 'description' => 'Masak hingga bumbu meresap dan kuah mengental.'],
        ]);

        $sotoLamongan->moderation()->create([
            'approver_id' => 1,
            'status' => 'approved',
            'notes' => '',
        ]);

        // Recipe 20: Bubur Ayam
        $buburAyam = Recipe::create([
            'name' => 'Bubur Ayam',
            'description' => 'Bubur nasi lembut dengan ayam suwir dan bumbu khas Indonesia.',
            'cooking_time' => 60,
            'difficulty' => 'sedang',
            'servings' => 4,
            'image' => null,
            'user_id' => rand(2, 3),
            'category_id' => 2, // main course
            'views_count' => rand(5, 20),
            'calories' => 200
        ]);

        $buburAyam->ingredients()->attach([
            4 => ['amount' => '1', 'unit' => 'gelas', 'is_primary' => true], // Nasi Putih
            5 => ['amount' => '200', 'unit' => 'gram', 'is_primary' => true], // Ayam
            19 => ['amount' => '1', 'unit' => 'sdt', 'is_primary' => false], // Garam
            31 => ['amount' => '2', 'unit' => 'lembar', 'is_primary' => false], // Daun Salam
            33 => ['amount' => '1', 'unit' => 'batang', 'is_primary' => false], // Serai
        ]);

        $buburAyam->steps()->createMany([
            ['step_number' => 1, 'description' => 'Masak nasi dengan air hingga menjadi bubur.'],
            ['step_number' => 2, 'description' => 'Rebus ayam dan suwir-suwir.'],
            ['step_number' => 3, 'description' => 'Sajikan bubur dengan ayam suwir dan bumbu pelengkap.'],
        ]);

        $buburAyam->moderation()->create([
            'approver_id' => 1,
            'status' => 'approved',
            'notes' => '',
        ]);

        // Recipe 21: Klepon
        $klepon = Recipe::create([
            'name' => 'Klepon',
            'description' => 'Kue tradisional berbentuk bulat dari tepung ketan berisi gula merah.',
            'cooking_time' => 30,
            'difficulty' => 'mudah',
            'servings' => 4,
            'image' => null,
            'user_id' => rand(2, 3),
            'category_id' => 3, // dessert
            'views_count' => rand(5, 20),
            'calories' => 180
        ]);

        $klepon->ingredients()->attach([
            4 => ['amount' => '1', 'unit' => 'gelas', 'is_primary' => true], // Nasi Putih
            19 => ['amount' => '1', 'unit' => 'sdt', 'is_primary' => false], // Garam
            66 => ['amount' => '100', 'unit' => 'ml', 'is_primary' => true], // Santan
            69 => ['amount' => '50', 'unit' => 'gram', 'is_primary' => true], // Kelapa
        ]);

        $klepon->steps()->createMany([
            ['step_number' => 1, 'description' => 'Campur tepung ketan dengan santan dan garam.'],
            ['step_number' => 2, 'description' => 'Bentuk bulat dan isi dengan gula merah.'],
            ['step_number' => 3, 'description' => 'Rebus hingga matang dan gulingkan di kelapa parut.'],
        ]);

        $klepon->moderation()->create([
            'approver_id' => 1,
            'status' => 'approved',
            'notes' => '',
        ]);

        // Resep 22: Gudeg
        $gudeg = Recipe::create([
            'name' => 'Gudeg',
            'description' => 'Hidangan khas Yogyakarta yang terbuat dari nangka muda.',
            'cooking_time' => 120,
            'difficulty' => 'sulit',
            'servings' => 4,
            'image' => null,
            'user_id' => rand(2, 3),
            'category_id' => 2, // hidangan utama
            'views_count' => rand(5, 20),
            'calories' => 350
        ]);

        $gudeg->ingredients()->attach([
            70 => ['amount' => '500', 'unit' => 'gram', 'is_primary' => true], // Nangka Muda
            19 => ['amount' => '1', 'unit' => 'sdt', 'is_primary' => false], // Garam
            31 => ['amount' => '2', 'unit' => 'lembar', 'is_primary' => false], // Daun Salam
            66 => ['amount' => '200', 'unit' => 'ml', 'is_primary' => true], // Santan
        ]);

        $gudeg->steps()->createMany([
            ['step_number' => 1, 'description' => 'Rebus nangka muda hingga empuk.'],
            ['step_number' => 2, 'description' => 'Tambahkan santan dan bumbu, masak hingga meresap.'],
            ['step_number' => 3, 'description' => 'Sajikan dengan nasi dan lauk pelengkap.'],
        ]);

        $gudeg->moderation()->create([
            'approver_id' => 1,
            'status' => 'approved',
            'notes' => '',
        ]);

        // Resep 23: Pempek
        $pempek = Recipe::create([
            'name' => 'Pempek',
            'description' => 'Makanan khas Palembang yang terbuat dari ikan dan sagu.',
            'cooking_time' => 90,
            'difficulty' => 'sedang',
            'servings' => 5,
            'image' => null,
            'user_id' => rand(2, 3),
            'category_id' => 2, // hidangan utama
            'views_count' => rand(5, 20),
            'calories' => 250
        ]);

        $pempek->ingredients()->attach([
            7 => ['amount' => '300', 'unit' => 'gram', 'is_primary' => true], // Ikan
            19 => ['amount' => '1', 'unit' => 'sdt', 'is_primary' => false], // Garam
            4 => ['amount' => '200', 'unit' => 'gram', 'is_primary' => true], // Nasi Putih
        ]);

        $pempek->steps()->createMany([
            ['step_number' => 1, 'description' => 'Campur ikan dengan sagu dan bumbu.'],
            ['step_number' => 2, 'description' => 'Bentuk adonan dan rebus hingga matang.'],
            ['step_number' => 3, 'description' => 'Goreng pempek dan sajikan dengan cuko.'],
        ]);

        $pempek->moderation()->create([
            'approver_id' => 1,
            'status' => 'approved',
            'notes' => '',
        ]);

        // Resep 24: Ketoprak
        $ketoprak = Recipe::create([
            'name' => 'Ketoprak',
            'description' => 'Hidangan khas Jakarta yang terdiri dari tahu, bihun, dan bumbu kacang.',
            'cooking_time' => 30,
            'difficulty' => 'mudah',
            'servings' => 3,
            'image' => null,
            'user_id' => rand(2, 3),
            'category_id' => 2, // hidangan utama
            'views_count' => rand(5, 20),
            'calories' => 300
        ]);

        $ketoprak->ingredients()->attach([
            8 => ['amount' => '200', 'unit' => 'gram', 'is_primary' => true], // Tahu
            19 => ['amount' => '1', 'unit' => 'sdt', 'is_primary' => false], // Garam
            4 => ['amount' => '100', 'unit' => 'gram', 'is_primary' => true], // Nasi Putih
        ]);

        $ketoprak->steps()->createMany([
            ['step_number' => 1, 'description' => 'Rebus bihun hingga matang.'],
            ['step_number' => 2, 'description' => 'Goreng tahu dan campur dengan bihun.'],
            ['step_number' => 3, 'description' => 'Sajikan dengan bumbu kacang dan kerupuk.'],
        ]);

        $ketoprak->moderation()->create([
            'approver_id' => 1,
            'status' => 'approved',
            'notes' => '',
        ]);

        // Resep 25: Rujak Cingur
        $rujakCingur = Recipe::create([
            'name' => 'Rujak Cingur',
            'description' => 'Salad tradisional Jawa Timur dengan cingur sapi dan bumbu petis.',
            'cooking_time' => 45,
            'difficulty' => 'sedang',
            'servings' => 4,
            'image' => null,
            'user_id' => rand(2, 3),
            'category_id' => 1, // hidangan pembuka
            'views_count' => rand(5, 20),
            'calories' => 200
        ]);

        $rujakCingur->ingredients()->attach([
            6 => ['amount' => '200', 'unit' => 'gram', 'is_primary' => true], // Daging Sapi
            19 => ['amount' => '1', 'unit' => 'sdt', 'is_primary' => false], // Garam
            4 => ['amount' => '100', 'unit' => 'gram', 'is_primary' => true], // Nasi Putih
        ]);

        $rujakCingur->steps()->createMany([
            ['step_number' => 1, 'description' => 'Rebus cingur sapi hingga empuk.'],
            ['step_number' => 2, 'description' => 'Campur dengan sayuran dan bumbu petis.'],
            ['step_number' => 3, 'description' => 'Sajikan dengan lontong dan kerupuk.'],
        ]);

        $rujakCingur->moderation()->create([
            'approver_id' => 1,
            'status' => 'approved',
            'notes' => '',
        ]);

        // Resep 26: Es Campur
        $esCampur = Recipe::create([
            'name' => 'Es Campur',
            'description' => 'Minuman segar dengan campuran buah dan sirup.',
            'cooking_time' => 15,
            'difficulty' => 'mudah',
            'servings' => 2,
            'image' => null,
            'user_id' => rand(2, 3),
            'category_id' => 3, // hidangan penutup
            'views_count' => rand(5, 20),
            'calories' => 150
        ]);

        $esCampur->ingredients()->attach([
            37 => ['amount' => '100', 'unit' => 'ml', 'is_primary' => true], // Susu
            66 => ['amount' => '100', 'unit' => 'ml', 'is_primary' => true], // Santan
            67 => ['amount' => '1', 'unit' => 'buah', 'is_primary' => true], // Belimbing Wuluh
        ]);

        $esCampur->steps()->createMany([
            ['step_number' => 1, 'description' => 'Campur semua bahan dalam mangkuk.'],
            ['step_number' => 2, 'description' => 'Tambahkan es serut dan sirup.'],
            ['step_number' => 3, 'description' => 'Sajikan dingin.'],
        ]);

        $esCampur->moderation()->create([
            'approver_id' => 1,
            'status' => 'approved',
            'notes' => '',
        ]);
    }
}
