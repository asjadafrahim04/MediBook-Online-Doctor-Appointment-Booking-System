<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class DoctorProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();

        if ($user->role !== 'doctor') {
            abort(403, 'Unauthorized access.');
        }

        $doctor = $user->doctor;

        return view('doctors.profile', compact('user', 'doctor'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        if ($user->role !== 'doctor') {
            abort(403);
        }

        $doctor = $user->doctor;

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'specialization' => 'required|string|max:255',
            'qualification' => 'required|string|max:255',
            'experience_years' => 'required|integer|min:0|max:60',
        ]);

        $data = [
            'name' => $request->name,
            'phone' => $request->phone,
            'specialization' => $request->specialization,
            'qualification' => $request->qualification,
            'experience_years' => $request->experience_years,
        ];

        if ($request->hasFile('profile_photo')) {
            if ($user->profile_photo) {
                Storage::disk('public')->delete($user->profile_photo);
            }
            $data['profile_photo'] = $request->file('profile_photo')->store('profiles', 'public');
        }

        $user->update($data);
        $doctor->update($data);

        return redirect()->route('doctor.profile')->with('status', 'Profile updated successfully!');
    }

    public function changePassword(Request $request)
    {
        $user = Auth::user();

        if ($user->role !== 'doctor') {
            abort(403);
        }

        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('doctor.profile')->with('status', 'Password changed successfully!');
    }

    public function deleteAccount(Request $request)
    {
        $user = Auth::user();

        if ($user->role !== 'doctor') {
            abort(403);
        }

        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        if ($user->profile_photo) {
            Storage::disk('public')->delete($user->profile_photo);
        }

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}