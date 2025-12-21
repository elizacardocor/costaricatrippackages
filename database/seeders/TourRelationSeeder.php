<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tour;
use App\Models\Destination;
use App\Models\TourImage;
use App\Models\TourInclude;
use App\Models\TourReview;

class TourRelationSeeder extends Seeder
{
    public function run(): void
    {
        // Get tours
        $tours = Tour::all();
        $destinations = Destination::where('name', 'like', '%Arenal%')->get();

        foreach ($tours as $tour) {
            // Attach to destinations (skip if already attached)
            if ($destinations->isNotEmpty()) {
                $destinationId = $destinations->first()->id;
                if (!$tour->destinations()->where('destination_id', $destinationId)->exists()) {
                    $tour->destinations()->attach($destinationId);
                }
            }

            // Add images
            $images = [
                ['url' => 'https://images.unsplash.com/photo-1488646953014-85cb44e25828?w=800&h=600&fit=crop', 'alt' => $tour->name . ' action'],
                ['url' => 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=800&h=600&fit=crop', 'alt' => $tour->name . ' nature'],
                ['url' => 'https://images.unsplash.com/photo-1493246507139-91e8fad9978e?w=800&h=600&fit=crop', 'alt' => $tour->name . ' landscape'],
            ];

            foreach ($images as $index => $image) {
                TourImage::create([
                    'tour_id' => $tour->id,
                    'url' => $image['url'],
                    'alt_text' => $image['alt'],
                    'order' => $index,
                ]);
            }

            // Add includes
            $includes = [
                'Guía profesional',
                'Transporte',
                'Almuerzo',
                'Agua embotellada',
                'Equipo necesario',
                'Seguro de viaje',
            ];

            foreach ($includes as $includeName) {
                TourInclude::create([
                    'tour_id' => $tour->id,
                    'name' => $includeName,
                    'icon' => 'bi-check-circle',
                ]);
            }

            // Add reviews
            $reviews = [
                ['name' => 'Sarah Wilson', 'rating' => 5, 'comment' => 'Best tour ever, guide was knowledgeable and fun. Highly recommend!'],
                ['name' => 'Carlos Mendez', 'rating' => 5, 'comment' => 'Una experiencia que no olvidaré nunca. Guía excelente y muy profesional.'],
                ['name' => 'Lisa Anderson', 'rating' => 4, 'comment' => 'Great experience and wonderful views. Would recommend to anyone!'],
            ];

            foreach ($reviews as $review) {
                TourReview::create([
                    'tour_id' => $tour->id,
                    'user_name' => $review['name'],
                    'rating' => $review['rating'],
                    'comment' => $review['comment'],
                ]);
            }
        }
    }
}
