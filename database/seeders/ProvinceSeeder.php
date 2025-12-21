<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvinceSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('provinces')->insert([
            [
                'name' => 'San José',
                'slug' => 'san-jose',
                'description' => 'La capital de Costa Rica, centro político y cultural del país',
                'image_url' => 'https://via.placeholder.com/800x600?text=San+Jose',
                'latitude' => 9.9281,
                'longitude' => -84.0907,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Alajuela',
                'slug' => 'alajuela',
                'description' => 'Provincia al norte de San José, conocida por sus montañas y plantaciones',
                'image_url' => 'https://via.placeholder.com/800x600?text=Alajuela',
                'latitude' => 10.3161,
                'longitude' => -84.4239,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Cartago',
                'slug' => 'cartago',
                'description' => 'Provincia histórica en la cordillera central, con volcanes y sitios arqueológicos',
                'image_url' => 'https://via.placeholder.com/800x600?text=Cartago',
                'latitude' => 9.8565,
                'longitude' => -83.9181,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Heredia',
                'slug' => 'heredia',
                'description' => 'Provincia norteña con cultivos de café y naturaleza exuberante',
                'image_url' => 'https://via.placeholder.com/800x600?text=Heredia',
                'latitude' => 10.2302,
                'longitude' => -84.1303,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Guanacaste',
                'slug' => 'guanacaste',
                'description' => 'Provincia del noroeste, conocida por playas, parques nacionales y naturaleza salvaje',
                'image_url' => 'https://via.placeholder.com/800x600?text=Guanacaste',
                'latitude' => 10.3812,
                'longitude' => -85.5278,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Puntarenas',
                'slug' => 'puntarenas',
                'description' => 'Provincia costera del Pacífico con playas paradisiacas y vida marina vibrante',
                'image_url' => 'https://via.placeholder.com/800x600?text=Puntarenas',
                'latitude' => 9.9789,
                'longitude' => -84.8133,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Limón',
                'slug' => 'limon',
                'description' => 'Provincia caribeña con arrecifes de coral, jungla tropical y vida silvestre',
                'image_url' => 'https://via.placeholder.com/800x600?text=Limon',
                'latitude' => 10.0024,
                'longitude' => -83.0342,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
