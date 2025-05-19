@extends('layouts.app')

@section('content')
<style>
    a.bg-blue-600.hover\:bg-blue-700.text-white.font-medium.py-2.px-4.rounded {
        background-color: blue;
    }
</style>

<div class="flex min-h-screen">
    @include('layouts.sidebar')

    <main class="flex-1 p-6">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-semibold text-gray-800 dark:text-white mb-6">Departments</h2>

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-4 text-right">
                <a href="{{ route('departments.create') }}"
                   class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded">
                    Add Department
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full bg-white dark:bg-gray-800 rounded shadow">
                    <thead class="bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300">
                        <tr>
                            <th class="py-3 px-6 text-left">#</th>
                            <th class="py-3 px-6 text-left">Name</th>
                            <th class="py-3 px-6 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700 dark:text-gray-200">
                        @foreach($departments as $department)
                            <tr class="border-b border-gray-200 dark:border-gray-700">
                                <td class="py-3 px-6">{{ $department->id }}</td>
                                <td class="py-3 px-6">{{ $department->name }}</td>
                                <td class="py-3 px-6 space-x-2">
                                    <a href="{{ route('departments.edit', $department) }}"
                                       class="bg-yellow-500 hover:bg-yellow-600  py-1 px-3 rounded text-sm">Edit</a>

                                    <form action="{{ route('departments.destroy', $department) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('Are you sure?')"
                                                class="bg-red-600 hover:bg-red-700 text-white py-1 px-3 rounded text-sm">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                        @if($departments->isEmpty())
                            <tr>
                                <td colspan="3" class="text-center py-4 text-gray-500">No departments found.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>
@endsection
