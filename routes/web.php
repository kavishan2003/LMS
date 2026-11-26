<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\ALStudentSubjectController;
use App\Http\Controllers\OLStudentSubjectController;
use App\Http\Middleware\PreventDuplicateSubjectSelection;

Route::get('/', function () {
    return view('auth.login');
});

Route::post('/register', [AuthController::class, 'store'])->name('register.store');
Route::post('/login', [AuthController::class, 'login'])->name('login.store');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {

    // 1. STUDENT ONBOARDING ROUTES
    Route::middleware([PreventDuplicateSubjectSelection::class])->group(function () {
        Route::get('/pre', function (Request $request) {
            if ($request->user()->role !== 'student') {
                return redirect()->route('teacher.create');
            }

            return view('auth.Prequestions');
        })->name('prequestions');

        Route::get('/pre/ol', [OLStudentSubjectController::class, 'index'])->name('OLform');
        Route::post('/pre/ol', [OLStudentSubjectController::class, 'create'])->name('OLform.create');

        Route::get('/pre/al', [ALStudentSubjectController::class, 'index'])->name('ALform.index');
        Route::post('/pre/al', [ALStudentSubjectController::class, 'create'])->name('ALform.create');
            
        // 2. TEACHER ONBOARDING ROUTES (only teachers)
        Route::get('/pre/teacher', [TeacherController::class, 'create'])->name('teacher.create');
        Route::post('/pre/teacher', [TeacherController::class, 'store'])->name('teacher.store');
    });

});

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

    Route::get('dashboard/subjects', [SubjectController::class, 'index'])->name('subjects');

    Route::get('/dashboard/subjects/{subject_code}', [SubjectController::class, 'show'])
        ->name('subjects.show');

    Route::get('dashboard/users', [UserController::class, 'index'])->name('users');

    Route::get('dashboard/events', function () {
        return view('pages.events');
    })->name('events');

    Route::get('dashboard/feedback', function () {
        return view('pages.feedback');
    })->name('feedback');

    Route::get('dashboard/ContactTeachers', [TeacherController::class, 'index'])->name('ContactTeachers');

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
