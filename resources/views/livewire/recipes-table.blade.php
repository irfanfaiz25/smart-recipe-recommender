<div>
    <div class="flex justify-between items-center">
        <div class="w-full max-w-xs min-w-[200px]">
            <div class="relative">
                <input wire:model.live.debounce.300ms='search'
                    class="w-full bg-bg-primary dark:bg-bg-dark-primary placeholder:text-slate-400 text-text-primary dark:text-text-dark-primary text-sm border border-gray-200 dark:border-[#393939] rounded-md pl-3 pr-28 py-2 transition duration-300 ease focus:outline-none focus:border-secondary-light dark:focus:border-secondary-light hover:border-gray-300 shadow-sm focus:shadow"
                    placeholder="Cari ingredient ..." />
                <button
                    class="absolute top-1 right-1 flex items-center space-x-1 rounded bg-secondary/80 py-1 px-2.5 border border-transparent text-center text-sm text-text-dark-primary transition-all shadow-smdisabled:pointer-events-none font-normal"
                    type="button" disabled>
                    <i class="fa-solid fa-magnifying-glass text-sm"></i>
                    <span>
                        Cari
                    </span>
                </button>
            </div>
        </div>

        <button wire:click='handleOpenModal'
            class="px-3 py-2 min-w-40 max-w-48 bg-primary hover:bg-primary-hover rounded-md text-sm text-text-dark-primary transition-all duration-300">
            Tambah
        </button>
    </div>

    <div class="mt-8 grid grid-cols-2 gap-3">
        <div class="h-[220px] bg-white dark:bg-bg-dark-primary rounded-lg">
            <div
                class="mb-0 border-b border-slate-200 dark:border-slate-700 py-3 px-4 flex justify-between items-center">
                <div class="flex space-x-1 items-center">
                    <button
                        class="px-3 py-1.5 flex justify-center items-center rounded-full bg-secondary hover:bg-secondary-hover text-text-dark-primary group space-x-1 text-xs">
                        <i class="fa-solid fa-wheat-awn"></i>
                        <span>Ingredient</span>
                    </button>
                    <button
                        class="px-3 py-1.5 flex justify-center items-center rounded-full bg-primary hover:bg-primary-hover text-text-dark-primary group space-x-1 text-xs">
                        <i class="fa-solid fa-list-ul"></i>
                        <span>Langkah-langkah</span>
                    </button>
                </div>
                <div class="flex space-x-1 items-center">
                    <button
                        class="p-2 flex justify-center items-center rounded-full bg-gray-500 hover:bg-gray-600 text-text-dark-primary group space-x-1 text-xs">
                        <i class="fa-solid fa-pencil"></i>
                    </button>
                    <button
                        class="p-2 flex justify-center items-center rounded-full bg-rose-500 hover:bg-rose-600 text-text-dark-primary group space-x-1 text-xs">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </div>
            </div>
            <div class="p-4">
                <div class="flex space-x-3">
                    <div
                        class="h-24 w-[27%] bg-gray-200 dark:bg-neutral-700 rounded-md shadow-sm flex justify-center items-center">
                        <i class="fa-regular fa-image text-gray-400"></i>
                    </div>
                    <div class="w-[73%]">
                        <h2 class="text-lg font-semibold text-text-primary dark:text-text-dark-primary">Nasi Goreng</h2>
                        <p class="mt-1 h-16 overflow-y-auto text-sm font-normal text-gray-700 dark:text-gray-300">Lorem
                            ipsum
                            dolor, sit amet
                            consectetur
                            adipisicing elit.
                            Fugiat
                            consectetur placeat inventore assumenda sapiente provident cum ut cupiditate?</p>
                    </div>
                </div>
                <div class="mt-5 flex justify-between items-center">
                    <div class="flex justify-center items-center space-x-3">
                        <div class="flex items-center space-x-1 text-sm">
                            <i class="fa-regular fa-clock text-primary"></i>
                            <span class="font-medium">30 min</span>
                        </div>
                        <div class="flex items-center space-x-1 text-sm">
                            <i class="fa-solid fa-sliders text-rose-500"></i>
                            <span class="font-medium">Mudah</span>
                        </div>
                        <div class="flex items-center space-x-1 text-sm">
                            <i class="fa-solid fa-bowl-food text-secondary"></i>
                            <span class="font-medium">1</span>
                        </div>
                    </div>
                    <div class="flex space-x-1 text-sm text-secondary">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-regular fa-star"></i>
                        <i class="fa-regular fa-star"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="h-[220px] bg-white dark:bg-bg-dark-primary rounded-lg">
            <div
                class="mb-0 border-b border-slate-200 dark:border-slate-700 py-3 px-4 flex justify-between items-center">
                <div class="flex space-x-1 items-center">
                    <button
                        class="px-3 py-1.5 flex justify-center items-center rounded-full bg-secondary hover:bg-secondary-hover text-text-dark-primary group space-x-1 text-xs">
                        <i class="fa-solid fa-wheat-awn"></i>
                        <span>Ingredient</span>
                    </button>
                    <button
                        class="px-3 py-1.5 flex justify-center items-center rounded-full bg-primary hover:bg-primary-hover text-text-dark-primary group space-x-1 text-xs">
                        <i class="fa-solid fa-list-ul"></i>
                        <span>Langkah-langkah</span>
                    </button>
                </div>
                <div class="flex space-x-1 items-center">
                    <button
                        class="p-2 flex justify-center items-center rounded-full bg-gray-500 hover:bg-gray-600 text-text-dark-primary group space-x-1 text-xs">
                        <i class="fa-solid fa-pencil"></i>
                    </button>
                    <button
                        class="p-2 flex justify-center items-center rounded-full bg-rose-500 hover:bg-rose-600 text-text-dark-primary group space-x-1 text-xs">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </div>
            </div>
            <div class="p-4">
                <div class="flex space-x-3">
                    <div
                        class="h-24 w-[27%] bg-gray-200 dark:bg-neutral-700 rounded-md shadow-sm flex justify-center items-center">
                        <i class="fa-regular fa-image text-gray-400"></i>
                    </div>
                    <div class="w-[73%]">
                        <h2 class="text-lg font-semibold text-text-primary dark:text-text-dark-primary">Nasi Goreng</h2>
                        <p class="mt-1 h-16 overflow-y-auto text-sm font-normal text-gray-700 dark:text-gray-300">Lorem
                            ipsum
                            dolor, sit amet
                            consectetur
                            adipisicing elit.
                            Fugiat
                            consectetur placeat inventore assumenda sapiente provident cum ut cupiditate?</p>
                    </div>
                </div>
                <div class="mt-5 flex justify-between items-center">
                    <div class="flex justify-center items-center space-x-3">
                        <div class="flex items-center space-x-1 text-sm">
                            <i class="fa-regular fa-clock text-primary"></i>
                            <span class="font-medium">30 min</span>
                        </div>
                        <div class="flex items-center space-x-1 text-sm">
                            <i class="fa-solid fa-sliders text-rose-500"></i>
                            <span class="font-medium">Mudah</span>
                        </div>
                        <div class="flex items-center space-x-1 text-sm">
                            <i class="fa-solid fa-bowl-food text-secondary"></i>
                            <span class="font-medium">1</span>
                        </div>
                    </div>
                    <div class="flex space-x-1 text-sm text-secondary">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-regular fa-star"></i>
                        <i class="fa-regular fa-star"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
