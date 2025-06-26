<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Masmerise\Toaster\Toaster;

class UserProfile extends Component
{
    use WithFileUploads;

    // Profile Information
    public $user;
    public $name;
    public $email;
    public $phone;
    public $city;
    public $avatar;
    public $newAvatar;

    // Password Change
    public $current_password;
    public $new_password;
    public $new_password_confirmation;

    // Active Tab
    public $activeTab = 'profile';

    protected $queryString = [
        'activeTab' => ['except' => 'profile'],
    ];

    public function setActiveTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function updateProfile()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'city' => 'nullable|string|max:255',
        ]);

        $user = Auth::user();
        $user->update([
            'name' => $this->name,
            'phone' => $this->phone,
            'city' => $this->city,
        ]);

        Toaster::success('Profil berhasil diperbarui!');
    }

    public function updateAvatar()
    {
        $this->validate([
            'newAvatar' => 'required|image|max:2048', // 2MB max
        ]);

        $user = Auth::user();

        // Delete old avatar if exists
        if ($user->avatar && Storage::disk('public')->exists($user->avatar_url)) {
            Storage::disk('public')->delete($user->avatar_url);
        }

        // Store new avatar
        $path = $this->newAvatar->store('users', 'public');

        $user->update(['avatar' => $path]);
        $this->avatar = $path;
        $this->newAvatar = null;

        Toaster::success('Foto profil berhasil diperbarui!');
    }

    public function isOauthUser($user)
    {
        return $user->is_oauth_user ?? false;
    }

    public function updatePassword()
    {
        $user = Auth::user();

        // Check if user is OAuth user (has random password)
        $isOAuthUser = $this->isOAuthUser($user);

        if ($isOAuthUser) {
            // For OAuth users, skip current password validation
            $this->validate([
                'new_password' => 'required|min:8|confirmed',
            ]);
        } else {
            // For regular users, require current password
            $this->validate([
                'current_password' => 'required',
                'new_password' => 'required|min:8|confirmed',
            ]);

            if (!Hash::check($this->current_password, $user->password)) {
                $this->addError('current_password', 'Password saat ini tidak benar.');
                return;
            }
        }

        $user->update([
            'password' => Hash::make($this->new_password),
            'is_password_changed' => true,
        ]);

        $this->reset(['current_password', 'new_password', 'new_password_confirmation']);

        if ($isOAuthUser) {
            Toaster::success('Password berhasil dibuat! Sekarang Anda dapat login dengan email dan password.');
        } else {
            Toaster::success('Password berhasil diperbarui!');
        }
    }

    public function render()
    {
        $user = Auth::user();
        $this->user = $user;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->avatar = $user->avatar_url;

        if ($user->creators()) {
            $this->phone = $user->creators->phone_number ?? '';
            $this->city = $user->creators->city ?? '';
        }

        return view('livewire.admin.user-profile');
    }
}
