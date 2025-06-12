@extends('layouts.main')

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
            <div class="relative z-10 container mx-auto px-4 flex flex-col items-center h-screen justify-center">
                <h1
                    class="text-6xl md:text-7xl font-display font-bold text-center bg-gradient-to-r from-[#FF564E] via-[#ff834e] to-[#FAD126] text-transparent bg-clip-text mb-6 py-2">
                    Selamat Datang Kembali, {{ Auth::user()->name }}!
                </h1>
                <p class="text-xl md:text-2xl text-white text-center max-w-3xl font-medium mb-20">
                    Kelola resepmu dan terus menginspirasi dunia dengan kreasi kulinermu
                    yang istimewa
                </p>
                <div class="flex gap-4">
                    <a href="{{ route('dashboard.index') }}"
                        class="px-8 py-4 bg-secondary hover:bg-secondary-hover text-white rounded-full text-xl font-semibold transition-all transform hover:scale-105 hover:shadow-lg inline-flex items-center">
                        <i class="fa-solid fa-chart-line mr-2"></i>
                        Lihat Dashboard
                    </a>
                    <a href="{{ route('recipes.create') }}"
                        class="px-8 py-4 bg-white hover:bg-gray-100 text-secondary rounded-full text-xl font-semibold transition-all transform hover:scale-105 hover:shadow-lg inline-flex items-center">
                        <i class="fa-solid fa-utensils mr-2"></i>
                        Buat Resep Baru
                    </a>
                </div>
            </div>
        @else
            <div class="relative z-10 container mx-auto px-4 flex flex-col items-center h-screen justify-center">
                <h1
                    class="text-6xl md:text-7xl font-display font-bold text-center bg-gradient-to-r from-[#FF564E] via-[#ff834e] to-[#FAD126] text-transparent bg-clip-text mb-6">
                    Become a Creators
                </h1>
                <p class="text-xl md:text-2xl text-white text-center max-w-3xl font-medium mb-10">
                    Bagikan karya kuliner terbaikmu kepada dunia dan inspirasi orang lain dengan resep unikmu
                </p>
                <a href="#learn-more"
                    class="px-8 py-4 bg-secondary hover:bg-secondary-hover text-white rounded-full text-xl font-semibold transition-all transform hover:scale-105 hover:shadow-lg">
                    Bergabung dengan Creators
                </a>
            </div>
        @endif

        @if (!Auth::user()->creators()->exists())
            <!-- What is Creators Section -->
            <div id="learn-more" class="relative h-screen bg-white dark:bg-bg-dark-primary py-36 px-24">
                <div class="container mx-auto">
                    <div class="text-center mb-36">
                        <h2 class="text-4xl md:text-5xl font-display font-bold text-primary dark:text-primary-light mb-6">
                            Apa
                            itu
                            <span class="underline decoration-wavy decoration-secondary underline-offset-8">Creators</span>?
                        </h2>
                        <p class="text-lg font-medium text-gray-700 dark:text-gray-300 max-w-3xl mx-auto">
                            Platform kami untuk para pecinta
                            makanan yang bersemangat untuk berbagi kreativitas kuliner mereka dengan komunitas pecinta
                            makanan
                            yang terus berkembang.
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-10 mb-16">
                        <div
                            class="group bg-white dark:bg-bg-dark-secondary p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 hover:bg-gradient-to-br from-secondary/5 to-primary/5 border border-gray-200 hover:border-secondary/20">
                            <div
                                class="text-4xl mb-6 bg-secondary/10 w-16 h-16 rounded-xl flex items-center justify-center group-hover:bg-secondary/20 transition-all">
                                <i
                                    class="fa-solid fa-lightbulb text-secondary group-hover:scale-110 transition-transform"></i>
                            </div>
                            <h3
                                class="text-2xl font-bold mb-4 text-gray-800 dark:text-white group-hover:text-secondary transition-colors">
                                Bagikan Kreativitasmu</h3>
                            <p
                                class="text-base text-gray-600 dark:text-gray-400 group-hover:text-gray-700 dark:group-hover:text-gray-300 transition-colors">
                                Tampilkan resep unik dan teknik memasak kepada audiens
                                yang haus akan inspirasi kuliner.
                            </p>
                        </div>

                        <div
                            class="group bg-white dark:bg-bg-dark-secondary p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 hover:bg-gradient-to-br from-secondary/5 to-primary/5 border border-gray-200 hover:border-secondary/20">
                            <div
                                class="text-4xl mb-6 bg-secondary/10 w-16 h-16 rounded-xl flex items-center justify-center group-hover:bg-secondary/20 transition-all">
                                <i class="fa-solid fa-users text-secondary group-hover:scale-110 transition-transform"></i>
                            </div>
                            <h3
                                class="text-2xl font-bold mb-4 text-gray-800 dark:text-white group-hover:text-secondary transition-colors">
                                Bangun Pengikut</h3>
                            <p
                                class="text-base text-gray-600 dark:text-gray-400 group-hover:text-gray-700 dark:group-hover:text-gray-300 transition-colors">
                                Terhubung dengan pecinta makanan yang menghargai gaya
                                kulinermu dan bangun komunitasmu sendiri.
                            </p>
                        </div>

                        <div
                            class="group bg-white dark:bg-bg-dark-secondary p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 hover:bg-gradient-to-br from-secondary/5 to-primary/5 border border-gray-200 hover:border-secondary/20">
                            <div
                                class="text-4xl mb-6 bg-secondary/10 w-16 h-16 rounded-xl flex items-center justify-center group-hover:bg-secondary/20 transition-all">
                                <i class="fa-solid fa-star text-secondary group-hover:scale-110 transition-transform"></i>
                            </div>
                            <h3
                                class="text-2xl font-bold mb-4 text-gray-800 dark:text-white group-hover:text-secondary transition-colors">
                                Dapatkan Penghargaan
                            </h3>
                            <p
                                class="text-base text-gray-600 dark:text-gray-400 group-hover:text-gray-700 dark:group-hover:text-gray-300 transition-colors">
                                Tampil di platform kami dan terima umpan balik serta
                                apresiasi untuk kreasi kulinermu.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- How to Become a Creator -->
            <div class="relative h-screen bg-gray-50 dark:bg-bg-dark-secondary py-36 px-24">
                <div class="container mx-auto">
                    <div class="text-center mb-40">
                        <h2 class="text-4xl md:text-5xl font-display font-bold text-primary dark:text-primary-light mb-6">
                            Cara Menjadi
                            <span
                                class="bg-clip-text text-transparent bg-gradient-to-r from-secondary to-accent">Creators</span>
                        </h2>
                        <p class="text-lg font-medium text-gray-700 dark:text-gray-300 max-w-3xl mx-auto">
                            Ikuti langkah-langkah sederhana
                            ini untuk mulai berbagi keahlian kulinermu dengan komunitas kami.
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-24">
                        <div
                            class="relative p-10 bg-white dark:bg-bg-dark-primary rounded-xl shadow-md hover:shadow-xl transition-all">
                            <div
                                class="absolute -top-5 -left-5 w-14 h-14 bg-primary text-white rounded-full flex items-center justify-center text-xl font-bold">
                                1
                            </div>
                            <h3 class="text-xl font-bold mb-3 mt-4 text-gray-800 dark:text-white">
                                Daftar Sebagai Creators
                            </h3>
                            <p class="text-base text-gray-600 dark:text-gray-400">
                                Daftar dan lengkapi profilmu dengan latar
                                belakang dan
                                minat kulinermu.
                            </p>
                        </div>
                        <div
                            class="relative p-10 bg-white dark:bg-bg-dark-primary rounded-xl shadow-md hover:shadow-xl transition-all">
                            <div
                                class="absolute -top-5 -left-5 w-14 h-14 bg-primary text-white rounded-full flex items-center justify-center text-xl font-bold">
                                2
                            </div>
                            <h3 class="text-xl font-bold mb-3 mt-4 text-gray-800 dark:text-white">Ajukan Status Creators
                            </h3>
                            <p class="text-base text-gray-600 dark:text-gray-400">
                                Kirim aplikasimu dengan menyoroti hasrat memasak dan
                                pembuatan resepmu.
                            </p>
                        </div>
                        <div
                            class="relative p-10 bg-white dark:bg-bg-dark-primary rounded-xl shadow-md hover:shadow-xl transition-all">
                            <div
                                class="absolute -top-5 -left-5 w-14 h-14 bg-primary text-white rounded-full flex items-center justify-center text-xl font-bold">
                                3
                            </div>
                            <h3 class="text-xl font-bold mb-3 mt-4 text-gray-800 dark:text-white">Buat Resep Pertamamu</h3>
                            <p class="text-base text-gray-600 dark:text-gray-400">
                                Bagikan hidangan khasmu dengan instruksi detail dan foto
                                berkualitas tinggi.
                            </p>
                        </div>
                        <div
                            class="relative p-10 bg-white dark:bg-bg-dark-primary rounded-xl shadow-md hover:shadow-xl transition-all">
                            <div
                                class="absolute -top-5 -left-5 w-14 h-14 bg-primary text-white rounded-full flex items-center justify-center text-xl font-bold">
                                4
                            </div>
                            <h3 class="text-xl font-bold mb-3 mt-4 text-gray-800 dark:text-white">Terlibat dengan Komunitas
                            </h3>
                            <p class="text-base text-gray-600 dark:text-gray-400">
                                Balas komentar, berkolaborasi dengan kreator lain, dan
                                bangun audiensmu.
                            </p>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Creators Form -->
            <div class="relative h-screen bg-white dark:bg-bg-dark-primary py-36 px-24 overflow-hidden">
                <!-- Background decorative elements -->
                <div class="absolute -top-24 -right-24 w-64 h-64 bg-primary/10 rounded-full blur-3xl"></div>
                <div class="absolute -bottom-32 -left-32 w-80 h-80 bg-secondary/10 rounded-full blur-3xl"></div>

                <div class="container mx-auto relative z-10">
                    <div class="text-center mb-28">
                        <h2 class="text-4xl md:text-5xl font-display font-bold text-primary dark:text-primary-light mb-6">
                            Daftar Sebagai
                            <span
                                class="bg-clip-text text-transparent bg-gradient-to-r from-secondary to-accent">Creators</span>
                        </h2>
                        <p class="text-lg font-medium text-gray-700 dark:text-gray-300 max-w-3xl mx-auto">
                            Lengkapi data di bawah ini untuk memulai perjalanan kulinermu sebagai Creators SavoryAI
                        </p>
                    </div>

                    <div class="max-w-3xl mx-auto">
                        @livewire('creators-form')
                    </div>

                </div>
            </div>

            {{-- <div class="container mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-display font-bold text-primary dark:text-primary-light mb-6">
                    Kisah Sukses Kreator
                </h2>
                <p class="text-lg font-medium text-gray-700 dark:text-gray-300 max-w-3xl mx-auto">
                    Dengarkan dari anggota komunitas
                    kami yang telah berbagi hasrat kuliner mereka.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <div class="bg-gray-50 dark:bg-bg-dark-secondary p-8 rounded-xl shadow-md hover:shadow-xl transition-all">
                    <div class="flex items-center mb-6">
                        <div class="w-16 h-16 rounded-full bg-gray-300 mr-4"></div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-800 dark:text-white">Sarah Johnson</h3>
                            <p class="text-base text-secondary">Ibu Rumah Tangga</p>
                        </div>
                    </div>
                    <p class="text-base text-gray-600 dark:text-gray-400 italic">
                        "Menjadi Creators memungkinkan saya berbagi resep
                        keluarga dengan dunia. Umpan balik yang saya terima luar biasa dan menginspirasi!"
                    </p>
                </div>
                <div class="bg-gray-50 dark:bg-bg-dark-secondary p-8 rounded-xl shadow-md hover:shadow-xl transition-all">
                    <div class="flex items-center mb-6">
                        <div class="w-16 h-16 rounded-full bg-gray-300 mr-4"></div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-800 dark:text-white">Michael Chen</h3>
                            <p class="text-base text-secondary">Penggiat Kuliner</p>
                        </div>
                    </div>
                    <p class="text-base text-gray-600 dark:text-gray-400 italic">
                        "Sebagai penggiat kuliner, menjadi Creators
                        memberi saya platform untuk bereksperimen dan menerima umpan balik berharga dari koki
                        berpengalaman."
                    </p>
                </div>
                <div class="bg-gray-50 dark:bg-bg-dark-secondary p-8 rounded-xl shadow-md hover:shadow-xl transition-all">
                    <div class="flex items-center mb-6">
                        <div class="w-16 h-16 rounded-full bg-gray-300 mr-4"></div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-800 dark:text-white">Priya Patel</h3>
                            <p class="text-base text-secondary">Wiraswasta</p>
                        </div>
                    </div>
                    <p class="text-base text-gray-600 dark:text-gray-400 italic">
                        "Program Creators telah menghubungkan saya dengan
                        banyak pecinta makanan yang menghargai masakan daerah autentik. Ini adalah perjalanan yang luar
                        biasa!"
                    </p>
                </div>
            </div>
        </div> --}}

            <!-- CTA Section -->
            <div class="relative bg-primary py-16 px-4">
                <div class="container mx-auto text-center">
                    <h2 class="text-4xl font-display font-bold text-white mb-6">Siap Berbagi Kreasi Kulinermu?</h2>
                    <p class="text-xl text-white/90 max-w-2xl mx-auto mb-10">Bergabunglah dengan komunitas kreator makanan
                        yang
                        bersemangat dan inspirasi orang lain dengan resep unikmu.</p>
                    <a href="#"
                        class="px-8 py-4 bg-white text-primary hover:bg-gray-100 rounded-full text-xl font-bold transition-all transform hover:scale-105 hover:shadow-lg inline-flex items-center">
                        <span>Jadi Kreator Sekarang</span>
                        <i class="fa-solid fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        @endif


    </div>
@endsection
