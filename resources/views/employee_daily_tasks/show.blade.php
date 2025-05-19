@extends('layouts.app')

@section('content')
<style>
    a.bg-blue-600.hover\:bg-blue-700.text-white.font-medium.py-2.px-4.rounded {
        background-color: blue;
    }
</style>




<div class="flex min-h-screen">
    <!-- Sidebar -->
@include('layouts.sidebar')
    <!-- Main content -->
    <main class="flex-1 p-6">


<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
    <h2 class="text-2xl font-semibold text-gray-800 dark:text-white mb-6">Task Details</h2>

    <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
        <div class="mb-4">
            <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-1">Employee</label>
            <p class="text-gray-900 dark:text-white">{{ $employee_daily_task->employee->first_name }} {{ $employee_daily_task->employee->last_name }}</p>
        </div>
        <div class="mb-4">
    <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-1">Assigned By</label>
    <p class="text-gray-900 dark:text-white">
        {{ $employee_daily_task->assignedBy ? $employee_daily_task->assignedBy->name : 'N/A' }}
    </p>
</div>

        <div class="mb-4">
            <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-1">Task Date</label>
            <p class="text-gray-900 dark:text-white">{{ \Carbon\Carbon::parse($employee_daily_task->task_date)->format('F j, Y') }}</p>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-1">Task Subject</label>
            <p class="text-gray-900 dark:text-white">{{ $employee_daily_task->task_subject }}</p>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-1">Task Description</label>
            <p class="text-gray-900 dark:text-white whitespace-pre-line">{{ $employee_daily_task->task_description }}</p>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-1">Priority</label>
            <p class="text-gray-900 dark:text-white capitalize">{{ $employee_daily_task->priority }}</p>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-1">Status</label>
            <p class="text-gray-900 dark:text-white capitalize">{{ str_replace('_', ' ', $employee_daily_task->status) }}</p>
        </div>


        @if($employee_daily_task->status !== 'completed')
    <div class="mt-6">
<form action="{{ route('task-comments.store') }}" method="POST">
    @csrf
   <input type="hidden" name="employee_daily_task_id" value="{{ $employee_daily_task->id }}">

    
    <div class="mb-4">
        <textarea name="comment" rows="3" 
                  class="w-full border border-gray-300 dark:border-gray-600 rounded px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                  placeholder="Add your comment..." required></textarea>
    </div>

    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded">
        Post Comment
    </button>
</form>


</div>
@endif


@if($employee_daily_task->comments->count())
    <div class="mt-8">
        <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Comments</h3>
        @foreach($employee_daily_task->comments as $comment)
            <div class="mb-4 border border-gray-200 dark:border-gray-700 rounded p-4 bg-gray-50 dark:bg-gray-900">
                <div class="flex justify-between items-center mb-2">
                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">
                      {{ $comment->commentedBy->name ?? $comment->commentedBy->first_name ?? 'Unknown User' }}

                    </span>
                    <span class="text-xs text-gray-500 dark:text-gray-400">
                        {{ $comment->created_at->diffForHumans() }}
                    </span>
                </div>
                <p class="text-gray-900 dark:text-white whitespace-pre-line">{{ $comment->comment }}</p>
            </div>
        @endforeach
    </div>
@else
    <div class="mt-8 text-sm text-gray-500 dark:text-gray-400">No comments yet.</div>
@endif

        <div class="mt-6">
            <a href="{{ route('employee-daily-tasks.index') }}" 
               class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded">
                Back to Tasks
            </a>
        </div>
    </div>
</div>
</main>
@endsection
