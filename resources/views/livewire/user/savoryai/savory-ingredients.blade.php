<div x-show="pageLoaded" x-transition:enter="transform transition-all duration-700 ease-out"
    x-transition:enter-start="opacity-0 -translate-x-full" x-transition:enter-end="opacity-100 translate-x-0"
    class="w-full">
    <div class="flex space-x-4">
        <div class="w-[75%] rounded-lg bg-white shadow-lg h-80">
            <div class="p-5">
                <div class="flex space-x-2 items-center">
                    <div class="w-[60%] min-w-[200px]">
                        <div class="relative">
                            <input wire:model.live.debounce.300ms='search'
                                class="w-full bg-bg-primary dark:bg-bg-dark-primary placeholder:text-slate-400 text-text-primary dark:text-text-dark-primary text-sm border border-gray-200 dark:border-[#393939] rounded-md pl-3 pr-28 py-3 transition duration-300 ease focus:outline-none focus:border-secondary-light dark:focus:border-secondary-light hover:border-gray-300 shadow-sm focus:shadow"
                                placeholder="Cari bahan masakan ..." />
                            <button
                                class="absolute top-1 right-1 flex items-center space-x-1 rounded bg-secondary/80 py-2 px-4 border border-transparent text-center text-sm text-text-dark-primary transition-all shadow-smdisabled:pointer-events-none font-normal"
                                type="button" disabled>
                                <i class="fa-solid fa-magnifying-glass text-sm"></i>
                                <span>
                                    Cari
                                </span>
                            </button>
                        </div>
                    </div>
                    <div class="w-[40%]">
                        <button type="button" wire:click="$set('isImageRecognitionOpen', true)"
                            class="w-full px-4 py-3 bg-secondary hover:bg-secondary-hover text-text-dark-primary font-medium rounded-lg shadow-md transition-all duration-200 ease-in-out transform hover:scale-[1.02] active:scale-[0.98] text-sm">
                            Deteksi Bahan Makanan dengan Kamera Anda</button>

                        {{-- Analyze image form modal --}}
                        <div x-show="$wire.isImageRecognitionOpen"
                            @keydown.escape.window="$wire.isImageRecognitionOpen = false"
                            class="fixed inset-0 z-50 overflow-y-auto"
                            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
                            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
                            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                            style="display: none;">
                            <div
                                class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
                                <div class="fixed inset-0 transition-opacity bg-black bg-opacity-60 backdrop-blur-sm"
                                    aria-hidden="true"></div>
                                <div class="relative inline-block overflow-hidden text-left align-bottom transition-all transform bg-white/95 backdrop-blur-md rounded-xl shadow-2xl border border-gray-100 sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
                                    @click.away="$wire.isImageRecognitionOpen = false"
                                    x-transition:enter="transform ease-out duration-300"
                                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                                    x-transition:leave="transform ease-in duration-200"
                                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">

                                    <div class="absolute top-0 right-0 pt-4 pr-4">
                                        <button type="button" @click="$wire.isImageRecognitionOpen = false"
                                            class="text-gray-400 hover:text-gray-500 focus:outline-none">
                                            <i class="fa-solid fa-xmark text-lg"></i>
                                        </button>
                                    </div>

                                    <form wire:submit.prevent='recognizeImage' class="flex flex-col p-8">
                                        <div class="mb-6 text-center">
                                            <div
                                                class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-secondary/20 mb-4">
                                                <i class="fa-solid fa-camera text-2xl text-secondary"></i>
                                            </div>
                                            <h2 class="text-xl font-bold text-gray-900 mb-2">Analisa Gambar Bahan
                                                Makanan</h2>
                                            <p class="text-sm text-gray-600 leading-relaxed">
                                                Upload gambar bahan makanan yang tersedia di rumah Anda. Pastikan gambar
                                                jelas dan detail untuk hasil deteksi yang lebih akurat.
                                            </p>
                                        </div>

                                        <div class="flex flex-col items-center space-y-4 mb-8">
                                            @if ($image)
                                                <div class="relative group">
                                                    <div wire:loading wire:target="image"
                                                        class="absolute inset-0 flex items-center justify-center z-10 bg-white/80 rounded-xl">
                                                        <div class="flex items-center space-x-2">
                                                            <i class="fa-solid fa-spinner fa-spin text-secondary"></i>
                                                            <span class="text-sm text-gray-600">Memuat gambar...</span>
                                                        </div>
                                                    </div>
                                                    <img class="w-64 h-48 rounded-xl shadow-lg object-cover transition-transform group-hover:scale-[1.02]"
                                                        src="{{ $image->temporaryUrl() }}" alt="Preview">
                                                    <div
                                                        class="absolute inset-0 bg-black/40 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                                        <i class="fa-solid fa-eye text-white text-xl"></i>
                                                    </div>
                                                </div>
                                            @else
                                                <div
                                                    class="w-64 h-48 bg-gray-50 border-2 border-dashed border-gray-300 rounded-xl flex flex-col justify-center items-center transition-colors hover:bg-gray-100">
                                                    <div wire:loading wire:target="image"
                                                        class="flex items-center space-x-2">
                                                        <i class="fa-solid fa-spinner fa-spin text-gray-400"></i>
                                                        <span class="text-sm text-gray-500">Memuat gambar...</span>
                                                    </div>
                                                    <div wire:loading.remove wire:target="image" class="text-center">
                                                        <i class="fa-regular fa-image text-3xl text-gray-400 mb-2"></i>
                                                        <p class="text-sm text-gray-500">Pilih gambar bahan makanan</p>
                                                    </div>
                                                </div>
                                            @endif

                                            <div class="w-full">
                                                <input type="file" wire:model='image'
                                                    class="w-full block text-sm text-gray-600 file:mr-4 file:py-3 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-secondary/10 file:text-secondary hover:file:bg-secondary/20 transition-all cursor-pointer">
                                                @error('image')
                                                    <p class="mt-2 text-xs text-red-500 flex items-center">
                                                        <i class="fa-solid fa-circle-exclamation mr-1"></i>
                                                        {{ $message }}
                                                    </p>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center space-x-2">
                                                <i class="fa-solid fa-coins text-yellow-500"></i>
                                                <h3 class="text-sm font-semibold text-gray-700">
                                                    Credits: <span class="text-secondary">3</span>
                                                </h3>
                                            </div>
                                            <div class="flex justify-end space-x-3">
                                                <button type="button"
                                                    wire:click="$set('isImageRecognitionOpen', false)"
                                                    class="px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-full transition-all duration-200 ease-in-out text-sm">
                                                    Batal
                                                </button>
                                                <button type="submit" wire:loading.attr="disabled"
                                                    wire:target='recognizeImage'
                                                    class="px-5 py-2.5 flex justify-center items-center bg-secondary hover:bg-secondary-dark text-white font-medium rounded-full shadow-md transition-all duration-200 ease-in-out hover:shadow-lg disabled:opacity-70 disabled:cursor-not-allowed text-sm">
                                                    <div wire:loading.remove wire:target='recognizeImage'>
                                                        <i class="fa-solid fa-wand-magic-sparkles mr-2"></i>
                                                        Analisa
                                                    </div>
                                                    <div wire:loading wire:target='recognizeImage'>
                                                        <div class="flex items-center space-x-2">
                                                            <i class="fa-solid fa-spinner fa-spin text-white"></i>
                                                            <span class="text-sm text-white">Memuat...</span>
                                                        </div>
                                                    </div>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        {{-- end analyze image form modals --}}

                    </div>
                </div>
            </div>

            <div class="border border-t-gray-100"></div>

            {{-- loading state --}}
            <div wire:loading class="w-full flex justify-center py-8">
                <div class="flex text-sm justify-center items-center gap-2 text-gray-600">
                    <i class="fa-solid fa-spinner fa-spin"></i>
                    Dalam proses ...
                </div>
            </div>

            {{-- ingredients list --}}
            <div wire:loading.remove class="p-5 max-h-[13.2rem] overflow-y-auto">
                <h2 class="text-base">
                    Pilih Bahan Makanan :
                </h2>
                <div class="space-y-4 mt-2">
                    @foreach ($ingredients as $category => $items)
                        <div>
                            <h3 class="text-sm font-semibold text-neutral-700 mb-2 capitalize">
                                {{ $category }}
                            </h3>
                            <div class="grid grid-cols-5 gap-3">
                                @foreach ($items as $ingredient)
                                    <div wire:click="selectIngredient('{{ json_encode(['id' => $ingredient->id, 'name' => $ingredient->name, 'image' => $ingredient->image]) }}')"
                                        class="h-[3.5rem] p-1.5 hover:border-2 group bg-gray-100  hover:border-secondary text-text-primary hover:text-secondary rounded-lg flex items-center space-x-2 shadow-md cursor-pointer">

                                        @if ($ingredient->image)
                                            <div class="w-12 h-full">
                                                <img class="w-12 h-full object-cover rounded-md shadow-md"
                                                    src="{{ asset($ingredient->image) }}"
                                                    alt="{{ $ingredient->name }}">
                                            </div>
                                        @else
                                            <div
                                                class="w-12 h-full flex justify-center items-center bg-gray-200 rounded-md shadow-md">
                                                <i
                                                    class="fa-solid fa-bowl-food text-base text-gray-400 group-hover:text-secondary"></i>
                                            </div>
                                        @endif

                                        <h3 class="text-sm font-medium">
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
        <div class="w-[25%] rounded-lg bg-white shadow-lg h-80 p-4">
            <div class="flex space-x-2 items-center">
                <p class="w-[80%] text-base">Bahan Masakan Terpilih :</p>
                @if ($selectedIngredients)
                    <button wire:click='resetIngredients'
                        class="w-[20%] px-1 py-1.5 bg-rose-500 hover:bg-rose-600 text-text-dark-primary text-xs rounded-full">
                        <i class="fa fa-circle-xmark text-xs"></i>
                        Clear
                    </button>
                @endif
            </div>
            <div class="mt-4 grid grid-cols-2 gap-2">
                @foreach ($selectedIngredients as $ingredient)
                    <div class="px-3 py-1.5 flex items-center rounded-full bg-primary text-gray-50">
                        <span class="w-[90%] text-sm font-medium">{{ $ingredient['name'] }}</span>
                        <i wire:click="removeIngredient({{ $ingredient['id'] }})"
                            class="w-[10%] fa fa-solid fa-circle-xmark text-xs hover:text-gray-200 cursor-pointer"></i>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
