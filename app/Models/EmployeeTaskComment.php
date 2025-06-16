<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmployeeTaskComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_daily_task_id',
        'commented_by_id',
        'commented_by_type',
        'comment',
        'document_path'
    ];

    /**
     * Relationship to the task.
     */
    public function task()
    {
        return $this->belongsTo(EmployeeDailyTask::class, 'employee_daily_task_id');
    }

    /**
     * Polymorphic relationship to either User (admin) or Employee.
     */
    public function commentedBy()
    {
        return $this->morphTo();
    }
}
