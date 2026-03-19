@extends('layouts.master')

@section('title', $hotel->name . ' - Costa Rica Trip Packages')

@section('og_type', 'website')
@section('og_title', $hotel->name . ' - Costa Rica Trip Packages')
@section('og_description', substr($hotel->description ?? '', 0, 160))
@section('og_image', $hotel->images->first() ? (\Illuminate\Support\Str::startsWith($hotel->images->first()->url, ['http://','https://','//']) ? $hotel->images->first()->url : asset('storage/' . ltrim($hotel->images->first()->url,'/'))) : asset('images/default-hotel.jpg'))

@section('twitter_title', $hotel->name)
@section('twitter_description', substr($hotel->description ?? '', 0, 160))
@section('twitter_image', $hotel->images->first() ? (\Illuminate\Support\Str::startsWith($hotel->images->first()->url, ['http://','https://','//']) ? $hotel->images->first()->url : asset('storage/' . ltrim($hotel->images->first()->url,'/'))) : asset('images/default-hotel.jpg'))

@section('canonical')
<link rel="canonical" href="{{ url($canonicalUrl) }}">
<!-- Schema.org JSON-LD for Hotel -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "Hotel",
    "@id": "{{ url($canonicalUrl) }}",
    "name": "{{ addslashes($hotel->name) }}",
    "description": "{{ addslashes($hotel->description ?? '') }}",
    @php
        $images = $hotel->images->pluck('url')->map(function($u){
            return \Illuminate\Support\Str::startsWith($u, ['http://','https://','//']) ? $u : asset('storage/' . ltrim($u,'/'));
        })->toArray();
    @endphp
    "image": {!! json_encode($images) !!},
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

