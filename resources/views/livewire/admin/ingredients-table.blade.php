<div>
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 sm:gap-2">
        <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4 sm:gap-2 w-full">
            <div class="w-full sm:max-w-xs">
                <div class="relative">
                    <input wire:model.live.debounce.300ms='search'
                        class="w-full bg-bg-primary dark:bg-bg-dark-primary placeholder:text-slate-400 text-text-primary dark:text-text-dark-primary text-sm border border-gray-200 dark:border-[#393939] rounded-md pl-3 pr-28 py-2 transition duration-300 ease focus:outline-none focus:border-secondary-light dark:focus:border-secondary-light hover:border-gray-300 shadow-sm focus:shadow"
                        placeholder="Cari ingredient ..." />
                    <button
                        class="absolute top-1 right-1 flex items-center space-x-1 rounded bg-secondary/80 py-1 px-2.5 border border-transparent text-center text-sm text-text-dark-primary transition-all shadow-sm disabled:pointer-events-none font-normal"
                        type="button" disabled>
                        <i class="fa-solid fa-magnifying-glass text-sm"></i>
                        <span class="hidden sm:inline">
                            Cari
                        </span>
                    </button>
                </div>
            </div>

            {{-- filter dropdown --}}
            <div x-data="{ isOpen: false }" class="relative w-full sm:w-auto">
                <button @click="isOpen = !isOpen"
                    class="px-3 py-2 w-full sm:w-[150px] bg-secondary hover:bg-secondary-hover rounded-md text-sm text-text-dark-primary flex justify-between space-x-1 items-center transition-all duration-300 capitalize"
                    type="button">
                    <span>{{ $selectedFilter == '' ? 'Semua' : $selectedFilter }}</span>
                    <i class="fa-solid" :class="isOpen ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                </button>
                <ul role="menu" x-show="isOpen" @click.away="isOpen = false"
                    class="absolute left-0 mt-2 z-10 w-full sm:w-[150px] overflow-auto rounded-lg border border-slate-200 dark:border-slate-700 bg-bg-primary dark:bg-bg-dark-secondary p-1.5 shadow-lg focus:outline-none space-y-1 transition-colors">
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
            class="w-full sm:w-auto px-3 py-2 bg-primary hover:bg-primary-hover rounded-md text-sm text-text-dark-primary transition-all duration-300">
            <span class="flex items-center justify-center gap-2">
                <i class="fa-solid fa-plus sm:hidden"></i>
                Tambah
            </span>
        </button>
    </div>

    <div class="relative mt-8">
        <div class="overflow-x-auto">
            <!-- Mobile view cards -->
            <div class="md:hidden space-y-4">
                @foreach ($ingredients as $ingredient)
                    <div class="bg-bg-primary dark:bg-bg-dark-primary rounded-lg p-4 shadow">
                        <div class="flex justify-between items-start mb-3">
                            <span class="text-sm font-medium">
                                #{{ ($ingredients->currentPage() - 1) * $ingredients->perPage() + $loop->iteration }}
                            </span>
                            <div x-data="{ isOpen: false }" class="relative">
                                <button
                                    class="w-8 h-8 bg-gray-100 dark:bg-bg-dark-secondary hover:bg-gray-200 border border-gray-300 text-text-primary dark:text-text-dark-primary rounded-md flex justify-center items-center"
                                    @click="isOpen = !isOpen">
                                    <i class="fa-solid fa-ellipsis"></i>
                                </button>
                                <ul role="menu" x-show="isOpen" @click.away="isOpen = false"
                                    class="absolute right-0 mt-2 z-50 w-36 rounded-lg border border-slate-200 dark:border-slate-800 bg-bg-primary dark:bg-bg-dark-secondary p-1.5 shadow-lg">
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
                        </div>
                        <div class="flex gap-4 mb-3">
                            @if ($ingredient->image)
                                <img src="{{ asset($ingredient->image) }}" alt="{{ $ingredient->name }}"
                                    class="h-20 w-24 rounded-md object-cover">
                            @else
                                <div
                                    class="h-20 w-24 bg-gray-200 dark:bg-neutral-700 rounded-md shadow-sm flex justify-center items-center">
                                    <i class="fa-regular fa-image text-gray-400"></i>
                                </div>
                            @endif
                            <div class="flex-1">
                                <h3 class="text-base font-semibold mb-1">{{ $ingredient->name ?? '-' }}</h3>
                                <p class="text-sm font-normal text-gray-600 dark:text-gray-400 capitalize">
                                    {{ $ingredient->category ?? '-' }}</p>
                                <p class="text-sm text-gray-600 dark:text-gray-400 line-clamp-2 mt-1">
                                    {{ $ingredient->description != '' ? $ingredient->description : '-' }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Desktop view table -->
            <table class="w-full text-sm text-left text-text-primary dark:text-text-dark-primary hidden md:table">
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
        <div class="relative flex min-h-screen items-center justify-center p-4">
            <!-- Modal Content -->
            <div x-show="$wire.showModal" x-transition.scale.origin.center
                class="w-full max-w-3xl bg-white dark:bg-bg-dark-primary rounded-lg text-left overflow-hidden shadow-xl transform transition-all">
                <!-- Modal Header -->
                <div class="bg-white dark:bg-bg-dark-primary px-4 sm:px-6 pt-4 sm:pt-6 pb-4 relative">
                    <button type="button" wire:click='closeModal'
                        class="absolute top-3 sm:top-4 right-3 sm:right-4 text-gray-400 hover:text-gray-500">
                        <i class="fa-solid fa-xmark text-lg"></i>
                    </button>
                    <h3
                        class="text-base sm:text-lg font-semibold leading-6 text-gray-900 dark:text-text-dark-primary pr-8">
                        {{ $isEditMode ? 'Edit Ingredient' : 'Tambah Ingredient' }}
                    </h3>
                </div>

                <!-- Modal Body -->
                <form enctype="multipart/form-data" wire:submit.prevent='handleSaveIngredient'>
                    <div class="px-4 sm:px-6 py-4 font-normal text-sm">
                        <div class="mb-5">
                            <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4 sm:space-x-4">
                                @if ($newImage)
                                    <div
                                        class="w-full sm:w-52 h-24 bg-gray-100 dark:bg-bg-dark-secondary rounded-lg flex items-center justify-center overflow-hidden relative shadow-md">
                                        <img src="{{ $newImage->temporaryUrl() }}" id="preview" alt="Preview"
                                            class="w-full h-full object-cover">
                                        <button type="button" wire:click="$set('newImage', null)"
                                            class="absolute top-2 right-2 bg-red-500 text-white rounded-full flex justify-center items-center hover:bg-red-600 p-1.5">
                                            <i class="fa-solid fa-xmark"></i>
                                        </button>
                                    </div>
                                @elseif ($existingImagePath)
                                    <div
                                        class="w-full sm:w-52 h-24 bg-gray-100 dark:bg-bg-dark-secondary rounded-lg flex items-center justify-center overflow-hidden relative shadow-md">
                                        <img src="{{ asset($existingImagePath) }}" id="preview"
                                            alt="Existing Image" class="w-full h-full object-cover">
                                        <button type="button" wire:click="$set('existingImagePath', null)"
                                            class="absolute top-2 right-2 bg-red-500 text-white rounded-full flex justify-center items-center hover:bg-red-600 p-1.5">
                                            <i class="fa-solid fa-xmark"></i>
                                        </button>
                                    </div>
                                @else
                                    <div
                                        class="w-full sm:w-52 h-24 bg-gray-100 dark:bg-bg-dark-secondary rounded-lg shadow-md flex justify-center items-center">
                                        <div role="status" wire:loading wire:target="newImage">
                                            <svg aria-hidden="true"
                                                class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-primary"
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
                                        <i wire:loading.remove wire:target="newImage"
                                            class="fa-regular fa-image text-lg text-gray-400"></i>
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
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-4 flex flex-col sm:flex-row gap-4 sm:space-x-2 w-full">
                            <div class="w-full">
                                <label for="name"
                                    class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">
                                    Nama Ingredient
                                    <span class="text-xs text-red-500">*</span>
                                </label>
                                <input wire:model='name' type="text" id="name" placeholder="Bawang Merah"
                                    class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-bg-dark-primary dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:shadow-xs-light" />
                                @error('name')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="w-full">
                                <label for="category"
                                    class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">
                                    Kategori
                                    <span class="text-xs text-red-500">*</span>
                                </label>
                                @if ($isAddCategory)
                                    <div class="flex space-x-1">
                                        <input wire:model='category' type="text" id="category"
                                            placeholder="protein"
                                            class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-bg-dark-primary dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:shadow-xs-light" />
                                        <button type="button" wire:click="$set('isAddCategory', false)"
                                            class="px-3 sm:px-4 py-2.5 text-sm font-medium text-text-primary dark:text-text-dark-primary border border-gray-500 hover:bg-gray-500 hover:text-text-dark-primary rounded-md transition duration-300">
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
                                                {{ $option == $category ? 'selected' : '' }}>
                                                {{ $option }}
                                            </option>
                                        @endforeach
                                    </select>
                                @endif
                                @error('category')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="description"
                                class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">
                                Deskripsi
                            </label>
                            <textarea wire:model='description' name="description" id="description" rows="3"
                                class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-bg-dark-primary dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:shadow-xs-light"></textarea>
                            @error('description')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div
                        class="flex items-center justify-end gap-2 p-4 md:p-5 border-t border-gray-200 dark:border-gray-600">
                        <button type="button" wire:click='closeModal'
                            class="w-full sm:w-auto py-1.5 px-4 sm:px-5 text-sm font-medium text-text-primary dark:text-text-dark-primary border border-gray-500 hover:bg-gray-500 hover:text-text-dark-primary rounded-md transition duration-300">
                            Batal
                        </button>
                        <button type="submit"
                            class="w-full sm:w-auto text-white bg-primary hover:bg-primary-hover border border-primary px-5 sm:px-6 py-1.5 text-sm text-center rounded-md transition duration-300">
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
                    class="relative transform overflow-hidden rounded-lg bg-white dark:bg-bg-dark-primary text-left shadow-xl transition-all w-full mx-4 sm:mx-0 sm:my-8 sm:max-w-lg">
                    <div class="bg-white dark:bg-bg-dark-primary p-4 sm:p-6">
                        <div class="flex flex-col sm:flex-row sm:items-start gap-4">
                            <div
                                class="mx-auto flex size-12 shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0">
                                <svg class="size-6 text-red-600" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                                </svg>
                            </div>
                            <div class="text-center sm:text-left flex-1">
                                <h3 class="text-lg font-semibold text-main-text dark:text-dark-main-text"
                                    id="modal-title">Delete Ingredient
                                </h3>
                                <div class="mt-2 space-y-2">
                                    <p class="text-sm text-gray-500 dark:text-gray-300">
                                        Apakah anda yakin akan menghapus ingredient ini?
                                    </p>
                                    <p class="text-sm text-gray-500 dark:text-gray-300">
                                        Data akan di hapus secara permanen. Tindakan ini tidak dapat di batalkan.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="px-4 py-3 sm:px-6 flex flex-col-reverse sm:flex-row sm:justify-end gap-3">
                        <button type="button" wire:click='closeConfirmationModal'
                            class="w-full sm:w-auto py-2 px-4 text-sm font-medium text-text-primary dark:text-text-dark-primary border border-gray-500 hover:bg-gray-500 hover:text-text-dark-primary rounded-md transition-colors">
                            Cancel
                        </button>
                        <button wire:click='handleDelete' type="button"
                            class="w-full sm:w-auto py-2 px-4 text-sm font-semibold text-white bg-red-600 hover:bg-red-500 rounded-md transition-colors">
                            Delete
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end modal delete confirmation --}}
</div>
