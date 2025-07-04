<div class="mt-20 w-full space-y-4">
    <!-- Search and Filter Section -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 md:gap-6 mb-6">
        <div class="w-full md:w-1/3">
            <div class="relative">
                <input type="text" placeholder="Cari resep favorit..." wire:model.live.debounce.300ms="search"
                    class="w-full bg-white dark:bg-bg-dark-primary placeholder:text-slate-400 text-text-primary dark:text-text-dark-primary text-sm border border-gray-200 dark:border-[#393939] rounded-full pl-10 pr-4 py-2.5 transition duration-300 ease focus:outline-none focus:border-secondary focus:ring-2 focus:ring-secondary/20 hover:border-gray-300 shadow-md">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fa-solid fa-magnifying-glass text-gray-400"></i>
                </div>
            </div>
        </div>
        <div class="flex flex-col sm:flex-row w-full md:w-auto gap-3">
            <select wire:model.live.debounce.300ms="category"
                class="w-full sm:w-auto bg-white dark:bg-bg-dark-primary text-text-primary dark:text-text-dark-primary text-sm border border-gray-200 dark:border-[#393939] rounded-full px-4 py-2.5 transition duration-300 ease focus:outline-none focus:border-secondary focus:ring-2 focus:ring-secondary/20 hover:border-gray-300 shadow-md">
                <option value="">Semua Kategori</option>
                <option value="rendah">Kalori Rendah</option>
                <option value="sedang">Kalori Sedang</option>
                <option value="tinggi">Kalori Tinggi</option>
            </select>
            <select wire:model.live.debounce.300ms="sortBy"
                class="w-full sm:w-auto bg-white dark:bg-bg-dark-primary text-text-primary dark:text-text-dark-primary text-sm border border-gray-200 dark:border-[#393939] rounded-full px-4 py-2.5 transition duration-300 ease focus:outline-none focus:border-secondary focus:ring-2 focus:ring-secondary/20 hover:border-gray-300 shadow-md">
                <option value="latest">Terbaru</option>
                <option value="higher">Rating Tertinggi</option>
                <option value="lower">Rating Terendah</option>
            </select>
        </div>
    </div>

    <!-- Bookmarks Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        {{-- @dd($recipes) --}}
        @forelse ($recipes as $recipe)
            <div
                class="group relative bg-white dark:bg-bg-dark-primary rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-xl hover:-translate-y-1 hover:scale-[1.02]">
                <!-- Recipe Image with Overlay -->
                <div class="relative h-48 overflow-hidden">
                    @if ($recipe->image)
                        <img src="{{ $recipe->image }}" alt="{{ $recipe->name }}"
                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                    @else
                        <div class="h-full w-full flex justify-center items-center bg-gray-200 dark:bg-gray-700">
                            <i class="fa-regular fa-image text-4xl text-gray-400 dark:text-gray-500"></i>
                        </div>
                    @endif

                    <!-- Category Badge -->
                    <div
                        class="absolute top-3 left-3 bg-primary/90 text-white text-xs font-medium px-2.5 py-1 rounded-full shadow-md">
                        {{ $recipe->category->name ?? 'Uncategorized' }}
                    </div>

                    <!-- Calories Badge -->
                    <div
                        class="absolute top-3 right-3 bg-secondary/90 text-white text-xs font-medium px-2.5 py-1 rounded-full shadow-md flex items-center space-x-1">
                        <i class="fa-solid fa-fire-flame-curved"></i>
                        <span>{{ floor($recipe->calories / $recipe->servings) }} Kkal/porsi</span>
                    </div>

                    <!-- Gradient Overlay -->
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    </div>

                    <!-- Quick Action Buttons (visible on hover) -->
                    {{-- <div
                        class="absolute bottom-0 left-0 right-0 p-3 flex justify-between items-center translate-y-full group-hover:translate-y-0 transition-transform duration-300">
                        <button onclick="window.location.href=''"
                            class="bg-white/90 hover:bg-white text-primary hover:text-primary-hover rounded-full p-2 transition-colors duration-200 shadow-md">
                            <i class="fa-solid fa-eye"></i>
                        </button>
                        <button
                            class="bg-white/90 hover:bg-white text-secondary hover:text-secondary-hover rounded-full p-2 transition-colors duration-200 shadow-md">
                            <i class="fa-solid fa-trash-can"></i>
                        </button>
                    </div> --}}
                </div>

                <!-- Recipe Content -->
                <div class="p-4">
                    <h3 class="text-lg font-bold text-primary dark:text-primary-light truncate">
                        {{ $recipe->name }}</h3>

                    <!-- Recipe Stats -->
                    <div class="mt-2 flex flex-wrap gap-3 text-xs text-gray-600 dark:text-gray-300">
                        <div class="flex items-center space-x-1">
                            <i class="fa-regular fa-clock text-primary"></i>
                            <span>{{ $recipe->cooking_time }} min</span>
                        </div>
                        <div class="flex items-center space-x-1 capitalize">
                            <i class="fa-solid fa-sliders text-yellow-500"></i>
                            <span>{{ $recipe->difficulty }}</span>
                        </div>
                        <div class="flex items-center space-x-1">
                            <i class="fa-solid fa-bowl-food text-secondary"></i>
                            <span>{{ $recipe->servings }} porsi</span>
                        </div>
                        <div class="flex items-center space-x-1">
                            <i class="fa-solid fa-eye text-blue-500"></i>
                            <span>{{ $recipe->views_count }}</span>
                        </div>
                    </div>

                    <!-- Rating Stars -->
                    <div class="mt-3 flex items-center">
                        @php
                            $avgRating = $recipe->ratings->avg('rating') ?? 0;
                            $roundedRating = round($avgRating);
                        @endphp

                        @for ($i = 1; $i <= 5; $i++)
                            <i
                                class="fa-{{ $i <= $roundedRating ? 'solid' : 'regular' }} fa-star {{ $i <= $roundedRating ? 'text-yellow-400' : 'text-gray-300' }}"></i>
                        @endfor

                        <span class="ml-2 text-xs text-gray-500 dark:text-gray-400">
                            ({{ $recipe->ratings->count() }} reviews)
                        </span>
                    </div>

                    <!-- Ingredients Preview -->
                    <div class="mt-3">
                        <p class="text-xs text-gray-500 dark:text-gray-400 line-clamp-1">
                            <span class="font-medium">Bahan: </span>
                            @foreach ($recipe->ingredients->take(3) as $key => $ingredient)
                                {{ $ingredient->name }}{{ $key < min(2, $recipe->ingredients->count() - 1) ? ', ' : '' }}
                            @endforeach
                            @if ($recipe->ingredients->count() > 3)
                                , dll.
                            @endif
                        </p>
                    </div>

                    <!-- View Recipe Button -->
                    <div class="mt-4 flex space-x-2">
                        <a href="{{ route('explore-recipes.show', $recipe->id) }}"
                            class="block text-base md:text-lg font-semibold w-full py-2 bg-gradient-to-r from-primary to-primary-light text-center text-white rounded-lg hover:shadow-lg transition-all duration-300 transform hover:scale-[1.02]">
                            Lihat Resep
                        </a>
                        <!-- Bookmark Icon (for removal) -->
                        <button wire:click='toggleBookmark({{ $recipe->id }})'
                            class="w-[20%] p-1.5 bg-white/80 hover:bg-white border border-secondary/30 hover:border-secondary text-secondary hover:text-rose-500 rounded-md shadow-md transition-all duration-200 z-10">
                            <i class="fa-solid fa-bookmark text-base md:text-lg"></i>
                        </button>
                    </div>
                </div>

            </div>
        @empty
            <div
                class="col-span-3 py-16 flex flex-col items-center justify-center bg-white dark:bg-bg-dark-primary rounded-xl shadow-md">
                <div class="text-6xl text-gray-300 dark:text-gray-600 mb-4">
                    <i class="fa-regular fa-bookmark"></i>
                </div>
                <h3 class="text-lg md:text-xl font-medium text-gray-500 dark:text-gray-400 mb-2">Belum Ada Resep Favorit
                </h3>
                <p class="text-gray-400 dark:text-gray-500 mb-6 text-sm md:text-base font-medium text-center max-w-md">
                    Anda belum
                    menyimpan
                    resep
                    favorit. Jelajahi resep-resep menarik dan simpan untuk referensi nanti.</p>
                <a href="{{ route('explore-recipes.index') }}"
                    class="px-6 py-2.5 bg-primary hover:bg-primary-hover text-white rounded-full shadow-md transition-all duration-200">
                    <i class="fa-solid fa-magnifying-glass mr-2"></i>Jelajahi Resep
                </a>
            </div>
        @endforelse
    </div>

    <!-- Pagination (if needed) -->
    <div class="mt-8">
        {{ $recipes->links('vendor.livewire.tailwind') }}
    </div>
</div>
