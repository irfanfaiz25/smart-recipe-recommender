@if (request()->is('/'))
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
    <div class="bg-gradient-to-r from-secondary to-secondary-light inline-block text-transparent bg-clip-text">
        <i class="fa-solid fa-plate-wheat text-xl"></i>
    </div>
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
                            class="flex items-center text-sm font-normal cursor-pointer hover:scale-110 transition-all duration-300 hover:text-secondary {{ request()->is($menu['request']) ? 'text-secondary font-semibold' : '' }}"
                            :class="{
                                'text-white': !isScrolled,
                                'text-text-primary dark:text-text-dark-primary': isScrolled
                            }">
                            {{ $menu['name'] }}
                            <i class="fas fa-chevron-down ml-1 text-xs"></i>
                        </button>
                        <div x-show="open" x-transition
                            class="absolute right-0 mt-6 w-48 bg-white dark:bg-bg-dark-primary rounded-md shadow-lg py-1">
                            @foreach ($menu['dropdown'] as $item)
                                <a href="{{ route($item['route']) }}" wire:navigate
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
                class="relative inline-flex items-center justify-center p-4 px-6 py-3 overflow-hidden font-medium transition text-white duration-300 ease-out border-2 rounded-full shadow-md group"
                :class="{
                    'border-white': !isScrolled,
                    'border-secondary': isScrolled
                }">
                <span
                    class="absolute inset-0 flex items-center justify-center w-full h-full duration-300 -translate-x-full group-hover:translate-x-0 ease"
                    :class="{
                        'bg-white text-secondary': !isScrolled,
                        'bg-secondary text-white': isScrolled
                    }">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                </span>
                <span
                    class="absolute flex items-center justify-center w-full h-full transition-all duration-300 transform group-hover:translate-x-full ease"
                    :class="{
                        'text-white': !isScrolled,
                        'text-secondary': isScrolled
                    }">Masuk
                    atau Daftar</span>
                <span class="relative invisible">Masuk atau Daftar</span>
            </a>
        @else
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" @click.away="open = false"
                    class="flex items-center text-sm font-normal cursor-pointer transition-all duration-300 hover:text-secondary hover:scale-105 hover:font-medium capitalize"
                    :class="{
                        'text-white': !isScrolled,
                        'text-text-primary dark:text-text-dark-primary': isScrolled
                    }">
                    @if (Auth::check() && Auth::user()->avatar)
                        <img class="h-9 w-9 rounded-full object-cover mr-2" src="{{ asset(Auth::user()->avatar) }}"
                            alt="{{ Auth::user()->avatar }}">
                    @else
                        <i class="fa fa-circle-user mr-2 text-2xl"></i>
                    @endif
                    {{ Auth::user()->name }}
                </button>
                <div x-show="open" x-transition
                    class="absolute right-0 p-2 mt-6 w-52 bg-white dark:bg-bg-dark-primary rounded-md shadow-lg py-1">
                    <form method="POST" action="{{ route('auth.logout') }}">
                        @csrf
                        <button
                            class="w-full block px-4 py-2.5 text-sm text-text-primary dark:text-text-dark-primary hover:bg-gray-100 hover:text-secondary dark:hover:bg-gray-800 text-start rounded-md">
                            <i class="fa-solid fa-arrow-right-from-bracket mr-2"></i>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        @endif

    </div>

</div>

</div>
