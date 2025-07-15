<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

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

    <style>
        @keyframes float {
            0% {
                transform: translateY(0px) translateX(0px);
            }

            50% {
                transform: translateY(-20px) translateX(20px);
            }

            100% {
                transform: translateY(0px) translateX(0px);
            }
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        .animate-float-delayed {
            animation: float 8s ease-in-out infinite;
            animation-delay: 1s;
        }

        .animate-float-slow {
            animation: float 10s ease-in-out infinite;
            animation-delay: 2s;
        }

        .animate-bounce-slow {
            animation: bounce 2s ease-in-out infinite;
        }
    </style>
</head>

<body>
    <div class="min-h-screen flex items-center justify-center bg-gray-50 relative overflow-hidden">
        <!-- Animated background elements -->
        <div class="absolute inset-0 z-0">
            <div
                class="animate-float absolute top-1/4 left-1/4 w-64 h-64 bg-blue-100 rounded-full mix-blend-multiply filter blur-xl opacity-70">
            </div>
            <div
                class="animate-float-delayed absolute top-1/2 right-1/4 w-72 h-72 bg-purple-100 rounded-full mix-blend-multiply filter blur-xl opacity-70">
            </div>
            <div
                class="animate-float-slow absolute bottom-1/4 left-1/3 w-80 h-80 bg-pink-100 rounded-full mix-blend-multiply filter blur-xl opacity-70">
            </div>
        </div>

        <div class="max-w-md w-full text-center relative z-10">
            <div class="mb-8">
                <h1 class="text-8xl font-bold text-rose-500 animate-bounce-slow">403</h1>
                <h2 class="text-2xl font-semibold font-display text-primary mb-4">Forbidden</h2>
                <p class="text-gray-500 text-base font-medium mb-8">
                    Maaf, Anda tidak memiliki akses ke halaman ini.
                </p>
            </div>

            <button onclick="window.history.back()"
                class="inline-block bg-green-50 hover:bg-primary border-2 border-primary text-base font-semibold text-primary hover:text-white px-6 py-3 rounded-xl transition-all transform hover:scale-105 hover:shadow-lg">
                <i class="fas fa-home mr-2"></i>
                Kembali ke Halaman Sebelumnya
            </button>
        </div>
    </div>
</body>

</html>
