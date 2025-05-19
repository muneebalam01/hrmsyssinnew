<?php

namespace App\Http\Controllers;
use App\Models\EmployeeTaskComment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class EmployeeTaskCommentController extends Controller
{


    public function index($taskId)
{
    $comments = EmployeeTaskComment::where('employee_daily_task_id', $taskId)
        ->with('commentedBy')
        ->latest()
        ->get();

    return view('comments.index', compact('comments'));
}

 public function store(Request $request)
{
    // Your validation and logic
    $request->validate([
        'employee_daily_task_id' => 'required|exists:employee_daily_tasks,id',
        'comment' => 'required|string',
    ]);

    // $user = auth()->user(); // Ensure the user is authenticated
    // $employee = Auth::guard('employee')->user();
    // EmployeeTaskComment::create([
    //     'employee_daily_task_id' => $request->employee_daily_task_id,
    //     'commented_by_id' => $employee->id,
    //     'commented_by_type' =>get_class($employee),
    //     'comment' => $request->comment,
    // ]);

     if (Auth::guard('employee')->check()) {
        $user = Auth::guard('employee')->user();
        $userId = $user->id;
        $userType = get_class($user);
    } elseif (Auth::check()) {
        $user = Auth::user(); // default web guard (admin/superadmin)
        $userId = $user->id;
        $userType = get_class($user);
    } else {
        return redirect()->back()->with('error', 'Unauthorized');
    }

    EmployeeTaskComment::create([
        'employee_daily_task_id' => $request->employee_daily_task_id,
        'commented_by_id' => $userId,
        'commented_by_type' => $userType,
        'comment' => $request->comment,
    ]);

    return redirect()->route('employee-daily-tasks.show', $request->employee_daily_task_id)
                     ->with('success', 'Comment posted successfully!');
}

}
