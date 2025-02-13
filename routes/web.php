<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('layouts.main');
    })->name('dashboard.index');

    Route::get('/ingredients', function () {
        return view('contents.admin.ingredients');
    })->name('ingredients.index');

    Route::get('/recipes', function () {
        return view('contents.admin.ingredients');
    })->name('recipes.index');
});