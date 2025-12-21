<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $transports = [
            [
                'name' => 'Taxi Express',
                'slug' => 'taxi-express',
                'vehicle_type' => 'car',
                'description' => 'Servicio de taxi express disponible 24/7 para traslados punto a punto. Conductores certificados y vehículos limpios.',
                'commission_percentage' => 12,
                'capacity' => 4,
                'rating' => 4.5,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Private Shuttle',
                'slug' => 'private-shuttle',
                'vehicle_type' => 'van',
                'description' => 'Servicio de transporte privado en minivanes cómodas. Ideal para grupos pequeños y medianos con paradas personalizadas.',
                'commission_percentage' => 15,
                'capacity' => 8,
                'rating' => 4.7,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Beach Bus Tours',
                'slug' => 'beach-bus-tours',
                'vehicle_type' => 'bus',
                'description' => 'Tours en autobús hacia playas con aire acondicionado, wifi y guía turístico. Salidas diarias a principales destinos de playa.',
                'commission_percentage' => 10,
                'capacity' => 45,
                'rating' => 4.4,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Motorcycle Rentals',
                'slug' => 'motorcycle-rentals',
                'vehicle_type' => 'motorcycle',
                'description' => 'Renta de motos modernas para explorar Costa Rica con libertad. Incluye casco, seguro básico y mapas.',
                'commission_percentage' => 12,
                'capacity' => 1,
                'rating' => 4.6,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Bike Adventures',
                'slug' => 'bike-adventures',
                'vehicle_type' => 'bicycle',
                'description' => 'Tours en bicicleta por rutas escénicas. Bicicletas de montaña de calidad, cascos de seguridad y guías experimentados.',
                'commission_percentage' => 15,
                'capacity' => 1,
                'rating' => 4.8,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('transports')->insert($transports);
    }
}
