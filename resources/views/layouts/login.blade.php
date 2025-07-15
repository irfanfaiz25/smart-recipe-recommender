<!DOCTYPE html>
<html lang="en" class="h-full"
    style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url({{ asset('/storage/img/main/main-background.jpg') }}) no-repeat center center fixed; background-size: cover;">

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

    <title>Login</title>

    {{-- logo title --}}
    <link rel="icon" href="{{ asset('storage/img/main/logo-orange.png') }}">

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

<body class="h-full flex items-center justify-center p-4 font-sans">

    @yield('content')

    <!-- Include GSAP for animations -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>

    <script>
        gsap.to('.fab', {
            y: -10,
            stagger: 0.1,
            duration: 0.8,
            repeat: -1,
            yoyo: true,
            ease: 'power1.inOut'
        });
    </script>

    @livewireScripts

    <x-toaster-hub />

</body>

</html>
