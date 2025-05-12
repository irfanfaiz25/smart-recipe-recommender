@extends('layouts.main')

@section('content')
    <div class="relative overflow-hidden min-h-screen flex flex-col justify-center">
        <!-- Background Section -->
        <div class="absolute inset-0 w-full h-full">
            <img src="{{ asset('/storage/img/main/main-background.jpg') }}" class="w-full h-full object-cover"
                alt="background">
            <div class="absolute inset-0 bg-black/50"></div>
        </div>

        <!-- Content -->
        <!-- Content with transition -->
        <div x-show="pageLoaded" x-transition:enter="transform transition-all duration-700 ease-out"
            x-transition:enter-start="opacity-0 translate-y-8 scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 scale-100"
            x-transition:leave="transform transition-all duration-500 ease-in"
            x-transition:leave-start="opacity-100 translate-y-0 scale-100"
            x-transition:leave-end="opacity-0 -translate-y-8 scale-95" class="relative z-10 w-full h-full py-36">
            <!-- Your existing content here -->
            <div class="leading-[6.4rem] font-display">
                <h1
                    class="text-[70px] font-bold text-center bg-gradient-to-r from-[#FF564E] via-[#ff834e] to-[#FAD126] text-transparent bg-clip-text">
                    SavoryAI
                </h1>
                <h1 class="text-[70px] font-bold text-center text-text-dark-primary">
                    Your Personal <span
                        class="underline decoration-wavy decoration-[#FAD126] underline-offset-[15px]">Chef,</span>
                </h1>
                <h1
                    class="text-[70px] font-bold text-center bg-clip-text text-transparent bg-gradient-to-r from-text-primary via-green-400 to-text-primary bg-300% animate-shine">
                    Powered By AI
                </h1>
            </div>
            <div class="mt-16 flex justify-center items-center space-x-24">
                <div
                    class="space-y-3 bg-gradient-to-r from-[#64e9d1] via-[#8af5e2] to-[#43c8a9] text-transparent bg-clip-text">
                    <p class="text-lg text-center font-semibold">
                        20++
                    </p>
                    <div class="flex justify-center items-center space-x-2">
                        <i class="fa-regular fa-user text-lg"></i>
                        <span class="text-lg font-medium">Users</span>
                    </div>
                </div>
                <div class="space-y-3 text-[#43c8a9]">
                    <p class="text-lg text-center font-semibold">
                        500++
                    </p>
                    <div class="flex justify-center items-center space-x-2">
                        <i class="fa-regular fa-lemon text-lg"></i>
                        <span class="text-lg font-medium">Ingredients</span>
                    </div>
                </div>
                <div
                    class="space-y-3  bg-gradient-to-r from-[#43c8a9] via-[#8af5e2] to-[#8af5e2] text-transparent bg-clip-text">
                    <p class="text-lg text-center font-semibold">
                        1.5K++
                    </p>
                    <div class="flex justify-center items-center space-x-2">
                        <i class="fa-regular fa-file-lines text-lg"></i>
                        <span class="text-lg font-medium">Recipes</span>
                    </div>
                </div>
            </div>
            <div class="mt-20 flex justify-center items-center space-x-3">
                <a href="{{ Auth::check() ? route('savoryai.index') : route('login') }}" wire:navigate
                    class="relative rounded-lg px-8 py-3 overflow-hidden group bg-[#FF564E] hover:bg-gradient-to-r hover:from-[#FF564E] hover:to-[#ff834e] text-white hover:ring-2 hover:ring-offset-2 hover:ring-[#ff834e] transition-all ease-out duration-300 text-base">
                    <span
                        class="absolute right-0 w-8 h-32 -mt-12 transition-all duration-1000 transform translate-x-12 bg-white opacity-10 rotate-12 group-hover:-translate-x-40 ease"></span>
                    <span class="relative">Mulai Sekarang</span>
                </a>
            </div>
        </div>
    </div>

    <div class="mt-10 h-96 bg-white w-full"></div>
@endsection
