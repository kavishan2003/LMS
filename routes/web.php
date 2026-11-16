<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('layouts.app');
});

Route::post('/register', [AuthController::class, 'store'])->name('register.store');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/dashboard', function () {
    return view('pages.dashboard');
})->name('dashboard');

Route::get('/inbox', function () {
    return view('pages.inbox');
})->name('inbox');

Route::get('/profile', function () {
    return view('pages.profile');
})->name('profile');

Route::get('/users', function () {
    return view('pages.users');
})->name('users');
