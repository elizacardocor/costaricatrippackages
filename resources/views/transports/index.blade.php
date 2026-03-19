@extends('layouts.master')

@section('title', app()->getLocale() === 'es' ? 'Servicios de Transporte' : 'Transport Services')

@section('meta_description', __('transports.listing_meta_description') ?? 'Transporte en Costa Rica, traslados, shuttles, buses, privados')
@section('meta_keywords', 'transporte Costa Rica, traslados, shuttles, buses, privados, transfers')
@section('og_title', __('transports.listing_og_title', ['default' => __('transports.listing_title')]))
@section('og_description', __('transports.listing_og_description', ['default' => __('transports.listing_meta_description')]))
@section('og_image', $transports->first() && $transports->first()->transportImages->first() ? asset('storage/' . $transports->first()->transportImages->first()->url) : asset('images/og-transport.jpg'))
@section('twitter_title', __('transports.listing_og_title', ['default' => __('transports.listing_title')]))
@section('twitter_description', __('transports.listing_og_description', ['default' => __('transports.listing_meta_description')]))
@section('twitter_image', $transports->first() && $transports->first()->transportImages->first() ? asset('storage/' . $transports->first()->transportImages->first()->url) : asset('images/og-transport.jpg'))
@section('canonical')
    <link rel="canonical" href="{{ url()->current() }}">
    <link rel="alternate" hreflang="es" href="{{ route('transport.index.es') }}">
    <link rel="alternate" hreflang="en" href="{{ route('transport.index.en') }}">
@endsection