@section('extra_styles')
<style>
.object-fit-cover {
    object-fit: cover !important;
}
</style>
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
    <!-- Content Section -->
    <div class="container py-5">
        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-8">
                <div class="mb-4">
                    <a href="javascript:history.back()" class="btn btn-outline-secondary btn-sm mb-3">
                        <i class="bi bi-arrow-left"></i> Volver
                    </a>
                    <h1 class="mb-2">{{ $hotel->name }}</h1>
                </div>

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

                <!-- Image Gallery -->
                <div class="mb-5">
                    <h3 class="mb-4">Galería</h3>
                    @if($hotel->images->count() > 0)
                        <div class="row g-3">
                            @foreach($hotel->images as $image)
                                <div class="col-md-6 col-lg-4">
                                    <div style="position: relative; height: 240px; overflow: hidden; border-radius: 12px; cursor: pointer; transition: transform 0.3s;"
                                         onmouseover="this.style.transform='scale(1.05)'" 
                                         onmouseout="this.style.transform='scale(1)'">
                                        @php $imgUrl = $image->url; @endphp
                                        <img src="{{ \Illuminate\Support\Str::startsWith($imgUrl, ['http://','https://','//']) ? $imgUrl : asset('storage/' . ltrim($imgUrl,'/')) }}" 
                                             alt="{{ $image->alt_text ?? $hotel->name }}" 
                                             class="img-fluid" 
                                             style="width: 100%; height: 100%; object-fit: cover;">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted">{{ __('No hay imágenes disponibles') }}</p>
                    @endif
                </div>


                <!-- Video de Presentación (si existe) -->
                @if($hotel->video_url)
                <div class="mb-5">
                    <h3>Video de Presentación</h3>
                    <div class="ratio ratio-16x9 mb-3">
                        @php
                            $videoUrl = ltrim($hotel->video_url, '/');
                            $videoMp4 = preg_replace('/\.webm$/i', '.mp4', $videoUrl);
                        @endphp
                        <video controls preload="none" style="width:100%;border-radius:12px;" poster="{{ $hotel->images->first() ? (\Illuminate\Support\Str::startsWith($hotel->images->first()->url, ['http://','https://','//']) ? $hotel->images->first()->url : asset('storage/' . ltrim($hotel->images->first()->url,'/'))) : asset('images/default-hotel.jpg') }}">
                            <source src="/{{ $videoUrl }}" type="video/webm">
                            <source src="/{{ $videoMp4 }}" type="video/mp4">
                            {{ __('Tu navegador no soporta la reproducción de video.') }}
                        </video>
                    </div>
                </div>
                @endif

                <!-- Description -->
                <div class="mb-5">
                    <h3>Descripción</h3>
                    <p class="lead">{{ $hotel->description }}</p>
                </div>

                <!-- Amenities -->
                <div class="mb-5">
                    <h3 class="mb-4">Amenidades del Hotel</h3>
                    @if($hotel->amenities->count() > 0)
                        <div class="row g-3">
                            @foreach ($hotel->amenities as $amenity)
                                <div class="col-md-6">
                                    <div class="p-3" style="background: linear-gradient(135deg, #f8f9ff, #f0f1ff); border-radius: 10px; border-left: 4px solid #667eea;">
                                        <div class="d-flex align-items-center gap-3">
                                            <div style="background: linear-gradient(135deg, #667eea, #764ba2); color: white; width: 45px; height: 45px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.3rem;">
                                                <i class="bi bi-check-circle"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-0" style="color: #333; font-weight: 600;">{{ $amenity->name }}</h6>
                                                <small style="color: #666;">Disponible en el hotel</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="alert alert-info">
                            <i class="bi bi-info-circle"></i> No se han especificado amenidades para este hotel.
                        </div>
                    @endif
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Price Card -->
                <div class="card position-sticky border-0" style="top: 20px; border-radius: 12px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.06);">
                    <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 1.25rem 1rem;">
                        <small style="opacity: 0.9; font-size: 0.75rem;">Desde</small>
                        @php
                            $minPrice = $hotel->pricing()->min('price') ?? 100;
                        @endphp
                        <h3 class="mb-0" style="font-weight: 700; margin-top: 0.25rem; font-size: 1.75rem;">
                            ${{ number_format($minPrice, 2) }}
                            <small style="font-size: 0.4em; opacity: 0.9;">/noche</small>
                        </h3>
                    </div>

                    <div class="card-body" style="padding: 1.25rem;">
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
                                $currentPrice = $hotel->pricing()
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
                                $currentPrice = $hotel->pricing()->orderBy('price', 'asc')->first();
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
                                    <small style="font-size: 0.4em; opacity: 0.8;">/noche</small>
                                </div>
                                @if($dateRange)
                                    <div style="font-size: 0.75rem; color: #666; margin-top: 0.5rem;">
                                        <i class="bi bi-calendar3"></i> {{ $dateRange }}
                                    </div>
                                @endif
                                <div style="font-size: 0.7rem; color: #999; margin-top: 0.5rem;">
                                    <i class="bi bi-info-circle"></i> Precio para {{ $today->format('d M Y') }}
                                    @if($isWeekend)
                                        (Fin de Semana)
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Booking Button -->
                        <button class="btn w-100 mb-2" style="background: linear-gradient(135deg, #1eaa60, #15c25a); color: white; font-weight: 600; padding: 0.65rem; border-radius: 8px;">
                            <i class="bi bi-calendar-check"></i> Reservar
                        </button>

                        <!-- Contact Info -->
                        <div style="border-top: 1px solid #e0e0e0; padding-top: 0.75rem; font-size: 0.85rem;">
                            @if($hotel->phone)
                                <div class="mb-1">
                                    <small style="color: #666; display: block;">Teléfono</small>
                                    <a href="tel:{{ $hotel->phone }}" style="color: #667eea; text-decoration: none; font-weight: 600;">
                                        {{ $hotel->phone }}
                                    </a>
                                </div>
                            @endif
                            @if($hotel->email)
                                <div class="mb-1">
                                    <small style="color: #666; display: block;">Email</small>
                                    <a href="mailto:{{ $hotel->email }}" style="color: #667eea; text-decoration: none; font-weight: 600;">
                                        {{ $hotel->email }}
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
