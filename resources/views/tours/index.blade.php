@extends('layouts.master')

@section('title', __('tours.listing_title'))

@section('meta_description', __('tours.listing_meta_description'))
@section('meta_keywords', 'tours Costa Rica, paquetes turísticos, aventuras, volcanes, selva tropical')

@section('og_title', __('tours.listing_og_title', ['default' => __('tours.listing_title')]))
@section('og_description', __('tours.listing_og_description', ['default' => __('tours.listing_meta_description')]))
@section('og_image', asset('images/og-tours.jpg'))

@section('twitter_title', __('tours.listing_og_title', ['default' => __('tours.listing_title')]))
@section('twitter_description', __('tours.listing_og_description', ['default' => __('tours.listing_meta_description')]))
@section('twitter_image', asset('images/og-tours.jpg'))

@section('canonical')
    <link rel="canonical" href="{{ url()->current() }}">
    <link rel="alternate" hreflang="es" href="{{ route('tours.index.es') }}">
    <link rel="alternate" hreflang="en" href="{{ route('tours.index.en') }}">
@endsection

@section('extra_styles')
<style>
    .page-header {
        position: relative;
        height: 400px;
        margin-top: 0;
        overflow: hidden;
    }

    .page-header-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .page-header:hover .page-header-image {
        transform: scale(1.1);
    }

    .page-header-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, rgba(0, 168, 107, 0.3) 0%, rgba(0, 102, 204, 0.3) 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.5s ease;
    }

    .page-header:hover .page-header-overlay {
        opacity: 1;
    }

    .page-header-content {
        text-align: center;
        color: white;
        transform: translateY(20px);
        transition: transform 0.5s ease;
    }

    .page-header:hover .page-header-content {
        transform: translateY(0);
    }

    .page-header-content h1 {
        font-size: 3rem;
        font-weight: 700;
        text-shadow: 2px 2px 8px rgba(0,0,0,0.5);
    }

    .filters-section {
        background: #f8f9fa;
        padding: 2rem 0;
    }

    .filters-section h1 {
        text-align: center;
        font-size: 2.5rem;
        margin-bottom: 0.5rem;
        color: var(--dark);
    }

    .filters-section .subtitle {
        text-align: center;
        color: var(--gray);
        margin-bottom: 2rem;
    }

    .filters {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
        align-items: flex-end;
    }

    .filter-group {
        flex: 1;
        min-width: 200px;
    }

    .filter-group label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 600;
        font-size: 0.9rem;
    }

    .filter-group select,
    .filter-group input {
        width: 100%;
        padding: 0.7rem;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-family: inherit;
    }

    .filter-button {
        padding: 0.7rem 2rem;
        background: var(--secondary-color);
        color: white;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
    }

    .filter-button:hover {
        background: #0052a3;
    }

    .tours-section {
        padding: 3rem 0;
    }

    .section-info {
        margin-bottom: 2rem;
        text-align: center;
    }

    .tours-count {
        color: var(--gray);
    }

    .tours-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 2rem;
        margin-bottom: 3rem;
    }

    @media (max-width: 1200px) {
        .tours-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    .tour-card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        transition: all 0.3s;
        display: flex;
        flex-direction: column;
    }

    .tour-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 8px 30px rgba(0,0,0,0.15);
    }

    .tour-image-wrapper {
        position: relative;
        height: 240px;
        overflow: hidden;
    }

    .tour-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s;
    }

    .tour-card:hover .tour-image {
        transform: scale(1.1);
    }

    /*
    .tour-badge {
        background: #25D366;
        color: white;
        font-weight: 700;
        padding: 0.35rem 0.9rem;
        border-radius: 12px;
        font-size: 0.95rem;
        display: inline-block;
        margin-bottom: 0.5rem;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    }
    */

    .tour-content {
        padding: 1.5rem;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .tour-category {
        color: #8B0000;
        font-size: 0.9rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .tour-title {
        font-size: 1.4rem;
        font-weight: 600;
        color: var(--dark);
        margin-bottom: 0.8rem;
        line-height: 1.3;
    }

    .tour-description {
        color: var(--gray);
        margin-bottom: 1rem;
        line-height: 1.6;
        flex: 1;
    }

    .tour-features {
        display: flex;
        gap: 1rem;
        margin-bottom: 1.5rem;
        flex-wrap: wrap;
    }

    .feature {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.9rem;
        color: var(--gray);
    }

    .tour-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 1rem;
        border-top: 1px solid #f0f0f0;
    }

    .tour-price {
        font-size: 1.8rem;
        font-weight: 700;
        color: #8B0000;
    }

    .tour-price small {
        font-size: 0.7rem;
        font-weight: 400;
        color: var(--gray);
        display: block;
    }

    .tour-button {
        padding: 0.8rem 1.8rem;
        background: #8B0000;
        color: white;
        text-decoration: none;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s;
        display: inline-block;
    }

    .tour-button:hover {
        background: #6b0000;
        transform: translateY(-2px);
    }

    .pagination {
        display: flex;
        justify-content: center;
        gap: 0.5rem;
        margin-top: 3rem;
    }

    .page-link {
        padding: 0.7rem 1.2rem;
        background: white;
        color: var(--dark);
        text-decoration: none;
        border-radius: 8px;
        border: 1px solid #ddd;
        transition: all 0.3s;
    }

    .page-link:hover,
    .page-link.active {
        background: #8B0000;
        color: white;
        border-color: #8B0000;
    }

    .providers-cta {
        position: relative;
        background: #2a2a2a;
        color: white;
        padding: 5rem 2rem;
        text-align: center;
        margin-top: 3rem;
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        overflow: hidden;
    }

    .providers-cta-video {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        z-index: 0;
    }

    .providers-cta::before {
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(0, 168, 107, 0.30) 0%, rgba(0, 102, 204, 0.30) 100%);
        z-index: 1;
    }

    .providers-cta-content {
        position: relative;
        z-index: 2;
    }

    .providers-cta-title {
        font-size: 1.25rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        text-shadow: 2px 2px 8px rgba(0,0,0,0.3);
    }

    .providers-cta-text {
        font-size: 1.3rem;
        line-height: 1.6;
        opacity: 0.95;
        margin-bottom: 2rem;
        max-width: 700px;
        margin-left: auto;
        margin-right: auto;
        text-shadow: 1px 1px 4px rgba(0,0,0,0.2);
    }

    .providers-cta-button {
        display: inline-block;
        background: white;
        color: #8B0000;
        padding: 0.5rem 1.2rem;
        border-radius: 50px;
        font-weight: 700;
        font-size: 1.1rem;
        text-decoration: none;
        transition: all 0.3s;
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }

    @media (max-width: 768px) {
        .page-header h1 {
            font-size: 2rem;
        }

        .filters {
            flex-direction: column;
        }

        .filter-group {
            width: 100%;
        }

        .tours-grid {
            grid-template-columns: 1fr;
        }

        .providers-cta {
            padding: 3rem 1rem;
        }

        .providers-cta-title {
            font-size: 1.05rem;
            margin-bottom: 1rem;
        }

        .providers-cta-text {
            font-size: 1rem;
            line-height: 1.5;
            margin-bottom: 1.25rem;
        }

        .providers-cta-button {
            font-size: 0.95rem;
            padding: 0.5rem 1.1rem;
            border-radius: 36px;
        }
    }
