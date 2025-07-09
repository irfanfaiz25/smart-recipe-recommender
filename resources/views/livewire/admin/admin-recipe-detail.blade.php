<div x-show="pageLoaded" x-transition:enter="transform transition-all duration-700 ease-out"
    x-transition:enter-start="opacity-0 -translate-x-full" x-transition:enter-end="opacity-100 translate-x-0"
    class="w-full">
    <div class="mt-3 w-full bg-white dark:bg-bg-dark-primary rounded-lg shadow-lg h-fit">
        <div class="relative w-full rounded-t-lg">
            @if ($recipe->image)
                <img class="w-full h-48 sm:h-64 md:h-80 lg:h-[30rem] rounded-t-lg object-cover"
                    src="{{ $recipe->image }}">
            @else
                <div
                    class="w-full h-48 sm:h-64 md:h-80 lg:h-[30rem] rounded-t-lg bg-gray-200 dark:bg-bg-dark-primary flex justify-center items-center">
                    <div class="flex flex-col items-center space-y-3">
                        <i
                            class="fa-solid fa-utensils text-2xl sm:text-3xl md:text-4xl text-gray-500 dark:text-text-dark-primary"></i>
                        <p
                            class="font-normal italic text-gray-500 dark:text-text-dark-primary text-sm sm:text-base px-4 text-center">
                            {{ $recipe->name }}
                        </p>
                    </div>
                </div>
            @endif
            <button onclick="history.back()"
                class="px-3 py-2 sm:px-4 sm:py-2.5 md:px-6 md:py-3 absolute top-3 left-3 bg-black/40 hover:bg-black/60 text-white text-sm sm:text-base font-semibold rounded-lg shadow-lg">
                <i class="fa-solid fa-chevron-left pe-1 text-xs sm:text-sm"></i>
                <span class="hidden sm:inline">Kembali</span>
                <span class="sm:hidden">Back</span>
            </button>
            @if ($recipe->is_published)
                @switch($recipe->moderation?->status)
                    @case('approved')
                        <div
                            class="absolute top-3 right-3 flex justify-center items-center space-x-1 sm:space-x-2 px-3 py-2 sm:px-5 sm:py-2.5 bg-green-100 dark:bg-bg-dark-primary bg-opacity-80 backdrop-blur-sm border border-green-300 text-green-700 dark:text-text-dark-primary text-xs sm:text-sm rounded-full">
                            <i class="fa-solid fa-earth-americas text-sm sm:text-lg"></i>
                            <span class="hidden sm:inline">
                                Public
                            </span>
                        </div>
                    @break

                    @case('pending')
                        <div
                            class="absolute top-3 right-3 flex justify-center items-center space-x-1 sm:space-x-2 px-3 py-2 sm:px-5 sm:py-2.5 bg-amber-100 dark:bg-bg-dark-primary bg-opacity-80 backdrop-blur-sm border border-amber-300 text-amber-700 dark:text-text-dark-primary text-xs sm:text-sm rounded-full">
                            <i class="fa fa-clock text-sm sm:text-lg"></i>
                            <span class="hidden sm:inline">
                                Dalam Peninjauan
                            </span>
                        </div>
                    @break

                    @case('rejected')
                        <div
                            class="absolute top-3 right-3 flex justify-center items-center space-x-1 sm:space-x-2 px-3 py-2 sm:px-5 sm:py-2.5 bg-red-100 dark:bg-bg-dark-primary bg-opacity-80 backdrop-blur-sm border border-red-300 text-red-700 dark:text-text-dark-primary text-xs sm:text-sm rounded-full">
                            <i class="fa-solid fa-ban text-sm sm:text-lg"></i>
                            <span class="hidden sm:inline">
                                Publikasi Ditolak
                            </span>
                        </div>
                    @break

                    @default
                @endswitch
            @else
                <div
                    class="absolute top-3 right-3 flex justify-center items-center space-x-1 sm:space-x-2 px-3 py-2 sm:px-5 sm:py-2.5 bg-gray-100 dark:bg-bg-dark-primary bg-opacity-80 backdrop-blur-sm border border-gray-300 text-gray-700 dark:text-text-dark-primary text-xs sm:text-sm rounded-full">
                    <i class="fa-solid fa-box-archive text-sm sm:text-lg"></i>
                    <span class="hidden sm:inline">
                        Draf
                    </span>
                </div>
            @endif
        </div>
        <div class="py-4 px-4 sm:py-6 sm:px-8 md:py-8 md:px-16 lg:px-32">
            {{-- head details --}}
            <h3
                class="text-sm sm:text-base md:text-lg font-medium text-gray-600 dark:text-text-dark-primary text-center uppercase">
                recipe by {{ $recipe->user->name }}
            </h3>
            <h1
                class="mt-2 text-2xl sm:text-3xl md:text-4xl lg:text-5xl xl:text-6xl font-bold font-display text-center dark:text-text-dark-primary px-2 capitalize">
                {{ $recipe->name }}
            </h1>
            <div
                class="mt-4 sm:mt-6 md:mt-8 flex space-x-1 justify-center items-center text-secondary text-lg sm:text-xl md:text-2xl">
                @for ($i = 1; $i <= 5; $i++)
                    <i class="fa-{{ $i <= (int) $averageRating ? 'solid' : 'regular' }} fa-star"></i>
                @endfor
                <p class="text-text-primary dark:text-text-dark-primary font-semibold text-lg sm:text-xl md:text-2xl">
                    /{{ $averageRating }}
                </p>
            </div>
            <div class="mt-4 sm:mt-6 md:mt-8 flex items-center justify-center">
                <div
                    class="w-full sm:w-[90%] md:w-[80%] lg:w-[60%] h-auto grid grid-cols-2 md:grid-cols-4 gap-2 md:gap-0">
                    <div
                        class="border border-gray-200 md:border-t md:border-b md:border-l-0 md:border-r-0 flex justify-center items-center p-3 md:p-0 md:h-28 text-sm sm:text-base md:text-lg">
                        <div class="text-center">
                            <i class="fa-solid fa-sliders text-yellow-500 mb-1 md:mb-0"></i>
                            <p
                                class="font-medium capitalize dark:text-text-dark-primary text-xs sm:text-sm md:text-base">
                                {{ $recipe->difficulty }}</p>
                        </div>
                    </div>
                    <div
                        class="border border-gray-200 flex justify-center items-center p-3 md:p-0 md:h-28 text-sm sm:text-base md:text-lg">
                        <div class="text-center">
                            <i class="fa-regular fa-clock text-blue-500 mb-1 md:mb-0"></i>
                            <p class="font-medium dark:text-text-dark-primary text-xs sm:text-sm md:text-base">
                                {{ $recipe->cooking_time }} min</p>
                        </div>
                    </div>
                    <div
                        class="border border-gray-200 flex justify-center items-center p-3 md:p-0 md:h-28 text-sm sm:text-base md:text-lg col-span-2 md:col-span-1">
                        <div class="text-center py-2">
                            <i class="fa-solid fa-fire-flame-curved text-orange-500 text-lg sm:text-xl mb-2"></i>
                            @if ($recipe->calories)
                                <div class="flex justify-center">
                                    <div class="px-1.5 flex flex-col border-r border-gray-200">
                                        <span
                                            class="font-bold text-sm sm:text-base md:text-lg text-primary dark:text-text-dark-primary">{{ $recipe->calories }}</span>
                                        <span
                                            class="text-xs text-gray-600 dark:text-text-dark-primary font-medium">Total
                                            Kkal</span>
                                    </div>
                                    <div class="px-1.5 flex flex-col">
                                        <span
                                            class="font-bold text-sm sm:text-base md:text-lg text-primary dark:text-text-dark-primary">{{ floor($recipe->calories / $recipe->servings) }}</span>
                                        <span
                                            class="text-xs text-gray-600 dark:text-text-dark-primary font-medium">Kkal/Porsi</span>
                                    </div>
                                </div>
                            @else
                                <span
                                    class="text-xs sm:text-sm text-gray-400 dark:text-text-dark-primary font-medium">Tidak
                                    ada
                                    info kalori</span>
                            @endif
                        </div>
                    </div>
                    <div
                        class="border border-gray-200 md:border-t md:border-b md:border-l-0 md:border-r-0 flex justify-center items-center p-3 md:p-0 md:h-28 text-sm sm:text-base md:text-lg col-span-2 md:col-span-1">
                        <div class="text-center">
                            <i class="fa-solid fa-bowl-food text-orange-500 mb-1 md:mb-0"></i>
                            <p class="font-medium dark:text-text-dark-primary text-xs sm:text-sm md:text-base">
                                {{ $recipe->servings }} porsi</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-4 sm:mt-6 flex justify-center items-center">
                <p
                    class="w-full sm:w-3/4 md:w-2/3 lg:w-1/2 text-sm sm:text-base text-center font-medium text-gray-700 dark:text-text-dark-primary italic px-4">
                    {{ $recipe->description ?? 'Resep lezat yang siap untuk dimoderasi dan dinikmati oleh semua pengguna.' }}
                </p>
            </div>
            {{-- end head details --}}

            {{-- recipe ingredients & steps --}}
            <div class="mt-8 sm:mt-10 md:mt-12 flex flex-col lg:flex-row lg:space-x-4 space-y-6 lg:space-y-0">
                <div class="w-full lg:w-[40%]">
                    <h2 class="text-xl sm:text-2xl font-display font-medium text-gray-800 dark:text-text-dark-primary">
                        Bahan Masakan
                    </h2>
                    <ul
                        class="mt-3 w-full lg:w-[80%] text-sm sm:text-base md:text-lg text-gray-700 dark:text-text-dark-primary space-y-3 font-normal">
                        @foreach ($recipe->ingredients as $ingredient)
                            <li class="pb-2 border-b border-gray-200"><i
                                    class="fa-solid fa-circle-check pe-2 text-sm"></i>
                                {{ $ingredient->pivot->amount . ' ' . $ingredient->pivot->unit . ' ' . $ingredient->name }}
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="w-full lg:w-[60%]">
                    <h2 class="text-xl sm:text-2xl font-display font-medium text-gray-800 dark:text-text-dark-primary">
                        Langkah Pembuatan
                    </h2>
                    <ul
                        class="mt-3 text-sm sm:text-base md:text-lg text-gray-700 dark:text-text-dark-primary space-y-4 font-normal">
                        @foreach ($recipe->steps as $step)
                            <li class="pb-3 flex space-x-2 border-b border-gray-200">
                                <p class="text-sm sm:text-base font-normal pt-1 flex items-start">
                                    <span
                                        class="text-3xl sm:text-4xl md:text-5xl font-display font pe-2 sm:pe-3 text-gray-800 dark:text-text-dark-primary flex-shrink-0">{{ $loop->iteration }}</span>
                                    <span class="pt-1">
                                        {{ $step->description }}
                                    </span>
                                </p>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            {{-- end recipe ingredients & steps --}}
            {{-- comment section --}}
            <div class="mt-5">
                <div
                    class="flex flex-col sm:flex-row sm:justify-between sm:items-end space-y-2 sm:space-y-0 sm:space-x-2 border-b border-gray-300 py-2">
                    <div>
                        <h2 class="text-xl sm:text-2xl font-display font-semibold dark:text-text-dark-primary">
                            {{ $recipe->ratings->count() }} Reviews
                        </h2>
                        <div class="mt-1 flex space-x-1 items-center text-secondary text-lg sm:text-xl">
                            @for ($i = 1; $i <= 5; $i++)
                                <i class="fa-{{ $i <= (int) $averageRating ? 'solid' : 'regular' }} fa-star"></i>
                            @endfor
                            <p class="text-text-primary dark:text-text-dark-primary font-semibold text-base sm:text-lg">
                                /{{ $averageRating }}
                            </p>
                        </div>
                    </div>
                    <div class="flex justify-start sm:justify-end items-center space-x-2">
                        <label for="sortby"
                            class="text-xs sm:text-sm text-gray-700 dark:text-text-dark-primary font-semibold">
                            <i class="fa-solid fa-arrow-up-wide-short"></i>
                            Urutkan
                        </label>
                        <select id="sortby" wire:model.live.debounce.300ms='sortBy'
                            class="shadow-xs bg-gray-50 dark:bg-bg-dark-primary border border-gray-300 text-gray-900 dark:text-text-dark-primary text-xs sm:text-sm rounded-lg block min-w-24 sm:min-w-32 p-1.5 sm:p-2">
                            <option value="latest">Terbaru</option>
                            <option value="higher">Tertinggi</option>
                            <option value="lower">Terendah</option>
                            <option value="likes">Disukai</option>
                        </select>
                    </div>
                </div>
                <div class="mt-3">
                    @foreach ($ratings as $item)
                        <div class="flex space-x-2 w-full border-b border-gray-300 py-3">
                            @if ($item->user->avatar)
                                <img class="h-8 w-8 sm:h-9 sm:w-9 rounded-full object-cover flex-shrink-0"
                                    src="{{ $item->user->avatar }}" alt="{{ $item->user->name }}">
                            @else
                                <i
                                    class="fa fa-circle-user text-3xl sm:text-4xl text-gray-500 dark:text-text-dark-primary flex-shrink-0"></i>
                            @endif
                            <div class="w-full min-w-0">
                                <div
                                    class="flex flex-col sm:flex-row sm:justify-between w-full space-y-1 sm:space-y-0">
                                    <div
                                        class="text-sm sm:text-base font-semibold text-text-primary dark:text-text-dark-primary">
                                        <p class="truncate">{{ $item->user->name }}
                                            <span
                                                class="text-xs sm:text-base font-normal text-gray-500 dark:text-text-dark-primary ml-1 block sm:inline">
                                                {{ $item->created_at->diffForHumans() }}
                                            </span>
                                        </p>
                                    </div>
                                    <div
                                        class="flex space-x-1 items-start text-base sm:text-lg text-secondary flex-shrink-0">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <i class="fa-{{ $i <= $item->rating ? 'solid' : 'regular' }} fa-star"></i>
                                        @endfor
                                    </div>
                                </div>
                                <p
                                    class="mt-1 text-xs sm:text-sm font-normal text-gray-700 dark:text-text-dark-primary break-words">
                                    {{ $item->comment }}
                                </p>
                                <div class="mt-2 flex space-x-2 items-center">
                                    <i
                                        class="fa-solid fa-thumbs-up text-sm sm:text-base text-secondary cursor-pointer"></i>
                                    <p
                                        class="text-xs sm:text-sm font-semibold text-gray-700 dark:text-text-dark-primary">
                                        {{ $item->likedBy->count() }} Likes
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
            {{-- end comment section --}}
        </div>
    </div>
</div>
