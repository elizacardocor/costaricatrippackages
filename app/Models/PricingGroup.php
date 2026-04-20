<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PricingGroup extends Model
{
    use HasFactory;

    protected $table = 'pricing_groups';

    protected $fillable = [
        'pricing_id',
        'group_size',
        'price_per_person',
        'active',
    ];

    protected $casts = [
        'group_size' => 'integer',
        'price_per_person' => 'decimal:2',
        'active' => 'boolean',
    ];

    /**
     * Relación con Pricing
     */
    public function pricing()
    {
        return $this->belongsTo(Pricing::class);
    }
}
