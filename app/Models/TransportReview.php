<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransportReview extends Model
{
    use HasFactory;

    protected $fillable = [
        'transport_id',
        'user_name',
        'rating',
        'comment',
    ];

    protected $casts = [
        'rating' => 'decimal:2',
        'created_at' => 'datetime',
    ];

    public function transport()
    {
        return $this->belongsTo(Transport::class);
    }
}
