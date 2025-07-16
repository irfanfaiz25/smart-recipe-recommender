<div>
    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 mb-8">
        <!-- Total Users -->
        <div class="bg-white dark:bg-bg-dark-primary rounded-lg shadow-md p-6 border-l-4 border-blue-500">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-users text-3xl text-blue-500"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600 dark:text-text-dark-primary">Total Users</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-text-dark-primary">
                        {{ number_format($totalUsers) }}</p>
                </div>
            </div>
        </div>

        <!-- Active Users -->
        <div class="bg-white dark:bg-bg-dark-primary rounded-lg shadow-md p-6 border-l-4 border-green-500">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-user-check text-3xl text-green-500"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600 dark:text-text-dark-primary">Active Users (30d)</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-text-dark-primary">
                        {{ number_format($activeUsers) }}</p>
                </div>
            </div>
        </div>

        <!-- New Users This Month -->
        <div class="bg-white dark:bg-bg-dark-primary rounded-lg shadow-md p-6 border-l-4 border-yellow-500">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-user-plus text-3xl text-yellow-500"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600 dark:text-text-dark-primary">New This Month</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-text-dark-primary">
                        {{ number_format($newUsersThisMonth) }}</p>
                </div>
            </div>
        </div>

        <!-- Total Creators -->
        <div class="bg-white dark:bg-bg-dark-primary rounded-lg shadow-md p-6 border-l-4 border-purple-500">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-chef-hat text-3xl text-purple-500"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600 dark:text-text-dark-primary">Total Creators</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-text-dark-primary">
                        {{ number_format($totalCreators) }}</p>
                </div>
            </div>
        </div>

        <!-- Total Recipes -->
        <div class="bg-white dark:bg-bg-dark-primary rounded-lg shadow-md p-6 border-l-4 border-red-500">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-utensils text-3xl text-red-500"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600 dark:text-text-dark-primary">Total Recipes</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-text-dark-primary">
                        {{ number_format($totalRecipes) }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Search and Filter Section -->
    <div class="bg-white dark:bg-bg-dark-primary rounded-lg shadow-md p-6 mb-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0 md:space-x-4">
            <!-- Search Input -->
            <div class="flex-1">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-lg text-gray-400"></i>
                    </div>
                    <input type="text" wire:model.live.debounce.300ms="search"
                        class="block w-full text-sm font-medium pl-10 pr-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md leading-5 bg-white dark:bg-bg-dark-secondary placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Cari berdasarkan nama atau email...">
                </div>
            </div>

            <!-- Role Filter -->
            <div class="w-full md:w-48">
                <select wire:model.live="roleFilter"
                    class="block text-sm font-medium w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md leading-5 bg-white dark:bg-bg-dark-secondary focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Semua Role</option>
                    @foreach ($this->roles as $role)
                        <option value="{{ $role->name }}">{{ ucfirst($role->name) }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Refresh Button -->
            <button wire:click="loadStatistics"
                class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-text-dark-primary bg-white dark:bg-bg-dark-secondary hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <i class="fas fa-sync-alt mr-2"></i>
                Refresh
            </button>
        </div>
    </div>

    <!-- Users Table -->
    <div class="bg-white dark:bg-bg-dark-primary rounded-lg shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-neutral-700">
                    <tr>
                        <th wire:click="sortBy('name')"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider cursor-pointer ">
                            <div class="flex items-center space-x-1">
                                <span>Nama</span>
                                @if ($sortBy === 'name')
                                    <i
                                        class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} text-blue-500"></i>
                                @else
                                    <i class="fas fa-sort text-gray-400"></i>
                                @endif
                            </div>
                        </th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                            Email
                        </th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                            Role
                        </th>
                        <th wire:click="sortBy('created_at')"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider cursor-pointer">
                            <div class="flex items-center space-x-1">
                                <span>Bergabung</span>
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
                            Terakhir Login
                        </th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-bg-dark-primary divide-y divide-gray-200 dark:divide-neutral-700"
                    wire:loading.remove>
                    @forelse($this->users as $user)
                        {{-- @dd($user->avatar) --}}
                        <tr class="hover:bg-gray-50 dark:hover:bg-neutral-600">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        @if ($user->avatar)
                                            <img class="h-10 w-10 rounded-full object-cover" src="{{ $user->avatar }}"
                                                alt="{{ $user->name }}">
                                        @else
                                            <div
                                                class="h-10 w-10 rounded-full bg-gray-300 flex items-center justify-center dark:bg-neutral-700">
                                                <i class="fas fa-user text-sm text-gray-600 dark:text-neutral-200"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900 dark:text-neutral-200">
                                            {{ $user->name }}</div>
                                        @if ($user->creators)
                                            <div class="text-xs text-purple-600 font-medium">
                                                <i class="fa fa-cookie-bite mr-1"></i>Creator
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900 dark:text-neutral-200">{{ $user->email }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                        @if ($user->getRoleNames()->first() === 'admin') bg-red-100 text-red-800
                                        @elseif($user->getRoleNames()->first() === 'creators') bg-purple-100 text-purple-800
                                        @else bg-gray-100 text-gray-800 @endif">
                                    {{ ucfirst($user->getRoleNames()->first()) }}
                                </span>
                            </td>
                            <td
                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-neutral-200 font-normal">
                                {{ $user->created_at->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-normal">
                                @if ($user->last_login_at)
                                    <div class="flex items-center space-x-1">
                                        <i class="fas fa-clock text-blue-500"></i>
                                        <span class="text-gray-700 dark:text-neutral-200">
                                            @if ($user->last_login_at->isToday())
                                                <span class="text-green-600 font-medium">Hari ini</span>
                                                {{ $user->last_login_at->format('H:i') }}
                                            @elseif ($user->last_login_at->isYesterday())
                                                <span class="text-blue-600 font-medium">Kemarin</span>
                                                {{ $user->last_login_at->format('H:i') }}
                                            @else
                                                {{ $user->last_login_at->diffForHumans(['locale' => 'id']) }}
                                            @endif
                                        </span>
                                    </div>
                                @else
                                    <div class="flex items-center space-x-1">
                                        <i class="fas fa-user-clock text-gray-400"></i>
                                        <span class="text-gray-400 italic">Belum pernah login</span>
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex items-center space-x-2">
                                    <button wire:click="viewUser({{ $user->id }})"
                                        class="text-blue-600 hover:text-blue-900 transition-colors duration-200">
                                        <i class="fas fa-eye"></i>
                                    </button>

                                    @if (!$user->hasRole('admin'))
                                        <button wire:click="assignAsAdmin({{ $user->id }})"
                                            wire:confirm="Apakah Anda yakin ingin mengangkat user ini menjadi admin?"
                                            class="text-green-600 hover:text-green-900 transition-colors duration-200"
                                            title="Angkat sebagai Admin">
                                            <i class="fas fa-user-shield"></i>
                                        </button>
                                    @else
                                        <button wire:click="removeAdminRole({{ $user->id }})"
                                            wire:confirm="Apakah Anda yakin ingin menghapus role admin dari user ini?"
                                            class="text-orange-600 hover:text-orange-900 transition-colors duration-200"
                                            title="Hapus Role Admin">
                                            <i class="fas fa-user-minus"></i>
                                        </button>
                                    @endif

                                    <button wire:click="deleteUser({{ $user->id }})"
                                        wire:confirm="Apakah Anda yakin ingin menghapus user ini?"
                                        class="text-red-600 hover:text-red-900 transition-colors duration-200">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                <div class="flex flex-col items-center justify-center py-8">
                                    <i class="fas fa-users text-4xl text-gray-300 mb-4"></i>
                                    <p class="text-lg font-medium">Tidak ada user ditemukan</p>
                                    <p class="text-sm">Coba ubah filter pencarian Anda</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="w-full flex justify-center items-center">
                <div wire:loading class="py-6">
                    <div class="flex items-center justify-center space-x-2">
                        <i class="fa-solid fa-spinner fa-spin text-xl text-gray-500"></i>
                        <span class="text-sm text-gray-500">Memuat...</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        @if ($this->users->hasPages())
            <div class="bg-white px-4 py-3 border-t border-gray-200">
                {{ $this->users->links() }}
            </div>
        @endif
    </div>

    <!-- User Detail Modal -->
    @if ($showUserModal && $editingUser)
        <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog"
            aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" wire:click="closeModal"></div>

                <div
                    class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg leading-6 font-semibold text-gray-900">Detail User</h3>
                            <button wire:click="closeModal" class="text-gray-400 hover:text-gray-600">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>

                        <div class="space-y-6">
                            <!-- User Basic Info -->
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    @if ($editingUser->avatar)
                                        <img class="h-20 w-20 rounded-full object-cover"
                                            src="{{ $editingUser->avatar }}" alt="{{ $editingUser->name }}">
                                    @else
                                        <div
                                            class="h-20 w-20 rounded-full bg-gray-300 flex items-center justify-center">
                                            <i class="fas fa-user text-2xl text-gray-600"></i>
                                        </div>
                                    @endif
                                </div>
                                <div>
                                    <h4 class="text-xl font-semibold text-gray-900">{{ $editingUser->name }}</h4>
                                    <p class="text-gray-600 text-sm font-medium">{{ $editingUser->email }}</p>
                                    <div class="flex items-center space-x-2 mt-2">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                                @if ($editingUser->getRoleNames()[0] === 'admin') bg-red-100 text-red-800
                                                @elseif($editingUser->getRoleNames()[0] === 'creators') bg-purple-100 text-purple-800
                                                @else bg-gray-100 text-gray-800 @endif">
                                            {{ ucfirst($editingUser->getRoleNames()[0]) }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Statistics -->
                            <div class="grid md:grid-cols-2 gap-4">
                                <div class="text-center p-4 bg-gray-50 rounded-lg">
                                    <div class="text-2xl font-bold text-green-600">
                                        {{ $editingUser->bookmarked_recipes_count }}</div>
                                    <div class="text-sm text-gray-600">Resep Disimpan</div>
                                </div>
                                <div class="text-center p-4 bg-gray-50 rounded-lg">
                                    <div class="text-2xl font-bold text-purple-600">{{ $editingUser->ratings_count }}
                                    </div>
                                    <div class="text-sm text-gray-600">Rating Diberikan</div>
                                </div>
                            </div>

                            <!-- Account Info -->
                            <div class="border-t pt-4">
                                <h5 class="font-semibold text-gray-900 mb-3">Informasi Akun</h5>
                                <div class="grid grid-cols-2 gap-4 text-sm">
                                    <div>
                                        <span class="text-gray-600">Bergabung:</span>
                                        <span
                                            class="ml-2 font-medium">{{ $editingUser->created_at->format('d M Y H:i') }}</span>
                                    </div>
                                    <div>
                                        <span class="text-gray-600">Terakhir Login:</span>
                                        <span
                                            class="ml-2 font-medium">{{ $editingUser->last_login_at ? $editingUser->last_login_at->format('d M Y H:i') : 'Tidak ada data' }}</span>
                                    </div>
                                </div>
                            </div>

                            @if ($editingUser->hasRole('creators') || $editingUser->hasRole('admin'))
                                <!-- Creator Info -->
                                <div class="border-t pt-4">
                                    <h5 class="font-semibold text-gray-900 mb-3">
                                        {{ $editingUser->hasRole('creators') ? 'Informasi Creators' : 'Informasi Admin' }}
                                    </h5>
                                    <div class="grid md:grid-cols-3 gap-4">
                                        <div class="text-center p-4 bg-orange-50 rounded-lg">
                                            <div class="text-2xl font-bold text-secondary">
                                                {{ $editingUser->recipes_count }}</div>
                                            <div class="text-sm text-gray-600">Resep Dibuat</div>
                                        </div>
                                        <div class="text-center p-4 bg-orange-50 rounded-lg">
                                            <div class="flex justify-center items-center space-x-1">
                                                <i class="fa fa-star text-lg text-yellow-500"></i>
                                                <span class="text-2xl font-bold text-secondary">
                                                    {{ number_format($editingUser->recipes_avg_rating, 1) ?? 'Belum ada rating' }}
                                                </span>
                                            </div>
                                            <div class="text-sm text-gray-600">Rata-Rata Rating</div>
                                        </div>
                                        <div class="text-center p-4 bg-orange-50 rounded-lg">
                                            <div class="text-2xl font-bold text-secondary">
                                                {{ $editingUser->recipes_sum_views_count ?? 0 }}</div>
                                            <div class="text-sm text-gray-600">Resep Dilihat</div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button wire:click="closeModal"
                            class="w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

</div>
