<?php

namespace App\Helpers;

use App\Models\Hotel;
use App\Models\Tour;

class UrlHelper
{
    /**
     * Translate URL path from Spanish to English
     */
    public static function translateUrlToEnglish($path)
    {
        // Remove leading slash if present
        $path = '/' . ltrim($path, '/');
        
        // Replace Spanish segments with English segments FIRST
        $path = str_replace('/provincia/', '/province/', $path);
        $path = str_replace('/destino/', '/destination/', $path);
        $path = str_replace('/contacto', '/contact', $path);
        
        // Replace /es/ with /en/
        $path = preg_replace('~^/es/~', '/en/', $path);
        
        // Replace /es$ with /en (for root-level language paths)
        $path = preg_replace('~^/es$~', '/en', $path);
        
        return $path;
    }

    /**
     * Translate URL path from English to Spanish
     */
    public static function translateUrlToSpanish($path)
    {
        // Remove leading slash if present
        $path = '/' . ltrim($path, '/');
        
        // Replace English segments with Spanish segments FIRST
        $path = str_replace('/province/', '/provincia/', $path);
        $path = str_replace('/destination/', '/destino/', $path);
        $path = str_replace('/contact', '/contacto', $path);
        
        // Replace /en/ with /es/
        $path = preg_replace('~^/en/~', '/es/', $path);
        
        // Replace /en$ with /es (for root-level language paths)
        $path = preg_replace('~^/en$~', '/es', $path);
        
        return $path;
    }

    /**
     * Generate canonical URL for a tour
     */
    public static function tourUrl(Tour $tour, $locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        $destination = $tour->destinations->first();
        
        if (!$destination) {
            return route('tour.show.es', ['slug' => $tour->slug]);
        }

        $province = $destination->province;
        $routeName = $locale === 'es' ? 'tour.show.complex.es' : 'tour.show.complex.en';
        
        return route($routeName, [
            'province' => $province->slug,
            'destination' => $destination->slug,
            'tour' => $tour->slug,
        ]);
    }

    /**
     * Generate canonical URL for a hotel
     */
    public static function hotelUrl(Hotel $hotel, $locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        $destination = $hotel->destinations->first();
        
        if (!$destination) {
            return route('hotel.show.es', ['slug' => $hotel->slug]);
        }

        $province = $destination->province;
        $routeName = $locale === 'es' ? 'hotel.show.complex.es' : 'hotel.show.complex.en';
        
        return route($routeName, [
            'province' => $province->slug,
            'destination' => $destination->slug,
            'hotel' => $hotel->slug,
        ]);
    }
}
