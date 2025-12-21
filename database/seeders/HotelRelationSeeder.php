<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Hotel;
use App\Models\Destination;
use App\Models\HotelImage;
use App\Models\HotelAmenity;
use App\Models\HotelReview;

class HotelRelationSeeder extends Seeder
{
    public function run(): void
    {
        // Get hotels
        $hotels = Hotel::all();
        $destinations = Destination::where('name', 'like', '%Arenal%')->get();

        foreach ($hotels as $index => $hotel) {
            // Attach to destinations (skip if already attached)
            if ($destinations->isNotEmpty()) {
                $destinationId = $destinations->first()->id;
                if (!$hotel->destinations()->where('destination_id', $destinationId)->exists()) {
                    $hotel->destinations()->attach($destinationId);
                }
            }

            // Add images
            $images = [
                ['url' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&h=600&fit=crop', 'alt' => $hotel->name . ' exterior'],
                ['url' => 'https://images.unsplash.com/photo-1571019614242-c5c5dee9f50b?w=800&h=600&fit=crop', 'alt' => $hotel->name . ' room'],
                ['url' => 'https://images.unsplash.com/photo-1559827260-dc66d52bef19?w=800&h=600&fit=crop', 'alt' => $hotel->name . ' pool'],
            ];

            foreach ($images as $index => $image) {
                HotelImage::create([
                    'hotel_id' => $hotel->id,
                    'url' => $image['url'],
                    'alt_text' => $image['alt'],
                    'order' => $index,
                ]);
            }

            // Add amenities
            $amenities = [
                'WiFi Gratis',
                'Piscina',
                'Spa',
                'Restaurante',
                'Bar',
                'Gym',
                'Aire Acondicionado',
                'Servicio a Habitación 24h',
            ];

            foreach ($amenities as $amenityName) {
                HotelAmenity::create([
                    'hotel_id' => $hotel->id,
                    'name' => $amenityName,
                    'icon' => 'bi-check-circle',
                ]);
            }

            // Add reviews
            $reviews = [
                ['name' => 'John Smith', 'rating' => 5, 'comment' => 'Amazing views and great service. Highly recommended!'],
                ['name' => 'María González', 'rating' => 4, 'comment' => 'Hermoso hotel con buena atención al detalle.'],
                ['name' => 'David Jones', 'rating' => 5, 'comment' => 'Perfect for a romantic getaway. Will return soon!'],
            ];

            foreach ($reviews as $review) {
                HotelReview::create([
                    'hotel_id' => $hotel->id,
                    'user_name' => $review['name'],
                    'rating' => $review['rating'],
                    'comment' => $review['comment'],
                ]);
            }
        }
    }
}
