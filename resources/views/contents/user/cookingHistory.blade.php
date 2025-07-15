@extends('layouts.main')

@section('title', 'Favorit Saya')

@section('content')
    <div class="md:mt-16 py-2 md:py-10 px-4 md:px-20 page-background min-h-screen bg-fixed bg-repeat relative">

        <div x-show="pageLoaded" x-transition:enter="transform transition-all duration-700 ease-out"
            x-transition:enter-start="opacity-0 translate-y-8 scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 scale-100"
            x-transition:leave="transform transition-all duration-500 ease-in"
            x-transition:leave-start="opacity-100 translate-y-0 scale-100"
            x-transition:leave-end="opacity-0 -translate-y-8 scale-95">
            <div>
                <h1 class="text-3xl md:text-[44px] font-display text-center text-secondary mb-3">
                    Riwayat Masak
                </h1>
                <h1 class="text-base md:text-lg font-sans font-medium text-center">
                    Lihat daftar resep yang telah kamu masak
                </h1>
            </div>

            @if (Route::current()->parameter('id'))
                {{-- detail page --}}
                @livewire('recipe-detail', ['recipeId' => Route::current()->parameter('id')])
            @else
                {{-- list page --}}
                @livewire('cooking-history-list')
            @endif

        </div>
    </div>
@endsection
