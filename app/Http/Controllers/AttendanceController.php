<?php

namespace App\Http\Controllers;
use App\Models\BreakTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Attendance;
use Carbon\Carbon;
// use App\Models\Attendance;
class AttendanceController extends Controller
{
//     public function index()
//     {
//        // $attendances = Auth::user()->attendances()->latest()->paginate(10);
//        // return view('attendance.index', compact('attendances'));
//    $user = Auth::user();
//     $attendances = $user->attendances()->latest()->paginate(10);

//     $todayAttendance = $user->attendances()
//         ->whereDate('date', now()->toDateString())
//         ->whereNotNull('clock_in')
//         ->whereNull('clock_out')
//         ->first();

//     $clockInTime = $todayAttendance ? Carbon::parse($todayAttendance->clock_in)->toIso8601String() : null;

//     return view('attendance.index', compact('attendances', 'clockInTime'));

//     }

    public function clockIn()
    {
        // $today = now()->toDateString();
        // $attendance = Attendance::firstOrCreate(
        //     ['user_id' => Auth::id(), 'date' => $today],
        //     ['clock_in' => now()]
        // );

        // return back()->with('success', 'Clocked in successfully');

        $today = now()->toDateString();
    $attendance = Attendance::firstOrCreate(
        ['user_id' => Auth::id(), 'date' => $today]
    );

    if (!$attendance->clock_in) {
        $attendance->clock_in = now();
        $attendance->save();
    }

    return back()->with('success', 'Clocked in successfully');
    }

    public function clockOut()
    {
        $today = now()->toDateString();
        $attendance = Attendance::where('user_id', Auth::id())->where('date', $today)->first();

        if ($attendance && !$attendance->clock_out) {
            $attendance->update(['clock_out' => now()]);
            return back()->with('success', 'Clocked out successfully');
        }

        return back()->with('error', 'Clock out failed or already done');
    }


public function break(Request $request)
{
    $user = Auth::user();
    $today = Carbon::now()->toDateString();

    $attendance = Attendance::firstOrCreate([
        'user_id' => $user->id,
        'date' => $today,
    ]);

    // Check if there's an open break
    $openBreak = BreakTime::where('attendance_id', $attendance->id)
        ->whereNull('break_end')
        ->first();

    if ($openBreak) {
        // End the break
        $openBreak->break_end = now();
        $openBreak->save();

        session(['onBreak' => false]);
        return back()->with('success', 'Break ended.');
    } else {
        // Start a new break
        BreakTime::create([
            'attendance_id' => $attendance->id,
            'break_start' => now(),
        ]);

        session(['onBreak' => true]);
        return back()->with('success', 'Break started.');
    }
}
public function index()
{
    $userId = auth()->id();
    $today = \Carbon\Carbon::today()->toDateString();

    // Get today's latest attendance record
    $latestAttendance = Attendance::where('user_id', $userId)
        ->whereDate('date', $today)
        ->latest()
        ->with('breaks')
        ->first();

    $isClockedIn = $latestAttendance && $latestAttendance->clock_in;
    $isClockedOut = $latestAttendance && $latestAttendance->clock_out;

    return view('attendance.index', [
        'attendances' => Attendance::with('breaks')
            ->where('user_id', $userId)
            ->orderByDesc('date')
            ->paginate(10),
        'clockInTime' => $latestAttendance?->clock_in,
        'onBreak' => session('onBreak', false),
        'isClockedIn' => $isClockedIn,
        'isClockedOut' => $isClockedOut,
    ]);
}


}
