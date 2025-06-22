@extends('layouts.main')

@section('content')
    {{-- Hero Section --}}
    <div class="relative overflow-hidden min-h-screen flex flex-col justify-center bg-gray-50">
        <!-- Background Elements -->
        <div class="absolute inset-0 w-full h-full">
            <img src="{{ asset('/storage/img/main/main-background.jpg') }}" class="w-full h-full object-cover"
                alt="Delicious food background">
            <div class="absolute inset-0 bg-gradient-to-b from-black/70 via-black/40 to-transparent"></div>
            {{-- Subtle pattern overlay --}}
            <div class="absolute inset-0 opacity-5"
                style="background-image: url('data:image/svg+xml,%3Csvg width=%2260%22 height=%2260%22 viewBox=%220 0 60 60%22 xmlns=%22http://www.w3.org/2000/svg%22%3E%3Cg fill=%22none%22 fill-rule=%22evenodd%22%3E%3Cg fill=%22%23ffffff%22 fill-opacity=%220.4%22%3E%3Cpath d=%22M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2V6h4V4H6z%22/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');">
            </div>
        </div>

        <!-- Decorative Blobs -->
        <div
            class="absolute -top-20 -left-20 w-72 h-72 bg-gradient-to-br from-[#FF564E]/30 to-[#ff834e]/30 rounded-full filter blur-3xl opacity-70 animate-pulse">
        </div>
        <div class="absolute -bottom-20 -right-20 w-80 h-80 bg-gradient-to-tl from-[#43c8a9]/30 to-[#64e9d1]/30 rounded-full filter blur-3xl opacity-70 animate-pulse"
            style="animation-duration: 5s;"></div>

        <!-- Content with transition -->
        <div x-data="{ pageLoaded: false }" x-init="setTimeout(() => pageLoaded = true, 200)" x-show="pageLoaded"
            x-transition:enter="transform transition-all duration-1000 ease-out"
            x-transition:enter-start="opacity-0 translate-y-12 scale-90"
            x-transition:enter-end="opacity-100 translate-y-0 scale-100"
            class="relative z-10 w-full h-full py-24 md:py-36 px-4 text-center">

            <div class="max-w-4xl mx-auto">
                <h1 class="font-display text-5xl sm:text-6xl md:text-7xl lg:text-[80px] font-extrabold leading-tight">
                    <span class="block text-white"> <span
                            class="bg-gradient-to-r from-[#FF564E] via-[#ff834e] to-[#FAD126] text-transparent bg-clip-text">SavoryAI</span>,</span>
                    <span class="block text-white mt-1 sm:mt-2">Your Personal <span class="relative inline-block">
                            <span class="relative z-10">Chef</span>
                            <svg class="absolute left-0 top-1/2 transform -translate-y-0 w-full h-8 sm:h-10 md:h-12 text-[#FAD126] -z-0"
                                viewBox="0 0 196 32" fill="none" xmlns="http://www.w3.org/2000/svg"
                                preserveAspectRatio="none">
                                <path
                                    d="M2 29.4588C31.5306 20.3342 81.7208 8.52831 130.653 10.309C179.586 12.0897 194.001 20.0001 194.001 20.0001"
                                    stroke="currentColor" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </span>,
                    </span>
                    <span
                        class="block bg-clip-text text-transparent bg-gradient-to-r from-text-primary via-green-400 to-text-primary bg-300% animate-shine pb-5 mt-1 sm:mt-2">
                        Powered By AI
                    </span>
                </h1>

                {{-- <p class="mt-8 text-lg md:text-xl text-gray-200 max-w-2xl mx-auto font-medium">
                    Transform your ingredients into delicious meals with intelligent recipe suggestions. Say goodbye to
                    "what's for dinner?" stress!
                </p> --}}

                <div class="mt-12 flex flex-col sm:flex-row justify-center items-center gap-6 sm:gap-8">
                    <div class="flex items-center space-x-3 text-gray-100">
                        <i class="fa-solid fa-users text-2xl text-[#64e9d1]"></i>
                        <div>
                            <p class="text-xl font-bold">20K+</p>
                            <p class="text-sm opacity-80">Happy Users</p>
                        </div>
                    </div>
                    <div class="hidden sm:block w-px h-10 bg-gray-500/50"></div>
                    <div class="flex items-center space-x-3 text-gray-100">
                        <i class="fa-solid fa-lemon text-2xl text-[#FAD126]"></i>
                        <div>
                            <p class="text-xl font-bold">500+</p>
                            <p class="text-sm opacity-80">Ingredients Recognized</p>
                        </div>
                    </div>
                    <div class="hidden sm:block w-px h-10 bg-gray-500/50"></div>
                    <div class="flex items-center space-x-3 text-gray-100">
                        <i class="fa-solid fa-book-open-reader text-2xl text-[#ff834e]"></i>
                        <div>
                            <p class="text-xl font-bold">1.5K+</p>
                            <p class="text-sm opacity-80">Unique Recipes</p>
                        </div>
                    </div>
                </div>

                <div class="mt-16 flex justify-center items-center">
                    <a href="{{ Auth::check() ? route('savoryai.index') : route('login') }}" wire:navigate
                        class="relative rounded-lg px-8 py-3 overflow-hidden group bg-[#FF564E] hover:bg-gradient-to-r hover:from-[#FF564E] hover:to-[#ff834e] text-white hover:ring-2 hover:ring-offset-2 hover:ring-[#ff834e] transition-all ease-out duration-300 text-base">
                        <span
                            class="absolute right-0 w-8 h-32 -mt-12 transition-all duration-1000 transform translate-x-12 bg-white opacity-10 rotate-12 group-hover:-translate-x-40 ease"></span>
                        <span class="relative">Mulai Sekarang</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- How It Works Section -->
    <section
        class="py-20 lg:py-32 flex flex-col justify-center bg-gradient-to-br from-gray-50 to-slate-100 overflow-hidden relative">
        <!-- Background decorative elements -->
        <div
            class="absolute top-10 left-10 w-40 h-40 bg-gradient-to-r from-[#FF564E]/10 to-[#ff834e]/10 rounded-full blur-3xl animate-blob">
        </div>
        <div
            class="absolute bottom-10 right-10 w-52 h-52 bg-gradient-to-r from-[#43c8a9]/10 to-[#64e9d1]/10 rounded-full blur-3xl animate-blob animation-delay-2000">
        </div>

        <div class="container mx-auto px-6 relative z-10">
            <div class="text-center mb-16 lg:mb-24" x-data="{ inView: false }" x-intersect.once="inView = true">
                <h2 class="text-4xl lg:text-5xl font-display font-bold text-gray-800 mb-4" x-show="inView"
                    x-transition:enter="transition ease-out duration-1000 delay-200"
                    x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0">
                    Masak Cerdas dalam 3 Langkah
                </h2>
                <p class="text-lg font-medium text-gray-600 max-w-3xl mx-auto" x-show="inView"
                    x-transition:enter="transition ease-out duration-1000 delay-400"
                    x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0">
                    Cukup foto bahanmu atau pilih manual, biarkan AI kami bekerja, dan nikmati resep lezat yang
                    dipersonalisasi.
                </p>
            </div>

            <div class="relative" x-data="{ inView: false }" x-intersect.once="inView = true">
                <!-- Connecting Lines - Enhanced and Properly Positioned -->
                <div class="hidden lg:block absolute top-[-45px] left-16 w-full h-20 z-0" x-show="inView">
                    <svg width="100%" height="100%" viewBox="0 0 1200 80" preserveAspectRatio="none"
                        x-transition:enter="transition ease-out duration-1500 delay-1000"
                        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
                        <!-- First connecting line: Step 1 to Step 2 -->
                        <path d="M 200 40 Q 300 20, 400 40" stroke-dasharray="8 4" stroke="url(#lineGradient1)"
                            stroke-width="3" fill="none"
                            x-transition:enter="transition-[stroke-dashoffset] ease-out duration-2000 delay-1200"
                            x-transition:enter-start="[stroke-dashoffset:500]"
                            x-transition:enter-end="[stroke-dashoffset:0]">
                        </path>
                        <!-- Second connecting line: Step 2 to Step 3 -->
                        <path d="M 600 40 Q 700 20, 800 40" stroke-dasharray="8 4" stroke="url(#lineGradient2)"
                            stroke-width="3" fill="none"
                            x-transition:enter="transition-[stroke-dashoffset] ease-out duration-2000 delay-1400"
                            x-transition:enter-start="[stroke-dashoffset:500]"
                            x-transition:enter-end="[stroke-dashoffset:0]">
                        </path>
                        <!-- Animated dots moving along the paths -->
                        <circle r="4" fill="#FF564E">
                            <animateMotion dur="3s" repeatCount="indefinite" begin="2s">
                                <mpath href="#path1" />
                            </animateMotion>
                        </circle>
                        <circle r="4" fill="#43c8a9">
                            <animateMotion dur="3s" repeatCount="indefinite" begin="2.5s">
                                <mpath href="#path2" />
                            </animateMotion>
                        </circle>
                        <defs>
                            <!-- Gradient for first line -->
                            <linearGradient id="lineGradient1" x1="0%" y1="0%" x2="100%"
                                y2="0%">
                                <stop offset="0%" style="stop-color:#FF564E;stop-opacity:1" />
                                <stop offset="100%" style="stop-color:#43c8a9;stop-opacity:1" />
                            </linearGradient>
                            <!-- Gradient for second line -->
                            <linearGradient id="lineGradient2" x1="0%" y1="0%" x2="100%"
                                y2="0%">
                                <stop offset="0%" style="stop-color:#43c8a9;stop-opacity:1" />
                                <stop offset="100%" style="stop-color:#FAD126;stop-opacity:1" />
                            </linearGradient>
                            <!-- Invisible paths for animation -->
                            <path id="path1" d="M 200 40 Q 300 20, 400 40" fill="none" stroke="none" />
                            <path id="path2" d="M 600 40 Q 700 20, 800 40" fill="none" stroke="none" />
                        </defs>
                    </svg>
                </div>

                <div class="grid lg:grid-cols-3 gap-10 lg:gap-8 relative z-10">
                    <!-- Step 1: Choose Ingredients -->
                    <div class="relative" x-show="inView"
                        x-transition:enter="transition ease-out duration-1000 delay-500"
                        x-transition:enter-start="opacity-0 translate-y-12 scale-95"
                        x-transition:enter-end="opacity-100 translate-y-0 scale-100">
                        <div
                            class="bg-white rounded-3xl p-8 shadow-xl hover:shadow-2xl transition-all duration-300 group border border-gray-200/50 transform hover:-translate-y-2">
                            <div
                                class="absolute -top-5 left-1/2 -translate-x-1/2 w-12 h-12 bg-gradient-to-br from-[#FF564E] to-[#ff834e] rounded-full flex items-center justify-center text-white font-bold text-xl shadow-lg group-hover:scale-110 transition-transform">
                                1
                            </div>
                            <div class="mt-8 mb-6 text-center">
                                <div
                                    class="w-20 h-20 bg-gradient-to-br from-[#FF564E]/10 to-[#ff834e]/10 rounded-2xl flex items-center justify-center mx-auto group-hover:rotate-[-6deg] transition-transform duration-300">
                                    <i class="fas fa-camera-retro text-4xl text-[#FF564E]"></i>
                                </div>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-800 mb-3 text-center">Pilih Bahanmu</h3>
                            <p class="text-gray-600 text-sm leading-relaxed text-center mb-6">Mulai dengan apa yang ada di
                                kulkas atau pantry Anda.</p>
                            <div class="space-y-3">
                                <div class="flex items-center space-x-3 p-3 bg-rose-50 rounded-xl border border-rose-200">
                                    <div
                                        class="w-10 h-10 bg-[#FF564E] rounded-lg flex items-center justify-center flex-shrink-0 shadow-md">
                                        <i class="fas fa-camera text-white text-lg"></i>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-800 text-sm">Upload Foto Bahan</p>
                                        <p class="text-gray-600 text-xs">AI deteksi otomatis.</p>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-3 p-3 bg-gray-100 rounded-xl border border-gray-200">
                                    <div
                                        class="w-10 h-10 bg-gray-500 rounded-lg flex items-center justify-center flex-shrink-0 shadow-md">
                                        <i class="fas fa-hand-pointer text-white text-lg"></i>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-800 text-sm">Pilih Manual</p>
                                        <p class="text-gray-600 text-xs">Dari daftar lengkap kami.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 2: AI Analysis -->
                    <div class="relative" x-show="inView"
                        x-transition:enter="transition ease-out duration-1000 delay-700"
                        x-transition:enter-start="opacity-0 translate-y-12 scale-95"
                        x-transition:enter-end="opacity-100 translate-y-0 scale-100">
                        <div
                            class="bg-white rounded-3xl p-8 shadow-xl hover:shadow-2xl transition-all duration-300 group border border-gray-200/50 transform hover:-translate-y-2">
                            <div
                                class="absolute -top-5 left-1/2 -translate-x-1/2 w-12 h-12 bg-gradient-to-br from-[#43c8a9] to-[#64e9d1] rounded-full flex items-center justify-center text-white font-bold text-xl shadow-lg group-hover:scale-110 transition-transform">
                                2
                            </div>
                            <div class="mt-8 mb-6 text-center">
                                <div
                                    class="w-20 h-20 bg-gradient-to-br from-[#43c8a9]/10 to-[#64e9d1]/10 rounded-2xl flex items-center justify-center mx-auto group-hover:animate-pulse transition-transform duration-300">
                                    <i class="fas fa-brain text-4xl text-[#43c8a9]"></i>
                                </div>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-800 mb-3 text-center">Analisis AI Cerdas</h3>
                            <p class="text-gray-600 text-sm leading-relaxed text-center mb-6">AI kami mencocokkan bahan
                                dengan database resep & preferensi Anda.</p>
                            <div class="text-center space-y-3">
                                <div class="flex justify-center space-x-2 my-4">
                                    <div class="w-3 h-3 bg-[#43c8a9] rounded-full animate-bounce"></div>
                                    <div class="w-3 h-3 bg-[#43c8a9] rounded-full animate-bounce"
                                        style="animation-delay: 0.15s"></div>
                                    <div class="w-3 h-3 bg-[#43c8a9] rounded-full animate-bounce"
                                        style="animation-delay: 0.3s"></div>
                                </div>
                                <div class="bg-teal-50 rounded-xl p-3 border border-teal-200">
                                    <p class="text-xs text-teal-700 font-medium"><i
                                            class="fas fa-cogs mr-2"></i>Menganalisis kompatibilitas...</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 3: Get Recommendations -->
                    <div class="relative" x-show="inView"
                        x-transition:enter="transition ease-out duration-1000 delay-900"
                        x-transition:enter-start="opacity-0 translate-y-12 scale-95"
                        x-transition:enter-end="opacity-100 translate-y-0 scale-100">
                        <div
                            class="bg-white rounded-3xl p-8 shadow-xl hover:shadow-2xl transition-all duration-300 group border border-gray-200/50 transform hover:-translate-y-2">
                            <div
                                class="absolute -top-5 left-1/2 -translate-x-1/2 w-12 h-12 bg-gradient-to-br from-[#FAD126] to-[#ffc04e] rounded-full flex items-center justify-center text-gray-800 font-bold text-xl shadow-lg group-hover:scale-110 transition-transform">
                                3
                            </div>
                            <div class="mt-8 mb-6 text-center">
                                <div
                                    class="w-20 h-20 bg-gradient-to-br from-[#FAD126]/10 to-[#ffc04e]/10 rounded-2xl flex items-center justify-center mx-auto group-hover:scale-105 transition-transform duration-300">
                                    <i class="fas fa-utensils text-4xl text-[#FAD126]"></i>
                                </div>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-800 mb-3 text-center">Resep Lezat Menanti</h3>
                            <p class="text-gray-600 text-sm leading-relaxed text-center mb-6">Dapatkan rekomendasi resep
                                lengkap dengan instruksi langkah demi langkah.</p>
                            <div class="space-y-2">
                                <div
                                    class="bg-yellow-50 rounded-lg p-3 flex items-center space-x-2 border border-yellow-200">
                                    <div
                                        class="w-8 h-8 bg-[#FAD126] rounded-md flex items-center justify-center text-white">
                                        <i class="fas fa-star text-sm"></i>
                                    </div>
                                    <span class="text-xs font-medium text-gray-700">Resep Terpersonalisasi</span>
                                </div>
                                <div
                                    class="bg-yellow-50 rounded-lg p-3 flex items-center space-x-2 border border-yellow-200">
                                    <div
                                        class="w-8 h-8 bg-[#FAD126] rounded-md flex items-center justify-center text-white">
                                        <i class="fas fa-stopwatch text-sm"></i>
                                    </div>
                                    <span class="text-xs font-medium text-gray-700">Estimasi Waktu & Kesulitan</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-16 lg:mt-24" x-show="inView"
                    x-transition:enter="transition ease-out duration-1000 delay-1200"
                    x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0">
                    <a href="{{ Auth::check() ? route('savoryai.index') : route('login') }}" wire:navigate
                        class="inline-flex items-center px-10 py-4 bg-gradient-to-r from-teal-500 to-[#6cf2da] text-white text-lg font-semibold rounded-xl shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300 group focus:outline-none focus:ring-4 focus:ring-teal-500/50">
                        <i
                            class="fas fa-magic mr-3 transform group-hover:rotate-[15deg] transition-transform duration-300"></i>
                        Coba SavoryAI Sekarang
                        <i
                            class="fas fa-arrow-right ml-3 transform group-hover:translate-x-1 transition-transform duration-300"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Categories Section -->
    <section class="py-20 min-h-screen flex flex-col justify-center lg:py-32 bg-gradient-to-br from-slate-100 to-gray-50">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16 lg:mb-24" x-data="{ inView: false }" x-intersect.once="inView = true">
                <h2 class="text-4xl lg:text-5xl font-display font-bold text-gray-800 mb-4" x-show="inView"
                    x-transition:enter="transition ease-out duration-1000 delay-200"
                    x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0">
                    Jelajahi Dunia Rasa
                </h2>
                <p class="text-lg font-medium text-gray-600 max-w-2xl mx-auto" x-show="inView"
                    x-transition:enter="transition ease-out duration-1000 delay-400"
                    x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0">
                    Temukan inspirasi dari berbagai kategori resep favorit.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8" x-data="{ inView: false }"
                x-intersect.once="inView = true">
                @php
                    $categories = [
                        [
                            'name' => 'Makanan Utama',
                            'desc' => 'Hidangan lezat untuk setiap hari.',
                            'icon' => 'fas fa-drumstick-bite',
                            'color_from' => 'from-orange-400',
                            'color_to' => 'to-red-500',
                            'recipes' => '250+',
                            'delay' => '500',
                        ],
                        [
                            'name' => 'Camilan & Pembuka',
                            'desc' => 'Gigitan ringan penuh cita rasa.',
                            'icon' => 'fas fa-pepper-hot',
                            'color_from' => 'from-green-400',
                            'color_to' => 'to-emerald-500',
                            'recipes' => '120+',
                            'delay' => '700',
                        ],
                        [
                            'name' => 'Makanan Penutup',
                            'desc' => 'Maniskan harimu dengan dessert.',
                            'icon' => 'fas fa-ice-cream',
                            'color_from' => 'from-purple-400',
                            'color_to' => 'to-pink-500',
                            'recipes' => '180+',
                            'delay' => '900',
                        ],
                        // Add more categories if needed
                    ];
                @endphp

                @foreach ($categories as $category)
                    <div class="group cursor-pointer" x-show="inView"
                        x-transition:enter="transition ease-out duration-1000 delay-[{{ $category['delay'] }}ms]"
                        x-transition:enter-start="opacity-0 translate-y-12 scale-95"
                        x-transition:enter-end="opacity-100 translate-y-0 scale-100">
                        <div
                            class="relative overflow-hidden rounded-3xl bg-white shadow-xl group-hover:shadow-2xl transition-all duration-500 h-72 sm:h-80">
                            <div
                                class="absolute inset-0 bg-gradient-to-br {{ $category['color_from'] }} {{ $category['color_to'] }} opacity-90 group-hover:opacity-100 transition-opacity duration-300">
                            </div>
                            {{-- Pattern Overlay --}}
                            <div
                                class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg%20width%3D%2240%22%20height%3D%2240%22%20viewBox%3D%220%200%2040%2040%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%3E%3Cg%20fill%3D%22%23ffffff%22%20fill-opacity%3D%220.07%22%20fill-rule%3D%22evenodd%22%3E%3Cpath%20d%3D%22M0%200h20v20H0zM20%2020h20v20H20z%22%2F%3E%3C%2Fg%3E%3C%2Fsvg%3E')] opacity-50 group-hover:opacity-70 transition-opacity duration-300">
                            </div>

                            <div class="relative p-6 sm:p-8 h-full flex flex-col justify-between text-white">
                                <div class="text-center flex-grow flex flex-col items-center justify-center">
                                    <div
                                        class="inline-flex items-center justify-center w-20 h-20 bg-white/20 backdrop-blur-sm rounded-full mb-4 group-hover:scale-110 group-hover:rotate-6 transition-transform duration-300 shadow-md">
                                        <i class="{{ $category['icon'] }} text-4xl text-white"></i>
                                    </div>
                                    <h3 class="text-2xl font-bold mb-1">{{ $category['name'] }}</h3>
                                    <p class="text-white/80 text-sm px-2">{{ $category['desc'] }}</p>
                                </div>
                                <div class="text-center mt-auto">
                                    <div
                                        class="inline-flex items-center justify-center bg-white/20 backdrop-blur-sm rounded-full px-4 py-2 text-xs font-semibold shadow">
                                        <span>{{ $category['recipes'] }} resep</span>
                                        <i
                                            class="fas fa-arrow-right ml-2 transform group-hover:translate-x-1 transition-transform"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="text-center mt-12 lg:mt-24" x-data="{ inView: false }" x-intersect.once="inView = true">
                <a href="{{ route('explore-recipes.index') }}" wire:navigate
                    class="inline-flex items-center px-8 py-3 bg-white text-gray-700 text-lg font-semibold rounded-xl shadow-md hover:shadow-lg hover:bg-gray-50 transform hover:scale-105 transition-all duration-300 border border-gray-300"
                    x-show="inView" x-transition:enter="transition ease-out duration-1000 delay-1200"
                    x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0">
                    Jelajahi Semua Kategori
                    <i class="fas fa-compass ml-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Popular Recipes Section -->
    <section class="py-20 min-h-screen flex flex-col justify-center lg:py-32 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16 lg:mb-24" x-data="{ inView: false }" x-intersect.once="inView = true">
                <h2 class="text-4xl lg:text-5xl font-display font-bold text-gray-800 mb-4" x-show="inView"
                    x-transition:enter="transition ease-out duration-1000 delay-200"
                    x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0">
                    Resep Pilihan Minggu Ini
                </h2>
                <p class="text-lg font-medium text-gray-600 max-w-2xl mx-auto" x-show="inView"
                    x-transition:enter="transition ease-out duration-1000 delay-400"
                    x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0">
                    Lihat apa yang sedang populer dan dicintai oleh komunitas SavoryAI.
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8" x-data="{ inView: false }"
                x-intersect.once="inView = true">
                @php
                    $popularRecipes = [
                        [
                            'name' => 'Nasi Goreng Spesial Ayam',
                            'desc' => 'Klasik Indonesia dengan sentuhan modern.',
                            'time' => '25 min',
                            'level' => 'Mudah',
                            'rating' => '4.8',
                            'icon' => 'fas fa-bowl-rice',
                            'color' => 'orange',
                            'delay' => '500',
                        ],
                        [
                            'name' => 'Salad Sayuran Pelangi',
                            'desc' => 'Segar, sehat, dan penuh warna.',
                            'time' => '15 min',
                            'level' => 'Mudah',
                            'rating' => '4.9',
                            'icon' => 'fas fa-carrot',
                            'color' => 'green',
                            'delay' => '700',
                        ],
                        [
                            'name' => 'Rendang Daging Sapi Empuk',
                            'desc' => 'Kelezatan rempah Nusantara yang otentik.',
                            'time' => '3 jam',
                            'level' => 'Menengah',
                            'rating' => '4.7',
                            'icon' => 'fas fa-drumstick-bite',
                            'color' => 'red',
                            'delay' => '900',
                        ],
                    ];
                    $colors = [
                        'orange' => [
                            'from' => 'from-orange-400',
                            'to' => 'to-amber-500',
                            'text' => 'text-orange-600',
                            'bg_light' => 'bg-orange-50',
                        ],
                        'green' => [
                            'from' => 'from-green-400',
                            'to' => 'to-emerald-500',
                            'text' => 'text-green-600',
                            'bg_light' => 'bg-green-50',
                        ],
                        'red' => [
                            'from' => 'from-red-400',
                            'to' => 'to-rose-500',
                            'text' => 'text-red-600',
                            'bg_light' => 'bg-red-50',
                        ],
                    ];
                @endphp

                @foreach ($popularRecipes as $recipe)
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden group hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1"
                        x-show="inView"
                        x-transition:enter="transition ease-out duration-1000 delay-[{{ $recipe['delay'] }}ms]"
                        x-transition:enter-start="opacity-0 translate-y-12 scale-95"
                        x-transition:enter-end="opacity-100 translate-y-0 scale-100">
                        <div
                            class="relative h-56 bg-gradient-to-br {{ $colors[$recipe['color']]['from'] }} {{ $colors[$recipe['color']]['to'] }} overflow-hidden">
                            <div
                                class="absolute inset-0 flex items-center justify-center opacity-20 group-hover:opacity-30 transition-opacity duration-300">
                                <i
                                    class="{{ $recipe['icon'] }} text-8xl text-white transform group-hover:scale-110 transition-transform duration-500"></i>
                            </div>
                            <img src="{{ asset('/storage/img/main/recipe-placeholder-' . $loop->iteration . '.jpg') }}"
                                alt="{{ $recipe['name'] }}"
                                class="w-full h-full object-cover opacity-0 group-hover:opacity-20 transition-opacity duration-300"
                                onerror="this.style.display='none'"> {{-- Hide if placeholder not found --}}
                            <div
                                class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm rounded-full px-3 py-1 text-sm font-semibold {{ $colors[$recipe['color']]['text'] }} shadow-sm">
                                <i class="fas fa-star text-yellow-400 mr-1"></i> {{ $recipe['rating'] }}
                            </div>
                            <div class="absolute bottom-0 left-0 w-full p-4 bg-gradient-to-t from-black/60 to-transparent">
                                <h3 class="text-xl font-semibold text-white mb-1 truncate">{{ $recipe['name'] }}</h3>
                            </div>
                        </div>
                        <div class="p-6">
                            <p class="text-gray-600 text-sm mb-4 h-10 overflow-hidden">{{ $recipe['desc'] }}</p>
                            <div
                                class="flex items-center justify-between text-xs text-gray-500 {{ $colors[$recipe['color']]['bg_light'] }} p-3 rounded-lg">
                                <span class="flex items-center"><i
                                        class="far fa-clock mr-1.5 {{ $colors[$recipe['color']]['text'] }}"></i>
                                    {{ $recipe['time'] }}</span>
                                <span class="flex items-center"><i
                                        class="fas fa-fire-alt mr-1.5 {{ $colors[$recipe['color']]['text'] }}"></i>
                                    {{ $recipe['level'] }}</span>
                            </div>
                            <a href="#"
                                class="block mt-4 text-center w-full px-4 py-2 bg-gradient-to-r {{ $colors[$recipe['color']]['from'] }} {{ $colors[$recipe['color']]['to'] }} text-white font-semibold rounded-lg hover:shadow-md transition-shadow duration-300 text-sm">
                                Lihat Resep
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-12 lg:mt-24" x-data="{ inView: false }" x-intersect.once="inView = true">
                <a href="{{ route('explore-recipes.index') }}" wire:navigate
                    class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-[#FF564E] to-[#ff834e] text-white text-lg font-semibold rounded-xl shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300"
                    x-show="inView" x-transition:enter="transition ease-out duration-1000 delay-1200"
                    x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0">
                    Lihat Semua Resep Populer
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- AI Features Highlight -->
    <section
        class="py-20 lg:py-32 min-h-screen flex flex-col justify-center bg-gradient-to-r from-[#FF564E] to-[#ff834e] text-white overflow-hidden relative">
        <!-- Abstract background shapes -->
        <div class="absolute top-0 left-0 w-1/2 h-full opacity-10 overflow-hidden">
            <svg class="absolute -left-1/4 top-0 w-[150%] h-[150%]" viewBox="0 0 800 800" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <circle cx="400" cy="400" r="300" stroke="white" stroke-width="80"
                    stroke-dasharray="20 40" />
            </svg>
        </div>
        <div class="absolute bottom-0 right-0 w-1/2 h-full opacity-10 overflow-hidden">
            <svg class="absolute -right-1/4 bottom-0 w-[150%] h-[150%]" viewBox="0 0 800 800" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <rect x="100" y="100" width="600" height="600" rx="100" stroke="white" stroke-width="60"
                    stroke-dasharray="30 30" transform="rotate(15 400 400)" />
            </svg>
        </div>

        <div class="container mx-auto px-6 relative z-10">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div x-data="{ inView: false }" x-intersect.once="inView = true">
                    <h2 class="text-4xl lg:text-5xl font-display font-bold mb-6" x-show="inView"
                        x-transition:enter="transition ease-out duration-1000 delay-200"
                        x-transition:enter-start="opacity-0 translate-x-8"
                        x-transition:enter-end="opacity-100 translate-x-0">
                        AI yang Beneran Ngerti, <br class="hidden sm:block">Masak Jadi Gampang!
                    </h2>
                    <p class="text-xl mb-10 opacity-90 leading-relaxed" x-show="inView"
                        x-transition:enter="transition ease-out duration-1000 delay-400"
                        x-transition:enter-start="opacity-0 translate-x-8"
                        x-transition:enter-end="opacity-100 translate-x-0">
                        Foto aja bahan yang ada di kulkas, SavoryAI langsung kasih tau resep apa yang bisa kamu bikin.
                        Gak perlu pusing mikir menu hari ini!
                    </p>

                    <div class="space-y-8">
                        @php
                            $aiFeatures = [
                                [
                                    'icon' => 'fas fa-camera',
                                    'title' => 'Deteksi Bahan dari Foto',
                                    'desc' =>
                                        'Tinggal foto bahan-bahan yang ada, AI langsung tau apa aja yang bisa kamu masak. Magic banget kan?',
                                    'delay' => '600',
                                ],
                                [
                                    'icon' => 'fas fa-magic',
                                    'title' => 'Rekomendasi Resep Instant',
                                    'desc' =>
                                        'Dari bahan seadanya di rumah, SavoryAI bisa sulap jadi menu lezat yang bikin keluarga happy.',
                                    'delay' => '800',
                                ],
                                [
                                    'icon' => 'fas fa-heart',
                                    'title' => 'Sesuai Selera Kamu',
                                    'desc' =>
                                        'Makin sering dipake, makin pinter ngasih rekomendasi yang pas sama lidah dan preferensi kamu.',
                                    'delay' => '1000',
                                ],
                            ];
                        @endphp
                        @foreach ($aiFeatures as $feature)
                            <div class="flex items-start space-x-5" x-show="inView"
                                x-transition:enter="transition ease-out duration-1000 delay-[{{ $feature['delay'] }}ms]"
                                x-transition:enter-start="opacity-0 translate-x-8"
                                x-transition:enter-end="opacity-100 translate-x-0">
                                <div
                                    class="w-14 h-14 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center flex-shrink-0 shadow-md">
                                    <i class="{{ $feature['icon'] }} text-2xl text-white"></i>
                                </div>
                                <div>
                                    <h3 class="text-xl font-semibold mb-1">{{ $feature['title'] }}</h3>
                                    <p class="opacity-80 text-sm leading-relaxed">{{ $feature['desc'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="relative" x-data="{ inView: false }" x-intersect.once="inView = true">
                    <div class="relative z-10" x-show="inView"
                        x-transition:enter="transition ease-out duration-1000 delay-400"
                        x-transition:enter-start="opacity-0 -translate-x-12 scale-95"
                        x-transition:enter-end="opacity-100 translate-x-0 scale-100">
                        <div class="bg-white/10 backdrop-blur-lg rounded-3xl p-8 border border-white/20 shadow-2xl">
                            <div class="text-center mb-6">
                                <div
                                    class="w-24 h-24 bg-gradient-to-br from-white/30 to-white/10 rounded-full flex items-center justify-center mx-auto mb-5 shadow-lg">
                                    <i class="fas fa-robot text-5xl text-white animate-pulse-slow"></i>
                                </div>
                                <h3 class="text-3xl font-bold font-display">SavoryAI Assistant</h3>
                                <p class="opacity-90 mt-1">Temen masak yang selalu siap bantuin!</p>
                            </div>

                            <div class="space-y-4">
                                @php
                                    $assistantFeatures = [
                                        [
                                            'icon' => 'fas fa-eye',
                                            'text' => 'Lihat & Kenali Bahan',
                                            'color' => 'text-emerald-300',
                                        ],
                                        [
                                            'icon' => 'fas fa-lightbulb',
                                            'text' => 'Kasih Ide Kreatif',
                                            'color' => 'text-sky-300',
                                        ],
                                        [
                                            'icon' => 'fas fa-smile',
                                            'text' => 'Bikin Masak Jadi Fun',
                                            'color' => 'text-yellow-300',
                                        ],
                                    ];
                                @endphp
                                @foreach ($assistantFeatures as $feat)
                                    <div
                                        class="bg-white/10 rounded-xl p-4 transform hover:scale-105 transition-transform duration-300">
                                        <div class="flex items-center space-x-3">
                                            <div
                                                class="w-8 h-8 flex items-center justify-center rounded-full {{ $feat['color'] }}">
                                                <i class="{{ $feat['icon'] }} text-xl"></i>
                                            </div>
                                            <span class="font-medium">{{ $feat['text'] }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Floating elements for decoration -->
                    <div
                        class="absolute -top-8 -right-8 w-28 h-28 bg-[#FAD126]/50 rounded-full opacity-50 filter blur-xl animate-blob animation-delay-1000">
                    </div>
                    <div
                        class="absolute -bottom-8 -left-8 w-20 h-20 bg-white/30 rounded-full opacity-50 filter blur-lg animate-blob animation-delay-3000">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 lg:py-32 min-h-screen flex flex-col justify-center bg-gray-50">
        <div class="container mx-auto px-6 text-center" x-data="{ inView: false }" x-intersect.once="inView = true">
            <div class="max-w-3xl mx-auto">
                <div x-show="inView" x-transition:enter="transition ease-out duration-1000 delay-100"
                    x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100">
                    <span
                        class="inline-block px-4 py-2 text-sm font-semibold text-[#FF564E] bg-rose-100 rounded-full mb-8">
                        <i class="fas fa-rocket mr-2"></i>Siap Memulai?
                    </span>
                </div>
                <h2 class="text-4xl lg:text-5xl font-display font-bold text-gray-800 mb-8" x-show="inView"
                    x-transition:enter="transition ease-out duration-1000 delay-200"
                    x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0">
                    Mulai Petualangan Kuliner Anda Hari Ini!
                </h2>
                <p class="text-lg font-normal text-gray-600 mb-20 leading-relaxed" x-show="inView"
                    x-transition:enter="transition ease-out duration-1000 delay-400"
                    x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0">
                    Bergabunglah dengan ribuan pengguna yang telah menemukan kemudahan dan kegembiraan memasak bersama
                    SavoryAI. Ciptakan hidangan lezat, hemat waktu, dan jelajahi rasa baru.
                </p>

                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center" x-show="inView"
                    x-transition:enter="transition ease-out duration-1000 delay-600"
                    x-transition:enter-start="opacity-0 translate-y-8 scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 scale-100">
                    <a href="{{ Auth::check() ? route('savoryai.index') : route('register') }}" wire:navigate
                        class="w-full sm:w-auto px-8 py-4 bg-gradient-to-r from-[#FF564E] to-[#ff834e] text-white text-lg font-semibold rounded-xl shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300 focus:outline-none focus:ring-4 focus:ring-[#FF564E]/50">
                        {{ Auth::check() ? 'Masuk ke Dapur AI' : 'Daftar Gratis Sekarang' }}
                        <i class="fas fa-arrow-right ml-2"></i>
                    </a>

                    <a href="{{ route('explore-recipes.index') }}" wire:navigate
                        class="w-full sm:w-auto px-8 py-4 border-2 border-gray-300 text-gray-700 font-semibold rounded-xl hover:border-[#FF564E] hover:text-[#FF564E] hover:bg-rose-50 transition-all duration-300 transform hover:scale-105">
                        Jelajahi Resep <i class="fas fa-search ml-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
