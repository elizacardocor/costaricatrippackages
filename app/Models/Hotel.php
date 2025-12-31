<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hotel extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'commission_percentage',
        'rating',
        'stars',
        'rooms_count',
        'phone',
        'email',
        'website',
        'address',
        'checkin_time',
        'checkout_time',
        'status',
        'user_id',
    ];

    public function destinations()
    {
        return $this->belongsToMany(Destination::class, 'destination_hotel');
    }

    public function hotelImages()
    {
        return $this->hasMany(HotelImage::class);
    }

    // Alias for views
    public function images()
    {
        return $this->hotelImages();
    }

    public function amenities()
    {
        return $this->belongsToMany(Amenity::class, 'hotel_amenities');
    }

    public function hotelReviews()
    {
        return $this->hasMany(HotelReview::class);
    }

    // Alias for views
    public function reviews()
    {
        return $this->hotelReviews();
    }

    public function pricing()
    {
        return $this->morphMany(Pricing::class, 'service');
    }
}
