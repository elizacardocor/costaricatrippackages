@extends('layouts.master')

@section('title', __('tours.listing_title'))
@section('meta_description', __('tours.listing_meta_description'))
@section('meta_keywords', 'tours Costa Rica, paquetes turísticos, aventuras, volcanes, selva tropical')

@section('og_title', __('tours.listing_og_title'))
@section('og_description', __('tours.listing_og_description'))
@section('og_image', asset('images/og-tours.jpg'))

@section('canonical')
<link rel="canonical" href="{{ url()->current() }}">
<link rel="alternate" hreflang="es" href="{{ route('tours.index.es') }}">
<link rel="alternate" hreflang="en" href="{{ route('tours.index.en') }}">
@endsection

@section('extra_styles')
<style>
    /* Estilos específicos de la página de tours */
    .page-header {
        margin-top: 80px;
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        color: white;
        padding: 4rem 2rem;
        text-align: center;
    }

    .page-header h1 {
        font-size: 3rem;
        margin-bottom: 1rem;
    }

    .tours-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 2rem;
        padding: 3rem 0;
    }

    .tour-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        transition: all 0.3s;
    }

    .tour-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.15);
    }

    .tour-image {
        width: 100%;
        height: 220px;
        object-fit: cover;
    }

    .tour-content {
        padding: 1.5rem;
    }

    .tour-title {
        font-size: 1.3rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .tour-price {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--primary-color);
    }
</style>
@endsection

@section('content')
<!-- Page Header -->
<section class="page-header">
    <h1>{{ __('tours.listing_title') }}</h1>
    <p>{{ __('tours.listing_subtitle') }}</p>
</section>

<!-- Tours Grid -->
<section class="container">
    <div class="tours-grid">
        @foreach($tours as $tour)
        <div class="tour-card">
            <img src="{{ $tour->images->first()?->image_path ?? 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=600&q=80' }}" alt="{{ $tour->name }}" class="tour-image">
            <div class="tour-content">
                <h3 class="tour-title">{{ $tour->name }}</h3>
                <p>{{ Str::limit($tour->description, 100) }}</p>
                <div class="tour-price">${{ $tour->pricing->first()?->price ?? '199' }}</div>
                <a href="{{ route(app()->getLocale() === 'es' ? 'tour.show.es' : 'tour.show.en', $tour->slug) }}" class="btn btn-primary">
                    {{ app()->getLocale() === 'es' ? 'Ver detalles' : 'View details' }}
                </a>
            </div>
        </div>
        @endforeach
    </div>
</section>
@endsection

@section('extra_scripts')
<script>
    // Scripts específicos de la página de tours
    console.log('Tours page loaded');
</script>
@endsection
