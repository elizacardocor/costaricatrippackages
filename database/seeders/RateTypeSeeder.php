<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RateTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rateTypes = [
            [
                'name' => 'Temporada Baja',
                'slug' => 'low-season',
                'color' => '#FF6B6B',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Temporada Alta',
                'slug' => 'high-season',
                'color' => '#4ECDC4',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Temporada Pico',
                'slug' => 'peak-season',
                'color' => '#FFE66D',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Fin de Semana',
                'slug' => 'weekend',
                'color' => '#95E1D3',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('rate_types')->insert($rateTypes);
    }
}
