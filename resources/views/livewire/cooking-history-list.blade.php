    <div class="mt-16 mx-auto">

        {{-- Filters Section --}}
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6 md:mb-10">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                {{-- Search --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-search mr-1"></i>
                        Cari Resep
                    </label>
                    <input type="text" wire:model.live.debounce.300ms="search" placeholder="Masukkan nama resep..."
                        class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                </div>

                {{-- Filter by Date --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-calendar mr-1"></i>
                        Filter Waktu
                    </label>
                    <select wire:model.live="filterBy"
                        class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                        <option value="all">Semua Waktu</option>
                        <option value="today">Hari Ini</option>
                        <option value="week">Minggu Ini</option>
                        <option value="month">Bulan Ini</option>
                    </select>
                </div>

                {{-- Sort --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-sort mr-1"></i>
                        Urutkan
                    </label>
                    <select wire:model.live="sortBy"
                        class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                        <option value="latest">Terbaru</option>
                        <option value="oldest">Terlama</option>
                        <option value="recipe_name">Nama Resep</option>
                    </select>
                </div>
            </div>
        </div>

        {{-- Loading State --}}
        <div class="flex justify-center items-center">
            <div wire:loading.delay>
                <div class="flex items-center py-8">
                    <i class="fas fa-spinner fa-spin text-2xl text-primary"></i>
                    <span class="ml-2 text-gray-600">Memuat...</span>
                </div>
            </div>
        </div>

        {{-- Content --}}
        <div wire:loading.remove>
            @if ($histories->count() > 0)
                {{-- Recipe Grid --}}
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-8">
                    @foreach ($histories as $history)
                        <div
                            class="group bg-white rounded-xl shadow-md hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300 overflow-hidden border border-gray-100">
                            {{-- Recipe Image --}}
                            <div class="relative h-56 bg-gray-200 overflow-hidden">
                                @if ($history->recipe->image)
                                    <img src="{{ $history->recipe->image }}" alt="{{ $history->recipe->name }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <i class="fas fa-utensils text-5xl text-gray-400"></i>
                                    </div>
                                @endif

                                {{-- Remove Button --}}
                                <button wire:click="removeFromHistory({{ $history->id }})"
                                    wire:confirm="Hapus dari riwayat?"
                                    class="absolute top-3 right-3 w-9 h-9 bg-red-500 hover:bg-red-600 text-white rounded-full flex items-center justify-center transition-all duration-200 opacity-0 group-hover:opacity-100 transform translate-x-2 group-hover:translate-x-0">
                                    <i class="fas fa-times"></i>
                                </button>

                                {{-- Category Badge --}}
                                @if ($history->recipe->category)
                                    <div class="absolute top-3 left-3">
                                        <span
                                            class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-medium bg-primary/90 text-white backdrop-blur-sm">
                                            <i class="fas fa-tag mr-1.5"></i>
                                            {{ $history->recipe->category->name }}
                                        </span>
                                    </div>
                                @endif
                            </div>

                            {{-- Recipe Info --}}
                            <div class="p-5">
                                <h3 class="font-bold text-gray-900 text-lg mb-3 line-clamp-2">
                                    <a href="{{ route('history.show', $history->recipe->id) }}"
                                        class="hover:text-primary transition-colors duration-200">
                                        {{ $history->recipe->name }}
                                    </a>
                                </h3>

                                <div class="space-y-2 mb-4">
                                    <div class="flex items-center text-sm text-gray-600">
                                        <i class="fas fa-user-chef text-primary mr-2"></i>
                                        <span>{{ $history->recipe->user->name }}</span>
                                    </div>

                                    <div class="flex items-center text-sm text-gray-600">
                                        <i class="fas fa-history text-primary mr-2"></i>
                                        <span>Dimasak {{ $history->cooked_at->diffForHumans() }}</span>
                                    </div>
                                </div>

                                @if ($history->notes)
                                    <div class="bg-gray-50 rounded-lg p-3 mb-4 border-l-4 border-primary">
                                        <p class="text-sm text-gray-700 italic">
                                            <i class="fas fa-quote-left text-primary mr-2"></i>
                                            {{ $history->notes }}
                                        </p>
                                    </div>
                                @endif

                                {{-- Action Buttons --}}
                                <div class="flex space-x-2">
                                    <a href="{{ route('history.show', $history->recipe->id) }}"
                                        class="flex-1 bg-primary hover:bg-primary-hover text-white text-center py-2.5 px-4 rounded-lg text-sm font-medium transition-all duration-200 transform hover:scale-[1.02] flex items-center justify-center">
                                        Lihat Resep
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Pagination --}}
                <div class="flex justify-center">
                    {{ $histories->links() }}
                </div>
            @else
                {{-- Empty State --}}
                <div class="text-center py-16">
                    <div class="mx-auto w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-history text-4xl text-gray-400"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">
                        @if ($search || $filterBy !== 'all')
                            Tidak ada riwayat yang ditemukan
                        @else
                            Belum ada riwayat masak
                        @endif
                    </h3>
                    <p class="text-gray-500 mb-6">
                        @if ($search || $filterBy !== 'all')
                            Coba ubah filter pencarian Anda
                        @else
                            Mulai masak resep favorit Anda dan riwayat akan muncul di sini
                        @endif
                    </p>
                    @if (!$search && $filterBy === 'all')
                        <a href="{{ route('explore-recipes.index') }}"
                            class="inline-flex items-center px-6 py-3 bg-primary hover:bg-primary-hover text-white font-medium rounded-lg transition-colors duration-200">
                            <i class="fas fa-search mr-2"></i>
                            Jelajahi Resep
                        </a>
                    @endif
                </div>
            @endif
        </div>
    </div>
