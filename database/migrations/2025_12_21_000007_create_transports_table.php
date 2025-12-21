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
        Schema::create('transports', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->decimal('commission_percentage', 5, 2)->default(0);
            $table->enum('vehicle_type', ['car', 'van', 'bus', 'minivan', 'motorcycle', 'bicycle', 'other'])->default('car');
            $table->integer('capacity')->default(0);
            $table->decimal('rating', 3, 2)->default(0)->nullable();
            $table->enum('status', ['active', 'inactive', 'suspended'])->default('active');
            $table->timestamps();
            $table->softDeletes();

            // Indices
            $table->index('slug');
            $table->index('name');
            $table->index('status');
            $table->index('vehicle_type');
            $table->index('rating');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transports');
    }
};
