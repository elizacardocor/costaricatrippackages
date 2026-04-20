<?php

namespace Database\Seeders;

use App\Models\PricingGroup;
use App\Models\Pricing;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PricingGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener algunos precios existentes para asociarles grupos
        $pricings = Pricing::where('pricing_model', 'per_person')
            ->orWhere('pricing_model', 'fixed')
            ->limit(5)
            ->get();

        foreach ($pricings as $pricing) {
            // Crear ejemplos de precios por grupo para cada pricing
            PricingGroup::updateOrCreate(
                ['pricing_id' => $pricing->id, 'group_size' => 2],
                ['price_per_person' => $pricing->price * 0.85, 'active' => true]
            );

            PricingGroup::updateOrCreate(
                ['pricing_id' => $pricing->id, 'group_size' => 3],
                ['price_per_person' => $pricing->price * 0.75, 'active' => true]
            );

            PricingGroup::updateOrCreate(
                ['pricing_id' => $pricing->id, 'group_size' => 4],
                ['price_per_person' => $pricing->price * 0.70, 'active' => true]
            );

            PricingGroup::updateOrCreate(
                ['pricing_id' => $pricing->id, 'group_size' => 5],
                ['price_per_person' => $pricing->price * 0.65, 'active' => true]
            );

            PricingGroup::updateOrCreate(
                ['pricing_id' => $pricing->id, 'group_size' => 6],
                ['price_per_person' => $pricing->price * 0.60, 'active' => true]
            );
        }

        $this->command->info('Pricing groups seeder completed!');
    }
}
