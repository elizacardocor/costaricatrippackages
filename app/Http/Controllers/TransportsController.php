<?php

namespace App\Http\Controllers;

use App\Models\Transport;
use App\Models\Destination;
use Illuminate\Http\Request;

class TransportsController extends Controller
{
    /**
     * Show transports listing page filtered by destination
     */
    public function index(Request $request)
    {
        $query = Transport::query();
        $destination = null;
        
        // Filter by destination if provided
        if ($request->has('destination_id')) {
            $destinationId = $request->get('destination_id');
            $destination = Destination::find($destinationId);
            $query->whereHas('destinations', function($q) use ($destinationId) {
                $q->where('destination_id', $destinationId);
            });
        }
        
        $transports = $query->paginate(12);
        
        return view('transports.index', [
            'transports' => $transports,
            'destination' => $destination,
        ]);
    }
}
