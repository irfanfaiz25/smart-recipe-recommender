@if (request()->is('/'))
    <div x-data="{ isScrolled: false }" x-init="window.addEventListener('scroll', () => { isScrolled = window.scrollY > 0 })"
        class="fixed w-full z-50 bg-transparent transition-all duration-300 text-text-primary dark:text-text-dark-primary flex justify-end lg:justify-between items-center px-20 py-5"
        :class="{ 'bg-white dark:bg-bg-dark-primary shadow-md': isScrolled, 'bg-transparent': !isScrolled }">
    @else
        <div
            class="fixed w-full z-50 bg-transparent transition-all duration-300 text-text-primary dark:text-text-dark-primary flex justify-end lg:justify-between items-center bg-white dark:bg-bg-dark-primary shadow-md px-20 py-5">
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
                            class="flex items-center text-base font-normal cursor-pointer hover:scale-110 transition-all duration-300 hover:text-secondary {{ request()->is($menu['request']) ? 'text-secondary font-semibold' : '' }}"
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
                        <li class="text-base font-normal cursor-pointer hover:scale-110 transition-all duration-300 hover:text-secondary"
                            :class="{
                                'text-secondary font-semibold': {{ request()->is($menu['request']) ? 'true' : 'false' }},
                                'text-white': !isScrolled && !{{ request()->is($menu['request']) ? 'true' : 'false' }},
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
            <a href="{{ route('auth.google.redirect') }}"
                class="px-4 py-2 border flex gap-2 rounded-lg hover:shadow transition duration-150"
                :class="{
                    'text-text-dark-primary border-white hover:border-gray-300 hover:text-gray-300': !isScrolled,
                    'text-text-primary dark:text-text-dark-primary border-gray-800 dark:border-gray-700 hover:border-gray-600 hover:text-gray-600': isScrolled
                }">
                <img class="w-6 h-6" src="https://www.svgrepo.com/show/475656/google-color.svg" loading="lazy"
                    alt="google logo">
                <span>Login with Google</span>
            </a>
        @else
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" @click.away="open = false"
                    class="flex items-center text-base font-normal cursor-pointer hover:scale-110 transition-all duration-300 hover:text-secondary capitalize"
                    :class="{
                        'text-white': !isScrolled,
                        'text-text-primary dark:text-text-dark-primary': isScrolled
                    }">
                    <i class="fa fa-circle-user mr-2 text-xl"></i>
                    {{ Auth::user()->name }}
                </button>
                <div x-show="open" x-transition
                    class="absolute right-0 mt-6 w-48 bg-white dark:bg-bg-dark-primary rounded-md shadow-lg py-1">
                    <form method="POST" action="{{ route('auth.logout') }}">
                        @csrf
                        <button
                            class="w-full block px-4 py-2.5 text-sm text-text-primary dark:text-text-dark-primary hover:bg-gray-100 hover:text-secondary dark:hover:bg-gray-800 text-start">
                            <i class="fa-solid fa-arrow-right-from-bracket mr-2"></i>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        @endif <!-- Profile Toggle Button -->
        {{-- <button wire:click='profileToggle' class="focus:outline-none">
            <i class="fa-solid fa-circle-user text-2xl"></i>
        </button> --}}

        <!-- Dropdown Menu -->
        @if ($isProfileButtonVisible)
            <div
                class="absolute top-10 right-0 mt-2 w-52 bg-bg-primary dark:bg-bg-dark-primary text-neutral-800 dark:text-text-dark-primary border dark:border-[#3c3c3c] rounded shadow-lg z-50">
                <div class="py-2">
                    <div class="px-4 pt-1 pb-2">
                        <div class="flex items-center space-x-2 pl-1 py-1">
                            <i class="fa-solid fa-circle-user text-xl"></i>
                            <span class="font-semibold">
                                @if (Auth::check())
                                    {{ Auth::user()->name }}
                                @else
                                    User
                                @endif
                            </span>
                        </div>
                    </div>

                    <div class="border-t border-neutral-200/80 dark:border-[#3c3c3c] flex justify-center">
                        <div class="mx-4 my-2">
                            <div class="flex z-50 space-x-1">
                                <!-- Light Mode Button -->
                                <div class="rounded-md cursor-pointer hover:text-gray-500 px-7 py-2 duration-100"
                                    @click="
                                         darkMode = false;
                                         localStorage.setItem('darkMode', false);
                                         document.documentElement.classList.remove('dark');
                                         $wire.profileToggle();
                                     "
                                    :class="darkMode ? 'text-text-primary dark:text-text-dark-primary' :
                                        'bg-neutral-100 text-secondary'">
                                    <i class="fa-regular fa-lightbulb text-lg"></i>
                                </div>

                                <!-- Dark Mode Button -->
                                <div class="rounded-md cursor-pointer hover:text-gray-500 px-7 py-2 duration-100"
                                    @click="
                                         darkMode = true;
                                         localStorage.setItem('darkMode', true);
                                         document.documentElement.classList.add('dark');
                                         $wire.profileToggle();
                                     "
                                    :class="darkMode ? 'bg-[#303030] text-secondary' : 'text-text-primary'">
                                    <i class="fa-solid fa-lightbulb text-lg"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="border-t border-neutral-200/80 dark:border-[#3c3c3c]">
                        <div class="mx-1 pt-2 pb-2">
                            <a href="{{ route('user-management.index') }}" wire:navigate
                                class="hover:bg-neutral-100 dark:hover:bg-[#373636] {{ $isSetting ? 'text-green-500 bg-neutral-100 dark:bg-[#373636]' : 'text-text-primary dark:text-text-dark-primary' }} px-4 py-2 rounded-md flex items-center space-x-2 text-sm cursor-pointer">
                                <i class="ri-user-settings-line text-xl"></i>
                                <span>Pengaturan</span>
                            </a>
                        </div>
                    </div> --}}
                    <div class="border-t border-neutral-200/80 dark:border-[#3c3c3c]">
                        <div class="mx-1 pt-2">
                            <div wire:click='logout'
                                class="hover:bg-neutral-100 dark:hover:bg-[#373636] px-4 py-2 rounded-md flex items-center space-x-2 text-sm cursor-pointer">
                                <i class="fa-solid fa-right-from-bracket text-lg"></i>
                                <span>Keluar</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

</div>
