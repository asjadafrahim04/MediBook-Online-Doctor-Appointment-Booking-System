<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DoctorAllAppointmentsController extends Controller
{
    public function index(Request $request)
    {
        $doctor = Auth::user()->doctor;

        if (!$doctor) {
            abort(403, 'Unauthorized access.');
        }

        $query = Appointment::where('doctor_id', $doctor->id)
            ->with('patient')
            ->orderBy('appointment_date', 'desc')
            ->orderBy('start_time', 'desc');

        // Search by patient name
        if ($request->search) {
            $query->whereHas('patient', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            });
        }

        // Filter by date range
        if ($request->date_from) {
            $query->where('appointment_date', '>=', $request->date_from);
        }
        if ($request->date_to) {
            $query->where('appointment_date', '<=', $request->date_to);
        }

        $appointments = $query->paginate(10);

        return view('doctors.all-appointments', compact('appointments'));
    }

    public function cancel(Request $request, Appointment $appointment)
    {
        if ($appointment->doctor_id !== Auth::user()->doctor->id) {
            abort(403);
        }

        if ($appointment->appointment_date->isPast()) {
            return back()->with('error', 'Cannot cancel past appointments.');
        }

        $appointment->update(['status' => 'cancelled']);

        return back()->with('success', 'Appointment cancelled successfully.');
    }
}