<div x-show="pageLoaded" x-transition:enter="transform transition-all duration-700 ease-out"
    x-transition:enter-start="opacity-0 translate-x-full" x-transition:enter-end="opacity-100 translate-x-0"
    class="w-full">

    <div class="rounded-lg p-4 bg-white shadow-lg h-fit">
        <div class="mt-2 w-full h-fit overflow-y-auto">
            <h2 class="text-base">
                Rekomendasi Resep :
            </h2>

            {{-- card recipe recommendation --}}
            <div class="mt-4 grid grid-cols-2 gap-4">
                @foreach ($matchedRecipes as $recipe)
                    {{-- @dd($recipe['ratings']) --}}
                    <div class="flex">
                        <div class="w-full border-2 border-primary rounded-lg">
                            {{-- card header --}}
                            <div class="h-12 w-full p-3 flex justify-between items-center bg-primary rounded-t-sm">
                                <div class="flex space-x-1 items-center justify-start text-text-dark-primary text-base">
                                    @if ($recipe['ratings'])
                                        @for ($i = 1; $i <= 5; $i++)
                                            <i
                                                class="fa-{{ $i <= (int) $recipe['ratings'] ? 'solid' : 'regular' }} fa-star"></i>
                                        @endfor
                                    @else
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-regular fa-star"></i>
                                    @endif
                                    @if ($recipe['matching_percentage'])
                                        <p>| Tingkat Kecocokan : {{ (int) $recipe['matching_percentage'] }} %</p>
                                    @endif
                                </div>
                                <div class="flex space-x-2 items-center justify-end">
                                    @if ($recipe['recipe']->isBookmarkedBy(auth()->user()))
                                        <i wire:click="toggleBookmark({{ $recipe['recipe']['id'] }})"
                                            class="fa-solid fa-bookmark text-xl text-gray-50 hover:text-gray-200 cursor-pointer"></i>
                                    @else
                                        <i wire:click="toggleBookmark({{ $recipe['recipe']['id'] }})"
                                            class="fa-regular fa-bookmark text-xl text-gray-50 hover:text-gray-200 cursor-pointer"></i>
                                    @endif
                                    <button wire:click="viewRecipeDetail({{ $recipe['recipe']['id'] }})"
                                        class="px-4 py-1.5 text-xs bg-gray-50 text-text-primary hover:bg-gray-200 rounded-md">
                                        Lihat Detail
                                    </button>
                                </div>
                            </div>
                            {{-- card body --}}
                            <div class="h-[205px] w-full flex gap-3 p-3">
                                {{-- image card --}}
                                <div>
                                    @if ($recipe['recipe']['image'])
                                        <div class="h-[180px] w-[180px]">
                                            <img class="h-[180px] w-[180px] object-cover rounded-md shadow-md"
                                                src="{{ asset($recipe['recipe']['image']) }}"
                                                alt="{{ $recipe['recipe']['name'] }}">
                                        </div>
                                    @else
                                        <div
                                            class="h-[180px] w-[180px] flex justify-center items-center bg-gray-300 rounded-md shadow-md">
                                            <i class="fa-regular fa-image text-2xl text-gray-400"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex flex-col justify-between">
                                    <div>
                                        <h2 class="text-lg font-bold text-primary">
                                            {{ $recipe['recipe']['name'] }}
                                        </h2>
                                        <p class="mt-1 text-neutral-700 text-sm font-normal">
                                            {{ $recipe['recipe']['description'] }}
                                        </p>
                                        <div class="mt-2 w-full">
                                            <p class="mt-1 text-neutral-700 text-sm font-semibold">
                                                Bahan Masakan :
                                            </p>
                                            <p class="text-neutral-700 text-sm font-normal">
                                                @foreach ($recipe['recipe']['ingredients'] as $key => $ingredient)
                                                    @if ($key < 4)
                                                        {{ $ingredient['name'] }}{{ $key < 3 && isset($recipe['recipe']['ingredients'][$key + 1]) ? ', ' : '' }}
                                                    @endif
                                                @endforeach
                                                @if (count($recipe['recipe']['ingredients']) > 4)
                                                    , dll.
                                                @endif
                                            </p>
                                        </div>
                                        @if ($recipe['matching_percentage'] && $recipe['missing_ingredients'])
                                            <div class="w-full">
                                                <p class="mt-1 text-neutral-700 text-sm font-semibold">
                                                    -
                                                </p>
                                                <p class="text-neutral-700 text-sm font-normal line-through">
                                                    @foreach ($recipe['missing_ingredients'] as $key => $ingredient)
                                                        @if ($key < 5)
                                                            {{ $ingredient['name'] }}{{ $key < 4 && isset($recipe['missing_ingredients'][$key + 1]) ? ', ' : '' }}
                                                        @endif
                                                    @endforeach
                                                    @if (count($recipe['missing_ingredients']) > 5)
                                                        , dll.
                                                    @endif
                                                </p>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex space-x-4">
                                        <div class="flex justify-center items-center space-x-3">
                                            <div class="flex items-center space-x-2 text-sm">
                                                <i class="fa-regular fa-clock text-primary"></i>
                                                <span class="font-medium">{{ $recipe['recipe']['cooking_time'] }}
                                                    min</span>
                                            </div>
                                            <div class="flex items-center space-x-2 text-sm capitalize">
                                                <i class="fa-solid fa-sliders text-yellow-500"></i>
                                                <span class="font-medium">{{ $recipe['recipe']['difficulty'] }}</span>
                                            </div>
                                            <div class="flex items-center space-x-2 text-sm">
                                                <i class="fa-solid fa-bowl-food text-secondary"></i>
                                                <span class="font-medium">{{ $recipe['recipe']['servings'] }}</span>
                                            </div>
                                            <div class="flex items-center space-x-2 text-sm">
                                                <i class="fa-solid fa-eye text-secondary"></i>
                                                <span class="font-medium">{{ $recipe['recipe']['views_count'] }}</span>
                                            </div>
                                            <div class="flex items-center space-x-2 text-sm">
                                                <i class="fa-solid fa-fire-flame-curved text-secondary"></i>
                                                <span class="font-medium">
                                                    {{ $recipe['recipe']['calories'] }} Kkal |
                                                    {{ floor($recipe['recipe']['calories'] / $recipe['recipe']['servings']) }}
                                                    Kkal/porsi
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
</div>
