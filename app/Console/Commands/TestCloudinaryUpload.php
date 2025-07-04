<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Cloudinary\Configuration\Configuration;
use Exception;

class TestCloudinaryUpload extends Command
{
    protected $signature = 'test:cloudinary-upload';
    protected $description = 'Test Cloudinary upload functionality';

    public function handle()
    {
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

        // Test file path
        $testFile = public_path('favicon.ico');
        
        if (!file_exists($testFile)) {
            $this->error('Test file not found: ' . $testFile);
            return 1;
        }

        $this->info('Uploading test file: ' . $testFile);

        try {
            $result = Cloudinary::upload($testFile, [
                'folder' => 'test',
                'public_id' => 'test_upload_' . time()
            ]);

            $this->info('✓ Upload successful!');
            $this->info('URL: ' . $result->getSecurePath());
            $this->info('Public ID: ' . $result->getPublicId());
            
            return 0;
        } catch (Exception $e) {
            $this->error('✗ Upload failed: ' . $e->getMessage());
            $this->error('Error type: ' . get_class($e));
            return 1;
        }
    }
}