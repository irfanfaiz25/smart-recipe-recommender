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
                            <img src="{{ $avatar }}" alt="Profile" class="w-full h-full object-cover">
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
        <div class="border-b border-gray-200 dark:border-bg-dark-secondary overflow-x-auto">
            <nav class="-mb-px flex flex-nowrap md:flex-wrap px-4 md:px-6">
                <button wire:click="setActiveTab('profile')"
                    class="flex-shrink-0 py-4 px-3 md:px-1 border-b-2 font-medium text-sm whitespace-nowrap {{ $activeTab === 'profile' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 dark:text-gray-100 hover:text-gray-700 dark:hover:text-gray-100 hover:border-gray-300' }}">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        <span>Profil</span>
                    </div>
                </button>
                <button wire:click="setActiveTab('security')"
                    class="flex-shrink-0 py-4 px-3 md:px-1 ml-4 md:ml-8 border-b-2 font-medium text-sm whitespace-nowrap {{ $activeTab === 'security' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 dark:text-gray-100 hover:text-gray-700 dark:hover:text-gray-100 hover:border-gray-300' }}">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                            </path>
                        </svg>
                        <span>Keamanan</span>
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
                        <span>Preferensi</span>
                    </div>
                </button> --}}
                <button wire:click="setActiveTab('avatar')"
                    class="flex-shrink-0 py-4 px-3 md:px-1 ml-4 md:ml-8 border-b-2 font-medium text-sm whitespace-nowrap {{ $activeTab === 'avatar' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 dark:text-gray-100 hover:text-gray-700 dark:hover:text-gray-100 hover:border-gray-300' }}">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span>Foto Profil</span>
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
                        </div>
                        @if ($user->creators)
                            <div>
                                <label for="phone"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-100 mb-2">Nomor
                                    Telepon</label>
                                <input type="text" id="phone" wire:model="phone"
                                    class="w-full px-3 py-2 text-sm font-medium text-gray-900 dark:text-gray-100 bg-white dark:bg-bg-dark-secondary border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                @error('phone')
                                    <span class="text-red-500 text-xs">{{ $message ?? '' }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="city"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-100 mb-2">Lokasi</label>
                                <input type="text" id="city" wire:model="city"
                                    class="w-full px-3 py-2 text-sm font-medium text-gray-900 dark:text-gray-100 bg-white dark:bg-bg-dark-secondary border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                @error('city')
                                    <span class="text-red-500 text-xs">{{ $message ?? '' }}</span>
                                @enderror
                            </div>
                        @endif
                    </div>
                    <div class="flex justify-end">
                        <button type="submit" wire:loading.attr="disabled"
                            class="bg-blue-600 text-base font-medium text-white px-6 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
                            <span wire:loading.remove wire:target='updateProfile'>Simpan Perubahan</span>
                            <span wire:loading wire:target='updateProfile'>
                                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline-block"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                        stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                    </path>
                                </svg>
                                Menyimpan...
                            </span>
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
                        <button type="submit" wire:loading.attr="disabled"
                            class="bg-blue-600 text-base font-medium text-white px-6 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
                            <span wire:loading.remove wire:target='updatePassword'>Update Password</span>
                            <span wire:loading wire:target='updatePassword'>
                                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline-block"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                        stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                    </path>
                                </svg>
                                Menyimpan...
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        @endif

        <!-- Avatar Tab -->
        @if ($activeTab === 'avatar')
            <div class="p-6">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-6">Foto Profil</h2>
                <div class="space-y-6">
                    <div
                        class="flex flex-col md:flex-row items-start md:items-center space-y-4 md:space-y-0 md:space-x-6">
                        <!-- Avatar Display -->
                        <div class="flex-shrink-0">
                            <div class="w-24 h-24 md:w-32 md:h-32 rounded-full overflow-hidden bg-gray-200 relative">
                                @if ($avatar)
                                    <img src="{{ $avatar }}" alt="Profile"
                                        class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-400">
                                        <svg class="w-8 h-8 md:w-16 md:h-16" fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                                        </svg>
                                    </div>
                                @endif

                                <!-- Loading overlay for avatar -->
                                <div wire:loading wire:target="updateAvatar"
                                    class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center rounded-full">
                                    <svg class="animate-spin h-8 w-8 text-white" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10"
                                            stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor"
                                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Upload Form -->
                        <div class="flex-1 w-full">
                            <h3 class="text-sm font-medium text-gray-900 dark:text-gray-100 mb-2">Upload Foto Baru</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">
                                Format yang didukung: JPG, PNG, GIF. Maksimal 2MB.
                            </p>

                            <form wire:submit.prevent="updateAvatar" class="space-y-4">
                                <!-- File Input -->
                                <div class="relative">
                                    <input type="file" wire:model="newAvatar" accept="image/*"
                                        class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-blue-900 dark:file:text-blue-300 dark:hover:file:bg-blue-800 transition-colors disabled:opacity-50 disabled:cursor-not-allowed"
                                        wire:loading.attr="disabled" wire:target="updateAvatar">

                                    <!-- File input loading state -->
                                    <div wire:loading wire:target="newAvatar"
                                        class="absolute inset-0 bg-white bg-opacity-75 dark:bg-gray-800 dark:bg-opacity-75 flex items-center justify-center rounded-md">
                                        <div class="flex items-center space-x-2">
                                            <svg class="animate-spin h-4 w-4 text-blue-600"
                                                xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24">
                                                <circle class="opacity-25" cx="12" cy="12" r="10"
                                                    stroke="currentColor" stroke-width="4"></circle>
                                                <path class="opacity-75" fill="currentColor"
                                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                                </path>
                                            </svg>
                                            <span class="text-sm text-gray-600 dark:text-gray-300">Memproses
                                                file...</span>
                                        </div>
                                    </div>
                                </div>

                                @error('newAvatar')
                                    <span class="text-red-500 text-sm block">{{ $message }}</span>
                                @enderror

                                <!-- Submit Button -->
                                <div class="flex justify-start">
                                    <button type="submit"
                                        class="relative bg-blue-600 text-white px-6 py-2 text-sm font-medium rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed transition-all duration-200"
                                        wire:loading.attr="disabled" wire:target="updateAvatar"
                                        @if (!$newAvatar) disabled @endif>

                                        <!-- Button content -->
                                        <span wire:loading.remove wire:target='updateAvatar'
                                            class="flex items-center space-x-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                                </path>
                                            </svg>
                                            <span>Upload Foto</span>
                                        </span>

                                        <!-- Loading state -->
                                        <span wire:loading wire:target='updateAvatar'
                                            class="flex items-center space-x-2">
                                            <svg class="animate-spin h-4 w-4 text-white"
                                                xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24">
                                                <circle class="opacity-25" cx="12" cy="12" r="10"
                                                    stroke="currentColor" stroke-width="4"></circle>
                                                <path class="opacity-75" fill="currentColor"
                                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                                </path>
                                            </svg>
                                            <span>Mengupload...</span>
                                        </span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Preview Section -->
                    @if ($newAvatar)
                        <div
                            class="border border-gray-200 dark:border-gray-700 rounded-lg p-4 bg-gray-50 dark:bg-gray-800">
                            <h4 class="text-sm font-medium text-gray-900 dark:text-gray-100 mb-3">Preview Foto Baru
                            </h4>
                            <div class="flex items-center space-x-4">
                                <div
                                    class="w-16 h-16 md:w-20 md:h-20 rounded-full overflow-hidden bg-gray-200 relative">
                                    <img src="{{ $newAvatar->temporaryUrl() }}" alt="Preview"
                                        class="w-full h-full object-cover">

                                    <!-- Preview loading overlay -->
                                    <div wire:loading wire:target="updateAvatar"
                                        class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center rounded-full">
                                        <svg class="animate-spin h-4 w-4 text-white"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10"
                                                stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor"
                                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                            </path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Foto ini akan menggantikan foto
                                        profil Anda saat ini.</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Upload Progress Indicator -->
                    <div wire:loading wire:target="updateAvatar"
                        class="bg-blue-50 dark:bg-blue-900 border border-blue-200 dark:border-blue-700 rounded-lg p-4">
                        <div class="flex items-center space-x-3">
                            <svg class="animate-spin h-5 w-5 text-blue-600" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10"
                                    stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                            <div>
                                <p class="text-sm font-medium text-blue-800 dark:text-blue-200">Sedang mengupload foto
                                    profil...</p>
                                <p class="text-xs text-blue-600 dark:text-blue-300">Mohon tunggu, jangan menutup
                                    halaman ini.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
