@extends('layouts.app')

@section('content')
<div class="flex">
    @include('layouts.sidebar')

    <div class="flex-1 p-4 md:ml-64">
        <div class="container mx-auto px-4 py-8">
            <h1 class="text-2xl font-bold text-gray-800 mb-6">Users List</h1>

            <div class="bg-white shadow-md rounded-lg overflow-x-auto">
                <table class="min-w-full">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Profile</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Name</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Email</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Password</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Roles</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($users as $user)
                        <tr>
                           <td class="px-6 py-4">
    @if($user->profile_image)
        <img src="{{ asset('storage/'.$user->profile_image) }}" 
             class="h-10 w-10 rounded-full">
    @else
        <div class="h-10 w-10 rounded-full bg-gray-300 flex items-center justify-center">
            {{ substr($user->name, 0, 1) }}
        </div>
    @endif
</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $user->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $user->email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <span class="bg-gray-100 px-2 py-1 rounded text-xs font-mono">••••••••</span>
                                <button class="ml-2 text-blue-500 hover:text-blue-700 text-xs" 
                                        onclick="alert('Encrypted password: {{ $user->password }}')">
                                    Show
                                </button>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex flex-wrap gap-1">
                                    @foreach($user->roles as $role)
                                        <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800">
                                            {{ ucfirst($role->name) }}
                                        </span>
                                    @endforeach
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Mobile menu button -->
<button id="sidebarToggle" class="md:hidden fixed top-4 left-4 z-50 p-2 rounded-md text-gray-700 bg-gray-100">
    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
    </svg>
</button>

<script>
    document.getElementById('sidebarToggle').addEventListener('click', function() {
        document.querySelector('aside').classList.toggle('active');
    });
</script>
@endsection