<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ProvinceSeeder::class,
            RateTypeSeeder::class,
            DestinationSeeder::class,
            TourOperatorSeeder::class,
            HotelSeeder::class,
            TourSeeder::class,
            TransportSeeder::class,
            HotelRelationSeeder::class,
            TourRelationSeeder::class,
        ]);
    }
}
