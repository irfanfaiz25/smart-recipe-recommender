<div x-show="pageLoaded" x-transition:enter="transform transition-all duration-700 ease-out"
    x-transition:enter-start="opacity-0 -translate-x-full" x-transition:enter-end="opacity-100 translate-x-0"
    class="w-full">
    <div class="mt-3 w-full bg-white rounded-lg shadow-lg h-fit recipe-container">
        <div class="relative w-full rounded-t-lg" x-data="{ showImageModal: false }">
            @if ($recipe->image)
                <img class="w-full h-[20rem] sm:h-[25rem] lg:h-[30rem] rounded-t-lg object-cover cursor-pointer hover:opacity-90 transition-opacity duration-200"
                    src="{{ $recipe->image }}" alt="{{ $recipe->name }}" @click="showImageModal = true">
            @else
                <div
                    class="w-full h-[20rem] sm:h-[25rem] lg:h-[30rem] rounded-t-lg bg-gray-200 flex justify-center items-center">
                    <div class="flex flex-col items-center space-y-3">
                        <i class="fa-solid fa-utensils text-2xl sm:text-3xl lg:text-4xl text-gray-500"></i>
                        <p class="font-normal italic text-gray-500 text-sm sm:text-base px-4 text-center">
                            {{ $recipe->name }}
                        </p>
                    </div>
                </div>
            @endif
            <button onclick="history.back()"
                class="px-3 py-2 sm:px-4 sm:py-2.5 lg:px-6 lg:py-3 absolute top-3 left-3 bg-black/40 hover:bg-black/60 text-text-dark-primary text-sm sm:text-base font-semibold rounded-lg shadow-lg">
                <i class="fa-solid fa-chevron-left pe-1 text-xs sm:text-sm"></i>
                <span class="hidden sm:inline">Kembali</span>
            </button>

            @if ($recipe->image)
                <!-- Zoom Icon Indicator -->
                <div class="absolute bottom-3 right-3 bg-black/40 hover:bg-black/60 text-white px-3 py-3 flex justify-center items-center rounded-full cursor-pointer transition-colors duration-200"
                    @click="showImageModal = true">
                    <i class="fas fa-search-plus text-sm"></i>
                </div>
            @endif

            <!-- Image Modal -->
            @if ($recipe->image)
                <div x-show="showImageModal" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                    x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 backdrop-blur-sm"
                    @click="showImageModal = false" @keydown.escape.window="showImageModal = false"
                    style="display: none;">

                    <!-- Modal Content -->
                    <div class="relative max-w-7xl max-h-[90vh] mx-4" @click.stop>

                        <!-- Close Button -->
                        <button @click="showImageModal = false"
                            class="absolute -top-12 right-0 text-white hover:text-gray-300 transition-colors duration-200 z-10">
                            <i class="fas fa-times text-2xl"></i>
                        </button>

                        <!-- Image -->
                        <img src="{{ $recipe->image }}" alt="{{ $recipe->name }}"
                            class="max-w-full max-h-[90vh] object-contain rounded-lg shadow-2xl"
                            x-transition:enter="transition ease-out duration-300 transform"
                            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-200 transform"
                            x-transition:leave-start="opacity-100 scale-100"
                            x-transition:leave-end="opacity-0 scale-95">

                        <!-- Image Info -->
                        <div
                            class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-6 rounded-b-lg">
                            <h3 class="text-white text-xl font-semibold mb-2">{{ $recipe->name }}</h3>
                            <p class="text-gray-200 text-sm">
                                <i class="fas fa-user mr-1"></i>
                                Oleh {{ $recipe->user->name }}
                            </p>
                            @if ($recipe->category)
                                <span
                                    class="inline-block mt-2 px-3 py-1 bg-primary text-white text-xs font-medium rounded-full">
                                    {{ $recipe->category->name }}
                                </span>
                            @endif
                        </div>

                        <!-- Download Button -->
                        <div class="absolute top-4 right-4">
                            <a href="{{ $recipe->image }}" download="{{ Str::slug($recipe->name) }}-recipe.jpg"
                                class="bg-white/20 hover:bg-white/30 text-white p-3 rounded-lg backdrop-blur-sm transition-colors duration-200"
                                title="Download Gambar">
                                <i class="fas fa-download"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <div class="py-4 px-4 sm:py-6 sm:px-8 lg:py-8 lg:px-32">
            {{-- head details --}}
            {{-- user avatar --}}
            <div class="flex justify-center items-center mb-2">
                @if ($recipe->user->avatar)
                    <img class="w-10 h-10 sm:w-12 sm:h-12 rounded-full object-cover" src="{{ $recipe->user->avatar }}"
                        alt="{{ $recipe->user->name }}">
                @else
                    <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-gray-200 flex justify-center items-center">
                        <i class="fa-solid fa-user text-xl sm:text-2xl text-gray-500"></i>
                    </div>
                @endif
            </div>
            <h3 class="text-base sm:text-lg font-medium text-text-primary text-center uppercase mb-1">
                recipe by {{ $recipe->user->name }}
            </h3>
            <div class="flex justify-center items-center space-x-2 text-xs sm:text-sm mb-4">
                <i class="fa fa-location-dot text-text-primary"></i>
                <p class="text-gray-600 capitalize">{{ $recipe->user->creators->city }}</p>
            </div>
            <h1 class="mt-2 text-3xl sm:text-4xl lg:text-6xl font-bold font-display text-center px-4 capitalize">
                {{ $recipe->name }}
            </h1>
            <div
                class="mt-6 sm:mt-8 flex space-x-1 justify-center items-center text-secondary text-lg sm:text-xl lg:text-2xl">
                @for ($i = 1; $i <= 5; $i++)
                    <i class="fa-{{ $i <= (int) $averageRating ? 'solid' : 'regular' }} fa-star"></i>
                @endfor
                <p class="text-text-primary font-semibold text-lg sm:text-xl lg:text-2xl">
                    /{{ $averageRating }}
                </p>
            </div>
            <div class="mt-6 sm:mt-8 flex items-center justify-center px-4">
                <div class="w-full sm:w-[85%] lg:w-[60%] h-auto">
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-2 sm:gap-0">
                        <div
                            class="border border-gray-200 sm:border-t sm:border-b sm:border-l-0 sm:border-r-0 flex justify-center items-center p-3 sm:p-4 text-sm sm:text-base lg:text-lg rounded-lg sm:rounded-none">
                            <div class="text-center">
                                <i class="fa-solid fa-sliders text-yellow-500 mb-1 sm:mb-0"></i>
                                <p class="font-medium capitalize text-xs sm:text-sm lg:text-base">
                                    {{ $recipe->difficulty }}</p>
                            </div>
                        </div>
                        <div
                            class="border border-gray-200 flex justify-center items-center p-3 sm:p-4 text-sm sm:text-base lg:text-lg rounded-lg sm:rounded-none">
                            <div class="text-center">
                                <i class="fa-regular fa-clock text-primary mb-1 sm:mb-0"></i>
                                <p class="font-medium text-xs sm:text-sm lg:text-base">{{ $recipe->cooking_time }} min
                                </p>
                            </div>
                        </div>
                        <div
                            class="border border-gray-200 flex justify-center items-center p-3 sm:p-4 text-sm sm:text-base lg:text-lg rounded-lg sm:rounded-none col-span-2 sm:col-span-1">
                            <div class="text-center py-2">
                                <i class="fa-solid fa-fire-flame-curved text-orange-500 text-lg sm:text-xl mb-2"></i>
                                @if ($recipe->calories)
                                    <div class="flex justify-center">
                                        <div class="px-1.5 flex flex-col border-r border-gray-200">
                                            <span
                                                class="font-bold text-sm sm:text-base lg:text-lg text-primary">{{ $recipe->calories }}</span>
                                            <span class="text-xs text-gray-600 font-medium">Total Kkal</span>
                                        </div>
                                        <div class="px-1.5 flex flex-col">
                                            <span
                                                class="font-bold text-sm sm:text-base lg:text-lg text-primary">{{ floor($recipe->calories / $recipe->servings) }}</span>
                                            <span class="text-xs text-gray-600 font-medium">Kkal/Porsi</span>
                                        </div>
                                    </div>
                                @else
                                    <span class="text-xs sm:text-sm text-gray-400 font-medium">Tidak ada info
                                        kalori</span>
                                @endif
                            </div>
                        </div>
                        <div
                            class="border border-gray-200 sm:border-t sm:border-b sm:border-l-0 sm:border-r-0 flex justify-center items-center p-3 sm:p-4 text-sm sm:text-base lg:text-lg rounded-lg sm:rounded-none sm:col-start-4">
                            <div class="text-center">
                                <i class="fa-solid fa-bowl-food text-secondary mb-1 sm:mb-0"></i>
                                <p class="font-medium text-xs sm:text-sm lg:text-base">{{ $recipe->servings }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-4 sm:mt-6 flex justify-center items-center px-4">
                <p
                    class="w-full sm:w-3/4 lg:w-1/2 text-sm sm:text-base text-center font-medium text-text-primary italic">
                    {{ $recipe->description }}
                </p>
            </div>
            {{-- end head details --}}
            {{-- button --}}
            <div
                class="hide-on-export mt-6 sm:mt-8 lg:mt-10 flex flex-col sm:flex-row justify-center items-center space-y-3 sm:space-y-0 sm:space-x-3 px-4">
                <button wire:click='toggleBookmark({{ $recipe->id }})'
                    class="w-full sm:w-auto px-4 py-2.5 sm:px-6 sm:py-3 bg-secondary hover:bg-secondary-hover text-text-dark-primary text-sm sm:text-base font-semibold rounded-full shadow-lg">
                    @if ($recipe->isBookmarkedBy(auth()->user()))
                        <i class="fa-solid fa-bookmark pe-1 text-sm sm:text-base"></i>
                        <span class="text-xs sm:text-base">Hapus dari Favorit</span>
                    @else
                        <i class="fa-regular fa-bookmark pe-1 text-sm sm:text-base"></i>
                        <span class="text-xs sm:text-base">Tambah ke Favorit</span>
                    @endif
                </button>

                <button wire:click="addToCookingHistory"
                    class="w-full sm:w-auto px-4 py-2.5 sm:px-6 sm:py-3 bg-primary hover:bg-primary-hover text-text-dark-primary text-sm sm:text-base font-semibold rounded-full shadow-lg transition-colors duration-200"
                    wire:loading.attr="disabled" wire:target="addToCookingHistory">
                    <span wire:loading.remove wire:target="addToCookingHistory">
                        <i class="fa-solid fa-book-bookmark pe-1 text-sm sm:text-base"></i>
                        <span class="text-xs sm:text-base">Simpan ke Riwayat</span>
                    </span>
                    <span wire:loading wire:target="addToCookingHistory">
                        <i class="fas fa-spinner fa-spin pe-1 text-sm sm:text-base"></i>
                        <span class="text-xs sm:text-base">Menyimpan...</span>
                    </span>
                </button>
            </div>

            {{-- Export Buttons Section --}}
            <div
                class="export-buttons mt-4 flex flex-col sm:flex-row justify-center items-center space-y-2 sm:space-y-0 sm:space-x-2 px-4">

                <button
                    onclick="RecipeExporter.exportAsImage({{ $recipe->id }}, '{{ addslashes($recipe->name) }}')"
                    class="w-full sm:w-auto px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-full shadow-lg transition-colors duration-200">
                    <i class="fa-solid fa-image pe-1"></i>
                    <span class="text-xs sm:text-sm">Export Gambar</span>
                </button>

                <button onclick="RecipeExporter.copyRecipeLink()"
                    class="w-full sm:w-auto px-4 py-2.5 bg-gray-600 hover:bg-gray-700 text-white text-sm font-semibold rounded-full shadow-lg transition-colors duration-200">
                    <i class="fa-solid fa-link pe-1"></i>
                    <span class="text-xs sm:text-sm">Copy Link</span>
                </button>
            </div>
            {{-- end button --}}
            {{-- recipe ingredients & steps --}}
            <div class="mt-8 sm:mt-10 lg:mt-12 flex flex-col lg:flex-row lg:space-x-4 space-y-6 lg:space-y-0">
                <div class="w-full lg:w-[40%]">
                    <h2 class="text-xl sm:text-2xl font-display font-medium text-text-primary">
                        Bahan Masakan
                    </h2>
                    <ul class="mt-3 w-full lg:w-[80%] text-base sm:text-lg text-text-primary space-y-3 font-normal">
                        @foreach ($recipe->ingredients as $ingredient)
                            <li class="pb-2 border-b border-gray-200">
                                @if ($ingredient->pivot->is_primary)
                                    <i class="fa-solid fa-star pe-2 text-sm text-yellow-500"></i>
                                @else
                                    <i class="fa-solid fa-circle-check pe-2 text-sm"></i>
                                @endif
                                {{ $ingredient->pivot->amount . ' ' . $ingredient->pivot->unit . ' ' . $ingredient->name }}
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="w-full lg:w-[60%]">
                    <h2 class="text-xl sm:text-2xl font-display font-medium text-text-primary">
                        Langkah Pembuatan
                    </h2>
                    <ul class="mt-3 text-base sm:text-lg text-text-primary space-y-4 font-normal">
                        @foreach ($recipe->steps as $step)
                            <li class="pb-3 flex space-x-2 border-b border-gray-200">
                                <p class="text-sm sm:text-base font-normal pt-1 flex items-start">
                                    <span
                                        class="text-3xl sm:text-4xl lg:text-5xl font-display font pe-2 sm:pe-3 flex-shrink-0">{{ $step->step_number }}</span>
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
            <div class="comment-section mt-5">
                <h2 class="text-xl sm:text-2xl font-display font-semibold">
                    {{ $recipe->ratings->count() }} Reviews
                </h2>
                <div class="mt-1 flex space-x-1 items-center text-secondary text-lg sm:text-xl">
                    @for ($i = 1; $i <= 5; $i++)
                        <i class="fa-{{ $i <= (int) $averageRating ? 'solid' : 'regular' }} fa-star"></i>
                    @endfor
                    <p class="text-text-primary font-semibold text-base sm:text-lg">
                        /{{ $averageRating }}
                    </p>
                </div>
                <form wire:submit.prevent='submitRating'>
                    <div class="mt-6 sm:mt-8 flex flex-col sm:flex-row sm:space-x-4 space-y-3 sm:space-y-0">
                        @if (auth()->user()->avatar)
                            <img class="w-8 h-8 sm:w-10 sm:h-10 rounded-full object-cover self-start sm:self-auto"
                                src="{{ auth()->user()->avatar }}" alt="{{ auth()->user()->name }}">
                        @else
                            <i
                                class="fa fa-circle-user text-3xl sm:text-4xl text-gray-500 self-start sm:self-auto"></i>
                        @endif
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
                    <div
                        class="mt-3 flex flex-col sm:flex-row sm:justify-between sm:items-center space-y-3 sm:space-y-0 sm:space-x-3">
                        <div class="flex flex-col sm:flex-row sm:space-x-3 space-y-2 sm:space-y-0">
                            <div>
                                <h3 class="text-sm sm:text-base font-medium text-text-primary">
                                    Berikan Penilaian Anda :
                                </h3>
                                @error('rating')
                                    <p class="text-xs text-red-500 font-medium">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <div x-data="{ rating: 0, hoverRating: 0 }"
                                class="flex space-x-1 items-center text-secondary text-2xl sm:text-3xl"
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
                        <button type="submit" wire:loading.class="opacity-50 cursor-not-allowed"
                            wire:target='submitRating'
                            class="w-full sm:w-auto px-6 sm:px-8 py-2.5 bg-secondary hover:bg-secondary-hover rounded-lg shadow-md text-text-dark-primary text-sm sm:text-base flex items-center justify-center">
                            <i class="fas fa-spinner fa-spin me-2" wire:loading wire:target='submitRating'></i>
                            <span wire:loading.remove wire:target='submitRating'>Simpan</span>
                            <span wire:loading wire:target='submitRating'>Menyimpan</span>
                        </button>
                    </div>
                </form>
                <div
                    class="mt-3 flex flex-col sm:flex-row sm:justify-end sm:items-center border-b border-gray-300 py-2 space-y-2 sm:space-y-0 sm:space-x-2">
                    <label for="sortby" class="text-sm text-gray-700 font-semibold">
                        <i class="fa-solid fa-arrow-up-wide-short"></i>
                        Urutkan
                    </label>
                    <div class="relative">
                        <select id="sortby" wire:model.live.debounce.300ms='sortBy'
                            class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full sm:min-w-32 sm:w-auto p-2 dark:bg-bg-dark-primary dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark dark:shadow-xs-light font-normal">
                            <option value="latest">Terbaru</option>
                            <option value="higher">Tertinggi</option>
                            <option value="lower">Terendah</option>
                            <option value="likes">Disukai</option>
                        </select>
                        <i class="fas fa-spinner fa-spin absolute right-2 top-1/4 -translate-y-1/4 text-gray-500"
                            wire:loading wire:target="sortBy"></i>
                    </div>
                </div>
                <div class="mt-3">
                    @foreach ($ratings as $item)
                        <div class="flex space-x-2 w-full border-b border-gray-300 py-3">
                            @if ($item->user->avatar)
                                <img class="h-8 w-8 sm:h-9 sm:w-9 rounded-full object-cover flex-shrink-0"
                                    src="{{ $item->user->avatar }}" alt="{{ $item->user->name }}">
                            @else
                                <i class="fa fa-circle-user text-3xl sm:text-4xl text-gray-500 flex-shrink-0"></i>
                            @endif
                            <div class="w-full min-w-0">
                                <div
                                    class="flex flex-col sm:flex-row sm:justify-between w-full space-y-1 sm:space-y-0">
                                    <div class="text-sm sm:text-base font-semibold text-text-primary">
                                        <p class="truncate">{{ $item->user->name }}
                                            <span class="text-xs sm:text-sm font-normal text-gray-500 ml-1">
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
                                <p class="mt-1 text-xs sm:text-sm font-normal text-gray-700 break-words">
                                    {{ $item->comment }}
                                </p>
                                <div class="mt-2 flex space-x-2 items-center">
                                    @if ($item->isLikedBy(auth()->user()))
                                        <i wire:click='toggleLike({{ $item->id }})'
                                            class="fa-solid fa-thumbs-up text-sm sm:text-base text-secondary cursor-pointer"></i>
                                    @else
                                        <i wire:click='toggleLike({{ $item->id }})'
                                            class="fa-regular fa-thumbs-up text-sm sm:text-base text-secondary cursor-pointer"></i>
                                    @endif
                                    <p class="text-xs sm:text-sm font-semibold text-gray-700">
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

@push('scripts')
    @vite(['resources/js/recipe-export.js'])
@endpush
