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
        // Add to roles table
        if (!Schema::hasColumn('roles', 'guard_name')) {
            Schema::table('roles', function (Blueprint $table) {
                $table->string('guard_name')->default('web')->after('name');
            });
        }

        // Add to permissions table
        if (!Schema::hasColumn('permissions', 'guard_name')) {
            Schema::table('permissions', function (Blueprint $table) {
                $table->string('guard_name')->default('web')->after('name');
            });
        }

        // Add to model_has_roles table (if exists)
        if (Schema::hasTable('model_has_roles') && !Schema::hasColumn('model_has_roles', 'guard_name')) {
            Schema::table('model_has_roles', function (Blueprint $table) {
                $table->string('guard_name')->default('web')->after('role_id');
            });
        }

        // Add to model_has_permissions table (if exists)
        if (Schema::hasTable('model_has_permissions') && !Schema::hasColumn('model_has_permissions', 'guard_name')) {
            Schema::table('model_has_permissions', function (Blueprint $table) {
                $table->string('guard_name')->default('web')->after('permission_id');
            });
        }

        // Add to role_has_permissions table (if exists)
        if (Schema::hasTable('role_has_permissions') && !Schema::hasColumn('role_has_permissions', 'guard_name')) {
            Schema::table('role_has_permissions', function (Blueprint $table) {
                $table->string('guard_name')->default('web')->after('permission_id');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        // Don't remove columns in down() to prevent data loss
        // This is a safety migration - we don't want to roll it back
    }
};