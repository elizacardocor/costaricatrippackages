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
        // Agregar user_id a hotels
        Schema::table('hotels', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->index('user_id');
        });

        // Agregar user_id a tours
        Schema::table('tours', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->index('user_id');
        });

        // Agregar user_id a transports
        Schema::table('transports', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hotels', function (Blueprint $table) {
            $table->dropForeignIdFor('users');
            $table->dropIndex(['user_id']);
        });

        Schema::table('tours', function (Blueprint $table) {
            $table->dropForeignIdFor('users');
            $table->dropIndex(['user_id']);
        });

        Schema::table('transports', function (Blueprint $table) {
            $table->dropForeignIdFor('users');
            $table->dropIndex(['user_id']);
        });
    }
};
