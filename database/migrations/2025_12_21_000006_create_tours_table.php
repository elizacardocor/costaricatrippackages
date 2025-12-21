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
        Schema::create('tours', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tour_operator_id')->constrained('tour_operators')->onDelete('cascade');
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->decimal('commission_percentage', 5, 2)->default(0);
            $table->decimal('duration_hours', 5, 2)->nullable();
            $table->time('start_time')->nullable();
            $table->integer('max_capacity')->default(0);
            $table->enum('difficulty', ['easy', 'moderate', 'hard'])->default('moderate');
            $table->json('languages')->nullable();
            $table->json('includes')->nullable();
            $table->json('itinerary')->nullable();
            $table->decimal('rating', 3, 2)->default(0)->nullable();
            $table->enum('status', ['active', 'inactive', 'suspended'])->default('active');
            $table->timestamps();
            $table->softDeletes();

            // Indices
            $table->index('tour_operator_id');
            $table->index('slug');
            $table->index('name');
            $table->index('status');
            $table->index('difficulty');
            $table->index('rating');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tours');
    }
};
