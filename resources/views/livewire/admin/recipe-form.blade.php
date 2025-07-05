<div>
    <!-- Sticky Progress Bar -->
    {{-- <div class="bg-white dark:bg-bg-dark-primary p-4 shadow-md mb-6 rounded-lg">
        <div class="w-full bg-gray-200 rounded-full h-2 mb-3 dark:bg-gray-700">
            <div class="bg-secondary h-2 rounded-full transition-all duration-300"
                style="width: {{ $this->getFormProgress() }}%"></div>
        </div>
        <div class="text-sm text-gray-600 dark:text-gray-400 text-center">
            Progress: {{ $this->getFormProgress() }}%
        </div>
    </div> --}}
    <!-- Progress Indicator -->
    <div class="mb-6 bg-white dark:bg-bg-dark-secondary rounded-lg p-4 border border-gray-200 dark:border-gray-600">
        <div class="flex items-center justify-between mb-2">
            <h3 class="text-sm font-medium text-gray-900 dark:text-white">Progress Pengisian Form</h3>
            <span class="text-sm text-gray-500 dark:text-gray-400">{{ $this->getFormProgress() }}%</span>
        </div>
        <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
            <div class="bg-blue-600 h-2 rounded-full transition-all duration-300"
                style="width: {{ $this->getFormProgress() }}%"></div>
        </div>
    </div>

    <div class="w-full h-fit bg-bg-primary dark:bg-bg-dark-primary p-4 rounded-lg relative">
        <form wire:submit='save'>
            <div class="w-full mb-6">
                <div class="flex flex-col md:flex-row md:space-x-4 w-full md:w-1/2 justify-center mx-auto">
                    <div class="w-full md:w-52 mb-4 md:mb-0">
                        @if ($newImage)
                            <div
                                class="w-full md:w-52 h-32 bg-gray-100 dark:bg-bg-dark-secondary rounded-lg flex items-center justify-center overflow-hidden relative">
                                <img src="{{ $newImage->temporaryUrl() }}" id="preview" alt="Preview"
                                    class="w-full h-full object-cover">
                                <button type="button" wire:click="$set('newImage', null)"
                                    class="absolute top-2 right-2 bg-red-500 text-white rounded-full flex justify-center items-center hover:bg-red-600 px-2 py-1">
                                    <i class="fa-solid fa-xmark text-sm"></i>
                                </button>
                            </div>
                        @elseif ($existingImagePath)
                            <div
                                class="w-full md:w-52 h-32 bg-gray-100 dark:bg-bg-dark-secondary rounded-lg flex items-center justify-center overflow-hidden relative">
                                <img src="{{ $existingImagePath }}" id="preview" alt="Existing Image"
                                    class="w-full h-full object-cover">
                                <button type="button" wire:click="$set('existingImagePath', null)"
                                    class="absolute top-2 right-2 bg-red-500 text-white rounded-full flex justify-center items-center hover:bg-red-600 px-2 py-1">
                                    <i class="fa-solid fa-xmark text-sm"></i>
                                </button>
                            </div>
                        @else
                            <div
                                class="w-full md:w-52 h-32 bg-gray-100 dark:bg-bg-dark-secondary rounded-lg shadow-sm flex justify-center items-center">
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
                    <div class="flex flex-col justify-center space-y-2 w-full">
                        <!-- File Upload Button -->
                        <label class="flex w-full">
                            <div
                                class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 dark:bg-bg-dark-primary dark:border-gray-600 dark:text-white dark:shadow-xs-light font-normal cursor-pointer hover:bg-gray-100 dark:hover:bg-neutral-700 flex items-center justify-center w-full">
                                <i class="fa-regular fa-file-image mr-2"></i>
                                <span>Upload File</span>
                            </div>
                            <input wire:model='newImage' type="file" id="fileInput" accept="image/*"
                                class="hidden" />
                        </label>

                        <!-- Camera Capture Button -->
                        <label class="flex md:hidden w-full">
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

            <div class="flex flex-col md:flex-row md:space-x-3 space-y-3 md:space-y-0">
                <div class="w-full md:w-2/3 mb-3">
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
                <div class="w-full md:w-1/3 mb-3">
                    <label for="recipeCategory" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">
                        Kategori Makanan
                        <span class="text-xs text-red-500">
                            *
                        </span>
                    </label>
                    <select wire:model.live.debounce.300ms='recipeCategory' type="text" id="recipeCategory"
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
            <div class="w-full flex flex-col md:flex-row md:items-center space-y-4 md:space-y-0 md:space-x-3 mb-5">
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
            {{-- Ingredients --}}
            <div class="mb-6 w-full">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Bahan Masakan
                    <span class="text-xs text-red-500">*</span>
                </label>

                <!-- Quick Add Bar -->
                <div class="mb-4 relative">
                    <div class="flex space-x-2">
                        <div class="flex-1 relative">
                            <div class="relative">
                                <input wire:model.live.debounce.300ms="quickAdd"
                                    wire:keydown.enter.prevent="addQuickIngredient" id="quickAddInput" type="text"
                                    class="w-full px-4 py-2.5 rounded-lg text-sm font-normal border border-gray-300 
                                           dark:border-gray-600 dark:bg-bg-dark-primary dark:text-white
                                           focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                                           transition-colors"
                                    placeholder="Cari bahan makanan ...">

                                <button wire:click="addQuickIngredient" type="button"
                                    class="absolute right-3 top-1/2 -translate-y-1/2
                                           text-gray-400 hover:text-blue-600 
                                           transition-colors duration-200 ease-in-out">
                                    <i class="fas fa-plus-circle text-lg"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-2 gap-2">
                        {{-- <p class="text-xs text-gray-500 dark:text-gray-400">
                            💡 Contoh: "2 sdm garam", "500g daging sapi", "1 buah bawang merah" atau langsung cari bahan
                            yang anda inginkan
                        </p> --}}

                        <!-- Parse status indicator -->
                        @if ($quickAddStatus)
                            <span
                                class="text-xs px-2 py-1 rounded-full {{ $quickAddStatus['type'] === 'success' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ $quickAddStatus['message'] }}
                            </span>
                        @endif
                    </div>

                    <!-- Search Results Dropdown -->
                    @if ($quickAdd && strlen($quickAdd) > 1 && count($searchResults) > 0)
                        <div
                            class="absolute top-full left-0 w-full bg-white dark:bg-bg-dark-secondary border border-gray-200 dark:border-gray-600 rounded-lg shadow-lg max-h-48 overflow-y-auto z-20">
                            <div class="p-2 border-b border-gray-100 dark:border-gray-700">
                                <p class="text-xs text-gray-500 dark:text-gray-400 font-medium">Hasil pencarian:</p>
                            </div>
                            @foreach ($searchResults as $result)
                                <div wire:click="selectSearchResult('{{ $result['id'] }}', '{{ $result['name'] }}'); $nextTick(() => document.getElementById('quickAddInput').focus())"
                                    class="flex items-center p-3 hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer border-b last:border-b-0 border-gray-100 dark:border-gray-700">
                                    @if ($result['image'])
                                        <img src="{{ $result['image'] }}" class="w-8 h-8 rounded object-cover mr-3">
                                    @else
                                        <div
                                            class="w-8 h-8 bg-gray-100 dark:bg-gray-600 rounded flex items-center justify-center mr-3">
                                            <i class="fas fa-utensils text-xs text-gray-400"></i>
                                        </div>
                                    @endif
                                    <div class="flex-1">
                                        <span
                                            class="text-sm font-medium text-gray-900 dark:text-white">{{ $result['name'] }}</span>
                                        @if ($result['category'])
                                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                                {{ $result['category'] }}
                                            </p>
                                        @endif
                                    </div>
                                    <i class="fas fa-plus text-gray-400 text-sm"></i>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Smart Suggestions based on recipe category -->
                @if ($recipeCategory && count($suggestedIngredients) > 0)
                    <div
                        class="mb-4 p-4 bg-green-50 dark:bg-green-900/20 rounded-lg border border-green-200 dark:border-green-800">
                        <div class="flex items-center mb-2">
                            <i class="fas fa-lightbulb text-green-600 mr-2"></i>
                            <p class="text-sm font-medium text-green-800 dark:text-green-200">
                                Saran bahan untuk {{ $selectedCategoryName }}:
                            </p>
                        </div>
                        <div class="flex flex-wrap gap-2">
                            @foreach ($suggestedIngredients as $suggestion)
                                <button
                                    wire:click="addSuggestedIngredient('{{ $suggestion['text'] }}', '{{ $suggestion['amount'] ?? '' }}', '{{ $suggestion['unit'] ?? '' }}')"
                                    type="button"
                                    class="px-3 py-1.5 text-sm bg-white dark:bg-bg-dark-primary hover:bg-green-50 border border-green-200 hover:border-green-300 rounded-full transition-colors flex items-center gap-1">
                                    <i class="fas fa-plus text-xs text-green-600"></i>
                                    {{ $suggestion['text'] }}
                                    @if ($suggestion['amount'])
                                        <span
                                            class="text-xs text-gray-500 dark:text-gray-300">({{ $suggestion['amount'] }}
                                            {{ $suggestion['unit'] }})</span>
                                    @endif
                                </button>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Selected Ingredients Display -->
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <h4 class="text-sm font-medium text-gray-900 dark:text-white">
                            Bahan Terpilih ({{ count($selectedIngredients) }})
                        </h4>
                        @if (count($selectedIngredients) > 0)
                            <button wire:click="clearAllIngredients" type="button"
                                class="text-xs text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300">
                                <i class="fas fa-trash mr-1"></i>Hapus Semua
                            </button>
                        @endif
                    </div>

                    @if (count($selectedIngredients) > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach ($selectedIngredients as $key => $ingredient)
                                <div
                                    class="bg-white dark:bg-bg-dark-secondary border border-gray-200 dark:border-gray-600 rounded-lg p-4 shadow-sm hover:shadow-md transition-shadow">
                                    <!-- Ingredient Header -->
                                    <div class="flex items-start justify-between mb-3">
                                        <div class="flex items-center flex-1">
                                            @if ($ingredient['image'])
                                                <img src="{{ $ingredient['image'] }}"
                                                    class="w-12 h-12 rounded-lg object-cover mr-3 border border-gray-200">
                                            @else
                                                <div
                                                    class="w-12 h-12 bg-gray-100 dark:bg-gray-600 rounded-lg flex items-center justify-center mr-3 border border-gray-200 dark:border-gray-500">
                                                    <i class="fas fa-utensils text-gray-400 text-sm"></i>
                                                </div>
                                            @endif
                                            <div class="flex-1 min-w-0">
                                                <h5 class="font-medium text-gray-900 dark:text-white text-sm truncate">
                                                    {{ $ingredient['name'] }}
                                                </h5>
                                                @if ($ingredient['category'])
                                                    <p class="text-xs text-gray-500 dark:text-gray-400">
                                                        {{ $ingredient['category'] }}</p>
                                                @endif
                                            </div>
                                        </div>
                                        <button wire:click="removeIngredient({{ $ingredient['id'] }})" type="button"
                                            class="text-red-500 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300 ml-2">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>

                                    <div class="grid grid-cols-2 gap-3 mb-3">
                                        <div>
                                            <label
                                                class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">
                                                Jumlah/Berat
                                            </label>
                                            <input wire:model.live="selectedIngredients.{{ $key }}.amount"
                                                wire:change="updateIngredientAmount({{ $ingredient['id'] }}, $event.target.value)"
                                                type="text"
                                                class="w-full text-sm rounded-md border-gray-300 dark:border-gray-600 dark:bg-neutral-700 dark:text-white"
                                                placeholder="2.5">
                                        </div>
                                        <div>
                                            <label
                                                class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">
                                                Satuan
                                            </label>
                                            <select
                                                wire:change="updateIngredientUnit({{ $ingredient['id'] }}, $event.target.value)"
                                                class="w-full text-sm rounded-md border-gray-300 dark:border-gray-600 dark:bg-neutral-700 dark:text-white">
                                                @foreach ($units as $unit)
                                                    <option value="{{ $unit }}"
                                                        {{ $ingredient['unit'] == $unit ? 'selected' : '' }}>
                                                        {{ $unit }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Primary Ingredient Checkbox -->
                                    <div class="flex items-center">
                                        <input wire:model.live="selectedIngredients.{{ $key }}.isPrimary"
                                            wire:change="updateIngredientIsPrimary({{ $ingredient['id'] }}, $event.target.checked)"
                                            id="isPrimary{{ $key }}" type="checkbox"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                                        <label for="isPrimary{{ $key }}"
                                            class="ml-2 text-sm text-gray-700 dark:text-gray-300">
                                            <i class="fas fa-star text-yellow-500 mr-1"></i>Bahan utama
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div
                            class="text-center py-12 bg-gray-50 dark:bg-neutral-800 rounded-lg border-2 border-dashed border-gray-300 dark:border-gray-600">
                            <i class="fas fa-utensils text-2xl md:text-4xl text-gray-400 mb-4"></i>
                            <p class="text-gray-500 text-base dark:text-gray-400 mb-2">Belum ada bahan yang dipilih</p>
                            <p class="text-sm font-medium text-gray-400 dark:text-gray-500">Cari bahan pada kolom input
                                di atas
                                atau pilih
                                dari saran bahan</p>
                        </div>
                    @endif
                </div>

                @error('selectedIngredients')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3 w-full">
                <label for="step" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Langkah Pembuatan
                    <span class="text-xs text-red-500">*</span>
                </label>
                @foreach ($steps as $index => $step)
                    <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-4 mb-3">
                        <span class="text-sm text-text-primary dark:text-text-dark-primary font-medium min-w-[24px]">
                            {{ $index + 1 }}.
                        </span>
                        <div class="flex-1">
                            <input wire:model="steps.{{ $index }}" type="text" id="step"
                                class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-bg-dark-primary dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark dark:shadow-xs-light font-normal"
                                placeholder="Masukkan langkah {{ $index + 1 }}" />
                        </div>
                        @if (count($steps) > 1)
                            <div class="flex justify-end sm:justify-start">
                                <button wire:click="removeStep({{ $index }})" type="button"
                                    wire:loading.remove wire:target='removeStep({{ $index }})'
                                    class="text-rose-500 hover:text-rose-600 p-2">
                                    <i class="fa fa-solid fa-circle-xmark"></i>
                                </button>
                                <div role="status" wire:loading wire:target="removeStep({{ $index }})"
                                    class="p-2">
                                    <svg aria-hidden="true"
                                        class="w-5 h-5 text-gray-200 animate-spin dark:text-gray-600 fill-white"
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
                        @endif
                    </div>
                @endforeach

                <div class="mt-4 flex items-center gap-2">
                    <button wire:click='addStep' type="button"
                        class="px-4 py-2.5 flex items-center gap-2 text-sm bg-gray-500 hover:bg-gray-600 text-text-dark-primary rounded-lg">
                        <i class="fa fa-solid fa-circle-plus"></i>
                        <span>Tambah Langkah</span>
                    </button>
                    <div role="status" wire:loading wire:target="addStep">
                        <svg aria-hidden="true"
                            class="w-5 h-5 text-gray-200 animate-spin dark:text-gray-600 fill-white"
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
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4 w-full">
                <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Status
                    <span class="text-xs text-red-500">*</span>
                </label>
                <ul
                    class="w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg flex flex-col md:flex-row divide-y sm:divide-y-0 sm:divide-x dark:divide-gray-600 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    <li class="w-full">
                        <div class="flex items-start p-4 sm:p-3">
                            <input wire:model.live.debounce.300ms='status' id="statusTrue" type="radio"
                                value="1" name="status"
                                class="w-4 h-4 mt-1 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                            <div class="ms-3">
                                <label for="statusTrue"
                                    class="text-base font-medium text-gray-900 dark:text-gray-300 cursor-pointer">
                                    Publikasi
                                </label>
                                <p class="text-sm font-normal text-gray-500 dark:text-gray-300">
                                    Publikasikan resep anda agar bisa dilihat semua orang.
                                </p>
                            </div>
                        </div>
                    </li>
                    <li class="w-full">
                        <div class="flex items-start p-4 sm:p-3">
                            <input wire:model.live.debounce.300ms='status' id="statusFalse" type="radio"
                                value="0" name="status"
                                class="w-4 h-4 mt-1 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                            <div class="ms-3">
                                <label for="statusFalse"
                                    class="text-base font-medium text-gray-900 dark:text-gray-300 cursor-pointer">
                                    Draf
                                </label>
                                <p class="text-sm font-normal text-gray-500 dark:text-gray-300">
                                    Simpan resep anda dan bagikan kapanpun anda mau.
                                </p>
                            </div>
                        </div>
                    </li>
                </ul>
                @error('status')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="border-t border-slate-200 dark:border-neutral-700"></div>

            <div class="flex flex-col-reverse sm:flex-row sm:items-center sm:justify-end gap-2 sm:gap-3 pt-4 px-4">
                <a href="{{ route('recipes.index') }}" wire:navigate
                    class="w-full sm:w-auto py-2.5 px-5 text-sm font-medium text-center text-rose-500 border border-rose-500 hover:bg-rose-500 hover:text-text-dark-primary rounded-md transition duration-300">
                    Batal
                </a>

                @if ($recipe?->moderation?->status == 'rejected' && (bool) $status)
                    <button type="submit" wire:loading.attr="disabled" wire:target='save'
                        class="w-full sm:w-auto flex justify-center items-center gap-2 text-white bg-gradient-to-br from-secondary to-secondary-light hover:from-secondary-hover hover:to-secondary border border-secondary px-6 py-2.5 text-sm text-center rounded-md transition-colors duration-300">
                        Ajukan Ulang Resep
                        <div role="status" wire:loading wire:target='save'>
                            <svg aria-hidden="true"
                                class="w-5 h-5 text-gray-200 animate-spin dark:text-gray-600 fill-white"
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
                @else
                    <button type="submit" wire:loading.attr="disabled" wire:target='save'
                        class="w-full sm:w-auto flex justify-center items-center gap-2 text-white bg-primary hover:bg-primary-hover border border-primary px-6 py-2.5 text-sm text-center rounded-md transition duration-300">
                        {{ $recipe ? 'Simpan Resep' : 'Unggah Resep' }}
                        <div role="status" wire:loading wire:target='save'>
                            <svg aria-hidden="true"
                                class="w-5 h-5 text-gray-200 animate-spin dark:text-gray-600 fill-white"
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
                @endif
            </div>
        </form>
    </div>
</div>
