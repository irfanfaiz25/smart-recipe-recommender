@extends('layouts.login')

@section('content')
    @livewire('reset-password-form', ['token' => $token])
@endsection
