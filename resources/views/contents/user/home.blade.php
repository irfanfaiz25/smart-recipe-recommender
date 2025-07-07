@extends('layouts.main')

@section('title', 'Beranda')

@section('content')
    {{-- Hero Section --}}
    <div class="relative overflow-hidden min-h-screen flex flex-col justify-center bg-gray-50">
        <!-- Background Elements -->
        <div class="absolute inset-0 w-full h-full">
            <img src="{{ asset('/storage/img/main/main-background.jpg') }}" class="w-full h-full object-cover"
                alt="Delicious food background">
            <div class="absolute inset-0 bg-gradient-to-b from-black/80 via-black/50 to-transparent"></div>
        </div>

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
                            <svg class="absolute left-0 top-[70%] transform -translate-y-0 w-full h-8 sm:h-10 md:h-12 text-[#FAD126] -z-0"
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
                    <div class="flex flex-col md:flex-row items-center space-x-3 text-gray-100">
                        <i class="fa-solid fa-users text-lg md:text-2xl text-[#64e9d1]"></i>
                        <div>
                            <p class="text-base md:text-xl font-bold">20K+</p>
                            <p class="text-xs md:text-sm opacity-80">Happy Users</p>
                        </div>
                    </div>
                    <div class="hidden sm:block w-px h-10 bg-gray-500/50"></div>
                    <div class="flex flex-col md:flex-row items-center space-x-3 text-gray-100">
                        <i class="fa-solid fa-lemon text-lg md:text-2xl text-[#FAD126]"></i>
                        <div>
                            <p class="text-base md:text-xl font-bold">500+</p>
                            <p class="text-xs md:text-sm opacity-80">Ingredients Recognized</p>
                        </div>
                    </div>
                    <div class="hidden sm:block w-px h-10 bg-gray-500/50"></div>
                    <div class="flex flex-col md:flex-row items-center space-x-3 text-gray-100">
                        <i class="fa-solid fa-book-open-reader text-lg md:text-2xl text-[#ff834e]"></i>
                        <div>
                            <p class="text-base md:text-xl font-bold">1.5K+</p>
                            <p class="text-xs md:text-sm opacity-80">Unique Recipes</p>
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
    <section class="py-20 lg:py-32 flex flex-col justify-center bg-white overflow-hidden relative">
        <div class="absolute inset-0">
            <!-- Floating circles -->
            <div
                class="absolute top-20 left-10 w-64 h-64 bg-gradient-to-br from-[#FF564E]/30 to-[#ff834e]/30 rounded-full blur-xl animate-float">
            </div>
            <div
                class="absolute bottom-20 right-10 w-72 h-72 bg-gradient-to-br from-[#43c8a9]/30 to-[#64e9d1]/30 rounded-full blur-xl animate-float-delayed">
            </div>

            <!-- Geometric patterns -->
            <div class="absolute top-1/4 right-1/4 w-24 h-24 border-8 border-[#FAD126]/20 rounded-lg rotate-45"></div>
            <div class="absolute bottom-1/3 left-1/3 w-16 h-16 border-4 border-[#FF564E]/20 rounded-full"></div>

            <!-- Dotted grid pattern -->
            <div
                class="absolute inset-0 bg-[radial-gradient(circle_at_1px_1px,#43c8a9_1px,transparent_1px)] bg-[size:30px_30px] opacity-10">
            </div>
        </div>

        <div class="container mx-auto px-6 relative z-10">
            <div class="text-center mb-16 lg:mb-24" x-data="{ inView: false }" x-intersect.once="inView = true">
                <h2 class="text-2xl md:text-4xl lg:text-5xl font-display font-bold text-gray-800 mb-4" x-show="inView"
                    x-transition:enter="transition ease-out duration-1000 delay-200"
                    x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0">
                    Masak Cerdas dalam 3 Langkah
                </h2>
                <p class="text-sm md:text-lg font-medium text-gray-600 max-w-3xl mx-auto" x-show="inView"
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
                                class="absolute -top-5 left-1/2 -translate-x-1/2 w-10 h-10 md:w-12 md:h-12 bg-gradient-to-br from-[#FF564E] to-[#ff834e] rounded-full flex items-center justify-center text-white font-bold text-base md:text-xl shadow-lg group-hover:scale-110 transition-transform">
                                1
                            </div>
                            <div class="mt-8 mb-6 text-center">
                                <div
                                    class="w-20 h-20 bg-gradient-to-br from-[#FF564E]/10 to-[#ff834e]/10 rounded-2xl flex items-center justify-center mx-auto group-hover:rotate-[-6deg] transition-transform duration-300">
                                    <i class="fas fa-camera-retro text-4xl text-[#FF564E]"></i>
                                </div>
                            </div>
                            <h3 class="text-lg md:text-2xl font-bold text-gray-800 mb-3 text-center">Pilih Bahanmu</h3>
                            <p class="text-gray-600 text-xs md:text-sm font-medium leading-relaxed text-center mb-6">Mulai
                                dengan apa
                                yang ada di
                                kulkas atau pantry Anda.</p>
                            <div class="space-y-3">
                                <div class="flex items-center space-x-3 p-3 bg-rose-50 rounded-xl border border-rose-200">
                                    <div
                                        class="w-10 h-10 bg-[#FF564E] rounded-lg flex items-center justify-center flex-shrink-0 shadow-md">
                                        <i class="fas fa-camera text-white text-lg"></i>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-800 text-sm">Upload Foto Bahan</p>
                                        <p class="text-gray-600 font-normal text-xs">AI deteksi otomatis.</p>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-3 p-3 bg-gray-100 rounded-xl border border-gray-200">
                                    <div
                                        class="w-10 h-10 bg-gray-500 rounded-lg flex items-center justify-center flex-shrink-0 shadow-md">
                                        <i class="fas fa-hand-pointer text-white text-lg"></i>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-800 text-sm">Pilih Manual</p>
                                        <p class="text-gray-600 font-normal text-xs">Dari daftar lengkap kami.</p>
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
                                class="absolute -top-5 left-1/2 -translate-x-1/2 w-10 h-10 md:w-12 md:h-12 bg-gradient-to-br from-[#43c8a9] to-[#64e9d1] rounded-full flex items-center justify-center text-white font-bold text-base md:text-xl shadow-lg group-hover:scale-110 transition-transform">
                                2
                            </div>
                            <div class="mt-8 mb-6 text-center">
                                <div
                                    class="w-20 h-20 bg-gradient-to-br from-[#43c8a9]/10 to-[#64e9d1]/10 rounded-2xl flex items-center justify-center mx-auto group-hover:animate-pulse transition-transform duration-300">
                                    <i class="fas fa-brain text-4xl text-[#43c8a9]"></i>
                                </div>
                            </div>
                            <h3 class="text-lg md:text-2xl font-bold text-gray-800 mb-3 text-center">
                                Analisis AI Cerdas
                            </h3>
                            <p class="text-gray-600 font-normal text-sm leading-relaxed text-center mb-6">
                                AI kami mencocokkan bahan
                                dengan database resep & preferensi Anda.
                            </p>
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
                                class="absolute -top-5 left-1/2 -translate-x-1/2 w-10 h-10 md:w-12 md:h-12 bg-gradient-to-br from-[#FAD126] to-[#ffc04e] rounded-full flex items-center justify-center text-gray-800 font-bold text-base md:text-xl shadow-lg group-hover:scale-110 transition-transform">
                                3
                            </div>
                            <div class="mt-8 mb-6 text-center">
                                <div
                                    class="w-20 h-20 bg-gradient-to-br from-[#FAD126]/10 to-[#ffc04e]/10 rounded-2xl flex items-center justify-center mx-auto group-hover:scale-105 transition-transform duration-300">
                                    <i class="fas fa-utensils text-4xl text-[#FAD126]"></i>
                                </div>
                            </div>
                            <h3 class="text-lg md:text-2xl font-bold text-gray-800 mb-3 text-center">
                                Resep Lezat Menanti
                            </h3>
                            <p class="text-gray-600 text-sm font-normal leading-relaxed text-center mb-6">
                                Dapatkan rekomendasi resep lengkap dengan instruksi langkah demi langkah.
                            </p>
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
                        class="inline-flex items-center px-10 py-4 bg-gradient-to-r from-teal-500 to-[#6cf2da] text-white text-base md:text-lg font-semibold rounded-xl shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300 group focus:outline-none focus:ring-4 focus:ring-teal-500/50">
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

    @livewire('home-section')

    <!-- AI Features Highlight -->
    <section
        class="py-20 lg:py-32 min-h-screen flex flex-col justify-center bg-gradient-to-r from-[#FF564E] to-[#ff834e] text-white overflow-hidden relative">
        <!-- Abstract background shapes -->
        <div class="absolute top-0 left-0 w-full h-full opacity-10 overflow-hidden">
            <svg class="absolute -left-1/4 top-0 w-[150%] h-[150%]" viewBox="0 0 1000 1000" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <!-- Hexagonal pattern -->
                <pattern id="hexagonPattern" x="0" y="0" width="100" height="100" patternUnits="userSpaceOnUse">
                    <path d="M50 5L92.7 30V80L50 105L7.3 80V30L50 5Z" stroke="white" stroke-width="2" fill="none" />
                </pattern>
                <rect width="100%" height="100%" fill="url(#hexagonPattern)" />

                <!-- Flowing curves -->
                <path d="M0 300 Q 250 200, 500 300 T 1000 300" stroke="white" stroke-width="3" fill="none">
                    <animate attributeName="d" dur="10s" repeatCount="indefinite"
                        values="M0 300 Q 250 200, 500 300 T 1000 300;
                                M0 300 Q 250 400, 500 300 T 1000 300;
                                M0 300 Q 250 200, 500 300 T 1000 300" />
                </path>

                <!-- Animated circles -->
                <circle cx="200" cy="200" r="50" stroke="white" stroke-width="2" fill="none">
                    <animate attributeName="r" values="50;70;50" dur="4s" repeatCount="indefinite" />
                </circle>
                <circle cx="800" cy="600" r="80" stroke="white" stroke-width="2" fill="none">
                    <animate attributeName="r" values="80;100;80" dur="6s" repeatCount="indefinite" />
                </circle>
            </svg>
        </div>
        <div class="absolute bottom-0 right-0 w-full h-full opacity-10 overflow-hidden">
            <svg class="absolute right-0 bottom-0 w-[150%] h-[150%]" viewBox="0 0 1000 1000" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <!-- Dotted grid -->
                <pattern id="dotPattern" x="0" y="0" width="40" height="40" patternUnits="userSpaceOnUse">
                    <circle cx="20" cy="20" r="2" fill="white" />
                </pattern>
                <rect width="100%" height="100%" fill="url(#dotPattern)" />

                <!-- Animated waves -->
                <path d="M0 700 C 200 650, 400 750, 600 700 S 800 650, 1000 700" stroke="white" stroke-width="2"
                    fill="none">
                    <animate attributeName="d" dur="8s" repeatCount="indefinite"
                        values="M0 700 C 200 650, 400 750, 600 700 S 800 650, 1000 700;
                                M0 700 C 200 750, 400 650, 600 700 S 800 750, 1000 700;
                                M0 700 C 200 650, 400 750, 600 700 S 800 650, 1000 700" />
                </path>
            </svg>
        </div>

        <div class="container mx-auto px-6 relative z-10">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div x-data="{ inView: false }" x-intersect.once="inView = true">
                    <h2 class="text-3xl md:text-4xl lg:text-5xl font-display font-bold mb-6" x-show="inView"
                        x-transition:enter="transition ease-out duration-1000 delay-200"
                        x-transition:enter-start="opacity-0 translate-x-8"
                        x-transition:enter-end="opacity-100 translate-x-0">
                        AI yang Beneran Ngerti, <br class="hidden sm:block">Masak Jadi Gampang!
                    </h2>
                    <p class="text-base md:text-xl font-medium mb-10 opacity-90 leading-relaxed" x-show="inView"
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
                                    <h3 class="text-base md:text-xl font-semibold mb-1">{{ $feature['title'] }}</h3>
                                    <p class="opacity-80 text-xs md:text-sm font-medium leading-relaxed">
                                        {{ $feature['desc'] }}</p>
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
                                <h3 class="text-2xl md:text-3xl font-bold font-display">SavoryAI Assistant</h3>
                                <p class="opacity-90 text-sm md:text-base font-medium mt-1">Temen masak yang selalu siap
                                    bantuin!</p>
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
                                                <i class="{{ $feat['icon'] }} text-base md:text-xl"></i>
                                            </div>
                                            <span class="font-medium text-base md:text-lg">{{ $feat['text'] }}</span>
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
    <section class="relative overflow-hidden min-h-screen flex flex-col justify-center bg-gray-50">
        <div class="py-20 lg:py-32 min-h-screen flex flex-col justify-center">
            <!-- Background Elements -->
            <div class="absolute inset-0 w-full h-full">
                <img src="{{ asset('/storage/img/main/start-journey-background.jpg') }}"
                    class="w-full h-full object-cover" alt="Delicious food background">
                <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/60 to-transparent"></div>
            </div>

            <div class="container mx-auto px-6 text-center z-50" x-data="{ inView: false }"
                x-intersect.once="inView = true">
                <div class="max-w-3xl mx-auto">
                    <div x-show="inView" x-transition:enter="transition ease-out duration-1000 delay-100"
                        x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100">
                        <span
                            class="inline-block px-4 py-2 text-sm font-semibold text-[#FF564E] bg-rose-100 rounded-full mb-8">
                            <i class="fas fa-rocket mr-2"></i>Siap Memulai?
                        </span>
                    </div>
                    <h2 class="text-3xl md:text-4xl lg:text-5xl font-display font-bold text-white mb-8" x-show="inView"
                        x-transition:enter="transition ease-out duration-1000 delay-200"
                        x-transition:enter-start="opacity-0 translate-y-8"
                        x-transition:enter-end="opacity-100 translate-y-0">
                        Mulai Petualangan Kuliner Anda Hari Ini!
                    </h2>
                    <p class="text-sm md:text-lg font-normal text-gray-50 mb-20 leading-relaxed" x-show="inView"
                        x-transition:enter="transition ease-out duration-1000 delay-400"
                        x-transition:enter-start="opacity-0 translate-y-8"
                        x-transition:enter-end="opacity-100 translate-y-0">
                        Bergabunglah dengan ribuan pengguna yang telah menemukan kemudahan dan kegembiraan memasak bersama
                        SavoryAI. Ciptakan hidangan lezat, hemat waktu, dan jelajahi rasa baru.
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4 justify-center items-center" x-show="inView"
                        x-transition:enter="transition ease-out duration-1000 delay-600"
                        x-transition:enter-start="opacity-0 translate-y-8 scale-95"
                        x-transition:enter-end="opacity-100 translate-y-0 scale-100">
                        <a href="{{ Auth::check() ? route('savoryai.index') : route('register') }}" wire:navigate
                            class="w-full sm:w-auto px-8 py-4 bg-gradient-to-r from-[#FF564E] to-[#ff834e] text-white text-base md:text-lg font-semibold rounded-xl shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300 focus:outline-none focus:ring-4 focus:ring-[#FF564E]/50">
                            {{ Auth::check() ? 'Masuk ke Dapur AI' : 'Daftar Gratis Sekarang' }}
                            <i class="fas fa-arrow-right ml-2"></i>
                        </a>

                        <a href="{{ route('explore-recipes.index') }}" wire:navigate
                            class="w-full sm:w-auto px-8 py-4 border-2 border-gray-300 text-base md:text-lg text-gray-50 font-semibold rounded-xl hover:border-[#FF564E] hover:text-[#FF564E] hover:bg-rose-50 transition-all duration-300 transform hover:scale-105">
                            Jelajahi Resep <i class="fas fa-search ml-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
