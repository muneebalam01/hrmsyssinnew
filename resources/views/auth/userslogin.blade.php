@extends('layouts.app')

@section('content')
<style>
    a.bg-blue-600.hover\:bg-blue-700.text-white.font-medium.py-2.px-4.rounded {
        background-color: blue;
    }
    button.bg-blue-600.hover\:bg-blue-700.text-white.font-medium.py-2.px-4.rounded {
        background-color: blue !important;
    }
</style>

<div class="max-w-md mx-auto px-4 sm:px-6 lg:px-8 mt-12">
    <div class="bg-white dark:bg-gray-800 p-8 rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold text-gray-800 dark:text-white mb-6 text-center">User Login</h2>

        @if ($errors->any())
            <div class="mb-4 text-red-600 bg-red-100 border border-red-300 rounded p-4 dark:bg-red-200 dark:text-red-800">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ url('/userslogin') }}">
            @csrf

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email</label>
                <input type="email" name="email" id="email" required
                       class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">
            </div>

            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Password</label>
                <input type="password" name="password" id="password" required
                       class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">
            </div>

            <div>
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded w-full">
                    Login
                </button>
            </div>
            <div class="mt-4 text-center">
            <a href="{{ url('/usersregister') }}" class="text-blue-600 hover:underline dark:text-blue-400">
                Don't have an account? Register here
            </a>
            </div>

        </form>
    </div>
</div>
@endsection
