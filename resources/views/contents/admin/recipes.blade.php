@extends('layouts.main')

@section('content')
    <div class="mt-2 mb-7">

        {{-- breadcumbs --}}
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <a href="{{ auth()->user()->hasRole('admin') ? route('admin-dashboard.index') : route('dashboard.index') }}"
                        wire:navigate
                        class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-secondary dark:text-gray-400 dark:hover:text-white">
                        <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path
                                d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                        </svg>
                        Dashboard
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        @if ($content === 'table')
                            <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">
                                Resep
                            </span>
                        @else
                            <a href="{{ auth()->user()->hasRole('admin') ? route('admin-recipes.index') : route('recipes.index') }}"
                                wire:navigate
                                class="ms-1 text-sm font-medium text-gray-700 hover:text-secondary md:ms-2 dark:text-gray-400 dark:hover:text-white">
                                Resep
                            </a>
                        @endif
                    </div>
                </li>
                @if ($content === 'create' || $content === 'edit')
                    <li>
                        <div class="flex items-center">
                            <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 9 4-4-4-4" />
                            </svg>
                            <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">
                                {{ $content === 'create' ? 'Tambah Resep' : 'Edit Resep' }}
                            </span>
                        </div>
                    </li>
                @endif
            </ol>
        </nav>


        @if ($content === 'create')
            <h1 class="text-3xl mt-3 mb-1">
                Tambah Resep
            </h1>
            <p class="text-sm font-normal mb-5 text-gray-600">
                Buat resep baru dengan mengisi formulir di bawah ini.
            </p>
        @elseif ($content === 'edit')
            <h1 class="text-3xl mt-3 mb-1">
                Edit Resep
            </h1>
            <p class="text-sm font-normal mb-5 text-gray-600">
                Ubah informasi resep dengan mengedit formulir di bawah ini.
            </p>
        @else
            <h1 class="text-3xl mt-3 mb-1">
                Resep
            </h1>
            <p class="text-sm font-normal mb-5 text-gray-600">
                Daftar semua resep yang telah dibuat.
            </p>
        @endif
    </div>

    @if ($content === 'table')
        @livewire('recipes-table')
    @elseif ($content === 'edit')
        @livewire('recipe-form', ['recipeId' => $recipeId])
    @elseif ($content === 'detail')
        @livewire('admin-recipe-detail', ['recipeId' => $recipeId])
    @else
        @livewire('recipe-form')
    @endif
@endsection
