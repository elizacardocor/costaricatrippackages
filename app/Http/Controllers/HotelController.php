<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Helpers\UrlHelper;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    /**
     * Show hotel detail page with complex URL structure
     */
    public function showComplex($province, $destination, $hotel)
    {
        return $this->show($hotel);
    }

    /**
     * Show hotel detail page from database
     */
    public function show($slug)
    {
        $hotel = Hotel::where('slug', $slug)->firstOrFail();
        $canonicalUrl = UrlHelper::hotelUrl($hotel, app()->getLocale());
        
        return view('hotels.show', [
            'hotel' => $hotel,
            'canonicalUrl' => $canonicalUrl,
        ]);
    }
}
