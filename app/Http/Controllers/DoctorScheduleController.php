<?php

namespace App\Http\Controllers;

use App\Models\DoctorAvailability;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoctorScheduleController extends Controller
{
    /**
     * Show the form to edit doctor's weekly schedule
     */
    public function edit()
    {
        $user = Auth::user();

        // Check if logged-in user is a doctor and has a doctor record
        if ($user->role !== 'doctor' || !$user->doctor) {
            abort(403, 'Unauthorized access.');
        }

        $doctor = $user->doctor;

        // Load existing availability, grouped by day for easy access
        $availability = $doctor->availability->keyBy('day_of_week');

        // List of days for the form
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

        // Fixed: view name matches file location resources/views/doctors/schedule.blade.php
        return view('doctors.schedule', compact('doctor', 'availability', 'days'));
    }

    /**
     * Update the doctor's weekly schedule
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        if ($user->role !== 'doctor' || !$user->doctor) {
            abort(403, 'Unauthorized access.');
        }

        $doctor = $user->doctor;

        $request->validate([
            'availability' => 'required|array',
            'availability.*.day' => 'required|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
            'availability.*.start_time' => 'nullable|date_format:H:i',
            'availability.*.end_time' => 'nullable|date_format:H:i|after:availability.*.start_time',
        ]);

        // Delete old availability to avoid duplicates
        $doctor->availability()->delete();

        // Save new availability
        foreach ($request->availability as $item) {
            if (!empty($item['start_time']) && !empty($item['end_time'])) {
                DoctorAvailability::create([
                    'doctor_id' => $doctor->id,
                    'day_of_week' => $item['day'],
                    'start_time' => $item['start_time'] . ':00',
                    'end_time' => $item['end_time'] . ':00',
                    'slot_duration_minutes' => 30,
                ]);
            }
        }

        return redirect()->route('doctor.schedule.edit')
                         ->with('status', 'Your weekly schedule has been updated successfully!');
    }
}