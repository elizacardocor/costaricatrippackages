@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="breadcrumb mb-4">
        <a href="/">Home</a> /
        <a href="/{{ $locale }}/provincia/{{ $province_slug }}">Provincia</a> /
        <span>{{ $destination_slug }}</span>
    </div>

    <h1 class="mb-4">{{ ucwords(str_replace('-', ' ', $destination_slug)) }}</h1>
    
    <div class="row">
        <div class="col-lg-8">
            <div class="section">
                <h2>Acerca de este destino</h2>
                <p>Información detallada sobre {{ ucwords(str_replace('-', ' ', $destination_slug)) }} irá aquí una vez que la BD esté lista.</p>
                <!-- Una vez creada la BD:
                <p>{{ $destination->description }}</p>
                -->
            </div>

            <div class="section">
                <h2>Hoteles Disponibles</h2>
                <div class="row">
                    <!-- Una vez creada la BD:
                    @forelse($destination->hotels as $hotel)
                        <div class="col-md-6 mb-4">
                            <div class="card">
                                <img src="{{ $hotel->images->first()?->url }}" class="card-img-top" alt="{{ $hotel->name }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $hotel->name }}</h5>
                                    <p class="card-text">{{ Str::limit($hotel->description, 100) }}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="badge bg-primary">⭐ {{ $hotel->reviews->avg('rating') }}</span>
                                        <a href="{{ route('hotel.show', ['locale' => $locale, 'province_slug' => $province_slug, 'destination_slug' => $destination_slug, 'hotel_slug' => $hotel->slug]) }}" class="btn btn-sm btn-primary">Ver Detalles</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p>No hay hoteles disponibles en este destino.</p>
                    @endforelse
                    -->
                    <p>Los hoteles aparecerán aquí una vez que la BD esté lista.</p>
                </div>
            </div>

            <div class="section">
                <h2>Tours Disponibles</h2>
                <div class="row">
                    <!-- Una vez creada la BD:
                    @forelse($destination->tours as $tour)
                        <div class="col-md-6 mb-4">
                            <div class="card">
                                <img src="{{ $tour->images->first()?->url }}" class="card-img-top" alt="{{ $tour->name }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $tour->name }}</h5>
                                    <p class="card-text">Duración: {{ $tour->duration_hours }}h</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="badge bg-success">⭐ {{ $tour->reviews->avg('rating') }}</span>
                                        <a href="{{ route('tour.show', ['locale' => $locale, 'province_slug' => $province_slug, 'destination_slug' => $destination_slug, 'tour_slug' => $tour->slug]) }}" class="btn btn-sm btn-primary">Ver Detalles</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p>No hay tours disponibles en este destino.</p>
                    @endforelse
                    -->
                    <p>Los tours aparecerán aquí una vez que la BD esté lista.</p>
                </div>
            </div>

            <div class="section">
                <h2>Servicios de Transporte</h2>
                <div class="row">
                    <!-- Una vez creada la BD:
                    @forelse($destination->transports as $transport)
                        <div class="col-md-6 mb-4">
                            <div class="card">
                                <img src="{{ $transport->images->first()?->url }}" class="card-img-top" alt="{{ $transport->name }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $transport->name }}</h5>
                                    <p class="card-text">{{ $transport->vehicle_type }} - Capacidad: {{ $transport->capacity }} personas</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="badge bg-info">⭐ {{ $transport->reviews->avg('rating') }}</span>
                                        <a href="{{ route('transport.show', ['locale' => $locale, 'province_slug' => $province_slug, 'destination_slug' => $destination_slug, 'transport_slug' => $transport->slug]) }}" class="btn btn-sm btn-primary">Ver Detalles</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p>No hay servicios de transporte disponibles en este destino.</p>
                    @endforelse
                    -->
                    <p>Los transportes aparecerán aquí una vez que la BD esté lista.</p>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Main Actions Card -->
            <div class="card sticky-top destination-actions-card">
                <div class="card-body">
                    <h5 class="card-title">{{ app()->getLocale() === 'es' ? 'Servicios Disponibles' : 'Available Services' }}</h5>
                    
                    <!-- Hotels Button -->
                    <a href="/{{ $locale }}/provincia/{{ $province_slug }}/destino/{{ $destination_slug }}/hotel/dummy" class="btn btn-outline-primary w-100 mb-3 action-button">
                        <span class="button-icon">🏨</span>
                        <span class="button-text">{{ app()->getLocale() === 'es' ? 'Hoteles' : 'Hotels' }}</span>
                    </a>
                    
                    <!-- Tours Button -->
                    <a href="/{{ $locale }}/provincia/{{ $province_slug }}/destino/{{ $destination_slug }}/tour/dummy" class="btn btn-outline-success w-100 mb-3 action-button">
                        <span class="button-icon">🌴</span>
                        <span class="button-text">{{ app()->getLocale() === 'es' ? 'Tours' : 'Tours' }}</span>
                    </a>
                    
                    <!-- Transport Button -->
                    <a href="/{{ $locale }}/provincia/{{ $province_slug }}/destino/{{ $destination_slug }}/transport/dummy" class="btn btn-outline-info w-100 mb-3 action-button">
                        <span class="button-icon">🚐</span>
                        <span class="button-text">{{ app()->getLocale() === 'es' ? 'Transporte' : 'Transport' }}</span>
                    </a>
                    
                    <!-- Build Your Plan Button -->
                    <button class="btn btn-primary w-100 action-button" data-bs-toggle="modal" data-bs-target="#buildPlanModal">
                        <span class="button-icon">✨</span>
                        <span class="button-text">{{ app()->getLocale() === 'es' ? 'Arma tu Plan' : 'Build Your Plan' }}</span>
                    </button>
                </div>
            </div>

            <!-- Info Card -->
            <div class="card mt-3">
                <div class="card-body">
                    <h5 class="card-title">{{ app()->getLocale() === 'es' ? 'Información del Destino' : 'Destination Info' }}</h5>
                    <p><strong>{{ app()->getLocale() === 'es' ? 'Ubicación:' : 'Location:' }}</strong> {{ ucwords(str_replace('-', ' ', $province_slug)) }}</p>
                    <p><strong>{{ app()->getLocale() === 'es' ? 'Destino:' : 'Destination:' }}</strong> {{ ucwords(str_replace('-', ' ', $destination_slug)) }}</p>
                    <button class="btn btn-outline-secondary w-100" data-bs-toggle="modal" data-bs-target="#contactModal">
                        {{ app()->getLocale() === 'es' ? 'Contactar Ahora' : 'Contact Now' }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .breadcrumb {
        font-size: 0.9rem;
    }
    
    .breadcrumb a {
        color: var(--primary-color);
        text-decoration: none;
    }
    
    .breadcrumb a:hover {
        text-decoration: underline;
    }
    
    .section {
        margin-bottom: 3rem;
    }
    
    .card {
        border: none;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        transition: transform 0.3s;
    }
    
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 20px rgba(0,0,0,0.15);
    }

    /* Destination Actions Card Styles */
    .destination-actions-card {
        border: 2px solid #00A86B;
        background: linear-gradient(135deg, rgba(0,168,107,0.05) 0%, rgba(0,102,204,0.05) 100%);
    }

    .action-button {
        display: flex !important;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        padding: 0.8rem !important;
        font-weight: 600;
        transition: all 0.3s;
        border-radius: 10px;
    }

    .action-button:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }

    .action-button .button-icon {
        font-size: 1.3rem;
    }

    .action-button .button-text {
        font-size: 0.95rem;
    }

    .btn-outline-primary:hover {
        background-color: #00A86B;
        border-color: #00A86B;
        color: white;
    }

    .btn-outline-success:hover {
        background-color: #28a745;
        border-color: #28a745;
        color: white;
    }

    .btn-outline-info:hover {
        background-color: #17a2b8;
        border-color: #17a2b8;
        color: white;
    }

    .btn-primary {
        background-color: #0066CC;
        border-color: #0066CC;
    }

    .btn-primary:hover {
        background-color: #0052a3;
        border-color: #0052a3;
    }
