<div>
    {{-- Featured Section --}}
    <div class="w-full grid grid-cols-4 gap-4 mb-12">
        <div
            class="h-64 col-span-2 bg-white shadow-md hover:shadow-xl flex group transition-all duration-500 overflow-hidden rounded-xl">
            <div class="w-[40%] h-full relative">
                <img src="{{ asset('storage/img/main/main-background.jpg') }}" alt="popular-images"
                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                <div
                    class="opacity-0 group-hover:opacity-100 absolute top-0 left-0 w-full h-full bg-gradient-to-t from-black/50 to-transparent transition-opacity duration-500">
                </div>
            </div>
            <div class="w-[60%] h-full px-6 py-6">
                <div class="w-fit mb-4 p-2 bg-secondary text-sm font-medium text-white">
                    Featured Recipes
                </div>
                <h3 class="mb-2 text-base font-semibold">
                    Resep praktis 30 menit yang akan menyelamatkan anda dari masalah kelaparan
                </h3>
                <p class="text-sm font-normal text-gray-600">
                    Berbagai resep masakan nusantara yang mudah dan praktis untuk anda coba. Tunggu apa lagi? coba
                    sekarang!
                </p>
            </div>
        </div>
        <div
            class="h-64 shadow-md hover:shadow-xl transition-all duration-500 relative group cursor-pointer overflow-hidden rounded-xl">
            <img src="{{ asset('storage/img/main/main-background.jpg') }}" alt="popular-images"
                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
            <div
                class="absolute top-0 left-0 w-full h-full bg-gradient-to-t from-black/50 via-black/10 to-transparent group-hover:bg-black/50 transition-all duration-500">
            </div>
            <div
                class="absolute bottom-5 left-5 group-hover:bottom-1/2 group-hover:left-1/2 group-hover:-translate-x-1/2 group-hover:translate-y-1/2 transition-all duration-500">
                <h3 class="text-lg font-semibold text-white transition-all duration-500 group-hover:text-center">
                    Desserts
                </h3>
                <p class="hidden group-hover:block text-center text-sm font-medium text-gray-300">
                    100+ Recipes
                </p>
            </div>
        </div>
        <div
            class="h-64 shadow-md hover:shadow-xl transition-all duration-500 relative group cursor-pointer overflow-hidden rounded-xl">
            <img src="{{ asset('storage/img/main/main-background.jpg') }}" alt="popular-images"
                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
            <div
                class="absolute top-0 left-0 w-full h-full bg-gradient-to-t from-black/50 via-black/10 to-transparent group-hover:bg-black/50 transition-all duration-500">
            </div>
            <div
                class="absolute bottom-5 left-5 group-hover:bottom-1/2 group-hover:left-1/2 group-hover:-translate-x-1/2 group-hover:translate-y-1/2 transition-all duration-500">
                <h3 class="text-lg font-semibold text-white transition-all duration-500 group-hover:text-center">
                    Main Course
                </h3>
                <p class="hidden group-hover:block text-center text-sm font-medium text-gray-300">
                    100+ Recipes
                </p>
            </div>
        </div>
    </div>

    {{-- Quick Stats Section with Glassmorphism Effects --}}
    <div
        class="relative bg-primary/10 backdrop-blur-md backdrop-opacity-50 border-2 border-primary/60 rounded-xl p-8 overflow-hidden shadow-xl">
        {{-- Glassmorphism Background Effects --}}
        {{-- <div class="absolute inset-0 bg-gradient-to-r from-secondary/10 via-primary/10 to-secondary/10"></div>
        <div class="absolute -top-32 -left-32 w-64 h-64 bg-secondary/30 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-32 -right-32 w-64 h-64 bg-primary/30 rounded-full blur-3xl"></div> --}}

        {{-- Content Container --}}
        <div class="relative z-10 grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
            <div class="group cursor-pointer">
                <div
                    class="relative w-16 h-16 bg-white/10 backdrop-blur-md rounded-2xl flex items-center justify-center mx-auto mb-3 border border-white/20 group-hover:bg-secondary/5 transition-all duration-500">
                    <i
                        class="fa-solid fa-utensils text-2xl text-secondary relative z-10 group-hover:scale-110 transition-transform duration-300"></i>
                </div>
                <h4
                    class="text-2xl font-bold text-secondary mb-1 group-hover:text-secondary/80 transition-colors duration-300">
                    150+</h4>
                <p class="text-gray-600 text-sm font-medium">Total Resep</p>
            </div>

            <div class="group cursor-pointer">
                <div
                    class="relative w-16 h-16 bg-white/10 backdrop-blur-md rounded-2xl flex items-center justify-center mx-auto mb-3 border border-white/20 group-hover:bg-primary/5 transition-all duration-500">
                    <i
                        class="fa-solid fa-users text-2xl text-primary relative z-10 group-hover:scale-110 transition-transform duration-300"></i>
                </div>
                <h4
                    class="text-2xl font-bold text-primary mb-1 group-hover:text-primary/80 transition-colors duration-300">
                    25+</h4>
                <p class="text-gray-600 text-sm font-medium">Creators</p>
            </div>

            <div class="group cursor-pointer">
                <div
                    class="relative w-16 h-16 bg-white/10 backdrop-blur-md rounded-2xl flex items-center justify-center mx-auto mb-3 border border-white/20 group-hover:bg-yellow-400/5 transition-all duration-500">
                    <i
                        class="fa-solid fa-star text-2xl text-yellow-400 relative z-10 group-hover:scale-110 transition-transform duration-300"></i>
                </div>
                <h4
                    class="text-2xl font-bold text-yellow-500 mb-1 group-hover:text-yellow-400/80 transition-colors duration-300">
                    4.8</h4>
                <p class="text-gray-600 text-sm font-medium">Rating Rata-rata</p>
            </div>

            <div class="group cursor-pointer">
                <div
                    class="relative w-16 h-16 bg-white/10 backdrop-blur-md rounded-2xl flex items-center justify-center mx-auto mb-3 border border-white/20 group-hover:bg-green-500/5 transition-all duration-500">
                    <i
                        class="fa-solid fa-heart text-2xl text-rose-500 relative z-10 group-hover:scale-110 transition-transform duration-300"></i>
                </div>
                <h4
                    class="text-2xl font-bold text-rose-500 mb-1 group-hover:text-rose-500/80 transition-colors duration-300">
                    10K+</h4>
                <p class="text-gray-600 text-sm font-medium">Resep Favorit</p>
            </div>
        </div>

        {{-- Glassmorphism Light Effects --}}
        <div
            class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-full h-full bg-gradient-radial from-white/5 to-transparent rounded-full pointer-events-none">
        </div>
    </div>
</div>
