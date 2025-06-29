@if (request()->is('/') || request()->is('creators'))
    <div x-data="{ isScrolled: false }" x-init="window.addEventListener('scroll', () => { isScrolled = window.scrollY > 0 })"
        class="fixed w-full z-50 bg-transparent transition-all duration-300 text-text-primary dark:text-text-dark-primary flex justify-end lg:justify-between items-center px-20 py-4"
        :class="{
            'bg-white bg-opacity-70 backdrop-blur-md dark:bg-bg-dark-primary shadow-md': isScrolled,
            'bg-transparent': !
                isScrolled
        }">
    @else
        <div
            class="fixed w-full z-50 bg-transparent transition-all duration-300 text-text-primary dark:text-text-dark-primary flex justify-end lg:justify-between items-center bg-white bg-opacity-20 backdrop-blur-md dark:bg-bg-dark-primary shadow-md px-20 py-4">
@endif

<div class="hidden lg:flex items-center">
    <img src="{{ asset('storage/img/main/savory-logo.png') }}" alt="logo" class="w-9 h-9">
    <h1 class="relative font-semibold text-xl ml-2 font-display transition-colors duration-300"
        :class="{ 'text-white': !isScrolled, 'text-text-primary dark:text-text-dark-primary': isScrolled }">
        SavoryAI<span class="absolute bottom-0 left-[5rem] text-primary dark:text-primary-light text-3xl">.</span>
    </h1>
</div>

{{-- navbar menu --}}
<div class="flex items-center space-x-12">
    @auth
        <ul class="flex justify-end items-center space-x-6 font-sans">
            @foreach ($menus as $menu)
                @if (isset($menu['dropdown']))
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" @click.away="open = false"
                            class="flex items-center text-sm font-normal cursor-pointer hover:scale-110 transition-all duration-300 hover:text-secondary {{ request()->is($menu['request']) ||collect($menu['dropdown'])->contains(function ($item) {return request()->is($item['request']);})? 'text-secondary font-semibold': '' }}"
                            :class="{
                                'text-white': !isScrolled,
                                'text-text-primary dark:text-text-dark-primary': isScrolled
                            }">
                            {{ $menu['name'] }}
                            <i class="fas fa-chevron-down ml-1 text-xs transition-transform duration-300"
                                :class="{ 'transform rotate-180': open }"></i>
                        </button>
                        <div x-show="open" x-transition
                            class="absolute right-0 mt-6 w-48 bg-white dark:bg-bg-dark-primary rounded-md shadow-lg py-1">
                            @foreach ($menu['dropdown'] as $item)
                                <a href="{{ route($item['route']) }}"
                                    {{ $item['route'] != 'explore-recipes.index' ? 'wire:navigate' : '' }}
                                    class="block px-4 py-2.5 text-sm
                                    {{ request()->is($item['request']) ? 'text-secondary font-semibold bg-gray-100' : 'text-text-primary dark:text-text-dark-primary' }}  hover:bg-gray-100 hover:text-secondary dark:hover:bg-gray-800">
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
                                'text-text-primary dark:text-text-dark-primary': isScrolled && !
                                    {{ request()->is($menu['request']) ? 'true' : 'false' }}
                            }">
                            {{ $menu['name'] }}
                        </li>
                    </a>
                @endif
            @endforeach
        </ul>
    @endauth
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
                        'bg-secondary/10 hover:bg-secondary/20 text-text-primary dark:text-text-dark-primary': isScrolled
                    }">
                    @if (Auth::check() && Auth::user()->avatar)
                        <img class="h-8 w-8 rounded-full object-cover ring-2 ring-secondary/30"
                            src="{{ Auth::user()->avatar_url }}" alt="{{ Auth::user()->name }}">
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
                    class="absolute right-0 mt-5 w-56 rounded-xl bg-white dark:bg-bg-dark-primary shadow-lg ring-1 ring-black ring-opacity-5 divide-y divide-gray-100 dark:divide-gray-800 focus:outline-none">
                    @role('admin')
                        <div class="p-2">
                            <a href="{{ route('admin-recipes.index') }}"
                                class="group flex items-center gap-3 px-4 py-2.5 text-sm rounded-lg transition-all duration-200 hover:bg-secondary/10 hover:text-secondary {{ $isSetting ? 'text-secondary bg-secondary/10' : 'text-text-primary dark:text-text-dark-primary' }}">
                                <i class="fa-solid fa-user-shield text-base"></i>
                                <span>Admin Panel</span>
                            </a>
                        </div>
                    @endrole
                    @role('creators')
                        <div class="p-2">
                            <a href="{{ route('dashboard.index') }}"
                                class="group flex items-center gap-3 px-4 py-2.5 text-sm rounded-lg transition-all duration-200 hover:bg-secondary/10 hover:text-secondary {{ $isSetting ? 'text-secondary bg-secondary/10' : 'text-text-primary dark:text-text-dark-primary' }}">
                                <i class="fa-solid fa-kitchen-set text-base"></i>
                                <span>Creators Panel</span>
                            </a>
                        </div>
                    @endrole
                    <div class="p-2">
                        <a href="{{ route('bookmarks.index') }}" wire:navigate
                            class="group flex items-center gap-3 px-4 py-2.5 text-sm rounded-lg transition-all duration-200 hover:bg-secondary/10 hover:text-secondary {{ $isSetting ? 'text-secondary bg-secondary/10' : 'text-text-primary dark:text-text-dark-primary' }}">
                            <i class="fa-solid fa-bookmark text-base"></i>
                            <span>Favorit Saya</span>
                        </a>
                    </div>
                    <div class="p-2">
                        <form method="POST" action="{{ route('auth.logout') }}">
                            @csrf
                            <button
                                class="group flex items-center gap-3 px-4 py-2.5 text-sm rounded-lg transition-all duration-200 hover:bg-red-500/10 hover:text-red-500 w-full text-text-primary dark:text-text-dark-primary">
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

</div>
