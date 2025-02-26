<?php

use App\Http\Controllers\GoogleAuthController;
use Illuminate\Support\Facades\Route;


// redirect to Google's OAuth page
Route::get('/api/auth/google/redirect', [GoogleAuthController::class, 'redirect'])->name('auth.google.redirect');

// handle the callback from Google
Route::get('/api/auth/google/callback', [GoogleAuthController::class, 'callback'])->name('auth.google.callback');

// logout
Route::post('/logout', [GoogleAuthController::class, 'logout'])->name('auth.logout');

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
})->middleware('auth');

Route::get('/', function () {
    return view('contents.user.home');
})->name('home.index');

Route::get('/savoryai', function () {
    return view('contents.user.savoryai');
})->name('savoryai.index');

Route::get('/savoryai/{id}', function () {
    return view('contents.user.savoryai');
})->name('savoryai.show');