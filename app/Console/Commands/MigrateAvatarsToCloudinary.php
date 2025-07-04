<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Cloudinary\Configuration\Configuration;
use Cloudinary\Api\Upload\UploadApi;
use Exception;

class MigrateAvatarsToCloudinary extends Command
{
    protected $signature = 'migrate:avatars-to-cloudinary';
    protected $description = 'Migrate user avatars from local storage to Cloudinary';

    public function handle()
    {
        $this->info('Memulai migrasi avatar ke Cloudinary...');

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

        // Get all users with avatars, excluding OAuth Google users with default avatars
        $users = User::whereNotNull('avatar')
            ->where('avatar', '!=', '')
            ->whereNotLike('avatar', '%cloudinary.com%')
            ->whereNotLike('avatar', '%googleusercontent.com%') // Exclude Google OAuth avatars
            ->whereNotLike('avatar', '%googleapis.com%')        // Exclude Google API avatars
            ->whereNotLike('avatar', '%lh3.googleusercontent.com%') // Exclude specific Google avatar URLs
            ->get();

        $this->info("Found {$users->count()} users to migrate");

        $successful = 0;
        $failed = 0;

        foreach ($users as $user) {
            $this->info("Processing user ID {$user->id} ({$user->name}):");

            // Skip if already using Cloudinary URL
            if (str_contains($user->avatar, 'cloudinary.com')) {
                $this->info("✓ User ID {$user->id}: Already using Cloudinary");
                $successful++;
                continue;
            }

            // Fix the path - remove duplicate /storage
            $avatarPath = $user->avatar;

            // Remove leading slash and 'storage/' if present
            $avatarPath = ltrim($avatarPath, '/');
            if (str_starts_with($avatarPath, 'storage/')) {
                $avatarPath = substr($avatarPath, 8); // Remove 'storage/'
            }

            // Construct the full path
            $fullPath = storage_path('app/public/' . $avatarPath);

            if (!file_exists($fullPath)) {
                $this->warn("File not found for user ID {$user->id}: {$fullPath}");
                $failed++;
                continue;
            }

            try {
                // Method 1: Using UploadApi directly
                $uploadApi = new UploadApi();
                $uploadResult = $uploadApi->upload($fullPath, [
                    'folder' => 'avatars',
                    'public_id' => 'avatar_' . $user->id,
                    'transformation' => [
                        'quality' => 'auto:good',
                        'format' => 'auto',
                        'width' => 300,
                        'height' => 300,
                        'crop' => 'fill',
                        'gravity' => 'face'
                    ]
                ]);

                // Update user with new Cloudinary URL
                $user->update([
                    'avatar' => $uploadResult['secure_url']
                ]);

                $this->info("✓ User ID {$user->id}: SUCCESS - {$uploadResult['secure_url']}");
                $successful++;

            } catch (Exception $e) {
                // Method 2: Fallback using Storage disk
                try {
                    $fileName = 'avatar_' . $user->id . '.' . pathinfo($fullPath, PATHINFO_EXTENSION);
                    $uploaded = Storage::disk('cloudinary')->putFileAs(
                        'avatars',
                        new \Illuminate\Http\File($fullPath),
                        $fileName
                    );

                    if ($uploaded) {
                        $url = Storage::disk('cloudinary')->url($uploaded);

                        // Update user with new Cloudinary URL
                        $user->update([
                            'avatar' => $url
                        ]);

                        $this->info("✓ User ID {$user->id}: SUCCESS (Storage) - {$url}");
                        $successful++;
                    } else {
                        throw new Exception('Storage upload failed');
                    }

                } catch (Exception $e2) {
                    $this->error("✗ User ID {$user->id}: FAILED - {$e->getMessage()}");
                    $this->error("Fallback error: {$e2->getMessage()}");
                    $this->error("Error type: " . get_class($e));
                    $failed++;
                }
            }
        }

        $this->info('=== MIGRATION SUMMARY ===');
        $this->info("Total users: {$users->count()}");
        $this->info("Successful: {$successful}");
        $this->info("Failed: {$failed}");
        $this->info('Migrasi avatar selesai!');

        return 0;
    }
}