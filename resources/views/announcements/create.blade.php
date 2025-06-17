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
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-6">
                <h2 class="text-2xl font-semibold text-gray-800 dark:text-white">Create Announcement</h2>
            </div>

            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('announcements.store') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Title</label>
                    <input type="text" name="title" id="title" class="w-full border border-gray-300 rounded-lg px-4 py-2 dark:bg-gray-700 dark:text-white dark:border-gray-600" required>
                </div>

                <div>
                    <label for="body" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Body</label>
                    <textarea name="body" id="body" rows="5" class="w-full border border-gray-300 rounded-lg px-4 py-2 dark:bg-gray-700 dark:text-white dark:border-gray-600" required></textarea>
                </div>

                <div>
                    <label for="publish_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Publish Date</label>
                    <input type="date" name="publish_date" id="publish_date" class="w-full border border-gray-300 rounded-lg px-4 py-2 dark:bg-gray-700 dark:text-white dark:border-gray-600">
                </div>

                <div>
                    <label class="inline-flex items-center text-sm text-gray-700 dark:text-gray-300">
                        <input type="checkbox" name="is_active" value="1" checked class="mr-2">
                        Active
                    </label>
                </div>

                <div>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </main>
</div>
@endsection
