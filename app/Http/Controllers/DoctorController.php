<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    /**
     * Display a list of approved doctors with search
     */
    public function index(Request $request)
    {
        $search = $request->get('search');

        $doctors = Doctor::with('user')
            ->approved()
            ->when($search, function ($query, $search) {
                return $query->whereHas('user', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                })->orWhere('specialization', 'like', "%{$search}%");
            })
            ->get();

        return view('doctors.index', compact('doctors', 'search'));
    }

    /**
     * Display the doctor profile and weekly availability
     */
    public function show(Doctor $doctor)
    {
        if ($doctor->status !== 'approved') {
            abort(404);
        }

        $doctor->load('user', 'availability');

        $availability = $doctor->availability->groupBy('day_of_week');

        return view('doctors.show', compact('doctor', 'availability'));
    }
}