@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md">
    <h2 class="text-xl font-semibold mb-4 text-gray-800 dark:text-white">Edit Profile</h2>

    @if (session('success'))
        <p class="text-green-600">{{ session('success') }}</p>
    @endif

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <div>
            <label class="block mb-1 text-gray-700 dark:text-gray-300">Name</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}"
                   class="w-full px-4 py-2 border rounded dark:bg-gray-700 dark:text-white">
            @error('name') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block mb-1 text-gray-700 dark:text-gray-300">Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}"
                   class="w-full px-4 py-2 border rounded dark:bg-gray-700 dark:text-white">
            @error('email') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block mb-1 text-gray-700 dark:text-gray-300">New Password</label>
            <input type="password" name="password"
                   class="w-full px-4 py-2 border rounded dark:bg-gray-700 dark:text-white">
            @error('password') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block mb-1 text-gray-700 dark:text-gray-300">Confirm Password</label>
            <input type="password" name="password_confirmation"
                   class="w-full px-4 py-2 border rounded dark:bg-gray-700 dark:text-white">
        </div>

        <div>
            <label class="block mb-1 text-gray-700 dark:text-gray-300">Profile Picture</label>
            <input type="file" name="profile_picture">

    <!-- Show current image -->
    @if ($user->profile_picture)
        <img src="{{ asset('storage/' . $user->profile_picture) }}" width="100" height="100">
    @endif
        </div>

        <div>
            <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Update Profile
            </button>
        </div>
    </form>
</div>
@endsection
