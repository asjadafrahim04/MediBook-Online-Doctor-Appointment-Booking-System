<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class PatientProfileController extends Controller
{
    /**
     * Show the patient profile page
     */
    public function show()
    {
        $user = Auth::user();

        if ($user->role !== 'patient') {
            abort(403, 'Unauthorized access.');
        }

        // Load upcoming appointments 
        $appointments = collect();

        return view('patient.profile', compact('user', 'appointments'));
    }

    /**
     * Update name, phone, and profile photo
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        if ($user->role !== 'patient') {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = [
            'name' => $request->name,
            'phone' => $request->phone,
        ];

        // Handle profile photo upload
        if ($request->hasFile('profile_photo')) {
            if ($user->profile_photo) {
                Storage::disk('public')->delete($user->profile_photo);
            }

            $data['profile_photo'] = $request->file('profile_photo')->store('profiles', 'public');
        }

        $user->update($data);

        return redirect()->route('patient.profile')->with('status', 'Profile updated successfully!');
    }

    /**
     * Change password
     */
    public function changePassword(Request $request)
    {
        $user = Auth::user();

        if ($user->role !== 'patient') {
            abort(403);
        }

        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('patient.profile')->with('status', 'Password changed successfully!');
    }

    /**
     * Delete patient account
     */
    public function deleteAccount(Request $request)
    {
        $user = Auth::user();

        if ($user->role !== 'patient') {
            abort(403);
        }

        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        // Delete profile photo if exists
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