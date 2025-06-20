<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->get();
        return view('users.index', compact('users'));
    }

    // Add these methods for profile image handling
    public function updateProfileImage(Request $request, User $user)
    {
        $request->validate([
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($user->profile_image) {
            Storage::delete($user->profile_image);
        }

        $path = $request->file('profile_image')->store('profile-images');
        $user->update(['profile_image' => $path]);

        return back()->with('success', 'Profile image updated successfully');
    }

    public function removeProfileImage(User $user)
    {
        if ($user->profile_image) {
            Storage::delete($user->profile_image);
            $user->update(['profile_image' => null]);
        }

        return back()->with('success', 'Profile image removed successfully');
    }
}