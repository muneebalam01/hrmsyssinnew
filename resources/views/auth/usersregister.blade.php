@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-semibold text-gray-800 dark:text-white mb-6">User Registration</h2>

        <form method="POST" action="{{ url('/usersregister') }}" class="bg-white dark:bg-gray-800 shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Name</label>
                <input type="text" id="name" name="name"
                       value="{{ old('name') }}"
                       class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:text-white dark:border-gray-600 focus:outline-none focus:ring focus:border-blue-300"
                       required>
                @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Email</label>
                <input type="email" id="email" name="email"
                       value="{{ old('email') }}"
                       class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:text-white dark:border-gray-600 focus:outline-none focus:ring focus:border-blue-300"
                       required>
                @error('email') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Password</label>
                <input type="password" id="password" name="password"
                       class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:text-white dark:border-gray-600 focus:outline-none focus:ring focus:border-blue-300"
                       required>
                @error('password') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label for="password_confirmation" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation"
                       class="w-full px-4 py-2 border rounded-lg dark:bg-gray-700 dark:text-white dark:border-gray-600 focus:outline-none focus:ring focus:border-blue-300"
                       required>
            </div>

<div class="mb-4">
    <label class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Search Roles</label>
    
    <!-- Search Input -->
    <input type="text" id="roleSearch"
           placeholder="Type to search roles..."
           class="w-full px-4 py-2 mb-3 border rounded-lg dark:bg-gray-700 dark:text-white dark:border-gray-600 focus:outline-none focus:ring focus:border-blue-300">
    
    <!-- Checkboxes List -->
    <div id="rolesList" class="space-y-2 max-h-48 overflow-y-auto border p-3 rounded-md dark:border-gray-600 dark:bg-gray-800">
        @foreach($roles as $role)
            <label class="flex items-center role-item">
                <input type="checkbox" name="role_id[]" value="{{ $role->id }}"
                       {{ is_array(old('role_id')) && in_array($role->id, old('role_id')) ? 'checked' : '' }}
                       class="form-checkbox text-blue-600 dark:bg-gray-700 dark:border-gray-600">
                <span class="ml-2 text-gray-700 dark:text-gray-300">{{ ucfirst($role->name) }}</span>
            </label>
        @endforeach
    </div>

    @error('role_id') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
</div>


            <div class="flex items-center justify-between mt-6">
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded">
                    Register
                </button>
                <a href="{{ url('/') }}"
                   class="text-gray-600 dark:text-gray-300 hover:underline">
                    Cancel
                </a>
            </div>
        </form>
    </div>
@endsection


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('roleSearch');
        const roleItems = document.querySelectorAll('.role-item');

        searchInput.addEventListener('input', function () {
            const query = searchInput.value.toLowerCase();

            roleItems.forEach(item => {
                const text = item.textContent.toLowerCase();
                item.style.display = text.includes(query) ? '' : 'none';
            });
        });
    });
</script>

<style>
    #rolesList::-webkit-scrollbar {
        width: 6px;
    }

    #rolesList::-webkit-scrollbar-thumb {
        background-color: rgba(100, 116, 139, 0.5); /* slate-500 */
        border-radius: 4px;
    }
</style>
