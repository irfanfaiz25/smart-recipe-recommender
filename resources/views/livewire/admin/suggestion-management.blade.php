<div>
    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-6 gap-6 mb-8">
        <!-- Total Suggestions -->
        <div class="bg-white dark:bg-bg-dark-primary rounded-lg shadow-md p-6 border-l-4 border-blue-500">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-comments text-3xl text-blue-500"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600 dark:text-text-dark-primary">Total Data</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-text-dark-primary">
                        {{ number_format($totalSuggestions) }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Pending Suggestions -->
        <div class="bg-white dark:bg-bg-dark-primary rounded-lg shadow-md p-6 border-l-4 border-yellow-500">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-clock text-3xl text-yellow-500"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600 dark:text-text-dark-primary">Pending</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-text-dark-primary">
                        {{ number_format($pendingSuggestions) }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Reviewed Suggestions -->
        <div class="bg-white dark:bg-bg-dark-primary rounded-lg shadow-md p-6 border-l-4 border-blue-500">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-eye text-3xl text-blue-500"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600 dark:text-text-dark-primary">Direview</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-text-dark-primary">
                        {{ number_format($reviewedSuggestions) }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Implemented Suggestions -->
        <div class="bg-white dark:bg-bg-dark-primary rounded-lg shadow-md p-6 border-l-4 border-green-500">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-check-circle text-3xl text-green-500"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600 dark:text-text-dark-primary">Diimplementasikan</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-text-dark-primary">
                        {{ number_format($implementedSuggestions) }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Rejected Suggestions -->
        <div class="bg-white dark:bg-bg-dark-primary rounded-lg shadow-md p-6 border-l-4 border-red-500">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-times-circle text-3xl text-red-500"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600 dark:text-text-dark-primary">Ditolak</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-text-dark-primary">
                        {{ number_format($rejectedSuggestions) }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Average Rating -->
        <div class="bg-white dark:bg-bg-dark-primary rounded-lg shadow-md p-6 border-l-4 border-purple-500">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-star text-3xl text-purple-500"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600 dark:text-text-dark-primary">Rating Rata-Rata</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-text-dark-primary">
                        {{ number_format($averageRating, 1) }}/5
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Search and Filter Section -->
    <div class="bg-white dark:bg-bg-dark-primary rounded-lg shadow-md p-6 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-6 gap-4">
            <!-- Search Input -->
            <div class="lg:col-span-2">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-lg text-gray-400"></i>
                    </div>
                    <input type="text" wire:model.live.debounce.300ms="search"
                        class="block w-full text-sm font-medium pl-10 pr-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md leading-5 bg-white dark:bg-bg-dark-secondary placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Cari Data ...">
                </div>
            </div>

            <!-- Status Filter -->
            <div>
                <select wire:model.live="statusFilter"
                    class="block text-sm font-medium w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md leading-5 bg-white dark:bg-bg-dark-secondary focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Semua Status</option>
                    <option value="pending">Pending</option>
                    <option value="reviewed">Direview</option>
                    <option value="implemented">Diimplementasikan</option>
                    <option value="rejected">Ditolak</option>
                </select>
            </div>

            <!-- Feedback Type Filter -->
            <div>
                <select wire:model.live="feedbackTypeFilter"
                    class="block text-sm font-medium w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md leading-5 bg-white dark:bg-bg-dark-secondary focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Semua Tipe</option>
                    @foreach ($this->feedbackTypes as $type)
                        <option value="{{ $type }}">{{ ucfirst($type) }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Priority Filter -->
            <div>
                <select wire:model.live="priorityFilter"
                    class="block text-sm font-medium w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md leading-5 bg-white dark:bg-bg-dark-secondary focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Semua Prioritas</option>
                    <option value="low">Rendah</option>
                    <option value="medium">Sedang</option>
                    <option value="high">Tinggi</option>
                </select>
            </div>

            <button wire:click="loadStatistics"
                class="px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-text-dark-primary bg-white dark:bg-bg-dark-secondary hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <i class="fas fa-sync-alt mr-2"></i>
                Refresh
            </button>
        </div>
    </div>

    <!-- Suggestions Table -->
    <div class="bg-white dark:bg-bg-dark-primary rounded-lg shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-neutral-700">
                    <tr>
                        <th wire:click="sortBy('subject')"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider cursor-pointer">
                            <div class="flex items-center space-x-1">
                                <span>Subject</span>
                                @if ($sortBy === 'subject')
                                    <i
                                        class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} text-blue-500"></i>
                                @else
                                    <i class="fas fa-sort text-gray-400"></i>
                                @endif
                            </div>
                        </th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                            User
                        </th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                            Tipe
                        </th>
                        <th wire:click="sortBy('priority')"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider cursor-pointer">
                            <div class="flex items-center space-x-1">
                                <span>Prioritas</span>
                                @if ($sortBy === 'priority')
                                    <i
                                        class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} text-blue-500"></i>
                                @else
                                    <i class="fas fa-sort text-gray-400"></i>
                                @endif
                            </div>
                        </th>
                        <th wire:click="sortBy('rating')"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider cursor-pointer">
                            <div class="flex items-center space-x-1">
                                <span>Rating</span>
                                @if ($sortBy === 'rating')
                                    <i
                                        class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} text-blue-500"></i>
                                @else
                                    <i class="fas fa-sort text-gray-400"></i>
                                @endif
                            </div>
                        </th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                            Status
                        </th>
                        <th wire:click="sortBy('created_at')"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider cursor-pointer">
                            <div class="flex items-center space-x-1">
                                <span>Tanggal</span>
                                @if ($sortBy === 'created_at')
                                    <i
                                        class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} text-blue-500"></i>
                                @else
                                    <i class="fas fa-sort text-gray-400"></i>
                                @endif
                            </div>
                        </th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-bg-dark-primary divide-y divide-gray-200 dark:divide-neutral-700"
                    wire:loading.remove>
                    @forelse($this->suggestions as $suggestion)
                        <tr class="hover:bg-gray-50 dark:hover:bg-neutral-600">
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900 dark:text-neutral-200">
                                    {{ Str::limit($suggestion->subject, 40) }}
                                </div>
                                <div class="text-xs text-gray-500 dark:text-neutral-400">
                                    {{ Str::limit($suggestion->feedback_message, 60) }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($suggestion->user)
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-8 w-8">
                                            @if ($suggestion->user->avatar_url)
                                                <img class="h-8 w-8 rounded-full object-cover"
                                                    src="{{ $suggestion->user->avatar_url }}"
                                                    alt="{{ $suggestion->user->name }}">
                                            @else
                                                <div
                                                    class="h-8 w-8 rounded-full bg-gray-300 flex items-center justify-center dark:bg-neutral-700">
                                                    <i
                                                        class="fas fa-user text-xs text-gray-600 dark:text-neutral-200"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="ml-3">
                                            <div class="text-sm font-medium text-gray-900 dark:text-neutral-200">
                                                {{ $suggestion->user->name }}
                                            </div>
                                            <div class="text-xs text-gray-500 dark:text-neutral-400">
                                                {{ $suggestion->user->email }}
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="text-sm text-gray-900 dark:text-neutral-200">
                                        {{ $suggestion->name ?? 'Anonymous' }}
                                    </div>
                                    <div class="text-xs text-gray-500 dark:text-neutral-400">
                                        {{ $suggestion->email ?? 'No email' }}
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ ucfirst($suggestion->feedback_type) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                    @if ($suggestion->priority === 'high') bg-red-100 text-red-800
                                    @elseif($suggestion->priority === 'medium') bg-yellow-100 text-yellow-800
                                    @else bg-green-100 text-green-800 @endif">
                                    <i class="fas fa-flag mr-1"></i>
                                    {{ ucfirst($suggestion->priority) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i
                                            class="fas fa-star text-sm {{ $i <= $suggestion->rating ? 'text-yellow-400' : 'text-gray-300' }}"></i>
                                    @endfor
                                    <span class="ml-2 text-sm text-gray-600 dark:text-neutral-400">
                                        {{ $suggestion->rating }}/5
                                    </span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                    @if ($suggestion->status === 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($suggestion->status === 'reviewed') bg-blue-100 text-blue-800
                                    @elseif($suggestion->status === 'implemented') bg-green-100 text-green-800
                                    @else bg-red-100 text-red-800 @endif">
                                    @if ($suggestion->status === 'pending')
                                        <i class="fas fa-clock mr-1"></i>
                                    @elseif($suggestion->status === 'reviewed')
                                        <i class="fas fa-eye mr-1"></i>
                                    @elseif($suggestion->status === 'implemented')
                                        <i class="fas fa-check mr-1"></i>
                                    @else
                                        <i class="fas fa-times mr-1"></i>
                                    @endif
                                    {{ ucfirst($suggestion->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-neutral-400">
                                {{ $suggestion->created_at->format('M d, Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <button wire:click="showDetail({{ $suggestion->id }})"
                                    class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300">
                                    <i class="fas fa-eye mr-1"></i>
                                    Lihat
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center">
                                    <i class="fas fa-comments text-4xl text-gray-400 mb-4"></i>
                                    <h3 class="text-lg font-medium text-gray-900 dark:text-neutral-200 mb-2">
                                        Data tidak ditemukan
                                    </h3>
                                    <p class="text-sm font-normal text-gray-500 dark:text-neutral-400">
                                        Tidak ada data yang sesuai dengan filter yang Anda pilih.
                                    </p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if ($this->suggestions->hasPages())
            <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">
                {{ $this->suggestions->links() }}
            </div>
        @endif
    </div>

    <!-- Loading State -->
    <div wire:loading class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white dark:bg-bg-dark-primary rounded-lg p-6 flex items-center space-x-3">
            <i class="fas fa-spinner fa-spin text-xl text-secondary"></i>
            <span class="text-base font-medium text-gray-700 dark:text-text-dark-primary">Loading...</span>
        </div>
    </div>

    <!-- Detail Modal -->
    @if ($showDetailModal && $selectedSuggestion)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
            <div
                class="bg-white dark:bg-bg-dark-primary rounded-lg shadow-xl max-w-4xl w-full max-h-[90vh] overflow-y-auto">
                <div class="p-6">
                    <!-- Modal Header -->
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-text-dark-primary">
                            <i class="fas fa-comment-dots text-blue-500 mr-2"></i>
                            Detail Saran dan Masukan
                        </h3>
                        <button wire:click="closeModal"
                            class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>

                    <!-- Suggestion Info -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                        <!-- Left Column -->
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    Subject
                                </label>
                                <p class="text-base font-medium text-gray-900 dark:text-text-dark-primary">
                                    {{ $selectedSuggestion->subject }}
                                </p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    Tipe Feedback
                                </label>
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ ucfirst($selectedSuggestion->feedback_type) }}
                                </span>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    Prioritas
                                </label>
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                    @if ($selectedSuggestion->priority === 'high') bg-red-100 text-red-800
                                    @elseif($selectedSuggestion->priority === 'medium') bg-yellow-100 text-yellow-800
                                    @else bg-green-100 text-green-800 @endif">
                                    <i class="fas fa-flag mr-1"></i>
                                    {{ ucfirst($selectedSuggestion->priority) }}
                                </span>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    Rating
                                </label>
                                <div class="flex items-center">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i
                                            class="fas fa-star {{ $i <= $selectedSuggestion->rating ? 'text-yellow-400' : 'text-gray-300' }}"></i>
                                    @endfor
                                    <span class="ml-2 text-sm text-gray-600 dark:text-neutral-400">
                                        {{ $selectedSuggestion->rating }}/5
                                    </span>
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    Area Spesifik
                                </label>
                                <p class="text-sm font-medium text-gray-900 dark:text-text-dark-primary">
                                    {{ $selectedSuggestion->specific_area }}</p>
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    Informasi Pengguna
                                </label>
                                @if ($selectedSuggestion->user)
                                    <div class="flex items-center space-x-3">
                                        @if ($selectedSuggestion->user->avatar_url)
                                            <img class="h-10 w-10 rounded-full object-cover"
                                                src="{{ $selectedSuggestion->user->avatar_url }}"
                                                alt="{{ $selectedSuggestion->user->name }}">
                                        @else
                                            <div
                                                class="h-10 w-10 rounded-full bg-gray-300 flex items-center justify-center dark:bg-neutral-700">
                                                <i class="fas fa-user text-gray-600 dark:text-neutral-200"></i>
                                            </div>
                                        @endif
                                        <div>
                                            <p class="text-basefont-medium text-gray-900 dark:text-text-dark-primary">
                                                {{ $selectedSuggestion->user->name }}</p>
                                            <p class="text-sm text-gray-500 dark:text-neutral-400">
                                                {{ $selectedSuggestion->user->email }}</p>
                                        </div>
                                    </div>
                                @else
                                    <div>
                                        <p class="font-medium text-gray-900 dark:text-text-dark-primary">
                                            {{ $selectedSuggestion->name ?? 'Anonymous' }}</p>
                                        <p class="text-sm text-gray-500 dark:text-neutral-400">
                                            {{ $selectedSuggestion->email ?? 'No email provided' }}</p>
                                    </div>
                                @endif
                            </div>

                            <div class="grid grid-cols-3 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                        Ease of Use
                                    </label>
                                    <div class="flex items-center">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <i
                                                class="fas fa-star text-sm {{ $i <= $selectedSuggestion->ease_of_use ? 'text-yellow-400' : 'text-gray-300' }}"></i>
                                        @endfor
                                        <span
                                            class="ml-1 text-xs text-gray-600 dark:text-neutral-400">{{ $selectedSuggestion->ease_of_use }}/5</span>
                                    </div>
                                </div>
                                <div>
                                    <label
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Performance</label>
                                    <div class="flex items-center">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <i
                                                class="fas fa-star text-sm {{ $i <= $selectedSuggestion->performance ? 'text-yellow-400' : 'text-gray-300' }}"></i>
                                        @endfor
                                        <span
                                            class="ml-1 text-xs text-gray-600 dark:text-neutral-400">{{ $selectedSuggestion->performance }}/5</span>
                                    </div>
                                </div>
                                <div>
                                    <label
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Design</label>
                                    <div class="flex items-center">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <i
                                                class="fas fa-star text-sm {{ $i <= $selectedSuggestion->design ? 'text-yellow-400' : 'text-gray-300' }}"></i>
                                        @endfor
                                        <span
                                            class="ml-1 text-xs text-gray-600 dark:text-neutral-400">{{ $selectedSuggestion->design }}/5</span>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    Would Recommend?
                                </label>
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $selectedSuggestion->would_recommend ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    <i
                                        class="fas fa-{{ $selectedSuggestion->would_recommend ? 'thumbs-up' : 'thumbs-down' }} mr-1"></i>
                                    {{ $selectedSuggestion->would_recommend ? 'Yes' : 'No' }}
                                </span>
                            </div>

                            <div>
                                <label
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Submitted</label>
                                <p class="text-base font-medium text-gray-900 dark:text-text-dark-primary">
                                    {{ $selectedSuggestion->created_at->format('M d, Y \\a\\t H:i') }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Feedback Message -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Feedback Message
                        </label>
                        <div class="bg-gray-50 dark:bg-bg-dark-secondary rounded-lg p-4">
                            <p class="text-base font-medium text-gray-900 dark:text-text-dark-primary indent-3">
                                {{ $selectedSuggestion->feedback_message }}
                            </p>
                        </div>
                    </div>

                    <!-- Additional Features -->
                    @if ($selectedSuggestion->additional_features)
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Additional
                                Features Requested</label>
                            <div class="bg-gray-50 dark:bg-bg-dark-secondary rounded-lg p-4">
                                <p class="text-base font-medium text-gray-900 dark:text-text-dark-primary indent-3">
                                    {{ $selectedSuggestion->additional_features }}
                                </p>
                            </div>
                        </div>
                    @endif

                    <!-- Admin Actions -->
                    <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
                        <h4 class="text-lg font-medium text-gray-900 dark:text-text-dark-primary mb-4">
                            Admin Actions
                        </h4>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Status</label>
                                <select wire:model="newStatus"
                                    class="block w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md leading-5 bg-white dark:bg-bg-dark-secondary text-sm font-medium focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                                    <option value="pending">Pending</option>
                                    <option value="reviewed">Direview</option>
                                    <option value="implemented">Diimplementasikan</option>
                                    <option value="rejected">Ditolak</option>
                                </select>
                            </div>
                        </div>

                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Admin Notes
                            </label>
                            <textarea wire:model="adminNotes" rows="4"
                                class="block w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md leading-5 bg-white dark:bg-bg-dark-secondary text-sm font-medium focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Add notes about this suggestion..."></textarea>
                        </div>
                    </div>

                    <!-- Modal Footer -->
                    <div class="flex justify-end space-x-3 mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                        <button wire:click="closeModal"
                            class="px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-text-dark-primary bg-white dark:bg-bg-dark-secondary hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Cancel
                        </button>
                        <button wire:click="updateSuggestion"
                            class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <i class="fas fa-save mr-2"></i>
                            Update Suggestion
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
