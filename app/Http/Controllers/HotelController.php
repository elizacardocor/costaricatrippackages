<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\SlugRedirect;
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
        $hotel = Hotel::where('slug', $slug)->first();

        if (!$hotel) {
            $redirect = SlugRedirect::where('service_type', 'hotel')
                ->where('old_slug', $slug)
                ->latest('id')
                ->first();

            if ($redirect) {
                $redirectHotel = Hotel::find($redirect->service_id);
                if ($redirectHotel) {
                    return redirect(UrlHelper::hotelUrl($redirectHotel, app()->getLocale()), 301);
                }
            }

            abort(404);
        }

        $canonicalUrl = UrlHelper::hotelUrl($hotel, app()->getLocale());
        
        return view('hotels.show', [
            'hotel' => $hotel,
            'canonicalUrl' => $canonicalUrl,
        ]);
    }
}
