<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

class AmenitiesFromHotelAmenitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Log::info('AmenitiesFromHotelAmenitiesSeeder: starting');

        if (!Schema::hasTable('amenities')) {
            Log::warning('AmenitiesFromHotelAmenitiesSeeder: table `amenities` does not exist, aborting seeder');
            return;
        }

        // Obtener nombres únicos desde hotel_amenities
        $rows = DB::table('hotel_amenities')
            ->select('name', 'icon')
            ->distinct()
            ->get();

        $now = now();

        foreach ($rows as $row) {
            // Insertar o ignorar si ya existe
            $amenityId = DB::table('amenities')->updateOrInsert(
                ['name' => $row->name],
                ['icon' => $row->icon, 'updated_at' => $now, 'created_at' => $now]
            );

            // Después de asegurar la amenity, actualizar hotel_amenities. Use name matching.
            $amenity = DB::table('amenities')->where('name', $row->name)->first();
            if ($amenity) {
                DB::table('hotel_amenities')
                    ->where('name', $row->name)
                    ->update(['amenity_id' => $amenity->id]);
            }
        }

        Log::info('AmenitiesFromHotelAmenitiesSeeder: finished');
    }
}