@section('extra_scripts')
<!-- Schema.org JSON-LD - Transports Collection -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "CollectionPage",
    "name": "{{ __('transports.listing_title') ?? 'Transporte en Costa Rica' }}",
    "description": "{{ __('transports.listing_meta_description') ?? 'Transporte en Costa Rica, traslados, shuttles, buses, privados' }}",
    "url": "{{ url()->current() }}",
    "mainEntity": {
        "@type": "ItemList",
        "itemListElement": [
            @foreach($transports as $index => $transport)
            {
                "@type": "ListItem",
                "position": {{ $index + 1 }},
                "item": {
                    "@type": "BusTrip",
                    "@id": "{{ url('/es/transport/' . $transport->slug) }}",
                    "name": "{{ addslashes($transport->name) }}",
                    "description": "{{ addslashes(substr($transport->description, 0, 160)) }}",
                    "image": "{{ $transport->transportImages->first()?->url ? asset('storage/' . $transport->transportImages->first()->url) : asset('images/default-transport.jpg') }}",
                    "url": "{{ url('/es/transport/' . $transport->slug) }}",
                    "aggregateRating": {
                        "@type": "AggregateRating",
                        "ratingValue": "{{ $transport->rating ?? 4.5 }}",
                        "reviewCount": "{{ $transport->transportReviews?->count() ?? 0 }}"
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
    <div style="background: linear-gradient(135deg, #FF9500 0%, #F57C00 100%); color: white; padding: 3rem 2rem; text-align: center;">
        <div class="container">
            <h1 style="font-size: 2.5rem; font-weight: 700; margin-bottom: 1rem;">
                🚐 {{ app()->getLocale() === 'es' ? 'Servicios de Transporte' : 'Transport Services' }}
            </h1>
            @if($destination)
                <p style="font-size: 1.2rem; opacity: 0.9;">
                    {{ app()->getLocale() === 'es' ? 'Transporte en' : 'Transport in' }} <strong>{{ $destination->name }}</strong>
                </p>
            @endif
            <p style="opacity: 0.9;">
                {{ $transports->total() }} {{ app()->getLocale() === 'es' ? 'servicios disponibles' : 'available services' }}
            </p>
        </div>
    </div>

    <!-- Transports Grid -->
    <div class="container py-5">
        @if($transports->count() > 0)
            <div class="row g-4">
                @foreach($transports as $transport)
                    <div class="col-md-6 col-lg-4">
                        <div class="card shadow-sm border-0" style="border-radius: 12px; overflow: hidden; transition: all 0.3s ease; height: 100%;"
                             onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 12px 24px rgba(0,0,0,0.15)'"
                             onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 8px rgba(0,0,0,0.1)'">
                            
                            <!-- Image -->
                            <div style="height: 220px; overflow: hidden; background: linear-gradient(135deg, #ffd89b, #ffb366);">
                                @php $mainImage = $transport->transportImages->first(); @endphp
                                @if($mainImage)
                                    <picture>
                                        <source type="image/webp" srcset="{{ asset('storage/' . str_replace('.jpg', '.webp', ltrim($mainImage->url, '/'))) }}">
                                        <img src="{{ asset('storage/' . ltrim($mainImage->url, '/')) }}"
                                             alt="{{ $mainImage->alt_text ?? $transport->name }}"
                                             style="width: 100%; height: 100%; object-fit: cover;">
                                    </picture>
                                @else
                                    <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center;">
                                        <i class="bi bi-car-front" style="font-size: 4rem; color: white; opacity: 0.8;"></i>
                                    </div>
                                @endif
                            </div>

                            <!-- Content -->
                            <div class="card-body" style="padding: 1.5rem;">
                                <h5 class="card-title" style="font-weight: 700; color: #333; margin-bottom: 0.5rem;">
                                    {{ $transport->name ?? 'Transporte' }}
                                </h5>
                                
                                <p style="color: #666; font-size: 0.9rem; margin-bottom: 1rem;">
                                    <i class="bi bi-geo-alt"></i> 
                                    {{ $transport->destinations->first()?->name ?? 'Costa Rica' }}
                                </p>

                                <!-- Type Badge -->
                                @if($transport->service_type)
                                    <div style="margin-bottom: 1rem;">
                                        <span style="background: #fff3e0; color: #e65100; padding: 6px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 600;">
                                            {{ ucfirst($transport->service_type) }}
                                        </span>
                                    </div>
                                @endif

                                <!-- Price -->
                                @php
                                    $minPrice = $transport->pricing()->min('price') ?? 50;
                                @endphp
                                <div style="background: linear-gradient(135deg, #fff3e0, #ffecb3); padding: 1rem; border-radius: 8px; margin-bottom: 1rem; border-left: 4px solid #FF9500;">
                                    <small style="color: #666;">{{ app()->getLocale() === 'es' ? 'Desde' : 'From' }}</small>
                                    <h6 style="color: #e65100; font-weight: 700; margin: 0;">
                                        ₡{{ number_format($minPrice, 0) }} <small style="font-size: 0.7rem; opacity: 0.8;">/{{ app()->getLocale() === 'es' ? 'viaje' : 'trip' }}</small>
                                    </h6>
                                </div>

                                <!-- Contact Info -->
                                <div style="margin-bottom: 1rem;">
                                    <small style="color: #666; display: block; margin-bottom: 0.5rem;">{{ app()->getLocale() === 'es' ? 'Contacto' : 'Contact' }}</small>
                                    @if($transport->phone)
                                        <p style="margin: 0.25rem 0; color: #333; font-weight: 600;">
                                            <i class="bi bi-telephone"></i> {{ $transport->phone }}
                                        </p>
                                    @endif
                                    @if($transport->email)
                                        <p style="margin: 0.25rem 0; color: #333; font-weight: 600; font-size: 0.9rem;">
                                            <i class="bi bi-envelope"></i> {{ substr($transport->email, 0, 25) }}...
                                        </p>
                                    @endif
                                </div>

                                <!-- View Details Button -->
                                <a href="{{ route('transport.show.' . app()->getLocale(), ['slug' => $transport->slug]) }}" 
                                   class="btn w-100" 
                                   style="background: linear-gradient(135deg, #FF9500, #F57C00); color: white; font-weight: 600; border-radius: 8px; border: none;">
                                    {{ app()->getLocale() === 'es' ? 'Ver Detalles' : 'View Details' }}
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($transports->hasPages())
                <div style="margin-top: 3rem; display: flex; justify-content: center;">
                    {{ $transports->links() }}
                </div>
            @endif
        @else
            <div class="alert alert-info text-center" style="padding: 3rem; border-radius: 12px;">
                <i class="bi bi-info-circle" style="font-size: 2rem;"></i>
                <h4 style="margin-top: 1rem; margin-bottom: 0.5rem;">
                    {{ app()->getLocale() === 'es' ? 'No hay servicios de transporte disponibles' : 'No transport services available' }}
                </h4>
                <p style="margin: 0; color: #666;">
                    {{ app()->getLocale() === 'es' ? 'Intenta otra búsqueda' : 'Try another search' }}
                </p>
            </div>
        @endif
    </div>

    <!-- CTA Section -->
    <div style="background: linear-gradient(135deg, #FF9500 0%, #F57C00 100%); color: white; padding: 4rem 2rem; text-align: center; margin-top: 4rem;">
        <div class="container">
            <h2 style="font-size: 2rem; font-weight: 700; margin-bottom: 1.5rem;">
                {{ app()->getLocale() === 'es' ? '¿Tienes un servicio de transporte?' : 'Do you have a transport service?' }}
            </h2>
            <p style="font-size: 1.1rem; opacity: 0.9; margin-bottom: 2rem;">
                {{ app()->getLocale() === 'es' ? 'Registra tu servicio y llega a más clientes' : 'Register your service and reach more customers' }}
            </p>
            <a href="{{ app()->getLocale() === 'es' ? '/es/registrar_servicio' : '/en/register_service' }}" 
               class="btn btn-light" 
               style="font-weight: 700; padding: 0.85rem 2rem; border-radius: 8px;">
                {{ app()->getLocale() === 'es' ? '➕ Agregar Transporte' : '➕ Add Transport' }}
            </a>
        </div>
    </div>
</div><!-- End Content Box -->
@endsection
