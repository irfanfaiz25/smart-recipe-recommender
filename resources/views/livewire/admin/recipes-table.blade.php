<div>
    <div class="flex justify-between items-center">
        <div class="w-full max-w-xs min-w-[200px]">
            <div class="relative">
                <input type="text" placeholder="Cari resep ..." wire:model.live.debounce.300ms="search"
                    class="w-full bg-white dark:bg-bg-dark-primary placeholder:text-slate-400 text-text-primary dark:text-text-dark-primary text-sm border border-gray-200 dark:border-[#393939] rounded-full pl-10 pr-4 py-2.5 transition duration-300 ease focus:outline-none focus:border-secondary focus:ring-2 focus:ring-secondary/20 hover:border-gray-300 shadow-md">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fa-solid fa-magnifying-glass text-gray-400"></i>
                </div>
            </div>
        </div>

        <a href="{{ route(auth()->user()->hasRole('admin') ? 'admin-recipes.create' : 'recipes.create') }}" wire:navigate
            class="px-3 py-2.5 min-w-40 max-w-48 bg-primary hover:bg-primary-hover rounded-full text-sm text-text-dark-primary transition-all duration-300 text-center">
            Tambah
        </a>
    </div>

    <div class="mt-10 grid grid-cols-1 md:grid-cols-2 gap-6">
        @forelse ($recipes as $recipe)
            <div
                class="group relative bg-white dark:bg-bg-dark-primary rounded-xl shadow-lg hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300 overflow-hidden border border-gray-100 dark:border-gray-800">
                <!-- Decorative accent bar at top with animation -->
                <div
                    class="absolute top-0 left-0 w-full h-1.5 bg-gradient-to-r from-primary via-secondary to-primary-light group-hover:animate-pulse">
                </div>

                <!-- Card Header with Actions - Enhanced styling -->
                <div
                    class="border-b border-slate-200 dark:border-slate-700 py-3.5 px-5 flex justify-between items-center bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-800/50 dark:to-gray-900/50">
                    <div class="flex space-x-2.5 items-center">
                        @if ($recipe->is_published)
                            @switch($recipe->moderation?->status)
                                @case('approved')
                                    <div
                                        class="flex items-center space-x-1.5 text-xs px-3 py-1.5 rounded-full bg-green-100 dark:bg-green-900/30 border border-green-200 dark:border-green-800 transform hover:scale-105 transition-transform duration-300">
                                        <i class="fa-solid fa-earth-americas text-green-600 dark:text-green-400"></i>
                                        <span class="font-medium">Public</span>
                                    </div>
                                @break

                                @case('pending')
                                    <div
                                        class="flex items-center space-x-1.5 text-xs px-3 py-1.5 rounded-full bg-amber-100 dark:bg-amber-900/30 border border-amber-200 dark:border-amber-800 transform hover:scale-105 transition-transform duration-300">
                                        <i class="fa-solid fa-clock text-amber-600 dark:text-amber-400"></i>
                                        <span class="font-medium">Dalam Peninjauan</span>
                                    </div>
                                @break

                                @case('rejected')
                                    <button wire:click='handleOpenDetailRejection({{ $recipe->id }})'
                                        class="flex items-center space-x-1.5 text-xs px-3 py-1.5 rounded-full bg-rose-100 dark:bg-rose-900/30 border border-rose-200 dark:border-rose-800 transform hover:scale-105 transition-transform duration-300">
                                        <i class="fa-solid fa-ban text-rose-600 dark:text-rose-400"></i>
                                        <span class="font-medium">
                                            Publikasi Ditolak
                                        </span>
                                    </button>
                                @break

                                @default
                            @endswitch
                        @else
                            <div
                                class="flex items-center space-x-1.5 text-xs px-3 py-1.5 rounded-full bg-gray-100 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 transform hover:scale-105 transition-transform duration-300">
                                <i class="fa-solid fa-box-archive text-gray-700 dark:text-gray-400"></i>
                                <span class="font-medium">Draf</span>
                            </div>
                        @endif
                        <a href="{{ auth()->user()->hasRole('admin') ? route('admin-recipes.detail', $recipe->id) : route('recipes.detail', $recipe->id) }}"
                            class="px-3.5 py-1.5 flex items-center rounded-full bg-gradient-to-r from-secondary to-secondary-hover text-text-dark-primary group-hover:shadow-md transition-all duration-300 text-xs font-medium hover:scale-105">
                            <i class="fa-solid fa-circle-info mr-1.5 group-hover:animate-pulse"></i>
                            <span>Lihat Detail</span>
                        </a>
                    </div>
                    {{-- add condition the button can be accessed only by recipe owner --}}
                    @if ($recipe->user->id === auth()->user()->id)
                        <div class="flex space-x-2.5 items-center">
                            <a href="{{ route(auth()->user()->hasRole('admin') ? 'admin-recipes.edit' : 'recipes.edit', $recipe->id) }}"
                                wire:navigate
                                class="p-2 flex justify-center items-center rounded-full bg-gradient-to-r from-gray-500 to-gray-600 text-white hover:scale-110 transition-all duration-300 text-xs shadow-md hover:shadow-lg">
                                <i class="fa-solid fa-pencil"></i>
                            </a>
                            <button wire:click="handleShowDeleteModal({{ $recipe->id }}, '{{ $recipe->name }}')"
                                class="p-2 flex justify-center items-center rounded-full bg-gradient-to-r from-rose-500 to-rose-600 text-white hover:scale-110 transition-all duration-300 text-xs shadow-md hover:shadow-lg">
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
                    @endif
                </div>

                <!-- Card Content - Enhanced with better spacing and visual hierarchy -->
                <div
                    class="p-6 bg-gradient-to-br from-white to-gray-50/50 dark:from-bg-dark-primary dark:to-gray-800/10">
                    <div class="flex space-x-5">
                        @if ($recipe->image)
                            <div
                                class="relative overflow-hidden rounded-lg h-36 w-36 shadow-md group-hover:shadow-lg transition-all duration-300">
                                <img src="{{ asset($recipe->image) }}" alt="{{ $recipe->name }}"
                                    class="h-full w-full object-cover transform group-hover:scale-110 transition-all duration-700">
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                </div>
                            </div>
                        @else
                            <div
                                class="relative overflow-hidden h-36 w-36 bg-gradient-to-br from-gray-100 to-gray-200 dark:from-neutral-700 dark:to-neutral-800 rounded-lg shadow-md flex justify-center items-center group-hover:shadow-lg transition-all duration-300">
                                <i
                                    class="fa-regular fa-image text-gray-400 text-3xl group-hover:scale-125 transition-transform duration-300"></i>
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                </div>
                            </div>
                        @endif
                        <div class="flex-1">
                            <h2
                                class="text-2xl font-bold text-text-primary dark:text-text-dark-primary group-hover:text-primary dark:group-hover:text-primary-light transition-colors duration-300">
                                {{ $recipe->name }}
                            </h2>
                            <p
                                class="mt-2.5 text-sm font-normal text-gray-600 dark:text-gray-400 line-clamp-3 group-hover:line-clamp-none transition-all duration-500">
                                {{ $recipe->description }}
                            </p>
                        </div>
                    </div>

                    <!-- Recipe Stats - Enhanced with better visual separation -->
                    <div class="mt-6 flex justify-between items-center">
                        <div class="flex flex-wrap gap-1.5">
                            <div
                                class="flex items-center space-x-1.5 text-xs px-3 py-1.5 rounded-full bg-blue-100 dark:bg-blue-900/30 border border-blue-200 dark:border-blue-800 transform hover:scale-105 transition-transform duration-300">
                                <i class="fa-regular fa-clock text-blue-600 dark:text-blue-400"></i>
                                <span class="font-medium">{{ $recipe->cooking_time }} min</span>
                            </div>
                            <div
                                class="flex items-center space-x-1.5 text-xs px-3 py-1.5 rounded-full bg-yellow-100 dark:bg-yellow-900/30 border border-yellow-200 dark:border-yellow-800 capitalize transform hover:scale-105 transition-transform duration-300">
                                <i class="fa-solid fa-sliders text-yellow-600 dark:text-yellow-400"></i>
                                <span class="font-medium">{{ $recipe->difficulty }}</span>
                            </div>
                            <div
                                class="flex items-center space-x-1.5 text-xs px-3 py-1.5 rounded-full bg-purple-100 dark:bg-purple-900/30 border border-purple-200 dark:border-purple-800 transform hover:scale-105 transition-transform duration-300">
                                <i class="fa-solid fa-bowl-food text-purple-600 dark:text-purple-400"></i>
                                <span class="font-medium">{{ $recipe->servings }}</span>
                            </div>
                            <div
                                class="flex items-center space-x-1.5 text-xs px-3 py-1.5 rounded-full bg-rose-100 dark:bg-purple-900/30 border border-rose-200 dark:border-rose-800 transform hover:scale-105 transition-transform duration-300">
                                <i class="fa-solid fa-fire-flame-curved text-rose-600 dark:text-rose-400"></i>
                                <span class="font-medium">
                                    {{ floor($recipe->calories / $recipe->servings) }} kkal/porsi
                                </span>
                            </div>
                        </div>

                        <div
                            class="flex space-x-0.5 text-sm text-yellow-500 items-center bg-yellow-50 dark:bg-yellow-900/20 px-3 py-1.5 rounded-full border border-yellow-100 dark:border-yellow-800/50 shadow-sm">
                            @if ($recipe->ratings->count() > 0)
                                @for ($i = 1; $i <= 5; $i++)
                                    <i
                                        class="fa-{{ $i <= (int) number_format($recipe->ratings->avg('rating')) ? 'solid' : 'regular' }} fa-star group-hover:scale-110 transition-transform duration-300"></i>
                                @endfor
                            @else
                                <i
                                    class="fa-regular fa-star group-hover:scale-110 transition-transform duration-300"></i>
                                <i
                                    class="fa-regular fa-star group-hover:scale-110 transition-transform duration-300"></i>
                                <i
                                    class="fa-regular fa-star group-hover:scale-110 transition-transform duration-300"></i>
                                <i
                                    class="fa-regular fa-star group-hover:scale-110 transition-transform duration-300"></i>
                                <i
                                    class="fa-regular fa-star group-hover:scale-110 transition-transform duration-300"></i>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Decorative accent bar at bottom with animation -->
                <div
                    class="absolute bottom-0 left-0 w-full h-1.5 bg-gradient-to-r from-primary-light via-secondary to-primary opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                </div>
            </div>
            @empty
                <div class="col-span-2 flex items-center justify-center min-h-[400px]">
                    <div
                        class="text-center bg-gradient-to-br from-white to-gray-50 dark:from-bg-dark-primary dark:to-gray-900/50 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300 p-10 max-w-md mx-auto border border-gray-100 dark:border-gray-800">
                        <div
                            class="mb-6 bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-800 dark:to-gray-900 p-8 rounded-full inline-block group shadow-inner hover:shadow-md transition-all duration-300">
                            <i
                                class="fa-solid fa-bowl-food text-6xl text-primary/50 dark:text-primary/30 group-hover:text-primary transition-colors duration-500"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-text-primary dark:text-text-dark-primary mb-3">
                            Belum Ada Resep
                        </h3>
                        <p class="text-base font-medium text-gray-500 dark:text-gray-400 mb-8 max-w-xs mx-auto">
                            Anda belum memiliki resep apapun. Mulai tambahkan resep pertama Anda sekarang!
                        </p>
                        <a href="{{ route(auth()->user()->hasRole('admin') ? 'recipes.create' : 'recipes.create') }}"
                            wire:navigate
                            class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-primary to-primary-hover text-white rounded-lg shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-300 text-sm font-medium">
                            <i class="fa-solid fa-plus mr-2"></i>
                            Tambah Resep
                        </a>
                    </div>
                </div>
            @endforelse
        </div>

        <div class="mt-5">
            {{ $recipes->links('vendor.livewire.tailwind') }}
        </div>

        {{-- detail rejection modal --}}
        <div x-show="$wire.showDetailRejection" class="relative z-50" aria-labelledby="modal-title" role="dialog"
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
                                    Detail Penolakan Resep
                                </h3>
                                <i wire:click='handleCloseDetailRejection' wire:loading.remove
                                    wire:target='handleCloseDetailRejection'
                                    class="fa fa-solid fa-xmark text-base font-medium cursor-pointer"></i>
                                <div role="status" wire:loading wire:target="handleCloseDetailRejection">
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

                            <div class="p-6 space-y-6">
                                <!-- Rejection Reason -->
                                <div class="bg-red-50 rounded-lg p-4 border border-red-100">
                                    <div class="flex items-center mb-2">
                                        <i class="fa-solid fa-circle-exclamation text-red-500 mr-2"></i>
                                        <h4 class="font-semibold text-red-500 text-base">Alasan Penolakan</h4>
                                    </div>
                                    <p class="text-red-700 text-sm font-medium">
                                        {{ $rejectedRecipe?->moderation?->notes }}
                                    </p>
                                </div>

                                <!-- Rejection Details -->
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="bg-gray-50 rounded-lg p-4 border border-gray-100">
                                        <div class="flex items-center mb-2">
                                            <i class="fa-regular fa-calendar text-gray-600 mr-2"></i>
                                            <h4 class="font-semibold text-gray-700 text-base">Tanggal Penolakan</h4>
                                        </div>
                                        <p class="text-gray-600 text-sm font-medium">
                                            {{ $rejectedRecipe?->moderation?->updated_at->format('d M Y, H:i') }}
                                        </p>
                                    </div>

                                    <div class="bg-gray-50 rounded-lg p-4 border border-gray-100">
                                        <div class="flex items-center mb-2">
                                            <i class="fa-regular fa-user text-gray-600 mr-2"></i>
                                            <h4 class="font-semibold text-gray-700 text-base">Moderator</h4>
                                        </div>
                                        <p class="text-gray-600 text-sm font-medium capitalize">
                                            {{ $rejectedRecipe?->moderation?->approver->name }}
                                        </p>
                                    </div>
                                </div>

                                <div class="w-full">
                                    <a href="{{ $rejectedRecipe ? route(auth()->user()->hasRole('admin') ? 'admin-recipes.edit' : 'recipes.edit', $rejectedRecipe->id) : '#' }}"
                                        class="block w-full text-center px-5 py-2.5 bg-gradient-to-br from-secondary to-secondary-light text-white rounded-lg text-base font-semibold shadow-sm hover:shadow-lg hover:scale-105 transition-all duration-300">
                                        Tinjau Kembali Resep
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Delete Confirmation Modal --}}
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
