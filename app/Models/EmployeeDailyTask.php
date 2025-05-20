<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeDailyTask extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'assigned_by',
        'task_date',
        'task_subject',
        'task_description',
        'priority',
        'status',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
    public function comments()
{
    return $this->hasMany(EmployeeTaskComment::class, 'employee_daily_task_id');
}

 public function assignedBy()
    {
        return $this->belongsTo(User::class, 'assigned_by');
    }

    public function documents()
{
    return $this->hasMany(EmployeeTaskDocument::class);
}


}
