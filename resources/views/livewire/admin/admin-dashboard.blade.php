<div class="min-h-screen">
    <!-- Header Section -->
    <div class="bg-white shadow-sm border-b border-gray-200 mb-8">
        <div class="px-6 py-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold font-display text-gray-900">Welcome back!</h1>
                    <p class="text-gray-600 text-base font-medium mt-1">Here's what's happening with your recipe
                        platform.
                    </p>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="text-right">
                        <p class="text-sm text-gray-500">Last updated</p>
                        <p class="text-sm font-medium text-gray-900">{{ now()->format('M d, Y H:i') }}</p>
                    </div>
                    <div
                        class="w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="pb-8">
        <!-- Key Metrics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Recipes -->
            <div
                class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl shadow-lg p-6 text-white transform hover:scale-105 transition-transform duration-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-blue-100 text-sm font-medium">Total Recipes</p>
                        <p class="text-3xl font-bold">{{ number_format($metrics['total_recipes']) }}</p>
                        <p class="text-blue-100 text-xs mt-1">+{{ $metrics['recipes_this_month'] }} this month</p>
                    </div>
                    <div class="bg-blue-400 bg-opacity-30 rounded-full p-3">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Pending Moderation -->
            <div
                class="bg-gradient-to-r from-orange-500 to-red-500 rounded-xl shadow-lg p-6 text-white transform hover:scale-105 transition-transform duration-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-orange-100 text-sm font-medium">Pending Review</p>
                        <p class="text-3xl font-bold">{{ $metrics['pending_moderation'] }}</p>
                        <p class="text-orange-100 text-xs mt-1">Needs attention</p>
                    </div>
                    <div class="bg-orange-400 bg-opacity-30 rounded-full p-3">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Total Users -->
            <div
                class="bg-gradient-to-r from-green-500 to-emerald-600 rounded-xl shadow-lg p-6 text-white transform hover:scale-105 transition-transform duration-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-green-100 text-sm font-medium">Total Users</p>
                        <p class="text-3xl font-bold">{{ number_format($metrics['total_users']) }}</p>
                        <p class="text-green-100 text-xs mt-1">{{ $metrics['total_creators'] }} creators</p>
                    </div>
                    <div class="bg-green-400 bg-opacity-30 rounded-full p-3">
                        <i class="fa fa-users"></i>
                    </div>
                </div>
            </div>

            <!-- Average Rating -->
            <div
                class="bg-gradient-to-r from-purple-500 to-pink-600 rounded-xl shadow-lg p-6 text-white transform hover:scale-105 transition-transform duration-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-purple-100 text-sm font-medium">Average Rating</p>
                        <p class="text-3xl font-bold">{{ $metrics['avg_rating'] }}/5</p>
                        <div class="flex items-center mt-1">
                            @for ($i = 1; $i <= 5; $i++)
                                <svg class="w-4 h-4 {{ $i <= $metrics['avg_rating'] ? 'text-yellow-300' : 'text-purple-300' }}"
                                    fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                    </path>
                                </svg>
                            @endfor
                        </div>
                    </div>
                    <div class="bg-purple-400 bg-opacity-30 rounded-full p-3">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.921-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <a href="{{ route('admin-moderation.index') }}"
                class="group bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition-all duration-200 border border-gray-100 hover:border-orange-200">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 group-hover:text-orange-600">Review Recipes</h3>
                        <p class="text-gray-600 text-sm mt-1">{{ $metrics['pending_moderation'] }} recipes waiting for
                            approval</p>
                    </div>
                    <div
                        class="bg-orange-100 group-hover:bg-orange-200 rounded-full p-3 transition-colors duration-200">
                        <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </a>

            <a href="{{ route('admin-recipes.create') }}"
                class="group bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition-all duration-200 border border-gray-100 hover:border-green-200">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 group-hover:text-green-600">Add New Recipe</h3>
                        <p class="text-gray-600 text-sm mt-1">Create and publish a new recipe</p>
                    </div>
                    <div class="bg-green-100 group-hover:bg-green-200 rounded-full p-3 transition-colors duration-200">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                    </div>
                </div>
            </a>

            <a href="{{ route('admin-ingredients.index') }}"
                class="group bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition-all duration-200 border border-gray-100 hover:border-blue-200">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 group-hover:text-blue-600">Manage Ingredients
                        </h3>
                        <p class="text-gray-600 text-sm mt-1">Add or edit recipe ingredients</p>
                    </div>
                    <div class="bg-blue-100 group-hover:bg-blue-200 rounded-full p-3 transition-colors duration-200">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                            </path>
                        </svg>
                    </div>
                </div>
            </a>
        </div>

        <!-- Charts and Analytics Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
            <!-- Recipe Categories Chart -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Recipe Categories Distribution</h3>
                <div class="relative h-64">
                    <canvas id="categoriesChart"></canvas>
                </div>
                <div class="mt-4 grid grid-cols-2 gap-2">
                    @foreach ($categoryStats as $category)
                        <div class="flex items-center space-x-2">
                            <div class="w-3 h-3 rounded-full"
                                style="background-color: {{ ['#3B82F6', '#10B981', '#F59E0B', '#EF4444', '#8B5CF6'][$loop->index % 5] }}">
                            </div>
                            <span class="text-xs text-gray-600">{{ $category->name }}
                                ({{ $category->recipes_count }})
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Monthly Recipe Submissions Chart -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Recipe Submissions Trend</h3>
                <div class="relative h-64">
                    <canvas id="monthlyChart"></canvas>
                </div>
                <div class="mt-4 text-center">
                    <p class="text-sm text-gray-600">Total submissions in last 6 months: <span
                            class="font-semibold text-gray-900">{{ collect($monthlyStats)->sum('recipes') }}</span>
                    </p>
                </div>
            </div>
        </div>

        <!-- Additional Analytics Charts -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
            <!-- Recipe Ratings Distribution -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Recipe Ratings Distribution</h3>
                <div class="relative h-64">
                    <canvas id="ratingsChart"></canvas>
                </div>
            </div>

            <!-- User Engagement Metrics -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="text-xl font-semibold text-gray-900 mb-4">User Engagement</h3>
                <div class="relative h-64">
                    <canvas id="engagementChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Recent Activity Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Recent Recipes -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xl font-semibold text-gray-900">Recent Recipes</h3>
                    <a href="{{ route('admin-recipes.index') }}"
                        class="text-blue-600 hover:text-blue-800 text-sm font-medium">View All</a>
                </div>
                <div class="space-y-4">
                    @forelse($recentRecipes as $recipe)
                        <div
                            class="flex items-center space-x-4 p-3 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                            <div class="w-[20%] h-20">
                                @if ($recipe->image)
                                    <img src="{{ asset($recipe->image) }}" alt="{{ $recipe->name }}"
                                        class="w-full h-full rounded-lg object-cover">
                                @else
                                    <div class="w-full h-full flex justify-center items-center">
                                        <i class="fa fa-image text-sm text-gray-300"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 truncate">{{ $recipe->name }}</p>
                                <p class="text-xs text-gray-500">by {{ $recipe->user->name }} •
                                    {{ $recipe->created_at->diffForHumans() }}</p>
                                <span
                                    class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-{{ $recipe->category->name === 'Hidangan Utama' ? 'blue' : ($recipe->category->name === 'Hidangan Penutup' ? 'purple' : 'green') }}-100 text-{{ $recipe->category->name === 'Hidangan Utama' ? 'blue' : ($recipe->category->name === 'Hidangan Penutup' ? 'purple' : 'green') }}-800">
                                    {{ $recipe->category->name }}
                                </span>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-medium text-gray-900">{{ $recipe->views_count }} views</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500 text-center py-4">No recent recipes found.</p>
                    @endforelse
                </div>
            </div>

            <!-- Pending Moderations -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xl font-semibold text-gray-900">Pending Moderations</h3>
                    <a href="{{ route('admin-moderation.index') }}"
                        class="text-orange-600 hover:text-orange-800 text-sm font-medium">Review All</a>
                </div>
                <div class="space-y-4">
                    @forelse($pendingModerations as $recipe)
                        <div
                            class="flex items-center space-x-4 p-3 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                            <div class="w-[20%] h-20">
                                @if ($recipe->image)
                                    <img src="{{ asset($recipe->image) }}" alt="{{ $recipe->name }}"
                                        class="w-full h-full rounded-lg object-cover">
                                @else
                                    <div class="w-full h-full flex justify-center items-center">
                                        <i class="fa fa-image text-sm text-gray-300"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 truncate">{{ $recipe->name }}</p>
                                <p class="text-xs text-gray-500">by {{ $recipe->user->name }} •
                                    {{ $recipe->created_at->diffForHumans() }}</p>
                                <span
                                    class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-orange-100 text-orange-800">
                                    Pending Review
                                </span>
                            </div>
                            <a href="{{ route('admin-moderation.show', $recipe->id) }}"
                                class="text-orange-600 hover:text-orange-800">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    @empty
                        <div class="text-center py-8">
                            <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <p class="text-gray-500">All caught up! No pending moderations.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Top Creators Section -->
        @if ($topCreators->count() > 0)
            <div class="mt-8">
                <div
                    class="bg-gradient-to-r from-purple-600 via-blue-600 to-indigo-700 rounded-xl shadow-xl p-8 text-white overflow-hidden relative">
                    <!-- Background decoration -->
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white opacity-10 rounded-full -mr-16 -mt-16"></div>
                    <div class="absolute bottom-0 left-0 w-24 h-24 bg-white opacity-10 rounded-full -ml-12 -mb-12">
                    </div>

                    <div class="relative z-10">
                        <div class="flex items-center justify-between mb-6">
                            <div>
                                <h3 class="text-2xl font-bold text-white mb-2">🌟 Top Creators</h3>
                                <p class="text-blue-100 text-sm font-medium">Our most talented recipe creators this
                                    month</p>
                            </div>
                            <div class="hidden md:flex items-center space-x-2 text-blue-100">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                    </path>
                                </svg>
                                <span class="text-sm font-medium">Hall of Fame</span>
                            </div>
                        </div>

                        <!-- Horizontal scrollable creators list -->
                        <div class="flex space-x-6 overflow-x-auto pb-4 scrollbar-hide">
                            @foreach ($topCreators as $index => $creator)
                                <div class="flex-shrink-0 group">
                                    <div
                                        class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 hover:bg-white/20 transition-all duration-300 transform hover:shadow-2xl border border-white/20 min-w-[280px]">
                                        <!-- Rank badge -->
                                        <div class="flex items-center justify-between mb-4">
                                            <div class="flex items-center space-x-3">
                                                <div class="relative">
                                                    @if ($creator->avatar_url)
                                                        <img src="{{ $creator->avatar_url }}"
                                                            alt="{{ $creator->name }}"
                                                            class="w-16 h-16 rounded-full object-cover border-4 border-white/30 group-hover:border-white/50 transition-all duration-300">
                                                    @else
                                                        <div
                                                            class="w-16 h-16 rounded-full border-4 border-white/30 group-hover:border-white/50 transition-all duration-300 bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-white font-bold text-xl">
                                                            {{ implode('',array_map(function ($word) {return ucfirst(substr($word, 0, 1));}, explode(' ', $creator->name))) }}
                                                        </div>
                                                    @endif
                                                    <!-- Online indicator -->
                                                    <div
                                                        class="absolute -bottom-1 -right-1 w-5 h-5 bg-green-400 rounded-full border-2 border-white">
                                                    </div>
                                                </div>
                                                <div>
                                                    <h4
                                                        class="font-bold text-white text-lg group-hover:text-yellow-200 transition-colors duration-300">
                                                        {{ $creator->name }}</h4>
                                                    <p class="text-blue-100 text-sm">Recipe Creator</p>
                                                </div>
                                            </div>
                                            <!-- Rank number -->
                                            <div
                                                class="bg-gradient-to-br from-yellow-400 to-orange-500 text-white font-bold text-lg w-10 h-10 rounded-full flex items-center justify-center shadow-lg">
                                                {{ $index + 1 }}
                                            </div>
                                        </div>

                                        <!-- Stats -->
                                        <div class="grid grid-cols-2 gap-4">
                                            <div class="bg-white/10 rounded-lg p-3 text-center">
                                                <div class="text-2xl font-bold text-white">
                                                    {{ $creator->recipes_count }}</div>
                                                <div class="text-blue-100 text-xs uppercase tracking-wide">Recipes
                                                </div>
                                            </div>
                                            <div class="bg-white/10 rounded-lg p-3 text-center">
                                                <div class="text-2xl font-bold text-white">
                                                    {{ number_format($creator->recipes_avg_views_count ?? 0) }}</div>
                                                <div class="text-blue-100 text-xs uppercase tracking-wide">Avg Views
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Action button -->
                                        <div class="mt-4">
                                            <button
                                                class="w-full bg-white/20 hover:bg-white/30 text-white font-medium py-2 px-4 rounded-lg transition-all duration-300 text-sm border border-white/30 hover:border-white/50">
                                                View Profile
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Navigation hint -->
                        <div class="flex justify-center mt-4 md:hidden">
                            <p class="text-blue-100 text-sm flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 16l-4-4m0 0l4-4m-4 4h18"></path>
                                </svg>
                                Swipe to see more creators
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Custom scrollbar styles -->
            <style>
                .scrollbar-hide {
                    -ms-overflow-style: none;
                    scrollbar-width: none;
                }

                .scrollbar-hide::-webkit-scrollbar {
                    display: none;
                }
            </style>
        @endif
    </div>
