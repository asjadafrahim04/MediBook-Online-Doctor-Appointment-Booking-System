<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\DoctorScheduleController;
use App\Http\Controllers\DoctorProfileController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\PatientAppointmentController;

// Home Page (Public)
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Include Breeze auth routes (login, register, logout, password reset, etc.)
require __DIR__.'/auth.php';

// Authenticated Routes (Only for logged-in users)
Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Profile Routes (general user profile)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // === REAL FEATURES WE HAVE BUILT ===

    // Find Doctors (Patient view)
    Route::get('/doctors', [DoctorController::class, 'index'])->name('doctors.index');

    // Doctor Profile & Calendar (Patient view)
    Route::get('/doctors/{doctor}', [DoctorController::class, 'show'])->name('doctors.show');

    // Doctor Schedule - Set weekly availability
    Route::get('/doctor/schedule', [DoctorScheduleController::class, 'edit'])->name('doctor.schedule.edit');
    Route::patch('/doctor/schedule', [DoctorScheduleController::class, 'update'])->name('doctor.schedule.update');

    // Doctor Profile Setup Form (after registration)
    Route::get('/doctor/profile/create', [DoctorProfileController::class, 'create'])->name('doctor.profile.create');
    Route::post('/doctor/profile', [DoctorProfileController::class, 'store'])->name('doctor.profile.store');

    // === APPOINTMENT BOOKING SYSTEM ===

    // Appointment Booking - Patient selects time slot
    Route::get('/appointments/create/{doctor}', [AppointmentController::class, 'create'])->name('appointments.create');
    Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');
    Route::delete('/appointments/{appointment}/cancel', [AppointmentController::class, 'cancel'])->name('appointments.cancel');

    // Patient Appointments (REAL - replaces coming soon)
    Route::get('/patient/appointments', [PatientAppointmentController::class, 'index'])->name('patient.appointments');

    // === TEMPORARY "Coming Soon" PAGES (Not built yet) ===

    Route::get('/doctor/today', function () {
        return view('coming-soon', ['title' => "Today's Patients"]);
    })->name('doctor.today');

    Route::get('/doctor/appointments', function () {
        return view('coming-soon', ['title' => 'All Appointments']);
    })->name('doctor.appointments');

    Route::get('/admin/doctors', function () {
        return view('coming-soon', ['title' => 'Manage Doctors']);
    })->name('admin.doctors.index');
});