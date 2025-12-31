<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tour extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'tour_operator_id',
        'name',
        'slug',
        'description',
        'commission_percentage',
        'duration_hours',
        'start_time',
        'max_capacity',
        'difficulty',
        'languages',
        'itinerary',
        'rating',
        'status',
        'user_id',
    ];

    protected $casts = [
        'languages' => 'json',
        'itinerary' => 'json',
    ];

    public function tourOperator()
    {
        return $this->belongsTo(TourOperator::class);
    }

    public function destinations()
    {
        return $this->belongsToMany(Destination::class, 'destination_tour');
    }

    public function tourImages()
    {
        return $this->hasMany(TourImage::class);
    }

    // Alias for views
    public function images()
    {
        return $this->tourImages();
    }

    public function tourIncludes()
    {
        return $this->hasMany(TourInclude::class);
    }

    // Alias for views
    public function includes()
    {
        return $this->tourIncludes();
    }

    /**
     * Override getAttribute to prioritize the relationship over the attribute
     */
    public function getAttribute($key)
    {
        // If asking for 'includes', return the relationship instead of the attribute
        if ($key === 'includes') {
            return $this->tourIncludes();
        }
        return parent::getAttribute($key);
    }

    public function tourReviews()
    {
        return $this->hasMany(TourReview::class);
    }

    // Alias for views
    public function reviews()
    {
        return $this->tourReviews();
    }

    public function pricing()
    {
        return $this->morphMany(Pricing::class, 'service');
    }
}
