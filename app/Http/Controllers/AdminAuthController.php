<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\BreakTime;

class AdminAuthController extends Controller
{
    // Show the login form for admin
    public function showLoginForm()
    {
        return view('admin.login');
    }

    // Handle admin login
    public function login(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        // Attempt login with email and password
        if (Auth::attempt($request->only('email', 'password'))) {
            // Check if the logged-in user has the 'admin' role
            if (Auth::user()->role === 'admin') {
                return redirect()->intended('/admin/dashboard'); // Redirect to the admin dashboard
            }

            // If not an admin, log the user out and return error
            Auth::logout();
            return back()->withErrors(['email' => 'You are not authorized to access this area.']);
        }

        // If login fails
        return back()->withErrors(['email' => 'Invalid credentials or not an admin.']);
    }

    // Show the admin dashboard
    public function showDashboard()
    {
        return view('admin.dashboard');
    }

    // Admin logout
    public function logout()
    {
        Auth::logout();
        return redirect('/admin/login');
    }


    public function breakToggle()
{
    $attendance = Attendance::where('user_id', auth()->id())
        ->whereDate('date', now())
        ->latest()
        ->first();

    if (!$attendance) {
        return back()->with('error', 'You must clock in first.');
    }

    $openBreak = $attendance->breaks()->whereNull('break_end')->latest()->first();

    if ($openBreak) {
        // End the break
        $openBreak->update(['break_end' => now()]);
        return back()->with('success', 'Break ended.');
    } else {
        // Start a new break
        $attendance->breaks()->create(['break_start' => now()]);
        return back()->with('success', 'Break started.');
    }
}
}
