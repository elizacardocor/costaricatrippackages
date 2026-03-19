@extends('layouts.master')

@section('title', app()->getLocale() === 'es' ? 'Hoteles en Costa Rica' : 'Hotels in Costa Rica')

@section('meta_description', __('hotels.listing_meta_description'))
@section('meta_keywords', 'hoteles Costa Rica, alojamiento, resorts, hospedajes, hoteles de lujo')
@section('og_title', __('hotels.listing_og_title', ['default' => __('hotels.listing_title')]))
@section('og_description', __('hotels.listing_og_description', ['default' => __('hotels.listing_meta_description')]))
@section('og_image', $hotels->first() && $hotels->first()->images->first() ? asset('storage/' . $hotels->first()->images->first()->url) : asset('images/og-hotels.jpg'))
@section('twitter_title', __('hotels.listing_og_title', ['default' => __('hotels.listing_title')]))
@section('twitter_description', __('hotels.listing_og_description', ['default' => __('hotels.listing_meta_description')]))
@section('twitter_image', $hotels->first() && $hotels->first()->images->first() ? asset('storage/' . $hotels->first()->images->first()->url) : asset('images/og-hotels.jpg'))
@section('canonical')
    <link rel="canonical" href="{{ url()->current() }}">
    <link rel="alternate" hreflang="es" href="{{ route('hotels.index.es') }}">
    <link rel="alternate" hreflang="en" href="{{ route('hotels.index.en') }}">
@endsection

@section('extra_scripts')
<!-- Schema.org JSON-LD - Hotels Collection -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "CollectionPage",
    "name": "{{ __('hotels.listing_title') }}",
    "description": "{{ __('hotels.listing_meta_description') }}",
    "url": "{{ url()->current() }}",
    "mainEntity": {
        "@type": "ItemList",
        "itemListElement": [
            @foreach($hotels as $index => $hotel)
            {
                "@type": "ListItem",
                "position": {{ $index + 1 }},
                "item": {
                    "@type": "Hotel",
                    "@id": "{{ url('/es/hotel/' . $hotel->slug) }}",
                    "name": "{{ addslashes($hotel->name) }}",
                    "description": "{{ addslashes(substr($hotel->description, 0, 160)) }}",
                    "image": "{{ $hotel->images->first()?->url ? asset('storage/' . $hotel->images->first()->url) : asset('images/default-hotel.jpg') }}",
                    "url": "{{ url('/es/hotel/' . $hotel->slug) }}",
                    "aggregateRating": {
                        "@type": "AggregateRating",
                        "ratingValue": "{{ $hotel->rating ?? 4.5 }}",
                        "reviewCount": "{{ $hotel->reviews?->count() ?? 0 }}"
                    }
                }
            }{{ $loop->last ? '' : ',' }}
            @endforeach
        ]
    }
}
</script>
@endsection

