<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\DoctorScheduleController;
use App\Http\Controllers\DoctorProfileController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\PatientAppointmentController;
use App\Http\Controllers\PatientProfileController;
use App\Http\Controllers\DoctorTodayPatientsController;
use App\Http\Controllers\DoctorAllAppointmentsController;

// Home Page (Public)
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Breeze authentication routes (login, register, logout, password reset)
require __DIR__.'/auth.php';

// All routes below require login
Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // === CUSTOM PATIENT PROFILE ===
    Route::get('/profile', [PatientProfileController::class, 'show'])->name('patient.profile');
    Route::patch('/profile', [PatientProfileController::class, 'update'])->name('patient.profile.update');
    Route::patch('/profile/password', [PatientProfileController::class, 'changePassword'])->name('patient.password.update');
    Route::delete('/profile', [PatientProfileController::class, 'deleteAccount'])->name('patient.account.delete');

    // === PATIENT FEATURES ===
    Route::get('/doctors', [DoctorController::class, 'index'])->name('doctors.index');
    Route::get('/doctors/{doctor}', [DoctorController::class, 'show'])->name('doctors.show');
    Route::get('/patient/appointments', [PatientAppointmentController::class, 'index'])->name('patient.appointments');

    // === DOCTOR FEATURES ===
    Route::get('/doctor/schedule', [DoctorScheduleController::class, 'edit'])->name('doctor.schedule.edit');
    Route::patch('/doctor/schedule', [DoctorScheduleController::class, 'update'])->name('doctor.schedule.update');

    Route::get('/doctor/profile', [DoctorProfileController::class, 'show'])->name('doctor.profile');
    Route::patch('/doctor/profile', [DoctorProfileController::class, 'update'])->name('doctor.profile.update');
    Route::patch('/doctor/profile/password', [DoctorProfileController::class, 'changePassword'])->name('doctor.profile.password.update');
    Route::delete('/doctor/profile', [DoctorProfileController::class, 'deleteAccount'])->name('doctor.profile.delete');

    // === REAL TODAY'S PATIENTS FEATURE ===
    Route::get('/doctor/today', [DoctorTodayPatientsController::class, 'index'])->name('doctor.today');

    // === REAL ALL APPOINTMENTS FEATURE ===
    Route::get('/doctor/appointments', [DoctorAllAppointmentsController::class, 'index'])->name('doctor.appointments');
    Route::delete('/doctor/appointments/{appointment}/cancel', [DoctorAllAppointmentsController::class, 'cancel'])->name('doctor.appointments.cancel');

    // === APPOINTMENT BOOKING ===
    Route::get('/appointments/create/{doctor}', [AppointmentController::class, 'create'])->name('appointments.create');
    Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');
    Route::delete('/appointments/{appointment}/cancel', [AppointmentController::class, 'cancel'])->name('appointments.cancel');

    // === TEMPORARY FEATURES ===
    Route::get('/admin/doctors', function () {
        return view('coming-soon', ['title' => 'Manage Doctors']);
    })->name('admin.doctors.index');
});