<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Tour;
use App\Models\Destination;
use App\Helpers\UrlHelper;
use Illuminate\Support\Facades\Response;

class SitemapController extends Controller
{
    /**
     * Generate XML sitemap for SEO
     */
    public function index()
    {
        // Recopilar todas las URLs canónicas
        $urls = [];

        // Home page (ambos idiomas)
        $urls[] = [
            'loc' => url('/es'),
            'lastmod' => now()->toAtomString(),
            'changefreq' => 'weekly',
            'priority' => '1.0'
        ];
        $urls[] = [
            'loc' => url('/en'),
            'lastmod' => now()->toAtomString(),
            'changefreq' => 'weekly',
            'priority' => '1.0'
        ];

        // Tours - URLs complejas
        $tours = Tour::with('destinations')->get();
        foreach ($tours as $tour) {
            $urls[] = [
                'loc' => url(UrlHelper::tourUrl($tour, 'es')),
                'lastmod' => $tour->updated_at->toAtomString(),
                'changefreq' => 'monthly',
                'priority' => '0.8'
            ];
            $urls[] = [
                'loc' => url(UrlHelper::tourUrl($tour, 'en')),
                'lastmod' => $tour->updated_at->toAtomString(),
                'changefreq' => 'monthly',
                'priority' => '0.8'
            ];
        }

        // Hotels - URLs complejas
        $hotels = Hotel::with('destinations')->get();
        foreach ($hotels as $hotel) {
            $urls[] = [
                'loc' => url(UrlHelper::hotelUrl($hotel, 'es')),
                'lastmod' => $hotel->updated_at->toAtomString(),
                'changefreq' => 'monthly',
                'priority' => '0.8'
            ];
            $urls[] = [
                'loc' => url(UrlHelper::hotelUrl($hotel, 'en')),
                'lastmod' => $hotel->updated_at->toAtomString(),
                'changefreq' => 'monthly',
                'priority' => '0.8'
            ];
        }

        // Destinations
        $destinations = Destination::with('province')->get();
        foreach ($destinations as $destination) {
            $urls[] = [
                'loc' => url("/es/destino/{$destination->slug}"),
                'lastmod' => $destination->updated_at->toAtomString(),
                'changefreq' => 'monthly',
                'priority' => '0.7'
            ];
            $urls[] = [
                'loc' => url("/en/destination/{$destination->slug}"),
                'lastmod' => $destination->updated_at->toAtomString(),
                'changefreq' => 'monthly',
                'priority' => '0.7'
            ];
        }

        // Generar XML
        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

        foreach ($urls as $url) {
            $xml .= '  <url>' . "\n";
            $xml .= '    <loc>' . htmlspecialchars($url['loc'], ENT_XML1) . '</loc>' . "\n";
            $xml .= '    <lastmod>' . $url['lastmod'] . '</lastmod>' . "\n";
            $xml .= '    <changefreq>' . $url['changefreq'] . '</changefreq>' . "\n";
            $xml .= '    <priority>' . $url['priority'] . '</priority>' . "\n";
            $xml .= '  </url>' . "\n";
        }

        $xml .= '</urlset>';

        return Response::make($xml, 200, [
            'Content-Type' => 'application/xml; charset=UTF-8'
        ]);
    }
}
