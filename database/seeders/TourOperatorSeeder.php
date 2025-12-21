<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TourOperatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $operators = [
            [
                'name' => 'Aventuras Costarricenses',
                'slug' => 'aventuras-costarricenses',
                'description' => 'Operador especializado en tours de aventura y expediciones en la naturaleza de Costa Rica. 20 años de experiencia.',
                'phone' => '+506 2234-5678',
                'email' => 'info@aventurascostarricenses.cr',
                'website' => 'www.aventurascostarricenses.cr',
                'rating' => 4.8,
                'commission_percentage' => 18,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Eco Tours CR',
                'slug' => 'eco-tours-cr',
                'description' => 'Tours ecológicos y sostenibles enfocados en la conservación y educación ambiental de Costa Rica.',
                'phone' => '+506 2443-8901',
                'email' => 'booking@ecotourscr.com',
                'website' => 'www.ecotourscr.com',
                'rating' => 4.9,
                'commission_percentage' => 15,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Costa Rica Adventures',
                'slug' => 'costa-rica-adventures',
                'description' => 'Compañía internacional de tours con presencia en múltiples destinos de Costa Rica. Tours completos y personalizados.',
                'phone' => '+506 2654-3210',
                'email' => 'contact@costaricaadventures.com',
                'website' => 'www.costaricaadventures.com',
                'rating' => 4.7,
                'commission_percentage' => 20,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Wild Nature Tours',
                'slug' => 'wild-nature-tours',
                'description' => 'Especializados en tours de vida silvestre y observación de fauna en hábitats naturales.',
                'phone' => '+506 2356-7890',
                'email' => 'reserve@wildnaturetours.cr',
                'website' => 'www.wildnaturetours.cr',
                'rating' => 4.6,
                'commission_percentage' => 17,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Tropic Explorer',
                'slug' => 'tropic-explorer',
                'description' => 'Tours tropicales exploradores con enfoque en selva, cascadas y experiencias auténticas de Costa Rica.',
                'phone' => '+506 2765-4321',
                'email' => 'info@tropicexplorer.cr',
                'website' => 'www.tropicexplorer.cr',
                'rating' => 4.5,
                'commission_percentage' => 16,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('tour_operators')->insert($operators);
    }
}
