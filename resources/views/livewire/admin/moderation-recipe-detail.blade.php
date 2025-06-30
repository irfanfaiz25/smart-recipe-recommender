<div x-show="pageLoaded" x-transition:enter="transform transition-all duration-700 ease-out"
    x-transition:enter-start="opacity-0 -translate-x-full" x-transition:enter-end="opacity-100 translate-x-0"
    class="w-full">
    <div class="mt-3 w-full bg-white dark:bg-bg-dark-primary rounded-lg shadow-lg h-fit">
        <div class="relative w-full rounded-t-lg">
            @if ($recipe->image)
                <img class="w-full h-48 sm:h-64 md:h-80 lg:h-[30rem] rounded-t-lg object-cover"
                    src="{{ asset($recipe->image) }}">
            @else
                <div
                    class="w-full h-48 sm:h-64 md:h-80 lg:h-[30rem] rounded-t-lg bg-gray-200 dark:bg-bg-dark-primary flex justify-center items-center">
                    <div class="flex flex-col items-center space-y-3">
                        <i
                            class="fa-solid fa-utensils text-2xl sm:text-3xl md:text-4xl text-gray-500 dark:text-text-dark-primary"></i>
                        <p
                            class="font-normal italic text-gray-500 dark:text-text-dark-primary text-sm sm:text-base px-4 text-center">
                            {{ $recipe->name }}
                        </p>
                    </div>
                </div>
            @endif
            <a href="{{ route('admin-moderation.index') }}" wire:navigate
                class="px-3 py-2 sm:px-4 sm:py-2.5 md:px-6 md:py-3 absolute top-3 left-3 bg-black/40 hover:bg-black/60 text-white text-sm sm:text-base font-semibold rounded-lg shadow-lg">
                <i class="fa-solid fa-chevron-left pe-1 text-xs sm:text-sm"></i>
                <span class="hidden sm:inline">Kembali</span>
                <span class="sm:hidden">Back</span>
            </a>
        </div>
        <div class="py-4 px-4 sm:py-6 sm:px-8 md:py-8 md:px-16 lg:px-32">
            {{-- head details --}}
            <h3
                class="text-sm sm:text-base md:text-lg font-medium text-gray-600 dark:text-text-dark-primary text-center uppercase">
                recipe by {{ $recipe->user->name }}
            </h3>
            <h1
                class="mt-2 text-2xl sm:text-3xl md:text-4xl lg:text-5xl xl:text-6xl font-bold font-display text-center dark:text-text-dark-primary px-2">
                {{ $recipe->name }}
            </h1>
            <div class="mt-4 sm:mt-6 md:mt-8 flex items-center justify-center">
                <div
                    class="w-full sm:w-[90%] md:w-[80%] lg:w-[60%] h-auto grid grid-cols-2 md:grid-cols-4 gap-2 md:gap-0">
                    <div
                        class="border border-gray-200 dark:border-gray-700 md:border-t md:border-b md:border-l-0 md:border-r-0 flex justify-center items-center p-3 md:p-0 md:h-28 text-sm sm:text-base md:text-lg">
                        <div class="text-center">
                            <i class="fa-solid fa-sliders text-yellow-500 mb-1 md:mb-0"></i>
                            <p
                                class="font-medium capitalize dark:text-text-dark-primary text-xs sm:text-sm md:text-base">
                                {{ $recipe->difficulty }}</p>
                        </div>
                    </div>
                    <div
                        class="border border-gray-200 dark:border-gray-700 flex justify-center items-center p-3 md:p-0 md:h-28 text-sm sm:text-base md:text-lg">
                        <div class="text-center">
                            <i class="fa-regular fa-clock text-blue-500 mb-1 md:mb-0"></i>
                            <p class="font-medium dark:text-text-dark-primary text-xs sm:text-sm md:text-base">
                                {{ $recipe->cooking_time }} min</p>
                        </div>
                    </div>
                    <div
                        class="border border-gray-200 dark:border-gray-700 flex justify-center items-center p-3 md:p-0 md:h-28 text-sm sm:text-base md:text-lg col-span-2 md:col-span-1">
                        <div class="text-center py-2">
                            <i class="fa-solid fa-fire-flame-curved text-orange-500 text-lg sm:text-xl mb-2"></i>
                            @if ($recipe->calories)
                                <div class="flex justify-center">
                                    <div class="px-1.5 flex flex-col border-r border-gray-200 dark:border-gray-700">
                                        <span
                                            class="font-bold text-sm sm:text-base md:text-lg text-primary dark:text-text-dark-primary">{{ $recipe->calories }}</span>
                                        <span
                                            class="text-xs text-gray-600 dark:text-text-dark-primary font-medium">Total
                                            Kkal</span>
                                    </div>
                                    <div class="px-1.5 flex flex-col">
                                        <span
                                            class="font-bold text-sm sm:text-base md:text-lg text-primary dark:text-text-dark-primary">{{ floor($recipe->calories / $recipe->servings) }}</span>
                                        <span
                                            class="text-xs text-gray-600 dark:text-text-dark-primary font-medium">Kkal/Porsi</span>
                                    </div>
                                </div>
                            @else
                                <span
                                    class="text-xs sm:text-sm text-gray-400 dark:text-text-dark-primary font-medium">Tidak
                                    ada
                                    info kalori</span>
                            @endif
                        </div>
                    </div>
                    <div
                        class="border border-gray-200 dark:border-gray-700 md:border-t md:border-b md:border-l-0 md:border-r-0 flex justify-center items-center p-3 md:p-0 md:h-28 text-sm sm:text-base md:text-lg col-span-2 md:col-span-1">
                        <div class="text-center">
                            <i class="fa-solid fa-bowl-food text-orange-500 mb-1 md:mb-0"></i>
                            <p class="font-medium dark:text-text-dark-primary text-xs sm:text-sm md:text-base">
                                {{ $recipe->servings }} porsi</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-4 sm:mt-6 flex justify-center items-center">
                <p
                    class="w-full sm:w-3/4 md:w-2/3 lg:w-1/2 text-sm sm:text-base text-center font-medium text-gray-700 dark:text-text-dark-primary italic px-4">
                    {{ $recipe->description ?? 'Resep lezat yang siap untuk dimoderasi dan dinikmati oleh semua pengguna.' }}
                </p>
            </div>
            {{-- end head details --}}

            {{-- moderation status --}}
            <div class="mt-6 sm:mt-8 md:mt-10 flex justify-center items-center">
                <div
                    class="bg-gradient-to-r from-amber-50 to-orange-50 dark:from-amber-700 dark:to-orange-700 border-amber-200 dark:border-gray-700 rounded-2xl p-4 sm:p-6 w-full sm:w-3/4 md:w-2/3 lg:w-1/2">
                    <div class="text-center">
                        <div
                            class="inline-flex items-center px-4 py-2 sm:px-6 sm:py-3 text-white rounded-full text-sm sm:text-base font-semibold shadow-lg mb-3 sm:mb-4
                            @if ($recipe->moderation->status === 'approved') bg-gradient-to-r from-green-700 to-green-500
                            @elseif($recipe->moderation->status === 'rejected') 
                                bg-gradient-to-r from-red-500 to-orange-600
                            @else
                                bg-gradient-to-r from-amber-400 to-orange-400 @endif
                            ">
                            <i class="fa-solid fa-clock mr-1 sm:mr-2"></i>
                            <span class="hidden sm:inline">Status: {{ ucfirst($recipe->moderation->status) }}</span>
                            <span class="sm:hidden">{{ ucfirst($recipe->moderation->status) }}</span>
                        </div>
                        <p class="text-gray-600 dark:text-text-dark-primary text-sm sm:text-base font-medium px-2">
                            Diajukan oleh: <span
                                class="font-semibold text-gray-800 dark:text-text-dark-primary">{{ $recipe->user->name }}</span>
                        </p>
                        @if ($recipe->moderation?->notes)
                            <div class="mt-3 sm:mt-4 bg-white/70 p-3 sm:p-4 rounded-xl border border-white/50">
                                <p class="text-xs sm:text-sm font-semibold text-gray-600 mb-2">Catatan
                                    Moderator:</p>
                                <p class="text-gray-700 text-sm sm:text-base leading-relaxed">
                                    {{ $recipe->moderation->notes }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            {{-- end moderation status --}}

            {{-- moderation buttons --}}
            @if ($recipe->moderation->status === 'pending')
                <div
                    class="mt-6 sm:mt-8 flex flex-col sm:flex-row justify-center items-center space-y-3 sm:space-y-0 sm:space-x-4 px-4">
                    <button wire:click="handleApproveRecipe"
                        class="w-full sm:w-auto px-6 sm:px-8 py-3 bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-600 hover:to-emerald-700 text-white text-sm sm:text-base font-semibold rounded-full shadow-lg transition-all duration-300 hover:shadow-xl">
                        <i class="fa-solid fa-check pe-2 text-sm sm:text-base"></i>
                        Setujui Resep
                    </button>
                    <button wire:click='handleOpenFormRejection'
                        class="w-full sm:w-auto px-6 sm:px-8 py-3 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white text-sm sm:text-base font-semibold rounded-full shadow-lg transition-all duration-300 hover:shadow-xl">
                        <i class="fa-solid fa-times pe-2 text-sm sm:text-base"></i>
                        Tolak Resep
                    </button>
                </div>
            @elseif ($recipe->moderation->status === 'approved')
                <div class="mt-6 sm:mt-8 flex justify-center items-center px-4">
                    <button wire:click="handleOpenFormRejection"
                        class="w-full sm:w-auto px-6 sm:px-8 py-3 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white text-sm sm:text-base font-semibold rounded-full shadow-lg transition-all duration-300 hover:shadow-xl">
                        <i class="fa-solid fa-times pe-2 text-sm sm:text-base"></i>
                        Batalkan Pengajuan
                    </button>
                </div>
            @elseif ($recipe->moderation->status === 'rejected')
                <div
                    class="mt-6 sm:mt-8 flex flex-col sm:flex-row justify-center items-center space-y-3 sm:space-y-0 sm:space-x-4 px-4">
                    <button wire:click="handleApproveRecipe"
                        class="w-full sm:w-auto px-6 sm:px-8 py-3 bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-600 hover:to-emerald-700 text-white text-sm sm:text-base font-semibold rounded-full shadow-lg transition-all duration-300 hover:shadow-xl">
                        <i class="fa-solid fa-check pe-2 text-sm sm:text-base"></i>
                        Setujui Resep
                    </button>
                    <button wire:click="handleOpenDetailRejection"
                        class="w-full sm:w-auto px-6 sm:px-8 py-3 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white text-sm sm:text-base font-semibold rounded-full shadow-lg transition-all duration-300 hover:shadow-xl">
                        <i class="fa-solid fa-eye pe-2 text-sm sm:text-base"></i>
                        <span class="hidden sm:inline">Lihat Alasan Penolakan</span>
                        <span class="sm:hidden">Lihat Alasan</span>
                    </button>
                </div>
            @endif
            {{-- end moderation buttons --}}

            {{-- recipe ingredients & steps --}}
            <div class="mt-8 sm:mt-10 md:mt-12 flex flex-col lg:flex-row lg:space-x-4 space-y-6 lg:space-y-0">
                <div class="w-full lg:w-[40%]">
                    <h2 class="text-xl sm:text-2xl font-display font-medium text-gray-800 dark:text-text-dark-primary">
                        Bahan Masakan
                    </h2>
                    <ul
                        class="mt-3 w-full lg:w-[80%] text-sm sm:text-base md:text-lg text-gray-700 dark:text-text-dark-primary space-y-3 font-normal">
                        @foreach ($recipe->ingredients as $ingredient)
                            <li class="pb-2 border-b border-gray-200 dark:border-gray-700"><i
                                    class="fa-solid fa-circle-check pe-2 text-sm"></i>
                                {{ $ingredient->pivot->amount . ' ' . $ingredient->pivot->unit . ' ' . $ingredient->name }}
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="w-full lg:w-[60%]">
                    <h2 class="text-xl sm:text-2xl font-display font-medium text-gray-800 dark:text-text-dark-primary">
                        Langkah Pembuatan
                    </h2>
                    <ul
                        class="mt-3 text-sm sm:text-base md:text-lg text-gray-700 dark:text-text-dark-primary space-y-4 font-normal">
                        @foreach ($recipe->steps as $step)
                            <li class="pb-3 flex space-x-2 border-b border-gray-200 dark:border-gray-700">
                                <p class="text-sm sm:text-base font-normal pt-1 flex items-start">
                                    <span
                                        class="text-3xl sm:text-4xl md:text-5xl font-display font pe-2 sm:pe-3 text-gray-800 dark:text-text-dark-primary flex-shrink-0">{{ $loop->iteration }}</span>
                                    <span class="pt-1">
                                        {{ $step->description }}
                                    </span>
                                </p>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            {{-- end recipe ingredients & steps --}}
        </div>
    </div>

    {{-- form rejection modal --}}
    <div x-show="$wire.showFormRejection" class="relative z-50" aria-labelledby="modal-title" role="dialog"
        aria-modal="true">
        <div class="fixed inset-0 bg-black/75 transition-opacity" aria-hidden="true"></div>

        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div
                    class="relative transform overflow-hidden rounded-lg bg-white dark:bg-bg-dark-primary text-left shadow-xl transition-all sm:my-8 w-full sm:max-w-lg mx-4 sm:mx-0">
                    <div class="bg-white dark:bg-bg-dark-primary">
                        <div
                            class="mb-0 border-b border-slate-200 dark:border-slate-700 py-3 px-4 flex justify-between items-center">
                            <h3 class="text-base sm:text-lg font-semibold dark:text-text-dark-primary">
                                Form Penolakan Resep
                            </h3>
                            <i wire:click='handleCloseFormRejection' wire:loading.remove
                                wire:target='handleCloseFormRejection'
                                class="fa fa-solid fa-xmark text-base font-medium cursor-pointer dark:text-text-dark-primary"></i>
                            <div role="status" wire:loading wire:target="handleCloseFormRejection">
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
                        <div class="p-4">
                            <form wire:submit.prevent='handleRejectRecipe'>
                                <div class="mb-4">
                                    <label for="reason"
                                        class="block text-sm font-medium text-gray-700 dark:text-text-dark-primary">Alasan
                                        Penolakan</label>
                                    <textarea wire:model='reason' id="reason" rows="4"
                                        class="mt-1 p-2 block w-full border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:ring-secondary focus:border-secondary text-sm font-normal dark:bg-bg-dark-primary dark:text-text-dark-primary"
                                        placeholder="Masukkan alasan penolakan resep"></textarea>
                                    @error('reason')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="flex justify-end space-x-2">
                                    <button type="button" wire:click='handleCloseFormRejection'
                                        class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-gray-500 hover:bg-gray-600">
                                        Batal
                                    </button>
                                    <button type="submit"
                                        class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-primary hover:bg-primary-hover">
                                        Lanjutkan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- detail rejection modal --}}
    <div x-show="$wire.showDetailRejection" class="relative z-50" aria-labelledby="modal-title" role="dialog"
        aria-modal="true">
        <div class="fixed inset-0 bg-black/75 transition-opacity" aria-hidden="true"></div>

        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div
                    class="relative transform overflow-hidden rounded-lg bg-white dark:bg-bg-dark-primary text-left shadow-xl transition-all sm:my-8 w-full sm:max-w-lg mx-4 sm:mx-0">
                    <div class="bg-white dark:bg-bg-dark-primary">
                        <div
                            class="mb-0 border-b border-slate-200 dark:border-slate-700 py-3 px-4 flex justify-between items-center">
                            <h3 class="text-base sm:text-lg font-semibold dark:text-text-dark-primary">
                                Detail Penolakan Resep
                            </h3>
                            <i wire:click='handleCloseDetailRejection' wire:loading.remove
                                wire:target='handleCloseDetailRejection'
                                class="fa fa-solid fa-xmark text-base font-medium cursor-pointer dark:text-text-dark-primary"></i>
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
                        <div class="p-4">
                            <div class="mb-4">
                                <label
                                    class="block text-sm font-medium text-gray-700 dark:text-text-dark-primary mb-2">Alasan
                                    Penolakan:</label>
                                <div
                                    class="p-3 bg-gray-50 dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-md">
                                    <p class="text-sm text-gray-700 dark:text-text-dark-primary leading-relaxed">
                                        {{ $recipe->moderation->notes ?? 'Tidak ada catatan penolakan.' }}
                                    </p>
                                </div>
                            </div>
                            <div class="flex justify-end">
                                <button type="button" wire:click='handleCloseDetailRejection'
                                    class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-gray-500 hover:bg-gray-600">
                                    Tutup
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
