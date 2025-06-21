<div>
    {{-- display all recipes here --}}
    <div class="space-y-2 mb-10 text-center">
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
                <button wire:click='setCategory("")'
                    class="px-4 py-2 {{ $category === '' ? 'bg-secondary hover:bg-secondary/90 text-white' : 'bg-white hover:bg-gray-100 text-gray-700' }} rounded-full text-sm font-medium transition-all duration-300 shadow-sm">
                    <i class="fa-solid fa-utensils mr-1"></i> Semua
                </button>
                <button wire:click='setCategory("utama")'
                    class="px-4 py-2 {{ $category === 'utama' ? 'bg-secondary hover:bg-secondary/90 text-white' : 'bg-white hover:bg-gray-100 text-gray-700' }} rounded-full text-sm font-medium transition-all duration-300 shadow-sm border">
                    <i class="fa-solid fa-drumstick-bite mr-1"></i> Makanan Utama
                </button>
                <button wire:click='setCategory("dessert")'
                    class="px-4 py-2 {{ $category === 'dessert' ? 'bg-secondary hover:bg-secondary/90 text-white' : 'bg-white hover:bg-gray-100 text-gray-700' }} rounded-full text-sm font-medium transition-all duration-300 shadow-sm border">
                    <i class="fa-solid fa-ice-cream mr-1"></i> Dessert
                </button>
                <button wire:click='setCategory("diet")'
                    class="px-4 py-2 {{ $category === 'diet' ? 'bg-secondary text-white' : 'bg-white hover:bg-gray-100 text-gray-700' }} rounded-full text-sm font-medium transition-all duration-300 shadow-sm border">
                    <i class="fa-solid fa-fire-flame-curved mr-1"></i> Diet Friendly
                </button>
            </div>

            {{-- Search and Sort --}}
            <div class="flex items-center gap-3">
                <div class="relative">
                    <input type="text" placeholder="Cari resep favorit..." wire:model.live.debounce.300ms='search'
                        class="pl-10 pr-4 py-2.5 w-64 text-sm font-medium border border-gray-200 rounded-full focus:ring-2 focus:ring-secondary/20 focus:border-secondary outline-none transition-all duration-300 bg-white">
                    <i class="fa-solid fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                </div>
                <select wire:model.live.debounce.300ms='sortBy'
                    class="px-4 py-2.5 text-sm font-medium border border-gray-200 rounded-full focus:ring-2 focus:ring-secondary/20 focus:border-secondary outline-none bg-white">
                    <option value="latest">Terbaru</option>
                    <option value="popular">Terpopuler</option>
                    <option value="rating">Rating Tertinggi</option>
                    <option value="fastest">Waktu Tercepat</option>
                </select>
            </div>
        </div>
    </div>

    {{-- Masonry-Style Recipe Grid --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5 mb-12">
        @foreach ($recipes as $recipe)
            {{-- Featured Large Card --}}
            <div
                class="break-inside-avoid bg-gradient-to-br from-secondary to-primary overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 group mb-6 rounded-xl">
                <div class="relative h-72">
                    @if ($recipe->image)
                        <img src="{{ asset($recipe['image']) }}" alt="{{ $recipe['name'] }}"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    @else
                        <div class="w-full h-full bg-gray-100 flex justify-center items-center">
                            <i class="fa fa-utensils text-3xl text-gray-300"></i>
                        </div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/40 to-transparent"></div>
                    <div class="absolute top-4 right-4 text-xs font-normal">
                        <a href="{{ route('explore-recipes.show', $recipe->id) }}"
                            class="bg-yellow-400 text-black px-3 py-1 rounded-full flex items-center gap-1">
                            <i class="fa fa-up-right-from-square"></i> Lihat Detail
                        </a>
                    </div>
                    <div class="absolute bottom-4 left-4 right-4">
                        <h3 class="text-white text-lg font-bold mb-1">
                            {{ $recipe->name }}
                        </h3>
                        <p class="text-white/90 text-sm font-normal mb-3 line-clamp-1">
                            Resep gudeg autentik dengan cita rasa
                            tradisional yang
                            kaya
                            bumbu
                        </p>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-1 text-xs">
                                @if ($recipe->ratings->count() > 0)
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i
                                            class="fa-{{ $i <= (int) number_format($recipe->ratings->avg('rating')) ? 'solid' : 'regular' }} fa-star group-hover:scale-110 transition-transform duration-300 text-yellow-500"></i>
                                    @endfor
                                @else
                                    <i
                                        class="text-white fa-regular fa-star group-hover:scale-110 transition-transform duration-300"></i>
                                    <i
                                        class="text-white fa-regular fa-star group-hover:scale-110 transition-transform duration-300"></i>
                                    <i
                                        class="text-white fa-regular fa-star group-hover:scale-110 transition-transform duration-300"></i>
                                    <i
                                        class="text-white fa-regular fa-star group-hover:scale-110 transition-transform duration-300"></i>
                                    <i
                                        class="text-white fa-regular fa-star group-hover:scale-110 transition-transform duration-300"></i>
                                @endif
                                <span
                                    class="text-white text-sm">({{ $recipe->ratings_avg_rating ? (int) $recipe->ratings_avg_rating : '0' }})</span>
                            </div>
                            <span class="bg-white/20 backdrop-blur-sm text-white px-2 py-1 rounded-full text-xs">
                                <i class="fa fa-clock mr-1"></i>
                                {{ $recipe->cooking_time }} menit
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

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
