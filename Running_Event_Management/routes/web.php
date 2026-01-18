<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Auth Routes
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\LeaderboardController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\AdminController; // Added for the new admin route

// Authentication Routes
Route::get('/login', [LoginController::class, 'create'])->name('login');
Route::post('/login', [LoginController::class, 'store']);
Route::post('/logout', [LoginController::class, 'destroy'])->name('logout'); // Kept existing logout route
Route::get('/register', [RegisterController::class, 'create'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

// Dashboard Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/events', [EventController::class, 'index'])->name('dashboard.events');
    Route::get('/participants', [ParticipantController::class, 'index'])->name('dashboard.participants');
    Route::get('/participants/{id}', [ParticipantController::class, 'show'])->name('dashboard.participants.show');
    Route::get('/results', [ResultController::class, 'index'])->name('dashboard.results');
    Route::get('/leaderboards', [LeaderboardController::class, 'index'])->name('dashboard.leaderboards');
    Route::get('/settings', [SettingController::class, 'index'])->name('dashboard.settings');
    Route::post('/settings/profile', [SettingController::class, 'updateProfile'])->name('dashboard.settings.update-profile');
    Route::post('/settings/password', [SettingController::class, 'updatePassword'])->name('dashboard.settings.update-password');
});

// Legacy Admin Routes (Keep as is or integrate later)
Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
});

// Participant Routes
use App\Http\Controllers\ParticipantDashboardController;

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
