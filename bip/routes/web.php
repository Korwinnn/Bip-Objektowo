<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RssController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\StatisticsController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\ContactController;

Route::get('/', [CategoryController::class, 'index']);
Route::resource('categories', CategoryController::class);
Route::get('/search', [CategoryController::class, 'search']);

// Logowanie
Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Reset hasła (dostępne dla niezalogowanych)
Route::get('/forgot-password', [UserController::class, 'showForgotForm'])->name('password.request');
Route::post('/forgot-password', [UserController::class, 'sendResetLink'])->name('password.email');
Route::get('/reset-password/{token}', [UserController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [UserController::class, 'resetPassword'])->name('password.update');

// Dashboard
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});

// Ustawienia
Route::middleware(['auth'])->group(function () {
    Route::get('/settings', [SettingController::class, 'edit'])->name('settings.edit');
    Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');
});

// Zarządzanie użytkownikami
Route::middleware(['auth'])->group(function () {
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    // Trasy dla zmiany hasła
    Route::get('/users/{user}/change-password', [UserController::class, 'showChangePasswordForm'])
        ->name('users.change-password');
    Route::post('/users/update-password', [UserController::class, 'changePassword'])
        ->name('users.update-password');
    // Trasa dla admina do zmiany hasła innych użytkowników
    Route::post('/users/{user}/admin-change-password', [UserController::class, 'adminChangePassword'])
        ->name('users.admin-change-password')
        ->middleware('admin');
});

// Kategorie
Route::get('/categories/{category}/print', [CategoryController::class, 'print'])->name('categories.print');
Route::get('/categories/{category}/pdf', [CategoryController::class, 'generatePdf'])->name('categories.pdf');
Route::get('/categories/{category}/window', [CategoryController::class, 'showInWindow'])->name('categories.window');

// RSS i Sitemap
Route::get('rss', [RssController::class, 'index'])->name('rss.feed');
Route::get('/sitemap', [SitemapController::class, 'index'])->name('sitemap');

// Statystyki
Route::get('/statistics', [CategoryController::class, 'statistics'])->name('statistics');

// Sortowanie kategorii
Route::post('/categories/update-order', [CategoryController::class, 'updateOrder'])
    ->name('categories.updateOrder')
    ->middleware('auth');

Route::post('/admin/categories/reorder', [CategoryController::class, 'reorder'])
    ->name('categories.reorder')
    ->middleware('auth');

// Aktualności - publiczne
Route::get('/announcements', [AnnouncementController::class, 'index'])->name('announcements.index');
Route::get('/announcements/{announcement}', [AnnouncementController::class, 'show'])->name('announcements.show');

// Aktualności - administracyjne
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/announcements/create', [AnnouncementController::class, 'create'])->name('announcements.create');
    Route::post('/admin/announcements', [AnnouncementController::class, 'store'])->name('announcements.store');
    Route::get('/admin/announcements/{announcement}/edit', [AnnouncementController::class, 'edit'])->name('announcements.edit');
    Route::put('/admin/announcements/{announcement}', [AnnouncementController::class, 'update'])->name('announcements.update');
    Route::delete('/admin/announcements/{announcement}', [AnnouncementController::class, 'destroy'])->name('announcements.destroy');
});

// Kontakty
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/contacts/edit', [ContactController::class, 'edit'])->name('contacts.edit');
    Route::put('/admin/contacts', [ContactController::class, 'update'])->name('contacts.update');
});