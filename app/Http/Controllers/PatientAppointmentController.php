<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatientAppointmentController extends Controller
{
    public function index()
    {
        $appointments = Auth::user()->appointments()
            ->with('doctor.user')
            ->orderBy('appointment_date', 'desc')
            ->orderBy('start_time', 'desc')
            ->paginate(10);

        return view('patient.appointments', compact('appointments'));
    }
}