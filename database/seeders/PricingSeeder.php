<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RateType;
use App\Models\Hotel;
use App\Models\Tour;
use App\Models\Transport;
use Illuminate\Support\Facades\DB;

class PricingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rateTypes = RateType::all();
        
        if ($rateTypes->isEmpty()) {
            $this->command->error('No rate types found. Please run RateTypeSeeder first.');
            return;
        }

        // Mapeo de rate types por slug
        $rateTypeMap = $rateTypes->keyBy('slug');

        // Definir precios base por temporada (multiplicadores)
        $seasonMultipliers = [
            'low-season' => 1.0,      // Precio base
            'high-season' => 1.4,     // +40%
            'peak-season' => 1.8,     // +80%
            'weekend' => 1.15,        // +15%
        ];

        $this->command->info('Starting pricing seeder...');
        
        // ========== HOTELES ==========
        $hotels = Hotel::all();
        $this->command->info("Processing {$hotels->count()} hotels...");
        
        foreach ($hotels as $hotel) {
            // Precio base estimado según estrellas
            $basePrice = match($hotel->stars) {
                5 => 200,
                4 => 120,
                3 => 80,
                2 => 50,
                default => 70,
            };

            foreach ($rateTypes as $rateType) {
                $multiplier = $seasonMultipliers[$rateType->slug] ?? 1.0;
                $price = round($basePrice * $multiplier, 2);

                DB::table('pricing')->updateOrInsert(
                    [
                        'service_type' => 'App\\Models\\Hotel',
                        'service_id' => $hotel->id,
                        'rate_type_id' => $rateType->id,
                    ],
                    [
                        'pricing_model' => 'per_day',
                        'price' => $price,
                        'active' => true,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]
                );
            }
            
            $this->command->info("✓ Hotel: {$hotel->name}");
        }

        // ========== TOURS ==========
        $tours = Tour::all();
        $this->command->info("Processing {$tours->count()} tours...");
        
        foreach ($tours as $tour) {
            // Precio base según duración y dificultad
            $basePriceByDuration = ($tour->duration_hours ?? 4) * 20; // $20 por hora
            
            $difficultyMultiplier = match($tour->difficulty) {
                'hard' => 1.3,
                'moderate' => 1.1,
                'easy' => 1.0,
                default => 1.0,
            };

            $basePrice = round($basePriceByDuration * $difficultyMultiplier, 2);
            $basePrice = max($basePrice, 50); // Mínimo $50

            foreach ($rateTypes as $rateType) {
                $multiplier = $seasonMultipliers[$rateType->slug] ?? 1.0;
                $price = round($basePrice * $multiplier, 2);

                DB::table('pricing')->updateOrInsert(
                    [
                        'service_type' => 'App\\Models\\Tour',
                        'service_id' => $tour->id,
                        'rate_type_id' => $rateType->id,
                    ],
                    [
                        'pricing_model' => 'per_person',
                        'price' => $price,
                        'active' => true,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]
                );
            }
            
            $this->command->info("✓ Tour: {$tour->name}");
        }

        // ========== TRANSPORTS ==========
        $transports = Transport::all();
        $this->command->info("Processing {$transports->count()} transports...");
        
        foreach ($transports as $transport) {
            // Precio base según capacidad
            $basePrice = ($transport->capacity_per_vehicle ?? 4) * 15; // $15 por persona de capacidad
            $basePrice = max($basePrice, 40); // Mínimo $40

            foreach ($rateTypes as $rateType) {
                $multiplier = $seasonMultipliers[$rateType->slug] ?? 1.0;
                $price = round($basePrice * $multiplier, 2);

                DB::table('pricing')->updateOrInsert(
                    [
                        'service_type' => 'App\\Models\\Transport',
                        'service_id' => $transport->id,
                        'rate_type_id' => $rateType->id,
                    ],
                    [
                        'pricing_model' => 'fixed',
                        'price' => $price,
                        'active' => true,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]
                );
            }
            
            $this->command->info("✓ Transport: {$transport->name}");
        }

        $totalPrices = DB::table('pricing')->count();
        $this->command->info("✅ Pricing seeder completed! Total prices: {$totalPrices}");
    }
}
