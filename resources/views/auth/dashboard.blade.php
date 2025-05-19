@extends('layouts.app')

@section('content')







<div class="flex min-h-screen">
    <!-- Sidebar -->
    <aside class="w-64 bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 p-4">
        <a href="{{ url('/') }}" class="block text-2xl font-bold text-gray-800 dark:text-white mb-6">
            Sysinn HRM
        </a>

        <nav class="space-y-2">
            {{-- Show to authenticated employee --}}
            @auth('employee')
                <a href="{{ route('user-tasks.index') }}"
                   class="block text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">
                    My Tasks
                </a>

                <span class="block text-gray-600 dark:text-gray-300">
                    {{ Auth::guard('employee')->user()->first_name }}
                </span>
            @endauth

            {{-- Show to authenticated admin or super admin --}}
            @auth
                @php
                    $roleId = Auth::user()->role_id ?? null;
                @endphp

                @if($roleId === 1 || $roleId === 2)
                    
                    <a href="{{ route('auth.dashboard') }}" class="block text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">
                        Dashboard
                    </a>
                    <a href="#" class="block text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">
                        Users
                    </a>
                    <a href="{{ route('employees.index') }}" class="block text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">
                        Employees
                    </a>
                    <a href="{{ route('employee-daily-tasks.index') }}" class="block text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">
                        Tasks
                    </a>
                    <a href="#" class="block text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">
                        Settings
                    </a>
                    <a href="#" class="block text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">
                         Profile
                    </a>
                    <a href="#" class="block text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">
                         Attendance & Time Tracking
                    </a>
                @endif

                <a href="{{ route('logout') }}" class="block text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">
                    Logout
                </a>
            @endauth
        </nav>
    </aside>

    <!-- Main content -->
    <main class="flex-1 p-6">
      


    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-6">
            <h1 class="text-2xl font-semibold text-gray-800 dark:text-white">
                Welcome, {{ Auth::user()->name }}!
            </h1>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-2">Total Users</h3>
                <p class="text-gray-900 dark:text-white text-xl">123</p>
            </div>

            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-2">Active Sessions</h3>
                <p class="text-gray-900 dark:text-white text-xl">45</p>
            </div>

            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-2">Pending Requests</h3>
                <p class="text-gray-900 dark:text-white text-xl">8</p>
            </div>

            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-2">
                    <a href="{{ route('employees.index') }}" class="hover:underline text-blue-600 dark:text-blue-400">
                        Employees
                    </a>
                </h3>
                <p class="text-gray-900 dark:text-white text-xl">Total Employees: {{ $employeeCount }}</p>
            </div>
        </div>
    </div>
    </main>
</div>










@endsection
