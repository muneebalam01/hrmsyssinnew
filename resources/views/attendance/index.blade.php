@extends('layouts.app')

@section('content')
<style>
    a.bg-blue-600.hover\:bg-blue-700.text-white.font-medium.py-2.px-4.rounded {
        background-color: blue;
    }
    button.bg-blue-600.hover\:bg-blue-700.text-white.font-medium.py-2.px-4.rounded {
        background-color: blue !important;
    }
    button.bg-green-500.hover\:bg-green-600.text-white.font-medium.py-2.px-4.rounded {
        background: blue;
    }
    button.bg-red-500.hover\:bg-red-600.text-white.font-medium.py-2.px-4.rounded {
        background: red;
    }
</style>

<div class="flex min-h-screen">
    @include('layouts.sidebar')

    <main class="flex-1 p-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-semibold text-gray-800 dark:text-white">
                    Attendance & Time Tracking
                </h1>

                <!-- Work Timer -->
            <div class="text-lg font-semibold text-blue-700 dark:text-blue-300">
                Work Duration: <span id="work-timer">00:00:00</span>
            </div>


            </div>

            <div class="flex justify-start space-x-2 mb-6">
                <form method="POST" action="{{ route('attendance.clock-in') }}" id="clockInForm">
                    @csrf
                    <button type="submit"
                            class="bg-green-500 hover:bg-green-600 text-white font-medium py-2 px-4 rounded">
                        Clock In
                    </button>
                </form>

                <form method="POST" action="{{ route('attendance.clock-out') }}">
                    @csrf
                    <button type="submit"
                            class="bg-red-500 hover:bg-red-600 text-white font-medium py-2 px-4 rounded">
                        Clock Out
                    </button>
                </form>

                <form method="POST" action="{{ route('attendance.break') }}" id="breakForm">
                    @csrf
                    <button type="submit"
                            class="bg-yellow-500 hover:bg-yellow-600 text-white font-medium py-2 px-4 rounded">
                        Break
                    </button>
                </form>
            </div>

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
                    {{ session('error') }}
                </div>
            @endif

            <div class="overflow-x-auto bg-white dark:bg-gray-800 shadow-md rounded-lg">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-100 dark:bg-gray-700">
                        <tr>
                           


                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 dark:text-gray-300">Date</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 dark:text-gray-300">Clock In</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 dark:text-gray-300">Clock Out</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse ($attendances as $attendance)
                            <tr>
                                <td class="px-6 py-4 text-gray-900 dark:text-white">{{ $attendance->date }}</td>
                                <td class="px-6 py-4 text-gray-900 dark:text-white">{{ $attendance->clock_in }}</td>
                                <td class="px-6 py-4 text-gray-900 dark:text-white">{{ $attendance->clock_out ?? '—' }}</td>

                                 <p>Clocked in at: {{ $clockInTime ?? 'not clocked in' }}</p>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                    No attendance records found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $attendances->links() }}
            </div>
        </div>
    </main>
</div>

<!-- <script>
    // Value from Laravel controller
    const clockInTime = @json($clockInTime);

    function formatTime(seconds) {
        const hrs = String(Math.floor(seconds / 3600)).padStart(2, '0');
        const mins = String(Math.floor((seconds % 3600) / 60)).padStart(2, '0');
        const secs = String(seconds % 60).padStart(2, '0');
        return `${hrs}:${mins}:${secs}`;
    }

    function startTimerFrom(secondsElapsed) {
        let elapsed = secondsElapsed;
        document.getElementById('work-timer').textContent = formatTime(elapsed);
        setInterval(() => {
            elapsed++;
            document.getElementById('work-timer').textContent = formatTime(elapsed);
        }, 1000); 
    }

    // Run only if user has clocked in and not clocked out
    document.addEventListener('DOMContentLoaded', () => {
        if (clockInTime) {
            const clockIn = new Date(clockInTime);
            const now = new Date();
            const secondsElapsed = Math.floor((now - clockIn) / 1000);
            startTimerFrom(secondsElapsed);
        }
    });  
     
</script> -->  


<script>
    const clockInTime = @json($clockInTime);
    let timerInterval = null;
    let elapsed = 0;

    function formatTime(seconds) {
        const hrs = String(Math.floor(seconds / 3600)).padStart(2, '0');
        const mins = String(Math.floor((seconds % 3600) / 60)).padStart(2, '0');
        const secs = String(seconds % 60).padStart(2, '0');
        return `${hrs}:${mins}:${secs}`;
    }

    function startTimerFrom(secondsElapsed) {
        elapsed = secondsElapsed;
        document.getElementById('work-timer').textContent = formatTime(elapsed);

        if (timerInterval) clearInterval(timerInterval);

        timerInterval = setInterval(() => {
            elapsed++;
            document.getElementById('work-timer').textContent = formatTime(elapsed);
        }, 1000);
    }

    function pauseTimer() {
        if (timerInterval) {
            clearInterval(timerInterval);
            timerInterval = null;
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        if (clockInTime) {
            const clockIn = new Date(clockInTime);
            const now = new Date();
            const secondsElapsed = Math.floor((now - clockIn) / 1000);
            startTimerFrom(secondsElapsed);
        }

        // Handle Break form submission
        const breakForm = document.getElementById('breakForm');
        if (breakForm) {
            breakForm.addEventListener('submit', function (e) {
                pauseTimer(); // Pause the timer before submitting
            });
        }
    });
</script>

@endsection
