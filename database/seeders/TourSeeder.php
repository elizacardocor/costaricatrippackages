<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TourSeeder extends Seeder
{
    public function run(): void
    {
        $tours = [
            [
                'tour_operator_id' => 1,
                'name' => 'Arenal Adventure',
                'slug' => 'arenal-adventure',
                'description' => 'Aventura completa en el Arenal: senderismo en el volcán, tirolesa y baños termales naturales.',
                'commission_percentage' => 15,
                'duration_hours' => 8.0,
                'start_time' => '08:00',
                'max_capacity' => 12,
                'difficulty' => 'moderate',
                'languages' => json_encode(['es', 'en', 'de']),
                'includes' => json_encode(['transportación', 'guía profesional', 'equipo de seguridad', 'comidas']),
                'itinerary' => json_encode(['Partida a las 8am', 'Caminata volcánica 3 horas', 'Almuerzo buffet', 'Tirolesa', 'Baños termales', 'Regreso 5pm']),
                'rating' => 4.8,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tour_operator_id' => 3,
                'name' => 'Rainforest Expedition',
                'slug' => 'rainforest-expedition',
                'description' => 'Expedición por la selva tropical con avistamiento de vida silvestre, aves y plantas exóticas.',
                'commission_percentage' => 15,
                'duration_hours' => 6.0,
                'start_time' => '09:00',
                'max_capacity' => 15,
                'difficulty' => 'easy',
                'languages' => json_encode(['es', 'en']),
                'includes' => json_encode(['transportación', 'guía biólogo', 'binoculares', 'agua']),
                'itinerary' => json_encode(['Salida a las 9am', 'Caminata de 4 horas', 'Observación de fauna', 'Regreso 3pm']),
                'rating' => 4.9,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tour_operator_id' => 2,
                'name' => 'Nighttime Wildlife Tour',
                'slug' => 'nighttime-wildlife',
                'description' => 'Tour nocturno para observar animales nocturnos y escuchar los sonidos únicos de la selva.',
                'commission_percentage' => 15,
                'duration_hours' => 4.0,
                'start_time' => '19:00',
                'max_capacity' => 8,
                'difficulty' => 'easy',
                'languages' => json_encode(['es', 'en', 'fr']),
                'includes' => json_encode(['lámpara frontal', 'guía nocturno', 'transportación']),
                'itinerary' => json_encode(['Salida a las 7pm', 'Caminata nocturna', 'Observación de fauna nocturna', 'Regreso 11pm']),
                'rating' => 4.7,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tour_operator_id' => 1,
                'name' => 'Coffee & Chocolate Tour',
                'slug' => 'coffee-chocolate-tour',
                'description' => 'Visita a fincas locales de café y chocolate, aprende el proceso de producción y disfruta de degustaciones.',
                'commission_percentage' => 15,
                'duration_hours' => 5.0,
                'start_time' => '10:00',
                'max_capacity' => 20,
                'difficulty' => 'easy',
                'languages' => json_encode(['es', 'en', 'fr']),
                'includes' => json_encode(['transportación', 'guía', 'visita a fincas', 'degustaciones', 'refrigerios']),
                'itinerary' => json_encode(['Salida a las 10am', 'Visita finca de café', 'Proceso de tostión', 'Almuerzo', 'Visita chocolatería', 'Degustación', 'Regreso 3pm']),
                'rating' => 4.6,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('tours')->insert($tours);
    }
}
