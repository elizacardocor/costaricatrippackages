<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pricing extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_type',
        'service_id',
        'rate_type_id',
        'pricing_model',
        'price',
        'min_hours',
        'min_km',
        'max_km',
        'min_persons',
        'start_date',
        'end_date',
        'active',
    ];

    protected $casts = [
        'service_type' => 'string',
        'pricing_model' => 'string',
        'active' => 'boolean',
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function rateType()
    {
        return $this->belongsTo(RateType::class);
    }

    public function service()
    {
        return $this->morphTo();
    }
}
