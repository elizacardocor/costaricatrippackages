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
        Schema::create('pricing_groups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pricing_id')->constrained('pricing')->onDelete('cascade');
            $table->integer('group_size')->unsigned(); // 2, 3, 4, etc.
            $table->decimal('price_per_person', 10, 2);
            $table->boolean('active')->default(true);
            $table->timestamps();

            // Índices
            $table->index('pricing_id');
            $table->index('group_size');
            $table->index('active');
            // Garantizar que no hay duplicados de tamaño de grupo por pricing
            $table->unique(['pricing_id', 'group_size']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pricing_groups');
    }
};
