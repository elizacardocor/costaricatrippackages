@extends('layouts.app')

@section('canonical')
<link rel="canonical" href="{{ url($canonicalUrl) }}">
<meta property="og:type" content="website">
<meta property="og:title" content="{{ $hotel->name }} - Costa Rica Trip Packages">
<meta property="og:description" content="{{ substr($hotel->description, 0, 160) }}">
<meta property="og:image" content="{{ $hotel->images->first()?->url ?? asset('images/default-hotel.jpg') }}">
<meta property="og:url" content="{{ url($canonicalUrl) }}">
<meta property="og:site_name" content="Costa Rica Trip Packages">
<meta property="og:locale" content="{{ app()->getLocale() === 'es' ? 'es_CR' : 'en_US' }}">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $hotel->name }}">
<meta name="twitter:description" content="{{ substr($hotel->description, 0, 160) }}">
<meta name="twitter:image" content="{{ $hotel->images->first()?->url ?? asset('images/default-hotel.jpg') }}">

<!-- Schema.org JSON-LD for Hotel -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "Hotel",
    "@id": "{{ url($canonicalUrl) }}",
    "name": "{{ addslashes($hotel->name) }}",
    "description": "{{ addslashes($hotel->description) }}",
    "image": "{{ $hotel->images->pluck('url')->toJson() }}",
    "url": "{{ url($canonicalUrl) }}",
    "priceRange": "$${{ str_repeat('$', intval($hotel->stars ?? 3)) }}",
    "starRating": {
        "@type": "Rating",
        "ratingValue": "{{ $hotel->stars ?? 3 }}"
    },
    "aggregateRating": {
        "@type": "AggregateRating",
        "ratingValue": "{{ $hotel->rating ?? 4.5 }}",
        "reviewCount": "{{ $hotel->reviews?->count() ?? 0 }}"
    }
}
</script>
@endsection

