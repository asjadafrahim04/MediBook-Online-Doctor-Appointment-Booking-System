<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

// Home Page (Public)
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Include all Breeze authentication routes (login, register, logout, password reset)
require __DIR__.'/auth.php';

// Authenticated Routes (Only for logged-in users)
Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Profile Routes (REQUIRED for Breeze layout to work)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});