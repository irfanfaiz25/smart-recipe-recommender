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

        // Delete old avatar if exists and it's a Cloudinary URL
        if ($user->avatar) {
            $this->deleteOldAvatar($user->avatar);
        }

        // Upload new avatar to Cloudinary
        $avatarPath = $this->uploadAvatarToCloudinary($this->newAvatar);

        $user->update(['avatar' => $avatarPath]);
        $this->avatar = $avatarPath;
        $this->newAvatar = null;

        Toaster::success('Foto profil berhasil diperbarui!');
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
            return 'storage/' . $avatar->store('users', 'public');
        }
    }

    private function deleteOldAvatar($avatarUrl)
    {
        try {
            // Cek apakah ini URL Cloudinary
            if (strpos($avatarUrl, 'cloudinary.com') !== false) {
                // Extract public_id dari URL Cloudinary
                $publicId = $this->extractPublicIdFromUrl($avatarUrl);

                if ($publicId) {
                    $uploadApi = new \Cloudinary\Api\Upload\UploadApi();
                    $uploadApi->destroy($publicId);
                }
            } else {
                // Hapus dari local storage jika bukan Cloudinary
                $localPath = str_replace('storage/', '', $avatarUrl);
                if (Storage::disk('public')->exists($localPath)) {
                    Storage::disk('public')->delete($localPath);
                }
            }
        } catch (\Exception $e) {
            \Log::error('Gagal hapus avatar lama: ' . $e->getMessage());
        }
    }

    private function extractPublicIdFromUrl($url)
    {
        try {
            // Pattern untuk extract public_id dari Cloudinary URL
            // Format: https://res.cloudinary.com/cloud_name/image/upload/v1234567890/folder/public_id.ext
            $pattern = '/\/v\d+\/(.+?)\.[a-zA-Z]{3,4}$/';

            if (preg_match($pattern, $url, $matches)) {
                return $matches[1]; // Return public_id dengan folder
            }

            return null;
        } catch (\Exception $e) {
            \Log::error('Error extracting public_id: ' . $e->getMessage());
            return null;
        }
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
        $this->avatar = $user->avatar;

        if ($user->creators()) {
            $this->phone = $user->creators->phone_number ?? '';
            $this->city = $user->creators->city ?? '';
        }

        return view('livewire.admin.user-profile');
    }
}
