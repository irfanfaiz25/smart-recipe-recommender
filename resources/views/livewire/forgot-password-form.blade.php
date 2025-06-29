<div class="bg-white bg-opacity-10 backdrop-blur-lg rounded-3xl p-8 shadow-2xl w-full max-w-md transition-all duration-300 relative"
    x-init="gsap.from($el, { opacity: 0, y: 50, duration: 1, ease: 'back' });
    gsap.from('.input-field', { opacity: 0, x: -50, stagger: 0.2, duration: 0.8, ease: 'power2.out' });
    gsap.from('.btn', { opacity: 0, scale: 0.5, duration: 0.5, delay: 1, ease: 'elastic.out(1, 0.5)' });">

    <!-- Back Button -->
    <button onclick="window.history.back()"
        class="px-4 py-2 bg-white hover:bg-gray-300 bg-opacity-50 backdrop-blur-md shadow-md text-text-primary rounded-md mb-4">
        <i class="fa fa-chevron-left text-sm"></i>
    </button>

    @if (!$emailSent)
        <!-- Header -->
        <div class="text-center mb-8">
            <div
                class="mx-auto w-16 h-16 bg-gradient-to-r from-[#FF564E] to-pink-500 rounded-full flex items-center justify-center mb-4">
                <i class="fas fa-key text-white text-2xl"></i>
            </div>
            <h2 class="text-3xl font-extrabold text-white mb-2">Lupa Password?</h2>
            <p class="text-gray-200 text-sm">Masukkan email Anda dan kami akan mengirimkan link untuk reset password</p>
        </div>

        <!-- Form -->
        <form wire:submit.prevent="sendResetLink" class="space-y-6">
            <div class="input-field relative">
                <input wire:model.live="email" type="email" id="email"
                    class="w-full px-4 py-3 pl-12 rounded-lg bg-white bg-opacity-20 focus:bg-opacity-30 text-white placeholder-gray-200 transition duration-200 border-2 border-transparent focus:border-white focus:border-opacity-50"
                    placeholder="Masukkan email Anda" :disabled="$wire.isLoading">
                <i class="fas fa-envelope absolute left-4 top-3 text-white text-lg"></i>
                @error('email')
                    <p class="mt-2 text-red-300 text-xs font-normal flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <button type="submit"
                class="btn w-full bg-gradient-to-r from-[#FF564E] to-pink-500 text-white font-bold py-3 px-4 rounded-lg hover:opacity-90 focus:ring-4 focus:ring-purple-300 transition duration-300 transform hover:scale-105 disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none"
                :disabled="$wire.isLoading">
                <span wire:loading.remove wire:target="sendResetLink">
                    Kirim Link Reset
                    <i class="fas fa-paper-plane ml-2"></i>
                </span>
                <span wire:loading wire:target="sendResetLink" class="flex items-center justify-center">
                    <i class="fas fa-spinner fa-spin text-white text-xl mr-1"></i>
                    Mengirim...
                </span>
            </button>
        </form>

        <!-- Additional Info -->
        <div class="mt-6 text-center">
            <p class="text-gray-200 text-sm mb-4">
                <i class="fas fa-info-circle mr-1"></i>
                Link reset akan dikirim ke email Anda dan berlaku selama 60 menit
            </p>
            {{-- <div class="flex justify-center space-x-4 text-xs text-gray-300">
                <span><i class="fas fa-shield-alt mr-1"></i>Aman</span>
                <span><i class="fas fa-clock mr-1"></i>Cepat</span>
                <span><i class="fas fa-lock mr-1"></i>Terpercaya</span>
            </div> --}}
        </div>
    @else
        <!-- Success State -->
        <div class="text-center">
            <div
                class="mx-auto w-20 h-20 bg-green-500 rounded-full flex items-center justify-center mb-6 animate-pulse">
                <i class="fas fa-check text-white text-3xl"></i>
            </div>
            <h2 class="text-3xl font-extrabold text-white mb-4">Email Terkirim!</h2>
            <div class="bg-white bg-opacity-20 rounded-lg p-6 mb-6">
                <p class="text-gray-200 text-sm mb-4">
                    Kami telah mengirimkan link reset password ke:
                </p>
                <p class="text-white font-semibold text-lg mb-4">{{ $email }}</p>
                <div class="text-gray-200 text-xs space-y-2">
                    <p><i class="fas fa-clock mr-2"></i>Link berlaku selama 60 menit</p>
                    <p><i class="fas fa-inbox mr-2"></i>Cek folder inbox dan spam</p>
                    <p><i class="fas fa-redo mr-2"></i>Klik link untuk reset password</p>
                </div>
            </div>

            <div class="space-y-3">
                <a href="{{ route('login') }}"
                    class="block w-full bg-gradient-to-r from-[#FF564E] to-pink-500 text-white font-bold py-3 px-4 rounded-lg hover:opacity-90 transition duration-300 text-center">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali ke Login
                </a>
            </div>
        </div>
    @endif
</div>
