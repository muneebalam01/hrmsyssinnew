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
    $today = now()->toDateString();

    $attendance = Attendance::firstOrCreate(
        ['user_id' => Auth::id(), 'date' => $today]
    );

    if (!$attendance->clock_in) {
        $attendance->clock_in = now();
        $attendance->save();
    }

    session(['clockInTime' => $attendance->clock_in->toIso8601String()]);

    return back()->with('success', 'Clocked in successfully');
}


public function clockOut()
{
    $today = now()->toDateString();
    $attendance = Attendance::where('user_id', Auth::id())->where('date', $today)->first();

    if ($attendance && !$attendance->clock_out) {
        $attendance->update(['clock_out' => now()]);
        session()->forget('clockInTime');
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

// In your controller
public function index()
{
    $user = auth()->user();
    $isClockedIn = $user->attendances()->whereNull('clock_out')->exists();
    $isClockedOut = !$isClockedIn;

    $latestAttendance = $user->attendances()->latest()->first();

    $clockInTime = session('clockInTime') ?? ($isClockedIn ? optional($latestAttendance->clock_in)->toIso8601String() : null);

    return view('attendance.index', [
        'isClockedIn' => $isClockedIn,
        'isClockedOut' => $isClockedOut,
        'clockInTime' => $clockInTime,
        'attendances' => $user->attendances()->orderBy('date', 'desc')->with('breaks')->paginate(10),
    ]);
}


}
