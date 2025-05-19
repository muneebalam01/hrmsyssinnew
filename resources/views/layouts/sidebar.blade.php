<!-- resources/views/layouts/sidebar.blade.php -->


    <!-- Sidebar -->
    <aside class="w-64 bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 p-4">
        <a href="{{ url('/') }}" class="block text-2xl font-bold text-gray-800 dark:text-white mb-6">
            Sysinn HRM
        </a>

        <nav class="space-y-2">
            {{-- Show to authenticated employee --}}
            @auth('employee')
                <a href="{{ route('user-tasks.index') }}"
                   class="block text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">
                    My Tasks
                </a>

                <span class="block text-gray-600 dark:text-gray-300">
                    {{ Auth::guard('employee')->user()->first_name }}
                </span>
            @endauth

            {{-- Show to authenticated admin or super admin --}}
            @auth
                @php
                    $roleId = Auth::user()->role_id ?? null;
                @endphp

                @if($roleId === 1 || $roleId === 2)
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
                    <a href="#" class="block text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">
                        Attendance & Time Tracking
                    </a>
                   
                @endif

                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            @endauth
        </nav>
    </aside>

