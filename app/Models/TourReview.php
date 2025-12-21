<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourReview extends Model
{
    use HasFactory;

    protected $fillable = [
        'tour_id',
        'user_name',
        'rating',
        'comment',
    ];

    protected $casts = [
        'rating' => 'decimal:2',
        'created_at' => 'datetime',
    ];

    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }
}
