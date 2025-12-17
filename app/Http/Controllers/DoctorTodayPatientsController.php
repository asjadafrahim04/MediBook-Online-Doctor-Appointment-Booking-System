<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DoctorTodayPatientsController extends Controller
{
    public function index()
    {
        $doctor = Auth::user()->doctor;

        if (!$doctor) {
            abort(403, 'Unauthorized access.');
        }

        $today = Carbon::today();

        $appointments = Appointment::where('doctor_id', $doctor->id)
            ->where('appointment_date', $today)
            ->where('status', 'booked')
            ->with('patient')
            ->orderBy('start_time')
            ->get();

        return view('doctors.today-patients', compact('appointments', 'today'));
    }
}