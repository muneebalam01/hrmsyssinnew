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
                <h1 class="text-2xl font-semibold text-gray-800 dark:text-white">Announcements</h1>
                <a href="{{ route('announcements.create') }}"
                   class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded">
                    Add Announcement
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
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 dark:text-gray-300">Title</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 dark:text-gray-300">Publish Date</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 dark:text-gray-300">Body</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse ($announcements as $announcement)
                            <tr>
                                <td class="px-6 py-4 text-gray-900 dark:text-white">{{ $announcement->id }}</td>
                                <td class="px-6 py-4 text-gray-900 dark:text-white font-semibold">{{ $announcement->title }}</td>
                                <td class="px-6 py-4 text-gray-900 dark:text-white">{{ $announcement->publish_date }}</td>
                                <td class="px-6 py-4 text-gray-900 dark:text-white">{{ Str::limit($announcement->body, 100) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                    No announcements found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </main>
</div>
@endsection
