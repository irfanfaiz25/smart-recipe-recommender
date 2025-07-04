<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Exception;

class TestCloudinaryCredentials extends Command
{
    protected $signature = 'test:cloudinary-credentials';
    protected $description = 'Test Cloudinary credentials and upload';

    public function handle()
    {
        $this->info('Testing Cloudinary credentials...');

        // Get credentials
        $cloudName = env('CLOUDINARY_CLOUD_NAME');
        $apiKey = env('CLOUDINARY_API_KEY');
        $apiSecret = env('CLOUDINARY_API_SECRET');

        // Validate credentials
        if (!$cloudName || !$apiKey || !$apiSecret) {
            $this->error('❌ Missing Cloudinary credentials in .env:');
            $this->error('CLOUDINARY_CLOUD_NAME: ' . ($cloudName ? '✓' : '❌'));
            $this->error('CLOUDINARY_API_KEY: ' . ($apiKey ? '✓' : '❌'));
            $this->error('CLOUDINARY_API_SECRET: ' . ($apiSecret ? '✓' : '❌'));
            return 1;
        }

        $this->info('✅ All credentials found:');
        $this->info("Cloud Name: {$cloudName}");
        $this->info("API Key: {$apiKey}");
        $this->info('API Secret: ' . str_repeat('*', strlen($apiSecret)));

        // Test file
        $testFile = public_path('favicon.ico');

        if (!file_exists($testFile)) {
            $this->error('❌ Test file not found: ' . $testFile);
            return 1;
        }

        $this->info('✅ Test file found: ' . $testFile);
        $this->info('File size: ' . number_format(filesize($testFile)) . ' bytes');

        // Test upload
        try {
            $this->info('🚀 Testing upload to Cloudinary...');

            $ch = curl_init();

            $uploadData = [
                'file' => new \CURLFile($testFile),
                'folder' => 'test',
                'public_id' => 'test_credentials_' . time()
            ];

            curl_setopt_array($ch, [
                CURLOPT_URL => "https://api.cloudinary.com/v1_1/{$cloudName}/image/upload",
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => $uploadData,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_USERPWD => $apiKey . ':' . $apiSecret,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_VERBOSE => false
            ]);

            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $error = curl_error($ch);
            curl_close($ch);

            if ($error) {
                throw new Exception("cURL Error: {$error}");
            }

            if ($httpCode === 200) {
                $result = json_decode($response, true);

                if (isset($result['secure_url'])) {
                    $this->info('🎉 Upload successful!');
                    $this->info('📷 Image URL: ' . $result['secure_url']);
                    $this->info('🆔 Public ID: ' . $result['public_id']);
                    $this->info('📏 Dimensions: ' . $result['width'] . 'x' . $result['height']);
                    $this->info('💾 Size: ' . number_format($result['bytes']) . ' bytes');
                    return 0;
                } else {
                    throw new Exception('No secure_url in response');
                }
            } else {
                $errorData = json_decode($response, true);
                $errorMessage = isset($errorData['error']['message'])
                    ? $errorData['error']['message']
                    : "HTTP {$httpCode}";
                throw new Exception($errorMessage);
            }

        } catch (Exception $e) {
            $this->error('❌ Upload failed: ' . $e->getMessage());

            if (isset($response)) {
                $this->error('Response: ' . substr($response, 0, 500));
            }

            return 1;
        }
    }
}