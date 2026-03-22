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
        height: 340px;
        overflow: hidden;
        transition: transform 0.3s;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #000;
    }

    .tour-image-wrapper:hover {
        transform: scale(1.05);
    }

    .tour-image, .tour-image-wrapper video {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s;
        display: block;
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
    <style>
        .tour-header-bar {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 200px;
            position: relative;
        }
        @media (max-width: 991.98px) {
            .tour-header-bar {
                margin-top: 120px;
            }
        }
        .tour-header-bar h1 {
            color: #8B0000;
            display: inline-block;
            margin: 0 auto;
            text-align: center;
            flex: 0 1 auto;
        }
        .tour-header-bar .back-btn {
            color: #fff;
            background: #8B0000;
            border: none;
            padding: 0.15em 0.7em;
            border-radius: 4px;
            font-weight: 600;
            font-size: 0.85rem;
            display: inline-block;
            height: 2em;
            width: auto;
            min-width: 60px;
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            transition: background 0.2s;
            text-decoration: none;
        }
        @media (max-width: 991.98px) {
            .tour-header-bar .back-btn {
                display: none;
            }
        }
        .tour-header-bar .back-btn:hover {
            background: #a80000;
            color: #fff;
        }
    </style>
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
    <!-- Content Section -->
    <div class="container py-5">
        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-8">
                <div class="mb-4">
                    <div class="tour-header-bar">
                        <a href="javascript:history.back()" class="back-btn">
                            <i class="bi bi-arrow-left"></i> Volver
                        </a>
                        <h1>{{ $tour->name }}</h1>
                    </div>
                    <p class="text-muted mb-0" style="text-align:center;">{{ $tour->destinations->first()?->name ?? 'Costa Rica' }}, {{ $tour->destinations->first()?->province->name ?? 'N/A' }}</p>
                </div>

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

                <!-- Tour Info Grid -->
                <div class="row g-3 mb-5" style="margin-top: 2.5rem; margin-bottom: 2.5rem;">
                    <div class="col-md-6">
                        <div class="card border-0 bg-light p-3">
                            <h5 class="mb-0">
                                <i class="bi bi-clock"></i>
                                <span style="color:#8B0000; font-weight: bold;">Duración:</span>
                                {{ $tour->duration_hours ? rtrim(rtrim(number_format($tour->duration_hours,2), '0'), '.') : 'N/D' }} horas
                            </h5>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card border-0 bg-light p-3">
                            <h5 class="mb-0">
                                <i class="bi bi-people"></i>
                                <span style="color:#8B0000; font-weight: bold;">Capacidad mínima:</span>
                                {{ $tour->min_capacity > 0 ? $tour->min_capacity : 'N/D' }} personas
                            </h5>
                            <h5 class="mb-0 mt-2">
                                <i class="bi bi-people"></i>
                                <span style="color:#8B0000; font-weight: bold;">Capacidad máxima:</span>
                                {{ $tour->max_capacity > 0 ? $tour->max_capacity : 'N/D' }} personas
                            </h5>
                        </div>
                    </div>
                </div>

                <!-- Galería de Imágenes y Video -->
                <div class="mb-5" style="margin-bottom: 2rem;">
                    <div class="row">
                        <div class="col-md-6">
                            <h3>Galería</h3>
                            @if($tour->images->count() > 0)
                                <div class="tour-gallery-grid">
                                    @foreach ($tour->images as $image)
                                        <div class="tour-gallery-item">
                                            <div class="tour-image-wrapper" style="border-radius: 12px; cursor: pointer;">
                                                <picture>
                                                    <source type="image/webp" srcset="{{ asset('storage/' . str_replace('.jpg', '.webp', $image->url)) }}">
                                                    <img src="{{ asset('storage/' . $image->url) }}" 
                                                         alt="{{ $image->alt_text ?? $tour->name }}" 
                                                         class="tour-image" style="width:100%;height:340px;object-fit:cover;border-radius:12px;">
                                                </picture>
                                            </div>
                                        </div>
                                    @endforeach
                                    @if($tour->video_url)
                                        <div class="tour-gallery-item">
                                            <div class="tour-image-wrapper" style="border-radius: 12px; cursor: pointer;">
                                                @php
                                                    $videoUrl = ltrim($tour->video_url, '/');
                                                    $videoMp4 = preg_replace('/\.webm$/i', '.mp4', $videoUrl);
                                                    $videoTitle = $tour->name . ' - ' . (\Illuminate\Support\Str::limit($tour->description, 60));
                                                @endphp
                                                <video controls preload="none" style="width:100%;height:340px;object-fit:cover;border-radius:12px;" poster="{{ $tour->images->first() ? asset('storage/' . ltrim($tour->images->first()->url,'/')) : asset('images/default-tour.jpg') }}" title="{{ $videoTitle }}">
                                                    <source src="/{{ $videoUrl }}" type="video/webm">
                                                    <source src="/{{ $videoMp4 }}" type="video/mp4">
                                                    {{ __('Video de presentación:') }} {{ $videoTitle }}
                                                </video>
                                            </div>
                                            <p class="text-muted mt-2"><strong>{{ $videoTitle }}</strong></p>
                                        </div>
                                    @endif
                                </div>
                            @else
                                <p class="text-muted">{{ __('No hay imágenes disponibles') }}</p>
                            @endif
                        </div>
                       
                    </div>
                </div>

                <!-- Description -->
                <div class="mb-5" style="margin-top: 2rem; margin-bottom: 2rem;">
                    <h3>Descripción</h3>
                    <p class="lead">{{ $tour->description }}</p>
                </div>


                <!-- What's Included -->
                <div class="mb-5" style="margin-top: 2rem; margin-bottom: 2rem;">
                    <h3>¿Qué está Incluido?</h3>
                    <div class="row g-3">
                        @forelse ($tour->tourIncludes as $item)
                            <div class="col-md-6 d-flex align-items-center mb-2">
                                <span style="font-size:1.5rem;line-height:1;display:inline-block;margin-right:0.5rem;color:#10b981;">
                                    &#10003;
                                </span>
                                <span class="fw-semibold" style="color:#222;font-size:1.08rem;">{{ $item->name }}</span>
                            </div>
                        @empty
                            <div class="col-12">
                                <span class="text-muted">No hay información de incluye para este tour.</span>
                            </div>
                        @endforelse
                    </div>
                </div>


                <!-- Recomendaciones del Tour -->
                <div class="mb-5" style="margin-top: 2rem; margin-bottom: 2rem;">
                    <h3>Recomendaciones</h3>
                    @if(!empty($tour->recommendations))
                        <ul>
                            @foreach(explode(',', $tour->recommendations) as $rec)
                                <li>{{ trim($rec) }}</li>
                            @endforeach
                        </ul>
                    @else
                        <span class="text-muted">No se encontraron recomendaciones disponibles.</span>
                    @endif
                </div>

                <!-- Política de Cancelación -->
                <div class="mb-5" style="margin-top: 2rem; margin-bottom: 2rem;">
                    <h3>Política de Cancelación</h3>
                    @if(!empty($tour->cancellation_policy))
                        <div class="alert alert-info" style="white-space: pre-line;">{{ $tour->cancellation_policy }}</div>
                    @else
                        <span class="text-muted">no se encontro informacion</span>
                    @endif
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
                                <div style="font-size: 1rem; color: #333; font-weight: 500; margin-bottom: 0.25rem;">
                                    por Persona
                                    <span style="color: #888; font-weight: 400;">
                                        {{ $tour->duration_hours ? rtrim(rtrim(number_format($tour->duration_hours,2), '0'), '.') : 'N/D' }} horas
                                    </span>
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
                        
                       
                        <!-- Info Box 
                        <div class="alert alert-info mt-3 small">
                            <i class="bi bi-info-circle"></i> 
                            Disponibilidad en tiempo real. Confirmación instantánea.
                        </div>-->

                        <!-- Quick Info 
                        <div class="border-top pt-3 mt-3">
                            <small class="text-muted d-block mb-2">
                                <i class="bi bi-geo-alt"></i> {{ $tour->destinations->first()?->name ?? 'Costa Rica' }}
                            </small>
                            <small class="text-muted d-block mb-2">
                                <i class="bi bi-clock"></i> {{ $tour->duration_hours ? rtrim(rtrim(number_format($tour->duration_hours,2), '0'), '.') : 'N/D' }} horas
                            </small>
                            <small class="text-muted d-block">
                                <i class="bi bi-people"></i> {{ $tour->max_capacity > 0 ? $tour->max_capacity : 'N/D' }} personas
                            </small>
                        </div> -->
                    </div>
                </div>

                <!-- CTA WhatsApp igual que en /tours -->
                <section class="providers-cta" style="background: #fff7f7; color: #8B0000; padding: 2.5rem 1rem; text-align: center; border-radius: 16px; margin-top: 1.5rem;">
                    <div class="container">
                        <h5 class="providers-cta-title">
                            {{ app()->getLocale() === 'es' ? '¿Listo para tu aventura?' : 'Ready for your adventure?' }}
                        </h5>
                        <p class="providers-cta-text">
                            {{ app()->getLocale() === 'es' ? 'Contáctanos hoy y comienza a planificar el viaje de tus sueños en Costa Rica' : 'Contact us today and start planning your dream trip to Costa Rica' }}
                        </p>
                        <a href="https://wa.me/70579814" target="_blank" rel="noopener" class="providers-cta-button">
                            <span style="display: inline-flex; align-items: center; gap: 0.4rem;">
                                <span style="font-size: 1.15rem;">💬</span>
                                {{ app()->getLocale() === 'es' ? 'Contactar Ahora' : 'Contact Now' }}
                            </span>
                        </a>
                    </div>
                </section>
                <style>
                    .providers-cta {
                        background: #fff7f7;
                        color: #8B0000;
                        padding: 2.5rem 1rem;
                        text-align: center;
                        border-radius: 16px;
                        margin-top: 1.5rem;
                    }
                    .providers-cta-title {
                        font-size: 1.2rem;
                        font-weight: 700;
                        margin-bottom: 0.7rem;
                    }
                    .providers-cta-text {
                        font-size: 1rem;
                        margin-bottom: 1.2rem;
                    }
                    .providers-cta-button {
                        display: inline-block;
                        background: #8B0000;
                        color: #fff;
                        padding: 0.5rem 1.2rem;
                        border-radius: 50px;
                        font-weight: 700;
                        font-size: 1.1rem;
                        text-decoration: none;
                        transition: all 0.3s;
                        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
                    }
                    .providers-cta-button:hover {
                        background: #a80000;
                        color: #fff;
                    }
                    @media (max-width: 768px) {
                        .providers-cta-button {
                            font-size: 0.95rem;
                        }
                    }
                </style>
                    <div class="mt-2" style="font-size: 0.95rem; color: #e0e0e0;">
                        Respuesta rápida y atención personalizada
                    </div>
                </section>
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
