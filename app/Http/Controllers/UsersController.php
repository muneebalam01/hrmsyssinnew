<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Role; 
class UsersController extends Controller
{
    public function showLoginForm()
    {
        if (auth()->check()) {
            return redirect('/auth/dashboard');
        }
        return view('auth.userslogin');
    }

public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        $user = auth()->user();
        // Redirect based on role
        if ($user->roles->contains('id', 9)) {
                return redirect()->route('employee.dashboard');
            }

        return redirect()->route('auth.dashboard');
    }

    return back()->withErrors([
        'email' => 'Invalid credentials.',
    ])->onlyInput('email');
}

    public function showRegisterForm()
    {
        if (auth()->check()) {
            return redirect('/dashboard');
        }
        $roles = Role::all();
        return view('auth.usersregister', compact('roles'));
    }

    public function register(Request $request)
{
    $data = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|confirmed|min:6',
        'role_id' => 'required|array',
        'role_id.*' => 'exists:roles,id',
        'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // ✅ add this
    ]);

    // Handle file upload
    $profilePath = null;
    if ($request->hasFile('profile_picture')) {
        $profilePath = $request->file('profile_picture')->store('profile_pictures', 'public');
    }

    // Create user with image path
    $user = User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
        'profile_picture' => $profilePath, // ✅ save the path
    ]);

    $user->roles()->sync($data['role_id']);
    Auth::login($user);
    return redirect('/auth/dashboard');
}


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/userslogin');
    }
}
