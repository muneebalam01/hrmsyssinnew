<nav class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
        <a href="{{ url('/') }}" class="text-xl font-bold text-gray-800 dark:text-white">
            Sysinn HRM
        </a>

<div class="flex items-center space-x-4">
            @auth
                @php
                    $roleId = Auth::user()->role_id ?? null;
                @endphp

                {{-- Show "My Tasks" link only for role_id 9 (students/employees) --}}

                <div class="relative inline-block text-left" x-data="{ open: false }">
    <!-- Profile Button -->
    <button @click="open = !open" class="flex items-center space-x-2 focus:outline-none">
        <!-- <img src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : asset('images/default-avatar.png') }}" class="w-10 h-10 rounded-full border border-gray-300 object"> -->
         <img src="{{ Auth::user()->profile_picture 
    ? asset('storage/' . Auth::user()->profile_picture) 
    : asset('images/default-avatar.png') }}" 
     alt="Profile" 
     class="w-10 h-10 rounded-full border border-gray-300 object"class="w-10 h-10 rounded-full">
        <svg class="w-5 h-5 text-gray-600 dark:text-white" fill="none" stroke="currentColor" stroke-width="2"
             viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M19 9l-7 7-7-7"/>
        </svg>
    </button>

    <!-- Dropdown -->
    <div x-show="open" @click.away="open = false"
         x-transition
         class="absolute right-0 mt-2 w-40 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 rounded-md shadow-lg z-50">
        <a href="{{ url('/profile') }}"
           class="block px-4 py-2 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">
            Profile
        </a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                    class="w-full text-left px-4 py-2 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                   class="text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">
                    Logout
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </button>
        </form>
    </div>
</div>
               
                <a href="#" class="text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">
                    {{ Auth::user()->name}}
                </a>

                
            @endauth
        </div>
    </div>
</nav>
