<div class="min-h-screen">
    <!-- Header -->
    <div
        class="bg-white dark:bg-bg-dark-primary rounded-lg shadow-sm border border-gray-200 dark:border-bg-dark-secondary mb-8">
        <div class="px-6 py-8">
            <div class="flex items-center space-x-6">
                <!-- Avatar -->
                <div class="relative">
                    <div class="w-24 h-24 rounded-full overflow-hidden bg-gray-200 dark:bg-gray-800">
                        @if ($avatar)
                            <img src="{{ asset($avatar) }}" alt="Profile" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-400">
                                <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                                </svg>
                            </div>
                        @endif
                    </div>
                    <button wire:click="$set('activeTab', 'avatar')"
                        class="absolute -bottom-2 -right-2 bg-blue-600 text-white rounded-full p-2 hover:bg-blue-700 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </button>
                </div>

                <!-- User Info -->
                <div class="flex-1">
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-text-dark-primary capitalize">
                        {{ $name }}</h1>
                    <p class="text-base text-gray-600 dark:text-gray-200 font-medium">{{ $email }}</p>
                    <div class="flex items-center space-x-4 mt-3 text-sm text-gray-500 dark:text-gray-100">
                        @if ($city)
                            <span class="flex items-center capitalize">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                {{ $city }}
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation Tabs -->
    <div
        class="bg-white dark:bg-bg-dark-primary rounded-lg shadow-sm border border-gray-200 dark:border-bg-dark-secondary mb-8">
        <div class="border-b border-gray-200 dark:border-bg-dark-secondary">
            <nav class="-mb-px flex space-x-8 px-6">
                <button wire:click="setActiveTab('profile')"
                    class="py-4 px-1 border-b-2 font-medium text-sm {{ $activeTab === 'profile' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 dark:text-gray-100 hover:text-gray-700 dark:hover:text-gray-100 hover:border-gray-300' }}">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Profil
                    </div>
                </button>
                <button wire:click="setActiveTab('security')"
                    class="py-4 px-1 border-b-2 font-medium text-sm {{ $activeTab === 'security' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 dark:text-gray-100 hover:text-gray-700 dark:hover:text-gray-100 hover:border-gray-300' }}">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                            </path>
                        </svg>
                        Keamanan
                    </div>
                </button>
                {{-- <button wire:click="setActiveTab('preferences')"
                    class="py-4 px-1 border-b-2 font-medium text-sm {{ $activeTab === 'preferences' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Preferensi
                    </div>
                </button> --}}
                <button wire:click="setActiveTab('avatar')"
                    class="py-4 px-1 border-b-2 font-medium text-sm {{ $activeTab === 'avatar' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 dark:text-gray-100 hover:text-gray-700 dark:hover:text-gray-100 hover:border-gray-300' }}">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Foto Profil
                    </div>
                </button>
            </nav>
        </div>
    </div>

    <!-- Tab Content -->
    <div
        class="bg-white dark:bg-bg-dark-primary rounded-lg shadow-sm border border-gray-200 dark:border-bg-dark-secondary">
        <!-- Profile Tab -->
        @if ($activeTab === 'profile')
            <div class="p-6">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-6">Informasi Profil</h2>
                <form wire:submit.prevent="updateProfile" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="name"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-100 mb-2">Nama
                                Lengkap</label>
                            <input type="text" id="name" wire:model="name"
                                class="w-full px-3 py-2 text-sm font-medium text-gray-900 dark:text-gray-100 bg-white dark:bg-bg-dark-secondary border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            @error('name')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="email"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-100 mb-2">Email</label>
                            <input type="email" id="email" wire:model="email"
                                class="w-full px-3 py-2 text-sm font-medium text-gray-900 dark:text-gray-100 bg-white dark:bg-bg-dark-secondary border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                disabled>
                            @error('email')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                        @if ($user->creators)
                            <div>
                                <label for="phone"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-100 mb-2">Nomor
                                    Telepon</label>
                                <input type="text" id="phone" wire:model="phone"
                                    class="w-full px-3 py-2 text-sm font-medium text-gray-900 dark:text-gray-100 bg-white dark:bg-bg-dark-secondary border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                @error('phone')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="city"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-100 mb-2">Lokasi</label>
                                <input type="text" id="city" wire:model="city"
                                    class="w-full px-3 py-2 text-sm font-medium text-gray-900 dark:text-gray-100 bg-white dark:bg-bg-dark-secondary border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                @error('city')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>
                        @endif
                    </div>
                    <div class="flex justify-end">
                        <button type="submit"
                            class="bg-blue-600 text-base font-medium text-white px-6 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        @endif

        <!-- Security Tab -->
        @if ($activeTab === 'security')
            <div class="p-6">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-6">Keamanan Akun</h2>
                <form wire:submit.prevent="updatePassword" class="space-y-6">
                    @if ($user->is_oauth_user && !$user->is_password_changed)
                        <p class="text-sm text-gray-600 dark:text-gray-50">
                            Perhatian: Akun Anda dibuat dengan OAuth. Perubahan password akan memaksa Anda untuk
                            membuat password baru saat login.
                        </p>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="new_password"
                                    class="block text-sm font-medium text-gray-700 mb-2">Password
                                    Baru</label>
                                <input type="password" id="new_password" wire:model="new_password"
                                    class="w-full px-3 py-2 text-sm font-medium text-gray-900 dark:text-text-dark-primary border bg-white dark:bg-bg-dark-secondary border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                @error('new_password')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="new_password_confirmation"
                                    class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password
                                    Baru</label>
                                <input type="password" id="new_password_confirmation"
                                    wire:model="new_password_confirmation"
                                    class="w-full px-3 py-2 text-sm font-medium text-gray-900 dark:text-text-dark-primary border bg-white dark:bg-bg-dark-secondary border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                        </div>
                    @else
                        <div>
                            <label for="current_password"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-50 mb-2">Password
                                Saat Ini</label>
                            <input type="password" id="current_password" wire:model="current_password"
                                class="w-full px-3 py-2 text-sm font-medium text-gray-900 dark:text-text-dark-primary border bg-white dark:bg-bg-dark-secondary border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            @error('current_password')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="new_password"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-50 mb-2">Password
                                    Baru</label>
                                <input type="password" id="new_password" wire:model="new_password"
                                    class="w-full px-3 py-2 text-sm font-medium text-gray-900 dark:text-text-dark-primary border bg-white dark:bg-bg-dark-secondary border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                @error('new_password')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="new_password_confirmation"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-50 mb-2">Konfirmasi
                                    Password
                                    Baru</label>
                                <input type="password" id="new_password_confirmation"
                                    wire:model="new_password_confirmation"
                                    class="w-full px-3 py-2 text-sm font-medium text-gray-900 dark:text-text-dark-primary border bg-white dark:bg-bg-dark-secondary border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                        </div>
                    @endif
                    <div class="bg-yellow-50 dark:bg-yellow-900 border border-yellow-200 rounded-md p-4">
                        <div class="flex">
                            <svg class="w-5 h-5 text-yellow-400 dark:text-yellow-500 mr-3 mt-0.5" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <div>
                                <h3 class="text-sm font-medium text-yellow-800 dark:text-yellow-50">Tips Keamanan</h3>
                                <p class="text-sm font-normal text-yellow-700 dark:text-yellow-400 mt-1">Gunakan
                                    password yang kuat
                                    dengan
                                    kombinasi
                                    huruf besar, huruf kecil, angka, dan simbol. Minimal 8 karakter.</p>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit"
                            class="bg-blue-600 text-base font-medium text-white px-6 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
                            Update Password
                        </button>
                    </div>
                </form>
            </div>
        @endif

        <!-- Preferences Tab -->
        {{-- @if ($activeTab === 'preferences')
            <div class="p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-6">Preferensi</h2>
                <form wire:submit.prevent="updatePreferences" class="space-y-6">
                    <div class="space-y-4">
                        <h3 class="text-md font-medium text-gray-900">Notifikasi</h3>
                        <div class="space-y-3">
                            <label class="flex items-center">
                                <input type="checkbox" wire:model="email_notifications"
                                    class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                <span class="ml-3 text-sm text-gray-700">Notifikasi Email</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" wire:model="push_notifications"
                                    class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                <span class="ml-3 text-sm text-gray-700">Notifikasi Push</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" wire:model="recipe_recommendations"
                                    class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                <span class="ml-3 text-sm text-gray-700">Rekomendasi Resep</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" wire:model="newsletter"
                                    class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                <span class="ml-3 text-sm text-gray-700">Newsletter</span>
                            </label>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <h3 class="text-md font-medium text-gray-900">Privasi</h3>
                        <div class="space-y-3">
                            <label class="flex items-center">
                                <input type="checkbox" wire:model="privacy_mode"
                                    class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                <span class="ml-3 text-sm text-gray-700">Mode Privasi (Sembunyikan profil dari
                                    pencarian)</span>
                            </label>
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit"
                            class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
                            Simpan Preferensi
                        </button>
                    </div>
                </form>
            </div>
        @endif --}}

        <!-- Avatar Tab -->
        @if ($activeTab === 'avatar')
            <div class="p-6">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-6">Foto Profil</h2>
                <div class="space-y-6">
                    <div class="flex items-center space-x-6">
                        <div class="w-32 h-32 rounded-full overflow-hidden bg-gray-200">
                            @if ($avatar)
                                <img src="{{ asset($avatar) }}" alt="Profile" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-400">
                                    <svg class="w-16 h-16" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <div class="flex-1">
                            <h3 class="text-sm font-medium text-gray-900 dark:text-gray-100 mb-2">Upload Foto Baru</h3>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-4">Format yang didukung:
                                JPG, PNG, GIF.
                                Maksimal
                                2MB.
                            </p>
                            <form wire:submit.prevent="updateAvatar">
                                <div class="flex items-center space-x-4">
                                    <input type="file" wire:model="newAvatar" accept="image/*"
                                        class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                                    <button type="submit"
                                        class="bg-blue-600 text-white px-4 py-2 text-base font-medium rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors"
                                        {{ !$newAvatar ? 'disabled' : '' }}>
                                        Upload
                                    </button>
                                </div>
                                @error('newAvatar')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </form>
                        </div>
                    </div>

                    @if ($newAvatar)
                        <div class="border border-gray-200 rounded-lg p-4">
                            <h4 class="text-sm font-medium text-gray-900 mb-2">Preview</h4>
                            <div class="w-24 h-24 rounded-full overflow-hidden bg-gray-200">
                                <img src="{{ $newAvatar->temporaryUrl() }}" alt="Preview"
                                    class="w-full h-full object-cover">
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @endif
    </div>
</div>
