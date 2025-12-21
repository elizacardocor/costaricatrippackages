<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DestinationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get province IDs
        $provinceIds = DB::table('provinces')->pluck('id', 'slug')->toArray();

        $destinations = [
            // Guanacaste destinations
            [
                'name' => 'Arenal',
                'slug' => 'arenal',
                'description' => 'Volcán Arenal activo rodeado de aguas termales naturales, jungla exuberante y hermosos lagos. Uno de los destinos más visitados de Costa Rica.',
                'image_url' => 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=800',
                'province_id' => $provinceIds['guanacaste'] ?? 5,
                'latitude' => 10.4627,
                'longitude' => -84.7017,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Tamarindo',
                'slug' => 'tamarindo',
                'description' => 'Playa de arena blanca en la Península de Nicoya, famosa por el surf, vida nocturna y resorts de lujo. Destino internacional de clase mundial.',
                'image_url' => 'https://images.unsplash.com/photo-1511632765486-a01980e01a18?w=800',
                'province_id' => $provinceIds['guanacaste'] ?? 5,
                'latitude' => 10.3033,
                'longitude' => -85.8395,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Papagayo',
                'slug' => 'papagayo',
                'description' => 'Playas protegidas con aguas cristalinas, arena blanca y clima seco. Perfecto para resorts de lujo y vacaciones familiares.',
                'image_url' => 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=800',
                'province_id' => $provinceIds['guanacaste'] ?? 5,
                'latitude' => 10.5000,
                'longitude' => -85.7000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Liberia',
                'slug' => 'liberia',
                'description' => 'Capital de Guanacaste, ciudad colonial con arquitectura tradicional y puerta de entrada a las playas del Pacífico Norte.',
                'image_url' => 'https://images.unsplash.com/photo-1488646953014-85cb44e25828?w=800',
                'province_id' => $provinceIds['guanacaste'] ?? 5,
                'latitude' => 10.6337,
                'longitude' => -85.4380,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Puntarenas destinations
            [
                'name' => 'Manuel Antonio',
                'slug' => 'manuel-antonio',
                'description' => 'Parque Nacional con playas de arena blanca rodeadas de selva tropical. Hogar de monos, perezosos y abundante vida silvestre.',
                'image_url' => 'https://images.unsplash.com/photo-1559827260-dc66d52bef19?w=800',
                'province_id' => $provinceIds['puntarenas'] ?? 6,
                'latitude' => 9.3869,
                'longitude' => -84.1419,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Uvita',
                'slug' => 'uvita',
                'description' => 'Playa del Pacífico Sur con la famosa Cola de Ballena, arrecifes de coral y comunidad de viajeros. Ideal para buceo y yoga.',
                'image_url' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=800',
                'province_id' => $provinceIds['puntarenas'] ?? 6,
                'latitude' => 9.1638,
                'longitude' => -83.7369,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dominical',
                'slug' => 'dominical',
                'description' => 'Pueblo costero relajado con excelente surf, ambiente hippie bohemio y acceso a cascadas y senderos en la selva.',
                'image_url' => 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=800',
                'province_id' => $provinceIds['puntarenas'] ?? 6,
                'latitude' => 9.2381,
                'longitude' => -83.6403,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Jaco',
                'slug' => 'jaco',
                'description' => 'Primera playa importante del Pacífico Central, conocida por el surf, resorts y acceso a la región del Pacífico Sur.',
                'image_url' => 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=800',
                'province_id' => $provinceIds['puntarenas'] ?? 6,
                'latitude' => 9.6160,
                'longitude' => -84.6370,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Limón destinations
            [
                'name' => 'Cahuita',
                'slug' => 'cahuita',
                'description' => 'Pueblo caribeño con arrecife de coral, parque nacional marino y ambiente afrocaribeño auténtico. Excelente para buceo y snorkel.',
                'image_url' => 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=800',
                'province_id' => $provinceIds['limon'] ?? 7,
                'latitude' => 9.7386,
                'longitude' => -82.8477,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Tortuguero',
                'slug' => 'tortuguero',
                'description' => 'Reserva marina nacional accesible solo por bote, famosa por el anidamiento de tortugas verdes. Jungla virgen y canales de agua.',
                'image_url' => 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=800',
                'province_id' => $provinceIds['limon'] ?? 7,
                'latitude' => 10.5962,
                'longitude' => -83.5092,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Puerto Limón',
                'slug' => 'puerto-limon',
                'description' => 'Puerto principal del Caribe, ciudad costera con historia, museos y puerta de entrada a las atracciones del Caribe Sur.',
                'image_url' => 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=800',
                'province_id' => $provinceIds['limon'] ?? 7,
                'latitude' => 10.0027,
                'longitude' => -83.0341,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Alajuela/Heredia destinations
            [
                'name' => 'La Fortuna',
                'slug' => 'la-fortuna',
                'description' => 'Pueblo base para explorar el Volcán Arenal, aguas termales naturales, cascadas y actividades de aventura en la región norte.',
                'image_url' => 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=800',
                'province_id' => $provinceIds['alajuela'] ?? 2,
                'latitude' => 10.4688,
                'longitude' => -84.6456,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // San José destinations
            [
                'name' => 'Valle Central',
                'slug' => 'valle-central',
                'description' => 'Región metropolitana con San José, Alajuela y Cartago. Corazón cultural, comercial y gastronómico de Costa Rica.',
                'image_url' => 'https://images.unsplash.com/photo-1488646953014-85cb44e25828?w=800',
                'province_id' => $provinceIds['san-jose'] ?? 1,
                'latitude' => 9.7489,
                'longitude' => -84.0808,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Monteverde',
                'slug' => 'monteverde',
                'description' => 'Reserva de Nube en tierras altas con bosques húmedos, aves exóticas y senderos colgantes. Destino ecológico de renombre mundial.',
                'image_url' => 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=800',
                'province_id' => $provinceIds['puntarenas'] ?? 6,
                'latitude' => 10.3008,
                'longitude' => -84.8133,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('destinations')->insert($destinations);
    }
}
