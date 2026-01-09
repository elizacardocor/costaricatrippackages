<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $tables = ['hotels', 'tours', 'transports'];

        foreach ($tables as $table) {
            if (!Schema::hasTable($table)) {
                continue;
            }

            // If column doesn't exist, add it with default 'pending'
            if (!Schema::hasColumn($table, 'status')) {
                Schema::table($table, function (Blueprint $t) {
                    $t->string('status')->default('pending');
                });
                continue;
            }

            // Ensure no NULL values remain
            DB::table($table)->whereNull('status')->update(['status' => 'pending']);

            // Use direct SQL to set NOT NULL and DEFAULT without requiring doctrine/dbal
            // MySQL syntax: MODIFY column
            $driver = DB::getDriverName();
            if ($driver === 'mysql') {
                DB::statement("ALTER TABLE {$table} MODIFY status VARCHAR(255) NOT NULL DEFAULT 'pending'");
            } else {
                // Fallback: use Schema to alter (may require doctrine/dbal in some setups)
                Schema::table($table, function (Blueprint $t) {
                    $t->string('status')->default('pending')->nullable(false);
                });
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $tables = ['hotels', 'tours', 'transports'];

        foreach ($tables as $table) {
            if (!Schema::hasTable($table) || !Schema::hasColumn($table, 'status')) {
                continue;
            }

            $driver = DB::getDriverName();
            if ($driver === 'mysql') {
                // Reset to nullable with no default
                DB::statement("ALTER TABLE {$table} MODIFY status VARCHAR(255) NULL DEFAULT NULL");
            } else {
                Schema::table($table, function (Blueprint $t) {
                    $t->string('status')->nullable()->default(null);
                });
            }
        }
    }
};
