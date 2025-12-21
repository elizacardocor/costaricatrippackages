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
        Schema::create('destination_tour_operator', function (Blueprint $table) {
            $table->foreignId('destination_id')->constrained('destinations')->onDelete('cascade');
            $table->foreignId('tour_operator_id')->constrained('tour_operators')->onDelete('cascade');
            $table->timestamps();

            // Composite primary key
            $table->primary(['destination_id', 'tour_operator_id']);

            // Indices
            $table->index('tour_operator_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('destination_tour_operator');
    }
};
