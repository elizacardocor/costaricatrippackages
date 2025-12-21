<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HotelSeeder extends Seeder
{
    public function run(): void
    {
        $hotels = [
            [
                'name' => 'La Fortuna Resort',
                'slug' => 'la-fortuna-resort',
                'description' => 'Resort de lujo frente a la laguna de Arenal con vistas al volcán. Piscina con aguas termales naturales, spa completo y excelente cocina.',
                'commission_percentage' => 15,
                'rating' => 4.8,
                'stars' => 5,
                'rooms_count' => 85,
                'phone' => '+506 2479-1234',
                'email' => 'reservations@lafortunaresort.cr',
                'website' => 'www.lafortunaresort.cr',
                'checkin_time' => '14:00',
                'checkout_time' => '11:00',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Arenal Springs Resort',
                'slug' => 'arenal-springs-resort',
                'description' => 'Resort boutique con spas y aguas termales naturales. Ubicado en la base del volcán Arenal con senderos propios.',
                'commission_percentage' => 15,
                'rating' => 4.7,
                'stars' => 5,
                'rooms_count' => 72,
                'phone' => '+506 2479-5000',
                'email' => 'info@arenalspringsresort.com',
                'website' => 'www.arenalspringsresort.com',
                'checkin_time' => '14:00',
                'checkout_time' => '11:00',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Volcano Lodge',
                'slug' => 'volcano-lodge',
                'description' => 'Lodge ecológico ubicado en la zona privada con vista al Volcán Arenal. Arquitectura en armonía con la naturaleza.',
                'commission_percentage' => 15,
                'rating' => 4.9,
                'stars' => 5,
                'rooms_count' => 90,
                'phone' => '+506 2479-6000',
                'email' => 'reservas@volcanolodge.cr',
                'website' => 'www.volcanolodge.cr',
                'checkin_time' => '14:00',
                'checkout_time' => '11:00',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Arenal Boutique',
                'slug' => 'arenal-boutique',
                'description' => 'Pequeño hotel boutique exclusivo con decoración artística. Abierto todo el año con piscina climatizada.',
                'commission_percentage' => 15,
                'rating' => 4.6,
                'stars' => 4,
                'rooms_count' => 35,
                'phone' => '+506 2479-7200',
                'email' => 'contact@arenalboutique.cr',
                'website' => 'www.arenalboutique.cr',
                'checkin_time' => '14:00',
                'checkout_time' => '11:00',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Arenal Eco Lodge',
                'slug' => 'arenal-eco-lodge',
                'description' => 'Lodge ecológico sustentable con habitaciones rodeadas de naturaleza. Tours y actividades de aventura incluidos.',
                'commission_percentage' => 15,
                'rating' => 4.5,
                'stars' => 4,
                'rooms_count' => 45,
                'phone' => '+506 2479-8500',
                'email' => 'bookings@arenalecolodge.cr',
                'website' => 'www.arenalecolodge.cr',
                'checkin_time' => '14:00',
                'checkout_time' => '11:00',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('hotels')->insert($hotels);
    }
}
