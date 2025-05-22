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

        <a href="{{ route('recipes.create') }}" wire:navigate
            class="px-3 py-2 min-w-40 max-w-48 bg-primary hover:bg-primary-hover rounded-md text-sm text-text-dark-primary transition-all duration-300 text-center">
            Tambah
        </a>
    </div>

    <div class="mt-8 grid grid-cols-2 gap-3">
        @forelse ($recipes as $recipe)
            <div class="h-[220px] bg-white dark:bg-bg-dark-primary rounded-lg">
                <div
                    class="mb-0 border-b border-slate-200 dark:border-slate-700 py-3 px-4 flex justify-between items-center">
                    <div class="flex space-x-1 items-center">
                        <button wire:click="handleShowDetailModal('ingredient', {{ $recipe->id }})"
                            class="px-3 py-1.5 flex justify-center items-center rounded-full bg-secondary hover:bg-secondary-hover text-text-dark-primary group space-x-1 text-xs">
                            <i class="fa-solid fa-wheat-awn"></i>
                            <span>Ingredient</span>
                            <div role="status" wire:loading
                                wire:target="handleShowDetailModal('ingredient', {{ $recipe->id }})">
                                <svg aria-hidden="true"
                                    class="w-4 h-4 text-gray-200 animate-spin dark:text-gray-600 fill-primary-light"
                                    viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
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
                        <button wire:click="handleShowDetailModal('steps', {{ $recipe->id }})"
                            class="px-3 py-1.5 flex justify-center items-center rounded-full bg-primary hover:bg-primary-hover text-text-dark-primary group space-x-1 text-xs">
                            <i class="fa-solid fa-list-ul"></i>
                            <span>Langkah Pembuatan</span>
                            <div role="status" wire:loading
                                wire:target="handleShowDetailModal('steps', {{ $recipe->id }})">
                                <svg aria-hidden="true"
                                    class="w-4 h-4 text-gray-200 animate-spin dark:text-gray-600 fill-primary-light"
                                    viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
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
                    <div class="flex space-x-1 items-center">
                        <a href="{{ route('recipes.edit', $recipe->id) }}" wire:navigate
                            class="p-2 flex justify-center items-center rounded-full bg-gray-500 hover:bg-gray-600 text-text-dark-primary group space-x-1 text-xs">
                            <i class="fa-solid fa-pencil"></i>
                        </a>
                        <button wire:click="handleShowDeleteModal({{ $recipe->id }}, '{{ $recipe->name }}')"
                            class="p-2 flex justify-center items-center rounded-full bg-rose-500 hover:bg-rose-600 text-text-dark-primary group text-xs">
                            <i wire:loading.remove
                                wire:target="handleShowDeleteModal({{ $recipe->id }}, '{{ $recipe->name }}')"
                                class="fa-solid fa-trash"></i>
                            <div role="status" wire:loading
                                wire:target="handleShowDeleteModal({{ $recipe->id }}, '{{ $recipe->name }}')">
                                <svg aria-hidden="true"
                                    class="w-3 h-3 text-gray-200 animate-spin dark:text-gray-600 fill-primary-light"
                                    viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
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
                <div class="p-4">
                    <div class="flex space-x-3">
                        @if ($recipe->image)
                            <img src="{{ asset($recipe->image) }}" alt="{{ $recipe->name }}"
                                class="h-24 w-[27%] rounded-md object-cover shadow-md">
                        @else
                            <div
                                class="h-24 w-[27%] bg-gray-200 dark:bg-neutral-700 rounded-md shadow-md flex justify-center items-center">
                                <i class="fa-regular fa-image text-gray-400"></i>
                            </div>
                        @endif
                        <div class="w-[73%]">
                            <h2 class="text-lg font-semibold text-text-primary dark:text-text-dark-primary">
                                {{ $recipe->name }}
                            </h2>
                            <p class="mt-1 h-16 overflow-y-auto text-sm font-normal text-gray-700 dark:text-gray-300">
                                {{ $recipe->description }}
                            </p>
                        </div>
                    </div>
                    <div class="mt-5 flex justify-between items-center">
                        <div class="flex justify-center items-center space-x-3">
                            <div class="flex items-center space-x-1 text-sm">
                                <i
                                    class="fa-solid fa-earth-americas {{ $recipe->is_published ? 'text-primary' : 'text-gray-700' }}"></i>
                                <span class="font-medium">{{ $recipe->is_published ? 'Public' : 'Draf' }}</span>
                            </div>
                            <div class="flex items-center space-x-1 text-sm">
                                <i class="fa-regular fa-clock text-primary"></i>
                                <span class="font-medium">{{ $recipe->cooking_time }} min</span>
                            </div>
                            <div class="flex items-center space-x-1 text-sm capitalize">
                                <i class="fa-solid fa-sliders text-yellow-500"></i>
                                <span class="font-medium">{{ $recipe->difficulty }}</span>
                            </div>
                            <div class="flex items-center space-x-1 text-sm">
                                <i class="fa-solid fa-bowl-food text-secondary"></i>
                                <span class="font-medium">{{ $recipe->servings }}</span>
                            </div>
                        </div>

                        <div class="flex space-x-1 text-sm text-secondary items-center">
                            @if ($recipe->ratings->count() > 0)
                                @for ($i = 1; $i <= 5; $i++)
                                    <i
                                        class="fa-{{ $i <= (int) number_format($recipe->ratings->avg('rating')) ? 'solid' : 'regular' }} fa-star"></i>
                                @endfor
                            @else
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-regular fa-star"></i>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-2 flex items-center justify-center min-h-[400px]">
                <div class="text-center bg-white dark:bg-bg-dark-primary rounded-xl shadow-lg p-8 max-w-md mx-auto">
                    <div class="mb-4">
                        <i class="fa-solid fa-bowl-food text-6xl text-gray-300 dark:text-gray-600"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-text-primary dark:text-text-dark-primary mb-2">
                        Belum Ada Resep
                    </h3>
                    <p class="text-base font-medium text-gray-500 dark:text-gray-400 mb-6">
                        Anda belum memiliki resep apapun. Mulai tambahkan resep pertama Anda sekarang!
                    </p>
                    <a href="{{ route('recipes.create') }}" wire:navigate
                        class="inline-flex items-center px-4 py-2 bg-primary hover:bg-primary-hover text-white rounded-lg transition-colors duration-200">
                        Tambah Resep
                    </a>
                </div>
            </div>
        @endforelse
    </div>

    <div class="mt-5">
        {{ $recipes->links('vendor.livewire.tailwind') }}
    </div>

    <div x-show="$wire.showDetailModal" class="relative z-50" aria-labelledby="modal-title" role="dialog"
        aria-modal="true">
        <div class="fixed inset-0 bg-black/75 transition-opacity" aria-hidden="true"></div>

        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div
                    class="relative transform overflow-hidden rounded-lg bg-white dark:bg-bg-dark-primary text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                    <div class="bg-white dark:bg-bg-dark-primary">
                        <div
                            class="mb-0 border-b border-slate-200 dark:border-slate-700 py-3 px-4 flex justify-between items-center">
                            <h3 class="text-lg font-semibold">
                                {{ $detailName === 'ingredient' ? 'Ingredient' : 'Langkah Pembuatan' }}</h3>
                            <i wire:click='handleCloseDetailModal' wire:loading.remove
                                wire:target='handleCloseDetailModal'
                                class="fa fa-solid fa-xmark text-base font-medium cursor-pointer"></i>
                            <div role="status" wire:loading wire:target="handleCloseDetailModal">
                                <svg aria-hidden="true"
                                    class="w-4 h-4 text-gray-200 animate-spin dark:text-gray-600 fill-primary-light"
                                    viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                        fill="currentColor" />
                                    <path
                                        d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                        fill="currentFill" />
                                </svg>
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                        @if ($detailName === 'ingredient')
                            <div class="p-4 grid grid-cols-2 gap-3">
                                @foreach ($detailContent as $item)
                                    <div
                                        class="h-16 flex space-x-3 bg-gray-100 dark:bg-neutral-900 shadow-md rounded-lg p-2">
                                        @if ($item['image'])
                                            <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}"
                                                class="h-full w-12 rounded-md object-cover shadow-md">
                                        @else
                                            <div
                                                class="h-full w-12 bg-gray-300 rounded-md flex justify-center items-center shadow-md">
                                                <i class="fa-regular fa-image text-gray-400 text-base"></i>
                                            </div>
                                        @endif
                                        <div>
                                            <h4
                                                class="text-base font-semibold text-text-primary dark:text-text-dark-primary">
                                                {{ $item['name'] }}
                                            </h4>
                                            <p
                                                class="text-base font-normal text-text-primary dark:text-text-dark-primary">
                                                {{ $item['pivot']['amount'] . ' ' . $item['pivot']['unit'] }}
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="p-4 space-y-2">
                                @foreach ($detailContent as $item)
                                    <div class="flex items-center space-x-3">
                                        <span
                                            class="h-5 w-5 flex justify-center items-center bg-secondary text-text-dark-primary rounded-full text-xs">
                                            {{ $item['step_number'] }}
                                        </span>
                                        <span
                                            class="text-base font-medium text-text-primary dark:text-text-dark-primary">
                                            {{ $item['description'] }}
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div x-show="$wire.showDeleteConfirmationModal" class="relative z-50" aria-labelledby="modal-title"
        role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-black/75 transition-opacity" aria-hidden="true"></div>

        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div
                    class="relative transform overflow-hidden rounded-lg bg-white dark:bg-dark-tertiary-bg text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                    <div class="bg-white dark:bg-dark-tertiary-bg px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div
                                class="mx-auto flex size-12 shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:size-10">
                                <svg class="size-6 text-red-600" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                                <h3 class="text-base font-semibold text-main-text dark:text-dark-main-text"
                                    id="modal-title">Hapus Resep
                                </h3>
                                <div class="mt-2 font-normal">
                                    <p class="text-sm text-gray-500 dark:text-gray-300">Apakah anda yakin akan
                                        menghapus resep <span class="font-bold">{{ $deleteName }}</span>?
                                    </p>
                                    <p class="text-sm text-gray-500 dark:text-gray-300">Data akan di hapus secara
                                        permanen. Tindakan ini tidak dapat di batalkan.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                        <button wire:click='handleDelete' type="button"
                            class="flex w-full justify-center space-x-2 items-center rounded-md bg-red-600 px-5 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto">
                            <span>Delete</span>
                            <div role="status" wire:loading wire:target="handleDelete">
                                <svg aria-hidden="true"
                                    class="w-6 h-6 text-gray-200 animate-spin dark:text-gray-600 fill-gray-300"
                                    viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
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
                        <button type="button" wire:click='handleCloseDeleteModal'
                            class="py-1.5 px-5 flex justify-center items-center space-x-2 text-sm font-medium text-text-primary dark:text-text-dark-primary border border-gray-500 hover:bg-gray-500 hover:text-text-dark-primary rounded-md">
                            <span>Cancel</span>
                            <div role="status" wire:loading wire:target="handleCloseDeleteModal">
                                <svg aria-hidden="true"
                                    class="w-4 h-4 text-gray-200 animate-spin dark:text-gray-600 fill-primary-light"
                                    viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
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
            </div>
        </div>
    </div>
</div>
