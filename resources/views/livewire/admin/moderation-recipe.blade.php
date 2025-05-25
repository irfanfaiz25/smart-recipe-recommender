{{-- recipe moderation section here --}}
<div>
    <!-- Search and Filter Section -->
    <div class="flex justify-between items-center mb-6">
        <div class="w-1/3">
            <div class="relative">
                <input type="text" placeholder="Cari resep ..." wire:model.live.debounce.300ms="search"
                    class="w-full bg-white dark:bg-bg-dark-primary placeholder:text-slate-400 text-text-primary dark:text-text-dark-primary text-sm border border-gray-200 dark:border-[#393939] rounded-full pl-10 pr-4 py-2.5 transition duration-300 ease focus:outline-none focus:border-secondary focus:ring-2 focus:ring-secondary/20 hover:border-gray-300 shadow-md">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fa-solid fa-magnifying-glass text-gray-400"></i>
                </div>
            </div>
        </div>
        <div class="flex space-x-3">
            <select wire:model.live.debounce.300ms="status"
                class="bg-white dark:bg-bg-dark-primary text-text-primary dark:text-text-dark-primary text-sm border border-gray-200 dark:border-[#393939] rounded-full px-4 py-2.5 transition duration-300 ease focus:outline-none focus:border-secondary focus:ring-2 focus:ring-secondary/20 hover:border-gray-300 shadow-md">
                <option value="all">All</option>
                <option value="pending" selected>Pending</option>
                <option value="approved">Approved</option>
                <option value="rejected">Rejected</option>
            </select>
        </div>
    </div>

    {{-- recipe moderation --}}
    <div class="mt-16 grid grid-cols-1 md:grid-cols-3 gap-4">
        @forelse ($recipes as $recipe)
            <div
                class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden hover:shadow-xl transition-all duration-300 group">
                <div class="flex flex-col">
                    <!-- Recipe Image -->
                    <div class="h-52 relative overflow-hidden">
                        @if ($recipe->image)
                            <img src="{{ asset($recipe->image) }}" alt="Nasi Goreng Special"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="w-full h-full bg-gray-100 flex justify-center items-center">
                                <i class="fa fa-utensils text-base text-gray-500"></i>
                            </div>
                        @endif
                        <div
                            class="w-full h-full opacity-0 group-hover:opacity-100 absolute top-0 bg-gradient-to-t from-black/20 via-black/10 to-transparent transition-opacity duration-500">
                        </div>
                        <div class="absolute top-4 left-4">
                            @switch($recipe->moderation->status)
                                @case('pending')
                                    <span class="bg-yellow-500 text-white px-3 py-1 rounded-full text-xs font-medium">
                                        <i class="fa-solid fa-clock mr-1"></i>
                                        Pending
                                    </span>
                                @break

                                @case('approved')
                                    <span class="bg-primary text-white px-3 py-1 rounded-full text-xs font-medium">
                                        <i class="fa fa-circle-check mr-1"></i>
                                        Approved by
                                        <span class="capitalize">
                                            {{ $recipe->moderation->approver ? $recipe->moderation->approver->name : '' }}
                                        </span>
                                    </span>
                                @break

                                @case('rejected')
                                    <span class="bg-rose-500 text-white px-3 py-1 rounded-full text-xs font-medium">
                                        <i class="fa fa-circle-xmark mr-1"></i>
                                        Rejected by
                                        <span class="capitalize">
                                            {{ $recipe->moderation->approver ? $recipe->moderation->approver->name : '' }}
                                        </span>
                                    </span>
                                @break

                                @default
                            @endswitch
                        </div>
                        <div
                            class="opacity-0 group-hover:opacity-100 absolute bottom-3 right-4 transition-opacity duration-500">
                            <span class="bg-secondary text-white px-3 py-1 rounded-full text-xs font-medium">
                                {{ $recipe->category->name }}
                            </span>
                        </div>
                        <a href="{{ route('admin-moderation.show', $recipe->id) }}" wire:navigate
                            class="opacity-0 group-hover:opacity-100 absolute bottom-3 left-4 bg-gray-50 hover:bg-gray-100 text-secondary px-4 py-1.5 rounded-full text-xs font-medium transition-all duration-500">
                            <i class="fa-solid fa-eye mr-1"></i>
                            Detail
                        </a>
                    </div>

                    <!-- Recipe Details -->
                    <div class="p-5">
                        <div class="mb-3">
                            <h3 class="text-lg font-bold text-gray-900 mb-2">
                                {{ $recipe->name }}
                            </h3>
                            <div class="flex items-center text-gray-600 text-sm">
                                <i class="fa-solid fa-user mr-2"></i>
                                <span class="font-medium">
                                    {{ $recipe->user->name }}
                                </span>
                                <span class="mx-2">•</span>
                                <span class="font-medium">
                                    {{ $recipe->created_at->diffForHumans() }}
                                </span>
                            </div>
                        </div>

                        <div class="flex items-center gap-3 text-xs font-medium text-gray-600 mb-3">
                            <div class="flex items-center">
                                <i class="fa-solid fa-clock mr-1 text-secondary"></i>
                                <span>{{ $recipe->cooking_time }} menit</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fa-solid fa-users mr-1 text-green-500"></i>
                                <span>{{ $recipe->servings }} porsi</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fa-solid fa-signal mr-1 text-yellow-500"></i>
                                <span>{{ $recipe->difficulty }}</span>
                            </div>
                            {{-- Calories --}}
                            <div class="flex items-center">
                                <i class="fa-solid fa-fire-flame-curved mr-1 text-rose-500"></i>
                                <span>
                                    {{ $recipe->calories }} kkal |
                                    {{ floor($recipe->calories / $recipe->servings) }}
                                    kkal/porsi
                                </span>
                            </div>
                        </div>

                        <p class="text-gray-700 mb-4 text-sm line-clamp-2">
                            {{ $recipe->description }}
                        </p>

                        <!-- Recipe Stats -->
                        {{-- <div class="grid grid-cols-3 gap-2 mb-4">
                        <div class="bg-blue-50 rounded-lg p-2 text-center">
                            <div class="text-sm font-bold text-blue-600">12</div>
                            <div class="text-xs text-blue-500">Bahan</div>
                        </div>
                        <div class="bg-green-50 rounded-lg p-2 text-center">
                            <div class="text-sm font-bold text-green-600">8</div>
                            <div class="text-xs text-green-500">Langkah</div>
                        </div>
                        <div class="bg-orange-50 rounded-lg p-2 text-center">
                            <div class="text-sm font-bold text-orange-600">450</div>
                            <div class="text-xs text-orange-500">Kalori</div>
                        </div>
                    </div> --}}

                        <!-- Action Buttons -->
                        <div class="flex gap-2">
                            @if ($recipe->moderation->status === 'pending')
                                <button wire:click='handleApproveRecipe({{ $recipe->id }})'
                                    class="flex-1 bg-primary hover:bg-primary-hover text-white px-5 py-2.5 rounded-lg text-sm font-medium transition-colors">
                                    <i class="fa-solid fa-check mr-1"></i>
                                    Setujui
                                </button>
                                <button wire:click="handleOpenFormRejection({{ $recipe->id }})"
                                    class="flex-1 bg-red-500 hover:bg-red-600 text-white px-5 py-2.5 rounded-lg text-sm font-medium transition-colors">
                                    <i class="fa-solid fa-times mr-1"></i>
                                    Tolak
                                </button>
                            @elseif ($recipe->moderation->status === 'rejected')
                                <button wire:click="handleOpenDetailRejection({{ $recipe->id }})"
                                    class="flex-1 bg-red-50 hover:bg-red-100 border border-red-100 hover:border-red-200 text-red-700 px-5 py-2.5 rounded-lg text-sm font-medium transition-colors">
                                    <i class="fa-solid fa-circle-info mr-1"></i>
                                    Detail Penolakan
                                </button>
                                <button wire:click="handleApproveRecipe({{ $recipe->id }})"
                                    class="bg-primary hover:bg-primary-hover text-white px-5 py-2.5 rounded-lg text-sm font-medium transition-colors">
                                    <i class="fa-solid fa-circle-check mr-1"></i>
                                    Setujui
                                </button>
                            @elseif ($recipe->moderation->status === 'approved')
                                <button
                                    class="flex-1 bg-green-50 border border-green-100 text-green-700 px-5 py-2.5 rounded-lg text-sm font-medium transition-colors"
                                    disabled>
                                    <i class="fa-solid fa-circle-check mr-1"></i>
                                    Disetujui
                                </button>
                                <button wire:click="handleOpenFormRejection({{ $recipe->id }})"
                                    class="bg-red-500 hover:bg-red-600 text-white px-5 py-2.5 rounded-lg text-sm font-medium transition-colors">
                                    <i class="fa-solid fa-circle-xmark mr-1"></i>
                                    Tolak
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @empty
                <div class="col-span-3 text-center">
                    <i class="fa-solid fa-circle-info text-5xl text-gray-400 mb-3"></i>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Tidak ada resep yang perlu moderasi</h3>
                </div>
            @endforelse
        </div>

        {{-- pagination --}}
        <div class="mt-8">
            {{ $recipes->links('vendor.livewire.tailwind') }}
        </div>

        {{-- form rejection modal --}}
        <div x-show="$wire.showFormRejection" class="relative z-50" aria-labelledby="modal-title" role="dialog"
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
                                    Form Penolakan Resep
                                </h3>
                                <i wire:click='handleCloseFormRejection' wire:loading.remove
                                    wire:target='handleCloseFormRejection'
                                    class="fa fa-solid fa-xmark text-base font-medium cursor-pointer"></i>
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
                                        <label for="reason" class="block text-sm font-medium text-gray-700">Alasan
                                            Penolakan</label>
                                        <textarea wire:model='reason' id="reason" rows="4"
                                            class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-secondary focus:border-secondary text-sm font-normal"
                                            placeholder="Masukkan alasan penolakan resep"></textarea>
                                        @error('reason')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="flex justify-end space-x-2">
                                        <button type="button" wire:click='handleCloseFormRejection'
                                            class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-gray-500 hover:bg-gray-600">
                                            Batal
                                        </button>
                                        <button type="submit"
                                            class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-primary hover:bg-primary-hover">
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
