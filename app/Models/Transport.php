<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transport extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'commission_percentage',
        'vehicle_type',
        'capacity',
        'rating',
        'status',
        'user_id',
    ];

    public function destinations()
    {
        return $this->belongsToMany(Destination::class, 'destination_transport');
    }

    public function transportImages()
    {
        return $this->hasMany(TransportImage::class);
    }

    public function transportReviews()
    {
        return $this->hasMany(TransportReview::class);
    }

    public function pricing()
    {
        return $this->morphMany(Pricing::class, 'service');
    }
}
