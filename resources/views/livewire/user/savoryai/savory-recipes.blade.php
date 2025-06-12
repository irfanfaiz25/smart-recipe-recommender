<div x-show="pageLoaded" x-transition:enter="transform transition-all duration-700 ease-out"
    x-transition:enter-start="opacity-0 translate-x-full" x-transition:enter-end="opacity-100 translate-x-0"
    class="w-full">

    <div class="rounded-lg p-4 bg-white shadow-lg h-fit">
        <div class="mt-2 w-full h-fit overflow-y-auto">

            <div class="flex items-center justify-between bg-gray-100 p-4 rounded-lg shadow-sm">
                <div class="flex items-center space-x-2">
                    <i class="fa-solid fa-utensils text-secondary text-xl"></i>
                    <h2 class="text-lg font-semibold text-gray-800">
                        Rekomendasi Resep
                    </h2>
                </div>

                {{-- calories preferences --}}
                <div class="w-[35%] flex items-center space-x-3">
                    <label for="caloriesCategory" class="text-sm font-medium text-gray-700 whitespace-nowrap">
                        Kategori Kalori:
                    </label>
                    <select id="caloriesCategory" wire:model.live.debounce.300ms="caloriesCategory"
                        class="w-full bg-white text-gray-700 text-sm border border-gray-200 rounded-lg px-4 py-2.5
                   transition duration-200 ease-in-out
                   focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20
                   hover:border-gray-300">
                        <option value="">Semua Kategori</option>
                        <option value="rendah">Kalori Rendah</option>
                        <option value="sedang">Kalori Sedang</option>
                        <option value="tinggi">Kalori Tinggi</option>
                    </select>
                </div>
            </div>


            <div class="mt-6 grid grid-cols-1 lg:grid-cols-2 gap-6">
                @foreach ($matchedRecipes as $recipe)
                    <div
                        class="group relative overflow-hidden rounded-2xl bg-white shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 border border-gray-100">

                        {{-- Background Gradient Overlay --}}
                        <div
                            class="absolute inset-0 bg-gradient-to-br from-green-50 via-white to-orange-50 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                        </div>

                        {{-- Top Section with Rating and Match Percentage --}}
                        <div class="relative p-4 pb-0">
                            <div class="flex justify-between items-start mb-3">
                                {{-- Rating Badge --}}
                                <div class="flex items-center space-x-2">
                                    <div
                                        class="flex items-center bg-gradient-to-r from-orange-400 to-red-500 text-white px-3 py-1.5 rounded-full shadow-md">
                                        <div class="flex space-x-0.5 mr-2">
                                            @if ($recipe['ratings'])
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <i
                                                        class="fa-{{ $i <= (int) $recipe['ratings'] ? 'solid' : 'regular' }} fa-star text-xs"></i>
                                                @endfor
                                            @else
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <i class="fa-regular fa-star text-xs"></i>
                                                @endfor
                                            @endif
                                        </div>
                                        <span class="text-xs font-semibold">{{ $recipe['ratings'] ?? '4.0' }}</span>
                                    </div>

                                    {{-- Match Percentage Badge --}}
                                    @if ($recipe['matching_percentage'])
                                        <div
                                            class="bg-gradient-to-r from-green-400 to-emerald-500 text-white px-3 pb-1.5 rounded-full shadow-md">
                                            <span class="text-xs font-bold">
                                                {{ (int) $recipe['matching_percentage'] }}% Match
                                            </span>
                                        </div>
                                    @endif

                                    @if ($recipe['cosine_similarity'])
                                        <p class="text-sm text-black">
                                            {{ $recipe['cosine_similarity'] }} Similarity
                                        </p>
                                    @endif
                                </div>

                                {{-- Bookmark Button --}}
                                <button wire:click="toggleBookmark({{ $recipe['recipe']['id'] }})"
                                    class="p-2 rounded-full hover:bg-gray-100 transition-colors duration-200">
                                    @if ($recipe['recipe']->isBookmarkedBy(auth()->user()))
                                        <i class="fa-solid fa-bookmark text-xl hover:text-red-600"
                                            style="color: #DD5C36;"></i>
                                    @else
                                        <i class="fa-regular fa-bookmark text-xl text-gray-400"
                                            style="hover: #DD5C36;"></i>
                                    @endif
                                </button>
                            </div>
                        </div>

                        {{-- Main Content Section --}}
                        <div class="relative p-4 pt-0">
                            <div class="flex gap-4">
                                {{-- Recipe Image --}}
                                <div class="flex-shrink-0">
                                    @if ($recipe['recipe']['image'])
                                        <div class="relative overflow-hidden rounded-xl shadow-md">
                                            <img class="h-40 w-40 object-cover transition-transform duration-500 group-hover:scale-110"
                                                src="{{ asset($recipe['recipe']['image']) }}"
                                                alt="{{ $recipe['recipe']['name'] }}">
                                            <div
                                                class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                            </div>
                                        </div>
                                    @else
                                        <div
                                            class="h-40 w-40 flex justify-center items-center bg-gradient-to-br from-gray-100 to-gray-200 rounded-xl shadow-md">
                                            <i class="fa-regular fa-image text-2xl text-gray-400"></i>
                                        </div>
                                    @endif
                                </div>

                                {{-- Recipe Details --}}
                                <div class="flex-1 min-w-0">
                                    {{-- Recipe Title --}}
                                    <h3
                                        class="text-lg font-bold text-gray-800 mb-1 line-clamp-1 group-hover:text-green-700 transition-colors duration-200">
                                        {{ $recipe['recipe']['name'] }}
                                    </h3>

                                    {{-- Description --}}
                                    <p class="text-sm text-gray-600 mb-3 line-clamp-2 leading-relaxed">
                                        {{ $recipe['recipe']['description'] }}
                                    </p>

                                    {{-- Ingredients Section --}}
                                    <div class="mb-3">
                                        <h4 class="text-xs font-semibold text-gray-700 mb-1 uppercase tracking-wide">
                                            Available Ingredients</h4>
                                        <div class="flex flex-wrap gap-1">
                                            @foreach ($recipe['recipe']['ingredients'] as $key => $ingredient)
                                                @if ($key < 3)
                                                    <span
                                                        class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium bg-green-100 text-green-800 border border-green-200">
                                                        {{ $ingredient['name'] }}
                                                    </span>
                                                @endif
                                            @endforeach
                                            @if (count($recipe['recipe']['ingredients']) > 3)
                                                <span
                                                    class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium bg-gray-100 text-gray-600">
                                                    +{{ count($recipe['recipe']['ingredients']) - 3 }} more
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    {{-- Missing Ingredients --}}
                                    @if ($recipe['matching_percentage'] && $recipe['missing_ingredients'])
                                        <div class="mb-3">
                                            <h4
                                                class="text-xs font-semibold text-gray-700 mb-1 uppercase tracking-wide">
                                                Missing Ingredients
                                            </h4>
                                            <div class="flex flex-wrap gap-1">
                                                @foreach ($recipe['missing_ingredients']->take(3) as $ingredient)
                                                    <span
                                                        class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium bg-orange-100 text-orange-800 border border-orange-200 line-through">
                                                        {{ $ingredient['name'] }}
                                                    </span>
                                                @endforeach
                                                @if ($recipe['missing_ingredients']->count() > 3)
                                                    <span
                                                        class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium bg-gray-100 text-gray-600">
                                                        +{{ $recipe['missing_ingredients']->count() - 3 }} more
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- Stats Section --}}
                        <div class="relative px-4 pb-4">
                            <div class="flex items-center justify-between text-xs">
                                <div class="flex items-center space-x-4">
                                    {{-- Cooking Time --}}
                                    <div class="flex items-center space-x-1" style="color: #327039;">
                                        <i class="fa-regular fa-clock"></i>
                                        <span class="font-medium">{{ $recipe['recipe']['cooking_time'] }}m</span>
                                    </div>

                                    {{-- Difficulty --}}
                                    <div class="flex items-center space-x-1 capitalize" style="color: #DD5C36;">
                                        <i class="fa-solid fa-sliders"></i>
                                        <span class="font-medium">{{ $recipe['recipe']['difficulty'] }}</span>
                                    </div>

                                    {{-- Servings --}}
                                    <div class="flex items-center space-x-1" style="color: #327039;">
                                        <i class="fa-solid fa-bowl-food"></i>
                                        <span class="font-medium">{{ $recipe['recipe']['servings'] }}</span>
                                    </div>

                                    {{-- Views --}}
                                    <div class="flex items-center space-x-1 text-gray-500">
                                        <i class="fa-solid fa-eye"></i>
                                        <span class="font-medium">{{ $recipe['recipe']['views_count'] }}</span>
                                    </div>
                                </div>

                                {{-- Calories --}}
                                <div class="flex items-center space-x-1" style="color: #DD5C36;">
                                    <i class="fa-solid fa-fire-flame-curved"></i>
                                    <span class="font-medium">
                                        {{ floor($recipe['recipe']['calories'] / $recipe['recipe']['servings']) }}
                                        kkal
                                    </span>
                                </div>
                            </div>
                        </div>

                        {{-- Action Button --}}
                        <div class="relative px-4 pb-4">
                            <button wire:click="viewRecipeDetail({{ $recipe['recipe']['id'] }})"
                                class="w-full text-white text-base font-semibold py-3 px-4 rounded-xl transition-all duration-300 transform hover:scale-[1.02] shadow-lg hover:shadow-xl"
                                style="background: linear-gradient(135deg, #DD5C36 0%, #FF8C4B 100%);
                                       transition: all 0.3s ease-in-out;">
                                Lihat Detail Resep
                            </button>
                        </div>

                        {{-- Hover Effect Overlay --}}
                        <div
                            class="absolute inset-0 rounded-2xl bg-gradient-to-r from-green-500/5 to-orange-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none">
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
</div>
