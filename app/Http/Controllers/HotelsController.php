<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Destination;
use Illuminate\Http\Request;

class HotelsController extends Controller
{
    /**
     * Show hotels listing page filtered by destination
     */
    public function index(Request $request)
    {
        $query = Hotel::query();
        $destination = null;
        
        // Filter by destination if provided
        if ($request->has('destination_id')) {
            $destinationId = $request->get('destination_id');
            $destination = Destination::find($destinationId);
            $query->whereHas('destinations', function($q) use ($destinationId) {
                $q->where('destination_id', $destinationId);
            });
        }
        
        $hotels = $query->paginate(12);
        
        return view('hotels.index', [
            'hotels' => $hotels,
            'destination' => $destination,
        ]);
    }
}
