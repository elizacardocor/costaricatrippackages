@extends('layouts.app')

<style>
    /* Estilos personalizados para el formulario de registro */
    .card {
        border: none;
        border-radius: 12px;
        overflow: hidden;
    }
    
    .card-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 2rem;
    }
    
    .card-header h2 {
        font-weight: 700;
        font-size: 1.8rem;
        margin-bottom: 0.5rem;
    }
    
    .card-header p {
        font-size: 0.95rem;
        opacity: 0.9;
    }
    
    .card-body {
        padding: 2.5rem;
    }
    
    /* Títulos de sección */
    .section-title {
        margin-top: 2rem;
        margin-bottom: 1.5rem;
    }
    
    .section-title h4 {
        font-weight: 700;
        color: #333;
        font-size: 1.3rem;
        margin-bottom: 0.5rem;
    }
    
    .section-title hr {
        border: none;
        border-top: 2px solid #667eea;
        margin: 0.5rem 0 0 0;
    }
    
    /* Formularios */
    .form-label {
        font-weight: 600;
        color: #333;
        margin-bottom: 0.5rem;
        font-size: 0.95rem;
    }
    
    .form-control, .form-select {
        border-radius: 8px;
        border: 1.5px solid #e0e0e0;
        padding: 0.75rem 1rem;
        font-size: 0.95rem;
        transition: all 0.3s ease;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.15);
    }
    
    .form-control.is-invalid, .form-select.is-invalid {
        border-color: #dc3545;
    }
    
    .form-control.is-invalid:focus, .form-select.is-invalid:focus {
        box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.15);
    }
    
    textarea.form-control {
        resize: vertical;
        min-height: 100px;
    }
    
    /* Alertas */
    .alert {
        border: none;
        border-radius: 8px;
        border-left: 4px solid;
    }
    
    .alert-info {
        background-color: #e7f3ff;
        border-left-color: #667eea;
        color: #004085;
    }
    
    .alert-danger {
        background-color: #ffe7e7;
        border-left-color: #dc3545;
    }
    
    .alert ul {
        margin-bottom: 0;
        padding-left: 1.5rem;
    }
    
    /* Radio y Checkboxes */
    .form-check {
        margin: 0.75rem 0;
        padding: 0.75rem 1rem;
        background-color: #f8f9fa;
        border-radius: 8px;
        border: 1px solid #dee2e6;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .form-check:hover {
        background-color: #f0f1ff;
        border-color: #667eea;
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.1);
    }
    
    .form-check-input {
        width: 1.5em;
        height: 1.5em;
        border-radius: 6px;
        cursor: pointer;
        border: 2px solid #ccc;
        transition: all 0.3s ease;
        margin-top: 0.25em;
    }
    
    .form-check-input:hover {
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }
    
    .form-check-input:checked {
        background-color: #667eea;
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.2);
    }
    
    .form-check-label {
        margin-left: 0.75rem;
        cursor: pointer;
        font-size: 1rem;
        font-weight: 500;
        color: #333;
    }
    
    /* Botones */
    .btn {
        border-radius: 8px;
        font-weight: 600;
        padding: 0.75rem 1.5rem;
        transition: all 0.3s ease;
        border: none;
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
    }

    /* Input File */
    .form-control[type="file"] {
        padding: 1rem 1.25rem;
        border: 2px dashed #667eea;
        background-color: #f8f9ff;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s ease;
        font-weight: 500;
    }

    .form-control[type="file"]:hover {
        background-color: #f0f1ff;
        border-color: #764ba2;
        box-shadow: 0 6px 16px rgba(102, 126, 234, 0.15);
    }

    .form-control[type="file"]:focus {
        border-color: #667eea;
        background-color: #ffffff;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    /* Botones secundarios (Agregar imagen, Eliminar) */
    #addImageBtn, .remove-image-btn {
        border-radius: 8px;
        font-weight: 600;
        padding: 0.65rem 1.25rem;
        transition: all 0.3s ease;
        border: none;
    }

    #addImageBtn {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        width: 100%;
        font-size: 1rem;
        padding: 0.85rem 1.5rem;
        margin-top: 0.5rem;
    }

    #addImageBtn:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
        color: white;
        text-decoration: none;
    }

    #addImageBtn:active {
        transform: translateY(0);
    }

    .remove-image-btn {
        background-color: #dc3545;
        color: white;
        padding: 0.5rem 0.75rem;
        border: none;
    }

    .remove-image-btn:hover {
        background-color: #c82333;
        transform: scale(1.05);
        box-shadow: 0 6px 12px rgba(220, 53, 69, 0.3);
        color: white;
    }

    /* Contenedor de input file dinámicos */
    .image-input-group {
        background-color: #f8f9fa;
        padding: 1rem;
        border-radius: 8px;
        border: 1px solid #dee2e6;
        transition: all 0.3s ease;
    }

    .image-input-group:hover {
        background-color: #f0f1ff;
        border-color: #667eea;
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.1);
    }
        color: white;
    }
    
    .btn-outline-danger {
        border: 1px solid #dc3545;
        color: #dc3545;
    }
    
    .btn-outline-danger:hover {
        background-color: #dc3545;
        color: white;
    }
    
    /* Contenedor de botones */
    .d-flex.gap-2 {
        gap: 1rem;
    }
    
    .btn-lg {
        padding: 1rem 2rem;
        font-size: 1.05rem;
    }
    
    /* Input de imágenes */
    .image-input-group {
        padding: 0.5rem;
        background-color: #f8f9fa;
        border-radius: 8px;
    }
    
    /* Espaciado */
    .mb-3 {
        margin-bottom: 1.5rem;
    }
    
    .row > div {
        margin-bottom: 0;
    }
    
    /* Contador de imágenes */
    #imageCount {
        font-weight: 700;
        color: #667eea;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .card-body {
            padding: 1.5rem;
        }
        
        .card-header {
            padding: 1.5rem;
        }
        
        .card-header h2 {
            font-size: 1.5rem;
        }
    }
