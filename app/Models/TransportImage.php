<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransportImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'transport_id',
        'url',
        'alt_text',
        'order',
    ];

    public function transport()
    {
        return $this->belongsTo(Transport::class);
    }
}
