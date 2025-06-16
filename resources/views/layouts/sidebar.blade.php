<!-- resources/views/layouts/sidebar.blade.php -->
@php
    $menuItems = config('sidebar');
@endphp

<aside class="w-64 bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 p-4">
    <a href="{{ url('/') }}" class="block text-2xl font-bold text-gray-800 dark:text-white mb-6">
        Sysinn HRM
    </a>

    <nav class="space-y-2">

	@auth
    <div class="text-gray-600 dark:text-gray-300 text-sm">
        <strong>Roles:</strong>
        <ul class="list-disc pl-5">
            @forelse (Auth::user()->roles as $role)
                <li>{{ $role->name }}</li>
            @empty
                <li>No role assigned</li>
            @endforelse
        </ul>
    </div>
@endauth

        @auth
            <span class="block text-gray-600 dark:text-gray-300">
                {{ Auth::user()->name }}
            </span>

            @php
                $user = Auth::user();
                $roleId = $user->role_id ?? null;
            @endphp

            @if ($user->id == 9)
                <a href="{{ route('user-tasks.index') }}"
                   class="block text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">
                    My Tasks                </a>
                 <a href="{{ route('attendance.index') }}" class="block text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">
                    Attendance & Time Tracking
                </a>
            @endif

            @if ($roleId === 1 || $roleId === 2)
                <a href="#" class="block text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">
                    Dashboard
                </a>
                <a href="#" class="block text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">
                    Users
                </a>
                <a href="{{ route('employees.index') }}" class="block text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">
                    Employees
                </a>
                <a href="{{ route('employee-daily-tasks.index') }}" class="block text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">
                    Tasks
                </a>
                
                <a href="#" class="block text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">
                    Settings
                </a>
                <a href="#" class="block text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">
                    Profile
                </a>
                <a href="{{ route('departments.index') }}" class="block text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">
                    Department
                </a>
                <a href="{{ route('attendance.index') }}" class="block text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">
                    Attendance & Time Tracking
                </a>
            @endif

            @foreach ($menuItems as $item)
            @if (array_intersect(Auth::user()->roles->pluck('id')->toArray(), $item['roles']))
                <a href="{{ $item['route'] === '#' ? '#' : route($item['route']) }}"
                class="block text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">
                    {{ $item['label'] }}
                </a>
            @endif
            @endforeach

            
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
               class="block text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">
                Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        @endauth
    </nav>
</aside>
