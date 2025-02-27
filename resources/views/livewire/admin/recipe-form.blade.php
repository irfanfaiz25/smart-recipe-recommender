<div>
    <div class="w-full h-fit bg-bg-primary dark:bg-bg-dark-primary p-4 rounded-lg">
        <form wire:submit='save'>
            <div class="w-full mb-6">
                <div class="flex space-x-4 w-1/2 justify-center mx-auto">
                    <div class="w-52">
                        @if ($newImage)
                            <div
                                class="w-52 h-32 bg-gray-100 dark:bg-bg-dark-secondary rounded-lg flex items-center justify-center overflow-hidden relative">
                                <img src="{{ $newImage->temporaryUrl() }}" id="preview" alt="Preview"
                                    class="w-full h-full object-cover">
                                <button type="button" wire:click="$set('newImage', null)"
                                    class="absolute top-2 right-2 bg-red-500 text-white rounded-full flex justify-center items-center hover:bg-red-600 px-2 py-1">
                                    <i class="fa-solid fa-xmark text-sm"></i>
                                </button>
                            </div>
                        @elseif ($existingImagePath)
                            <div
                                class="w-52 h-32 bg-gray-100 dark:bg-bg-dark-secondary rounded-lg flex items-center justify-center overflow-hidden relative">
                                <img src="{{ asset($existingImagePath) }}" id="preview" alt="Existing Image"
                                    class="w-full h-full object-cover">
                                <button type="button" wire:click="$set('existingImagePath', null)"
                                    class="absolute top-2 right-2 bg-red-500 text-white rounded-full flex justify-center items-center hover:bg-red-600 px-2 py-1">
                                    <i class="fa-solid fa-xmark text-sm"></i>
                                </button>
                            </div>
                        @else
                            <div
                                class="w-52 h-32 bg-gray-100 dark:bg-bg-dark-secondary rounded-lg shadow-sm flex justify-center items-center">

                                <div role="status" wire:loading wire:target="newImage">
                                    <svg aria-hidden="true"
                                        class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-primary"
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

                                <i wire:loading.remove wire:target="newImage"
                                    class="fa-regular fa-image text-lg text-gray-400"></i>
                            </div>
                        @endif
                    </div>
                    <div class="flex flex-col justify-center space-y-1 w-full">
                        <!-- File Upload Button -->
                        <label class="flex mt-2 w-full">
                            <div
                                class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 dark:bg-bg-dark-primary dark:border-gray-600 dark:text-white dark:shadow-xs-light font-normal cursor-pointer hover:bg-gray-100 dark:hover:bg-neutral-700 flex items-center justify-center w-full">
                                <i class="fa-regular fa-file-image mr-2"></i>
                                <span>Upload File</span>
                            </div>
                            <input wire:model='newImage' type="file" id="fileInput" accept="image/*"
                                class="hidden" />
                        </label>

                        <!-- Camera Capture Button -->
                        <label class="flex sm:hidden w-full">
                            <div
                                class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 dark:bg-bg-dark-primary dark:border-gray-600 dark:text-white dark:shadow-xs-light font-normal cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-700 flex items-center justify-center w-full">
                                <i class="fa-solid fa-camera mr-2"></i>
                                <span>Take Photo</span>
                            </div>
                            <input wire:model='newImage' type="file" id="cameraInput" accept="image/*" capture="user"
                                class="hidden" />
                        </label>
                    </div>
                </div>

                @error('newImage')
                    <p class="text-red-500 text-xs mt-1">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="flex space-x-3">
                <div class="w-2/3 mb-3">
                    <label for="name" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">
                        Nama
                        <span class="text-xs text-red-500">
                            *
                        </span>
                    </label>
                    <input wire:model='name' type="text" id="name"
                        class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-bg-dark-primary dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark dark:shadow-xs-light font-normal"
                        placeholder="Nasi Goreng" />
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="w-1/3 mb-3">
                    <label for="recipeCategory" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">
                        Kategori Makanan
                        <span class="text-xs text-red-500">
                            *
                        </span>
                    </label>
                    <select wire:model.live='recipeCategory' type="text" id="recipeCategory"
                        class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-bg-dark-primary dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark dark:shadow-xs-light font-normal capitalize"
                        placeholder="Nasi Goreng">
                        <option value="" selected>--Pilih Kategori Makanan--</option>
                        @foreach ($recipeCategories as $category)
                            <option value="{{ $category->id }}"
                                {{ $recipeCategory === $category->id ? 'selected' : '' }}>
                                {{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('recipeCategory')
                        <p class="text-red-500 text-xs mt-1">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>
            <div class="w-full mb-3">
                <label for="description" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">
                    Deskripsi
                    <span class="text-xs text-red-500">
                        *
                    </span>
                </label>
                <textarea wire:model='description' type="text" id="description"
                    class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-bg-dark-primary dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark dark:shadow-xs-light font-normal"
                    rows="4" placeholder="Deskripsikan resep yang anda buat atau ceritakan pengalaman anda memasak resep ini">
            </textarea>
                @error('description')
                    <p class="text-red-500 text-xs mt-1">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            <div class="w-full flex items-center space-x-3 mb-5">
                <div class="w-full">
                    <label for="cookingTime" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">
                        Waktu Memasak (menit)
                        <span class="text-xs text-red-500">
                            *
                        </span>
                    </label>
                    <input wire:model='cookingTime' type="number" id="cookingTime"
                        class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-bg-dark-primary dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark dark:shadow-xs-light font-normal"
                        placeholder="30" />
                    @error('cookingTime')
                        <p class="text-red-500 text-xs mt-1">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="w-full">
                    <label for="difficulty" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">
                        Tingkat Kesulitan
                        <span class="text-xs text-red-500">
                            *
                        </span>
                    </label>
                    <select wire:model.live='difficulty' type="text" id="difficulty"
                        class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-bg-dark-primary dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark dark:shadow-xs-light font-normal"
                        placeholder="Nasi Goreng">
                        <option value="" selected>--Pilih Tingkat Kesulitan--</option>
                        <option value="mudah">Mudah</option>
                        <option value="sedang">Sedang</option>
                        <option value="rumit">Rumit</option>
                    </select>
                    @error('difficulty')
                        <p class="text-red-500 text-xs mt-1">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="w-full">
                    <label for="servings" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">
                        Porsi
                        <span class="text-xs text-red-500">
                            *
                        </span>
                    </label>
                    <input wire:model='servings' type="number" id="servings"
                        class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-bg-dark-primary dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark dark:shadow-xs-light font-normal"
                        placeholder="1" />
                    @error('servings')
                        <p class="text-red-500 text-xs mt-1">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>
            <div class="mb-3 w-full flex space-x-3">
                <div class="w-1/3">
                    <div class="w-full">
                        <label for="search" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">
                            Cari Bahan Masakan
                            <span class="text-xs text-red-500">
                                *
                            </span>
                        </label>
                        <div class="flex space-x-2 items-center">
                            {{-- OLD METHOD --}}
                            {{-- <select wire:model.live='ingredient' type="text" id="ingredient"
                                wire:loading.attr="disabled" wire:target="ingredient"
                                class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-bg-dark-primary dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark dark:shadow-xs-light font-normal"
                                placeholder="Nasi Goreng">
                                <option value="" selected>--Pilih Bahan Masakan--</option>
                                @foreach ($ingredients as $ingredient)
                                    <option
                                        value="{{ json_encode(['id' => $ingredient['id'], 'name' => $ingredient['name'], 'image' => $ingredient['image']]) }}"
                                        {{ collect($selectedIngredients)->contains('id', $ingredient['id']) ? 'disabled' : '' }}>
                                        {{ $ingredient['name'] }}</option>
                                @endforeach
                            </select> --}}
                            <div class="relative w-full">
                                <!-- Search Input -->
                                <input wire:model.live.debounce.300ms='searchIngredients' type="text"
                                    id="search"
                                    x-on:keydown.arrow-down.prevent="$event.target.nextElementSibling.querySelector('.ingredient-item:not(.hidden)')?.focus()"
                                    x-on:keydown.enter.prevent
                                    class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-bg-dark-primary dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark dark:shadow-xs-light font-normal"
                                    placeholder="bawang merah" />
                                <!-- Search Results -->
                                @if ($searchIngredients)
                                    <div
                                        class="mt-2 absolute w-full h-36 bg-gray-100 rounded-lg overflow-y-auto space-y-1">
                                        @foreach ($ingredients as $ingredient)
                                            <div wire:click="selectIngredient({{ $ingredient['id'] }}); $nextTick(() => document.getElementById('search').focus())"
                                                tabindex="0"
                                                x-on:keydown.arrow-down.prevent="$event.target.nextElementSibling?.classList.contains('hidden') ? $event.target.nextElementSibling?.nextElementSibling?.focus() : $event.target.nextElementSibling?.focus()"
                                                x-on:keydown.arrow-up.prevent="$event.target.previousElementSibling?.classList.contains('hidden') ? $event.target.previousElementSibling?.previousElementSibling?.focus() : $event.target.previousElementSibling?.focus()"
                                                x-on:keydown.enter.prevent="$wire.selectIngredient({{ $ingredient['id'] }}); document.getElementById('search').focus()"
                                                class="ingredient-item p-2 hover:bg-gray-200 text-text-primary cursor-pointer text-sm focus:bg-gray-200 focus:outline-none {{ collect($selectedIngredients)->contains('id', $ingredient['id']) ? 'hidden' : '' }}">
                                                {{ $ingredient['name'] }}
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                            <div role="status" wire:loading wire:target="ingredient">
                                <svg aria-hidden="true"
                                    class="w-6 h-6 text-gray-200 animate-spin dark:text-gray-600 fill-primary"
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
                        @error('selectedIngredients')
                            <p class="text-red-500 text-xs mt-1">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>
                <div class="w-2/3">
                    <p class="text-sm mb-1">Bahan Masakan Terpilih :</p>
                    <div class="grid grid-cols-2 gap-3">
                        @forelse ($selectedIngredients as $key => $ingredient)
                            <div
                                class="h-[7rem] flex items-center space-x-2 p-2 bg-gray-50 dark:bg-neutral-700 rounded-lg shadow-md">
                                <div class="w-[25%] h-full">
                                    @if ($ingredient['image'])
                                        <img src="{{ asset($ingredient['image']) }}" alt="{{ $ingredient['name'] }}"
                                            class="h-full w-24 rounded-md object-cover shadow-md">
                                    @else
                                        <div
                                            class="h-full w-24 flex justify-center items-center bg-gray-100 rounded-md shadow-md">
                                            <i class="fa-regular fa-image text-sm text-gray-400"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="w-[75%] h-full flex flex-col justify-between">
                                    <div class="flex justify-between space-x-2">
                                        <div class="w-[90%] h-fit">
                                            <p class="text-sm font-medium">{{ $ingredient['name'] }}</p>
                                        </div>
                                        <div class="w-[10%] text-end">
                                            <i wire:click="removeIngredient({{ $ingredient['id'] }})"
                                                wire:loading.remove
                                                wire:target="removeIngredient({{ $ingredient['id'] }})"
                                                class="fa fa-solid fa-circle-xmark cursor-pointer text-base text-rose-500 hover:text-rose-600"></i>
                                            <div role="status" wire:loading
                                                wire:target="removeIngredient({{ $ingredient['id'] }})">
                                                <svg aria-hidden="true"
                                                    class="w-4 h-4 text-gray-200 animate-spin dark:text-gray-600 fill-primary"
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
                                        </div>
                                    </div>
                                    <div class="flex space-x-3">
                                        <div class="space-y-1">
                                            <label for="unit"
                                                class="text-xs text-text-primary dark:text-text-dark-primary">
                                                Jumlah/Berat
                                            </label>
                                            <input wire:model.live="selectedIngredients.{{ $key }}.amount"
                                                wire:change="updateIngredientAmount({{ $ingredient['id'] }}, $event.target.value)"
                                                type="text"
                                                class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg block w-full px-2 py-1.5 dark:bg-bg-dark-primary dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark dark:shadow-xs-light font-normal"
                                                placeholder="2.5">
                                        </div>
                                        <div class="space-y-1">
                                            <label for="unit"
                                                class="text-xs text-text-primary dark:text-text-dark-primary">
                                                Satuan
                                            </label>
                                            <select
                                                wire:change="updateIngredientUnit({{ $ingredient['id'] }}, $event.target.value)"
                                                class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg block w-full px-2 py-1.5 dark:bg-bg-dark-primary dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark dark:shadow-xs-light font-normal">
                                                @foreach ($units as $unit)
                                                    <option value="{{ $unit }}" class="capitalize"
                                                        {{ $ingredient['unit'] == $unit ? 'selected' : '' }}>
                                                        {{ $unit }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="mt-2 text-sm font-normal">
                                Belum ada ingredient terpilih.
                            </p>
                        @endforelse
                    </div>
                </div>
            </div>
            <div class="mb-3 w-full">
                <label for="step" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">
                    Langkah Pembuatan
                    <span class="text-xs text-red-500">
                        *
                    </span>
                </label>
                @foreach ($steps as $index => $step)
                    <div class="flex items-center space-x-4 mb-2">
                        <span class="text-sm text-text-primary dark:text-text-dark-primary font-medium">
                            {{ $index + 1 }}.
                        </span>
                        <div class="w-full">
                            <input wire:model="steps.{{ $index }}" type="text" id="step"
                                class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-bg-dark-primary dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark dark:shadow-xs-light font-normal"
                                placeholder="Masukkan langkah {{ $index + 1 }}" />
                        </div>
                        @if (count($steps) > 1)
                            <button wire:click="removeStep({{ $index }})" type="button" wire:loading.remove
                                wire:target='removeStep({{ $index }})'
                                class="text-rose-500 hover:text-rose-600">
                                <i class="fa fa-solid fa-circle-xmark"></i>
                            </button>
                            <div role="status" wire:loading wire:target="removeStep({{ $index }})">
                                <svg aria-hidden="true"
                                    class="w-6 h-6 text-gray-200 animate-spin dark:text-gray-600 fill-primary"
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
                        @endif
                    </div>
                @endforeach

                <div class="mt-3 flex space-x-2 items-center">
                    <button wire:click='addStep' type="button"
                        class="px-4 py-2.5 flex items-center space-x-2 text-sm bg-gray-500 hover:bg-gray-600 text-text-dark-primary rounded-lg">
                        <i class="fa fa-solid fa-circle-plus"></i>
                        <span>Tambah Langkah</span>
                    </button>
                    <div role="status" wire:loading wire:target="addStep">
                        <svg aria-hidden="true"
                            class="w-6 h-6 text-gray-200 animate-spin dark:text-gray-600 fill-primary"
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
                @error('steps')
                    <p class="text-red-500 text-xs mt-1">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            <div class="mb-4 w-full">
                <label for="status" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">
                    Status
                    <span class="text-xs text-red-500">
                        *
                    </span>
                </label>
                <ul
                    class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                        <div class="flex items-center ps-3">
                            <input wire:model.live.debounce.300ms='status' id="statusTrue" type="radio"
                                value="1" name="status"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                            <div class="w-full py-3 ms-2 ">
                                <label for="statusTrue"
                                    class="text-base font-medium text-gray-900 dark:text-gray-300 cursor-pointer">
                                    Publikasi
                                </label>
                                <p class="text-sm font-normal text-gray-500 dark:text-gray-300 cursor-text">
                                    Publikasikan resep anda agar bisa dilihat semua orang.
                                </p>
                            </div>
                        </div>
                    </li>
                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                        <div class="flex items-center ps-3">
                            <input wire:model.live.debounce.300ms='status' id="statusFalse" type="radio"
                                value="0" name="status"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                            <div class="w-full py-3 ms-2 ">
                                <label for="statusFalse"
                                    class="text-base font-medium text-gray-900 dark:text-gray-300 cursor-pointer">
                                    Draf
                                </label>
                                <p class="text-sm font-normal text-gray-500 dark:text-gray-300 cursor-text">
                                    Simpan resep anda dan bagikan kapanpun anda mau.
                                </p>
                            </div>
                        </div>
                    </li>
                </ul>
                @error('status')
                    <p class="text-red-500 text-xs mt-1">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            <div class="border border-t border-slate-200 dark:border-neutral-700"></div>
            <div class="flex items-center justify-end space-x-2 pt-3 px-4">
                <a href="{{ route('recipes.index') }}" wire:navigate
                    class="py-2 px-5 text-sm font-medium text-rose-500 border border-rose-500 hover:bg-rose-500 hover:text-text-dark-primary rounded-md transition duration-300">Batal</a>
                {{-- <button type="submit" wire:loading.attr="disabled" wire:target='save'
                    class="flex justify-center items-center space-x-2 text-white bg-gray-500 hover:bg-gray-600 border border-gray-500 px-6 py-2 text-sm text-center rounded-md transition duration-300">
                    Draf
                    <div role="status" wire:loading wire:target='save'>
                        <svg aria-hidden="true"
                        class="ml-2 w-5 h-5 text-gray-200 animate-spin dark:text-gray-600 fill-white"
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
            </button> --}}
                <button type="submit" wire:loading.attr="disabled" wire:target='save'
                    class="flex justify-center items-center space-x-2 text-white bg-primary hover:bg-primary-hover border border-primary px-6 py-2 text-sm text-center rounded-md transition duration-300">
                    {{ $recipe ? 'Simpan Resep' : 'Unggah Resep' }}
                    <div role="status" wire:loading wire:target='save'>
                        <svg aria-hidden="true"
                            class="ml-2 w-5 h-5 text-gray-200 animate-spin dark:text-gray-600 fill-white"
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
        </form>
    </div>
</div>
