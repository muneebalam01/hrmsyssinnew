<nav class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
        <a href="{{ url('/') }}" class="text-xl font-bold text-gray-800 dark:text-white">
            Sysinn HRM
        </a>

        <div class="flex items-center space-x-4">
            {{-- Show to authenticated employee --}}
            @auth('employee')
                <a href="{{ route('user-tasks.index') }}"
                   class="text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">
                    My Tasks
                </a>

                <a href="#"
                   class="text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">
                    {{ Auth::guard('employee')->user()->first_name }}
                </a>
            @endauth

            {{-- Show to authenticated admin or super admin --}}
            @auth
                @php
                    $roleId = Auth::user()->role_id ?? null;
                @endphp

                @if($roleId === 1 || $roleId === 2)

                    
                    <a href="#" class="text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">
                       {{ Auth::user()->name }}
                    </a>
                @endif

               <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>

            @endauth
        </div>
    </div>
</nav>