</div>

@push('script')
    <!-- Chart.js Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Categories Pie Chart
            const categoriesCtx = document.getElementById('categoriesChart').getContext('2d');
            new Chart(categoriesCtx, {
                type: 'doughnut',
                data: {
                    labels: {!! json_encode($categoryStats->pluck('name')) !!},
                    datasets: [{
                        data: {!! json_encode($categoryStats->pluck('recipes_count')) !!},
                        backgroundColor: [
                            '#3B82F6',
                            '#10B981',
                            '#F59E0B',
                            '#EF4444',
                            '#8B5CF6'
                        ],
                        borderWidth: 2,
                        borderColor: '#ffffff'
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
                                    const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                    const percentage = ((context.parsed * 100) / total).toFixed(1);
                                    return context.label + ': ' + context.parsed + ' (' + percentage +
                                        '%)';
                                }
                            }
                        }
                    },
                    cutout: '60%'
                }
            });

            // Monthly Submissions Line Chart
            const monthlyCtx = document.getElementById('monthlyChart').getContext('2d');
            new Chart(monthlyCtx, {
                type: 'line',
                data: {
                    labels: {!! json_encode($monthlyStats->pluck('month')) !!},
                    datasets: [{
                        label: 'Recipe Submissions',
                        data: {!! json_encode($monthlyStats->pluck('recipes')) !!},
                        borderColor: '#3B82F6',
                        backgroundColor: 'rgba(59, 130, 246, 0.1)',
                        borderWidth: 3,
                        fill: true,
                        tension: 0.4,
                        pointBackgroundColor: '#3B82F6',
                        pointBorderColor: '#ffffff',
                        pointBorderWidth: 2,
                        pointRadius: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0, 0, 0, 0.1)'
                            },
                            ticks: {
                                stepSize: 1
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

            // Ratings Distribution Bar Chart
            const ratingsCtx = document.getElementById('ratingsChart').getContext('2d');
            // Sample data - you can replace with actual ratings data
            new Chart(ratingsCtx, {
                type: 'bar',
                data: {
                    labels: ['1 Star', '2 Stars', '3 Stars', '4 Stars', '5 Stars'],
                    datasets: [{
                        label: 'Number of Ratings',
                        data: [5, 12, 25, 45, 78], // Replace with actual data
                        backgroundColor: [
                            '#EF4444',
                            '#F59E0B',
                            '#F59E0B',
                            '#10B981',
                            '#10B981'
                        ],
                        borderRadius: 6,
                        borderSkipped: false
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0, 0, 0, 0.1)'
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

            // User Engagement Radar Chart
            const engagementCtx = document.getElementById('engagementChart').getContext('2d');
            new Chart(engagementCtx, {
                type: 'radar',
                data: {
                    labels: ['Views', 'Bookmarks', 'Ratings', 'Comments'],
                    datasets: [{
                        label: 'Engagement Metrics',
                        data: [85, 70, 90, 65], // Replace with actual engagement data
                        backgroundColor: 'rgba(139, 92, 246, 0.2)',
                        borderColor: '#8B5CF6',
                        borderWidth: 2,
                        pointBackgroundColor: '#8B5CF6',
                        pointBorderColor: '#ffffff',
                        pointBorderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        r: {
                            beginAtZero: true,
                            max: 100,
                            grid: {
                                color: 'rgba(0, 0, 0, 0.1)'
                            },
                            angleLines: {
                                color: 'rgba(0, 0, 0, 0.1)'
                            }
                        }
                    }
                }
            });
        });
    </script>
@endpush
