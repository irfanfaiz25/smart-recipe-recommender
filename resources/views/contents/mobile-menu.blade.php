<!-- Add this at the bottom of your layout for mobile -->
<div class="fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 md:hidden z-40" x-data="{
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
    <div x-show="activeSubmenu" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click="closeSubmenu()"
        class="fixed inset-0 bg-black bg-opacity-50 z-10">
    </div>

    <!-- Submenu Panel -->
    <div x-show="activeSubmenu" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="transform translate-y-full" x-transition:enter-end="transform translate-y-0"
        x-transition:leave="transition ease-in duration-200" x-transition:leave-start="transform translate-y-0"
        x-transition:leave-end="transform translate-y-full"
        class="absolute bottom-full left-0 right-0 bg-white rounded-t-2xl shadow-2xl z-20 max-h-80 overflow-y-auto">

        <!-- Submenu Header -->
        <div class="flex items-center justify-between p-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-text-primary"
                x-text="
                    activeSubmenu === 'recipes' ? 'Resep Masakan' :
                    activeSubmenu === 'profile' ? 'Profil & Pengaturan' : ''
                ">
            </h3>
            <button @click="closeSubmenu()" class="p-2 hover:bg-gray-100 rounded-full">
                <i class="fas fa-times text-gray-500"></i>
            </button>
        </div>

        <!-- Submenu Items -->
        <div class="p-2">
            <!-- Recipes Submenu -->
            <template x-if="activeSubmenu === 'recipes'">
                <div class="space-y-1">
                    <template x-for="item in menus.recipes" :key="item.route">
                        <a :href="item.url" x-bind:wire:navigate="item.route !== 'explore-recipes.index'"
                            @click="closeSubmenu()"
                            class="flex items-center gap-4 p-3 rounded-xl hover:bg-secondary/10 hover:text-secondary transition-all duration-200">
                            <div class="w-10 h-10 bg-secondary/10 rounded-full flex items-center justify-center">
                                <i class="fas" :class="item.icon" class="text-secondary"></i>
                            </div>
                            <div>
                                <p class="font-medium text-text-primary" x-text="item.name"></p>
                                <p class="text-xs text-gray-500" x-text="item.description"></p>
                            </div>
                        </a>
                    </template>
                </div>
            </template>

            <!-- Profile Submenu -->
            <template x-if="activeSubmenu === 'profile'">
                <div class="space-y-1">
                    <!-- Admin Panel -->
                    @role('admin')
                        <a href="{{ route('admin-recipes.index') }}" wire:navigate @click="closeSubmenu()"
                            class="flex items-center gap-4 p-3 rounded-xl hover:bg-secondary/10 hover:text-secondary transition-all duration-200">
                            <div class="w-10 h-10 bg-secondary/10 rounded-full flex items-center justify-center">
                                <i class="fa-solid fa-user-shield text-secondary"></i>
                            </div>
                            <div>
                                <p class="font-medium text-text-primary">Admin Panel</p>
                                <p class="text-xs text-gray-500">Manage system</p>
                            </div>
                        </a>
                    @endrole

                    <!-- Creators Panel -->
                    @role('creators')
                        <a href="{{ route('dashboard.index') }}" wire:navigate @click="closeSubmenu()"
                            class="flex items-center gap-4 p-3 rounded-xl hover:bg-secondary/10 hover:text-secondary transition-all duration-200">
                            <div class="w-10 h-10 bg-secondary/10 rounded-full flex items-center justify-center">
                                <i class="fa-solid fa-kitchen-set text-secondary"></i>
                            </div>
                            <div>
                                <p class="font-medium text-text-primary">Creators Panel</p>
                                <p class="text-xs text-gray-500">Creator dashboard</p>
                            </div>
                        </a>
                    @endrole

                    <!-- Favorit Saya -->
                    <a href="{{ route('bookmarks.index') }}" wire:navigate @click="closeSubmenu()"
                        class="flex items-center gap-4 p-3 rounded-xl hover:bg-secondary/10 hover:text-secondary transition-all duration-200">
                        <div class="w-10 h-10 bg-secondary/10 rounded-full flex items-center justify-center">
                            <i class="fa-solid fa-bookmark text-secondary"></i>
                        </div>
                        <div>
                            <p class="font-medium text-text-primary">Favorit Saya</p>
                            <p class="text-xs text-gray-500">Resep tersimpan</p>
                        </div>
                    </a>

                    {{-- saran dan masukan --}}
                    <a href="{{ route('suggestions.index') }}" wire:navigate @click="closeSubmenu()"
                        class="flex items-center gap-4 p-3 rounded-xl hover:bg-secondary/10 hover:text-secondary transition-all duration-200">
                        <div class="w-10 h-10 bg-secondary/10 rounded-full flex items-center justify-center">
                            <i class="fa-solid fa-file-pen text-secondary"></i>
                        </div>
                        <div>
                            <p class="font-medium text-text-primary">Saran & Masukan</p>
                            <p class="text-xs text-gray-500">Berikan saran & masukan kepada kami</p>
                        </div>
                    </a>

                    <!-- Logout -->
                    <form method="POST" action="{{ route('auth.logout') }}">
                        @csrf
                        <button type="submit" @click="closeSubmenu()"
                            class="flex items-center gap-4 p-3 rounded-xl hover:bg-red-500/10 hover:text-red-500 transition-all duration-200 w-full text-left">
                            <div class="w-10 h-10 bg-red-500/10 rounded-full flex items-center justify-center">
                                <i class="fa-solid fa-arrow-right-from-bracket text-red-500"></i>
                            </div>
                            <div>
                                <p class="font-medium">Logout</p>
                                <p class="text-xs text-gray-500">Keluar dari akun</p>
                            </div>
                        </button>
                    </form>
                </div>
            </template>
        </div>
    </div>

    <!-- Bottom Tab Navigation -->
    <div class="flex justify-around items-center py-2 bg-white relative z-30">
        <!-- Home Tab -->
        <a href="{{ route('home.index') }}" wire:navigate class="flex flex-col items-center p-2 min-w-0">
            <div class="w-6 h-6 flex items-center justify-center mb-1">
                <i class="fa fa-home text-lg {{ request()->is('/') ? 'text-secondary' : 'text-gray-400' }}"></i>
            </div>
            <span
                class="text-xs {{ request()->is('/') ? 'text-secondary font-medium' : 'text-gray-500' }} truncate">Beranda</span>
        </a>

        <!-- Recipes Tab (with submenu) -->
        <button @click="toggleSubmenu('recipes')" class="flex flex-col items-center p-2 min-w-0 relative">
            <div class="w-6 h-6 flex items-center justify-center mb-1">
                <i class="fa fa-utensils text-lg"
                    :class="activeSubmenu === 'recipes' ||
                        {{ request()->is('recipes*') || request()->is('savoryai*') || request()->is('explore*') ? 'true' : 'false' }} ?
                        'text-secondary' : 'text-gray-400'"></i>
            </div>
            <span class="text-xs truncate"
                :class="activeSubmenu === 'recipes' ||
                    {{ request()->is('recipes*') || request()->is('savoryai*') || request()->is('explore*') ? 'true' : 'false' }} ?
                    'text-secondary font-medium' : 'text-gray-500'">Resep</span>
            <!-- Active indicator -->
            <div x-show="activeSubmenu === 'recipes'" class="absolute -top-1 w-1 h-1 bg-secondary rounded-full"></div>
        </button>

        <!-- Creators Tab -->
        <a href="{{ route('creators.index') }}" wire:navigate class="flex flex-col items-center p-2 min-w-0">
            <div class="w-6 h-6 flex items-center justify-center mb-1">
                <i
                    class="fa fa-users text-lg {{ request()->is('creators*') ? 'text-secondary' : 'text-gray-400' }}"></i>
            </div>
            <span
                class="text-xs {{ request()->is('creators*') ? 'text-secondary font-medium' : 'text-gray-500' }} truncate">Creators</span>
        </a>

        <!-- Profile Tab (with submenu) -->
        <button @click="toggleSubmenu('profile')" class="flex flex-col items-center p-2 min-w-0 relative">
            <div class="w-6 h-6 flex items-center justify-center mb-1">
                @if (Auth::user()->avatar)
                    <img class="w-5 h-5 rounded-full object-cover" src="{{ Auth::user()->avatar }}" alt="Profile">
                @else
                    <i class="fa fa-user text-lg"
                        :class="activeSubmenu === 'profile' ||
                            {{ request()->is('admin*') || request()->is('dashboard*') || request()->is('bookmarks*') || request()->is('suggestions*') ? 'true' : 'false' }} ?
                            'text-secondary' : 'text-gray-400'"></i>
                @endif
            </div>
            <span class="text-xs truncate"
                :class="activeSubmenu === 'profile' ||
                    {{ request()->is('admin*') || request()->is('dashboard*') || request()->is('bookmarks*') ? 'true' : 'false' }} ?
                    'text-secondary font-medium' : 'text-gray-500'">Profil</span>
            <div x-show="activeSubmenu === 'profile'" class="absolute -top-1 w-1 h-1 bg-secondary rounded-full"></div>
        </button>
    </div>
</div>
