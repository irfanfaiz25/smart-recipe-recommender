<!DOCTYPE html>
<html lang="en" class="antialiased">

<head>
    <script>
        // Initialize dark mode on page load
        function initializeDarkMode() {
            const isDark = localStorage.getItem('darkMode') === 'true';
            document.documentElement.classList.toggle('dark', isDark);
        }

        // Apply dark mode after Livewire navigation
        document.addEventListener('livewire:navigated', () => {
            initializeDarkMode();
        });

        // Initial setup
        initializeDarkMode();
    </script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Document</title>

    {{-- logo title --}}
    <link rel="icon" href="{{ asset('img/Logo.png') }}">

    <!-- Include Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- google font --}}
    <link
        href="https://fonts.googleapis.com/css2?family=Barlow:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Eczar:wght@400..800&family=Fira+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Raleway:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    {{-- icon --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>

    @livewireStyles
</head>

<body class="bg-[#edf5e4] dark:bg-[#1c1c1c] font-sans">

    @if (str_contains(request()->path(), 'creators/') || str_contains(request()->path(), 'admin/'))
        @livewire('header-layout')

        <div x-data="{ pageLoaded: false }" x-init="setTimeout(() => pageLoaded = true, 100)" class="relative bg-gray-100 dark:bg-[#1c1c1c]">
            <div class="flex gap-6 pt-16">

                @livewire('sidebar-toggle')

                <div
                    class="flex-1 p-4 text-xl bg-gray-100 dark:bg-[#1c1c1c] text-gray-900 dark:text-gray-50 font-semibold overflow-auto relative min-h-screen duration-500 -ml-5 lg:ml-64">

                    @yield('content')

                </div>
            </div>
        </div>
    @else
        @livewire('user-header')

        <div class="relative">
            <div class="">
                <div x-data="{ pageLoaded: false }" x-init="setTimeout(() => pageLoaded = true, 100)"
                    class="text-xl bg-white dark:bg-[#1c1c1c] text-gray-900 dark:text-gray-50 font-semibold overflow-auto relative min-h-screen duration-500">

                    <!-- Page Content with Transitions -->
                    {{-- <div x-show="pageLoaded" x-transition:enter="transform transition-all duration-700 ease-out"
                        x-transition:enter-start="opacity-0 translate-y-8 scale-95"
                        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                        x-transition:leave="transform transition-all duration-500 ease-in"
                        x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                        x-transition:leave-end="opacity-0 -translate-y-8 scale-95"> --}}
                    @yield('content')
                    {{-- </div> --}}

                </div>
            </div>
        </div>
    @endif


    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    @livewireScripts

    <x-toaster-hub />

    @stack('script')

</body>

</html>
