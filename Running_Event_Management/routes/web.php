<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Auth Routes
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', function () {
    return redirect()->route('dashboard'); // Mock login
});

Route::post('/logout', function () {
    return redirect()->route('login');
})->name('logout');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

// Participant Routes
Route::get('/dashboard', function () {
    return view('dashboard.index');
})->name('dashboard');

Route::get('/events/register', function () {
    return view('events.register');
})->name('events.register');

Route::get('/history', function () {
    return view('dashboard.history');
})->name('history');

// Admin Routes
Route::get('/admin', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');

// Temporary or Testing
Route::get('/profile', function () {
    return view('profile.edit');
})->name('profile.edit');
