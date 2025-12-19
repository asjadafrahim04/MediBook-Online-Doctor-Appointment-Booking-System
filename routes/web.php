<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicDoctorController; 
use App\Http\Controllers\DoctorScheduleController;
use App\Http\Controllers\DoctorProfileController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\PatientAppointmentController;
use App\Http\Controllers\PatientProfileController;
use App\Http\Controllers\DoctorTodayPatientsController;
use App\Http\Controllers\DoctorAllAppointmentsController;
use App\Http\Controllers\Admin\DoctorManagementController as AdminDoctorController;
use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\Admin\UserController as AdminUserController;

// Home Page
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

    // === PATIENT PROFILE ===
    Route::get('/profile', [PatientProfileController::class, 'show'])->name('patient.profile');
    Route::patch('/profile', [PatientProfileController::class, 'update'])->name('patient.profile.update');
    Route::patch('/profile/password', [PatientProfileController::class, 'changePassword'])->name('patient.password.update');
    Route::delete('/profile', [PatientProfileController::class, 'deleteAccount'])->name('patient.account.delete');

    // === PATIENT FEATURES ===
    Route::get('/doctors', [PublicDoctorController::class, 'index'])->name('doctors.index');
    Route::get('/doctors/{doctor}', [PublicDoctorController::class, 'show'])->name('doctors.show');
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

    // === DOCTOR PENDING PAGE ===
    Route::get('/doctor/pending', function () {
        return view('doctors.pending');
    })->name('doctor.pending');

    // === ADMIN FEATURES ===
    Route::middleware('admin')->group(function () {
        Route::get('/admin/doctors', [AdminDoctorController::class, 'index'])->name('admin.doctors.index');
        Route::post('/admin/doctors/{doctor}/approve', [AdminDoctorController::class, 'approve'])->name('admin.doctors.approve');
        Route::post('/admin/doctors/{doctor}/reject', [AdminDoctorController::class, 'reject'])->name('admin.doctors.reject');

        // Admin Profile Routes
        Route::get('/admin/profile', [AdminProfileController::class, 'show'])->name('admin.profile');
        Route::patch('/admin/profile', [AdminProfileController::class, 'update'])->name('admin.profile.update');
        Route::patch('/admin/profile/password', [AdminProfileController::class, 'changePassword'])->name('admin.profile.password.update');
        Route::delete('/admin/profile', [AdminProfileController::class, 'deleteAccount'])->name('admin.profile.delete');

        // User Management Routes
        Route::get('/admin/users', [AdminUserController::class, 'index'])->name('admin.users.index');
        Route::post('/admin/users/{user}/block', [AdminUserController::class, 'block'])->name('admin.users.block');
        Route::post('/admin/users/{user}/unblock', [AdminUserController::class, 'unblock'])->name('admin.users.unblock');
        Route::delete('/admin/users/{user}', [AdminUserController::class, 'destroy'])->name('admin.users.destroy');
        Route::get('/admin/users/{user}', [AdminUserController::class, 'show'])->name('admin.users.show');

        // System Overview Route
        Route::get('/admin/overview', function () {
            $totalPatients = \App\Models\User::where('role', 'patient')->count();
            $totalDoctors = \App\Models\Doctor::count();
            $totalAppointments = \App\Models\Appointment::count();
            $pendingDoctors = \App\Models\Doctor::where('status', 'pending')->count();

            // Last 7 days appointments
            $appointmentsData = \App\Models\Appointment::selectRaw('DATE(created_at) as date, count(*) as count')
                ->where('created_at', '>=', now()->subDays(7))
                ->groupBy('date')
                ->orderBy('date')
                ->pluck('count', 'date');

            $appointmentsLabels = [];
            $appointmentsCounts = [];
            for ($i = 6; $i >= 0; $i--) {
                $date = now()->subDays($i)->format('Y-m-d');
                $appointmentsLabels[] = now()->subDays($i)->format('M d');
                $appointmentsCounts[] = $appointmentsData->get($date, 0);
            }

            // Last 6 months doctor registrations
            $registrationsData = \App\Models\Doctor::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, count(*) as count')
                ->where('created_at', '>=', now()->subMonths(6))
                ->groupBy('month')
                ->orderBy('month')
                ->pluck('count', 'month');

            $registrationsLabels = [];
            $registrationsCounts = [];
            for ($i = 5; $i >= 0; $i--) {
                $month = now()->subMonths($i)->format('Y-m');
                $registrationsLabels[] = now()->subMonths($i)->format('M Y');
                $registrationsCounts[] = $registrationsData->get($month, 0);
            }

            return view('admin.overview', compact(
                'totalPatients',
                'totalDoctors',
                'totalAppointments',
                'pendingDoctors',
                'appointmentsLabels',
                'appointmentsCounts',
                'registrationsLabels',
                'registrationsCounts'
            ));
        })->name('admin.overview');
    });
});