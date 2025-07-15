<div>
    {{-- display all recipes here --}}
    <div class="space-y-2 mb-10 text-center">
        <h1 class="text-3xl md:text-4xl font-bold font-display text-secondary">
            Semua Resep Masakan
        </h1>
        <p class="text-primary text-xs md:text-sm">
            Resep masakan yang tersedia di SavoryAI
        </p>
    </div>

    {{-- Advanced Filter Section --}}
    <div
        class="bg-primary/10 backdrop-blur-md backdrop-opacity-50 border-2 border-primary/60 rounded-xl p-4 sm:p-6 mb-8 shadow-sm">
        <div class="flex flex-col lg:flex-row gap-4 sm:gap-6 items-start lg:items-center">
            {{-- Category Pills --}}
            <div class="flex flex-wrap items-center gap-2 w-full lg:flex-1">
                <span class="text-sm font-medium text-gray-700 mb-2 sm:mb-0 sm:mr-2 w-full sm:w-auto">Filter:</span>
                <div class="flex flex-wrap gap-2 w-full sm:w-auto">
                    <button wire:click='setCategory("")'
                        class="px-3 sm:px-4 py-1.5 sm:py-2 {{ $category === '' ? 'bg-secondary hover:bg-secondary/90 text-white' : 'bg-white hover:bg-gray-100 text-gray-700' }} rounded-full text-xs sm:text-sm font-medium transition-all duration-300 shadow-sm flex-grow sm:flex-grow-0">
                        <i class="fa-solid fa-utensils mr-1"></i> Semua
                    </button>
                    <button wire:click='setCategory("utama")'
                        class="px-3 sm:px-4 py-1.5 sm:py-2 {{ $category === 'utama' ? 'bg-secondary hover:bg-secondary/90 text-white' : 'bg-white hover:bg-gray-100 text-gray-700' }} rounded-full text-xs sm:text-sm font-medium transition-all duration-300 shadow-sm border flex-grow sm:flex-grow-0">
                        <i class="fa-solid fa-drumstick-bite mr-1"></i> Makanan Utama
                    </button>
                    <button wire:click='setCategory("dessert")'
                        class="px-3 sm:px-4 py-1.5 sm:py-2 {{ $category === 'dessert' ? 'bg-secondary hover:bg-secondary/90 text-white' : 'bg-white hover:bg-gray-100 text-gray-700' }} rounded-full text-xs sm:text-sm font-medium transition-all duration-300 shadow-sm border flex-grow sm:flex-grow-0">
                        <i class="fa-solid fa-ice-cream mr-1"></i> Dessert
                    </button>
                    <button wire:click='setCategory("diet")'
                        class="px-3 sm:px-4 py-1.5 sm:py-2 {{ $category === 'diet' ? 'bg-secondary text-white' : 'bg-white hover:bg-gray-100 text-gray-700' }} rounded-full text-xs sm:text-sm font-medium transition-all duration-300 shadow-sm border flex-grow sm:flex-grow-0">
                        <i class="fa-solid fa-fire-flame-curved mr-1"></i> Diet Friendly
                    </button>
                </div>
            </div>

            {{-- Search and Sort --}}
            <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 w-full lg:w-auto">
                <div class="relative flex-grow sm:flex-grow-0">
                    <input type="text" placeholder="Cari resep favorit..." wire:model.live.debounce.300ms='search'
                        class="w-full sm:w-64 pl-10 pr-4 py-2 sm:py-2.5 text-xs sm:text-sm font-medium border border-gray-200 rounded-full focus:ring-2 focus:ring-secondary/20 focus:border-secondary outline-none transition-all duration-300 bg-white">
                    <i class="fa-solid fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                </div>
                <select wire:model.live.debounce.300ms='sortBy'
                    class="w-full sm:w-auto px-4 py-2 sm:py-2.5 text-xs sm:text-sm font-medium border border-gray-200 rounded-full focus:ring-2 focus:ring-secondary/20 focus:border-secondary outline-none bg-white">
                    <option value="latest">Terbaru</option>
                    <option value="popular">Terpopuler</option>
                    <option value="rating">Rating Tertinggi</option>
                    <option value="fastest">Waktu Tercepat</option>
                </select>
            </div>
        </div>
    </div>

    {{-- loading state --}}
    <div class="w-full flex justify-center items-center">
        <div wire:loading class="py-6">
            <div class="flex items-center space-x-2">
                <i class="fa-solid fa-spinner fa-spin text-3xl text-secondary"></i>
                <span class="text-base text-secondary">Memuat...</span>
            </div>
        </div>
    </div>

    {{-- Masonry-Style Recipe Grid --}}
    <div wire:loading.remove class="grid grid-cols-1 lg:grid-cols-3 gap-5 mb-12">
        @forelse ($recipes as $recipe)
            {{-- Featured Large Card --}}
            <div
                class="break-inside-avoid overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 group mb-6 rounded-2xl bg-white border-2 border-primary/10">
                <div class="relative h-72">
                    @if ($recipe->image)
                        <img src="{{ $recipe['image'] }}" alt="{{ $recipe['name'] }}"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    @else
                        <div
                            class="w-full h-full bg-gradient-to-br from-primary/5 to-secondary/5 flex justify-center items-center">
                            <i class="fa fa-utensils text-4xl text-primary/30"></i>
                        </div>
                    @endif
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                    </div>

                    {{-- Top badges --}}
                    <div
                        class="absolute w-full top-0 p-4 flex justify-between opacity-100 group-hover:opacity-100 transition-opacity duration-500">
                        <div
                            class="flex items-center gap-1 px-3 py-1.5 bg-white/95 backdrop-blur-sm rounded-full shadow-lg">
                            @if ($recipe->ratings->count() > 0)
                                @for ($i = 1; $i <= 5; $i++)
                                    <i
                                        class="fa-{{ $i <= (int) number_format($recipe->ratings->avg('rating')) ? 'solid' : 'regular' }} fa-star group-hover:scale-110 transition-transform duration-300 text-yellow-400 text-sm"></i>
                                @endfor
                            @else
                                @for ($i = 1; $i <= 5; $i++)
                                    <i
                                        class="text-gray-300 fa-regular fa-star group-hover:scale-110 transition-transform duration-300 text-sm"></i>
                                @endfor
                            @endif
                            <span
                                class="text-gray-700 text-sm font-medium ml-1">({{ $recipe->ratings->count() }})</span>
                        </div>
                        <span
                            class="bg-white/95 backdrop-blur-sm text-primary px-3 py-1.5 rounded-full text-sm font-medium shadow-lg">
                            <i class="fa fa-clock mr-1"></i>
                            {{ $recipe->cooking_time }} menit
                        </span>
                    </div>

                    {{-- Content overlay --}}
                    <div
                        class="absolute bottom-0 left-0 right-0 p-6 transform translate-y-2 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-500">
                        <h3 class="text-white text-xl font-bold mb-2 drop-shadow-lg">
                            {{ $recipe->name }}
                        </h3>
                        <p class="text-white/90 text-sm font-normal mb-4 line-clamp-2 drop-shadow-md">
                            Resep gudeg autentik dengan cita rasa tradisional yang kaya bumbu
                        </p>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                @if ($recipe->user->avatar)
                                    <img src="{{ $recipe->user->avatar }}" alt="{{ $recipe->user->name }}"
                                        class="w-8 h-8 rounded-full object-cover ring-2 ring-white/50">
                                @else
                                    <div
                                        class="flex justify-center items-center bg-white/20 backdrop-blur-sm text-white h-8 w-8 rounded-full text-sm ring-2 ring-white/50">
                                        <i class="fa fa-user"></i>
                                    </div>
                                @endif
                                <p class="text-sm font-medium text-white capitalize drop-shadow-md">
                                    {{ $recipe->user->name }}
                                </p>
                            </div>
                            <a href="{{ route('explore-recipes.show', $recipe->id) }}" wire:navigate
                                class="bg-secondary hover:bg-secondary/90 text-white text-sm font-medium px-4 py-2 rounded-full flex items-center gap-2 transform hover:scale-105 transition-all duration-300 shadow-lg">
                                <span>Lihat Detail</span>
                                <i class="fa fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-12">
                <div class="text-gray-400 mb-4">
                    <i class="fa-solid fa-search text-6xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-600 mb-2">Tidak ada resep ditemukan</h3>
                <p class="text-base font-medium text-gray-500">Coba ubah kata kunci pencarian atau filter yang digunakan
                </p>
            </div>
        @endforelse

    </div>

    {{-- Load More with Animation --}}
    @if ($recipes->hasMorePages())
        <div class="flex flex-col items-center mb-12">
            <button wire:click="loadMoreRecipes" wire:loading.attr="disabled"
                class="group px-8 py-4 text-sm bg-secondary/10 border-2 border-secondary/50 backdrop-blur-sm backdrop-opacity-50 bg-size-200 bg-pos-0 hover:bg-pos-100 text-secondary font-semibold rounded-2xl shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-500 flex items-center gap-3 disabled:opacity-50 disabled:cursor-not-allowed">
                <span wire:loading.remove wire:target="loadMoreRecipes">Jelajahi Resep Lainnya</span>
                <span wire:loading wire:target="loadMoreRecipes">Memuat...</span>
                <i class="fa-solid fa-arrow-down group-hover:translate-y-1 transition-transform duration-300"
                    wire:loading.remove wire:target="loadMoreRecipes"></i>
                <i class="fa-solid fa-spinner fa-spin" wire:loading wire:target="loadMoreRecipes"></i>
            </button>
            <p class="text-gray-500 text-sm font-medium mt-3">Menampilkan {{ $recipes->count() }} dari
                {{ $recipes->total() }} resep tersedia</p>
        </div>
    @else
        <div class="text-center mb-12">
            <p class="text-gray-500 text-sm font-medium">Semua resep telah ditampilkan ({{ $recipes->total() }} resep)
            </p>
        </div>
    @endif
</div>
