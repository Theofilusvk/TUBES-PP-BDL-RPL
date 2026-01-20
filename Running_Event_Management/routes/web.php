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
    Route::post('/events', [EventController::class, 'store']);
    Route::get('/participants', [ParticipantController::class, 'index'])->name('dashboard.participants');
    Route::get('/participants/{id}', [ParticipantController::class, 'show'])->name('dashboard.participants.show');
    Route::get('/results', [ResultController::class, 'index'])->name('dashboard.results');
    Route::get('/leaderboards', [LeaderboardController::class, 'index'])->name('dashboard.leaderboards');
    Route::get('/settings', [SettingController::class, 'index'])->name('dashboard.settings');
    Route::post('/settings/profile', [SettingController::class, 'updateProfile'])->name('dashboard.settings.update-profile');
    Route::post('/settings/password', [SettingController::class, 'updatePassword'])->name('dashboard.settings.update-password');
    Route::post('/notifications/{id}/read', [App\Http\Controllers\NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::post('/notifications/read-all', [App\Http\Controllers\NotificationController::class, 'markAllAsRead'])->name('notifications.read-all');
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
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminEventController;
use App\Http\Controllers\AdminFinancialController;
use App\Http\Controllers\AdminTriggerController;
use App\Http\Controllers\AdminNotificationController; // Added Import
use App\Http\Middleware\EnsureAdminEmail;

Route::middleware(['auth', EnsureAdminEmail::class])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/users', [AdminUserController::class, 'index'])->name('users');
    Route::get('/users/{id}', [AdminUserController::class, 'show'])->name('users.show');
    Route::put('/users/{id}', [AdminUserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [AdminUserController::class, 'destroy'])->name('users.destroy');
    
    // Notifications
    Route::get('/notifications', [AdminNotificationController::class, 'index'])->name('notifications');
    Route::post('/notifications/broadcast', [AdminNotificationController::class, 'broadcast'])->name('notifications.broadcast');

    Route::get('/events', [AdminEventController::class, 'index'])->name('events');
    Route::get('/events/{id}', [AdminEventController::class, 'show'])->name('events.show');
    Route::get('/events/{id}/edit', [AdminEventController::class, 'edit'])->name('events.edit');
    Route::put('/events/{id}', [AdminEventController::class, 'update'])->name('events.update');
    Route::delete('/events/{id}', [AdminEventController::class, 'destroy'])->name('events.destroy');
    Route::post('/events/commit', [AdminEventController::class, 'commit'])->name('events.commit');
    Route::post('/events', [AdminEventController::class, 'store'])->name('events.store');
    Route::get('/financial', [AdminFinancialController::class, 'index'])->name('financial');
    Route::post('/financial/{id}/verify', [AdminFinancialController::class, 'verify'])->name('financial.verify');
    Route::get('/triggers', [AdminTriggerController::class, 'index'])->name('triggers');
    Route::post('/events/results/update', [AdminEventController::class, 'updateResult'])->name('events.results.update');
});

// Temporary or Testing
Route::get('/profile', function () {
    return view('profile.edit');
})->name('profile.edit');
