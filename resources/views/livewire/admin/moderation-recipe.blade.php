{{-- recipe moderation section here --}}
<div>
    <!-- Search and Filter Section -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 md:gap-6 mb-6">
        <div class="w-full md:w-1/3">
            <div class="relative">
                <input type="text" placeholder="Cari resep ..." wire:model.live.debounce.300ms="search"
                    class="w-full bg-white dark:bg-bg-dark-primary placeholder:text-slate-400 text-text-primary dark:text-text-dark-primary text-sm border border-gray-200 dark:border-[#393939] rounded-full pl-10 pr-4 py-2.5 transition duration-300 ease focus:outline-none focus:border-secondary focus:ring-2 focus:ring-secondary/20 hover:border-gray-300 shadow-md">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fa-solid fa-magnifying-glass text-gray-400"></i>
                </div>
            </div>
        </div>
        <div class="w-full md:w-auto">
            <select wire:model.live.debounce.300ms="status"
                class="w-full md:w-auto bg-white dark:bg-bg-dark-primary text-text-primary dark:text-text-dark-primary text-sm border border-gray-200 dark:border-[#393939] rounded-full px-4 py-2.5 transition duration-300 ease focus:outline-none focus:border-secondary focus:ring-2 focus:ring-secondary/20 hover:border-gray-300 shadow-md">
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
                class="bg-white dark:bg-bg-dark-primary rounded-2xl shadow-lg border border-gray-100 dark:border-[#393939] overflow-hidden hover:shadow-xl transition-all duration-300 group">
                <div class="flex flex-col">
                    <!-- Recipe Image -->
                    <div class="h-52 relative overflow-hidden">
                        @if ($recipe->image)
                            <img src="{{ $recipe->image }}" alt="Nasi Goreng Special"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="w-full h-full bg-gray-100 dark:bg-[#2b2b2b] flex justify-center items-center">
                                <i class="fa fa-utensils text-base text-gray-500 dark:text-gray-400"></i>
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
                            class="opacity-0 group-hover:opacity-100 absolute bottom-3 left-4 bg-gray-50 dark:bg-[#2b2b2b] hover:bg-gray-100 dark:hover:bg-[#3b3b3b] text-secondary px-4 py-1.5 rounded-full text-xs font-medium transition-all duration-500">
                            <i class="fa-solid fa-eye mr-1"></i>
                            Detail
                        </a>
                    </div>

                    <!-- Recipe Details -->
                    <div class="p-5">
                        <div class="mb-3">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-text-dark-primary mb-2">
                                {{ $recipe->name }}
                            </h3>
                            <div class="flex items-center text-gray-600 dark:text-gray-400 text-sm">
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

                        <div class="flex items-center gap-3 text-xs font-medium text-gray-600 dark:text-gray-400 mb-3">
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
                                    {{ floor($recipe->calories / $recipe->servings) }}
                                    kkal
                                </span>
                            </div>
                        </div>

                        <p class="text-gray-700 dark:text-gray-300 mb-4 text-sm line-clamp-1">
                            {{ $recipe->description }}
                        </p>

                        <!-- Action Buttons -->
                        <div class="flex gap-2">
                            @if ($recipe->moderation->status === 'pending')
                                <button wire:click='handleApproveRecipe({{ $recipe->id }})'
                                    wire:loading.attr="disabled"
                                    class="flex-1 bg-primary hover:bg-primary-hover text-white px-5 py-2.5 rounded-lg text-sm font-medium transition-colors">
                                    <i class="fa-solid fa-check mr-1" wire:loading.remove
                                        wire:target="handleApproveRecipe({{ $recipe->id }})"></i>
                                    <i class="fa-solid fa-spinner fa-spin mr-1" wire:loading
                                        wire:target="handleApproveRecipe({{ $recipe->id }})"></i>
                                    Setujui
                                </button>
                                <button wire:click="handleOpenFormRejection({{ $recipe->id }})"
                                    wire:loading.attr="disabled"
                                    class="flex-1 bg-red-500 hover:bg-red-600 text-white px-5 py-2.5 rounded-lg text-sm font-medium transition-colors">
                                    <i class="fa-solid fa-times mr-1" wire:loading.remove
                                        wire:target="handleOpenFormRejection({{ $recipe->id }})"></i>
                                    <i class="fa-solid fa-spinner fa-spin mr-1" wire:loading
                                        wire:target="handleOpenFormRejection({{ $recipe->id }})"></i>
                                    Tolak
                                </button>
                            @elseif ($recipe->moderation->status === 'rejected')
                                <button wire:click="handleOpenDetailRejection({{ $recipe->id }})"
                                    wire:loading.attr="disabled"
                                    class="flex-1 bg-red-50 dark:bg-red-500/10 hover:bg-red-100 dark:hover:bg-red-500/20 border border-red-100 dark:border-red-500/20 hover:border-red-200 dark:hover:border-red-500/30 text-red-700 dark:text-red-400 px-5 py-2.5 rounded-lg text-sm font-medium transition-colors">
                                    <i class="fa-solid fa-circle-info mr-1" wire:loading.remove
                                        wire:target="handleOpenDetailRejection({{ $recipe->id }})"></i>
                                    <i class="fa-solid fa-spinner fa-spin mr-1" wire:loading
                                        wire:target="handleOpenDetailRejection({{ $recipe->id }})"></i>
                                    Detail Penolakan
                                </button>
                                <button wire:click="handleApproveRecipe({{ $recipe->id }})"
                                    wire:loading.attr="disabled"
                                    class="bg-primary hover:bg-primary-hover text-white px-5 py-2.5 rounded-lg text-sm font-medium transition-colors">
                                    <i class="fa-solid fa-circle-check mr-1" wire:loading.remove
                                        wire:target="handleApproveRecipe({{ $recipe->id }})"></i>
                                    <i class="fa-solid fa-spinner fa-spin mr-1" wire:loading
                                        wire:target="handleApproveRecipe({{ $recipe->id }})"></i>
                                    Setujui
                                </button>
                            @elseif ($recipe->moderation->status === 'approved')
                                <button
                                    class="flex-1 bg-green-50 dark:bg-green-500/10 border border-green-100 dark:border-green-500/20 text-green-700 dark:text-green-400 px-5 py-2.5 rounded-lg text-sm font-medium transition-colors"
                                    disabled>
                                    <i class="fa-solid fa-circle-check mr-1"></i>
                                    Disetujui
                                </button>
                                <button wire:click="handleOpenFormRejection({{ $recipe->id }})"
                                    wire:loading.attr="disabled"
                                    class="bg-red-500 hover:bg-red-600 text-white px-5 py-2.5 rounded-lg text-sm font-medium transition-colors">
                                    <i class="fa-solid fa-circle-xmark mr-1" wire:loading.remove
                                        wire:target="handleOpenFormRejection({{ $recipe->id }})"></i>
                                    <i class="fa-solid fa-spinner fa-spin mr-1" wire:loading
                                        wire:target="handleOpenFormRejection({{ $recipe->id }})"></i>
                                    Tolak
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @empty
                <div class="col-span-3 text-center">
                    <i class="fa-solid fa-circle-info text-5xl text-gray-400 dark:text-gray-500 mb-3"></i>
                    <h3 class="text-lg font-bold text-gray-900 dark:text-text-dark-primary mb-2">Tidak ada resep yang perlu
                        moderasi</h3>
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
                        class="relative transform overflow-hidden rounded-lg bg-white dark:bg-bg-dark-primary text-left shadow-xl transition-all w-full mx-4 sm:mx-0 sm:my-8 sm:max-w-lg">
                        <div class="bg-white dark:bg-bg-dark-primary">
                            <div
                                class="mb-0 border-b border-slate-200 dark:border-slate-700 py-3 px-4 sm:px-6 flex justify-between items-center">
                                <h3 class="text-base sm:text-lg font-semibold text-gray-900 dark:text-gray-100">
                                    Form Penolakan Resep
                                </h3>
                                <button wire:click='handleCloseFormRejection'
                                    class="text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-secondary">
                                    <i class="fa fa-solid fa-xmark text-base font-medium" wire:loading.remove
                                        wire:target="handleCloseFormRejection"></i>
                                    <i class="fa fa-solid fa-spinner fa-spin text-base font-medium" wire:loading
                                        wire:target="handleCloseFormRejection"></i>
                                </button>
                            </div>
                            <div class="p-4 sm:p-6">
                                <form wire:submit.prevent='handleRejectRecipe' class="space-y-4">
                                    <div>
                                        <label for="reason"
                                            class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">
                                            Alasan Penolakan
                                        </label>
                                        <textarea wire:model='reason' id="reason" rows="4"
                                            class="w-full rounded-md border border-gray-300 dark:border-gray-600 shadow-sm px-4 py-2 bg-white dark:bg-bg-dark-primary text-gray-900 dark:text-gray-100 text-sm focus:ring-2 focus:ring-secondary focus:border-secondary transition duration-200"
                                            placeholder="Masukkan alasan penolakan resep"></textarea>
                                        @error('reason')
                                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-2 sm:gap-3 mt-6">
                                        <button type="button" wire:click='handleCloseFormRejection'
                                            class="w-full sm:w-auto px-4 py-2.5 border border-gray-300 dark:border-gray-600 text-sm font-medium rounded-lg text-gray-700 dark:text-gray-200 bg-white dark:bg-bg-dark-primary hover:bg-gray-50 dark:hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-secondary transition duration-200">
                                            Batal
                                        </button>
                                        <button type="submit"
                                            class="w-full sm:w-auto px-4 py-2.5 text-sm font-medium rounded-lg text-white bg-primary hover:bg-primary-hover focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition duration-200">
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
                        class="relative transform overflow-hidden rounded-lg bg-white dark:bg-bg-dark-primary text-left shadow-xl transition-all w-full mx-4 sm:mx-0 sm:my-8 sm:w-full sm:max-w-lg">
                        <div class="bg-white dark:bg-bg-dark-primary">
                            <div
                                class="mb-0 border-b border-slate-200 dark:border-slate-700 py-3 px-4 sm:px-6 flex justify-between items-center">
                                <h3 class="text-base sm:text-lg font-semibold text-gray-900 dark:text-gray-100">
                                    Detail Penolakan Resep
                                </h3>
                                <button wire:click='handleCloseDetailRejection'
                                    class="text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-secondary">
                                    <i class="fa fa-solid fa-xmark text-base font-medium" wire:loading.remove
                                        wire:target="handleCloseDetailRejection"></i>
                                    <i class="fa fa-solid fa-spinner fa-spin text-base font-medium" wire:loading
                                        wire:target="handleCloseDetailRejection"></i>
                                </button>
                            </div>

                            <div class="p-4 sm:p-6 space-y-4 sm:space-y-6">
                                <!-- Rejection Reason -->
                                <div
                                    class="bg-red-50 dark:bg-red-500/10 rounded-lg p-4 border border-red-100 dark:border-red-500/20">
                                    <div class="flex items-center mb-2">
                                        <i class="fa-solid fa-circle-exclamation text-red-500 mr-2"></i>
                                        <h4 class="font-semibold text-red-500 text-sm sm:text-base">Alasan Penolakan</h4>
                                    </div>
                                    <p class="text-red-700 dark:text-red-400 text-sm font-medium">
                                        {{ $rejectedRecipe?->moderation?->notes }}
                                    </p>
                                </div>

                                <!-- Rejection Details -->
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
                                    <div
                                        class="bg-gray-50 dark:bg-gray-800 rounded-lg p-4 border border-gray-100 dark:border-gray-700">
                                        <div class="flex items-center mb-2">
                                            <i class="fa-regular fa-calendar text-gray-600 dark:text-gray-400 mr-2"></i>
                                            <h4
                                                class="font-semibold text-gray-700 dark:text-gray-200 text-sm sm:text-base">
                                                Tanggal Penolakan</h4>
                                        </div>
                                        <p class="text-gray-600 dark:text-gray-400 text-sm font-medium">
                                            {{ $rejectedRecipe?->moderation?->updated_at->format('d M Y, H:i') }}
                                        </p>
                                    </div>

                                    <div
                                        class="bg-gray-50 dark:bg-gray-800 rounded-lg p-4 border border-gray-100 dark:border-gray-700">
                                        <div class="flex items-center mb-2">
                                            <i class="fa-regular fa-user text-gray-600 dark:text-gray-400 mr-2"></i>
                                            <h4
                                                class="font-semibold text-gray-700 dark:text-gray-200 text-sm sm:text-base">
                                                Moderator</h4>
                                        </div>
                                        <p class="text-gray-600 dark:text-gray-400 text-sm font-medium capitalize">
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
