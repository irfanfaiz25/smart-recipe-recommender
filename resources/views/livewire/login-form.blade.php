<div x-data="{ email: '', password: '', name: '' }"
    class="bg-white bg-opacity-10 backdrop-blur-lg rounded-3xl p-8 shadow-2xl w-full max-w-md transition-all duration-300"
    x-init="gsap.from($el, { opacity: 0, y: 50, duration: 1, ease: 'back' });
    gsap.from('.input-field', { opacity: 0, x: -50, stagger: 0.2, duration: 0.8, ease: 'power2.out' });
    gsap.from('.btn', { opacity: 0, scale: 0.5, duration: 0.5, delay: 1, ease: 'elastic.out(1, 0.5)' });">
    <h2 class="text-4xl font-extrabold text-white mb-10 text-center">{{ $isLogin ? 'Login' : 'Register' }}</h2>
    <form wire:submit.prevent="{{ $isLogin ? 'login' : 'register' }}" class="space-y-6">
        @if (!$isLogin)
            <div class="w-full justify-center flex items-center">
                <div class="w-1/4">
                    @if ($avatar)
                        <img src="{{ $avatar->temporaryUrl() }}" alt="user-avatar"
                            class="h-[4.5rem] w-[4.5rem] object-cover rounded-full border-2 border-gray-50 ">
                    @else
                        <div
                            class="h-[4.5rem] w-[4.5rem] rounded-full bg-gray-500 border-2 border-gray-50 flex justify-center items-center">
                            <i class="fa-regular fa-image text-lg text-gray-300"></i>
                        </div>
                    @endif
                </div>
                <div class="w-2/3">
                    <input type="file" wire:model='avatar'
                        class="block w-full text-sm text-white file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-white file:bg-opacity-20 file:text-white hover:file:bg-opacity-30 cursor-pointer">
                    @error('avatar')
                        <p class="mt-1 text-red-500 text-xs font-normal">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>
        @endif
        @if (!$isLogin)
            <div class="input-field relative">
                <input wire:model='name' type="text" id="name"
                    class="w-full px-4 py-3 rounded-lg bg-white bg-opacity-20 focus:bg-opacity-30 text-white placeholder-gray-200 transition duration-200"
                    placeholder="Name">
                <i class="fas fa-user absolute right-3 top-3 text-white"></i>
                @error('name')
                    <p class="mt-1 text-red-500 text-xs font-normal">
                        {{ $message ?? '' }}
                    </p>
                @enderror
            </div>
        @endif
        <div class="input-field relative">
            <input wire:model='email' type="email" id="email"
                class="w-full px-4 py-3 rounded-lg bg-white bg-opacity-20 focus:bg-opacity-30 text-white placeholder-gray-200 transition duration-200"
                placeholder="Email Address">
            <i class="fas fa-envelope absolute right-3 top-3 text-white"></i>
            @error('email')
                <p class="mt-1 text-red-500 text-xs font-normal">
                    {{ $message }}
                </p>
            @enderror
        </div>
        <div class="input-field relative">
            <input wire:model='password' type="password" id="password"
                class="w-full px-4 py-3 rounded-lg bg-white bg-opacity-20 focus:bg-opacity-30 text-white placeholder-gray-200 transition duration-200"
                placeholder="Password">
            <i class="fas fa-lock absolute right-3 top-3 text-white"></i>
            @error('password')
                <p class="mt-1 text-red-500 text-xs font-normal">
                    {{ $message }}
                </p>
            @enderror
        </div>
        <button type="submit"
            class="w-full bg-gradient-to-r from-[#FF564E] to-pink-500 text-white font-bold py-3 px-4 rounded-lg hover:opacity-90 focus:ring-4 focus:ring-purple-300 transition duration-300 transform hover:scale-105">
            {{ $isLogin ? 'Login' : 'Daftar' }}
            <i class="fas fa-arrow-right ml-2"></i>
        </button>
    </form>
    <p class="text-white text-center mt-6">
        Sudah punya akun?
        <span wire:click='setIsLogin' class="font-bold hover:underline cursor-pointer">
            {{ $isLogin ? 'Daftar' : 'Login' }}
        </span>
    </p>
    <a href="{{ route('auth.google.redirect') }}"
        class="mt-8 px-6 py-3 text-text-dark-primary bg-gray-50 bg-opacity-20 hover:bg-gray-100 hover:text-text-primary border flex justify-center gap-2 rounded-lg hover:shadow transition duration-150 transform hover:scale-105">
        <img class="w-6 h-6" src="https://www.svgrepo.com/show/475656/google-color.svg" loading="lazy"
            alt="google logo">
        <span>Login with Google</span>
    </a>
    {{-- <div class="mt-8 flex justify-center space-x-4">
            <a href="#" class="text-white hover:text-purple-300 transition-colors duration-200">
                <i class="fab fa-facebook-f text-2xl"></i>
            </a>
            <a href="#" class="text-white hover:text-purple-300 transition-colors duration-200">
                <i class="fab fa-twitter text-2xl"></i>
            </a>
            <a href="#" class="text-white hover:text-purple-300 transition-colors duration-200">
                <i class="fab fa-google text-2xl"></i>
            </a>
        </div> --}}
</div>
