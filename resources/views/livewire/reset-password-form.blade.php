<div class="min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md bg-white bg-opacity-10 backdrop-blur-md rounded-2xl shadow-2xl p-8 border border-white border-opacity-20"
        x-data="{ showPassword: @entangle('showPassword'), showPasswordConfirmation: @entangle('showPasswordConfirmation') }" x-init="gsap.from($el, { opacity: 0, y: 50, duration: 1, ease: 'back' });
        gsap.from('.input-field', { opacity: 0, x: -50, stagger: 0.2, duration: 0.8, ease: 'power2.out' });
        gsap.from('.btn', { opacity: 0, scale: 0.5, duration: 0.5, delay: 1, ease: 'elastic.out(1, 0.5)' });">

        <!-- Back Button -->
        <button onclick="window.history.back()"
            class="px-4 py-2 bg-white hover:bg-gray-300 bg-opacity-50 backdrop-blur-md shadow-md text-text-primary rounded-md mb-4">
            <i class="fa fa-chevron-left text-sm"></i>
        </button>

        @if (!$passwordReset)
            <!-- Header -->
            <div class="text-center mb-8">
                <div
                    class="mx-auto w-16 h-16 bg-gradient-to-r from-[#FF564E] to-pink-500 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-lock text-white text-2xl"></i>
                </div>
                <h2 class="text-3xl font-extrabold text-white mb-2">Reset Password</h2>
                <p class="text-gray-200 text-sm">Masukkan password baru Anda untuk mengamankan akun</p>
            </div>

            <!-- Form -->
            <form wire:submit.prevent="resetPassword" class="space-y-6">
                <!-- Email Field -->
                <div class="input-field relative">
                    <input wire:model.live="email" type="email" id="email"
                        class="w-full px-4 py-3 pl-12 rounded-lg bg-white bg-opacity-20 focus:bg-opacity-30 text-white placeholder-gray-200 transition duration-200 border-2 border-transparent focus:border-white focus:border-opacity-50"
                        placeholder="Email Anda" :disabled="$wire.isLoading">
                    <i class="fas fa-envelope absolute left-4 top-3 text-white text-lg"></i>
                    @error('email')
                        <p class="mt-2 text-red-300 text-xs font-normal flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Password Field -->
                <div class="input-field relative">
                    <input wire:model.live="password" :type="showPassword ? 'text' : 'password'" id="password"
                        class="w-full px-4 py-3 pl-12 pr-12 rounded-lg bg-white bg-opacity-20 focus:bg-opacity-30 text-white placeholder-gray-200 transition duration-200 border-2 border-transparent focus:border-white focus:border-opacity-50"
                        placeholder="Password Baru" :disabled="$wire.isLoading">
                    <i class="fas fa-key absolute left-4 top-3 text-white text-lg"></i>
                    @error('password')
                        @if (!str_contains($message, 'Konfirmasi password tidak cocok'))
                            <p class="mt-2 text-red-300 text-xs font-normal flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </p>
                        @endif
                    @enderror
                </div>

                <!-- Password Confirmation Field -->
                <div class="input-field relative">
                    <input wire:model.live="password_confirmation"
                        :type="showPasswordConfirmation ? 'text' : 'password'" id="password_confirmation"
                        class="w-full px-4 py-3 pl-12 pr-12 rounded-lg bg-white bg-opacity-20 focus:bg-opacity-30 text-white placeholder-gray-200 transition duration-200 border-2 border-transparent focus:border-white focus:border-opacity-50"
                        placeholder="Konfirmasi Password Baru" :disabled="$wire.isLoading">
                    <i class="fas fa-shield-alt absolute left-4 top-3 text-white text-lg"></i>
                    @error('password_confirmation')
                        <p class="mt-2 text-red-300 text-xs font-normal flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>
                            {{ $message }}
                        </p>
                    @enderror
                    @error('password')
                        @if (str_contains($message, 'Konfirmasi password tidak cocok'))
                            <p class="mt-2 text-red-300 text-xs font-normal flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </p>
                        @endif
                    @enderror
                </div>

                <!-- Password Requirements -->
                <div class="bg-white bg-opacity-10 rounded-lg p-4">
                    <p class="text-gray-200 text-xs mb-2 font-semibold">
                        <i class="fas fa-info-circle mr-1"></i>
                        Persyaratan Password:
                    </p>
                    <ul class="text-gray-300 text-xs space-y-1">
                        <li class="flex items-center">
                            <i class="fas fa-check-circle mr-2"
                                :class="$wire.password && $wire.password.length >= 8 ? 'text-green-400' : 'text-gray-500'"></i>
                            Minimal 8 karakter
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check-circle mr-2"
                                :class="$wire.password && $wire.password_confirmation && $wire.password === $wire
                                    .password_confirmation && $wire.password.length > 0 ? 'text-green-400' :
                                    'text-gray-500'"></i>
                            Password dan konfirmasi harus sama
                        </li>
                    </ul>
                </div>

                <button type="submit"
                    class="btn w-full bg-gradient-to-r from-[#FF564E] to-pink-500 text-white font-bold py-3 px-4 rounded-lg hover:opacity-90 focus:ring-4 focus:ring-purple-300 transition duration-300 transform hover:scale-105 disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none"
                    :disabled="$wire.isLoading">
                    <span wire:loading.remove wire:target="resetPassword">
                        Reset Password
                        <i class="fas fa-check ml-2"></i>
                    </span>
                    <span wire:loading wire:target="resetPassword" class="flex items-center justify-center">
                        <i class="fas fa-spinner fa-spin text-white text-xl mr-1"></i>
                        Mereset Password...
                    </span>
                </button>
            </form>

            <!-- Security Info -->
            <div class="mt-6 text-center">
                <p class="text-gray-200 text-sm mb-4">
                    <i class="fas fa-shield-alt mr-1"></i>
                    Password Anda akan dienkripsi dengan aman
                </p>
                <div class="flex justify-center space-x-4 text-xs text-gray-300">
                    <span><i class="fas fa-lock mr-1"></i>Aman</span>
                    <span><i class="fas fa-key mr-1"></i>Terenkripsi</span>
                    <span><i class="fas fa-shield-alt mr-1"></i>Terlindungi</span>
                </div>
            </div>
        @else
            <!-- Success State -->
            <div class="text-center">
                <div
                    class="mx-auto w-20 h-20 bg-green-500 rounded-full flex items-center justify-center mb-6 animate-pulse">
                    <i class="fas fa-check text-white text-3xl"></i>
                </div>
                <h2 class="text-3xl font-extrabold text-white mb-4">Password Berhasil Direset!</h2>
                <div class="bg-white bg-opacity-20 rounded-lg p-6 mb-6">
                    <p class="text-gray-200 text-sm mb-4">
                        Password Anda telah berhasil direset. Sekarang Anda dapat login dengan password baru.
                    </p>
                    <div class="text-gray-200 text-xs space-y-2">
                        <p><i class="fas fa-check-circle mr-2 text-green-400"></i>Password telah diperbarui</p>
                        <p><i class="fas fa-shield-alt mr-2 text-green-400"></i>Akun Anda aman</p>
                        <p><i class="fas fa-sign-in-alt mr-2 text-green-400"></i>Silakan login dengan password baru</p>
                    </div>
                </div>

                <div class="space-y-3">
                    <a href="{{ route('login') }}"
                        class="block w-full bg-gradient-to-r from-[#FF564E] to-pink-500 text-white font-bold py-3 px-4 rounded-lg hover:opacity-90 transition duration-300 text-center">
                        <i class="fas fa-sign-in-alt mr-2"></i>
                        Login Sekarang
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
