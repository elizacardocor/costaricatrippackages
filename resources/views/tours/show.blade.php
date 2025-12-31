@extends('layouts.app')

@section('canonical')
<link rel="canonical" href="{{ url($canonicalUrl) }}">
<meta property="og:type" content="website">
<meta property="og:title" content="{{ $tour->name }} - Costa Rica Trip Packages">
<meta property="og:description" content="{{ substr($tour->description, 0, 160) }}">
<meta property="og:image" content="{{ $tour->images->first()?->url ?? asset('images/default-tour.jpg') }}">
<meta property="og:url" content="{{ url($canonicalUrl) }}">
<meta property="og:site_name" content="Costa Rica Trip Packages">
<meta property="og:locale" content="{{ app()->getLocale() === 'es' ? 'es_CR' : 'en_US' }}">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $tour->name }}">
<meta name="twitter:description" content="{{ substr($tour->description, 0, 160) }}">
<meta name="twitter:image" content="{{ $tour->images->first()?->url ?? asset('images/default-tour.jpg') }}">

<!-- Schema.org JSON-LD for Tour -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "TouristAttraction",
    "@id": "{{ url($canonicalUrl) }}",
    "name": "{{ addslashes($tour->name) }}",
    "description": "{{ addslashes($tour->description) }}",
    "image": "{{ $tour->images->pluck('url')->toJson() }}",
    "url": "{{ url($canonicalUrl) }}",
    "offers": {
        "@type": "Offer",
        "priceCurrency": "USD",
        "price": "{{ $tour->price ?? 0 }}",
        "availability": "InStock"
    },
    "aggregateRating": {
        "@type": "AggregateRating",
        "ratingValue": "{{ $tour->rating ?? 4.5 }}",
        "reviewCount": "{{ $tour->reviews?->count() ?? 0 }}"
    }
}
</script>
@endsection

@section('content')
<!-- Mensaje de Éxito -->
@if(session('success'))
    <div class="container mt-3">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
@endif

<div class="container-fluid p-0">
    <!-- Hero Image Section -->
    <div class="position-relative" style="height: 300px; overflow: hidden; margin-top: 80px;">
        <img src="{{ $tour->images->first() ? asset('storage/' . $tour->images->first()->url) : 'https://via.placeholder.com/1200x500' }}" 
             alt="{{ $tour->name }}" 
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
            <h1 class="text-white mb-2">{{ $tour->name }}</h1>
            <p class="text-light mb-0">{{ $tour->destinations->first()?->name ?? 'Costa Rica' }}, {{ $tour->destinations->first()?->province->name ?? 'N/A' }}</p>
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
                            @for ($i = 0; $i < floor($tour->rating); $i++)
                                <i class="bi bi-star-fill text-warning"></i>
                            @endfor
                            @if ($tour->rating % 1 > 0)
                                <i class="bi bi-star-half text-warning"></i>
                            @endif
                        </div>
                        <span class="badge bg-success">{{ $tour->rating }}</span>
                        <small class="text-muted">({{ $tour->reviews->count() }} reseñas)</small>
                    </div>
                </div>

                <!-- Description -->
                <div class="mb-5">
                    <h3>Descripción</h3>
                    <p class="lead">{{ $tour->description }}</p>
                </div>

                <!-- Tour Info Grid -->
                <div class="row g-3 mb-5">
                    <div class="col-md-6">
                        <div class="card border-0 bg-light p-3">
                            <small class="text-muted">
                                <i class="bi bi-clock"></i> Duración
                            </small>
                            <h5 class="mb-0">{{ $tour->duration }} horas</h5>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card border-0 bg-light p-3">
                            <small class="text-muted">
                                <i class="bi bi-people"></i> Grupo
                            </small>
                            <h5 class="mb-0">{{ $tour->group_size ?? '6-8' }} personas</h5>
                        </div>
                    </div>
                </div>

                <!-- Image Gallery -->
                <div class="mb-5">
                    <h3 class="mb-4">Galería</h3>
                    <div class="row g-3">
                        @foreach ($tour->images as $image)
                            <div class="col-md-6">
                                <img src="{{ asset('storage/' . $image->url) }}" alt="{{ $tour->name }}" class="img-fluid rounded" style="height: 300px; object-fit: cover; width: 100%;">
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- What's Included -->
                <div class="mb-5">
                    <h3>¿Qué está Incluido?</h3>
                    <div class="row g-3">
                        @foreach ($tour->includes as $item)
                            <div class="col-md-6">
                                <div class="d-flex gap-2">
                                    <i class="bi bi-check-circle-fill text-success mt-1"></i>
                                    <span>{{ $item->name }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Important Info -->
                <div class="alert alert-info">
                    <h5 class="alert-heading">
                        <i class="bi bi-info-circle"></i> Información Importante
                    </h5>
                    <ul class="mb-0">
                        <li>Los horarios están sujetos a cambios según el clima</li>
                        <li>Se recomienda llevar ropa cómoda y zapatos de senderismo</li>
                        <li>Cancelación gratuita hasta 24 horas antes</li>
                        <li>Confirmación instantánea al reservar</li>
                    </ul>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Price Card -->
                <div class="card shadow-lg position-sticky" style="top: 20px;">
                    <div class="card-body">
                        <div class="mb-4">
                            <small class="text-muted">Precio por Persona</small>
                            <h2 class="mb-0" style="color: #1eaa60;">
                                ${{ number_format($tour->base_price ?? 199, 0) }}
                            </h2>
                            <small class="text-muted">{{ $tour->duration }} horas</small>
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

                        <!-- Quick Info -->
                        <div class="border-top pt-3 mt-3">
                            <small class="text-muted d-block mb-2">
                                <i class="bi bi-geo-alt"></i> {{ $tour->destinations->first()?->name ?? 'Costa Rica' }}
                            </small>
                            <small class="text-muted d-block mb-2">
                                <i class="bi bi-clock"></i> {{ $tour->duration }} horas
                            </small>
                            <small class="text-muted d-block">
                                <i class="bi bi-people"></i> {{ $tour->group_size ?? '6-8' }} personas
                            </small>
                        </div>
                    </div>
                </div>

                <!-- Similar Tours -->
                <div class="card mt-3">
                    <div class="card-header">
                        <h5 class="mb-0">Tours Similares</h5>
                    </div>
                    <div class="card-body">
                        @php
                            $otherTours = \App\Models\Tour::where('id', '!=', $tour->id)->limit(2)->get();
                        @endphp
                        @forelse ($otherTours as $otherTour)
                            <div class="mb-3">
                                <h6>{{ $otherTour->name }}</h6>
                                <small class="text-muted">{{ $otherTour->duration }} horas</small>
                                <p class="text-success fw-bold">${{ number_format($otherTour->base_price ?? 199, 0) }}</p>
                                <a href="/{{ app()->getLocale() }}/tour/{{ $otherTour->slug }}" class="btn btn-sm btn-outline-primary">Ver Tour</a>
                            </div>
                            @if (!$loop->last)
                                <hr>
                            @endif
                        @empty
                            <p class="text-muted">No hay otros tours disponibles</p>
                        @endforelse
                    </div>
                </div>
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
