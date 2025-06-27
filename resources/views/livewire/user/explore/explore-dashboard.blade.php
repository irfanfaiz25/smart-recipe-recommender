<div>
    {{-- Featured Section --}}
    {{-- Enhanced Featured Section with Interactive Elements --}}
    <div class="w-full grid grid-cols-4 gap-4 mb-12">
        {{-- Main Featured Recipe Card with Stats --}}
        <div
            class="h-64 col-span-2 bg-gradient-to-br from-white to-gray-50 shadow-lg hover:shadow-2xl flex group transition-all duration-500 overflow-hidden rounded-xl border border-gray-100">
            <div class="w-[40%] h-full relative overflow-hidden">
                @if ($todayTrending['recipes']['image'])
                    <img src="{{ asset($todayTrending['recipes']['image']) }}" alt="featured-recipe"
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                @else
                    <div class="w-full h-full bg-gray-200 flex justify-center items-center">
                        <i class="fa fa-image text-gray-400"></i>
                    </div>
                @endif
                <div
                    class="opacity-0 group-hover:opacity-100 absolute top-0 left-0 w-full h-full bg-gradient-to-br from-black/60 to-transparent transition-opacity duration-500">
                </div>

                {{-- Recipe Rating Badge --}}
                <div
                    class="absolute top-3 left-3 bg-black/60 text-black px-2 py-1 rounded-full text-xs font-bold flex items-center gap-1">
                    <div class="flex items-center gap-1 text-xs">
                        @if ($todayTrending['recipes']['ratings_count'] > 0)
                            @for ($i = 1; $i <= 5; $i++)
                                <i
                                    class="fa-{{ $i <= (int) number_format($todayTrending['recipes']['ratings_avg_rating']) ? 'solid' : 'regular' }} fa-star group-hover:scale-110 transition-transform duration-300 text-yellow-500"></i>
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
                            class="text-white text-sm">({{ $todayTrending['recipes']['ratings_avg_rating'] ? (int) $todayTrending['recipes']['ratings_avg_rating'] : '0' }})</span>
                    </div>
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
            class="h-64 flex flex-col bg-white shadow-lg hover:shadow-2xl transition-all duration-500 rounded-xl border border-gray-100 overflow-hidden group">
            <div class="h-1/2 relative">
                <img src="{{ asset('storage/img/main/dessert-image.jpg') }}" alt="desserts-category"
                    class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-b from-pink-500/20 to-pink-600/50"></div>
                <div
                    class="absolute top-3 left-3 bg-white/90 backdrop-blur text-pink-600 px-3 py-1.5 rounded-lg text-sm font-medium flex items-center gap-2">
                    🍰 Cemilan Manis
                    @if ($totalDessert['new'] > 0)
                        <span class="bg-pink-100 text-pink-700 px-2 py-0.5 rounded text-xs">
                            +{{ $totalDessert['new'] }}
                        </span>
                    @endif
                </div>
            </div>
            <div
                class="h-1/2 p-4 bg-gradient-to-br from-pink-50 to-white flex flex-col justify-between group-hover:bg-pink-100/50 transition-all duration-500">
                <div>
                    <h3 class="text-lg font-bold text-gray-800 mb-1">{{ $totalDessert['total'] }}+ Resep Manis</h3>
                    <div class="flex gap-2 text-xs">
                        <span class="bg-pink-100 text-pink-700 px-2 py-1 rounded">Kue-kue</span>
                        <span class="bg-pink-100 text-pink-700 px-2 py-1 rounded">Kukis</span>
                    </div>
                </div>
                <a href="{{ route('explore.category', ['categoryId' => 3]) }}" wire:navigate
                    class="mt-2 bg-gradient-to-r from-pink-500 to-pink-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:from-pink-600 hover:to-pink-700 transition-all duration-300 flex items-center justify-between group">
                    <span>Jelajahi</span>
                    <i class="fa-solid fa-arrow-right group-hover:translate-x-1 transition-transform duration-300"></i>
                </a>
            </div>
        </div>

        <div
            class="h-64 flex flex-col bg-white shadow-lg hover:shadow-2xl transition-all duration-500 rounded-xl border border-gray-100 overflow-hidden group">
            <div class="h-1/2 relative">
                <img src="{{ asset('storage/img/main/maincourse-image.jpg') }}" alt="main-course-category"
                    class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-b from-orange-500/20 to-orange-600/50"></div>
                <div
                    class="absolute top-3 left-3 bg-white/90 backdrop-blur text-orange-600 px-3 py-1.5 rounded-lg text-sm font-medium flex items-center gap-2">
                    🍖 Menu Utama
                    @if ($totalMainCourse['new'] > 0)
                        <span class="bg-orange-100 text-orange-700 px-2 py-0.5 rounded text-xs">
                            +{{ $totalMainCourse['new'] }}
                        </span>
                    @endif
                </div>
            </div>
            <div
                class="h-1/2 p-4 bg-gradient-to-br from-orange-50 to-white flex flex-col justify-between group-hover:bg-orange-100/50 transition-all duration-500">
                <div>
                    <h3 class="text-lg font-bold text-gray-800 mb-1">{{ $totalMainCourse['total'] }}+ Resep Utama</h3>
                    <div class="flex gap-2 text-xs">
                        <span class="bg-orange-100 text-orange-700 px-2 py-1 rounded">Daging</span>
                        <span class="bg-orange-100 text-orange-700 px-2 py-1 rounded">Seafood</span>
                    </div>
                </div>
                <a href="{{ route('explore.category', ['categoryId' => 2]) }}" wire:navigate
                    class="mt-2 bg-gradient-to-r from-orange-500 to-orange-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:from-orange-600 hover:to-orange-700 transition-all duration-300 flex items-center justify-between group">
                    <span>Jelajahi</span>
                    <i class="fa-solid fa-arrow-right group-hover:translate-x-1 transition-transform duration-300"></i>
                </a>
            </div>
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
                        {{ round($averageRating, 1) }}
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
