<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('password'); // Password field for login
            $table->string('phone')->nullable();
            $table->string('position')->nullable();
            $table->foreignId('department_id') // 💡 Use foreignId() instead of unsignedBigInteger()
                  ->nullable()
                  ->constrained('departments')
                  ->nullOnDelete(); // This ensures onDelete('set null')
            $table->decimal('salary', 10, 2)->nullable();
            $table->date('hired_at')->nullable();
            $table->string('profile_picture')->nullable();
            $table->foreignId('user_id')
            ->constrained('users')
            ->onDelete('cascade'); 

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
