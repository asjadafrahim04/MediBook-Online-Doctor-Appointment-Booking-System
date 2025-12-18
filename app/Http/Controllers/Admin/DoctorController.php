<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::with('user')->get();

        return view('admin.doctors.index', compact('doctors'));
    }

    public function approve(Doctor $doctor)
    {
        $doctor->update(['status' => 'approved']);

        return redirect()->route('admin.doctors.index')->with('success', 'Doctor approved successfully!');
    }

    public function reject(Doctor $doctor)
    {
        $doctor->update(['status' => 'rejected']);

        return redirect()->route('admin.doctors.index')->with('success', 'Doctor rejected successfully!');
    }
}