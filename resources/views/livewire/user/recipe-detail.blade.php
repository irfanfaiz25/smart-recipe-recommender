<div x-show="pageLoaded" x-transition:enter="transform transition-all duration-700 ease-out"
    x-transition:enter-start="opacity-0 -translate-x-full" x-transition:enter-end="opacity-100 translate-x-0"
    class="w-full">
    <div class="mt-3 w-full bg-white rounded-lg shadow-lg h-fit">
        <div class="relative w-full rounded-t-lg ">
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
                class="px-6 py-3 absolute top-3 left-3 bg-black/40 hover:bg-black/60 text-text-dark-primary text-base font-semibold rounded-lg shadow-lg">
                <i class="fa-solid fa-chevron-left pe-1 text-sm"></i>
                Kembali
            </button>
        </div>
        <div class="py-8 px-32">
            {{-- head details --}}
            {{-- user avatar --}}
            <div class="flex justify-center items-center mb-2">
                @if ($recipe->user->avatar_url)
                    <img class="w-12 h-12 rounded-full object-cover" src="{{ asset($recipe->user->avatar_url) }}"
                        alt="{{ $recipe->user->name }}">
                @else
                    <div class="w-12 h-12 rounded-full bg-gray-200 flex justify-center items-center">
                        <i class="fa-solid fa-user text-2xl text-gray-500"></i>
                    </div>
                @endif
            </div>
            <h3 class="text-lg font-medium text-text-primary text-center uppercase mb-1">
                recipe by {{ $recipe->user->name }}
            </h3>
            <div class="flex justify-center items-center space-x-2 text-sm mb-4">
                <i class="fa fa-location-dot text-text-primary"></i>
                <p class="text-gray-600 capitalize">{{ $recipe->user->creators->city }}</p>
            </div>
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
                <div class="w-1/2 h-28 grid grid-cols-4">
                    <div class="border-t border-b border-gray-200 flex justify-center items-center space-x-2 text-lg">
                        <div class="text-center">
                            <i class="fa-solid fa-sliders text-yellow-500"></i>
                            <p class="font-medium capitalize">{{ $recipe->difficulty }}</p>
                        </div>
                    </div>
                    <div class="border border-gray-200 flex justify-center items-center space-x-2 text-lg">
                        <div class="text-center">
                            <i class="fa-regular fa-clock text-primary"></i>
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
                            <i class="fa-solid fa-bowl-food text-secondary"></i>
                            <p class="font-medium">{{ $recipe->servings }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-6 flex justify-center items-center">
                <p class="w-1/2 text-base text-center font-medium text-text-primary italic">
                    {{ $recipe->description }}
                </p>
            </div>
            {{-- end head details --}}
            {{-- button --}}
            <div class="mt-10 flex justify-center items-center space-x-3">
                <button wire:click='toggleBookmark({{ $recipe->id }})'
                    class="px-6 py-3 bg-secondary hover:bg-secondary-hover text-text-dark-primary text-base font-semibold rounded-full shadow-lg">
                    @if ($recipe->isBookmarkedBy(auth()->user()))
                        <i class="fa-solid fa-bookmark pe-1 text-base"></i>
                        Hapus dari Favorit
                    @else
                        <i class="fa-regular fa-bookmark pe-1 text-base"></i>
                        Tambah ke Favorit
                    @endif
                </button>
                <button
                    class="px-6 py-3 bg-primary hover:bg-primary-hover text-text-dark-primary text-base font-semibold rounded-full shadow-lg">
                    <i class="fa-solid fa-utensils pe-1 text-base"></i>
                    Tambah Ke Riwayat Masak
                </button>
            </div>
            {{-- end button --}}
            {{-- recipe ingredients & steps --}}
            <div class="mt-12 flex space-x-4">
                <div class="w-[40%]">
                    <h2 class="text-2xl font-display font-medium text-text-primary">
                        Bahan Masakan
                    </h2>
                    <ul class="mt-3 w-[80%] text-lg text-text-primary space-y-3 font-normal">
                        @foreach ($recipe->ingredients as $ingredient)
                            <li class="pb-2 border-b border-gray-200"><i
                                    class="fa-solid fa-circle-check pe-2 text-sm"></i>
                                {{ $ingredient->pivot->amount . ' ' . $ingredient->pivot->unit . ' ' . $ingredient->name }}
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="w-[60%]">
                    <h2 class="text-2xl font-display font-medium text-text-primary">
                        Langkah Pembuatan
                    </h2>
                    <ul class="mt-3 text-lg text-text-primary space-y-4 font-normal">
                        @foreach ($recipe->steps as $step)
                            <li class="pb-3 flex space-x-2 border-b border-gray-200">
                                <p class="text-base font-normal pt-1 flex items-start">
                                    <span class="text-5xl font-display font pe-3">{{ $step->step_number }}</span>
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
                <form wire:submit.prevent='submitRating'>
                    <div class="mt-8 flex space-x-4">
                        <i class="fa fa-circle-user text-4xl text-gray-500"></i>
                        <div class="w-full space-y-1">
                            <textarea wire:model='comment'
                                class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-bg-dark-primary dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark dark:shadow-xs-light font-normal"
                                rows="3" placeholder="Masukkan penilaian anda tentang resep ini"></textarea>
                            @error('comment')
                                <p class="text-xs text-red-500 font-medium">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                    <div class="mt-3 flex justify-between items-center space-x-3">
                        <div class="flex space-x-3">
                            <div>
                                <h3 class="text-base font-medium text-text-primary">
                                    Berikan Penilaian Anda :
                                </h3>
                                @error('rating')
                                    <p class="text-xs text-red-500 font-medium">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <div x-data="{ rating: 0, hoverRating: 0 }" class="flex space-x-1 items-center text-secondary text-3xl"
                                x-on:rating-submitted.window="rating = 0; hoverRating = 0">
                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="fa-star cursor-pointer transition-all duration-150"
                                        :class="{
                                            'fa-solid': rating >= {{ $i }} || hoverRating >=
                                                {{ $i }},
                                            'fa-regular': rating < {{ $i }} && hoverRating <
                                                {{ $i }}
                                        }"
                                        @click="rating = {{ $i }}; $wire.rating = {{ $i }}"
                                        @mouseenter="hoverRating = {{ $i }}"
                                        @mouseleave="hoverRating = 0">
                                    </i>
                                @endfor
                            </div>
                        </div>
                        <button type="submit"
                            class="px-8 py-2.5 bg-secondary hover:bg-secondary-hover rounded-lg shadow-md text-text-dark-primary text-base">
                            Simpan
                        </button>
                    </div>
                </form>
                <div class="mt-3 flex justify-end items-center border-b border-gray-300 py-2 space-x-2">
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
                <div class="mt-3">

                    @foreach ($ratings as $item)
                        <div class="flex space-x-2 w-full border-b border-gray-300 py-3">
                            @if ($item->user->avatar)
                                <img class="h-9 w-9 rounded-full object-cover"
                                    src="{{ asset($item->user->avatar_url) }}" alt="{{ $item->user->name }}">
                            @else
                                <i class="fa fa-circle-user text-4xl text-gray-500"></i>
                            @endif
                            <div class="w-full">
                                <div class="flex justify-between w-full">
                                    <div class="text-base font-semibold text-text-primary">
                                        <p>{{ $item->user->name }}
                                            <span class="text-sm font-normal text-gray-500 ml-1">
                                                {{ $item->created_at->diffForHumans() }}
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
                                    @if ($item->isLikedBy(auth()->user()))
                                        <i wire:click='toggleLike({{ $item->id }})'
                                            class="fa-solid fa-thumbs-up text-base text-secondary cursor-pointer"></i>
                                    @else
                                        <i wire:click='toggleLike({{ $item->id }})'
                                            class="fa-regular fa-thumbs-up text-base text-secondary cursor-pointer"></i>
                                    @endif
                                    <p class="text-sm font-semibold text-gray-700">
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
