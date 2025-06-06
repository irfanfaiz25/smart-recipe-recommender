<div>
    {{-- display all recipes here --}}
    <div class="space-y-2 mb-10">
        <h1 class="text-4xl font-bold font-display text-secondary">
            Semua Resep Masakan
        </h1>
        <p class="text-primary text-sm">
            Resep masakan yang tersedia di SavoryAI
        </p>
    </div>

    {{-- Advanced Filter Section --}}
    <div
        class="bg-primary/10 backdrop-blur-md backdrop-opacity-50 border-2 border-primary/60 rounded-xl p-6 mb-8 shadow-sm">
        <div class="flex flex-col lg:flex-row gap-6 items-center">
            {{-- Category Pills --}}
            <div class="flex flex-wrap items-center gap-2 flex-1">
                <span class="text-sm font-medium text-gray-700 mr-2">Filter:</span>
                <button
                    class="px-4 py-2 bg-secondary text-white rounded-full text-sm font-medium hover:bg-secondary/90 transition-all duration-300 shadow-sm">
                    <i class="fa-solid fa-utensils mr-1"></i> Semua
                </button>
                <button
                    class="px-4 py-2 bg-white text-gray-700 rounded-full text-sm font-medium hover:bg-gray-100 transition-all duration-300 shadow-sm border">
                    <i class="fa-solid fa-drumstick-bite mr-1"></i> Makanan Utama
                </button>
                <button
                    class="px-4 py-2 bg-white text-gray-700 rounded-full text-sm font-medium hover:bg-gray-100 transition-all duration-300 shadow-sm border">
                    <i class="fa-solid fa-ice-cream mr-1"></i> Dessert
                </button>
                <button
                    class="px-4 py-2 bg-white text-gray-700 rounded-full text-sm font-medium hover:bg-gray-100 transition-all duration-300 shadow-sm border">
                    <i class="fa-solid fa-fire-flame-curved mr-1"></i> Diet Friendly
                </button>
            </div>

            {{-- Search and Sort --}}
            <div class="flex items-center gap-3">
                <div class="relative">
                    <input type="text" placeholder="Cari resep favorit..."
                        class="pl-10 pr-4 py-2.5 w-64 text-sm font-medium border border-gray-200 rounded-full focus:ring-2 focus:ring-secondary/20 focus:border-secondary outline-none transition-all duration-300 bg-white">
                    <i class="fa-solid fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                </div>
                <select
                    class="px-4 py-2.5 text-sm font-medium border border-gray-200 rounded-full focus:ring-2 focus:ring-secondary/20 focus:border-secondary outline-none bg-white">
                    <option>Terpopuler</option>
                    <option>Terbaru</option>
                    <option>Rating Tertinggi</option>
                    <option>Waktu Tercepat</option>
                </select>
            </div>
        </div>
    </div>

    {{-- Masonry-Style Recipe Grid --}}
    <div class="columns-1 md:columns-2 lg:columns-3 xl:columns-3 gap-5 space-y-6 mb-12">

        @for ($i = 0; $i < 12; $i++)
            {{-- Featured Large Card --}}
            <div
                class="break-inside-avoid bg-gradient-to-br from-secondary to-primary overflow-hidden shadow-md hover:shadow-xl transition-all duration-500 group mb-6 rounded-xl">
                <div class="relative h-72">
                    <img src="{{ asset('storage/img/main/secondary-background.jpg') }}" alt="featured-recipe"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/40 to-transparent"></div>
                    <div class="absolute top-4 left-4">
                        <span
                            class="bg-yellow-400 text-black px-3 py-1 rounded-full text-xs font-bold flex items-center gap-1">
                            <i class="fa-solid fa-crown"></i> FEATURED
                        </span>
                    </div>
                    <div class="absolute bottom-4 left-4 right-4">
                        <h3 class="text-white text-lg font-bold mb-1">Nasi Gudeg Jogja Istimewa</h3>
                        <p class="text-white/90 text-sm font-normal mb-3">
                            Resep gudeg autentik dengan cita rasa
                            tradisional yang
                            kaya
                            bumbu
                        </p>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <div class="flex items-center gap-1">
                                    <i class="fa-solid fa-star text-yellow-400 text-xs"></i>
                                    <i class="fa-solid fa-star text-yellow-400 text-xs"></i>
                                    <i class="fa-solid fa-star text-yellow-400 text-xs"></i>
                                    <i class="fa-solid fa-star text-yellow-400 text-xs"></i>
                                    <i class="fa-solid fa-star-half text-yellow-400 text-xs"></i>
                                </div>
                                <span class="text-white text-sm">(4.9)</span>
                            </div>
                            <span class="bg-white/20 backdrop-blur-sm text-white px-2 py-1 rounded-full text-xs">
                                <i class="fa fa-clock mr-1"></i>
                                2 jam
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        @endfor

    </div>

    {{-- Load More with Animation --}}
    <div class="flex flex-col items-center mb-12">
        <button
            class="group px-8 py-4 text-sm bg-secondary/10 border-2 border-secondary/50 backdrop-blur-sm backdrop-opacity-50 bg-size-200 bg-pos-0 hover:bg-pos-100 text-secondary font-semibold rounded-2xl shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-500 flex items-center gap-3">
            <span>Jelajahi Resep Lainnya</span>
            <i class="fa-solid fa-arrow-down group-hover:translate-y-1 transition-transform duration-300"></i>
        </button>
        <p class="text-gray-500 text-sm font-medium mt-3">Menampilkan 12 dari 150+ resep tersedia</p>
    </div>
</div>
