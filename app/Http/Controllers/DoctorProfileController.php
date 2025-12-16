<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoctorProfileController extends Controller
{
    /**
     * Show the doctor profile setup form
     */
    public function create()
    {
        $user = Auth::user();

        if ($user->role !== 'doctor') {
            abort(403, 'Unauthorized access.');
        }

        // If profile already completed, redirect to dashboard
        if ($user->doctor) {
            return redirect()->route('dashboard');
        }

        // Fixed view name to match file location: resources/views/doctors/profile.blade.php
        return view('doctors.profile');
    }

    /**
     * Store the doctor profile details
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        if ($user->role !== 'doctor') {
            abort(403, 'Unauthorized access.');
        }

        $request->validate([
            'specialization' => 'required|string|max:255',
            'qualification' => 'required|string|max:255',
            'experience_years' => 'required|integer|min:0|max:60',
        ]);

        // Create the doctor profile
        $user->doctor()->create([
            'specialization' => $request->specialization,
            'qualification' => $request->qualification,
            'experience_years' => $request->experience_years,
            'status' => 'approved', // Change to 'pending' if you want admin approval later
        ]);

        return redirect()->route('dashboard')
                         ->with('status', 'Your doctor profile has been created successfully!');
    }
}