@section('content')
<div class="content-box">
    <!-- Header Section -->
    <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 3rem 2rem; text-align: center;">
        <div class="container">
            <h1 style="font-size: 2.5rem; font-weight: 700; margin-bottom: 1rem;">
                🏨 {{ app()->getLocale() === 'es' ? 'Hoteles en Costa Rica' : 'Hotels in Costa Rica' }}
            </h1>
            @if($destination)
                <p style="font-size: 1.2rem; opacity: 0.9;">
                    {{ app()->getLocale() === 'es' ? 'Hospedaje en' : 'Accommodation in' }} <strong>{{ $destination->name }}</strong>
                </p>
            @endif
            <p style="opacity: 0.9;">
                {{ $hotels->total() }} {{ app()->getLocale() === 'es' ? 'hoteles disponibles' : 'available hotels' }}
            </p>
        </div>
    </div>

    <!-- Hotels Grid -->
    <div class="container py-5">
        @if($hotels->count() > 0)
            <div class="row g-4">
                @foreach($hotels as $hotel)
                    <div class="col-md-6 col-lg-4">
                        <div class="card shadow-sm border-0" style="border-radius: 12px; overflow: hidden; transition: all 0.3s ease; height: 100%;"
                             onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 12px 24px rgba(0,0,0,0.15)'"
                             onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 8px rgba(0,0,0,0.1)'">
                            
                            <!-- Image -->
                            <div style="height: 220px; overflow: hidden; background: #f0f0f0; position: relative;">
                                @if($hotel->images->first())
                                    @php $imgUrl = $hotel->images->first()->url; $altText = $hotel->images->first()->alt_text ?? $hotel->name; @endphp
                                    <picture>
                                        <source type="image/webp" srcset="{{ asset('storage/' . str_replace('.jpg', '.webp', ltrim($imgUrl, '/'))) }}">
                                        <img src="{{ \Illuminate\Support\Str::startsWith($imgUrl, ['http://','https://','//']) ? $imgUrl : asset('storage/' . ltrim($imgUrl, '/')) }}"
                                             alt="{{ $altText }}"
                                             style="width: 100%; height: 100%; object-fit: cover;">
                                    </picture>
                                @else
                                    <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; color: #999;">
                                        <i class="bi bi-image" style="font-size: 3rem;"></i>
                                    </div>
                                @endif
                                <div style="position: absolute; top: 10px; right: 10px; background: rgba(102, 126, 234, 0.95); color: white; padding: 6px 12px; border-radius: 20px; font-size: 0.85rem; font-weight: 600;">
                                    ⭐ {{ $hotel->stars ?? 3 }}/5
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="card-body" style="padding: 1.5rem;">
                                <h5 class="card-title" style="font-weight: 700; color: #333; margin-bottom: 0.5rem;">
                                    {{ $hotel->name }}
                                </h5>
                                
                                <p style="color: #666; font-size: 0.9rem; margin-bottom: 1rem;">
                                    <i class="bi bi-geo-alt"></i> 
                                    {{ $hotel->destinations->first()?->name ?? 'Costa Rica' }}
                                </p>

                                <!-- Price -->
                                @php
                                    $minPrice = $hotel->pricing()->min('price') ?? 100;
                                @endphp
                                <div style="background: linear-gradient(135deg, #f8f9ff, #f0f1ff); padding: 1rem; border-radius: 8px; margin-bottom: 1rem; border-left: 4px solid #667eea;">
                                    <small style="color: #666;">{{ app()->getLocale() === 'es' ? 'Desde' : 'From' }}</small>
                                    <h6 style="color: #667eea; font-weight: 700; margin: 0;">
                                        ₡{{ number_format($minPrice, 0) }} <small style="font-size: 0.7rem; opacity: 0.8;">/{{ app()->getLocale() === 'es' ? 'noche' : 'night' }}</small>
                                    </h6>
                                </div>

                                <!-- Amenities -->
                                @if($hotel->amenities->count() > 0)
                                    <div style="margin-bottom: 1rem;">
                                        <small style="color: #666; display: block; margin-bottom: 0.5rem;">{{ app()->getLocale() === 'es' ? 'Amenidades' : 'Amenities' }}</small>
                                        <div style="display: flex; flex-wrap: wrap; gap: 0.5rem;">
                                            @foreach($hotel->amenities->take(3) as $amenity)
                                                <span style="background: #e8f0fe; color: #667eea; padding: 4px 10px; border-radius: 20px; font-size: 0.75rem; font-weight: 600;">
                                                    {{ $amenity->name }}
                                                </span>
                                            @endforeach
                                            @if($hotel->amenities->count() > 3)
                                                <span style="background: #e8f0fe; color: #667eea; padding: 4px 10px; border-radius: 20px; font-size: 0.75rem; font-weight: 600;">
                                                    +{{ $hotel->amenities->count() - 3 }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                @endif

                                <!-- View Details Button -->
                                @php
                                    $dest = $hotel->destinations->first();
                                    $detailUrl = route('hotel.show.complex.' . app()->getLocale(), [
                                        'province' => $dest?->province?->slug ?? 'costa-rica',
                                        'destination' => $dest?->slug ?? 'general',
                                        'hotel' => $hotel->slug,
                                    ]);
                                @endphp
                                <a href="{{ $detailUrl }}" 
                                   class="btn w-100" 
                                   style="background: linear-gradient(135deg, #667eea, #764ba2); color: white; font-weight: 600; border-radius: 8px; border: none;">
                                    {{ app()->getLocale() === 'es' ? 'Ver Detalles' : 'View Details' }}
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($hotels->hasPages())
                <div style="margin-top: 3rem; display: flex; justify-content: center;">
                    {{ $hotels->links() }}
                </div>
            @endif
        @else
            <div class="alert alert-info text-center" style="padding: 3rem; border-radius: 12px;">
                <i class="bi bi-info-circle" style="font-size: 2rem;"></i>
                <h4 style="margin-top: 1rem; margin-bottom: 0.5rem;">
                    {{ app()->getLocale() === 'es' ? 'No hay hoteles disponibles' : 'No hotels available' }}
                </h4>
                <p style="margin: 0; color: #666;">
                    {{ app()->getLocale() === 'es' ? 'Intenta otra búsqueda' : 'Try another search' }}
                </p>
            </div>
        @endif
    </div>

    <!-- CTA Section -->
    <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 4rem 2rem; text-align: center; margin-top: 4rem;">
        <div class="container">
            <h2 style="font-size: 2rem; font-weight: 700; margin-bottom: 1.5rem;">
                {{ app()->getLocale() === 'es' ? '¿No encontraste lo que buscas?' : "Didn't find what you're looking for?" }}
            </h2>
            <p style="font-size: 1.1rem; opacity: 0.9; margin-bottom: 2rem;">
                {{ app()->getLocale() === 'es' ? 'Registra tu hotel y únete a nuestra plataforma' : 'Register your hotel and join our platform' }}
            </p>
            <a href="{{ app()->getLocale() === 'es' ? '/es/registrar_servicio' : '/en/register_service' }}" 
               class="btn btn-light" 
               style="font-weight: 700; padding: 0.85rem 2rem; border-radius: 8px;">
                {{ app()->getLocale() === 'es' ? '➕ Agregar un Hotel' : '➕ Add a Hotel' }}
            </a>
        </div>
    </div>
</div><!-- End Content Box -->
@endsection
