<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

// Home Page (Public)
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Include Breeze auth routes (login, register, logout, etc.)
require __DIR__.'/auth.php';

// Authenticated Routes (Only logged-in users)
Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // === Temporary "Coming Soon" Pages for All Features ===

    // Patient Features
    Route::get('/doctors', function () {
        return view('coming-soon', ['title' => 'Find Doctors']);
    })->name('doctors.index');

    Route::get('/patient/appointments', function () {
        return view('coming-soon', ['title' => 'My Appointments']);
    })->name('patient.appointments');

    // Doctor Features
    Route::get('/doctor/today', function () {
        return view('coming-soon', ['title' => "Today's Patients"]);
    })->name('doctor.today');

    Route::get('/doctor/schedule', function () {
        return view('coming-soon', ['title' => 'My Schedule']);
    })->name('doctor.schedule.edit');

    Route::get('/doctor/appointments', function () {
        return view('coming-soon', ['title' => 'All Appointments']);
    })->name('doctor.appointments');

    // Admin Features
    Route::get('/admin/doctors', function () {
        return view('coming-soon', ['title' => 'Manage Doctors']);
    })->name('admin.doctors.index');
});