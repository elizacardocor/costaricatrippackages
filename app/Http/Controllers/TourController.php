<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use App\Helpers\UrlHelper;
use Illuminate\Http\Request;

class TourController extends Controller
{
    /**
     * Show tours listing page
     */
    public function index(Request $request)
    {
        $query = Tour::query();
        
        // Filter by destination if provided
        if ($request->has('destination_id')) {
            $destinationId = $request->get('destination_id');
            $query->whereHas('destinations', function($q) use ($destinationId) {
                $q->where('destination_id', $destinationId);
            });
        }
        
        $tours = $query->get();
        
        return view('tours.index', [
            'tours' => $tours,
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
        $tour = Tour::where('slug', $slug)->firstOrFail();
        $canonicalUrl = UrlHelper::tourUrl($tour, app()->getLocale());
        
        return view('tours.show', [
            'tour' => $tour,
            'canonicalUrl' => $canonicalUrl,
        ]);
    }
}
