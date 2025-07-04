<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Masmerise\Toaster\Toaster;

class LoginForm extends Component
{
    use WithFileUploads;

    public $avatar;
    public $name;
    public $email;
    public $password;

    public $isLogin = false;

    public function setIsLogin()
    {
        $this->reset('name', 'email', 'password', 'avatar');
        $this->isLogin = !$this->isLogin;
    }

    public function register()
    {
        $this->validate([
            'avatar' => 'nullable|mimes:png,jpg,jpeg|max:2048',
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8'
        ]);

        $avatarPath = '';
        if ($this->avatar) {
            $avatarPath = $this->uploadAvatarToCloudinary($this->avatar);
        }

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'avatar' => $avatarPath,
            'is_password_changed' => false,
        ]);

        $user->assignRole('user');

        auth()->login($user);
        $this->reset('name', 'email', 'password', 'avatar');
        $this->redirectRoute('home.index', navigate: true);
    }

    private function uploadAvatarToCloudinary($avatar)
    {
        try {
            // Upload ke Cloudinary menggunakan UploadApi
            $uploadApi = new \Cloudinary\Api\Upload\UploadApi();

            // Generate unique public_id
            $publicId = 'avatar_' . uniqid();

            $uploadResult = $uploadApi->upload($avatar->getRealPath(), [
                'folder' => 'avatars',
                'public_id' => $publicId,
                'transformation' => [
                    'quality' => 'auto:good',
                    'format' => 'auto',
                    'width' => 300,
                    'height' => 300,
                    'crop' => 'fill',
                    'gravity' => 'face'
                ]
            ]);

            return $uploadResult['secure_url'];
        } catch (\Exception $e) {
            // Fallback ke penyimpanan lokal jika Cloudinary gagal
            \Log::warning('Cloudinary upload failed, using local storage: ' . $e->getMessage());
            return 'storage/' . $avatar->store('img/users', 'public');
        }
    }

    public function login()
    {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        $user = User::where('email', $this->email)->first();

        // check if user exists
        if (!$user) {
            Toaster::error('Akun tidak terdaftar');
            $this->reset('password');
            return;
        }

        // check if password matched
        if (!Hash::check($this->password, $user->password)) {
            Toaster::error('Invalid Credentials');
            $this->reset('password');
            return;
        }

        // login and redirect
        auth()->login($user);
        $this->reset('name', 'email', 'password', 'avatar');

        if ($user->hasRole('admin')) {
            $this->redirectRoute('admin-dashboard.index');
        } else {
            $this->redirectRoute('home.index');
        }
    }


    public function render()
    {
        return view('livewire.login-form');
    }
}
