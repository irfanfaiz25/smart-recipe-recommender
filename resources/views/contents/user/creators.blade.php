@extends('layouts.main')

@section('title', 'Creators')

@section('content')
    <div class="relative overflow-hidden min-h-screen">
        <!-- Hero Section with Background -->
        <div class="absolute inset-0 w-full h-screen">
            <img src="{{ asset('/storage/img/main/creators-hero.jpg') }}" class="w-full h-full object-cover"
                alt="creators background">
            <div class="absolute inset-0 bg-black/70"></div>
        </div>

        <!-- Hero Content -->
        @if (Auth::user()->creators()->exists())
            <div
                class="relative z-10 container mx-auto px-4 sm:px-6 lg:px-8 flex flex-col items-center h-screen justify-center">
                <h1
                    class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-display font-bold text-center bg-gradient-to-r from-[#FF564E] via-[#ff834e] to-[#FAD126] text-transparent bg-clip-text mb-4 sm:mb-6 py-2 leading-tight">
                    Selamat Datang Kembali, {{ Auth::user()->name }}!
                </h1>
                <p
                    class="text-lg sm:text-xl md:text-2xl text-white text-center max-w-xs sm:max-w-2xl lg:max-w-3xl font-medium mb-12 sm:mb-16 lg:mb-20 px-4">
                    Kelola resepmu dan terus menginspirasi dunia dengan kreasi kulinermu
                    yang istimewa
                </p>
                <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 w-full sm:w-auto px-4 sm:px-0">
                    <a href="{{ route('dashboard.index') }}"
                        class="px-6 sm:px-8 py-3 sm:py-4 bg-secondary hover:bg-secondary-hover text-white rounded-full text-lg sm:text-xl font-semibold transition-all transform hover:scale-105 hover:shadow-lg inline-flex items-center justify-center">
                        <i class="fa-solid fa-chart-line mr-2"></i>
                        Lihat Dashboard
                    </a>
                    <a href="{{ route('recipes.create') }}"
                        class="px-6 sm:px-8 py-3 sm:py-4 bg-white hover:bg-gray-100 text-secondary rounded-full text-lg sm:text-xl font-semibold transition-all transform hover:scale-105 hover:shadow-lg inline-flex items-center justify-center">
                        <i class="fa-solid fa-utensils mr-2"></i>
                        Buat Resep Baru
                    </a>
                </div>
            </div>
        @else
            <div
                class="relative z-10 container mx-auto px-4 sm:px-6 lg:px-8 flex flex-col items-center h-screen justify-center">
                <h1
                    class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-display font-bold text-center bg-gradient-to-r from-[#FF564E] via-[#ff834e] to-[#FAD126] text-transparent bg-clip-text mb-4 sm:mb-6 leading-tight">
                    Become a Creators
                </h1>
                <p
                    class="text-lg sm:text-xl md:text-2xl text-white text-center max-w-xs sm:max-w-2xl lg:max-w-3xl font-medium mb-8 sm:mb-10 px-4">
                    Bagikan karya kuliner terbaikmu kepada dunia dan inspirasi orang lain dengan resep unikmu
                </p>
                <a href="#learn-more"
                    class="px-6 sm:px-8 py-3 sm:py-4 bg-secondary hover:bg-secondary-hover text-white rounded-full text-base sm:text-lg font-semibold transition-all transform hover:scale-105 hover:shadow-lg mx-4">
                    Bergabung dengan Creators
                </a>
            </div>
        @endif

        @if (!Auth::user()->creators()->exists())
            <!-- What is Creators Section -->
            <div id="learn-more"
                class="relative min-h-screen bg-white dark:bg-bg-dark-primary py-16 sm:py-24 lg:py-36 px-4 sm:px-8 lg:px-24">
                <div class="container mx-auto">
                    <div class="text-center mb-16 sm:mb-24 lg:mb-36">
                        <h2
                            class="text-3xl sm:text-4xl md:text-5xl font-display font-bold text-primary dark:text-primary-light mb-4 sm:mb-6">
                            Apa
                            itu
                            <span class="underline decoration-wavy decoration-secondary underline-offset-8">Creators</span>?
                        </h2>
                        <p
                            class="text-base sm:text-lg font-medium text-gray-700 dark:text-gray-300 max-w-xs sm:max-w-2xl lg:max-w-3xl mx-auto px-4">
                            Platform kami untuk para pecinta
                            makanan yang bersemangat untuk berbagi kreativitas kuliner mereka dengan komunitas pecinta
                            makanan
                            yang terus berkembang.
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 sm:gap-8 lg:gap-10 mb-12 sm:mb-16">
                        <div
                            class="group bg-white dark:bg-bg-dark-secondary p-6 sm:p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 hover:bg-gradient-to-br from-secondary/5 to-primary/5 border border-gray-200 hover:border-secondary/20">
                            <div
                                class="text-3xl sm:text-4xl mb-4 sm:mb-6 bg-secondary/10 w-12 h-12 sm:w-16 sm:h-16 rounded-xl flex items-center justify-center group-hover:bg-secondary/20 transition-all">
                                <i class="fa-solid fa-robot text-secondary group-hover:scale-110 transition-transform"></i>
                            </div>
                            <h3
                                class="text-xl sm:text-2xl font-bold mb-3 sm:mb-4 text-gray-800 dark:text-white group-hover:text-secondary transition-colors">
                                AI-Powered Recipes</h3>
                            <p
                                class="text-sm sm:text-base text-gray-600 dark:text-gray-400 group-hover:text-gray-700 dark:group-hover:text-gray-300 transition-colors">
                                Manfaatkan teknologi AI untuk mengoptimalkan dan meningkatkan kualitas resep yang kamu
                                bagikan.
                            </p>
                        </div>

                        <div
                            class="group bg-white dark:bg-bg-dark-secondary p-6 sm:p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 hover:bg-gradient-to-br from-secondary/5 to-primary/5 border border-gray-200 hover:border-secondary/20">
                            <div
                                class="text-3xl sm:text-4xl mb-4 sm:mb-6 bg-secondary/10 w-12 h-12 sm:w-16 sm:h-16 rounded-xl flex items-center justify-center group-hover:bg-secondary/20 transition-all">
                                <i
                                    class="fa-solid fa-chart-line text-secondary group-hover:scale-110 transition-transform"></i>
                            </div>
                            <h3
                                class="text-xl sm:text-2xl font-bold mb-3 sm:mb-4 text-gray-800 dark:text-white group-hover:text-secondary transition-colors">
                                Analytics & Insights</h3>
                            <p
                                class="text-sm sm:text-base text-gray-600 dark:text-gray-400 group-hover:text-gray-700 dark:group-hover:text-gray-300 transition-colors">
                                Pantau performa resepmu dengan analitik mendalam dan dapatkan wawasan untuk pengembangan
                                konten.
                            </p>
                        </div>

                        <div
                            class="group bg-white dark:bg-bg-dark-secondary p-6 sm:p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 hover:bg-gradient-to-br from-secondary/5 to-primary/5 border border-gray-200 hover:border-secondary/20">
                            <div
                                class="text-3xl sm:text-4xl mb-4 sm:mb-6 bg-secondary/10 w-12 h-12 sm:w-16 sm:h-16 rounded-xl flex items-center justify-center group-hover:bg-secondary/20 transition-all">
                                <i
                                    class="fa-solid fa-wand-magic-sparkles text-secondary group-hover:scale-110 transition-transform"></i>
                            </div>
                            <h3
                                class="text-xl sm:text-2xl font-bold mb-3 sm:mb-4 text-gray-800 dark:text-white group-hover:text-secondary transition-colors">
                                Smart Features
                            </h3>
                            <p
                                class="text-sm sm:text-base text-gray-600 dark:text-gray-400 group-hover:text-gray-700 dark:group-hover:text-gray-300 transition-colors">
                                Akses fitur cerdas seperti konversi otomatis, rekomendasi bahan, dan optimasi resep berbasis
                                AI.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- How to Become a Creator -->
            <div
                class="relative min-h-screen bg-gray-50 dark:bg-bg-dark-secondary py-16 sm:py-24 lg:py-36 px-4 sm:px-8 lg:px-24">
                <div class="container mx-auto">
                    <div class="text-center mb-20 sm:mb-32 lg:mb-40">
                        <h2
                            class="text-3xl sm:text-4xl md:text-5xl font-display font-bold text-primary dark:text-primary-light mb-4 sm:mb-6">
                            Cara Menjadi
                            <span
                                class="bg-clip-text text-transparent bg-gradient-to-r from-secondary to-accent">Creators</span>
                        </h2>
                        <p
                            class="text-base sm:text-lg font-medium text-gray-700 dark:text-gray-300 max-w-xs sm:max-w-2xl lg:max-w-3xl mx-auto px-4">
                            Ikuti langkah-langkah sederhana
                            ini untuk mulai berbagi keahlian kulinermu dengan komunitas kami.
                        </p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-16 sm:mb-24">
                        <div
                            class="relative p-6 sm:p-8 lg:p-10 bg-white dark:bg-bg-dark-primary rounded-xl shadow-md hover:shadow-xl transition-all">
                            <div
                                class="absolute -top-3 -left-3 sm:-top-5 sm:-left-5 w-10 h-10 sm:w-14 sm:h-14 bg-primary text-white rounded-full flex items-center justify-center text-lg sm:text-xl font-bold">
                                1
                            </div>
                            <h3
                                class="text-lg sm:text-xl font-bold mb-2 sm:mb-3 mt-3 sm:mt-4 text-gray-800 dark:text-white">
                                Daftar Sebagai Creators
                            </h3>
                            <p class="text-sm sm:text-base text-gray-600 dark:text-gray-400">
                                Daftar dan lengkapi profilmu dengan latar
                                belakang dan
                                minat kulinermu.
                            </p>
                        </div>
                        <div
                            class="relative p-6 sm:p-8 lg:p-10 bg-white dark:bg-bg-dark-primary rounded-xl shadow-md hover:shadow-xl transition-all">
                            <div
                                class="absolute -top-3 -left-3 sm:-top-5 sm:-left-5 w-10 h-10 sm:w-14 sm:h-14 bg-primary text-white rounded-full flex items-center justify-center text-lg sm:text-xl font-bold">
                                2
                            </div>
                            <h3
                                class="text-lg sm:text-xl font-bold mb-2 sm:mb-3 mt-3 sm:mt-4 text-gray-800 dark:text-white">
                                Ajukan Status Creators
                            </h3>
                            <p class="text-sm sm:text-base text-gray-600 dark:text-gray-400">
                                Kirim aplikasimu dengan menyoroti hasrat memasak dan
                                pembuatan resepmu.
                            </p>
                        </div>
                        <div
                            class="relative p-6 sm:p-8 lg:p-10 bg-white dark:bg-bg-dark-primary rounded-xl shadow-md hover:shadow-xl transition-all">
                            <div
                                class="absolute -top-3 -left-3 sm:-top-5 sm:-left-5 w-10 h-10 sm:w-14 sm:h-14 bg-primary text-white rounded-full flex items-center justify-center text-lg sm:text-xl font-bold">
                                3
                            </div>
                            <h3
                                class="text-lg sm:text-xl font-bold mb-2 sm:mb-3 mt-3 sm:mt-4 text-gray-800 dark:text-white">
                                Buat Resep Pertamamu</h3>
                            <p class="text-sm sm:text-base text-gray-600 dark:text-gray-400">
                                Bagikan hidangan khasmu dengan instruksi detail dan foto
                                berkualitas tinggi.
                            </p>
                        </div>
                        <div
                            class="relative p-6 sm:p-8 lg:p-10 bg-white dark:bg-bg-dark-primary rounded-xl shadow-md hover:shadow-xl transition-all">
                            <div
                                class="absolute -top-3 -left-3 sm:-top-5 sm:-left-5 w-10 h-10 sm:w-14 sm:h-14 bg-primary text-white rounded-full flex items-center justify-center text-lg sm:text-xl font-bold">
                                4
                            </div>
                            <h3
                                class="text-lg sm:text-xl font-bold mb-2 sm:mb-3 mt-3 sm:mt-4 text-gray-800 dark:text-white">
                                Terlibat dengan Komunitas
                            </h3>
                            <p class="text-sm sm:text-base text-gray-600 dark:text-gray-400">
                                Balas komentar, berkolaborasi dengan kreator lain, dan
                                bangun audiensmu.
                            </p>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Creators Form -->
            <div
                class="relative min-h-screen bg-white dark:bg-bg-dark-primary py-16 sm:py-24 lg:py-36 px-4 sm:px-8 lg:px-24 overflow-hidden">
                <!-- Background decorative elements -->
                <div
                    class="absolute -top-12 -right-12 sm:-top-24 sm:-right-24 w-32 h-32 sm:w-64 sm:h-64 bg-primary/10 rounded-full blur-3xl">
                </div>
                <div
                    class="absolute -bottom-16 -left-16 sm:-bottom-32 sm:-left-32 w-40 h-40 sm:w-80 sm:h-80 bg-secondary/10 rounded-full blur-3xl">
                </div>

                <div class="container mx-auto relative z-10">
                    <div class="text-center mb-16 sm:mb-20 lg:mb-28">
                        <h2
                            class="text-3xl sm:text-4xl md:text-5xl font-display font-bold text-primary dark:text-primary-light mb-4 sm:mb-6">
                            Daftar Sebagai
                            <span
                                class="bg-clip-text text-transparent bg-gradient-to-r from-secondary to-accent">Creators</span>
                        </h2>
                        <p
                            class="text-base sm:text-lg font-medium text-gray-700 dark:text-gray-300 max-w-xs sm:max-w-2xl lg:max-w-3xl mx-auto px-4">
                            Lengkapi data di bawah ini untuk memulai perjalanan kulinermu sebagai Creators SavoryAI
                        </p>
                    </div>

                    <div class="max-w-xs sm:max-w-2xl lg:max-w-3xl mx-auto">
                        @livewire('creators-form')
                    </div>

                </div>
            </div>
        @endif


    </div>
@endsection
