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
        // Evitar error si la columna ya fue creada manualmente;
        // sólo añadimos si no existe aún.
        if (!Schema::hasColumn('hotels', 'user_id')) {
            Schema::table('hotels', function (Blueprint $table) {
                // Añadimos user_id nullable y FK a users(id). Null on delete por seguridad.
                $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hotels', function (Blueprint $table) {
            // dropConstrainedForeignId requiere Laravel 9+. Alternativa segura:
            if (Schema::hasColumn('hotels', 'user_id')) {
                $table->dropConstrainedForeignId('user_id');
            }
        });
    }
};
