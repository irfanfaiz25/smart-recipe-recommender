@extends('layouts.main')

@section('content')
    <div class="mt-5 mb-7">
        <h1 class="text-3xl mb-5">
            Recipes
        </h1>
    </div>

    @livewire('recipes-table')
@endsection
