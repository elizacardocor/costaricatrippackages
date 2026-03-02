<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RateTypeSeason extends Model
{
    use HasFactory;

    protected $fillable = [
        'rate_type_id',
        'start_date',
        'end_date',
        'year',
        'description',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'year' => 'integer',
    ];

    /**
     * Relación con RateType
     */
    public function rateType()
    {
        return $this->belongsTo(RateType::class);
    }

    /**
     * Verificar si una fecha está dentro de este rango
     */
    public function includesDate($date)
    {
        $checkDate = \Carbon\Carbon::parse($date);
        return $checkDate->between($this->start_date, $this->end_date);
    }

    /**
     * Obtener el rate_type que aplica para una fecha específica
     */
    public static function getRateTypeForDate($date)
    {
        $checkDate = \Carbon\Carbon::parse($date);
        
        $season = self::where('start_date', '<=', $checkDate)
            ->where('end_date', '>=', $checkDate)
            ->first();

        return $season ? $season->rateType : null;
    }
}