@section('content')
<div class="container-fluid p-0">
    <!-- Hero Image Section -->
    <div class="position-relative" style="height: 300px; overflow: hidden; margin-top: 80px;">
        <img src="{{ $hotel->images->first()?->url ?? 'https://via.placeholder.com/1200x500' }}" 
             alt="{{ $hotel->name }}" 
             class="w-100 h-100 object-fit-cover"
             style="object-fit: cover;">
        <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark" style="opacity: 0.3;"></div>
        
        <!-- Back Button -->
        <div class="position-absolute top-3 start-3">
            <a href="javascript:history.back()" class="btn btn-light rounded-circle" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                <i class="bi bi-arrow-left"></i>
            </a>
        </div>

        <!-- Title on Image -->
        <div class="position-absolute bottom-0 start-0 w-100 p-4" style="background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);">
            <h1 class="text-white mb-2">{{ $hotel->name }}</h1>
            <p class="text-light mb-0">{{ $hotel->destination_id }}, {{ $hotel->province_id }}</p>
        </div>
    </div>

    <!-- Content Section -->
    <div class="container py-5">
        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-8">
                <!-- Rating and Reviews -->
                <div class="mb-4">
                    <div class="d-flex align-items-center gap-2">
                        <div class="d-flex">
                            @for ($i = 0; $i < floor($hotel->rating); $i++)
                                <i class="bi bi-star-fill text-warning"></i>
                            @endfor
                            @if ($hotel->rating % 1 > 0)
                                <i class="bi bi-star-half text-warning"></i>
                            @endif
                        </div>
                        <span class="badge bg-success">{{ $hotel->rating }}</span>
                        <small class="text-muted">({{ $hotel->reviews->count() }} reseñas)</small>
                    </div>
                </div>

                <!-- Description -->
                <div class="mb-5">
                    <h3>Descripción</h3>
                    <p class="lead">{{ $hotel->description }}</p>
                </div>

                <!-- Image Gallery -->
                <div class="mb-5">
                    <h3 class="mb-4">Galería</h3>
                    <div class="row g-3">
                        @foreach ($hotel->images as $image)
                            <div class="col-md-6">
                                <img src="{{ $image->url }}" alt="{{ $hotel->name }}" class="img-fluid rounded" style="height: 300px; object-fit: cover; width: 100%;">
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Amenities -->
                <div class="mb-5">
                    <h3>Amenidades</h3>
                    <div class="row g-3">
                        @foreach ($hotel->amenities as $amenity)
                            <div class="col-md-6">
                                <div class="d-flex gap-2">
                                    <i class="bi bi-check-circle-fill text-success mt-1"></i>
                                    <span>{{ $amenity->name }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Hotel Info -->
                <div class="mb-5">
                    <h3>Información</h3>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="card border-0 bg-light p-3">
                                <small class="text-muted">Número de Habitaciones</small>
                                <h5 class="mb-0">{{ $hotel->rooms_count }}</h5>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card border-0 bg-light p-3">
                                <small class="text-muted">Ubicación</small>
                                <h5 class="mb-0">{{ $hotel->destinations->first()?->name ?? 'N/A' }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Price Card -->
                <div class="card shadow-lg position-sticky" style="top: 20px;">
                    <div class="card-body">
                        <div class="mb-4">
                            <small class="text-muted">Desde</small>
                            <h2 class="mb-0" style="color: #1eaa60;">
                                ${{ number_format($hotel->base_price ?? 100, 0) }}
                                <small style="font-size: 0.5em;">/noche</small>
                            </h2>
                        </div>

                        <!-- Booking Button -->
                        <button class="btn w-100 mb-2" style="background: linear-gradient(135deg, #1eaa60, #15c25a); color: white; font-weight: 600;">
                            <i class="bi bi-calendar-check"></i> Reservar Ahora
                        </button>

                        <!-- Add to Plan Button -->
                        <button class="btn btn-outline-secondary w-100 mb-3">
                            <i class="bi bi-plus"></i> Agregar a Mi Plan
                        </button>

                        <!-- Contact Button -->
                        <button class="btn btn-light w-100">
                            <i class="bi bi-telephone"></i> Contactar
                        </button>

                        <!-- Info Box -->
                        <div class="alert alert-info mt-3 small">
                            <i class="bi bi-info-circle"></i> 
                            Disponibilidad en tiempo real. Confirmación instantánea.
                        </div>
                    </div>
                </div>

                <!-- Map Section -->
                <div class="card mt-3">
                    <div class="card-header">
                        <h5 class="mb-0">Ubicación</h5>
                    </div>
                    <div class="card-body p-0">
                        <div style="height: 300px; background: linear-gradient(135deg, #f5f5f5, #e0e0e0); border-radius: 0 0 8px 8px; display: flex; align-items: center; justify-content: center;">
                            <div class="text-center text-muted">
                                <i class="bi bi-geo-alt" style="font-size: 2rem;"></i>
                                <p>{{ $hotel->destinations->first()?->name ?? 'N/A' }}, {{ $hotel->destinations->first()?->province->name ?? 'N/A' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Hotels Section -->
    <div class="bg-light py-5">
        <div class="container">
            <h3 class="mb-4">Otros Hoteles en {{ $hotel->destinations->first()?->name ?? 'Esta Área' }}</h3>
            <div class="row g-4">
                @php
                    $otherHotels = \App\Models\Hotel::where('id', '!=', $hotel->id)->limit(3)->get();
                @endphp
                @forelse ($otherHotels as $otherHotel)
                    <div class="col-md-4">
                        <div class="card shadow-sm">
                            <img src="{{ $otherHotel->images->first()?->url ?? 'https://via.placeholder.com/400x250' }}" class="card-img-top" alt="{{ $otherHotel->name }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $otherHotel->name }}</h5>
                                <p class="card-text text-muted">{{ $otherHotel->rating }} ★ ({{ $otherHotel->reviews->count() }} reseñas)</p>
                                <p class="h5 mb-3">${{ number_format($otherHotel->base_price ?? 100, 0) }}<small>/noche</small></p>
                                <a href="/{{ app()->getLocale() }}/hotel/{{ $otherHotel->slug }}" class="btn btn-sm btn-outline-primary">Ver Detalles</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <p class="text-muted text-center">No hay otros hoteles disponibles</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<style>
.object-fit-cover {
    object-fit: cover !important;
}
</style>
@endsection
