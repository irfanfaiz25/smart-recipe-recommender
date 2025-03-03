<div x-show="pageLoaded" x-transition:enter="transform transition-all duration-700 ease-out"
    x-transition:enter-start="opacity-0 -translate-x-full" x-transition:enter-end="opacity-100 translate-x-0"
    class="w-full">
    <div class="flex space-x-4">
        <div class="w-[75%] rounded-lg bg-white shadow-lg h-80">
            <div class="p-5">
                <div class="flex space-x-2 items-center">
                    <div class="w-[65%] min-w-[200px]">
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
                    <div class="w-[35%]">
                        <button type="button" wire:click="$set('isImageRecognitionOpen', true)"
                            class="w-full px-4 py-3 bg-secondary hover:bg-secondary-hover text-text-dark-primary font-medium rounded-lg shadow-md transition-all duration-200 ease-in-out transform hover:scale-[1.02] active:scale-[0.98] text-sm">
                            Deteksi Bahan Masakan dengan Kamera Anda</button>

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
                                <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                                </div>
                                <div class="relative inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
                                    @click.away="$wire.isImageRecognitionOpen = false"
                                    x-transition:enter="transform ease-out duration-300"
                                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                                    x-transition:leave="transform ease-in duration-200"
                                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                                    <form wire:submit.prevent='recognizeImage' class="flex flex-col p-6">
                                        <div class=" mb-5">
                                            <h2 class="text-lg font-semibold">Analisa Gambar Bahan Masakan</h2>
                                            <p class="text-xs text-gray-500 font-normal">
                                                Upload gambar bahan masakan yang tersedia di rumah Anda. Detail dari
                                                gambar
                                                yang diupload akan mempengaruhi hasil deteksi bahan masakan. </p>
                                        </div>

                                        <div class="flex w-full space-x-2 mb-6">
                                            @if ($image)
                                                <img class="w-40 h-28 rounded-lg shadow-md object-cover"
                                                    src="{{ $image->temporaryUrl() }}" alt="image recognition">
                                            @else
                                                <div
                                                    class="w-40 h-28 bg-gray-100 flex justify-center items-center rounded-lg shadow-md">
                                                    <i class="fa-regular fa-image text-lg text-gray-400"></i>
                                                </div>
                                            @endif
                                            <div>
                                                <input type="file" wire:model='image'
                                                    class="w-full block text-sm text-text-primary file:mr-4 file:py-3 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-secondary/80 file:text-text-dark-primary hover:file:bg-secondary transition-all cursor-pointer">
                                                @error('image')
                                                    <p class="text-xs text-red-500">
                                                        {{ $message }}
                                                    </p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="flex justify-between items-center space-x-3">
                                            <h3 class="text-sm font-medium text-text-primary">
                                                Credits: 3
                                            </h3>
                                            <div class="flex justify-end space-x-3">
                                                <button type="button"
                                                    wire:click="$set('isImageRecognitionOpen', false)"
                                                    class="px-4 py-2.5 bg-gray-200 hover:bg-gray-300 text-text-primary font-medium rounded-lg shadow-md transition-all duration-200 ease-in-out text-sm">
                                                    Batal
                                                </button>
                                                <button type="submit" wire:loading.attr="disabled"
                                                    wire:target='recognizeImage'
                                                    class="px-4 py-2.5 flex justify-center items-center bg-secondary hover:bg-secondary-dark text-text-dark-primary font-medium rounded-lg shadow-md transition-all duration-200 ease-in-out transform hover:scale-[1.02] active:scale-[0.98] text-sm">
                                                    Analisa
                                                    <div role="status" wire:loading wire:target='recognizeImage'>
                                                        <svg aria-hidden="true"
                                                            class="ml-2 w-5 h-5 text-gray-200 animate-spin dark:text-gray-600 fill-white"
                                                            viewBox="0 0 100 101" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                                                fill="currentColor" />
                                                            <path
                                                                d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                                                fill="currentFill" />
                                                        </svg>
                                                        <span class="sr-only">Loading...</span>
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

            {{-- ingredients list --}}
            <div class="p-5 max-h-[13.2rem] overflow-y-auto">
                <h2 class="text-base">
                    Pilih Bahan Masakan :
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
                                                    src="{{ asset($ingredient->image) }}" alt="{{ $ingredient->name }}">
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
