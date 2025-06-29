@extends('layouts.main')

@section('content')
    <div class="mt-16 py-10 px-4 md:px-20 page-background bg-fixed bg-repeat min-h-screen relative">

        @livewire('floating-bookmarks')

        <div x-show="pageLoaded" x-transition:enter="transform transition-all duration-700 ease-out"
            x-transition:enter-start="opacity-0 translate-y-8 scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 scale-100"
            x-transition:leave="transform transition-all duration-500 ease-in"
            x-transition:leave-start="opacity-100 translate-y-0 scale-100"
            x-transition:leave-end="opacity-0 -translate-y-8 scale-95">
            {{-- <div>
                <h1 class="text-[44px] font-display text-center text-secondary mb-3">SavoryAI</h1>
                <h1 class="text-lg font-sans font-medium text-center">Smart Recipe Recommender</h1>
            </div> --}}

            <div class="mt-10 w-full space-y-4">

                @if (Route::current()->parameter('id'))
                    {{-- Recipe Detail View --}}
                    @livewire('recipe-detail', ['recipeId' => Route::current()->parameter('id')])
                @elseif (isset($filterType) && isset($filterValue))
                    {{-- Category/Filter View --}}
                    @livewire('explore-category', [
                        'type' => $filterType,
                        'value' => $filterValue,
                        'name' => $filterType === 'category' ? ($filterValue == '3' ? 'Cemilan Manis' : 'Menu Utama') : null,
                    ])
                @else
                    {{-- Default Explore Dashboard --}}
                    <div class="mb-10">
                        @livewire('explore-dashboard')
                    </div>

                    {{-- Popular Recipes --}}
                    <div class="mb-12">
                        @livewire('explore-popular')
                    </div>

                    {{-- Recipe List --}}
                    <div>
                        @livewire('explore-list')
                    </div>
                @endif

            </div>
        </div>
    </div>
@endsection
