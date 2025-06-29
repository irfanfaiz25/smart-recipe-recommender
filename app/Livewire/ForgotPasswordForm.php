<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\RateLimiter;
use Livewire\Component;
use Masmerise\Toaster\Toaster;
use Illuminate\Support\Facades\Log;

class ForgotPasswordForm extends Component
{
    public $email = '';
    public $emailSent = false;
    public $isLoading = false;

    protected $rules = [
        'email' => 'required|email|exists:users,email'
    ];

    protected $messages = [
        'email.required' => 'Email wajib diisi.',
        'email.email' => 'Format email tidak valid.',
        'email.exists' => 'Email tidak terdaftar dalam sistem.'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function sendResetLink()
    {
        $this->validate();

        // Rate limiting - max 3 attempts per 5 minutes
        $key = 'password-reset:' . $this->email;

        if (RateLimiter::tooManyAttempts($key, 3)) {
            $seconds = RateLimiter::availableIn($key);
            $minutes = ceil($seconds / 60);
            Toaster::error("Terlalu banyak percobaan. Coba lagi dalam {$minutes} menit.");
            return;
        }

        $this->isLoading = true;

        try {
            // Check if user exists and is OAuth user
            $user = User::where('email', $this->email)->first();

            if (!$user) {
                RateLimiter::hit($key, 300);
                Toaster::error('Email tidak ditemukan dalam sistem.');
                Log::warning('Password reset attempted for non-existent email', [
                    'email' => $this->email,
                    'ip' => request()->ip()
                ]);
                return;
            }

            if ($user->is_oauth_user && !$user->is_password_changed) {
                RateLimiter::hit($key, 300);
                Toaster::error('Akun OAuth yang belum mengatur password tidak dapat melakukan reset password. Silakan login menggunakan ' . ucfirst($user->oauth_provider ?? 'OAuth') . ' atau atur password terlebih dahulu di pengaturan akun.');
                Log::info('Password reset blocked for OAuth user without password', [
                    'email' => $this->email,
                    'oauth_provider' => $user->oauth_provider,
                    'is_password_changed' => $user->is_password_changed,
                    'ip' => request()->ip()
                ]);
                return;
            }

            // Send password reset link
            $status = Password::sendResetLink(
                ['email' => $this->email]
            );

            Log::info('Password reset status', [
                'email' => $this->email,
                'status' => $status,
                'expected_status' => Password::RESET_LINK_SENT
            ]);

            if ($status === Password::RESET_LINK_SENT) {
                $this->emailSent = true;
                RateLimiter::hit($key, 300); // 5 minutes

                // Log successful attempt
                Log::info('Password reset link sent successfully', [
                    'email' => $this->email,
                    'ip' => request()->ip(),
                    'user_agent' => request()->userAgent()
                ]);

                Toaster::success('Link reset password telah dikirim ke email Anda. Silakan cek inbox atau folder spam.');
            } else {
                RateLimiter::hit($key, 300);

                // Log different status responses
                $errorMessage = match ($status) {
                    Password::INVALID_USER => 'Email tidak ditemukan',
                    Password::INVALID_TOKEN => 'Token tidak valid',
                    default => 'Status tidak dikenal: ' . $status
                };

                Log::warning('Password reset failed', [
                    'email' => $this->email,
                    'status' => $status,
                    'error_message' => $errorMessage
                ]);

                Toaster::error('Gagal mengirim link reset password: ' . $errorMessage);
            }
        } catch (\Exception $e) {
            Log::error('Password reset exception', [
                'email' => $this->email,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);

            Toaster::error('Terjadi kesalahan sistem: ' . $e->getMessage());
        } finally {
            $this->isLoading = false;
        }
    }

    public function resetForm()
    {
        $this->reset(['email', 'emailSent']);
        $this->resetErrorBag();
    }

    public function render()
    {
        return view('livewire.forgot-password-form');
    }
}
