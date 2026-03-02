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

        // Landing pages (Tours, Hotels, Transport listings)
        $landingPages = [
            ['es' => '/es/tours', 'en' => '/en/tours', 'changefreq' => 'weekly', 'priority' => '0.9'],
            ['es' => '/es/hoteles', 'en' => '/en/hotels', 'changefreq' => 'weekly', 'priority' => '0.9'],
            ['es' => '/es/transporte', 'en' => '/en/transport', 'changefreq' => 'weekly', 'priority' => '0.9'],
            ['es' => '/es/contacto', 'en' => '/en/contact', 'changefreq' => 'monthly', 'priority' => '0.8'],
        ];

        foreach ($landingPages as $page) {
            $urls[] = [
                'loc' => url($page['es']),
                'lastmod' => now()->toAtomString(),
                'changefreq' => $page['changefreq'],
                'priority' => $page['priority']
            ];
            $urls[] = [
                'loc' => url($page['en']),
                'lastmod' => now()->toAtomString(),
                'changefreq' => $page['changefreq'],
                'priority' => $page['priority']
            ];
        }

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

        // Generar XML con header de caché
        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">' . "\n";

        foreach ($urls as $url) {
            $xml .= '  <url>' . "\n";
            $xml .= '    <loc>' . htmlspecialchars($url['loc'], ENT_XML1) . '</loc>' . "\n";
            $xml .= '    <lastmod>' . $url['lastmod'] . '</lastmod>' . "\n";
            $xml .= '    <changefreq>' . $url['changefreq'] . '</changefreq>' . "\n";
            $xml .= '    <priority>' . $url['priority'] . '</priority>' . "\n";
            $xml .= '  </url>' . "\n";
        }

        $xml .= '</urlset>';

        // Cache sitemap por 24 horas
        return Response::make($xml, 200, [
            'Content-Type' => 'application/xml; charset=UTF-8',
            'Cache-Control' => 'public, max-age=86400',
            'X-Generated' => now()->toAtomString()
        ]);
    }
}
