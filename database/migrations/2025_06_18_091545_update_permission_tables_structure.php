<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Check and add columns to permissions table
        if (Schema::hasTable('permissions')) {
            if (!Schema::hasColumn('permissions', 'guard_name')) {
                Schema::table('permissions', function (Blueprint $table) {
                    $table->string('guard_name')->default('web')->after('name');
                });
            }
        }

        // Check and add columns to roles table
        if (Schema::hasTable('roles')) {
            if (!Schema::hasColumn('roles', 'guard_name')) {
                Schema::table('roles', function (Blueprint $table) {
                    $table->string('guard_name')->default('web')->after('name');
                });
            }
        }

        // Repeat for other permission tables if they exist
        $pivotTables = [
            'model_has_permissions',
            'model_has_roles',
            'role_has_permissions'
        ];

        foreach ($pivotTables as $table) {
            if (Schema::hasTable($table)) {
                if (!Schema::hasColumn($table, 'guard_name')) {
                    Schema::table($table, function (Blueprint $table) {
                        $table->string('guard_name')->default('web')->after('permission_id');
                    });
                }
            }
        }
    }

    public function down()
    {
        // We intentionally leave this empty to prevent data loss
        // This is a one-way migration to add columns
    }
};