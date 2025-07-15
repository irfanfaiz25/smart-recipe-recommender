@if (request()->is('/') || request()->is('creators'))
    <div x-data="{ isScrolled: false, mobileMenuOpen: false }" x-init="window.addEventListener('scroll', () => { isScrolled = window.scrollY > 0 })"
        class="hidden md:block fixed w-full z-50 bg-transparent transition-all duration-300 text-text-primary px-4 md:px-8 lg:px-20 py-4"
        :class="{
            'bg-white bg-opacity-70 backdrop-blur-md shadow-md': isScrolled,
            'bg-transparent': !isScrolled
        }">
    @else
        <div x-data="{ mobileMenuOpen: false }" x-init="window.addEventListener('scroll', () => { isScrolled = window.scrollY > 0 })"
            class="hidden md:block fixed w-full z-50 bg-transparent transition-all duration-300 text-text-primary bg-white bg-opacity-20 backdrop-blur-md shadow-md px-4 md:px-8 lg:px-20 py-4">
@endif

<nav class="flex justify-between items-center">
    <!-- Logo -->
    <div class="flex items-center">
        <img src="{{ asset('storage/img/main/logo-orange.png') }}" alt="logo" class="w-9 h-9">
        <h1 class="relative font-semibold text-xl ml-2 font-display transition-colors duration-300"
            :class="{ 'text-white': !isScrolled, 'text-text-primary': isScrolled }">
            SavoryAI<span class="absolute bottom-0 left-[5rem] text-primary text-3xl">.</span>
        </h1>
    </div>

    <!-- Mobile menu button -->
    <button @click="mobileMenuOpen = !mobileMenuOpen"
        class="px-3 py-1.5 bg-white bg-opacity-80 backdrop-blur-md rounded-md lg:hidden">
        <i class="fas" :class="mobileMenuOpen ? 'fa-times' : 'fa-bars'"
            :class="{ 'text-black': !isScrolled, 'text-white': isScrolled }"></i>
    </button>

    <!-- Desktop Navigation -->
    <div class="hidden lg:flex items-center space-x-12">
        @auth
            <ul class="flex justify-end items-center space-x-6 font-sans">
                @foreach ($menus as $menu)
                    @if (isset($menu['dropdown']))
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" @click.away="open = false"
                                class="flex items-center text-sm font-normal cursor-pointer hover:scale-110 transition-all duration-300 hover:text-secondary {{ request()->is($menu['request']) ||collect($menu['dropdown'])->contains(function ($item) {return request()->is($item['request']);})? 'text-secondary font-semibold': '' }}"
                                :class="{
                                    'text-white': !isScrolled,
                                    'text-text-primary': isScrolled
                                }">
                                {{ $menu['name'] }}
                                <i class="fas fa-chevron-down ml-1 text-xs transition-transform duration-300"
                                    :class="{ 'transform rotate-180': open }"></i>
                            </button>
                            <div x-show="open" x-transition
                                class="absolute right-0 mt-6 w-48 bg-white rounded-md shadow-lg py-1">
                                @foreach ($menu['dropdown'] as $item)
                                    <a href="{{ route($item['route']) }}"
                                        {{ $item['route'] != 'explore-recipes.index' ? 'wire:navigate' : '' }}
                                        class="block px-4 py-2.5 text-sm {{ request()->is($item['request']) ? 'text-secondary font-semibold bg-gray-100' : 'text-text-primary' }} hover:bg-gray-100 hover:text-secondary">
                                        {{ $item['name'] }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <a href="{{ route($menu['route']) }}" wire:navigate>
                            <li class="text-sm font-normal cursor-pointer hover:scale-110 transition-all duration-300 hover:text-secondary"
                                :class="{
                                    'text-secondary font-semibold': {{ request()->is($menu['request']) ? 'true' : 'false' }},
                                    'text-white': !isScrolled && !
                                        {{ request()->is($menu['request']) ? 'true' : 'false' }},
                                    'text-text-primary': isScrolled && !
                                        {{ request()->is($menu['request']) ? 'true' : 'false' }}
                                }">
                                {{ $menu['name'] }}
                            </li>
                        </a>
                    @endif
                @endforeach
            </ul>
        @endauth

        {{-- profile menu --}}
        <div class="relative flex items-center space-x-4">
            @if (!Auth::check())
                <a href="{{ route('login') }}" wire:navigate
                    class="group relative inline-flex items-center justify-center px-6 py-2.5 overflow-hidden font-medium transition-all rounded-lg"
                    :class="{
                        'bg-white/10 hover:bg-white/20': !isScrolled,
                        'bg-secondary/10 hover:bg-secondary/20': isScrolled
                    }">
                    <span class="relative flex items-center gap-2"
                        :class="{
                            'text-white': !isScrolled,
                            'text-secondary': isScrolled
                        }">
                        <span class="text-sm font-semibold">Masuk atau Daftar</span>
                        <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </span>
                </a>
            @else
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" @click.away="open = false"
                        class="flex items-center gap-3 px-4 py-2 rounded-full transition-all duration-300 hover:scale-105"
                        :class="{
                            'bg-white/10 hover:bg-white/20 text-white': !isScrolled,
                            'bg-secondary/10 hover:bg-secondary/20 text-text-primary': isScrolled
                        }">
                        @if (Auth::check() && Auth::user()->avatar)
                            <img class="h-8 w-8 rounded-full object-cover ring-2 ring-secondary/30"
                                src="{{ Auth::user()->avatar }}" alt="{{ Auth::user()->name }}">
                        @else
                            <div class="h-8 w-8 rounded-full bg-secondary/20 flex items-center justify-center">
                                <i class="fa fa-circle-user text-2xl"></i>
                            </div>
                        @endif
                        <span class="text-sm font-medium capitalize">{{ Auth::user()->name }}</span>
                        <i class="fas fa-chevron-down text-xs transition-transform duration-300"
                            :class="{ 'transform rotate-180': open }"></i>
                    </button>

                    <div x-show="open" x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                        class="absolute right-0 mt-5 w-56 rounded-xl bg-white ring-1 ring-black ring-opacity-5 divide-y divide-gray-100 focus:outline-none">
                        @role('admin')
                            <div class="p-2">
                                <a href="{{ route('admin-recipes.index') }}"
                                    class="group flex items-center gap-3 px-4 py-2.5 text-sm rounded-lg transition-all duration-200 hover:bg-secondary/10 hover:text-secondary {{ $isSetting ? 'text-secondary bg-secondary/10' : 'text-text-primary' }}">
                                    <i class="fa-solid fa-user-shield text-base"></i>
                                    <span>Admin Panel</span>
                                </a>
                            </div>
                        @endrole
                        @role('creators')
                            <div class="p-2">
                                <a href="{{ route('dashboard.index') }}"
                                    class="group flex items-center gap-3 px-4 py-2.5 text-sm rounded-lg transition-all duration-200 hover:bg-secondary/10 hover:text-secondary {{ $isSetting ? 'text-secondary bg-secondary/10' : 'text-text-primary' }}">
                                    <i class="fa-solid fa-kitchen-set text-base"></i>
                                    <span>Creators Panel</span>
                                </a>
                            </div>
                        @endrole
                        <div class="p-2">
                            <a href="{{ route('bookmarks.index') }}" wire:navigate
                                class="group flex items-center gap-3 px-4 py-2.5 text-sm rounded-lg transition-all duration-200 hover:bg-secondary/10 hover:text-secondary {{ $isSetting ? 'text-secondary bg-secondary/10' : 'text-text-primary' }}">
                                <i class="fa-solid fa-bookmark text-base"></i>
                                <span>Favorit Saya</span>
                            </a>
                        </div>
                        <div class="p-2">
                            <a href="{{ route('history.index') }}" wire:navigate
                                class="group flex items-center gap-3 px-4 py-2.5 text-sm rounded-lg transition-all duration-200 hover:bg-secondary/10 hover:text-secondary {{ $isSetting ? 'text-secondary bg-secondary/10' : 'text-text-primary' }}">
                                <i class="fa-solid fa-history text-base"></i>
                                <span>Riwayat Masak</span>
                            </a>
                        </div>
                        <div class="p-2">
                            <a href="{{ route('suggestions.index') }}" wire:navigate
                                class="group flex items-center gap-3 px-4 py-2.5 text-sm rounded-lg transition-all duration-200 hover:bg-secondary/10 hover:text-secondary {{ $isSetting ? 'text-secondary bg-secondary/10' : 'text-text-primary' }}">
                                <i class="fa-solid fa-file-pen text-base"></i>
                                <span>Saran & Masukan</span>
                            </a>
                        </div>
                        <div class="p-2">
                            <form method="POST" action="{{ route('auth.logout') }}">
                                @csrf
                                <button
                                    class="group flex items-center gap-3 px-4 py-2.5 text-sm rounded-lg transition-all duration-200 hover:bg-red-500/10 hover:text-red-500 w-full text-text-primary">
                                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                                    <span>Logout</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Mobile Navigation -->
    <div x-show="mobileMenuOpen" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        class="absolute top-full left-0 right-0 bg-white shadow-lg mt-2 p-4 lg:hidden">
        @auth
            <!-- User Profile Section -->
            <div class="border-b border-gray-200 pb-4 mb-4">
                <div class="flex items-center gap-3 mb-3">
                    @if (Auth::check() && Auth::user()->avatar)
                        <img class="h-10 w-10 rounded-full object-cover ring-2 ring-secondary/30"
                            src="{{ Auth::user()->avatar }}" alt="{{ Auth::user()->name }}">
                    @else
                        <div class="h-10 w-10 rounded-full bg-secondary/20 flex items-center justify-center">
                            <i class="fa fa-circle-user text-2xl text-secondary"></i>
                        </div>
                    @endif
                    <div>
                        <p class="text-sm font-medium text-text-primary capitalize">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                    </div>
                </div>

                <!-- Profile Menu Items -->
                <div class="space-y-2">
                    @role('admin')
                        <a href="{{ route('admin-recipes.index') }}"
                            class="flex items-center gap-3 px-3 py-2 text-sm rounded-lg transition-all duration-200 hover:bg-secondary/10 hover:text-secondary {{ $isSetting ? 'text-secondary bg-secondary/10' : 'text-text-primary' }}">
                            <i class="fa-solid fa-user-shield text-base"></i>
                            <span>Admin Panel</span>
                        </a>
                    @endrole
                    @role('creators')
                        <a href="{{ route('dashboard.index') }}"
                            class="flex items-center gap-3 px-3 py-2 text-sm rounded-lg transition-all duration-200 hover:bg-secondary/10 hover:text-secondary {{ $isSetting ? 'text-secondary bg-secondary/10' : 'text-text-primary' }}">
                            <i class="fa-solid fa-kitchen-set text-base"></i>
                            <span>Creators Panel</span>
                        </a>
                    @endrole
                    <a href="{{ route('bookmarks.index') }}" wire:navigate
                        class="flex items-center gap-3 px-3 py-2 text-sm rounded-lg transition-all duration-200 hover:bg-secondary/10 hover:text-secondary {{ $isSetting ? 'text-secondary bg-secondary/10' : 'text-text-primary' }}">
                        <i class="fa-solid fa-bookmark text-base"></i>
                        <span>Favorit Saya</span>
                    </a>
                    <a href="{{ route('history.index') }}" wire:navigate
                        class="flex items-center gap-3 px-3 py-2 text-sm rounded-lg transition-all duration-200 hover:bg-secondary/10 hover:text-secondary {{ $isSetting ? 'text-secondary bg-secondary/10' : 'text-text-primary' }}">
                        <i class="fa-solid fa-history text-base"></i>
                        <span>Riwayat Masak</span>
                    </a>
                    <a href="{{ route('suggestions.index') }}" wire:navigate
                        class="flex items-center gap-3 px-3 py-2 text-sm rounded-lg transition-all duration-200 hover:bg-secondary/10 hover:text-secondary {{ $isSetting ? 'text-secondary bg-secondary/10' : 'text-text-primary' }}">
                        <i class="fa-solid fa-file-pen text-base"></i>
                        <span>Saran & Masukan</span>
                    </a>
                    <form method="POST" action="{{ route('auth.logout') }}">
                        @csrf
                        <button
                            class="flex items-center gap-3 px-3 py-2 text-sm rounded-lg transition-all duration-200 hover:bg-red-500/10 hover:text-red-500 w-full text-left text-text-primary">
                            <i class="fa-solid fa-arrow-right-from-bracket"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Navigation Menu -->
            <ul class="space-y-4">
                @foreach ($menus as $menu)
                    @if (isset($menu['dropdown']))
                        <div x-data="{ open: false }">
                            <button @click="open = !open"
                                class="flex items-center justify-between w-full text-sm font-normal py-2 {{ request()->is($menu['request']) ? 'text-secondary font-semibold' : 'text-text-primary' }}">
                                {{ $menu['name'] }}
                                <i class="fas fa-chevron-down text-xs" :class="{ 'transform rotate-180': open }"></i>
                            </button>
                            <div x-show="open" class="pl-4 space-y-2 mt-2">
                                @foreach ($menu['dropdown'] as $item)
                                    <a href="{{ route($item['route']) }}"
                                        {{ $item['route'] != 'explore-recipes.index' ? 'wire:navigate' : '' }}
                                        class="block py-2 text-sm {{ request()->is($item['request']) ? 'text-secondary font-semibold' : 'text-text-primary' }}">
                                        {{ $item['name'] }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <li>
                            <a href="{{ route($menu['route']) }}" wire:navigate
                                class="block py-2 text-sm {{ request()->is($menu['request']) ? 'text-secondary font-semibold' : 'text-text-primary' }}">
                                {{ $menu['name'] }}
                            </a>
                        </li>
                    @endif
                @endforeach
            </ul>
        @else
            <!-- Login Button for Mobile -->
            <div class="mb-4 pb-4 border-b border-gray-200">
                <a href="{{ route('login') }}" wire:navigate
                    class="flex items-center justify-center gap-2 w-full px-4 py-3 bg-secondary text-white rounded-lg font-medium transition-all duration-200 hover:bg-secondary/90">
                    <span>Masuk atau Daftar</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                </a>
            </div>

            <!-- Navigation Menu for Guests -->
            <ul class="space-y-4">
                @foreach ($menus as $menu)
                    @if (isset($menu['dropdown']))
                        <div x-data="{ open: false }">
                            <button @click="open = !open"
                                class="flex items-center justify-between w-full text-sm font-normal py-2 {{ request()->is($menu['request']) ? 'text-secondary font-semibold' : 'text-text-primary' }}">
                                {{ $menu['name'] }}
                                <i class="fas fa-chevron-down text-xs" :class="{ 'transform rotate-180': open }"></i>
                            </button>
                            <div x-show="open" class="pl-4 space-y-2 mt-2">
                                @foreach ($menu['dropdown'] as $item)
                                    <a href="{{ route($item['route']) }}"
                                        {{ $item['route'] != 'explore-recipes.index' ? 'wire:navigate' : '' }}
                                        class="block py-2 text-sm {{ request()->is($item['request']) ? 'text-secondary font-semibold' : 'text-text-primary' }}">
                                        {{ $item['name'] }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <li>
                            <a href="{{ route($menu['route']) }}" wire:navigate
                                class="block py-2 text-sm {{ request()->is($menu['request']) ? 'text-secondary font-semibold' : 'text-text-primary' }}">
                                {{ $menu['name'] }}
                            </a>
                        </li>
                    @endif
                @endforeach
            </ul>
        @endauth
    </div>

</nav>
</div>