</style>
@endsection

@section('extra_scripts')
<!-- Schema.org JSON-LD - Tours Collection -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "CollectionPage",
    "name": "{{ __('tours.listing_title') }}",
    "description": "{{ __('tours.listing_meta_description') }}",
    "url": "{{ url()->current() }}",
    "mainEntity": {
        "@type": "ItemList",
        "itemListElement": [
            @php
                $toursArray = \App\Models\Tour::get();
            @endphp
            @foreach($toursArray as $index => $tour)
            {
                "@type": "ListItem",
                "position": {{ $index + 1 }},
                "item": {
                    "@type": "TouristAttraction",
                    "@id": "{{ url('/es/tour/' . $tour->slug) }}",
                    "name": "{{ addslashes($tour->name) }}",
                    "description": "{{ addslashes(substr($tour->description, 0, 160)) }}",
                    "image": "{{ $tour->images->first()?->url ?? asset('images/default-tour.jpg') }}",
                    "url": "{{ url('/es/tour/' . $tour->slug) }}",
                    "aggregateRating": {
                        "@type": "AggregateRating",
                        "ratingValue": "{{ $tour->rating ?? 4.5 }}",
                        "reviewCount": "{{ $tour->reviews?->count() ?? 0 }}"
                    }
                }
            }{{ $loop->last ? '' : ',' }}
            @endforeach
        ]
    }
}
</script>

<script>
    const allTours = {!! json_encode($allToursData) !!};
    const filteredTours = {!! json_encode($filteredToursData) !!};

    const urlParams = new URLSearchParams(window.location.search);
    const destinationId = urlParams.get('destination_id');

    function renderTours(tours) {
        const grid = document.getElementById('toursGrid');
        const count = document.getElementById('tourCount');
        
        grid.innerHTML = '';
        count.textContent = tours.length;

        if (tours.length === 0) {
            grid.innerHTML = '<div style="grid-column: 1 / -1; text-align: center; padding: 3rem;">{{ app()->getLocale() === "es" ? "No hay tours disponibles para este destino" : "No tours available for this destination" }}</div>';
            return;
        }

        tours.forEach(tour => {
            const card = `
                <div class="tour-card">
                    <div class="tour-image-wrapper">
                        <picture>
                            ${tour.image_webp ? `<source type='image/webp' srcset='${tour.image_webp}'>` : ''}
                            <img src="${tour.image_jpg}" alt="${tour.alt_text}" class="tour-image" loading="lazy">
                        </picture>
                        ${tour.badge ? `<div class="tour-badge">${tour.badge}</div>` : ''}
                    </div>
                    <div class="tour-content">
                        ${tour.category ? `<div class="tour-category">${tour.category}</div>` : ''}
                        <h3 class="tour-title">${tour.title}</h3>
                        <p class="tour-description">${tour.description}</p>
                        <div class="tour-features">
                            ${tour.duration ? `<div class="feature"><span>⏱️</span> ${tour.duration}</div>` : ''}
                            ${tour.people ? `<div class="feature"><span>👥</span> ${tour.people}</div>` : ''}
                        </div>
                        <div class="tour-footer">
                            ${tour.price ? `<div class="tour-price">
                                $${tour.price}
                                <small>{{ app()->getLocale() === "es" ? "por persona" : "per person" }}</small>
                            </div>` : ''}
                            <a href="${tour.url}" class="tour-button">{{ app()->getLocale() === "es" ? "Ver Tour" : "View Tour" }}</a>
                        </div>
                    </div>
                </div>
            `;
            grid.innerHTML += card;
        });
    }

    function applyFilters() {
        alert('{{ app()->getLocale() === "es" ? "Filtros aplicados (funcionalidad completa en siguiente fase)" : "Filters applied (full functionality in next phase)" }}');
    }

    renderTours(filteredTours.length > 0 ? filteredTours : allTours);
