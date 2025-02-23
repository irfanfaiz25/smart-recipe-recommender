<div x-show="pageLoaded" x-transition:enter="transform transition-all duration-700 ease-out"
    x-transition:enter-start="opacity-0 -translate-x-full" x-transition:enter-end="opacity-100 translate-x-0"
    class="w-[35%] rounded-lg bg-white shadow-lg">
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
    <div class="p-5 ">
        <h2 class="text-base">
            Pilih Bahan Makanan :
        </h2>
        <div class="mt-2 grid grid-cols-2 gap-2">
            <div
                class="h-[5rem] p-2 border-2 border-secondary hover:bg-secondary text-text-primary hover:text-text-dark-primary rounded-lg flex items-center space-x-2 shadow-md cursor-pointer">
                <div class="w-16 h-full flex justify-center items-center bg-gray-100 rounded-md shadow-md">
                    <i class="fa-regular fa-image text-base text-gray-400"></i>
                </div>
                <h3 class="text-base font-medium">
                    Bawang Merah
                </h3>
            </div>
            <div
                class="h-[5rem] p-2 border-2 border-secondary hover:bg-secondary text-text-primary hover:text-text-dark-primary rounded-lg flex items-center space-x-2 shadow-md cursor-pointer">
                <div class="w-16 h-full flex justify-center items-center bg-gray-100 rounded-md shadow-md">
                    <i class="fa-regular fa-image text-base text-gray-400"></i>
                </div>
                <h3 class="text-base font-medium">
                    Bawang Putih
                </h3>
            </div>
        </div>
    </div>
</div>
