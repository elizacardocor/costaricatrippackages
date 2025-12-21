<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Discount extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'code',
        'description',
        'discount_type',
        'min_items',
        'min_services',
        'min_total_price',
        'applicable_to',
        'discount_value',
        'max_discount',
        'start_date',
        'end_date',
        'is_active',
        'usage_limit',
        'usage_count',
        'per_user_limit',
    ];

    protected $casts = [
        'discount_type' => 'string',
        'applicable_to' => 'string',
        'is_active' => 'boolean',
        'start_date' => 'date',
        'end_date' => 'date',
        'discount_value' => 'decimal:2',
    ];
}