</script>
@endsection

@section('content')
<div class="content-box">
    <!-- Page Header 
    <div class="page-header">
        <img src="{{ asset('images/parqManuelAntonio/playa-parque-nacional-manuel-antonio.jpg') }}" alt="Costa Rica Tours" class="page-header-image" loading="eager" fetchpriority="high">
        <div class="page-header-overlay">
            <div class="page-header-content">
                <h1>{{ __('tours.listing_title') }}</h1>
            </div>
        </div>
    </div> -->

<!-- Filters -->
<div class="filters-section">
    <!--<div class="container">
        <h1>{{ __('tours.listing_title') }}</h1>
        <p class="subtitle">{{ __('tours.listing_subtitle') }}</p>
        <div class="filters">
            <div class="filter-group">
                <label>{{ __('tours.filter_destination') }}</label>
                <select id="destinoFilter">
                    <option value="">{{ __('tours.all_destinations') }}</option>
                    <option value="arenal">Arenal</option>
                    <option value="manuel-antonio">Manuel Antonio</option>
                    <option value="monteverde">Monteverde</option>
                    <option value="tortuguero">Tortuguero</option>
                    <option value="tamarindo">Tamarindo</option>
                </select>
            </div>

            <div class="filter-group">
                <label>{{ __('tours.filter_duration') }}</label>
                <select id="durationFilter">
                    <option value="">{{ app()->getLocale() === 'es' ? 'Todas las duraciones' : 'All durations' }}</option>
                    <option value="1">{{ app()->getLocale() === 'es' ? '1 día' : '1 day' }}</option>
                    <option value="2">{{ app()->getLocale() === 'es' ? '2-3 días' : '2-3 days' }}</option>
                    <option value="4">{{ app()->getLocale() === 'es' ? '4+ días' : '4+ days' }}</option>
                </select>
            </div>

            <div class="filter-group">
                <label>{{ __('tours.filter_price') }}</label>
                <input type="number" id="priceFilter" placeholder="$500" min="0">
            </div>

            <button class="filter-button" onclick="applyFilters()">{{ __('tours.apply_filters') }}</button>
        </div>
    </div>-->
</div>

<!-- Tours Section -->
<section class="tours-section">
    <div class="container">
        <div class="section-info">
            <p class="tours-count">{{ __('tours.showing_results') }} <strong id="tourCount">10</strong> {{ __('tours.results') }}</p>
        </div>

        <div class="tours-grid" id="toursGrid">
            <!-- Tours loaded by JavaScript -->
        </div>

        <div class="pagination">
            <a href="#" class="page-link active">1</a>
            <a href="#" class="page-link">2</a>
            <a href="#" class="page-link">3</a>
            <a href="#" class="page-link">→</a>
        </div>
    </div>
</section>

<!-- CTA Section for Service Providers -->
<section class="providers-cta">
    <video class="providers-cta-video" autoplay muted loop playsinline preload="metadata" aria-hidden="true">
        <source src="{{ asset('videos/tours_costa_rica_1.mp4') }}" type="video/mp4">
    </video>
    <div class="container providers-cta-content">
        <h5 class="providers-cta-title">
            {{ app()->getLocale() === 'es' ? '¿Eres un Operador de Tours?' : 'Are you a Tour Operator?' }}
        </h5>
        <p class="providers-cta-text">
            {{ app()->getLocale() === 'es' ? '¡Registra tus tours en nuestra plataforma! Alcanza a miles de viajeros que buscan experiencias únicas en Costa Rica' : 'Register your tours on our platform! Reach thousands of travelers looking for unique experiences in Costa Rica' }}
        </p>
        <a href="{{ app()->getLocale() === 'es' ? '/es/registrar_servicio' : '/en/register_service' }}" 
           class="providers-cta-button">
            {{ app()->getLocale() === 'es' ? '➕ Registra tu Tour' : '➕ Register Your Tour' }}
        </a>
    </div>
</section>
</div><!-- End Content Box -->
@endsection
