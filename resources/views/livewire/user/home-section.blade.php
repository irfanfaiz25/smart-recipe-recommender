<div>
    <!-- Featured Categories Section -->
    <section
        class="py-20 min-h-screen flex flex-col justify-center lg:py-32 bg-gradient-to-br from-slate-100 to-gray-50">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16 lg:mb-24" x-data="{ inView: false }" x-intersect.once="inView = true">
                <h2 class="text-2xl md:text-4xl lg:text-5xl font-display font-bold text-gray-800 mb-4" x-show="inView"
                    x-transition:enter="transition ease-out duration-1000 delay-200"
                    x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0">
                    Jelajahi Dunia Rasa
                </h2>
                <p class="text-sm md:text-lg font-medium text-gray-600 max-w-2xl mx-auto" x-show="inView"
                    x-transition:enter="transition ease-out duration-1000 delay-400"
                    x-transition:enter-start="opacity-0 translate-y-8"
                    x-transition:enter-end="opacity-100 translate-y-0">
                    Temukan inspirasi dari berbagai kategori resep favorit.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8" x-data="{ inView: false }"
                x-intersect.once="inView = true">

                @foreach ($categories as $category)
                    <div class="group cursor-pointer" x-show="inView"
                        x-transition:enter="transition ease-out duration-1000 delay-[{{ $category['delay'] }}ms]"
                        x-transition:enter-start="opacity-0 translate-y-12 scale-95"
                        x-transition:enter-end="opacity-100 translate-y-0 scale-100">
                        <div
                            class="relative overflow-hidden rounded-3xl bg-white shadow-xl group-hover:shadow-2xl transition-all duration-500 h-72 sm:h-80">
                            <div
                                class="absolute inset-0 bg-gradient-to-br {{ $category['color_from'] }} {{ $category['color_to'] }} opacity-90 group-hover:opacity-100 transition-opacity duration-300">
                            </div>
                            {{-- Pattern Overlay --}}
                            <div
                                class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg%20width%3D%2240%22%20height%3D%2240%22%20viewBox%3D%220%200%2040%2040%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%3E%3Cg%20fill%3D%22%23ffffff%22%20fill-opacity%3D%220.07%22%20fill-rule%3D%22evenodd%22%3E%3Cpath%20d%3D%22M0%200h20v20H0zM20%2020h20v20H20z%22%2F%3E%3C%2Fg%3E%3C%2Fsvg%3E')] opacity-50 group-hover:opacity-70 transition-opacity duration-300">
                            </div>

                            <div class="relative p-6 sm:p-8 h-full flex flex-col justify-between text-white">
                                <div class="text-center flex-grow flex flex-col items-center justify-center">
                                    <div
                                        class="inline-flex items-center justify-center w-20 h-20 bg-white/20 backdrop-blur-sm rounded-full mb-4 group-hover:scale-110 group-hover:rotate-6 transition-transform duration-300 shadow-md">
                                        <i class="{{ $category['icon'] }} text-4xl text-white"></i>
                                    </div>
                                    <h3 class="text-lg md:text-2xl font-bold mb-1">{{ $category['name'] }}</h3>
                                    <p class="text-white/80 font-medium text-sm px-2">{{ $category['desc'] }}</p>
                                </div>
                                <div class="text-center mt-auto">
                                    <div
                                        class="inline-flex items-center justify-center bg-white/20 backdrop-blur-sm rounded-full px-4 py-2 text-xs font-semibold shadow">
                                        <span>{{ $category['recipes'] }} resep</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="text-center mt-12 lg:mt-24" x-data="{ inView: false }" x-intersect.once="inView = true">
                <a href="{{ route('explore-recipes.index') }}" wire:navigate
                    class="inline-flex items-center px-8 py-3 bg-white text-gray-700 text-base md:text-lg font-semibold rounded-xl shadow-md hover:shadow-lg hover:bg-gray-50 transform hover:scale-105 transition-all duration-300 border border-gray-300"
                    x-show="inView" x-transition:enter="transition ease-out duration-1000 delay-1200"
                    x-transition:enter-start="opacity-0 translate-y-8"
                    x-transition:enter-end="opacity-100 translate-y-0">
                    Jelajahi Semua Kategori
                    <i class="fas fa-compass ml-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Popular Recipes Section -->
    <section class="py-20 min-h-screen flex flex-col justify-center lg:py-32 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16 lg:mb-24" x-data="{ inView: false }" x-intersect.once="inView = true">
                <h2 class="text-2xl md:text-4xl lg:text-5xl font-display font-bold text-gray-800 mb-4" x-show="inView"
                    x-transition:enter="transition ease-out duration-1000 delay-200"
                    x-transition:enter-start="opacity-0 translate-y-8"
                    x-transition:enter-end="opacity-100 translate-y-0">
                    Resep Pilihan Minggu Ini
                </h2>
                <p class="text-sm md:text-lg font-medium text-gray-600 max-w-2xl mx-auto" x-show="inView"
                    x-transition:enter="transition ease-out duration-1000 delay-400"
                    x-transition:enter-start="opacity-0 translate-y-8"
                    x-transition:enter-end="opacity-100 translate-y-0">
                    Lihat apa yang sedang populer dan dicintai oleh komunitas SavoryAI.
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8" x-data="{ inView: false }"
                x-intersect.once="inView = true">
                @foreach ($popularRecipes as $recipe)
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden group hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1"
                        x-show="inView"
                        x-transition:enter="transition ease-out duration-1000 delay-[{{ $recipe['delay'] }}ms]"
                        x-transition:enter-start="opacity-0 translate-y-12 scale-95"
                        x-transition:enter-end="opacity-100 translate-y-0 scale-100">
                        <div class="relative h-56 overflow-hidden">
                            @if ($recipe['image'])
                                <img src="{{ $recipe['image'] }}" alt="{{ $recipe['name'] }}"
                                    class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105"
                                    onerror="this.parentElement.innerHTML = `
                                        <div class='absolute inset-0 bg-gradient-to-br {{ $colors[$recipe['color']]['from'] }} {{ $colors[$recipe['color']]['to'] }} flex items-center justify-center'>
                                            <i class='{{ $recipe['icon'] }} text-8xl text-white opacity-30'></i>
                                        </div>
                                    `">
                            @else
                                <div
                                    class="absolute inset-0 bg-gradient-to-br {{ $colors[$recipe['color']]['from'] }} {{ $colors[$recipe['color']]['to'] }} flex items-center justify-center">
                                    <i class="{{ $recipe['icon'] }} text-8xl text-white opacity-30"></i>
                                </div>
                            @endif
                            <div
                                class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm rounded-full px-3 py-1 text-sm font-semibold {{ $colors[$recipe['color']]['text'] }} shadow-sm">
                                <i class="fas fa-star text-yellow-400 mr-1"></i> {{ $recipe['rating'] }}
                            </div>
                            <div
                                class="absolute bottom-0 left-0 w-full p-4 bg-gradient-to-t from-black/60 to-transparent">
                                <h3 class="text-xl font-semibold text-white mb-1 truncate">{{ $recipe['name'] }}</h3>
                            </div>
                        </div>
                        <div class="p-6">
                            <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ $recipe['desc'] }}</p>
                            <div
                                class="flex items-center justify-between text-xs text-gray-500 {{ $colors[$recipe['color']]['bg_light'] }} p-3 rounded-lg">
                                <span class="flex items-center"><i
                                        class="far fa-clock mr-1.5 {{ $colors[$recipe['color']]['text'] }}"></i>
                                    {{ $recipe['time'] }}</span>
                                <span class="flex items-center"><i
                                        class="fas fa-fire-alt mr-1.5 {{ $colors[$recipe['color']]['text'] }}"></i>
                                    {{ $recipe['level'] }}</span>
                            </div>
                            <a href="{{ route('explore-recipes.show', $recipe['id']) }}"
                                class="block mt-4 text-center w-full px-4 py-2 bg-gradient-to-r {{ $colors[$recipe['color']]['from'] }} {{ $colors[$recipe['color']]['to'] }} text-white font-semibold rounded-lg hover:shadow-md transition-shadow duration-300 text-sm">
                                Lihat Resep
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-12 lg:mt-24" x-data="{ inView: false }" x-intersect.once="inView = true">
                <a href="{{ route('explore-recipes.index') }}" wire:navigate
                    class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-[#FF564E] to-[#ff834e] text-white text-base md:text-lg font-semibold rounded-xl shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300"
                    x-show="inView" x-transition:enter="transition ease-out duration-1000 delay-1200"
                    x-transition:enter-start="opacity-0 translate-y-8"
                    x-transition:enter-end="opacity-100 translate-y-0">
                    Lihat Semua Resep Populer
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </section>
</div>
