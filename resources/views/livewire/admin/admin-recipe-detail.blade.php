<div x-show="pageLoaded" x-transition:enter="transform transition-all duration-700 ease-out"
    x-transition:enter-start="opacity-0 -translate-x-full" x-transition:enter-end="opacity-100 translate-x-0"
    class="w-full">
    <div class="mt-3 w-full bg-white rounded-lg shadow-lg h-fit">
        <div class="relative w-full rounded-t-lg">
            @if ($recipe->image)
                <img class="w-full h-[30rem] rounded-t-lg object-cover" src="{{ asset($recipe->image) }}">
            @else
                <div class="w-full h-[30rem] rounded-t-lg bg-gray-200 flex justify-center items-center">
                    <div class="flex flex-col items-center space-y-3">
                        <i class="fa-solid fa-utensils text-4xl text-gray-500"></i>
                        <p class="font-normal italic text-gray-500">
                            {{ $recipe->name }}
                        </p>
                    </div>
                </div>
            @endif
            <button onclick="history.back()"
                class="px-6 py-3 absolute top-3 left-3 bg-black/40 hover:bg-black/60 text-white text-base font-semibold rounded-lg shadow-lg">
                <i class="fa-solid fa-chevron-left pe-1 text-sm"></i>
                Kembali
            </button>
            @if ($recipe->is_published)
                @switch($recipe->moderation?->status)
                    @case('approved')
                        <div
                            class="absolute top-3 right-3 flex justify-center items-center space-x-2 px-5 py-2.5 bg-green-100 bg-opacity-80 backdrop-blur-sm border border-green-300 text-green-700 text-sm rounded-full">
                            <i class="fa-solid fa-earth-americas text-lg"></i>
                            <span>
                                Public
                            </span>
                        </div>
                    @break

                    @case('pending')
                        <div
                            class="absolute top-3 right-3 flex justify-center items-center space-x-2 px-5 py-2.5 bg-amber-100 bg-opacity-80 backdrop-blur-sm border border-amber-300 text-amber-700 text-sm rounded-full">
                            <i class="fa fa-clock text-lg"></i>
                            <span>
                                Dalam Peninjauan
                            </span>
                        </div>
                    @break

                    @case('rejected')
                        <div
                            class="absolute top-3 right-3 flex justify-center items-center space-x-2 px-5 py-2.5 bg-red-100 bg-opacity-80 backdrop-blur-sm border border-red-300 text-red-700 text-sm rounded-full">
                            <i class="fa-solid fa-ban text-lg"></i>
                            <span>
                                Publikasi Ditolak
                            </span>
                        </div>
                    @break

                    @default
                @endswitch
            @else
                <div
                    class="absolute top-3 right-3 flex justify-center items-center space-x-2 px-5 py-2.5 bg-gray-100 bg-opacity-80 backdrop-blur-sm border border-gray-300 text-gray-700 text-sm rounded-full">
                    <i class="fa-solid fa-box-archive text-lg"></i>
                    <span>
                        Draf
                    </span>
                </div>
            @endif
        </div>
        <div class="py-8 px-32">
            {{-- head details --}}
            <h3 class="text-lg font-medium text-gray-600 text-center uppercase">
                recipe by {{ $recipe->user->name }}
            </h3>
            <h1 class="mt-2 text-6xl font-bold font-display text-center">
                {{ $recipe->name }}
            </h1>
            <div class="mt-8 flex space-x-1 justify-center items-center text-secondary text-2xl">
                @for ($i = 1; $i <= 5; $i++)
                    <i class="fa-{{ $i <= (int) $averageRating ? 'solid' : 'regular' }} fa-star"></i>
                @endfor
                <p class="text-text-primary font-semibold text-2xl">
                    /{{ $averageRating }}
                </p>
            </div>
            <div class="mt-8 flex items-center justify-center">
                <div class="w-[60%] h-28 grid grid-cols-4">
                    <div class="border-t border-b border-gray-200 flex justify-center items-center space-x-2 text-lg">
                        <div class="text-center">
                            <i class="fa-solid fa-sliders text-yellow-500"></i>
                            <p class="font-medium capitalize">{{ $recipe->difficulty }}</p>
                        </div>
                    </div>
                    <div class="border border-gray-200 flex justify-center items-center space-x-2 text-lg">
                        <div class="text-center">
                            <i class="fa-regular fa-clock text-blue-500"></i>
                            <p class="font-medium">{{ $recipe->cooking_time }} min</p>
                        </div>
                    </div>
                    <div class="border border-gray-200 flex justify-center items-center text-lg">
                        <div class="text-center py-2">
                            <i class="fa-solid fa-fire-flame-curved text-orange-500 text-xl mb-2"></i>
                            @if ($recipe->calories)
                                <div class="flex">
                                    <div class="px-1.5 flex flex-col border-r border-gray-200">
                                        <span class="font-bold text-lg text-primary">{{ $recipe->calories }}</span>
                                        <span class="text-xs text-gray-600 font-medium">Total Kkal</span>
                                    </div>
                                    <div class="px-1.5 flex flex-col">
                                        <span
                                            class="font-bold text-lg text-primary">{{ floor($recipe->calories / $recipe->servings) }}</span>
                                        <span class="text-xs text-gray-600 font-medium">Kkal/Porsi</span>
                                    </div>
                                </div>
                            @else
                                <span class="text-sm text-gray-400 font-medium">Tidak ada info kalori</span>
                            @endif
                        </div>
                    </div>
                    <div class="border-t border-b border-gray-200 flex justify-center items-center space-x-2 text-lg">
                        <div class="text-center">
                            <i class="fa-solid fa-bowl-food text-orange-500"></i>
                            <p class="font-medium">{{ $recipe->servings }} porsi</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-6 flex justify-center items-center">
                <p class="w-1/2 text-base text-center font-medium text-gray-700 italic">
                    {{ $recipe->description ?? 'Resep lezat yang siap untuk dimoderasi dan dinikmati oleh semua pengguna.' }}
                </p>
            </div>
            {{-- end head details --}}

            {{-- recipe ingredients & steps --}}
            <div class="mt-12 flex space-x-4">
                <div class="w-[40%]">
                    <h2 class="text-2xl font-display font-medium text-gray-800">
                        Bahan Masakan
                    </h2>
                    <ul class="mt-3 w-[80%] text-lg text-gray-700 space-y-3 font-normal">
                        @foreach ($recipe->ingredients as $ingredient)
                            <li class="pb-2 border-b border-gray-200"><i
                                    class="fa-solid fa-circle-check pe-2 text-sm"></i>
                                {{ $ingredient->pivot->amount . ' ' . $ingredient->pivot->unit . ' ' . $ingredient->name }}
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="w-[60%]">
                    <h2 class="text-2xl font-display font-medium text-gray-800">
                        Langkah Pembuatan
                    </h2>
                    <ul class="mt-3 text-lg text-gray-700 space-y-4 font-normal">
                        @foreach ($recipe->steps as $step)
                            <li class="pb-3 flex space-x-2 border-b border-gray-200">
                                <p class="text-base font-normal pt-1 flex items-start">
                                    <span
                                        class="text-5xl font-display font pe-3 text-gray-800">{{ $loop->iteration }}</span>
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
                <div class="flex justify-between items-end space-x-2 border-b border-gray-300 py-2 ">
                    <div>
                        <h2 class="text-2xl font-display font-semibold">
                            {{ $recipe->ratings->count() }} Reviews
                        </h2>
                        <div class="mt-1 flex space-x-1 items-center text-secondary text-xl">
                            @for ($i = 1; $i <= 5; $i++)
                                <i class="fa-{{ $i <= (int) $averageRating ? 'solid' : 'regular' }} fa-star"></i>
                            @endfor
                            <p class="text-text-primary font-semibold text-lg">
                                /{{ $averageRating }}
                            </p>
                        </div>
                    </div>
                    <div class="flex justify-end items-center space-x-2">
                        <label for="sortby" class="text-sm text-gray-700 font-semibold">
                            <i class="fa-solid fa-arrow-up-wide-short"></i>
                            Urutkan
                        </label>
                        <select id="sortby" wire:model.live.debounce.300ms='sortBy'
                            class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block min-w-32 p-2 dark:bg-bg-dark-primary dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark dark:shadow-xs-light font-normal">
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
                                <img class="h-9 w-9 rounded-full object-cover" src="{{ asset($item->user->avatar) }}"
                                    alt="{{ $item->user->name }}">
                            @else
                                <i class="fa fa-circle-user text-4xl text-gray-500"></i>
                            @endif
                            <div class="w-full">
                                <div class="flex justify-between w-full">
                                    <div class="text-base font-semibold text-text-primary">
                                        <p>{{ $item->user->name }}
                                            <span class="text-base font-normal text-gray-500 ml-1">
                                                21 Februari 2025
                                            </span>
                                        </p>
                                    </div>
                                    <div class="flex space-x-1 items-start text-lg text-secondary">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <i class="fa-{{ $i <= $item->rating ? 'solid' : 'regular' }} fa-star"></i>
                                        @endfor
                                    </div>
                                </div>
                                <p class="mt-1 text-sm font-normal text-gray-700">
                                    {{ $item->comment }}
                                </p>
                                <div class="mt-2 flex space-x-2 items-center">
                                    <i class="fa-solid fa-thumbs-up text-base text-secondary cursor-pointer"></i>
                                    <p class="text-sm font-semibold text-gray-700">
                                        {{ $item->likedBy->count() }} Likes
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <div class="flex space-x-2 w-full border-b border-gray-300 py-3">
                        <i class="fa fa-circle-user text-4xl text-gray-500"></i>
                        <div>
                            <div class="flex justify-between w-full">
                                <div class="text-base font-semibold text-text-primary">
                                    <p>Tomingse
                                        <span class="text-base font-normal text-gray-500 ml-1">
                                            21 Februari 2025
                                        </span>
                                    </p>
                                </div>
                                <div class="flex space-x-1 items-start text-lg text-secondary">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                </div>
                            </div>
                            <p class="mt-1 text-sm font-normal text-gray-700">
                                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Iusto aliquam doloribus
                                ipsum nesciunt ab tenetur accusamus rem explicabo? Eum, maiores quae qui reiciendis
                                saepe sapiente. Iusto quisquam fugiat veniam recusandae.
                            </p>
                            <div class="mt-2 flex space-x-2 items-center">
                                <i class="fa-solid fa-thumbs-up text-base text-secondary cursor-pointer"></i>
                                <p class="text-sm font-semibold text-gray-700">
                                    1 Likes
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            {{-- end comment section --}}
        </div>
    </div>
</div>
