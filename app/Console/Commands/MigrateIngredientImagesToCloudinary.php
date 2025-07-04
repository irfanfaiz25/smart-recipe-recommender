<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Ingredient;
use Illuminate\Support\Facades\Storage;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Cloudinary\Configuration\Configuration;
use Cloudinary\Api\Upload\UploadApi;
use Exception;

class MigrateIngredientImagesToCloudinary extends Command
{
    protected $signature = 'migrate:ingredient-images-to-cloudinary';
    protected $description = 'Migrate ingredient images from local storage to Cloudinary';

    public function handle()
    {
        $this->info('Memulai migrasi gambar ingredient ke Cloudinary...');

        // Setup Cloudinary configuration manually
        try {
            Configuration::instance([
                'cloud' => [
                    'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                    'api_key' => env('CLOUDINARY_API_KEY'),
                    'api_secret' => env('CLOUDINARY_API_SECRET'),
                ],
                'url' => [
                    'secure' => true
                ]
            ]);
            $this->info('Cloudinary configuration set successfully');
        } catch (Exception $e) {
            $this->error('Failed to configure Cloudinary: ' . $e->getMessage());
            return 1;
        }

        // Get all ingredients with images
        $ingredients = Ingredient::whereNotNull('image')
            ->where('image', '!=', '')
            ->whereNotLike('image', '%cloudinary.com%')
            ->get();

        $this->info("Found {$ingredients->count()} ingredients to migrate");

        $successful = 0;
        $failed = 0;

        foreach ($ingredients as $ingredient) {
            $this->info("Processing ingredient ID {$ingredient->id}:");

            // Skip if already using Cloudinary URL
            if (str_contains($ingredient->image, 'cloudinary.com')) {
                $this->info("✓ Ingredient ID {$ingredient->id}: Already using Cloudinary");
                $successful++;
                continue;
            }

            // Fix the path - remove duplicate /storage
            $imagePath = $ingredient->image;

            // Remove leading slash and 'storage/' if present
            $imagePath = ltrim($imagePath, '/');
            if (str_starts_with($imagePath, 'storage/')) {
                $imagePath = substr($imagePath, 8); // Remove 'storage/'
            }

            // Construct the full path
            $fullPath = storage_path('app/public/' . $imagePath);

            if (!file_exists($fullPath)) {
                $this->warn("File not found for ingredient ID {$ingredient->id}: {$fullPath}");
                $failed++;
                continue;
            }

            try {
                // Method 1: Using UploadApi directly
                $uploadApi = new UploadApi();
                $uploadResult = $uploadApi->upload($fullPath, [
                    'folder' => 'ingredients',
                    'public_id' => 'ingredient_' . $ingredient->id,
                    'transformation' => [
                        'quality' => 'auto:good',
                        'format' => 'auto',
                        'width' => 600,
                        'height' => 400,
                        'crop' => 'fill'
                    ]
                ]);

                // Update ingredient with new Cloudinary URL
                $ingredient->update([
                    'image' => $uploadResult['secure_url']
                ]);

                $this->info("✓ Ingredient ID {$ingredient->id}: SUCCESS - {$uploadResult['secure_url']}");
                $successful++;

            } catch (Exception $e) {
                // Method 2: Fallback using Storage disk
                try {
                    $fileName = 'ingredient_' . $ingredient->id . '.' . pathinfo($fullPath, PATHINFO_EXTENSION);
                    $uploaded = Storage::disk('cloudinary')->putFileAs(
                        'ingredients',
                        new \Illuminate\Http\File($fullPath),
                        $fileName
                    );

                    if ($uploaded) {
                        $url = Storage::disk('cloudinary')->url($uploaded);

                        // Update ingredient with new Cloudinary URL
                        $ingredient->update([
                            'image' => $url
                        ]);

                        $this->info("✓ Ingredient ID {$ingredient->id}: SUCCESS (Storage) - {$url}");
                        $successful++;
                    } else {
                        throw new Exception('Storage upload failed');
                    }

                } catch (Exception $e2) {
                    $this->error("✗ Ingredient ID {$ingredient->id}: FAILED - {$e->getMessage()}");
                    $this->error("Fallback error: {$e2->getMessage()}");
                    $this->error("Error type: " . get_class($e));
                    $failed++;
                }
            }
        }

        $this->info('=== MIGRATION SUMMARY ===');
        $this->info("Total ingredients: {$ingredients->count()}");
        $this->info("Successful: {$successful}");
        $this->info("Failed: {$failed}");
        $this->info('Migrasi selesai!');

        return 0;
    }
}