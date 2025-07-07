<!-- Add this at the bottom of your layout for mobile -->
<div class="fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 md:hidden z-40">
    @auth
        <div x-data="{
            activeSubmenu: null,
            menus: {
                recipes: [{
                        name: 'Rekomendasi Cerdas',
                        route: 'savoryai.index',
                        url: '{{ route('savoryai.index') }}',
                        icon: 'fa-solid fa-lightbulb',
                        description: 'Temukan resep yang cocok untukmu dengan bantuan AI!'
                    },
                    {
                        name: 'Jelajahi Resep',
                        route: 'explore-recipes.index',
                        url: '{{ route('explore-recipes.index') }}',
                        icon: 'fa-solid fa-compass',
                        description: 'Jelajahi berbagai resep lezat dari seluruh Indonesia'
                    }
                ]
            },
            toggleSubmenu(menu) {
                this.activeSubmenu = this.activeSubmenu === menu ? null : menu;
            },
            closeSubmenu() {
                this.activeSubmenu = null;
            }
        }">
            <!-- Submenu Overlay -->
            <div x-show="activeSubmenu" x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0" @click="closeSubmenu()" class="fixed inset-0 bg-black bg-opacity-50 z-10">
            </div>

            <!-- Submenu Panel -->
            <div x-show="activeSubmenu" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="transform translate-y-full" x-transition:enter-end="transform translate-y-0"
                x-transition:leave="transition ease-in duration-200" x-transition:leave-start="transform translate-y-0"
                x-transition:leave-end="transform translate-y-full"
                class="absolute bottom-full left-0 right-0 bg-white rounded-t-2xl shadow-2xl z-20 max-h-80 overflow-y-auto">

                <!-- Rest of authenticated submenu content remains the same -->
                <!-- ... (previous submenu content) ... -->
            </div>

            <!-- Bottom Tab Navigation -->
            <div class="flex justify-around items-center py-2 bg-white relative z-30">
                <!-- Previous bottom tab navigation content remains the same -->
                <!-- ... (previous bottom tab content) ... -->
            </div>
        </div>
    @else
        <!-- Guest Navigation -->
        <div class="flex justify-around items-center py-2 bg-white relative z-30">
            <!-- Home Tab -->
            <a href="{{ route('home.index') }}" wire:navigate class="flex flex-col items-center p-2 min-w-0">
                <div class="w-6 h-6 flex items-center justify-center mb-1">
                    <i class="fa fa-home text-lg {{ request()->is('/') ? 'text-secondary' : 'text-gray-400' }}"></i>
                </div>
                <span
                    class="text-xs {{ request()->is('/') ? 'text-secondary font-medium' : 'text-gray-500' }} truncate">Beranda</span>
            </a>

            <!-- Recipes Tab -->
            <a href="{{ route('explore-recipes.index') }}" wire:navigate class="flex flex-col items-center p-2 min-w-0">
                <div class="w-6 h-6 flex items-center justify-center mb-1">
                    <i
                        class="fa fa-utensils text-lg {{ request()->is('explore*') ? 'text-secondary' : 'text-gray-400' }}"></i>
                </div>
                <span
                    class="text-xs {{ request()->is('explore*') ? 'text-secondary font-medium' : 'text-gray-500' }} truncate">Resep</span>
            </a>

            <!-- Creators Tab -->
            <a href="{{ route('creators.index') }}" wire:navigate class="flex flex-col items-center p-2 min-w-0">
                <div class="w-6 h-6 flex items-center justify-center mb-1">
                    <i
                        class="fa fa-users text-lg {{ request()->is('creators*') ? 'text-secondary' : 'text-gray-400' }}"></i>
                </div>
                <span
                    class="text-xs {{ request()->is('creators*') ? 'text-secondary font-medium' : 'text-gray-500' }} truncate">Creators</span>
            </a>

            <!-- Login Tab -->
            <a href="{{ route('login') }}" wire:navigate class="flex flex-col items-center p-2 min-w-0">
                <div class="w-6 h-6 flex items-center justify-center mb-1">
                    <i
                        class="fa fa-sign-in-alt text-lg {{ request()->is('login') ? 'text-secondary' : 'text-gray-400' }}"></i>
                </div>
                <span
                    class="text-xs {{ request()->is('login') ? 'text-secondary font-medium' : 'text-gray-500' }} truncate">Masuk</span>
            </a>
        </div>
    @endauth
</div>
