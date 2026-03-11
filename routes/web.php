<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Student;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');
// Guest routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Admin routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [Admin\DashboardController::class, 'index'])->name('dashboard');

    Route::resource('questions', Admin\QuestionController::class)
        ->except(['show']);

    Route::get('/results', [Admin\ResultController::class, 'index'])->name('results.index');
});

// Student routes
Route::middleware(['auth', 'role:student'])->prefix('student')->name('student.')->group(function () {
    Route::get('/dashboard', [Student\DashboardController::class, 'index'])->name('dashboard');

    Route::get('/quiz', [Student\QuizController::class, 'index'])->name('quiz.index');
    Route::post('/quiz/take', [Student\QuizController::class, 'take'])->name('quiz.take');
    Route::post('/quiz/{quiz}/submit', [Student\QuizController::class, 'submit'])->name('quiz.submit');
    Route::get('/quiz/result/{quizResult}', [Student\QuizController::class, 'result'])->name('quiz.result');

    Route::get('/history', [Student\ResultController::class, 'index'])->name('history.index');
});
