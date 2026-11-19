<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SubjectController;

Route::get('/', function () {
    return view('auth.login');
});

Route::post('/register', [AuthController::class, 'store'])->name('register.store');
Route::post('/login', [AuthController::class, 'login'])->name('login.store');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('pages.dashboard');
    })->name('dashboard');

    Route::get('/dashboard/inbox', function () {
        return view('pages.inbox');
    })->name('inbox');

    Route::get('/dashboard/profile', function () {
        return view('pages.profile');
    })->name('profile');

    Route::get('dashboard/users', function () {
        return view('pages.users');
    })->name('users');

    Route::get('dashboard/subjects',[SubjectController::class,'index'])->name('subjects');

    Route::get('dashboard/users',[UserController::class,'index'])->name('users');

    Route::get('dashboard/events', function () {
        return view('pages.events');
    })->name('events');

    Route::get('dashboard/feedback', function () {
        return view('pages.feedback');
    })->name('feedback');

    Route::get('dashboard/ContactTeachers', function () {
        return view('pages.ContactTeachers');
    })->name('ContactTeachers');

    Route::get('dashboard/leaderboard', function () {
        return view('pages.leaderboard');
    })->name('leaderboard');
    
    Route::get('dashboard/passFailCalculator', function () {
        return view('pages.passFailCalculator');
    })->name('passFailCalculator');

});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');
Route::get('/register', function () {
    return view('auth.register');
})->name('register');
