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
        Schema::create('employee_task_documents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_daily_task_id');
            $table->string('file_path');
            $table->timestamps();
            $table->foreign('employee_daily_task_id')
        ->references('id')
        ->on('employee_daily_tasks')
        ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_task_documents');
    }
};