</style>

<!-- Build Your Plan Modal -->
<div class="modal fade" id="buildPlanModal" tabindex="-1" aria-labelledby="buildPlanLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="buildPlanLabel">
                    {{ app()->getLocale() === 'es' ? 'Arma tu Plan' : 'Build Your Plan' }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>{{ app()->getLocale() === 'es' ? '¡Crea un itinerario personalizado para tu viaje a ' : 'Create a personalized itinerary for your trip to ' }}{{ ucwords(str_replace('-', ' ', $destination_slug)) }}!</p>
                
                <form>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">{{ app()->getLocale() === 'es' ? 'Nombre' : 'Name' }}</label>
                            <input type="text" class="form-control" placeholder="{{ app()->getLocale() === 'es' ? 'Tu nombre' : 'Your name' }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">{{ app()->getLocale() === 'es' ? 'Email' : 'Email' }}</label>
                            <input type="email" class="form-control" placeholder="email@example.com">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">{{ app()->getLocale() === 'es' ? 'Fecha de Inicio' : 'Start Date' }}</label>
                            <input type="date" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">{{ app()->getLocale() === 'es' ? 'Duración (días)' : 'Duration (days)' }}</label>
                            <input type="number" class="form-control" min="1" max="30" placeholder="5">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">{{ app()->getLocale() === 'es' ? 'Servicios de Interés' : 'Services of Interest' }}</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="planHotels" checked>
                            <label class="form-check-label" for="planHotels">
                                🏨 {{ app()->getLocale() === 'es' ? 'Hoteles' : 'Hotels' }}
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="planTours" checked>
                            <label class="form-check-label" for="planTours">
                                🌴 {{ app()->getLocale() === 'es' ? 'Tours' : 'Tours' }}
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="planTransport" checked>
                            <label class="form-check-label" for="planTransport">
                                🚐 {{ app()->getLocale() === 'es' ? 'Transporte' : 'Transport' }}
                            </label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">{{ app()->getLocale() === 'es' ? 'Preferencias' : 'Preferences' }}</label>
                        <textarea class="form-control" rows="3" placeholder="{{ app()->getLocale() === 'es' ? 'Cuéntanos qué tipo de experiencias buscas...' : 'Tell us what kind of experiences you\'re looking for...' }}"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    {{ app()->getLocale() === 'es' ? 'Cancelar' : 'Cancel' }}
                </button>
                <button type="button" class="btn btn-primary">
                    {{ app()->getLocale() === 'es' ? 'Enviar Solicitud' : 'Send Request' }}
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Contact Modal -->
<div class="modal fade" id="contactModal" tabindex="-1" aria-labelledby="contactLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="contactLabel">
                    {{ app()->getLocale() === 'es' ? 'Contactar Ahora' : 'Contact Now' }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>{{ app()->getLocale() === 'es' ? 'Ponte en contacto con nuestro equipo para más información sobre ' : 'Get in touch with our team for more information about ' }}{{ ucwords(str_replace('-', ' ', $destination_slug)) }}</p>
                
                <form>
                    <div class="mb-3">
                        <label class="form-label">{{ app()->getLocale() === 'es' ? 'Nombre' : 'Name' }}</label>
                        <input type="text" class="form-control" placeholder="{{ app()->getLocale() === 'es' ? 'Tu nombre' : 'Your name' }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ app()->getLocale() === 'es' ? 'Email' : 'Email' }}</label>
                        <input type="email" class="form-control" placeholder="email@example.com">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ app()->getLocale() === 'es' ? 'Teléfono' : 'Phone' }}</label>
                        <input type="tel" class="form-control" placeholder="+506 1234-5678">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ app()->getLocale() === 'es' ? 'Mensaje' : 'Message' }}</label>
                        <textarea class="form-control" rows="3" placeholder="{{ app()->getLocale() === 'es' ? 'Tu mensaje...' : 'Your message...' }}"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    {{ app()->getLocale() === 'es' ? 'Cerrar' : 'Close' }}
                </button>
                <button type="button" class="btn btn-primary">
                    {{ app()->getLocale() === 'es' ? 'Enviar' : 'Send' }}
                </button>
            </div>
        </div>
    </div>
</div>

@endsection
