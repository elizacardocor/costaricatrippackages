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
        // Añadir amenity_id sólo si no existe aún
        if (!Schema::hasColumn('hotel_amenities', 'amenity_id')) {
            Schema::table('hotel_amenities', function (Blueprint $table) {
                $table->foreignId('amenity_id')->nullable()->after('id')->constrained('amenities')->nullOnDelete();
                $table->index('amenity_id');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hotel_amenities', function (Blueprint $table) {
            if (Schema::hasColumn('hotel_amenities', 'amenity_id')) {
                $table->dropConstrainedForeignId('amenity_id');
            }
        });
    }
};
