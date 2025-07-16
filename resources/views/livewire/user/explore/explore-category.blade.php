<div class="min-h-screen card-background rounded-lg">
    {{-- Header Section --}}
    <div class="bg-gradient-to-r {{ $this->getFilterColor() }} text-white py-16 px-4 rounded-t-lg relative">
        <div class="max-w-6xl mx-auto">
            <div class="text-center">
                <div class="text-6xl mb-4">{{ $this->getFilterIcon() }}</div>
                <h1 class="text-4xl md:text-5xl font-bold mb-0">
                    @if ($filterType === 'category')
                        {{ $filterValue == '1' ? 'Menu Pembuka' : ($filterValue == '2' ? 'Menu Utama' : 'Cemilan Manis') }}
                    @elseif ($filterType === 'ingredient')
                        {{ $ingredientName }}
                    @else
                        {{ $filterName }}
                    @endif
                </h1>
                <p class="text-lg font-medium opacity-90 mb-6">
                    @if ($filterType === 'category')
                        Temukan resep
                        {{ $filterValue == '1' ? 'menu pembuka' : ($filterValue == '2' ? 'menu utama' : 'cemilan manis') }}
                        terbaik
                    @elseif($filterType === 'ingredient')
                        Resep dengan bahan {{ str_replace('#', '', $ingredientName) }}
                    @elseif($filterType === 'cooking_time')
                        Resep dengan waktu memasak {{ $filterValue }}
                    @else
                        Jelajahi semua resep terbaik
                    @endif
                </p>
                <div class="flex justify-center items-center gap-4 text-sm opacity-80">
                    <span class="flex items-center gap-1">
                        <i class="fa-solid fa-utensils"></i>
                        {{ $recipes->total() }} Resep
                    </span>
                    {{-- <span class="flex items-center gap-1">
                        <i class="fa-solid fa-fire"></i>
                        Trending
                    </span> --}}
                </div>
            </div>
        </div>
        {{-- back button --}}
        <a href="{{ route('explore-recipes.index') }}"
            class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm text-sm text-gray-600 hover:text-red-500 w-8 h-8 rounded-full flex items-center justify-center transition-colors">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
    </div>

    {{-- Search and Filter Section --}}
    <div class="max-w-6xl mx-auto px-4 -mt-8 relative z-10">
        <div class="bg-white rounded-2xl shadow-xl p-4 sm:p-6 border border-gray-200">
            <div class="flex flex-col sm:flex-row gap-4 items-stretch sm:items-center justify-between">
                {{-- Search Bar --}}
                <div class="flex-1 w-full sm:w-auto">
                    <div class="relative">
                        <i
                            class="fa-solid fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        <input type="text" wire:model.live.debounce.300ms="searchTerm"
                            placeholder="Cari resep, bahan, atau kreator..."
                            class="w-full pl-12 pr-4 py-2.5 sm:py-3 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                    </div>
                </div>

                {{-- Sort Dropdown --}}
                <div class="flex items-center gap-2 sm:gap-4 w-full sm:w-auto">
                    <label class="text-sm font-medium text-gray-700 whitespace-nowrap">Urutkan:</label>
                    <select wire:model.live="sortBy"
                        class="w-full sm:w-auto px-3 sm:px-4 py-2.5 sm:py-3 text-sm font-medium border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="trending">Trending</option>
                        <option value="newest">Terbaru</option>
                        <option value="rating">Rating Tertinggi</option>
                        <option value="views">Banyak Dilihat</option>
                        <option value="bookmarks">Banyak Disimpan</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    {{-- Loading State --}}
    <div wire:loading wire:target='sortBy, searchTerm, loadMore' class="w-full flex justify-center py-8">
        <div class="flex text-lg justify-center items-center gap-2 text-gray-600">
            <i class="fa-solid fa-spinner fa-spin"></i>
            Memuat resep...
        </div>
    </div>

    {{-- Results Section --}}
    <div class="max-w-6xl mx-auto px-4 py-12">

        {{-- Results Grid --}}
        <div wire:loading.remove>
            @if ($recipes->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($recipes as $recipe)
                        <div
                            class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 overflow-hidden border border-gray-100 group">
                            {{-- Recipe Image --}}
                            <div class="relative h-48 overflow-hidden">
                                @if ($recipe->image)
                                    <img src="{{ $recipe->image }}" alt="{{ $recipe->name }}"
                                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                @else
                                    <div
                                        class="w-full h-full flex justify-center items-center bg-gray-300 text-gray-400 text-lg">
                                        <i class="fa fa-utensils"></i>
                                    </div>
                                @endif

                                {{-- Overlay Gradient --}}
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                </div>

                                {{-- Quick Stats --}}
                                <div class="absolute top-3 left-3 flex gap-2">
                                    <span
                                        class="bg-white/90 backdrop-blur-sm text-gray-800 px-2 py-1 rounded-full text-xs font-medium flex items-center gap-1">
                                        <i class="fa-solid fa-clock text-blue-500"></i>
                                        {{ $recipe->cooking_time }}m
                                    </span>
                                    @if ($recipe->ratings_avg_rating)
                                        <span
                                            class="bg-white/90 backdrop-blur-sm text-gray-800 px-2 py-1 rounded-full text-xs font-medium flex items-center gap-1">
                                            <i class="fa-solid fa-star text-yellow-500"></i>
                                            {{ number_format($recipe->ratings_avg_rating, 1) }}
                                        </span>
                                    @endif
                                </div>

                                {{-- Bookmark Button --}}
                                <div class="absolute top-3 right-3">
                                    <button wire:click="toggleBookmark({{ $recipe->id }})"
                                        class="bg-white/90 backdrop-blur-sm text-gray-600 hover:text-red-500 w-8 h-8 rounded-full flex items-center justify-center transition-colors">
                                        @if ($recipe->isBookmarkedBy(auth()->user()))
                                            <i class="fa-solid fa-bookmark text-sm hover:text-red-600"
                                                style="color: #DD5C36;"></i>
                                        @else
                                            <i class="fa-regular fa-bookmark text-sm text-gray-400"
                                                style="hover: #DD5C36;"></i>
                                        @endif
                                    </button>
                                </div>

                                {{-- View Count --}}
                                <div
                                    class="absolute bottom-3 right-3 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <span
                                        class="bg-black/50 backdrop-blur-sm text-white px-2 py-1 rounded-full text-xs flex items-center gap-1">
                                        <i class="fa-solid fa-eye"></i>
                                        {{ $recipe->views_count }}
                                    </span>
                                </div>
                            </div>

                            {{-- Recipe Content --}}
                            <div class="p-4">
                                {{-- Category Badge --}}
                                <div class="mb-2">
                                    <span
                                        class="bg-gradient-to-r {{ $recipe->category_id == 3 ? 'from-pink-500 to-rose-500' : 'from-orange-500 to-red-500' }} text-white px-2 py-1 rounded-full text-xs font-medium">
                                        {{ $recipe->category->name }}
                                    </span>
                                </div>

                                {{-- Recipe Title --}}
                                <h3
                                    class="text-lg font-semibold text-gray-800 mb-2 line-clamp-2 group-hover:text-orange-600 transition-colors">
                                    {{ $recipe->name }}
                                </h3>

                                {{-- Creator Info --}}
                                <div class="flex items-center gap-2 mb-3">
                                    @if ($recipe->user->avatar)
                                        <img src="{{ $recipe->user->avatar }}" alt="{{ $recipe->user->name }}"
                                            class="w-6 h-6 rounded-full object-cover">
                                    @else
                                        <div
                                            class="w-6 h-6 rounded-full bg-gray-300 flex items-center justify-center text-gray-400 text-xs">
                                            <i class="fa fa-user"></i>
                                        </div>
                                    @endif
                                    <span class="text-sm font-medium text-gray-600">{{ $recipe->user->name }}</span>
                                </div>

                                {{-- Recipe Description --}}
                                <p class="text-sm font-normal text-gray-600 line-clamp-1 mb-4">
                                    {{ $recipe->description }}
                                </p>

                                {{-- Recipe Stats --}}
                                <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                                    <div class="flex items-center gap-3">
                                        <span class="flex items-center gap-1">
                                            <i class="fa-solid fa-bookmark text-secondary"></i>
                                            {{ $recipe->bookmarked_by_count }}
                                        </span>
                                        <span class="flex items-center gap-1">
                                            <i class="fa-solid fa-comment text-primary"></i>
                                            {{ $recipe->ratings_count }}
                                        </span>
                                    </div>
                                </div>

                                {{-- Action Button --}}
                                <a href="{{ route('explore-recipes.show', $recipe->id) }}"
                                    class="block w-full text-white text-base text-center font-semibold py-2.5 px-4 rounded-xl transition-all duration-300 transform hover:scale-[1.02] shadow-lg hover:shadow-xl"
                                    style="background: linear-gradient(135deg, #DD5C36 0%, #FF8C4B 100%);
                                       transition: all 0.3s ease-in-out;">
                                    Lihat Resep
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Load More Button --}}
                @if ($recipes->hasMorePages())
                    <div class="flex justify-center text-center mt-12">
                        <button wire:click="loadMore" wire:loading.attr="disabled"
                            class="group px-8 py-4 text-sm bg-secondary/10 border-2 border-secondary/50 backdrop-blur-sm backdrop-opacity-50 bg-size-200 bg-pos-0 hover:bg-pos-100 text-secondary font-semibold rounded-2xl shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-500 flex items-center gap-3 disabled:opacity-50 disabled:cursor-not-allowed">
                            <span wire:loading.remove wire:target="loadMore">Muat Lebih Banyak</span>
                            <span wire:loading wire:target="loadMore">Memuat...</span>
                            <i class="fa-solid fa-arrow-down group-hover:translate-y-1 transition-transform duration-300"
                                wire:loading.remove wire:target="loadMore"></i>
                            <i class="fa-solid fa-spinner fa-spin" wire:loading wire:target="loadMore"></i>
                        </button>
                    </div>
                @endif
            @else
                {{-- Empty State --}}
                <div class="text-center py-16">
                    <div class="text-6xl mb-4">🔍</div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">Tidak Ada Resep Ditemukan</h3>
                    <p class="text-gray-600 mb-6 text-base font-medium">
                        @if ($searchTerm)
                            Tidak ada resep yang cocok dengan pencarian "{{ $searchTerm }}"
                        @else
                            Belum ada resep untuk kategori ini
                        @endif
                    </p>
                    @if ($searchTerm)
                        <button wire:click="$set('searchTerm', '')"
                            class="bg-blue-500 hover:bg-blue-600 text-white text-base font-medium px-6 py-2 rounded-xl transition-colors">
                            Hapus Pencarian
                        </button>
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>
