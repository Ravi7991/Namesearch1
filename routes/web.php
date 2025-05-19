<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PoliceRecordController;
use App\Http\Controllers\SearchController;

// Public routes
Route::get('/', function () {
    return view('welcome');
});

// Authentication routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Registration routes
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Protected routes
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Police Records
    Route::resource('police', PoliceRecordController::class);
    
    // Search
    Route::get('/search', [SearchController::class, 'index'])->name('search');
    Route::get('/search/results', [SearchController::class, 'search'])->name('search.results');
    Route::post('/search/suggest-phonetic', [SearchController::class, 'suggestPhoneticCode'])->name('search.suggest-phonetic');
    
    // Admin routes
    Route::middleware(['role:admin'])->group(function () {
        // User management routes would go here
    });
});
