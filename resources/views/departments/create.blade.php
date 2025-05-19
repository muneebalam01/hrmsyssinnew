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
    @include('layouts.sidebar')

    <main class="flex-1 p-6">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-semibold text-gray-800 dark:text-white mb-6">Create Department</h2>

            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('departments.store') }}" method="POST" class="bg-white dark:bg-gray-800 shadow-md rounded px-8 pt-6 pb-8 mb-4">
                @csrf

                <div class="mb-4">
                    <label for="name" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Department Name</label>
                    <input type="text" name="name" id="name"
                        class="w-full border border-gray-300 dark:border-gray-600 rounded px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                        required>
                </div>

                <div class="flex items-center space-x-4">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded">
                        Save
                    </button>
                    <a href="{{ route('departments.index') }}" class="bg-gray-400 hover:bg-gray-500 text-white font-medium py-2 px-4 rounded">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </main>
</div>
@endsection
