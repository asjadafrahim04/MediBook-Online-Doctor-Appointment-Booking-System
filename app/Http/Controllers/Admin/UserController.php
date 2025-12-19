<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a list of all users
     */
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->get();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Block a user
     */
    public function block(User $user)
    {
        $user->update(['is_blocked' => true]);

        return redirect()->route('admin.users.index')
            ->with('success', 'User blocked successfully!');
    }

    /**
     * Unblock a user
     */
    public function unblock(User $user)
    {
        $user->update(['is_blocked' => false]);

        return redirect()->route('admin.users.index')
            ->with('success', 'User unblocked successfully!');
    }

    /**
     * Delete a user with confirmation
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'User deleted successfully!');
    }

    /**
     * Show user details
     */
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }
}