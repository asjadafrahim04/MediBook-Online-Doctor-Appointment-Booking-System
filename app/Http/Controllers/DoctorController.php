<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    /**
     * Display a list of all registered doctors with search
     */
    public function index(Request $request)
    {
        $search = $request->get('search');

        $doctors = Doctor::with('user')
            ->when($search, function ($query, $search) {
                return $query->whereHas('user', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                })->orWhere('specialization', 'like', "%{$search}%");
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.doctors.index', compact('doctors', 'search'));
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