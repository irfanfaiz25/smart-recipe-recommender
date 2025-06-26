<div class="min-h-screen">
    <!-- Welcome Header -->
    <div class="bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 text-white p-8 rounded-b-3xl shadow-xl mb-8">
        <div class="max-w-7xl mx-auto">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-4xl font-bold font-display mb-2 capitalize">👨‍🍳 Halo, {{ Auth::user()->name }}!
                    </h1>
                    <p class="text-indigo-100 text-base font-medium">Siap bikin resep enak hari ini?</p>
                </div>
                <div class="hidden md:flex items-center space-x-4">
                    <div class="bg-white/20 backdrop-blur-sm rounded-2xl p-4 text-center">
                        <div class="text-2xl font-bold">{{ $totalRecipes }}</div>
                        <div class="text-sm text-indigo-100">Total Resep</div>
                    </div>
                    <div class="bg-white/20 backdrop-blur-sm rounded-2xl p-4 text-center">
                        <div class="text-2xl font-bold">{{ number_format($totalViews) }}</div>
                        <div class="text-sm text-indigo-100">Total Dilihat</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="w-full">
        <!-- KPI Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Published Recipes -->
            <div
                class="bg-gradient-to-br from-green-400 to-green-600 rounded-2xl p-6 text-white shadow-xl transform transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-green-100 text-sm font-medium">Resep Dipublikasi</p>
                        <p class="text-3xl font-bold">{{ $publishedRecipes }}</p>
                        <p class="text-green-100 text-xs mt-1">Aktif</p>
                    </div>
                    <div class="bg-white/20 rounded-full px-3 py-2">
                        <i class="fa fa-check text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Pending Approval -->
            <div
                class="bg-gradient-to-br from-yellow-400 to-orange-500 rounded-2xl p-6 text-white shadow-xl transform transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-yellow-100 text-sm font-medium">Menunggu Persetujuan</p>
                        <p class="text-3xl font-bold">{{ $pendingRecipes }}</p>
                        <p class="text-yellow-100 text-xs mt-1">Sedang Direview</p>
                    </div>
                    <div class="bg-white/20 rounded-full px-3 py-2">
                        <i class="fa fa-clock"></i>
                    </div>
                </div>
            </div>

            <!-- Total Bookmarks -->
            <div
                class="bg-gradient-to-br from-purple-500 to-indigo-600 rounded-2xl p-6 text-white shadow-xl transform transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-purple-100 text-sm font-medium">Total Disimpan</p>
                        <p class="text-3xl font-bold">{{ number_format($totalBookmarks) }}</p>
                        <p class="text-purple-100 text-xs mt-1">Disimpan Pengguna</p>
                    </div>
                    <div class="bg-white/20 rounded-full px-4 py-2">
                        <i class="fa fa-bookmark text-base"></i>
                    </div>
                </div>
            </div>

            <!-- Average Rating -->
            <div
                class="bg-gradient-to-br from-pink-500 to-rose-600 rounded-2xl p-6 text-white shadow-xl transform transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-pink-100 text-sm font-medium">Rata-rata Rating</p>
                        <p class="text-3xl font-bold">{{ number_format($averageRating, 1) }}</p>
                        <div class="flex items-center mt-1">
                            @for ($i = 1; $i <= 5; $i++)
                                <svg class="w-4 h-4 {{ $i <= $averageRating ? 'text-yellow-300' : 'text-pink-200' }}"
                                    fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                            @endfor
                        </div>
                    </div>
                    <div class="bg-white/20 rounded-full px-3 py-2">
                        <i class="fa fa-star text-base"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white dark:bg-bg-dark-primary rounded-2xl shadow-xl p-6 mb-8">
            <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-50 mb-4">🚀 Quick Actions</h3>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <a href="{{ route('recipes.create') }}"
                    class="bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white rounded-xl p-4 text-center transition-all duration-300 transform hover:scale-105 shadow-lg">
                    <svg class="w-8 h-8 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    <span class="text-sm font-medium">Buat Resep</span>
                </a>
                <a href="{{ route('recipes.index') }}"
                    class="bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white rounded-xl p-4 text-center transition-all duration-300 transform hover:scale-105 shadow-lg">
                    <svg class="w-8 h-8 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                    <span class="text-sm font-medium">Resep Saya</span>
                </a>
                <a href="#analytics"
                    class="bg-gradient-to-r from-purple-500 to-purple-600 hover:from-purple-600 hover:to-purple-700 text-white rounded-xl p-4 text-center transition-all duration-300 transform hover:scale-105 shadow-lg">
                    <svg class="w-8 h-8 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                    <span class="text-sm font-medium">Statistik</span>
                </a>
                <a href=""
                    class="bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white rounded-xl p-4 text-center transition-all duration-300 transform hover:scale-105 shadow-lg">
                    <svg class="w-8 h-8 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <span class="text-sm font-medium">Profil</span>
                </a>
            </div>
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
            <!-- Recent Recipes -->
            <div class="lg:col-span-2">
                <div class="bg-white dark:bg-bg-dark-primary rounded-2xl shadow-xl p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-text-dark-primary">📝 Resep Terbaru
                        </h3>
                        <a href="{{ route('recipes.index') }}"
                            class="text-indigo-600 hover:text-indigo-800 dark:text-indigo-200 dark:hover:text-indigo-300 text-sm font-medium">Lihat
                            Semua</a>
                    </div>
                    <div class="space-y-1">
                        @forelse($recentRecipes as $recipe)
                            <div class="flex space-x-4 p-4 rounded-xl hover:bg-gray-50 transition-colors duration-200">
                                <div class="w-[20%] h-24">
                                    @if ($recipe->image)
                                        <img src="{{ asset($recipe->image) }}" alt="{{ $recipe->name }}"
                                            class="w-full h-full rounded-lg object-cover shadow-md">
                                    @else
                                        <div
                                            class="w-full h-full bg-gray-300 text-gray-400 flex justify-center items-center rounded-lg">
                                            <i class="fa fa-utensils"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-1">
                                    <h4 class="font-medium text-gray-900 dark:text-text-dark-primary">
                                        {{ $recipe->name }}</h4>
                                    <p class="text-sm font-normal text-gray-500 dark:text-gray-200">
                                        {{ $recipe->category->name }}
                                        •
                                        {{ $recipe->views_count }} kali dilihat</p>
                                    <p class="text-xs font-normal text-gray-400">
                                        {{ $recipe->created_at->diffForHumans() }}</p>
                                </div>
                                <div class="flex items-center space-x-2">
                                    @if ($recipe->moderation)
                                        <span
                                            class="px-2 py-1 text-xs rounded-full 
                                            {{ $recipe->moderation->status === 'approved'
                                                ? 'bg-green-100 text-green-800'
                                                : ($recipe->moderation->status === 'pending'
                                                    ? 'bg-yellow-100 text-yellow-800'
                                                    : 'bg-red-100 text-red-800') }}">
                                            {{ $recipe->moderation->status === 'approved' ? 'Disetujui' : ($recipe->moderation->status === 'pending' ? 'Menunggu' : 'Ditolak') }}
                                        </span>
                                    @endif
                                    <a href="{{ route('recipes.edit', $recipe) }}"
                                        class="text-indigo-600 hover:text-indigo-800 dark:text-indigo-200 dark:hover:text-indigo-300">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-8">
                                <svg class="w-16 h-16 mx-auto text-gray-300 dark:text-gray-200 mb-4" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <p class="text-gray-500 dark:text-gray-300">Belum ada resep nih. Yuk bikin resep
                                    pertamamu!</p>
                                <a href="{{ route('recipes.create') }}"
                                    class="mt-2 inline-block bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition-colors duration-200">Buat
                                    Resep</a>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Top Performing Recipes -->
            <div>
                <div class="bg-white dark:bg-bg-dark-primary rounded-2xl shadow-xl p-6">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-text-dark-primary mb-6">🏆 Resep
                        Terpopuler</h3>
                    <div class="space-y-4">
                        @forelse($topRecipes as $index => $recipe)
                            <div class="flex items-center space-x-3">
                                <div
                                    class="flex-shrink-0 w-8 h-8 bg-gradient-to-r from-yellow-400 to-orange-500 rounded-full flex items-center justify-center text-white font-bold text-sm">
                                    {{ $index + 1 }}
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 dark:text-text-dark-primary truncate">
                                        {{ $recipe->name }}</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-200">
                                        {{ number_format($recipe->views_count) }} kali
                                        dilihat
                                    </p>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500 text-center py-4">Belum ada resep yang dipublikasi</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <!-- Analytics Section -->
        <div id="analytics" class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
            <!-- Category Distribution -->
            <div class="bg-white dark:bg-bg-dark-primary rounded-2xl shadow-xl p-6">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-text-dark-primary mb-6">📊 Kategori Resep</h3>
                <div class="h-80">
                    <canvas id="categoryChart"></canvas>
                </div>
            </div>

            <!-- Monthly Views Trend -->
            <div class="bg-white dark:bg-bg-dark-primary rounded-2xl shadow-xl p-6">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-text-dark-primary mb-6">📈 Statistik Total
                    Resep Dibuat</h3>
                <div class="h-80">
                    <canvas id="viewsChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Recent Ratings -->
        @if ($recentRatings->count() > 0)
            <div class="bg-white dark:bg-bg-dark-primary rounded-2xl shadow-xl p-6 mb-8">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-text-dark-primary mb-6">⭐ Rating & Ulasan
                    Terbaru</h3>
                <div class="space-y-4">
                    @foreach ($recentRatings as $rating)
                        <div class="border-l-4 border-indigo-500 pl-4 py-2">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    @if ($rating->user->avatar_url)
                                        <img src="{{ $rating->user->avatar_url }}" alt="{{ $rating->user->name }}"
                                            class="w-8 h-8 rounded-full object-cover shadow-md">
                                    @else
                                        <div
                                            class="w-8 h-8 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-white font-bold text-base">
                                            {{ implode('',array_map(function ($word) {return ucfirst(substr($word, 0, 1));}, explode(' ', $rating->user->name))) }}
                                        </div>
                                    @endif
                                    <div>
                                        <p
                                            class="font-semibold text-sm text-gray-900 dark:text-text-dark-primary capitalize">
                                            {{ $rating->user->name }}
                                        </p>
                                        <p class="text-xs font-medium text-gray-500 dark:text-gray-200">
                                            {{ $rating->recipe->name }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <div class="flex items-center">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <svg class="w-4 h-4 {{ $i <= $rating->rating ? 'text-yellow-400' : 'text-gray-300' }}"
                                                fill="currentColor" viewBox="0 0 20 20">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                        @endfor
                                    </div>
                                    <span
                                        class="text-sm text-gray-500 dark:text-gray-200">{{ $rating->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                            @if ($rating->comment)
                                <p class="text-gray-700 dark:text-gray-200 mt-2 text-sm">"{{ $rating->comment }}"</p>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>

@push('script')
    <!-- Chart.js Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Check if elements exist before creating charts
            const categoryChartEl = document.getElementById('categoryChart');
            const viewsChartEl = document.getElementById('viewsChart');

            if (categoryChartEl) {
                const categoryCtx = categoryChartEl.getContext('2d');
                const categoryData = @json($categoryStats);

                if (categoryData && categoryData.length > 0) {
                    new Chart(categoryCtx, {
                        type: 'doughnut',
                        data: {
                            labels: categoryData.map(item => item.name),
                            datasets: [{
                                data: categoryData.map(item => item.count),
                                backgroundColor: [
                                    '#8B5CF6', '#06B6D4', '#10B981', '#F59E0B', '#EF4444',
                                    '#EC4899'
                                ],
                                borderWidth: 0
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    position: 'bottom',
                                    labels: {
                                        padding: 20,
                                        usePointStyle: true,
                                        font: {
                                            size: 12
                                        }
                                    }
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function(context) {
                                            const label = context.label || '';
                                            const value = context.raw || 0;
                                            const total = context.dataset.data.reduce((a, b) => a + b,
                                                0);
                                            const percentage = Math.round((value / total) * 100);
                                            return `${label}: ${value} (${percentage}%)`;
                                        }
                                    }
                                }
                            }
                        }
                    });
                } else {
                    // Display a message if no data
                    const noDataMessage = document.createElement('div');
                    noDataMessage.className = 'flex items-center justify-center h-full';
                    noDataMessage.innerHTML =
                        '<p class="text-gray-500 text-center">No category data available yet</p>';
                    categoryChartEl.parentNode.replaceChild(noDataMessage, categoryChartEl);
                }
            }

            if (viewsChartEl) {
                const viewsCtx = viewsChartEl.getContext('2d');
                const viewsData = @json($monthlyCreatedRecipe);

                if (viewsData && viewsData.length > 0) {
                    // Sort data chronologically
                    viewsData.sort((a, b) => {
                        if (a.year !== b.year) return a.year - b.year;
                        return a.month - b.month;
                    });

                    new Chart(viewsCtx, {
                        type: 'line',
                        data: {
                            labels: viewsData.map(item => {
                                const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul',
                                    'Aug', 'Sep', 'Oct',
                                    'Nov', 'Dec'
                                ];
                                return months[item.month - 1] + ' ' + item.year;
                            }),
                            datasets: [{
                                label: 'Resep',
                                data: viewsData.map(item => item.total_recipes),
                                borderColor: '#8B5CF6',
                                backgroundColor: 'rgba(139, 92, 246, 0.1)',
                                borderWidth: 3,
                                fill: true,
                                tension: 0.4,
                                pointBackgroundColor: '#8B5CF6',
                                pointBorderColor: '#fff',
                                pointBorderWidth: 2,
                                pointRadius: 5,
                                pointHoverRadius: 7
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    display: false
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function(context) {
                                            return `Resep: ${context.raw.toLocaleString()}`;
                                        }
                                    }
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    grid: {
                                        color: 'rgba(0, 0, 0, 0.1)'
                                    },
                                    ticks: {
                                        callback: function(value) {
                                            return value.toLocaleString();
                                        }
                                    }
                                },
                                x: {
                                    grid: {
                                        display: false
                                    }
                                }
                            }
                        }
                    });
                } else {
                    // Display a message if no data
                    const noDataMessage = document.createElement('div');
                    noDataMessage.className = 'flex items-center justify-center h-full';
                    noDataMessage.innerHTML =
                        '<p class="text-gray-500 text-center">No views data available yet</p>';
                    viewsChartEl.parentNode.replaceChild(noDataMessage, viewsChartEl);
                }
            }
        });
    </script>
@endpush
