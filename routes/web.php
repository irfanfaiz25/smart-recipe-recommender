<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GoogleAuthController;
use Illuminate\Support\Facades\Route;

// AUTH
// redirect to Google's OAuth page
Route::get('/api/auth/google/redirect', [GoogleAuthController::class, 'redirect'])->name('auth.google.redirect');

// handle the callback from Google
Route::get('/api/auth/google/callback', [GoogleAuthController::class, 'callback'])->name('auth.google.callback');

// redirect to login page
Route::get('/login', function () {
    return view('layouts.login');
})->name('login');

// login action
Route::post('/login', [AuthController::class, 'login'])->name('login.action');

// register
Route::post('/register', [AuthController::class, 'register'])->name('register');

// logout
Route::post('/logout', [GoogleAuthController::class, 'logout'])->name('auth.logout');

Route::get('/', function () {
    return view('contents.user.home');
})->name('home.index');

// admin dashboard
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', function () {
        return view('contents.admin.dashboard');
    })->name('admin-dashboard.index');

    Route::get('/ingredients', function () {
        return view('contents.admin.ingredients');
    })->name('admin-ingredients.index');

    Route::get('/recipes/list', function () {
        return view('contents.admin.recipes', [
            'content' => 'table'
        ]);
    })->name('admin-recipes.index');

    Route::get('/recipes/list/create', function () {
        return view('contents.admin.recipes', [
            'content' => 'create'
        ]);
    })->name('admin-recipes.create');

    Route::get('/recipes/list/edit/{id}', function ($id) {
        return view('contents.admin.recipes', [
            'content' => 'edit',
            'recipeId' => $id
        ]);
    })->name('admin-recipes.edit');

    Route::get('/recipes/list/{id}', function ($id) {
        return view('contents.admin.recipes', [
            'content' => 'detail',
            'recipeId' => $id
        ]);
    })->name('admin-recipes.detail');

    // moderation
    Route::get('/recipes/moderation', function () {
        return view('contents.admin.moderation');
    })->name('admin-moderation.index');

    // moderation recipe detail
    Route::get('/recipes/moderation/{id}', function ($id) {
        return view('contents.admin.moderation', [
            'recipeId' => $id
        ]);
    })->name('admin-moderation.show');

    // User management
    Route::get('/users', function () {
        return view('contents.admin.users');
    })->name('user-management.index');
});

// creators dashboard
Route::prefix('creators')->middleware(['auth', 'creators'])->group(function () {
    Route::get('/dashboard', function () {
        return view('contents.admin.dashboard');
    })->name('dashboard.index');

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

    Route::get('/recipes/{id}', function ($id) {
        return view('contents.admin.recipes', [
            'content' => 'detail',
            'recipeId' => $id
        ]);
    })->name('recipes.detail');
});

// auth middleware
Route::middleware('auth')->group(function () {
    // explore recipes
    Route::get('/explore', function () {
        return view('contents.user.recipes');
    })->name('explore-recipes.index');

    // explore recipes detail
    Route::get('/explore/{id}', function () {
        return view('contents.user.recipes');
    })->name('explore-recipes.show');

    // explore by category (dessert/main course)
    Route::get('/explore/category/{categoryId}', function ($categoryId) {
        return view('contents.user.recipes', [
            'filterType' => 'category',
            'filterValue' => $categoryId
        ]);
    })->name('explore.category');

    // explore by ingredient
    Route::get('/explore/ingredient/{ingredient}', function ($ingredient) {
        return view('contents.user.recipes', [
            'filterType' => 'ingredient',
            'filterValue' => $ingredient
        ]);
    })->name('explore.ingredient');

    // explore by cooking time
    Route::get('/explore/time/{timeCategory}', function ($timeCategory) {
        return view('contents.user.recipes', [
            'filterType' => 'cooking_time',
            'filterValue' => $timeCategory
        ]);
    })->name('explore.time');

    // smart recommender
    Route::get('/savoryai', function () {
        return view('contents.user.savoryai', [
            'previousPage' => 'savoryai'
        ]);
    })->name('savoryai.index');

    // savoryai recipe detail
    Route::get('/savoryai/{id}', function () {
        return view('contents.user.savoryai');
    })->name('savoryai.show');

    // creators
    Route::get('/creators', function () {
        return view('contents.user.creators');
    })->name('creators.index');

    // bookmarks
    Route::get('/bookmarks', function () {
        return view('contents.user.bookmarks');
    })->name('bookmarks.index');

    // bookmarks recipe detail
    Route::get('/bookmarks/{id}', function () {
        return view('contents.user.bookmarks', [
            'previousPage' => 'bookmarks'
        ]);
    })->name('bookmarks.show');
});