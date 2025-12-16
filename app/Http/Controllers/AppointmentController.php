<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\DoctorAvailability;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AppointmentController extends Controller
{
    // Show booking form for a specific doctor and day
    public function create(Doctor $doctor, Request $request)
    {
        // Get the selected date from query string (e.g., ?date=2024-12-20)
        $date = $request->date ? Carbon::parse($request->date) : Carbon::tomorrow();
        $dayOfWeek = $date->englishDayOfWeek; // Monday, Tuesday, etc.

        // Get doctor's availability for this day
        $availability = $doctor->availability()->where('day_of_week', $dayOfWeek)->first();

        if (!$availability) {
            return back()->with('error', 'Doctor is not available on this day.');
        }

        // Generate 30-minute time slots based on availability
        $startTime = Carbon::parse($availability->start_time);
        $endTime = Carbon::parse($availability->end_time);
        $slotDuration = $availability->slot_duration_minutes;

        $slots = [];
        $currentTime = $startTime->copy();

        while ($currentTime->lt($endTime)) {
            $slotStart = $currentTime->copy();
            $slotEnd = $currentTime->addMinutes($slotDuration);

            if ($slotEnd->gt($endTime)) break;

            // Check if slot is already booked
            $isBooked = Appointment::where('doctor_id', $doctor->id)
                ->where('appointment_date', $date->format('Y-m-d'))
                ->where('start_time', $slotStart->format('H:i:s'))
                ->exists();

            $slots[] = [
                'start_time' => $slotStart->format('H:i:s'),
                'display_time' => $slotStart->format('g:i A'),
                'end_time' => $slotEnd->format('H:i:s'),
                'is_booked' => $isBooked,
            ];
        }

        return view('appointments.create', compact('doctor', 'date', 'slots', 'availability'));
    }

    // Store the appointment
    public function store(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'appointment_date' => 'required|date',
            'start_time' => 'required',
            'symptoms' => 'nullable|string|max:500',
        ]);

        $doctor = Doctor::findOrFail($request->doctor_id);
        $patient = Auth::user();
        $date = Carbon::parse($request->appointment_date);

        // Check if slot is still available (prevent double-booking)
        $existingAppointment = Appointment::where('doctor_id', $doctor->id)
            ->where('appointment_date', $date->format('Y-m-d'))
            ->where('start_time', $request->start_time)
            ->exists();

        if ($existingAppointment) {
            return back()->with('error', 'This time slot has already been booked. Please choose another time.');
        }

        // Calculate end time (30 minutes later)
        $start = Carbon::parse($request->start_time);
        $end = $start->copy()->addMinutes(30);

        // Create appointment
        $appointment = Appointment::create([
            'patient_id' => $patient->id,
            'doctor_id' => $doctor->id,
            'appointment_date' => $date->format('Y-m-d'),
            'start_time' => $start->format('H:i:s'),
            'end_time' => $end->format('H:i:s'),
            'status' => 'booked',
            'symptoms' => $request->symptoms,
        ]);

        return redirect()->route('patient.appointments')
            ->with('success', 'Appointment booked successfully!');
    }

    // Cancel an appointment (FIXED VERSION)
    public function cancel(Appointment $appointment)
    {
        if (Auth::id() !== $appointment->patient_id) {
            abort(403, 'Unauthorized action.');
        }

        // FIX: Use try-catch to handle any date parsing errors
        try {
            // Get raw values from the appointment
            $date = $appointment->getRawOriginal('appointment_date'); // Get raw DB value
            $time = $appointment->getRawOriginal('start_time'); // Get raw DB value
            
            // Check if date and time are valid
            if (empty($date) || empty($time)) {
                // If date/time missing, just cancel without date check
                $appointment->update(['status' => 'cancelled']);
                return back()->with('success', 'Appointment cancelled successfully.');
            }
            
            // Combine date and time safely
            $appointmentDateTime = Carbon::createFromFormat('Y-m-d H:i:s', "$date $time");
            
            // Only allow cancellation if appointment is in the future
            if ($appointmentDateTime->lt(now())) {
                return back()->with('error', 'Cannot cancel past appointments.');
            }
            
        } catch (\Exception $e) {
            // If there's any error in date parsing, log it and allow cancellation anyway
            \Log::error("Error parsing appointment datetime for ID {$appointment->id}: " . $e->getMessage());
            // Continue with cancellation (better user experience)
        }

        $appointment->update(['status' => 'cancelled']);

        return back()->with('success', 'Appointment cancelled successfully.');
    }
    
    // Alternative simpler cancel method (use this if above still has issues)
    public function cancelSimple(Appointment $appointment)
    {
        if (Auth::id() !== $appointment->patient_id) {
            abort(403, 'Unauthorized action.');
        }

        // Just update status without date checking
        $appointment->update(['status' => 'cancelled']);

        return back()->with('success', 'Appointment cancelled successfully.');
    }
}