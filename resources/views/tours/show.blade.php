@extends('layouts.master')

@section('title', $tour->name . ' - Costa Rica Trip Packages')
@section('meta_description', substr($tour->description, 0, 160))

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

@section('extra_styles')
<style>
    .tour-gallery-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        gap: 1rem;
    }

    .tour-gallery-item {
        min-width: 0;
    }

    .tour-image-wrapper {
        position: relative;
        height: 240px;
        overflow: hidden;
        transition: transform 0.3s;
    }

    .tour-image-wrapper:hover {
        transform: scale(1.05);
    }

    .tour-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s;
    }

    .tour-image-wrapper:hover .tour-image {
        transform: scale(1.1);
    }

    @media (max-width: 576px) {
        .tour-gallery-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
<div class="content-box">
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
    <div class="position-relative" style="height: 300px; overflow: hidden;">
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
                    @if($tour->images->count() > 0)
                        <div class="tour-gallery-grid">
                            @foreach ($tour->images as $image)
                                <div class="tour-gallery-item">
                                    <div class="tour-image-wrapper" style="border-radius: 12px; cursor: pointer;">
                                        <img src="{{ asset('storage/' . $image->url) }}" 
                                             alt="{{ $tour->name }}" 
                                             class="tour-image">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted">{{ __('No hay imágenes disponibles') }}</p>
                    @endif
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
                        <!-- Precio de la Temporada Actual -->
                        @php
                            $today = \Carbon\Carbon::today();
                            
                            // Encontrar la temporada actual (excluyendo fin de semana)
                            $currentSeason = \App\Models\RateTypeSeason::with('rateType')
                                ->where('start_date', '<=', $today)
                                ->where('end_date', '>=', $today)
                                ->whereHas('rateType', function($q) {
                                    $q->where('slug', '!=', 'weekend');
                                })
                                ->first();
                            
                            // Si es fin de semana (sábado o domingo), verificar precio de fin de semana
                            $isWeekend = $today->isWeekend();
                            
                            if ($isWeekend) {
                                $weekendSeason = \App\Models\RateTypeSeason::with('rateType')
                                    ->whereHas('rateType', function($q) {
                                        $q->where('slug', 'weekend');
                                    })
                                    ->where('start_date', '<=', $today)
                                    ->where('end_date', '>=', $today)
                                    ->first();
                                    
                                if ($weekendSeason) {
                                    $currentSeason = $weekendSeason;
                                }
                            }
                            
                            // Obtener el precio correspondiente
                            $currentPrice = null;
                            $seasonName = 'Temporada Regular';
                            $seasonIcon = '📅';
                            $seasonColor = '#667eea';
                            $dateRange = '';
                            
                            if ($currentSeason) {
                                $currentPrice = $tour->pricing()
                                    ->where('rate_type_id', $currentSeason->rate_type_id)
                                    ->first();
                                    
                                $seasonName = $currentSeason->rateType->name;
                                $dateRange = \Carbon\Carbon::parse($currentSeason->start_date)->format('d M') . ' - ' . 
                                            \Carbon\Carbon::parse($currentSeason->end_date)->format('d M Y');
                                
                                // Iconos y colores por temporada
                                $icons = [
                                    'low-season' => ['icon' => '🟢', 'color' => '#10b981'],
                                    'high-season' => ['icon' => '🟡', 'color' => '#f59e0b'],
                                    'peak-season' => ['icon' => '🔴', 'color' => '#ef4444'],
                                    'weekend' => ['icon' => '⭐', 'color' => '#8b5cf6'],
                                ];
                                $config = $icons[$currentSeason->rateType->slug] ?? ['icon' => '📅', 'color' => '#667eea'];
                                $seasonIcon = $config['icon'];
                                $seasonColor = $config['color'];
                            }
                            
                            // Si no hay precio para temporada actual, usar el más bajo
                            if (!$currentPrice) {
                                $currentPrice = $tour->pricing()->orderBy('price', 'asc')->first();
                            }
                            
                            $priceAmount = $currentPrice ? $currentPrice->price : 100;
                        @endphp
                        
                        <div class="mb-3" style="background: linear-gradient(135deg, {{ $seasonColor }}15, {{ $seasonColor }}05); padding: 1rem; border-radius: 10px; border: 2px solid {{ $seasonColor }};">
                            <div style="text-align: center;">
                                <div style="font-size: 1.5rem; margin-bottom: 0.25rem;">{{ $seasonIcon }}</div>
                                <div style="font-size: 0.8rem; color: #666; margin-bottom: 0.5rem; font-weight: 600;">
                                    {{ $seasonName }}
                                </div>
                                <div style="font-size: 2rem; font-weight: 700; color: {{ $seasonColor }}; margin-bottom: 0.25rem;">
                                    ${{ number_format($priceAmount, 0) }}
                                </div>
                                @if($dateRange)
                                    <div style="font-size: 0.75rem; color: #666;">
                                        {{ $dateRange }}
                                    </div>
                                @endif
                                <div style="font-size: 0.75rem; color: #999; margin-top: 0.5rem;">
                                    Precio para {{ $today->format('d M Y') }}
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <small class="text-muted">por Persona</small>
                            <small class="text-muted d-block">{{ $tour->duration }} horas</small>
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
</div><!-- End Content Box -->

<style>
.object-fit-cover {
    object-fit: cover !important;
}
</style>
@endsection
