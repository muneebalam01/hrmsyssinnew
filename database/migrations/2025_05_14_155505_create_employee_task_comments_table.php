<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employee_task_comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_daily_task_id');

            // Polymorphic fields
            $table->unsignedBigInteger('commented_by_id');
            $table->string('commented_by_type'); // 'App\Models\User' or 'App\Models\Employee'

            $table->text('comment');
            $table->timestamps();

            $table->foreign('employee_daily_task_id')
                  ->references('id')
                  ->on('employee_daily_tasks')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employee_task_comments');
    }
};
