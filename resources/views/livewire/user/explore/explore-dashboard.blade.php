<div>
    {{-- Featured Section --}}
    {{-- Enhanced Featured Section with Interactive Elements --}}
    <div class="w-full grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-12">
        {{-- Main Featured Recipe Card with Stats --}}
        <div
            class="h-auto min-h-64 md:h-64 col-span-1 md:col-span-2 bg-gradient-to-br from-white to-gray-50 shadow-lg hover:shadow-2xl flex flex-col md:flex-row group transition-all duration-500 overflow-hidden rounded-xl border border-gray-100">
            <div class="w-full md:w-[40%] h-48 md:h-full relative overflow-hidden">
                @if ($todayTrending['recipes']['image'])
                    <img src="{{ $todayTrending['recipes']['image'] }}" alt="featured-recipe"
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                @else
                    <div class="w-full h-full bg-gray-200 flex justify-center items-center">
                        <i class="fa fa-image text-gray-400 text-2xl"></i>
                    </div>
                @endif
                <div
                    class="opacity-0 group-hover:opacity-100 absolute top-0 left-0 w-full h-full bg-gradient-to-br from-black/60 to-transparent transition-opacity duration-500">
                </div>

                {{-- Recipe Rating Badge --}}
                <div
                    class="absolute top-2 left-2 md:top-3 md:left-3 bg-black/70 text-white px-2 py-1 rounded-full text-xs font-bold flex items-center gap-1">
                    <div class="flex items-center gap-0.5 md:gap-1 text-xs">
                        @if ($todayTrending['recipes']['ratings_count'] > 0)
                            @for ($i = 1; $i <= 5; $i++)
                                <i
                                    class="fa-{{ $i <= (int) number_format($todayTrending['recipes']['ratings_avg_rating']) ? 'solid' : 'regular' }} fa-star group-hover:scale-110 transition-transform duration-300 text-yellow-400 text-xs"></i>
                            @endfor
                        @else
                            <i
                                class="text-white fa-regular fa-star group-hover:scale-110 transition-transform duration-300 text-xs"></i>
                            <i
                                class="text-white fa-regular fa-star group-hover:scale-110 transition-transform duration-300 text-xs"></i>
                            <i
                                class="text-white fa-regular fa-star group-hover:scale-110 transition-transform duration-300 text-xs"></i>
                            <i
                                class="text-white fa-regular fa-star group-hover:scale-110 transition-transform duration-300 text-xs"></i>
                            <i
                                class="text-white fa-regular fa-star group-hover:scale-110 transition-transform duration-300 text-xs"></i>
                        @endif
                        <span
                            class="text-white text-xs ml-1">({{ $todayTrending['recipes']['ratings_avg_rating'] ? (int) $todayTrending['recipes']['ratings_avg_rating'] : '0' }})</span>
                    </div>
                </div>

                {{-- Quick Action Buttons --}}
                <div
                    class="absolute bottom-2 left-2 md:bottom-3 md:left-3 opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex gap-2">
                    <button
                        class="bg-white/20 backdrop-blur-sm text-white px-2 md:px-3 py-1 md:py-1.5 rounded-full hover:bg-white/30 transition-all duration-300">
                        <i class="fa-solid fa-bookmark text-xs md:text-sm"></i>
                    </button>
                </div>
            </div>

            <div class="w-full md:w-[60%] h-auto md:h-full px-3 md:px-6 py-3 md:py-6 flex flex-col justify-between">
                <div>
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-3 md:mb-4 gap-2">
                        <div
                            class="bg-gradient-to-r from-secondary to-orange-400 text-white px-2.5 md:px-3 py-1 rounded-full text-xs font-medium inline-block w-fit">
                            {{ $todayTrending['title'] }}
                        </div>
                        <div class="flex items-center text-xs text-gray-500">
                            <i class="fa-solid fa-clock mr-1"></i> {{ $todayTrending['recipes']['cooking_time'] }} min
                        </div>
                    </div>

                    <h3
                        class="mb-2 md:mb-3 text-sm md:text-lg font-bold text-gray-800 group-hover:text-secondary transition-colors duration-300 leading-tight">
                        {{ $todayTrending['recipes']['name'] }}
                    </h3>

                    <p
                        class="text-xs md:text-sm font-normal text-gray-600 mb-3 md:mb-4 leading-relaxed line-clamp-2 md:line-clamp-3">
                        {{ $todayTrending['recipes']['description'] }}
                    </p>

                    <div class="flex items-center gap-2 mb-3 md:mb-4">
                        @if ($todayTrending['recipes']['user']['avatar'])
                            <img src="{{ $todayTrending['recipes']['user']['avatar'] }}"
                                alt="{{ $todayTrending['recipes']['user']['name'] }}"
                                class="w-6 h-6 md:w-8 md:h-8 rounded-full object-cover border-2 border-white shadow-sm">
                        @else
                            <div
                                class="w-6 h-6 md:w-8 md:h-8 rounded-full bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center border-2 border-white shadow-sm">
                                <span class="text-xs md:text-sm font-medium text-gray-600">
                                    {{ substr($todayTrending['recipes']['user']['name'], 0, 1) }}
                                </span>
                            </div>
                        @endif
                        <span class="text-xs md:text-sm text-gray-600">
                            {{ $todayTrending['recipes']['user']['name'] }}
                        </span>
                    </div>
                </div>

                {{-- Recipe Stats --}}
                <div class="flex flex-col gap-2 md:gap-0 md:flex-row md:items-center md:justify-between text-xs">
                    <div class="flex flex-col gap-1 md:flex-row md:items-center md:gap-4 font-medium">
                        <span class="flex items-center text-gray-500">
                            <i class="fa-solid fa-users mr-1 text-secondary"></i>
                            <span class="truncate">{{ $todayTrending['recipes']['views_count'] }} pengunjung</span>
                        </span>
                        <span class="flex items-center text-gray-500">
                            <i class="fa-solid fa-heart mr-1 text-orange-500"></i>
                            <span
                                class="truncate">{{ $todayTrending['recipes']['bookmarked_by_count'] ? $todayTrending['recipes']['bookmarked_by_count'] . ' tersimpan' : $todayTrending['recipes']['ratings_count'] . ' ulasan' }}</span>
                        </span>
                    </div>
                    <a href="{{ route('explore-recipes.show', $todayTrending['recipes']['id']) }}" wire:navigate
                        class="bg-secondary text-white px-3 md:px-4 py-1.5 md:py-2 rounded-full text-xs font-medium hover:bg-secondary/90 transition-all duration-300 transform hover:scale-105 text-center mt-2 md:mt-0 w-full md:w-auto">
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
                    class="absolute top-3 left-3 bg-white/90 backdrop-blur text-pink-600 px-2 md:px-3 py-1.5 rounded-lg text-xs md:text-sm font-medium flex items-center gap-2">
                    🍰 <span class="hidden sm:inline">Cemilan Manis</span><span class="sm:hidden">Manis</span>
                    @if ($totalDessert['new'] > 0)
                        <span class="bg-pink-100 text-pink-700 px-2 py-0.5 rounded text-xs">
                            +{{ $totalDessert['new'] }}
                        </span>
                    @endif
                </div>
            </div>
            <div
                class="h-1/2 p-3 md:p-4 bg-gradient-to-br from-pink-50 to-white flex flex-col justify-between group-hover:bg-pink-100/50 transition-all duration-500">
                <div>
                    <h3 class="text-base md:text-lg font-bold text-gray-800 mb-1">{{ $totalDessert['total'] }}+ Resep
                        Manis</h3>
                    <div class="flex gap-1 md:gap-2 text-xs">
                        <span class="bg-pink-100 text-pink-700 px-1.5 md:px-2 py-1 rounded">Kue-kue</span>
                        <span class="bg-pink-100 text-pink-700 px-1.5 md:px-2 py-1 rounded">Kukis</span>
                    </div>
                </div>
                <a href="{{ route('explore.category', ['categoryId' => 3]) }}" wire:navigate
                    class="mt-2 bg-gradient-to-r from-pink-500 to-pink-600 text-white px-3 md:px-4 py-2 rounded-lg text-xs md:text-sm font-medium hover:from-pink-600 hover:to-pink-700 transition-all duration-300 flex items-center justify-between group">
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
                    class="absolute top-3 left-3 bg-white/90 backdrop-blur text-orange-600 px-2 md:px-3 py-1.5 rounded-lg text-xs md:text-sm font-medium flex items-center gap-2">
                    🍖 <span class="hidden sm:inline">Menu Utama</span><span class="sm:hidden">Utama</span>
                    @if ($totalMainCourse['new'] > 0)
                        <span class="bg-orange-100 text-orange-700 px-2 py-0.5 rounded text-xs">
                            +{{ $totalMainCourse['new'] }}
                        </span>
                    @endif
                </div>
            </div>
            <div
                class="h-1/2 p-3 md:p-4 bg-gradient-to-br from-orange-50 to-white flex flex-col justify-between group-hover:bg-orange-100/50 transition-all duration-500">
                <div>
                    <h3 class="text-base md:text-lg font-bold text-gray-800 mb-1">{{ $totalMainCourse['total'] }}+
                        Resep Utama</h3>
                    <div class="flex gap-1 md:gap-2 text-xs">
                        <span class="bg-orange-100 text-orange-700 px-1.5 md:px-2 py-1 rounded">Daging</span>
                        <span class="bg-orange-100 text-orange-700 px-1.5 md:px-2 py-1 rounded">Seafood</span>
                    </div>
                </div>
                <a href="{{ route('explore.category', ['categoryId' => 2]) }}" wire:navigate
                    class="mt-2 bg-gradient-to-r from-orange-500 to-orange-600 text-white px-3 md:px-4 py-2 rounded-lg text-xs md:text-sm font-medium hover:from-orange-600 hover:to-orange-700 transition-all duration-300 flex items-center justify-between group">
                    <span>Jelajahi</span>
                    <i class="fa-solid fa-arrow-right group-hover:translate-x-1 transition-transform duration-300"></i>
                </a>
            </div>
        </div>
    </div>

    {{-- Quick Stats Dashboard --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-3 md:p-4 rounded-xl border border-blue-200 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-600 text-xs font-medium uppercase tracking-wide">Total Resep</p>
                    <p class="text-xl md:text-2xl font-bold text-blue-800">
                        {{ $totalRecipe }}
                    </p>
                </div>
                <div class="bg-blue-500 text-white p-2 md:p-3 rounded-full">
                    <i class="fa-solid fa-utensils text-sm md:text-base"></i>
                </div>
            </div>
        </div>

        <div
            class="bg-gradient-to-br from-green-50 to-green-100 p-3 md:p-4 rounded-xl border border-green-200 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-600 text-xs font-medium uppercase tracking-wide">Creators</p>
                    <p class="text-xl md:text-2xl font-bold text-green-800">
                        {{ $totalCreators }}
                    </p>
                </div>
                <div class="bg-green-500 text-white p-2 md:p-3 rounded-full">
                    <i class="fa-solid fa-users text-sm md:text-base"></i>
                </div>
            </div>
        </div>

        <div
            class="bg-gradient-to-br from-purple-50 to-purple-100 p-3 md:p-4 rounded-xl border border-purple-200 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-purple-600 text-xs font-medium uppercase tracking-wide">Resep Baru</p>
                    <p class="text-xl md:text-2xl font-bold text-purple-800">
                        {{ $totalNewRecipeInWeek }}
                    </p>
                </div>
                <div class="bg-purple-500 text-white p-2 md:p-3 rounded-full">
                    <i class="fa fa-chart-line text-sm md:text-base"></i>
                </div>
            </div>
        </div>

        <div
            class="bg-gradient-to-br from-orange-50 to-orange-100 p-3 md:p-4 rounded-xl border border-orange-200 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-orange-600 text-xs font-medium uppercase tracking-wide">Avg Rating</p>
                    <p class="text-xl md:text-2xl font-bold text-orange-800">
                        {{ round($averageRating, 1) }}
                    </p>
                </div>
                <div class="bg-orange-500 text-white p-2 md:p-3 rounded-full">
                    <i class="fa-solid fa-star text-sm md:text-base"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Trending Topics Section --}}
    <div
        class="bg-gradient-to-r from-indigo-50 via-white to-purple-50 p-4 md:p-6 rounded-xl border border-gray-200 mb-8 shadow-lg">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-base md:text-lg font-bold text-gray-800 flex items-center gap-2">
                <i class="fa-solid fa-fire text-orange-500"></i>
                <span class="hidden sm:inline">{{ $isAnyRecipesInWeek ? 'Trending Minggu Ini' : 'Trending' }}</span>
                <span class="sm:hidden">Trending</span>
            </h3>
        </div>

        <div class="flex flex-wrap gap-2">
            @foreach ($this->getTrendingCategories() as $category)
                <a href="{{ route('explore.category', ['categoryId' => $category['id']]) }}" wire:navigate
                    class="bg-gradient-to-r from-blue-500 to-cyan-500 text-white px-2 md:px-3 py-1 rounded-full text-xs md:text-sm font-medium hover:scale-105 transition-transform cursor-pointer">
                    {{ $category['name'] }}
                    <span class="ml-1 text-xs opacity-75">({{ $category['count'] }})</span>
                </a>
            @endforeach

            @foreach ($this->getTrendingIngredients() as $ingredient)
                <a href="{{ route('explore.ingredient', ['ingredient' => $ingredient['id']]) }}" wire:navigate
                    class="bg-gradient-to-r from-gray-500 to-neutral-400 text-white px-2 md:px-3 py-1 rounded-full text-xs md:text-sm font-medium hover:scale-105 transition-transform cursor-pointer">
                    {{ $ingredient['name'] }}
                    <span class="ml-1 text-xs opacity-75">({{ $ingredient['count'] }})</span>
                </a>
            @endforeach

            @foreach ($this->getTrendingCookingTime() as $timeCategory)
                <a href="{{ route('explore.time', ['timeCategory' => str_replace('#', '', $timeCategory['name'])]) }}"
                    wire:navigate
                    class="bg-gradient-to-r from-red-500 to-orange-500 text-white px-2 md:px-3 py-1 rounded-full text-xs md:text-sm font-medium hover:scale-105 transition-transform cursor-pointer">
                    {{ $timeCategory['name'] }}
                    <span class="ml-1 text-xs opacity-75">({{ $timeCategory['count'] }})</span>
                </a>
            @endforeach
        </div>
    </div>
</div>
