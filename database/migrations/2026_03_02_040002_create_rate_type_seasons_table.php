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
        Schema::create('rate_type_seasons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rate_type_id')->constrained('rate_types')->onDelete('cascade');
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('year');
            $table->text('description')->nullable(); // Ej: "Navidad y Año Nuevo", "Semana Santa"
            $table->timestamps();
            
            // Índices para búsquedas rápidas
            $table->index(['rate_type_id', 'start_date', 'end_date']);
            $table->index('year');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rate_type_seasons');
    }
};
