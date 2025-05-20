<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory; // ✅ Correct

use Illuminate\Database\Eloquent\Model;

class EmployeeTaskDocument extends Model
{

     use HasFactory;

    protected $fillable = [
        'employee_daily_task_id',
        'file_path',
    ];
    public function task()
{
    return $this->belongsTo(EmployeeDailyTask::class, 'employee_daily_task_id');
}

}
