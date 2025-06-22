<div>
    {{-- Featured Section --}}
    {{-- Enhanced Featured Section with Interactive Elements --}}
    <div class="w-full grid grid-cols-4 gap-4 mb-12">
        {{-- Main Featured Recipe Card with Stats --}}
        <div
            class="h-64 col-span-2 bg-gradient-to-br from-white to-gray-50 shadow-lg hover:shadow-2xl flex group transition-all duration-500 overflow-hidden rounded-xl border border-gray-100">
            <div class="w-[40%] h-full relative">
                @if ($todayTrending['recipes']['image'])
                    <img src="{{ asset($todayTrending['recipes']['image']) }}" alt="featured-recipe"
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                @else
                    <div class="w-full h-full bg-gray-200 flex justify-center items-center">
                        <i class="fa fa-image text-gray-400"></i>
                    </div>
                @endif
                <div
                    class="opacity-0 group-hover:opacity-100 absolute top-0 left-0 w-full h-full bg-gradient-to-t from-black/60 to-transparent transition-opacity duration-500">
                </div>

                {{-- Recipe Rating Badge --}}
                <div
                    class="absolute top-3 left-3 bg-yellow-400 text-black px-2 py-1 rounded-full text-xs font-bold flex items-center gap-1">
                    <i class="fa-solid fa-star"></i> 4.9
                </div>

                {{-- Quick Action Buttons --}}
                <div
                    class="absolute bottom-3 left-3 opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex gap-2">
                    <button
                        class="bg-white/20 backdrop-blur-sm text-white px-3 py-1.5 rounded-full hover:bg-white/30 transition-all duration-300">
                        <i class="fa-solid fa-bookmark text-sm"></i>
                    </button>
                </div>
            </div>

            <div class="w-[60%] h-full px-6 py-6 flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <div
                            class="bg-gradient-to-r from-secondary to-orange-400 text-white px-3 py-1 rounded-full text-xs font-medium">
                            {{ $todayTrending['title'] }}
                        </div>
                        <div class="flex items-center text-xs text-gray-500">
                            <i class="fa-solid fa-clock mr-1"></i> {{ $todayTrending['recipes']['cooking_time'] }} min
                        </div>
                    </div>

                    <h3
                        class="mb-3 text-lg font-bold text-gray-800 group-hover:text-secondary transition-colors duration-300">
                        {{ $todayTrending['recipes']['name'] }}
                    </h3>

                    <p class="text-sm text-gray-600 mb-4 leading-relaxed">
                        {{ $todayTrending['recipes']['description'] }}
                    </p>
                </div>

                {{-- Recipe Stats --}}
                <div class="flex items-center justify-between text-xs">
                    <div class="flex items-center gap-4">
                        <span class="flex items-center text-gray-500">
                            <i class="fa-solid fa-users mr-1 text-secondary"></i>
                            {{ $todayTrending['recipes']['views_count'] }} pengunjung
                        </span>
                        <span class="flex items-center text-gray-500">
                            <i class="fa-solid fa-heart mr-1 text-orange-500"></i>
                            {{ $todayTrending['recipes']['bookmarked_by_count'] ? $todayTrending['recipes']['bookmarked_by_count'] . ' tersimpan' : $todayTrending['recipes']['ratings_count'] . ' ulasan' }}
                        </span>
                    </div>
                    <a href="{{ route('explore-recipes.show', $todayTrending['recipes']['id']) }}" wire:navigate
                        class="bg-secondary text-white px-4 py-2 rounded-full text-xs font-medium hover:bg-secondary/90 transition-all duration-300 transform hover:scale-105">
                        Lihat Detail →
                    </a>
                </div>
            </div>
        </div>

        {{-- Interactive Category Cards --}}
        <div
            class="h-64 shadow-lg hover:shadow-2xl transition-all duration-500 relative group cursor-pointer overflow-hidden rounded-xl border border-gray-100">
            <img src="{{ asset('storage/img/main/main-background.jpg') }}" alt="desserts-category"
                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">

            {{-- Gradient Overlay --}}
            <div
                class="absolute inset-0 bg-gradient-to-t from-pink-600/80 via-pink-400/40 to-transparent group-hover:from-pink-700/90 transition-all duration-500">
            </div>

            {{-- Category Badge --}}
            <div
                class="absolute top-4 right-4 bg-white/20 backdrop-blur-sm text-white px-3 py-1 rounded-full text-xs font-medium">
                🍰 Manisss
            </div>

            {{-- Content --}}
            <div
                class="absolute bottom-5 left-5 group-hover:bottom-1/2 group-hover:left-1/2 group-hover:-translate-x-1/2 group-hover:translate-y-1/2 transition-all duration-500">
                <h3 class="text-xl font-bold text-white mb-2 group-hover:text-center transition-all duration-500">
                    Cemilan Manis
                </h3>
                <div class="hidden group-hover:block text-center space-y-2">
                    <p class="text-white/90 text-sm font-medium">{{ $totalDessert['total'] }}+ Resep Manis-Manis</p>
                    <div class="flex justify-center gap-2 text-xs text-white/80">
                        <span class="bg-white/20 px-2 py-1 rounded-full">Kue-kue</span>
                        <span class="bg-white/20 px-2 py-1 rounded-full">Kukis</span>
                    </div>
                    <a href="{{ route('explore.category', ['categoryId' => 3]) }}" wire:navigate
                        class="bg-white text-pink-600 px-4 py-2 rounded-full text-xs font-bold hover:bg-pink-50 transition-all duration-300 mt-3">
                        Yuk Lihat →
                    </a>
                </div>
            </div>

            {{-- Recipe Count Indicator --}}
            @if ($totalDessert['new'] > 0)
                <div class="absolute top-4 left-4 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                    <div
                        class="bg-white/20 backdrop-blur-sm text-white px-2 py-1 rounded-full text-xs flex items-center gap-1">
                        <i class="fa-solid fa-chart-line"></i> +{{ $totalDessert['new'] }} minggu ini
                    </div>
                </div>
            @endif
        </div>

        <div
            class="h-64 shadow-lg hover:shadow-2xl transition-all duration-500 relative group cursor-pointer overflow-hidden rounded-xl border border-gray-100">
            <img src="{{ asset('storage/img/main/main-background.jpg') }}" alt="main-course-category"
                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">

            {{-- Gradient Overlay --}}
            <div
                class="absolute inset-0 bg-gradient-to-t from-orange-600/80 via-orange-400/40 to-transparent group-hover:from-orange-700/90 transition-all duration-500">
            </div>

            {{-- Category Badge --}}
            <div
                class="absolute top-4 right-4 bg-white/20 backdrop-blur-sm text-white px-3 py-1 rounded-full text-xs font-medium">
                🍖 Mak Nyuss
            </div>

            {{-- Content --}}
            <div
                class="absolute bottom-5 left-5 group-hover:bottom-1/2 group-hover:left-1/2 group-hover:-translate-x-1/2 group-hover:translate-y-1/2 transition-all duration-500">
                <h3 class="text-xl font-bold text-white mb-2 group-hover:text-center transition-all duration-500">
                    Menu Utama
                </h3>
                <div class="hidden group-hover:block text-center space-y-2">
                    <p class="text-white/90 text-sm font-medium">{{ $totalMainCourse['total'] }}+ Resep Mak Nyuss
                    </p>
                    <div class="flex justify-center gap-2 text-xs text-white/80">
                        <span class="bg-white/20 px-2 py-1 rounded-full">Daging</span>
                        <span class="bg-white/20 px-2 py-1 rounded-full">Seafood</span>
                    </div>
                    <a href="{{ route('explore.category', ['categoryId' => 2]) }}" wire:navigate
                        class="bg-white text-orange-600 px-4 py-2 rounded-full text-xs font-bold hover:bg-orange-50 transition-all duration-300 mt-3">
                        Yuk Coba →
                    </a>
                </div>
            </div>

            {{-- Recipe Count Indicator --}}
            @if ($totalMainCourse['new'] > 0)
                <div class="absolute top-4 left-4 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                    <div
                        class="bg-white/20 backdrop-blur-sm text-white px-2 py-1 rounded-full text-xs flex items-center gap-1">
                        <i class="fa-solid fa-chart-line"></i> +{{ $totalMainCourse['new'] }} minggu ini
                    </div>
                </div>
            @endif
        </div>
    </div>

    {{-- Quick Stats Dashboard --}}
    <div class="grid grid-cols-4 gap-4 mb-8">
        <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-4 rounded-xl border border-blue-200 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-600 text-xs font-medium uppercase tracking-wide">Total Resep</p>
                    <p class="text-2xl font-bold text-blue-800">
                        {{ $totalRecipe }}
                    </p>
                </div>
                <div class="bg-blue-500 text-white p-3 rounded-full">
                    <i class="fa-solid fa-utensils"></i>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-green-50 to-green-100 p-4 rounded-xl border border-green-200 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-600 text-xs font-medium uppercase tracking-wide">Creators</p>
                    <p class="text-2xl font-bold text-green-800">
                        {{ $totalCreators }}
                    </p>
                </div>
                <div class="bg-green-500 text-white p-3 rounded-full">
                    <i class="fa-solid fa-users"></i>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-purple-50 to-purple-100 p-4 rounded-xl border border-purple-200 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-purple-600 text-xs font-medium uppercase tracking-wide">Resep Baru</p>
                    <p class="text-2xl font-bold text-purple-800">
                        {{ $totalNewRecipeInWeek }}
                    </p>
                </div>
                <div class="bg-purple-500 text-white p-3 rounded-full">
                    <i class="fa fa-chart-line"></i>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-orange-50 to-orange-100 p-4 rounded-xl border border-orange-200 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-orange-600 text-xs font-medium uppercase tracking-wide">Rating Rata-Rata</p>
                    <p class="text-2xl font-bold text-orange-800">
                        {{ $averageRating }}
                    </p>
                </div>
                <div class="bg-orange-500 text-white p-3 rounded-full">
                    <i class="fa-solid fa-star"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Trending Topics Section --}}
    <div
        class="bg-gradient-to-r from-indigo-50 via-white to-purple-50 p-6 rounded-xl border border-gray-200 mb-8 shadow-lg">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                <i class="fa-solid fa-fire text-orange-500"></i>
                {{ $isAnyRecipesInWeek ? 'Trending Minggu Ini' : 'Trending' }}
            </h3>
        </div>

        <div class="flex flex-wrap gap-2">
            @foreach ($this->getTrendingCategories() as $category)
                <a href="{{ route('explore.category', ['categoryId' => $category['id']]) }}" wire:navigate
                    class="bg-gradient-to-r from-blue-500 to-cyan-500 text-white px-3 py-1 rounded-full text-sm font-medium hover:scale-105 transition-transform cursor-pointer">
                    {{ $category['name'] }}
                    <span class="ml-1 text-xs opacity-75">({{ $category['count'] }})</span>
                </a>
            @endforeach

            @foreach ($this->getTrendingIngredients() as $ingredient)
                <a href="{{ route('explore.ingredient', ['ingredient' => $ingredient['id']]) }}" wire:navigate
                    class="bg-gradient-to-r from-gray-500 to-neutral-400 text-white px-3 py-1 rounded-full text-sm font-medium hover:scale-105 transition-transform cursor-pointer">
                    {{ $ingredient['name'] }}
                    <span class="ml-1 text-xs opacity-75">({{ $ingredient['count'] }})</span>
                </a>
            @endforeach

            @foreach ($this->getTrendingCookingTime() as $timeCategory)
                <a href="{{ route('explore.time', ['timeCategory' => str_replace('#', '', $timeCategory['name'])]) }}"
                    wire:navigate
                    class="bg-gradient-to-r from-red-500 to-orange-500 text-white px-3 py-1 rounded-full text-sm font-medium hover:scale-105 transition-transform cursor-pointer">
                    {{ $timeCategory['name'] }}
                    <span class="ml-1 text-xs opacity-75">({{ $timeCategory['count'] }})</span>
                </a>
            @endforeach
        </div>
    </div>
</div>
