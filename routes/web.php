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
        return view('contents.admin.recipes', [
            'content' => 'table'
        ]);
    })->name('recipes.index');

    Route::get('/recipes/create', function () {
        return view('contents.admin.recipes', [
            'content' => 'create'
        ]);
    })->name('recipes.create');

    Route::get('/recipes/edit/{id}', function ($id) {
        return view('contents.admin.recipes', [
            'content' => 'edit',
            'recipeId' => $id
        ]);
    })->name('recipes.edit');
});

Route::get('/', function () {
    return view('contents.user.home');
})->name('home.index');

Route::get('/savoryai', function () {
    return view('contents.user.savoryai');
})->name('savoryai.index');