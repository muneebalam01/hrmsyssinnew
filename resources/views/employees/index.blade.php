@extends('layouts.app')

@section('content')
<style>
    a.bg-blue-600.hover\:bg-blue-700.text-white.font-medium.py-2.px-4.rounded {
    background-color: blue;
}
button.bg-blue-600.hover\:bg-blue-700.text-white.font-medium.py-2.px-4.rounded {
    background-color: blue!important;
}
</style>



<div class="flex min-h-screen">
    <!-- Sidebar -->
    @include('layouts.sidebar')
    <!-- Main content -->
    <main class="flex-1 p-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    
        <div class="flex justify-between items-center mb-6">
            

         
        <form method="GET" action="{{ route('employees.index') }}" class="mb-4">
            <div class="flex items-center space-x-2">
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Search by name or email"
                    class="w-full sm:w-64 px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded">
                    Search
                </button>
            </div>
        </form>
<h1 class="text-2xl font-semibold text-gray-800 dark:text-white">Employees</h1>
            <a href="{{ route('employees.create') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded">
                Add Employee
            </a>
        </div>

        <div class="overflow-x-auto bg-white dark:bg-gray-800 shadow-md rounded-lg">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-100 dark:bg-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 dark:text-gray-300">Name</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 dark:text-gray-300">Email</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 dark:text-gray-300">Position</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 dark:text-gray-300">Start Date</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 dark:text-gray-300">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($employees as $employee)
                        <tr>
                            <td class="px-6 py-4 text-gray-900 dark:text-white">
                                {{ $employee->first_name }} {{ $employee->last_name }}
                            </td>
                             <td class="px-6 py-4 text-gray-900 dark:text-white">
                                {{ $employee->position }}
                            </td>
                            <td class="px-6 py-4 text-gray-900 dark:text-white">
                                {{ $employee->email }}
                            </td>
                             <td class="px-6 py-4 text-gray-900 dark:text-white">
                                {{ $employee->hired_at }}
                            </td>
                            <td class="px-6 py-4 space-x-2">
                                <a href="{{ route('employees.show', $employee) }}"
                                   class="text-blue-600 hover:underline dark:text-blue-400">
                                    View
                                </a>
                                <a href="{{ route('employees.edit', $employee) }}"
                                   class="text-yellow-600 hover:underline dark:text-yellow-400">
                                    Edit
                                </a>
                                <form action="{{ route('employees.destroy', $employee) }}" method="POST" class="inline-block"
                                      onsubmit="return confirm('Are you sure you want to delete this employee?');">
                                    @csrf @method('DELETE')
                                    <button type="submit"
                                            class="text-red-600 hover:underline dark:text-red-400">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                No employees found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    </main>
@endsection
