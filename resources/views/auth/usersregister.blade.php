@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-semibold text-gray-800 dark:text-white mb-6">User Registration</h2>

        <form method="POST" action="{{ url('/usersregister') }}" class="bg-white dark:bg-gray-800 shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Name</label>
                <input type="text" id="name" name="name"
                       value="{{ old('name') }}"
                       class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:text-white dark:border-gray-600 focus:outline-none focus:ring focus:border-blue-300"
                       required>
                @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Email</label>
                <input type="email" id="email" name="email"
                       value="{{ old('email') }}"
                       class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:text-white dark:border-gray-600 focus:outline-none focus:ring focus:border-blue-300"
                       required>
                @error('email') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Password</label>
                <input type="password" id="password" name="password"
                       class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:text-white dark:border-gray-600 focus:outline-none focus:ring focus:border-blue-300"
                       required>
                @error('password') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label for="password_confirmation" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation"
                       class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:text-white dark:border-gray-600 focus:outline-none focus:ring focus:border-blue-300"
                       required>
            </div>

        <div class="mb-4">
    <label for="role_id" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Role</label>
    <select id="role_id" name="role_id"
        class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:text-white dark:border-gray-600 focus:outline-none focus:ring focus:border-blue-300"
        required>
        <option value="">-- Select Role --</option>
        @foreach($roles as $role)
            <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
                {{ ucfirst($role->name) }}
            </option>
        @endforeach
    </select>

    @error('role_id') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
</div>

            <div class="flex items-center justify-between mt-6">
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded">
                    Register
                </button>
                <a href="{{ url('/') }}"
                   class="text-gray-600 dark:text-gray-300 hover:underline">
                    Cancel
                </a>
            </div>
        </form>
    </div>
@endsection
