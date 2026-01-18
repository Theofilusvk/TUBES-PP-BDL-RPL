<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Auth Routes
use App\Http\Controllers\Auth\LoginController;
use App\Http\Middleware\EnsureAdminEmail;

Route::get('/login', [LoginController::class, 'create'])->name('login');
Route::post('/login', [LoginController::class, 'store']);
Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

// Participant Routes
use App\Http\Controllers\ParticipantDashboardController;

Route::get('/dashboard', [ParticipantDashboardController::class, 'index'])->name('dashboard');

Route::get('/events/register', function () {
    return view('events.register');
})->name('events.register');

Route::get('/history', function () {
    return view('dashboard.history');
})->name('history');

// Admin Routes
use App\Http\Controllers\AdminDashboardController;

Route::middleware(['auth', EnsureAdminEmail::class])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
});

// Temporary or Testing
Route::get('/profile', function () {
    return view('profile.edit');
})->name('profile.edit');
