<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RestrictUnapprovedDoctors
{
    public function handle(Request $request, Closure $next): Response
{
    // Skip for logout request to prevent interference
    if ($request->is('logout')) {
        return $next($request);
    }

    $user = Auth::user();

    if ($user && $user->role === 'doctor') {
        // Skip check if already on pending page
        if ($request->path() === 'doctor/pending') {
            return $next($request);
        }

        $doctor = $user->doctor;

        if (!$doctor) {
            abort(403, 'Your doctor profile is not set up.');
        }

        if ($doctor->status === 'pending') {
            return redirect()->route('doctor.pending');
        }

        if ($doctor->status === 'rejected') {
            Auth::logout();
            return redirect('/login')->with('error', 'Your doctor account was rejected. Contact admin.');
        }
    }

    return $next($request);
}
}