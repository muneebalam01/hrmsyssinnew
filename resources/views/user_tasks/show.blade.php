@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <h2 class="text-2xl font-semibold text-gray-800 dark:text-white mb-6">
        Task Details
    </h2>

    <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
        <div class="mb-4">
            <strong class="text-gray-700 dark:text-gray-300">Employee:</strong>
            <span class="text-gray-900 dark:text-white">
                {{ $task->employee->first_name }} {{ $task->employee->last_name }}
            </span>
        </div>
        <div class="mb-4">
            <strong class="text-gray-700 dark:text-gray-300">Task Date:</strong>
            <span class="text-gray-900 dark:text-white">{{ $task->task_date }}</span>
        </div>
        <div class="mb-4">
            <strong class="text-gray-700 dark:text-gray-300">Description:</strong>
            <p class="text-gray-900 dark:text-white">{{ $task->task_description }}</p>
        </div>
        <div class="mb-4">
            <strong class="text-gray-700 dark:text-gray-300">Status:</strong>
            <span class="text-gray-900 dark:text-white">{{ ucfirst($task->status) }}</span>
        </div>
        <div class="mb-4">
            <strong class="text-gray-700 dark:text-gray-300">Created At:</strong>
            <span class="text-gray-900 dark:text-white">{{ $task->created_at->format('d M Y, h:i A') }}</span>
        </div>

        <a href="{{ route('user.tasks.index') }}" class="mt-4 inline-block text-blue-600 hover:underline dark:text-blue-400">
            ← Back to Tasks
        </a>
    </div>
</div>
@endsection