</style>

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white">
                    <h2 class="mb-0">{{ __('Registra tu Servicio') }}</h2>
                    <p class="small mb-0">{{ app()->getLocale() === 'es' ? 'Hotel, Tour o Transporte' : 'Hotel, Tour or Transport' }}</p>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{ __('Error en el formulario:') }}</strong>
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form action="{{ app()->getLocale() === 'es' ? route('listings.store.es') : route('listings.store.en') }}" method="POST" enctype="multipart/form-data" id="listingForm">
                        @csrf

                        <!-- Información de Contacto -->
                        <div class="section-title mb-4">
                            <h4>{{ __('Información de Contacto') }}</h4>
                            <hr>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="contact_name" class="form-label">{{ __('Nombre Completo') }} *</label>
                                <input type="text" name="contact_name" id="contact_name" class="form-control @error('contact_name') is-invalid @enderror" 
                                    value="{{ old('contact_name') }}" required>
                                @error('contact_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="contact_email" class="form-label">{{ __('Email') }} *</label>
                                <input type="email" name="contact_email" id="contact_email" class="form-control @error('contact_email') is-invalid @enderror" 
                                    value="{{ old('contact_email') }}" required>
                                @error('contact_email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="contact_phone" class="form-label">{{ __('Teléfono') }} *</label>
                                <input type="tel" name="contact_phone" id="contact_phone" class="form-control @error('contact_phone') is-invalid @enderror" 
                                    value="{{ old('contact_phone') }}" required>
                                @error('contact_phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="contact_address" class="form-label">{{ __('Dirección (Opcional)') }}</label>
                                <input type="text" name="contact_address" id="contact_address" class="form-control" 
                                    value="{{ old('contact_address') }}">
                            </div>
                        </div>

                        <!-- Información del Servicio -->
                        <div class="section-title mb-4">
                            <h4>{{ __('Información del Servicio') }}</h4>
                            <hr>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="destination_id" class="form-label">{{ __('Destino') }} *</label>
                                <select name="destination_id" id="destination_id" class="form-select @error('destination_id') is-invalid @enderror" required>
                                    <option value="">{{ __('Selecciona un destino') }}</option>
                                    @foreach($destinations as $destination)
                                        <option value="{{ $destination->id }}" @selected(old('destination_id') == $destination->id)>
                                            {{ $destination->name ?? __('destinations.' . $destination->slug . '.title') }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('destination_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="service_type" class="form-label">{{ __('Tipo de Servicio') }} *</label>
                                <select name="service_type" id="service_type" class="form-select @error('service_type') is-invalid @enderror" required onchange="updateServiceFields()">
                                    <option value="">{{ __('Selecciona un tipo') }}</option>
                                    <option value="hotel" @selected(old('service_type') == 'hotel')>{{ __('Hotel') }}</option>
                                    <option value="tour" @selected(old('service_type') == 'tour')>{{ __('Tour') }}</option>
                                    <option value="transport" @selected(old('service_type') == 'transport')>{{ __('Transporte') }}</option>
                                </select>
                                @error('service_type') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <!-- Campos Dinámicos por Tipo de Servicio -->
                        <div id="serviceFields" class="dynamic-fields">
                            <!-- Se llenan dinámicamente -->
                        </div>

                        <!-- Precios por Temporada -->
                        <div class="section-title mb-4" id="pricesSection" style="display: none;">
                            <h4>{{ __('Precios por Temporada') }}</h4>
                            <hr>
                        </div>

                        <div id="priceFields" class="mb-3">
                            <!-- Se llenan dinámicamente -->
                        </div>

                        <!-- Botones -->
                        <div class="d-flex gap-2 mt-4">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="bi bi-check-circle"></i> {{ __('Registrar Servicio') }}
                            </button>
                            <a href="{{ app()->getLocale() === 'es' ? '/es/' : '/en/' }}" class="btn btn-secondary btn-lg">
                                <i class="bi bi-x-circle"></i> {{ __('Cancelar') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Info Box -->
            <div class="alert alert-info mt-4">
                <i class="bi bi-info-circle"></i>
                <strong>{{ __('Información Importante:') }}</strong>
                <ul class="mb-0 mt-2">
                    <li>{{ __('Todos los campos marcados con * son obligatorios') }}</li>
                    <li>{{ app()->getLocale() === 'es' ? 'Sin necesidad de registro o login' : 'No registration or login required' }}</li>
                    <li>{{ app()->getLocale() === 'es' ? 'Guardamos tus datos de contacto para verificar tu servicio' : 'We save your contact info to verify your service' }}</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<style>
    .section-title {
        border-top: 2px solid #007bff;
        padding-top: 1rem;
    }

    .dynamic-fields {
        background-color: #f8f9fa;
        padding: 1.5rem;
        border-radius: 0.5rem;
        margin-bottom: 2rem;
    }

    .form-section {
        margin-bottom: 1.5rem;
    }

    .form-section h5 {
        color: #495057;
        font-weight: 600;
        margin-bottom: 1rem;
        border-bottom: 1px solid #dee2e6;
        padding-bottom: 0.5rem;
    }

    .operator-fields {
        background-color: #fff3cd;
        padding: 1rem;
        border-radius: 0.5rem;
        margin-top: 1rem;
        border-left: 4px solid #ffc107;
    }
</style>

<script>
    const rateTypes = @json($rateTypes);

    function updateServiceFields() {
        const serviceType = document.getElementById('service_type').value;
        const fieldsDiv = document.getElementById('serviceFields');
        const pricesSection = document.getElementById('pricesSection');
        const priceFields = document.getElementById('priceFields');

        fieldsDiv.innerHTML = '';
        priceFields.innerHTML = '';

        if (!serviceType) {
            pricesSection.style.display = 'none';
            return;
        }

        pricesSection.style.display = 'block';

        // Mostrar campos según tipo de servicio
        if (serviceType === 'hotel') {
            fieldsDiv.innerHTML = `
                <div class="form-section">
                    <h5>{{ __('Información del Hotel') }}</h5>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="hotel_name" class="form-label">{{ __('Nombre del Hotel') }} *</label>
                            <input type="text" name="hotel_name" id="hotel_name" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="hotel_stars" class="form-label">{{ __('Estrellas (1-5)') }}</label>
                            <input type="number" name="hotel_stars" id="hotel_stars" class="form-control" min="1" max="5">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="hotel_description" class="form-label">{{ __('Descripción') }}</label>
                        <textarea name="hotel_description" id="hotel_description" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="hotel_image" class="form-label">{{ __('Imagen Principal') }} *</label>
                        <input type="file" name="hotel_image" id="hotel_image" class="form-control" accept="image/*" required>
                        <small class="text-muted">{{ __('Resolución recomendada: 1200x800px. Se comprimirá automáticamente.') }}</small>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">{{ __('Imágenes Adicionales (Hasta 9)') }}</label>
                        <div class="alert alert-info alert-sm" role="alert">
                            <strong>{{ __('Mismos requisitos que la imagen principal.') }}</strong><br>
                            {{ __('Sugerencia: sube fotos de habitaciones, piscina, restaurante, vistas y áreas comunes para mejor presentación.') }}
                        </div>
                        
                        <div id="additionalImagesContainer">
                            <!-- Los inputs se agregan dinámicamente aquí -->
                        </div>
                        
                        <button type="button" id="addImageBtn" class="btn btn-primary mt-2">
                            <i class="bi bi-cloud-upload"></i> {{ __('Agregar más imágenes') }}
                        </button>
                        <small class="d-block mt-2 text-muted">
                            <i class="bi bi-info-circle"></i> {{ __('Imágenes agregadas:') }} <strong><span id="imageCount">0</span>/9</strong>
                        </small>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="hotel_address" class="form-label">{{ __('Dirección') }}</label>
                            <input type="text" name="hotel_address" id="hotel_address" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="hotel_phone" class="form-label">{{ __('Teléfono') }}</label>
                            <input type="tel" name="hotel_phone" id="hotel_phone" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="hotel_website" class="form-label">{{ __('Sitio Web') }}</label>
                            <input type="url" name="hotel_website" id="hotel_website" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="hotel_rooms" class="form-label">{{ __('Cantidad de Habitaciones') }}</label>
                            <input type="number" name="hotel_rooms" id="hotel_rooms" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="hotel_commission" class="form-label">{{ __('Comisión (%)') }}</label>
                            <input type="number" name="hotel_commission" id="hotel_commission" class="form-control" step="0.01" min="0" max="100" placeholder="0.00">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="hotel_checkin" class="form-label">{{ __('Hora de Check-in') }}</label>
                            <input type="time" name="hotel_checkin" id="hotel_checkin" class="form-control" value="14:00">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="hotel_checkout" class="form-label">{{ __('Hora de Check-out') }}</label>
                            <input type="time" name="hotel_checkout" id="hotel_checkout" class="form-control" value="11:00">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('Amenidades') }}</label>
                        <div class="amenities-list" id="amenitiesList" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 10px;">
                            @forelse ($amenities as $amenity)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="hotel_amenities[]" 
                                        value="{{ $amenity->id }}" id="amenity_{{ $amenity->id }}">
                                    <label class="form-check-label" for="amenity_{{ $amenity->id }}">
                                        {{ $amenity->name ?? $amenity->amenity }}
                                    </label>
                                </div>
                            @empty
                                <p class="text-muted">{{ __('No hay amenidades disponibles') }}</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            `;
        } 
        else if (serviceType === 'tour') {
            fieldsDiv.innerHTML = `
                <div class="form-section">
                    <h5>{{ __('Información del Tour') }}</h5>
                    <div class="mb-3">
                        <label for="tour_name" class="form-label">{{ __('Nombre del Tour') }} *</label>
                        <input type="text" name="tour_name" id="tour_name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="tour_description" class="form-label">{{ __('Descripción') }}</label>
                        <textarea name="tour_description" id="tour_description" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="tour_duration" class="form-label">{{ __('Duración (horas)') }}</label>
                            <input type="number" name="tour_duration" id="tour_duration" class="form-control" step="0.5">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="tour_difficulty" class="form-label">{{ __('Dificultad') }}</label>
                            <select name="tour_difficulty" id="tour_difficulty" class="form-select">
                                <option value="easy">{{ __('Fácil') }}</option>
                                <option value="moderate" selected>{{ __('Moderada') }}</option>
                                <option value="hard">{{ __('Difícil') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="tour_capacity" class="form-label">{{ __('Capacidad Máxima') }}</label>
                        <input type="number" name="tour_capacity" id="tour_capacity" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="tour_commission" class="form-label">{{ __('Comisión (%)') }}</label>
                        <input type="number" name="tour_commission" id="tour_commission" class="form-control" step="0.01" min="0" max="100" placeholder="0.00">
                    </div>

                    <!-- ¿Eres operador de tours? -->
                    <div class="mb-3">
                        <label class="form-label">{{ __('¿Eres operador de tours registrado?') }} *</label>
                        <div class="btn-group w-100" role="group">
                            <input type="radio" class="btn-check" name="is_tour_operator" id="operator_yes" value="yes" required onchange="toggleOperatorFields()">
                            <label class="btn btn-outline-primary" for="operator_yes">{{ __('Sí') }}</label>

                            <input type="radio" class="btn-check" name="is_tour_operator" id="operator_no" value="no" required onchange="toggleOperatorFields()">
                            <label class="btn btn-outline-primary" for="operator_no">{{ __('No') }}</label>
                        </div>
                    </div>

                    <!-- Campos de Operador (solo si dice "Sí") -->
                    <div id="operatorFields" class="operator-fields" style="display: none;">
                        <h6 class="mb-3">{{ __('Información del Operador') }}</h6>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="operator_name" class="form-label">{{ __('Nombre de la Empresa') }} *</label>
                                <input type="text" name="operator_name" id="operator_name" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="operator_phone" class="form-label">{{ __('Teléfono') }} *</label>
                                <input type="tel" name="operator_phone" id="operator_phone" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="operator_website" class="form-label">{{ __('Sitio Web') }}</label>
                                <input type="url" name="operator_website" id="operator_website" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="operator_license" class="form-label">{{ __('Número de Licencia') }}</label>
                                <input type="text" name="operator_license" id="operator_license" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
            `;
        } 
        else if (serviceType === 'transport') {
            fieldsDiv.innerHTML = `
                <div class="form-section">
                    <h5>{{ __('Información del Transporte') }}</h5>
                    <div class="mb-3">
                        <label for="transport_name" class="form-label">{{ __('Nombre de la Empresa') }} *</label>
                        <input type="text" name="transport_name" id="transport_name" class="form-control" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="transport_type" class="form-label">{{ __('Tipo de Transporte') }}</label>
                            <input type="text" name="transport_type" id="transport_type" class="form-control" placeholder="Taxi, Bus, Shuttle, etc.">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="transport_vehicles" class="form-label">{{ __('Cantidad de Vehículos') }}</label>
                            <input type="number" name="transport_vehicles" id="transport_vehicles" class="form-control">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="transport_capacity" class="form-label">{{ __('Capacidad por Vehículo') }}</label>
                        <input type="number" name="transport_capacity" id="transport_capacity" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="transport_commission" class="form-label">{{ __('Comisión (%)') }}</label>
                        <input type="number" name="transport_commission" id="transport_commission" class="form-control" step="0.01" min="0" max="100" placeholder="0.00">
                    </div>
                </div>
            `;
        }

        // Mostrar campos de precios
        priceFields.innerHTML = `
            <div class="row">
                ${rateTypes.map(rateType => `
                    <div class="col-md-6 mb-3">
                        <label for="price_${rateType.id}" class="form-label">{{ __('Precio') }} - ${rateType.name || rateType.type}</label>
                        <div class="input-group">
                            <span class="input-group-text">₡</span>
                            <input type="number" name="prices[${rateType.id}]" id="price_${rateType.id}" 
                                class="form-control" step="0.01" min="0">
                        </div>
                    </div>
                `).join('')}
            </div>
        `;
    }

    function toggleOperatorFields() {
        const isOperator = document.querySelector('input[name="is_tour_operator"]:checked');
        const operatorFields = document.getElementById('operatorFields');
        const operatorInputs = operatorFields.querySelectorAll('input[name^="operator_"]');

        if (isOperator && isOperator.value === 'yes') {
            operatorFields.style.display = 'block';
            // Hacer requeridos los campos de operador
            operatorInputs.forEach(input => {
                if (input.name === 'operator_name' || input.name === 'operator_phone') {
                    input.required = true;
                }
            });
        } else {
            operatorFields.style.display = 'none';
            // Remover requerimiento
            operatorInputs.forEach(input => input.required = false);
        }
    }

    // Inicializar si hay servicio seleccionado
    window.addEventListener('load', function() {
        console.log('Window load disparado');
        
        const serviceType = document.getElementById('service_type');
        if (serviceType && serviceType.value) {
            updateServiceFields();
        }
    });

    /**
     * Manejo dinámico de imágenes adicionales usando delegación de eventos
     */
    let imageCount = 0;

    // Delegación de eventos para el botón "Agregar Imagen"
    document.addEventListener('click', function(e) {
        if (e.target.closest('#addImageBtn')) {
            e.preventDefault();
            e.stopPropagation();
            
            const container = document.getElementById('additionalImagesContainer');
            if (!container) {
                console.error('Contenedor de imágenes no encontrado');
                return;
            }

            console.log('Botón agregar imagen clickeado');
            
            if (imageCount >= 9) {
                alert('{{ __("Máximo 9 imágenes adicionales permitidas") }}');
                return false;
            }

            imageCount++;
            const imageId = `hotel_image_${imageCount}`;
            
            console.log('Agregando imagen #' + imageCount);
            
            const inputGroup = document.createElement('div');
            inputGroup.className = 'input-group mb-2 image-input-group';
            inputGroup.id = `group_${imageId}`;
            inputGroup.innerHTML = `
                <input type="file" name="hotel_images[]" id="${imageId}" class="form-control" accept="image/*">
                <button type="button" class="btn btn-outline-danger btn-sm remove-image-btn">
                    <i class="bi bi-trash"></i>
                </button>
            `;

            container.appendChild(inputGroup);
            updateImageCount();
            
            return false;
        }

        // Delegación para botón de eliminar
        if (e.target.closest('.remove-image-btn')) {
            e.preventDefault();
            e.stopPropagation();
            
            const inputGroup = e.target.closest('.image-input-group');
            if (inputGroup) {
                console.log('Botón eliminar clickeado');
                inputGroup.remove();
                imageCount--;
                updateImageCount();
            }
            
            return false;
        }
    });

    function updateImageCount() {
        const countSpan = document.getElementById('imageCount');
        if (countSpan) {
            countSpan.textContent = imageCount;
            console.log('Count actualizado a: ' + imageCount);
        }
    }
</script>
@endsection
