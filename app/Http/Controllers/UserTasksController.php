<?php 
namespace App\Http\Controllers;
use App\Models\EmployeeDailyTask;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserTasksController extends Controller
{
    public function index()
    {
        
       $user = Auth::user(); // using default 'web' guard

        if (!$user || $user->role_id !== 9) {
            return redirect()->route('login')->with('error', 'Unauthorized access.');
        }

        $users_tasks = EmployeeDailyTask::with('employee')
                            ->where('user_id', $user->id) // match logged-in user
                            ->latest()
                            ->get();

        return view('user_tasks.index', compact('users_tasks'));

}


public function show($id)
    {
        $employee = Auth::guard('employee')->user();

        if (!$employee) {
            return redirect()->route('login')->with('error', 'Please log in as employee.');
        }

        $task = EmployeeDailyTask::with('employee')
                    ->where('id', $id)
                    ->where('employee_id', $employee->id) // Security check
                    ->firstOrFail();

        return view('user_tasks.show', compact('task'));
    }

}