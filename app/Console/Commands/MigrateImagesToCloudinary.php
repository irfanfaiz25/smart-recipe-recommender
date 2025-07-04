<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Recipe;
use Illuminate\Support\Facades\Storage;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Cloudinary\Configuration\Configuration;
use Cloudinary\Api\Upload\UploadApi;
use Exception;

class MigrateImagesToCloudinary extends Command
{
    protected $signature = 'migrate:images-to-cloudinary';
    protected $description = 'Migrate recipe images from local storage to Cloudinary';

    public function handle()
    {
        $this->info('Memulai migrasi gambar ke Cloudinary...');

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

        // Get all recipes with images
        $recipes = Recipe::whereNotNull('image')
            ->where('image', '!=', '')
            ->whereNotLike('image', '%cloudinary.com%')
            ->get();

        $this->info("Found {$recipes->count()} recipes to migrate");

        $successful = 0;
        $failed = 0;

        foreach ($recipes as $recipe) {
            $this->info("Processing recipe ID {$recipe->id}:");

            // Skip if already using Cloudinary URL
            if (str_contains($recipe->image, 'cloudinary.com')) {
                $this->info("✓ Recipe ID {$recipe->id}: Already using Cloudinary");
                $successful++;
                continue;
            }

            // Fix the path - remove duplicate /storage
            $imagePath = $recipe->image;

            // Remove leading slash and 'storage/' if present
            $imagePath = ltrim($imagePath, '/');
            if (str_starts_with($imagePath, 'storage/')) {
                $imagePath = substr($imagePath, 8); // Remove 'storage/'
            }

            // Construct the full path
            $fullPath = storage_path('app/public/' . $imagePath);

            if (!file_exists($fullPath)) {
                $this->warn("File not found for recipe ID {$recipe->id}: {$fullPath}");
                $failed++;
                continue;
            }

            try {
                // Method 1: Using UploadApi directly
                $uploadApi = new UploadApi();
                $uploadResult = $uploadApi->upload($fullPath, [
                    'folder' => 'recipes',
                    'public_id' => 'recipe_' . $recipe->id,
                    'transformation' => [
                        'quality' => 'auto:good',
                        'format' => 'auto',
                        'width' => 800,
                        'height' => 600,
                        'crop' => 'fill'
                    ]
                ]);

                // Update recipe with new Cloudinary URL
                $recipe->update([
                    'image' => $uploadResult['secure_url']
                ]);

                $this->info("✓ Recipe ID {$recipe->id}: SUCCESS - {$uploadResult['secure_url']}");
                $successful++;

            } catch (Exception $e) {
                // Method 2: Fallback using Storage disk
                try {
                    $fileName = 'recipe_' . $recipe->id . '.' . pathinfo($fullPath, PATHINFO_EXTENSION);
                    $uploaded = Storage::disk('cloudinary')->putFileAs(
                        'recipes',
                        new \Illuminate\Http\File($fullPath),
                        $fileName
                    );

                    if ($uploaded) {
                        $url = Storage::disk('cloudinary')->url($uploaded);

                        // Update recipe with new Cloudinary URL
                        $recipe->update([
                            'image' => $url
                        ]);

                        $this->info("✓ Recipe ID {$recipe->id}: SUCCESS (Storage) - {$url}");
                        $successful++;
                    } else {
                        throw new Exception('Storage upload failed');
                    }

                } catch (Exception $e2) {
                    $this->error("✗ Recipe ID {$recipe->id}: FAILED - {$e->getMessage()}");
                    $this->error("Fallback error: {$e2->getMessage()}");
                    $this->error("Error type: " . get_class($e));
                    $failed++;
                }
            }
        }

        $this->info('=== MIGRATION SUMMARY ===');
        $this->info("Total recipes: {$recipes->count()}");
        $this->info("Successful: {$successful}");
        $this->info("Failed: {$failed}");
        $this->info('Migrasi selesai!');

        return 0;
    }
}
