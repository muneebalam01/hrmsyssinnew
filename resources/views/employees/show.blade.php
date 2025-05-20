@extends('layouts.app')

@section('content')
<div class="flex min-h-screen bg-gray-100">
    <!-- Sidebar -->
    @include('layouts.sidebar')

    <!-- Main content -->
    <main class="flex-1 p-8">
        <div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-md p-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-2">Employee Details</h2>

            <div class="flex flex-col items-center mb-6">
                @if($employee->profile_picture)
                    <img src="{{ asset('storage/' . $employee->profile_picture) }}"
                         alt="Profile Picture"
                         class="w-40 h-40 object-cover rounded-full border-4 border-indigo-500 shadow-lg mb-4">
                @else
                    <div class="w-40 h-40 bg-gray-200 rounded-full flex items-center justify-center text-gray-500 text-xl mb-4">
                        No Image
                    </div>
                @endif

                <h3 class="text-xl font-semibold text-gray-700">{{ $employee->first_name }} {{ $employee->last_name }}</h3>
                <p class="text-gray-500">{{ $employee->position ?? 'N/A' }}</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-gray-700">
                <div>
                    <p><strong>Email:</strong> {{ $employee->email }}</p>
                    <p><strong>Phone:</strong> {{ $employee->phone ?? 'N/A' }}</p>
                </div>
                <div>
                    <p><strong>Salary:</strong> {{ $employee->salary ? 'RS ' . number_format($employee->salary, 2) : 'N/A' }}</p>
                    <p><strong>Hire Date:</strong> {{ $employee->hired_at ? \Carbon\Carbon::parse($employee->hired_at)->format('d M Y') : 'N/A' }}</p>
                </div>
                <div>
                    <p><strong>Department:</strong> {{ $employee->department->name ?? 'N/A' }}</p>
                </div>
            </div>

            <div class="mt-8 flex gap-4">
                <a href="{{ route('employees.edit', $employee) }}"
                   class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-2 px-4 rounded-lg shadow">
                    Edit
                </a>
                <a href="{{ route('employees.index') }}"
                   class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-lg shadow">
                    Back to List
                </a>
            </div>
        </div>
    </main>
</div>
@endsection
