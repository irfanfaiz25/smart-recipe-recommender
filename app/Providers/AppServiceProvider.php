<?php

namespace App\Providers;

use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Force Cloudinary configuration at boot time
        if (env('CLOUDINARY_URL')) {
            // Set Cloudinary environment variable
            putenv('CLOUDINARY_URL=' . env('CLOUDINARY_URL'));

            // Force configuration values
            config([
                'cloudinary.cloud_url' => env('CLOUDINARY_URL'),
                'filesystems.disks.cloudinary.driver' => 'cloudinary',
                'filesystems.disks.cloudinary.api_key' => env('CLOUDINARY_API_KEY'),
                'filesystems.disks.cloudinary.api_secret' => env('CLOUDINARY_API_SECRET'),
                'filesystems.disks.cloudinary.cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
            ]);

            // Try to initialize Cloudinary configuration
            try {
                \Cloudinary\Configuration\Configuration::instance([
                    'cloud' => [
                        'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                        'api_key' => env('CLOUDINARY_API_KEY'),
                        'api_secret' => env('CLOUDINARY_API_SECRET'),
                    ],
                    'url' => [
                        'secure' => true
                    ]
                ]);
            } catch (\Exception $e) {
                // Silent fail, will be handled in commands
            }
        }

        // Listen for login events and update last_login_at
        Event::listen(Login::class, function (Login $event) {
            $event->user->update([
                'last_login_at' => now()
            ]);
        });
    }
}
