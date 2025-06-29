<div x-data="{ sidebarOpen: false, isMobile: window.innerWidth < 768 }" x-init="window.addEventListener('resize', () => { isMobile = window.innerWidth < 768; if (!isMobile) sidebarOpen = false; })" x-show="pageLoaded"
    x-transition:enter="transform transition-all duration-700 ease-out"
    x-transition:enter-start="opacity-0 -translate-x-full" x-transition:enter-end="opacity-100 translate-x-0"
    class="w-full relative">

    <!-- Mobile Header dengan Toggle Button -->
    <div class="lg:hidden mb-4 flex items-center justify-between bg-white rounded-lg shadow-lg p-3 sm:p-4">
        <h1 class="text-base sm:text-lg font-semibold text-gray-800">Pilih Bahan Makanan</h1>
        <button @click="sidebarOpen = !sidebarOpen"
            class="p-2 rounded-lg bg-secondary text-white hover:bg-secondary-hover transition-colors">
            <i class="fa-solid fa-bars" x-show="!sidebarOpen"></i>
            <i class="fa-solid fa-xmark" x-show="sidebarOpen"></i>
        </button>
    </div>

    <!-- Floating Action Button untuk Selected Ingredients (Mobile) -->
    <div class="lg:hidden fixed top-20 sm:top-22 right-4 sm:right-6 z-40"
        x-show="$wire.selectedIngredients && $wire.selectedIngredients.length > 0">
        <button @click="sidebarOpen = true"
            class="w-12 h-12 sm:w-14 sm:h-14 bg-secondary hover:bg-secondary-hover text-white rounded-full shadow-lg flex items-center justify-center transition-all duration-200 hover:scale-110">
            <div class="relative">
                <i class="fa-solid fa-shopping-basket text-base sm:text-lg"></i>
                <span
                    class="absolute -top-1.5 sm:-top-2 -right-1.5 sm:-right-2 bg-red-500 text-white text-xs rounded-full w-4 h-4 sm:w-5 sm:h-5 flex items-center justify-center text-[10px] sm:text-xs"
                    x-text="$wire.selectedIngredients ? $wire.selectedIngredients.length : 0"></span>
            </div>
        </button>
    </div>

    <!-- Main Layout -->
    <div class="flex relative">
        <!-- Main Content Area -->
        <div class="w-full lg:w-3/4 lg:pr-4">
            <!-- Search & Camera Section -->
            <div class="bg-white rounded-lg shadow-lg mb-4 lg:mb-0 min-h-[20rem] sm:min-h-[22rem] lg:h-80">
                <div class="p-3 sm:p-5">
                    <div
                        class="flex flex-col sm:flex-row space-y-3 sm:space-y-0 sm:space-x-3 items-stretch sm:items-center">
                        <!-- Search Input -->
                        <div class="flex-1 min-w-0">
                            <div class="relative">
                                <input wire:model.live.debounce.300ms='search'
                                    class="w-full bg-bg-primary dark:bg-bg-dark-primary placeholder:text-slate-400 text-text-primary dark:text-text-dark-primary text-sm border border-gray-200 dark:border-[#393939] rounded-md pl-3 pr-16 sm:pr-20 lg:pr-28 py-2.5 sm:py-3 transition duration-300 ease focus:outline-none focus:border-secondary-light dark:focus:border-secondary-light hover:border-gray-300 shadow-sm focus:shadow"
                                    placeholder="Cari bahan masakan ..." />
                                <button
                                    class="absolute top-0.5 sm:top-1 right-0.5 sm:right-1 flex items-center space-x-1 rounded bg-secondary/80 py-1.5 sm:py-2 px-2 sm:px-4 border border-transparent text-center text-xs sm:text-sm text-text-dark-primary transition-all shadow-sm disabled:pointer-events-none font-normal"
                                    type="button" disabled>
                                    <i class="fa-solid fa-magnifying-glass text-xs sm:text-sm"></i>
                                    <span class="hidden sm:inline">Cari</span>
                                </button>
                            </div>
                        </div>

                        <!-- Camera Button -->
                        <div class="w-full sm:w-auto">
                            <button type="button" wire:click="$set('isImageRecognitionOpen', true)"
                                class="w-full sm:w-auto px-3 sm:px-4 py-2.5 sm:py-3 bg-secondary hover:bg-secondary-hover text-text-dark-primary font-medium rounded-lg shadow-md transition-all duration-200 ease-in-out transform hover:scale-[1.02] active:scale-[0.98] text-xs sm:text-sm whitespace-nowrap">
                                <i class="fa-solid fa-camera mr-1 sm:mr-2"></i>
                                <span class="sm:hidden">Deteksi dengan Kamera</span>
                                <span class="hidden sm:inline lg:hidden">Deteksi Bahan</span>
                                <span class="hidden lg:inline">Deteksi Bahan Makanan dengan Kamera Anda</span>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="border border-t-gray-100"></div>

                <!-- Loading State -->
                <div wire:loading class="w-full flex justify-center py-6 sm:py-8">
                    <div class="flex text-xs sm:text-sm justify-center items-center gap-2 text-gray-600">
                        <i class="fa-solid fa-spinner fa-spin"></i>
                        Dalam proses ...
                    </div>
                </div>

                <!-- Ingredients List -->
                <div wire:loading.remove
                    class="p-3 sm:p-5 max-h-[16rem] sm:max-h-[18rem] lg:max-h-[15.2rem] overflow-y-auto">
                    <h2 class="text-sm sm:text-base mb-3">
                        Pilih Bahan Makanan :
                    </h2>
                    <div class="space-y-3 sm:space-y-4">
                        @foreach ($ingredients as $category => $items)
                            <div>
                                <h3
                                    class="text-xs sm:text-sm font-semibold text-neutral-700 mb-2 sm:mb-3 capitalize flex items-center">
                                    <i class="fa-solid fa-tag mr-1 sm:mr-2 text-secondary text-xs sm:text-sm"></i>
                                    {{ $category }}
                                </h3>
                                <div
                                    class="grid grid-cols-1 xs:grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-2 sm:gap-3">
                                    @foreach ($items as $ingredient)
                                        <div wire:click="selectIngredient('{{ json_encode(['id' => $ingredient->id, 'name' => $ingredient->name, 'image' => $ingredient->image]) }}')"
                                            class="h-12 sm:h-[3.5rem] p-1 sm:p-1.5 hover:border-2 group bg-gray-100 hover:border-secondary text-text-primary hover:text-secondary rounded-lg flex items-center space-x-1 sm:space-x-2 shadow-md cursor-pointer transition-all duration-200 hover:shadow-lg">

                                            @if ($ingredient->image)
                                                <div class="w-10 sm:w-12 h-full flex-shrink-0">
                                                    <img class="w-10 sm:w-12 h-full object-cover rounded-md shadow-md"
                                                        src="{{ asset($ingredient->image) }}"
                                                        alt="{{ $ingredient->name }}">
                                                </div>
                                            @else
                                                <div
                                                    class="w-10 sm:w-12 h-full flex-shrink-0 flex justify-center items-center bg-gray-200 rounded-md shadow-md">
                                                    <i
                                                        class="fa-solid fa-bowl-food text-sm sm:text-base text-gray-400 group-hover:text-secondary"></i>
                                                </div>
                                            @endif

                                            <h3 class="text-xs sm:text-sm font-medium truncate flex-1">
                                                {{ $ingredient->name }}
                                            </h3>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Desktop Sidebar -->
        <div class="hidden lg:block w-1/4 pl-4">
            <div class="bg-white rounded-lg shadow-lg h-[22rem] p-4 sticky top-4">
                <div class="flex space-x-2 items-center mb-4">
                    <p class="flex-1 text-base font-medium">Bahan Masakan Terpilih :</p>
                    @if ($selectedIngredients)
                        <button wire:click='resetIngredients'
                            class="px-2 py-1.5 bg-rose-500 hover:bg-rose-600 text-white text-xs rounded-full transition-colors">
                            <i class="fa fa-circle-xmark text-xs mr-1"></i>
                            Clear
                        </button>
                    @endif
                </div>

                <div class="max-h-64 overflow-y-auto">
                    @if (empty($selectedIngredients))
                        <div class="text-center py-8 text-gray-500">
                            <i class="fa-solid fa-basket-shopping text-3xl mb-3 text-gray-300"></i>
                            <p class="text-sm">Belum ada bahan yang dipilih</p>
                        </div>
                    @else
                        <div class="grid grid-cols-1 gap-2">
                            @foreach ($selectedIngredients as $ingredient)
                                <div
                                    class="px-3 py-2 flex items-center rounded-lg bg-primary text-gray-50 group hover:bg-primary-hover transition-colors">
                                    <span class="flex-1 text-sm font-medium">{{ $ingredient['name'] }}</span>
                                    <i wire:click="removeIngredient({{ $ingredient['id'] }})"
                                        class="fa fa-solid fa-circle-xmark text-sm hover:text-gray-200 cursor-pointer ml-2 opacity-70 group-hover:opacity-100 transition-opacity"></i>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Mobile Sidebar Overlay -->
        <div class="lg:hidden fixed inset-0 z-50" x-show="sidebarOpen" style="display: none;">
            <!-- Backdrop -->
            <div class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm" @click="sidebarOpen = false"
                x-transition:enter="transition-opacity ease-out duration-300" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-in duration-200"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"></div>

            <!-- Sidebar -->
            <div class="fixed right-0 top-0 h-full w-72 sm:w-80 max-w-[85vw] bg-white shadow-2xl"
                x-transition:enter="transform transition ease-out duration-300"
                x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
                x-transition:leave="transform transition ease-in duration-200" x-transition:leave-start="translate-x-0"
                x-transition:leave-end="translate-x-full">

                <!-- Sidebar Header -->
                <div
                    class="flex items-center justify-between p-3 sm:p-4 border-b border-gray-200 bg-gradient-to-r from-secondary to-secondary-hover">
                    <h2 class="text-base sm:text-lg font-semibold text-white">Bahan Terpilih</h2>
                    <button @click="sidebarOpen = false" class="px-2 py-1 rounded-full text-white transition-colors">
                        <i class="fa-solid fa-xmark text-sm sm:text-base"></i>
                    </button>
                </div>

                <!-- Sidebar Content -->
                <div class="p-3 sm:p-4 h-full overflow-y-auto pb-16 sm:pb-20">
                    @if (empty($selectedIngredients))
                        <div class="text-center py-8 sm:py-12 text-gray-500">
                            <i class="fa-solid fa-basket-shopping text-3xl sm:text-4xl mb-3 sm:mb-4 text-gray-300"></i>
                            <p class="text-sm sm:text-base mb-1 sm:mb-2">Belum ada bahan yang dipilih</p>
                            <p class="text-xs sm:text-sm text-gray-400">Pilih bahan makanan dari daftar untuk memulai
                            </p>
                        </div>
                    @else
                        <div class="space-y-2 sm:space-y-3">
                            @foreach ($selectedIngredients as $ingredient)
                                <div
                                    class="px-3 py-1.5 flex justify-between items-center -space-y-1 rounded-lg bg-gray-50 border border-gray-200 group hover:bg-gray-100 transition-colors">
                                    <span
                                        class="text-xs sm:text-sm font-medium text-gray-800">{{ $ingredient['name'] }}</span>
                                    <button wire:click="removeIngredient({{ $ingredient['id'] }})"
                                        class="text-red-600 hover:text-red-800 transition-colors">
                                        <i class="fa fa-solid fa-circle-xmark text-xs"></i>
                                    </button>
                                </div>
                            @endforeach
                        </div>

                        <!-- Clear All Button -->
                        <div class="mt-4 sm:mt-6 pt-3 sm:pt-4 border-t border-gray-200">
                            <button wire:click='resetIngredients'
                                class="w-full px-3 sm:px-4 py-2.5 sm:py-3 bg-rose-500 hover:bg-rose-600 text-white font-medium rounded-lg transition-colors text-sm">
                                <i class="fa fa-circle-xmark mr-1 sm:mr-2"></i>
                                Hapus Semua Bahan
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Image Recognition -->
    <div x-show="$wire.isImageRecognitionOpen" @keydown.escape.window="$wire.isImageRecognitionOpen = false"
        class="fixed inset-0 z-50 overflow-y-auto" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0" style="display: none;">
        <div class="flex items-center justify-center min-h-screen px-3 sm:px-4 pt-4 pb-20 text-center sm:p-0">
            <div class="fixed inset-0 transition-opacity bg-black bg-opacity-60 backdrop-blur-sm" aria-hidden="true">
            </div>
            <div class="relative inline-block overflow-hidden text-left align-bottom transition-all transform bg-white/95 backdrop-blur-md rounded-xl shadow-2xl border border-gray-100 sm:my-8 sm:align-middle sm:max-w-lg sm:w-full mx-3 sm:mx-0"
                @click.away="$wire.isImageRecognitionOpen = false"
                x-transition:enter="transform ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="transform ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">

                <div class="absolute top-0 right-0 pt-3 sm:pt-4 pr-3 sm:pr-4">
                    <button type="button" @click="$wire.isImageRecognitionOpen = false"
                        class="text-gray-400 hover:text-gray-500 focus:outline-none">
                        <i class="fa-solid fa-xmark text-base sm:text-lg"></i>
                    </button>
                </div>

                <form wire:submit.prevent='recognizeImage' class="flex flex-col p-4 sm:p-8">
                    <div class="mb-4 sm:mb-6 text-center">
                        <div
                            class="inline-flex items-center justify-center w-12 h-12 sm:w-16 sm:h-16 rounded-full bg-secondary/20 mb-3 sm:mb-4">
                            <i class="fa-solid fa-camera text-xl sm:text-2xl text-secondary"></i>
                        </div>
                        <h2 class="text-lg sm:text-xl font-bold text-gray-900 mb-2">Analisa Gambar Bahan Makanan</h2>
                        <p class="text-xs sm:text-sm text-gray-600 leading-relaxed px-2 sm:px-0">
                            Upload gambar bahan makanan yang tersedia di rumah Anda. Pastikan gambar
                            jelas dan detail untuk hasil deteksi yang lebih akurat.
                        </p>
                    </div>

                    <div class="flex flex-col items-center space-y-3 sm:space-y-4 mb-6 sm:mb-8">
                        @if ($image)
                            <div class="relative group">
                                <div wire:loading wire:target="image"
                                    class="absolute inset-0 flex items-center justify-center z-10 bg-white/80 rounded-xl">
                                    <div class="flex items-center space-x-2">
                                        <i class="fa-solid fa-spinner fa-spin text-secondary"></i>
                                        <span class="text-xs sm:text-sm text-gray-600">Memuat gambar...</span>
                                    </div>
                                </div>
                                <img class="w-48 h-36 sm:w-64 sm:h-48 rounded-xl shadow-lg object-cover transition-transform group-hover:scale-[1.02]"
                                    src="{{ $image->temporaryUrl() }}" alt="Preview">
                                <div
                                    class="absolute inset-0 bg-black/40 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                    <i class="fa-solid fa-eye text-white text-lg sm:text-xl"></i>
                                </div>
                            </div>
                        @else
                            <div
                                class="w-48 h-36 sm:w-64 sm:h-48 bg-gray-50 border-2 border-dashed border-gray-300 rounded-xl flex flex-col justify-center items-center transition-colors hover:bg-gray-100">
                                <div wire:loading wire:target="image" class="flex items-center space-x-2">
                                    <i class="fa-solid fa-spinner fa-spin text-gray-400"></i>
                                    <span class="text-xs sm:text-sm text-gray-500">Memuat gambar...</span>
                                </div>
                                <div wire:loading.remove wire:target="image" class="text-center">
                                    <i class="fa-regular fa-image text-2xl sm:text-3xl text-gray-400 mb-2"></i>
                                    <p class="text-xs sm:text-sm text-gray-500">Pilih gambar bahan makanan</p>
                                </div>
                            </div>
                        @endif

                        <div class="w-full">
                            <input type="file" wire:model='image'
                                class="w-full block text-xs sm:text-sm text-gray-600 file:mr-3 sm:file:mr-4 file:py-2 sm:file:py-3 file:px-3 sm:file:px-4 file:rounded-full file:border-0 file:text-xs sm:file:text-sm file:font-semibold file:bg-secondary/10 file:text-secondary hover:file:bg-secondary/20 transition-all cursor-pointer">
                            @error('image')
                                <p class="mt-2 text-xs text-red-500 flex items-center">
                                    <i class="fa-solid fa-circle-exclamation mr-1"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-3 sm:space-y-0">
                        <div class="flex items-center justify-center sm:justify-start space-x-2">
                            <i class="fa-solid fa-coins text-yellow-500"></i>
                            <h3 class="text-xs sm:text-sm font-semibold text-gray-700">
                                Credits: <span class="text-secondary">3</span>
                            </h3>
                        </div>
                        <div class="flex justify-center sm:justify-end space-x-2 sm:space-x-3">
                            <button type="button" wire:click="$set('isImageRecognitionOpen', false)"
                                class="px-4 sm:px-5 py-2 sm:py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-full transition-all duration-200 ease-in-out text-xs sm:text-sm">
                                Batal
                            </button>
                            <button type="submit" wire:loading.attr="disabled" wire:target='recognizeImage'
                                class="px-4 sm:px-5 py-2 sm:py-2.5 flex justify-center items-center bg-secondary hover:bg-secondary-dark text-white font-medium rounded-full shadow-md transition-all duration-200 ease-in-out hover:shadow-lg disabled:opacity-70 disabled:cursor-not-allowed text-xs sm:text-sm">
                                <div wire:loading.remove wire:target='recognizeImage'>
                                    <i class="fa-solid fa-wand-magic-sparkles mr-1 sm:mr-2"></i>
                                    Analisa
                                </div>
                                <div wire:loading wire:target='recognizeImage'>
                                    <div class="flex items-center space-x-2">
                                        <i class="fa-solid fa-spinner fa-spin text-white"></i>
                                        <span class="text-xs sm:text-sm text-white">Memuat...</span>
                                    </div>
                                </div>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
