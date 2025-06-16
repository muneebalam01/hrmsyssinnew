<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Attendance;
use Carbon\Carbon;
class AttendanceController extends Controller
{
    public function index()
    {
       // $attendances = Auth::user()->attendances()->latest()->paginate(10);
       // return view('attendance.index', compact('attendances'));
   $user = Auth::user();
    $attendances = $user->attendances()->latest()->paginate(10);

    $todayAttendance = $user->attendances()
        ->whereDate('date', now()->toDateString())
        ->whereNotNull('clock_in')
        ->whereNull('clock_out')
        ->first();

    $clockInTime = $todayAttendance ? Carbon::parse($todayAttendance->clock_in)->toIso8601String() : null;

    return view('attendance.index', compact('attendances', 'clockInTime'));

    }

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
    // Placeholder logic
    return back()->with('success', 'Break started (demo action)');
}

}
