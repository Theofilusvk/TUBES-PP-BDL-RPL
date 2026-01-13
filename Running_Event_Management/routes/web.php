<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Auth Routes (Temporary, until Breeze/Auth is fully installed)
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', function () {
    return redirect()->route('dashboard'); // Mock login
});

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/register', function () {
    return redirect()->route('dashboard'); // Mock register
});

Route::get('/forgot-password', function () {
    return "Forgot Password Page";
})->name('password.request');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/profile', function () {
    return view('profile.edit');
})->name('profile.edit');

// Testing routes
Route::get('/layout-test', function () {
    return view('layouts.app');
});
