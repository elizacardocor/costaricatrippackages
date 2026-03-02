<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\RateType;
use App\Models\RateTypeSeason;
use Carbon\Carbon;

class RateTypeSeasonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener los rate types
        $lowSeason = RateType::where('slug', 'low-season')->first();
        $highSeason = RateType::where('slug', 'high-season')->first();
        $peakSeason = RateType::where('slug', 'peak-season')->first();
        $weekend = RateType::where('slug', 'weekend')->first();

        // Año actual y siguiente
        $currentYear = Carbon::now()->year;
        $nextYear = $currentYear + 1;

        $seasons = [];

        // ========== TEMPORADA BAJA ==========
        // Mayo - Noviembre
        $seasons[] = [
            'rate_type_id' => $lowSeason->id,
            'start_date' => "$currentYear-05-01",
            'end_date' => "$currentYear-11-30",
            'year' => $currentYear,
            'description' => 'Temporada baja - Mayo a Noviembre',
        ];

        $seasons[] = [
            'rate_type_id' => $lowSeason->id,
            'start_date' => "$nextYear-05-01",
            'end_date' => "$nextYear-11-30",
            'year' => $nextYear,
            'description' => 'Temporada baja - Mayo a Noviembre',
        ];

        // ========== TEMPORADA ALTA ==========
        // 16 enero - 30 abril del año actual (para cubrir inicio de año)
        $seasons[] = [
            'rate_type_id' => $highSeason->id,
            'start_date' => "$currentYear-01-16",
            'end_date' => "$currentYear-04-30",
            'year' => $currentYear,
            'description' => 'Temporada alta - Enero a Abril',
        ];
        
        // 1 - 20 diciembre
        $seasons[] = [
            'rate_type_id' => $highSeason->id,
            'start_date' => "$currentYear-12-01",
            'end_date' => "$currentYear-12-20",
            'year' => $currentYear,
            'description' => 'Temporada alta - Inicio diciembre',
        ];

        // 20 enero - 30 abril del próximo año
        $seasons[] = [
            'rate_type_id' => $highSeason->id,
            'start_date' => "$nextYear-01-20",
            'end_date' => "$nextYear-04-30",
            'year' => $nextYear,
            'description' => 'Temporada alta - Enero a Abril',
        ];

        // Para el próximo ciclo
        $seasons[] = [
            'rate_type_id' => $highSeason->id,
            'start_date' => "$nextYear-12-01",
            'end_date' => "$nextYear-12-20",
            'year' => $nextYear,
            'description' => 'Temporada alta - Inicio diciembre',
        ];

        // ========== TEMPORADA PICO ==========
        // 1 - 15 enero del año actual (fin de la temporada navideña anterior)
        $seasons[] = [
            'rate_type_id' => $peakSeason->id,
            'start_date' => "$currentYear-01-01",
            'end_date' => "$currentYear-01-15",
            'year' => $currentYear,
            'description' => 'Temporada pico - Año Nuevo',
        ];
        
        // 21 diciembre - 15 enero (Navidad y Año Nuevo)
        $seasons[] = [
            'rate_type_id' => $peakSeason->id,
            'start_date' => "$currentYear-12-21",
            'end_date' => "$nextYear-01-15",
            'year' => $currentYear,
            'description' => 'Temporada pico - Navidad y Año Nuevo',
        ];

        $seasons[] = [
            'rate_type_id' => $peakSeason->id,
            'start_date' => "$nextYear-12-21",
            'end_date' => ($nextYear + 1) . "-01-15",
            'year' => $nextYear,
            'description' => 'Temporada pico - Navidad y Año Nuevo',
        ];

        // ========== FIN DE SEMANA ==========
        // Nota: Fin de semana aplica TODO el año, pero tiene prioridad sobre temporada baja
        // Para simplificar, definimos que aplica todo el año
        $seasons[] = [
            'rate_type_id' => $weekend->id,
            'start_date' => "$currentYear-01-01",
            'end_date' => "$currentYear-12-31",
            'year' => $currentYear,
            'description' => 'Fin de semana - Sábados y domingos todo el año',
        ];

        $seasons[] = [
            'rate_type_id' => $weekend->id,
            'start_date' => "$nextYear-01-01",
            'end_date' => "$nextYear-12-31",
            'year' => $nextYear,
            'description' => 'Fin de semana - Sábados y domingos todo el año',
        ];

        // Insertar todos los registros
        foreach ($seasons as $season) {
            RateTypeSeason::create($season);
        }

        $this->command->info('✅ Rate type seasons seeded successfully!');
        $this->command->info("📅 Created " . count($seasons) . " season date ranges for years $currentYear-$nextYear");
    }
}
