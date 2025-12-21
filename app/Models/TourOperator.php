<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TourOperator extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'phone',
        'email',
        'website',
        'rating',
        'commission_percentage',
        'status',
    ];

    public function tours()
    {
        return $this->hasMany(Tour::class);
    }

    public function destinations()
    {
        return $this->belongsToMany(Destination::class, 'destination_tour_operator');
    }
}
