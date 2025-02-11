<?php

use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function () {
    return view('layouts.main');
})->name('dashboard.index');

Route::get('/ingridients', function () {
    return view('layouts.main');
})->name('ingridients.index');
