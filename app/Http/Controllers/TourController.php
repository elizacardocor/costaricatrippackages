<?php

namespace App\Http\Controllers;

use App\Models\SlugRedirect;
use App\Models\Tour;
use App\Models\RateTypeSeason;
use App\Helpers\UrlHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TourController extends Controller
{
    /**
     * Show tours listing page
     */
    public function index(Request $request)
    {
        $baseQuery = Tour::with([
            'destinations.province',
            'tourImages' => function ($query) {
                $query->orderBy('order');
            },
            'pricing',
        ]);

        $query = clone $baseQuery;
        
        // Filter by destination if provided
        if ($request->has('destination_id')) {
            $destinationId = $request->get('destination_id');
            $query->whereHas('destinations', function($q) use ($destinationId) {
                $q->where('destination_id', $destinationId);
            });
        }
        
        $tours = $query->get();
        $allTours = (clone $baseQuery)->get();

        $currentRateType = RateTypeSeason::getRateTypeForDate(now());

        $transformTour = function (Tour $tour) use ($currentRateType) {
            $currentPricing = null;

            if ($currentRateType) {
                $currentPricing = $tour->pricing
                    ->where('rate_type_id', $currentRateType->id)
                    ->where('active', true)
                    ->first();
            }

            if (!$currentPricing) {
                $currentPricing = $tour->pricing
                    ->where('active', true)
                    ->sortBy('price')
                    ->first();
            }

            $mainImage = $tour->tourImages->first();

            $imageJpg = $mainImage
                ? asset('storage/' . ltrim($mainImage->url, '/'))
                : asset('images/default-tour.jpg');
            $imageWebp = $mainImage && str_ends_with($mainImage->url, '.jpg')
                ? asset('storage/' . str_replace('.jpg', '.webp', ltrim($mainImage->url, '/')))
                : null;
            $altText = $mainImage->alt_text ?? $tour->name;

            return [
                'id' => $tour->id,
                'title' => $tour->name,
                'slug' => $tour->slug,
                'category' => $tour->difficulty ?: 'Tour',
                'price' => $currentPricing ? (float) $currentPricing->price : null,
                'duration' => $tour->duration_hours ? $tour->duration_hours . ' horas' : null,
                'people' => $tour->max_capacity ? ('Hasta ' . $tour->max_capacity) : null,
                'description' => $tour->description ? Str::limit(strip_tags($tour->description), 160) : '',
                'image_jpg' => $imageJpg,
                'image_webp' => $imageWebp,
                'alt_text' => $altText,
                'destinations' => $tour->destinations->pluck('id')->toArray(),
                'url' => UrlHelper::tourUrl($tour, app()->getLocale()),
                'badge' => $currentRateType ? $currentRateType->name : null,
            ];
        };

        $allToursData = $allTours->map($transformTour)->values();
        $filteredToursData = $tours->map($transformTour)->values();
        
        return view('tours.index', [
            'tours' => $tours,
            'allToursData' => $allToursData,
            'filteredToursData' => $filteredToursData,
        ]);
    }

    /**
     * Show tour detail page with complex URL structure
     */
    public function showComplex($province, $destination, $tour)
    {
        return $this->show($tour);
    }

    /**
     * Show tour detail page from database
     */
    public function show($slug)
    {
        $tour = Tour::where('slug', $slug)->first();

        if (!$tour) {
            $redirect = SlugRedirect::where('service_type', 'tour')
                ->where('old_slug', $slug)
                ->latest('id')
                ->first();

            if ($redirect) {
                $redirectTour = Tour::find($redirect->service_id);
                if ($redirectTour) {
                    return redirect(UrlHelper::tourUrl($redirectTour, app()->getLocale()), 301);
                }
            }

            abort(404);
        }

        $canonicalUrl = UrlHelper::tourUrl($tour, app()->getLocale());
        
        return view('tours.show', [
            'tour' => $tour,
            'canonicalUrl' => $canonicalUrl,
        ]);
    }
}
