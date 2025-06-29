<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Livewire\Component;
use Masmerise\Toaster\Toaster;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules;

class ResetPasswordForm extends Component
{
    public $token;
    public $email = '';
    public $password = '';
    public $password_confirmation = '';
    public $isLoading = false;
    public $passwordReset = false;
    public $showPassword = false;
    public $showPasswordConfirmation = false;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
        'password_confirmation' => 'required'
    ];

    protected $messages = [
        'email.required' => 'Email wajib diisi.',
        'email.email' => 'Format email tidak valid.',
        'password.required' => 'Password wajib diisi.',
        'password.min' => 'Password minimal 8 karakter.',
        'password.confirmed' => 'Konfirmasi password tidak cocok.',
        'password_confirmation.required' => 'Konfirmasi password wajib diisi.'
    ];

    public function mount($token)
    {
        $this->token = $token;

        // Get email from token if available
        $email = request()->query('email');
        if ($email) {
            $this->email = $email;
        }
    }

    public function updated($propertyName)
    {
        // Clear errors for password confirmation when either password field changes
        if ($propertyName === 'password' || $propertyName === 'password_confirmation') {
            $this->resetErrorBag(['password', 'password_confirmation']);

            // Only validate if both fields have values
            if (!empty($this->password) && !empty($this->password_confirmation)) {
                $this->validateOnly($propertyName);
            } elseif ($propertyName === 'password' && !empty($this->password)) {
                // Validate password field only (without confirmation) if password_confirmation is empty
                $this->validateOnly('password', [
                    'password' => 'required|min:8'
                ]);
            }
        } else {
            $this->validateOnly($propertyName);
        }
    }

    public function togglePasswordVisibility()
    {
        $this->showPassword = !$this->showPassword;
    }

    public function togglePasswordConfirmationVisibility()
    {
        $this->showPasswordConfirmation = !$this->showPasswordConfirmation;
    }

    public function resetPassword()
    {
        $this->validate();

        $this->isLoading = true;

        try {
            $status = Password::reset(
                [
                    'email' => $this->email,
                    'password' => $this->password,
                    'password_confirmation' => $this->password_confirmation,
                    'token' => $this->token,
                ],
                function (User $user, string $password) {
                    $user->forceFill([
                        'password' => Hash::make($password)
                    ])->setRememberToken(Str::random(60));

                    $user->save();

                    event(new PasswordReset($user));
                }
            );

            if ($status === Password::PASSWORD_RESET) {
                Log::info('Password reset successful', [
                    'email' => $this->email,
                    'ip' => request()->ip(),
                    'user_agent' => request()->userAgent()
                ]);

                $this->passwordReset = true;
                Toaster::success('Password berhasil direset! Silakan login dengan password baru Anda.');
            } else {
                Log::warning('Password reset failed', [
                    'email' => $this->email,
                    'status' => $status,
                    'ip' => request()->ip()
                ]);

                $this->addError('email', $this->getErrorMessage($status));
                Toaster::error('Gagal mereset password. ' . $this->getErrorMessage($status));
            }
        } catch (\Exception $e) {
            Log::error('Password reset exception', [
                'email' => $this->email,
                'error' => $e->getMessage(),
                'ip' => request()->ip()
            ]);

            Toaster::error('Terjadi kesalahan sistem. Silakan coba lagi.');
        } finally {
            $this->isLoading = false;
        }
    }

    private function getErrorMessage($status)
    {
        return match ($status) {
            Password::INVALID_TOKEN => 'Token reset password tidak valid atau sudah kedaluwarsa.',
            Password::INVALID_USER => 'Email tidak ditemukan dalam sistem.',
            'throttled' => 'Terlalu banyak percobaan. Silakan coba lagi nanti.',
            default => 'Terjadi kesalahan. Silakan coba lagi.'
        };
    }

    public function render()
    {
        return view('livewire.reset-password-form');
    }
}
