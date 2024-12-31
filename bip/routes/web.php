<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', [CategoryController::class, 'index']);
Route::resource('categories', CategoryController::class);
Route::get('/search', [CategoryController::class, 'search']);
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Trasy dla zalogowanych użytkowników
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});