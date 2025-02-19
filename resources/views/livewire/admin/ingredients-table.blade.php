<div>
    <div class="flex justify-between items-center">
        <div class="flex items-center space-x-2 w-full">
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

            {{-- filter dropdown --}}
            <div x-data="{ isOpen: false }" class="relative w-full">
                <button @click="isOpen = !isOpen"
                    class="px-3 py-2 w-full sm:min-w-[150px] sm:max-w-[150px] bg-secondary hover:bg-secondary-hover rounded-md text-sm text-text-dark-primary flex justify-between space-x-1 items-center transition-all duration-300 capitalize"
                    type="button">
                    <span>{{ $selectedFilter == '' ? 'Semua' : $selectedFilter }}</span>
                    <i class="fa-solid" :class="isOpen ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                </button>
                <ul role="menu" x-show="isOpen" @click.away="isOpen = false"
                    class="absolute left-0 mt-2 z-10 w-full sm:min-w-[150px] sm:max-w-[150px] overflow-auto rounded-lg border border-slate-200 dark:border-slate-700 bg-bg-primary dark:bg-bg-dark-secondary p-1.5 shadow-lg focus:outline-none space-y-1 transition-colors">
                    <li role="menuitem" wire:click="$set('selectedFilter', null)"
                        class="cursor-pointer rounded-md flex w-full text-sm items-center p-3 transition-all {{ $selectedFilter == '' ? 'bg-secondary text-text-dark-primary' : 'text-text-primary dark:text-text-dark-primary hover:bg-gray-100 hover:dark:bg-bg-dark-primary' }}"
                        @click="isOpen = false">
                        Semua
                    </li>
                    @foreach ($filterOptions as $filter)
                        <li role="menuitem" wire:click="$set('selectedFilter', '{{ $filter }}')"
                            class="cursor-pointer rounded-md flex w-full text-sm items-center p-3 transition-all {{ $selectedFilter == $filter ? 'bg-secondary text-text-dark-primary' : 'text-text-primary dark:text-text-dark-primary hover:bg-gray-100 hover:dark:bg-bg-dark-primary' }} capitalize"
                            @click="isOpen = false">
                            {{ $filter }}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <button wire:click='handleOpenModal'
            class="px-3 py-2 min-w-40 max-w-48 bg-primary hover:bg-primary-hover rounded-md text-sm text-text-dark-primary transition-all duration-300">
            Tambah
        </button>
    </div>

    <div class="relative mt-8">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-text-primary dark:text-text-dark-primary">
                <thead>
                    <tr class="px-3 bg-bg-primary dark:bg-bg-dark-primary text-sm">
                        <th class="rounded-s-md px-2 py-3 text-center">No</th>
                        <th class="px-2 py-3">Gambar</th>
                        <th class="px-2 py-3">Nama</th>
                        <th class="px-2 py-3">Kategori</th>
                        <th class="px-2 py-3">Deskripsi</th>
                        <th class="rounded-e-md px-2 py-3"></th>
                    </tr>
                </thead>
                <tbody class="font-medium">
                    @foreach ($ingredients as $ingredient)
                        <tr class="h-2"></tr>
                        <tr class="px-3 bg-bg-primary dark:bg-bg-dark-primary text-sm">
                            <td class="rounded-s-md px-2 py-3 text-center">
                                {{ ($ingredients->currentPage() - 1) * $ingredients->perPage() + $loop->iteration }}
                            </td>
                            <td class="px-2 py-3">
                                @if ($ingredient->image)
                                    <img src="{{ asset($ingredient->image) }}" alt="{{ $ingredient->name }}"
                                        class="h-14 w-20 rounded-md object-cover">
                                @else
                                    <div
                                        class="h-14 w-20 bg-gray-200 dark:bg-neutral-700 rounded-md shadow-sm flex justify-center items-center">
                                        <i class="fa-regular fa-image text-gray-400"></i>
                                    </div>
                                @endif
                            </td>
                            <td class="px-2 py-3">
                                {{ $ingredient->name ?? '-' }}
                            </td>
                            <td class="px-2 py-3 capitalize">
                                {{ $ingredient->category ?? '-' }}
                            </td>
                            <td class="px-2 py-3">
                                {{ $ingredient->description != '' ? $ingredient->description : '-' }}
                            </td>
                            <td class="rounded-e-md px-2 py-3">
                                <div x-data="{ isOpen: false }">
                                    <button
                                        class="w-6 h-6 bg-gray-100 dark:bg-bg-dark-secondary hover:bg-gray-200 border border-gray-300 text-text-primary dark:text-text-dark-primary rounded-md flex justify-center items-center cursor-pointer transition-all duration-300"
                                        @click="isOpen = !isOpen">
                                        <i class="fa-solid text-sm transition-transform duration-300"
                                            :class="isOpen ? 'fa-ellipsis rotate-90' : 'fa-ellipsis'"></i>
                                    </button>
                                    <ul role="menu" x-show="isOpen" @click.away="isOpen = false"
                                        class="absolute mt-2 right-16 z-50 min-w-36 max-w-72 overflow-auto rounded-lg border border-slate-200 dark:border-slate-800 bg-bg-primary dark:bg-bg-dark-secondary p-1.5 shadow-lg focus:outline-none transition-all duration-500">
                                        <li role="menuitem" wire:click="editIngredient({{ $ingredient->id }})"
                                            @click="isOpen = false"
                                            class="cursor-pointer rounded-md text-text-primary dark:text-text-dark-primary flex w-full text-sm items-center p-3 transition-all hover:bg-gray-100 dark:hover:bg-bg-dark-primary">
                                            <i class="fa-solid fa-pencil text-blue-500 pr-2"></i>
                                            Edit
                                        </li>
                                        <li role="menuitem" wire:click="openConfirmationModal({{ $ingredient->id }})"
                                            @click="isOpen = false"
                                            class="cursor-pointer rounded-md text-text-primary dark:text-text-dark-primary flex w-full text-sm items-center p-3 transition-all hover:bg-gray-100 dark:hover:bg-bg-dark-primary">
                                            <i class="fa-solid fa-trash text-rose-500 pr-2"></i>
                                            Hapus
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $ingredients->links('vendor.livewire.tailwind') }}
        </div>
    </div>

    {{-- modal --}}
    <div x-show="$wire.showModal" x-transition.opacity class="fixed inset-0 z-50 overflow-y-auto"
        style="display: none;">
        <!-- Backdrop -->
        <div class="fixed inset-0 bg-black/75" aria-hidden="true" wire:click='closeModal'></div>

        <!-- Modal Container -->
        <div class="relative flex min-h-screen items-center justify-center px-4 pt-4 pb-20 text-center">
            <!-- Modal Content -->

            <div x-show="$wire.showModal" x-transition.scale.origin.center
                class="inline-block align-middle bg-white dark:bg-bg-dark-primary rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:max-w-3xl sm:w-full">
                <!-- Modal Header -->
                <div class="bg-white dark:bg-bg-dark-primary px-6 pt-6 pb-4 relative">
                    <button type="button" wire:click='closeModal'
                        class="absolute top-4 right-4 text-gray-400 hover:text-gray-500">
                        <i class="fa-solid fa-xmark text-lg"></i>
                    </button>
                    <h3 class="text-lg font-semibold leading-6 text-gray-900 dark:text-text-dark-primary">
                        {{ $isEditMode ? 'Edit Ingredient' : 'Tambah Ingredient' }}
                    </h3>
                </div>

                <!-- Modal Body -->
                <form enctype="multipart/form-data" wire:submit.prevent='handleSaveIngredient'>
                    <div class="px-6 py-4 font-normal text-sm">
                        <div class="mb-5">
                            <div class="flex items-center space-x-4">
                                @if ($newImage)
                                    <div
                                        class="w-52 h-24 bg-gray-100 dark:bg-bg-dark-secondary rounded-lg flex items-center justify-center overflow-hidden">
                                        <img src="{{ $newImage->temporaryUrl() }}" id="preview" alt="Preview"
                                            class="w-full h-full object-cover">
                                    </div>
                                @elseif ($existingImagePath)
                                    <div
                                        class="w-52 h-24 bg-gray-100 dark:bg-bg-dark-secondary rounded-lg flex items-center justify-center overflow-hidden">
                                        <img src="{{ asset($existingImagePath) }}" id="preview"
                                            alt="Existing Image" class="w-full h-full object-cover">
                                    </div>
                                @else
                                    <div
                                        class="w-52 h-24 bg-gray-100 dark:bg-bg-dark-secondary rounded-lg shadow-sm flex justify-center items-center">
                                        <i class="fa-regular fa-image text-lg text-gray-400"></i>
                                    </div>
                                @endif

                                <div class="w-full">
                                    <label for="image"
                                        class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">
                                        Gambar Ingredient
                                    </label>
                                    <input wire:model='newImage' type="file" id="image" accept="image/*"
                                        class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-bg-dark-primary dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:shadow-xs-light" />
                                    @error('newImage')
                                        <p class="text-red-500 text-xs mt-1">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-2 flex space-x-2 w-full">
                            <div class="w-full">
                                <label for="name"
                                    class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">
                                    Nama Ingredient
                                    <span class="text-xs text-red-500">
                                        *
                                    </span>
                                </label>
                                <input wire:model='name' type="text" id="name"
                                    class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-bg-dark-primary dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark dark:shadow-xs-light"
                                    placeholder="Bawang Merah" />
                                @error('name')
                                    <p class="text-red-500 text-xs mt-1">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <div class="w-full">
                                <label for="category"
                                    class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">
                                    Kategori
                                    <span class="text-xs text-red-500">
                                        *
                                    </span>
                                </label>
                                @if ($isAddCategory)
                                    <div class="flex space-x-1">
                                        <input wire:model='category' type="text" id="category"
                                            class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-bg-dark-primary dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark dark:shadow-xs-light"
                                            placeholder="protein" />
                                        <button type="button" wire:click="$set('isAddCategory', false)"
                                            class="px-4 py-2.5 text-sm font-medium text-text-primary dark:text-text-dark-primary border border-gray-500 hover:bg-gray-500 hover:text-text-dark-primary rounded-md transition duration-300">
                                            Batal
                                        </button>
                                    </div>
                                @else
                                    <select wire:model.live.debounce.300ms='category' id="category"
                                        class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-bg-dark-primary dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:shadow-xs-light font-normal capitalize">
                                        <option value="" selected>--pilih kategori--</option>
                                        <option value="addNewCategory">--tambah kategori baru--</option>
                                        @foreach ($filterOptions as $option)
                                            <option value="{{ $option }}"
                                                {{ $option == $category ? 'selected' : '' }}>{{ $option }}
                                            </option>
                                        @endforeach
                                    </select>
                                @endif

                                @error('category')
                                    <p class="text-red-500 text-xs mt-1">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-2">
                            <label for="description"
                                class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">
                                Deskripsi
                            </label>
                            <textarea wire:model='description' name="description" id="description"
                                class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-bg-dark-primary dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:shadow-xs-light"
                                rows="3"></textarea>
                            @error('description')
                                <p class="text-red-500 text-xs mt-1">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <div
                        class="flex items-center justify-end space-x-2 p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <button type="button" wire:click='closeModal'
                            class="py-1.5 px-5 text-sm font-medium text-text-primary dark:text-text-dark-primary border border-gray-500 hover:bg-gray-500 hover:text-text-dark-primary rounded-md transition duration-300">Batal</button>
                        <button type="submit"
                            class="text-white bg-primary hover:bg-primary-hover border border-primary px-6 py-1.5 text-sm text-center rounded-md transition duration-300">
                            {{ $isEditMode ? 'Simpan' : 'Tambah' }}
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    {{-- end modal --}}

    {{-- modal delete confirmation --}}
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
                                    id="modal-title">Delete Ingredient
                                </h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500 dark:text-gray-300">Apakah anda yakin akan
                                        menghapus ingredient ini?
                                    </p>
                                    <p class="text-sm text-gray-500 dark:text-gray-300">Data akan di hapus secara
                                        permanen. Tindakan ini tidak dapat di batalkan.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                        <button wire:click='handleDelete' type="button"
                            class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto">Delete</button>
                        <button type="button" wire:click='closeConfirmationModal'
                            class="py-1.5 px-5 text-sm font-medium text-text-primary dark:text-text-dark-primary border border-gray-500 hover:bg-gray-500 hover:text-text-dark-primary rounded-md">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end modal delete confirmation --}}
</div>
