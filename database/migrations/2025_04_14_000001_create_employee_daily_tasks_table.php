<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employee_daily_tasks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('assigned_by');
            $table->string('task_subject');
            $table->date('task_date');
            $table->text('task_description');
            $table->enum('priority', ['urgent', 'normal'])->default('normal');
            $table->enum('status', ['pending', 'in_progress', 'completed'])->default('pending');
            $table->timestamps();
            $table->foreign('employee_id')
                ->references('id')
                ->on('employees')
                ->onDelete('cascade'); 

            $table->foreign('assigned_by')
                ->references('id')->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_daily_tasks');
    }
};
