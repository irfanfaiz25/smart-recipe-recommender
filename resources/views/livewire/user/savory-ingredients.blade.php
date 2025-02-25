<div x-show="pageLoaded" x-transition:enter="transform transition-all duration-700 ease-out"
    x-transition:enter-start="opacity-0 -translate-x-full" x-transition:enter-end="opacity-100 translate-x-0"
    class="w-full">
    <div class="flex space-x-4">
        <div class="w-[75%] rounded-lg bg-white shadow-lg h-80">
            <div class="p-5">
                <div class="w-full mx-auto min-w-[200px]">
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
                                        class="h-[3.5rem] p-1.5 border-2 border-secondary hover:bg-secondary text-text-primary hover:text-text-dark-primary rounded-lg flex items-center space-x-2 shadow-md cursor-pointer">

                                        @if ($ingredient->image)
                                            <div class="w-12 h-full">
                                                <img class="w-12 h-full object-cover rounded-md shadow-md"
                                                    src="{{ asset($ingredient->image) }}" alt="{{ $ingredient->name }}">
                                            </div>
                                        @else
                                            <div
                                                class="w-12 h-full flex justify-center items-center bg-gray-100 rounded-md shadow-md">
                                                <i class="fa-solid fa-bowl-food text-base text-gray-400"></i>
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
            <p class="text-base">Bahan Masakan Terpilih :</p>
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
