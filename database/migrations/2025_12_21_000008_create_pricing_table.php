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
        Schema::create('pricing', function (Blueprint $table) {
            $table->id();
            $table->enum('service_type', ['hotel', 'tour', 'transport']);
            $table->unsignedBigInteger('service_id');
            $table->foreignId('rate_type_id')->constrained('rate_types')->onDelete('cascade');
            $table->enum('pricing_model', ['fixed', 'hourly', 'per_km', 'per_day', 'per_person'])->default('fixed');
            $table->decimal('price', 10, 2)->default(0);
            $table->decimal('min_hours', 5, 2)->nullable();
            $table->decimal('min_km', 8, 2)->nullable();
            $table->decimal('max_km', 8, 2)->nullable();
            $table->integer('min_persons')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps();

            // Indices
            $table->index(['service_type', 'service_id']);
            $table->index('rate_type_id');
            $table->index('pricing_model');
            $table->index(['start_date', 'end_date']);
            $table->index('active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pricing');
    }
};
