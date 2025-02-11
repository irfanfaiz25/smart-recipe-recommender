<div
    class="fixed w-full z-50 bg-white dark:bg-[#252525] text-gray-800 dark:text-gray-50 flex justify-end lg:justify-between items-center px-8 py-5 shadow-md">
    <div class="hidden lg:flex items-center">
        <i class="fa-solid fa-plate-wheat text-xl"></i>
        <h1 class="text-gray-800 dark:text-gray-50 font-semibold text-lg ml-2 font-sans">
            Food Recipe.
        </h1>
    </div>
    <div class="relative flex items-center space-x-4">
        <!-- Profile Toggle Button -->
        <button wire:click='profileToggle' class="focus:outline-none">
            <i class="fa-solid fa-circle-user text-2xl"></i>
        </button>

        <!-- Dropdown Menu -->
        @if ($isProfileButtonVisible)
            <div
                class="absolute top-10 right-0 mt-2 w-52 bg-white dark:bg-[#252525] text-gray-800 dark:text-gray-50 border dark:border-[#3c3c3c] rounded shadow-lg z-50">
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

                    <div class="border-t border-gray-200/80 dark:border-[#3c3c3c] flex justify-center">
                        <div class="mx-4 my-2">
                            <div class="flex z-50 space-x-1">
                                <div wire:click='profileToggle'
                                    class="rounded-md cursor-pointer hover:text-gray-500 px-7 py-2 duration-100"
                                    @click="darkMode= false"
                                    :class="darkMode ? 'text-gray-800 dark:text-gray-50' : 'bg-gray-100 text-primary'">
                                    <i class="fa-regular fa-lightbulb text-lg"></i>
                                </div>
                                <div wire:click='profileToggle'
                                    class="rounded-md cursor-pointer hover:text-gray-500 px-7 py-2 duration-100"
                                    @click="darkMode= true"
                                    :class="darkMode ? 'bg-[#303030] text-primary' : 'text-gray-800'">
                                    <i class="fa-solid fa-lightbulb text-lg"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="border-t border-gray-200/80 dark:border-[#3c3c3c]">
                        <div class="mx-1 pt-2 pb-2">
                            <a href="{{ route('user-management.index') }}" wire:navigate
                                class="hover:bg-gray-100 dark:hover:bg-[#373636] {{ $isSetting ? 'text-green-500 bg-gray-100 dark:bg-[#373636]' : 'text-gray-800 dark:text-gray-50' }} px-4 py-2 rounded-md flex items-center space-x-2 text-sm cursor-pointer">
                                <i class="ri-user-settings-line text-xl"></i>
                                <span>Pengaturan</span>
                            </a>
                        </div>
                    </div> --}}
                    <div class="border-t border-gray-200/80 dark:border-[#3c3c3c]">
                        <div class="mx-1 pt-2">
                            <div wire:click='logout'
                                class="hover:bg-gray-100 dark:hover:bg-[#373636] px-4 py-2 rounded-md flex items-center space-x-2 text-sm cursor-pointer">
                                <i class="ri-logout-circle-line text-xl"></i>
                                <span>Keluar</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
