<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory;

    protected $fillable = [
        'province_id',
        'name',
        'slug',
        'description',
        'image_url',
        'latitude',
        'longitude',
    ];

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function hotels()
    {
        return $this->belongsToMany(Hotel::class, 'destination_hotel');
    }

    public function tours()
    {
        return $this->belongsToMany(Tour::class, 'destination_tour');
    }

    public function transports()
    {
        return $this->belongsToMany(Transport::class, 'destination_transport');
    }

    public function tourOperators()
    {
        return $this->belongsToMany(TourOperator::class, 'destination_tour_operator');
    }
}
