<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    /**
     * Display a list of all doctors with their user details
     */
    public function index()
    {
        $doctors = Doctor::with('user')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.doctors.index', compact('doctors'));
    }

    /**
     * Approve a doctor
     */
    public function approve(Doctor $doctor)
    {
        $doctor->update(['status' => 'approved']);

        return redirect()->route('admin.doctors.index')
            ->with('success', 'Doctor approved successfully!');
    }

    /**
     * Reject a doctor
     */
    public function reject(Doctor $doctor)
    {
        $doctor->update(['status' => 'rejected']);

        return redirect()->route('admin.doctors.index')
            ->with('success', 'Doctor rejected successfully!');
    }
}