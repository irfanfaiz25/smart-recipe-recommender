@extends('layouts.main')

@section('content')
    <div class="md:mt-16 py-2 md:py-10 px-4 md:px-20 page-background bg-fixed bg-repeat min-h-screen relative">

        @livewire('floating-bookmarks')

        <div x-show="pageLoaded" x-transition:enter="transform transition-all duration-700 ease-out"
            x-transition:enter-start="opacity-0 translate-y-8 scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 scale-100"
            x-transition:leave="transform transition-all duration-500 ease-in"
            x-transition:leave-start="opacity-100 translate-y-0 scale-100"
            x-transition:leave-end="opacity-0 -translate-y-8 scale-95">
            <div class="mx-auto">
                <h1 class="text-3xl md:text-[44px] font-display text-center text-secondary mb-3">
                    Saran dan Masukan
                </h1>
                <h1 class="text-base md:text-lg font-sans font-medium text-center mx-auto max-w-full md:max-w-2xl">Bantu
                    kami meningkatkan
                    SavoryAI
                    dengan
                    memberikan
                    saran, masukan, atau melaporkan masalah yang Anda
                    temukan.
                    Setiap feedback Anda sangat berharga untuk pengembangan aplikasi ini.
                </h1>
            </div>

            <div class="mt-5 md:mt-10 w-full space-y-4">
                @livewire('suggestion-form')
            </div>

        </div>
    </div>
@endsection
