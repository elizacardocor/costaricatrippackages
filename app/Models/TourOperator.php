<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

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

    protected static function booted()
    {
        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->name);
            }
        });
    }

    public function tours()
    {
        return $this->hasMany(Tour::class);
    }

    public function destinations()
    {
        return $this->belongsToMany(Destination::class, 'destination_tour_operator');
    }
}
