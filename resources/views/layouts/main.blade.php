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
    @vite('resources/css/app.css')

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

<body class="bg-bg-primary dark:bg-bg-secondary font-sans">

    @livewire('header-layout')

    <div class="relative">
        <div class="flex gap-6 pt-16">

            @livewire('sidebar-toggle')

            <div
                class="flex-1 p-4 text-xl bg-[#edf5e4] dark:bg-[#1c1c1c] text-gray-900 dark:text-gray-50 font-semibold overflow-auto relative min-h-screen duration-500 -ml-5 lg:ml-64">

                @yield('content')

            </div>
        </div>
    </div>


    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    @livewireScripts

    @stack('script')

</body>

</html>
