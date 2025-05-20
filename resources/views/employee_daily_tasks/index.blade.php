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





<div class="flex min-h-screen">
    <!-- Sidebar -->
    @include('layouts.sidebar')

    <!-- Main content -->
    <main class="flex-1 p-6">

    

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">



    <div class="flex justify-between items-center mb-6">


    <form method="GET" action="{{ route('employee-daily-tasks.index') }}" class="flex space-x-2">
    <input type="text" name="search" value="{{ request('search') }}"
           placeholder="Search by name or status"
           class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:border-blue-300 dark:bg-gray-700 dark:text-white dark:border-gray-600">
    <button type="submit"
            class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded">
        Search
    </button>
</form>



        <h1 class="text-2xl font-semibold text-gray-800 dark:text-white">Management Tasks List</h1>
        <a href="{{ route('employee-daily-tasks.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded">
            Add New Task
        </a>
    </div>

    @if (session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto bg-white dark:bg-gray-800 shadow-md rounded-lg">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-100 dark:bg-gray-700">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 dark:text-gray-300">#</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 dark:text-gray-300">Employee</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 dark:text-gray-300">Date</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 dark:text-gray-300">Status</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 dark:text-gray-300">Created At</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 dark:text-gray-300">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                @forelse ($tasks as $task)
                    <tr>
                        <td class="px-6 py-4 text-gray-900 dark:text-white">{{ $task->id }}</td>
                        <td class="px-6 py-4 text-gray-900 dark:text-white">{{ $task->employee->first_name }} {{ $task->employee->last_name }}</td>
                        <td class="px-6 py-4 text-gray-900 dark:text-white">{{ $task->task_date }}</td>
                        <td class="px-6 py-4 text-gray-900 dark:text-white">{{ ucfirst($task->status) }}</td>
                        <td class="px-6 py-4 text-gray-900 dark:text-white">{{ $task->created_at->format('d M Y, h:i A') }}</td>
                       <td class="px-6 py-4 space-x-2">
    <a href="{{ route('employee-daily-tasks.show', $task) }}"
       class="text-blue-600 hover:underline dark:text-blue-400">
        Show
    </a>

    <a href="{{ route('employee-daily-tasks.edit', $task) }}"
       class="text-yellow-600 hover:underline dark:text-yellow-400">
        Edit
    </a>

    <form action="{{ route('employee-daily-tasks.destroy', $task) }}" method="POST"
          class="inline-block"
          onsubmit="return confirm('Are you sure you want to delete this task?');">
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
                        <td colspan="7" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                            No tasks found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
</main>
@endsection
