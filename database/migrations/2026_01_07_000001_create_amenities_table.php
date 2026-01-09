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
        // Crear sólo si no existe (evita errores si la tabla ya fue creada manualmente)
        if (!Schema::hasTable('amenities')) {
            Schema::create('amenities', function (Blueprint $table) {
                $table->id();
                $table->string('name')->unique();
                $table->string('icon')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('amenities');
    }
};
