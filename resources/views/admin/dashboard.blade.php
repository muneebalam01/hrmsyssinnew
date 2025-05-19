@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-6 py-12">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
            <h2 class="text-3xl font-bold text-gray-800 mb-4">Welcome to the Admin Dashboard</h2>

            <div class="mb-8">
                <p class="text-xl text-gray-600">You are logged in as <span class="font-semibold text-blue-600">{{ auth()->user()->name }}</span>.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Example: Total Users -->
                <div class="bg-gray-100 p-6 rounded-lg shadow-lg">
                    <h3 class="text-xl font-semibold text-gray-700 mb-2">Total Users</h3>
                    <p class="text-3xl font-bold text-gray-800">{{ $totalUsers }}</p>
                </div>

                <!-- Example: Total Active Users -->
                <div class="bg-gray-100 p-6 rounded-lg shadow-lg">
                    <h3 class="text-xl font-semibold text-gray-700 mb-2">Active Users</h3>
                    <p class="text-3xl font-bold text-gray-800">{{ $activeUsers }}</p>
                </div>

                <!-- Example: Total Admins -->
                <div class="bg-gray-100 p-6 rounded-lg shadow-lg">
                    <h3 class="text-xl font-semibold text-gray-700 mb-2">Total Admins</h3>
                    <p class="text-3xl font-bold text-gray-800">{{ $totalAdmins }}</p>
                </div>
            </div>

            <div class="mt-8">
                <h3 class="text-2xl font-bold text-gray-800 mb-4">Recent Activity</h3>
                <div class="bg-gray-100 p-6 rounded-lg shadow-lg">
                    <ul class="space-y-4">
                        @foreach($recentActivities as $activity)
                            <li class="text-lg text-gray-700">
                                <strong>{{ $activity->user->name }}</strong> {{ $activity->description }} 
                                <span class="text-sm text-gray-500">{{ $activity->created_at->diffForHumans() }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
