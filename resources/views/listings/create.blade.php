@extends('layouts.master')

@section('title', app()->getLocale() === 'es' ? 'Registra tu Servicio - Costa Rica Trip Packages' : 'Register Your Service - Costa Rica Trip Packages')
@section('meta_description', app()->getLocale() === 'es' ? 'Registra tu hotel, tour, transporte u otro servicio turístico en nuestra plataforma' : 'Register your hotel, tour, transportation or other tourism service on our platform')

@section('extra_styles')
<style>
    /* Estilos personalizados para el formulario de registro */
    .addTourIncludeBtn {
    background: #10b981;
    color: #fff;
    font-size: 0.92rem;
    padding: 0.25rem 0.7rem;
    border-radius: 6px;
    font-weight: 600;
    border: none;
    box-shadow: none;
    transition: background 0.2s;
    line-height: 1.1;
    margin-top: 0.2rem;
}
.addTourIncludeBtn:hover {
    background: #0e9e6e;
    color: #fff;
}
.card {
        border: none;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    }

    /* Formulario */
    #listingForm {
        border: 2px solid #8B0000;
        padding: 2rem;
        border-radius: 8px;
    }

    /* Grid de 2 columnas en desktop, 1 columna en móvil */
    #listingForm .row {
        display: flex;
        flex-wrap: wrap;
        margin-left: -0.75rem;
        margin-right: -0.75rem;
        margin-bottom: 0.7rem; /* Espaciado entre filas del formulario */
    }

    #listingForm .col-md-6 {
        flex: 0 0 50%;
        max-width: 50%;
        padding-left: 0.75rem;
        padding-right: 0.75rem;
        box-sizing: border-box;
    }

    #listingForm .col-12 {
        flex: 0 0 100%;
        max-width: 100%;
        padding-left: 0.75rem;
        padding-right: 0.75rem;
        box-sizing: border-box;
    }

    .card-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 2rem;
        color: white;
    }
    
    .card-header h2 {
        font-weight: 700;
        font-size: 1.8rem;
        margin-bottom: 0.5rem;
        color: white;
    }
    
    .card-header p {
        font-size: 0.95rem;
        opacity: 0.9;
        color: white;
    }
    
    .card-body {
        padding: 2.5rem;
        background-color: #ffffff;
    }
    
    /* Títulos de sección */
    .section-title {
        margin-top: 2rem;
        margin-bottom: 1.5rem;
        border-top: 2px solid #8B0000;
        padding-top: 1rem;
    }
    
    .section-title h4 {
        font-weight: 400;
        color: #333;
        font-size: 1.3rem;
        margin-bottom: 0.5rem;
    }
    
    .section-title hr {
        border: none;
        border-top: 2px solid #8B0000;
        margin: 0.5rem 0 0 0;
    }

    /* Campos dinámicos */
    .dynamic-fields {
        background-color: #f8f9fa;
        padding: 1.5rem;
        border-radius: 0.5rem;
        margin-bottom: 2rem;
        border: 1px solid #8B0000;
    }

    .form-section {
        margin-bottom: 1.5rem;
        width: 100%;
        margin-left: 0;
        margin-right: 0;
    }



    .form-section h5 {
        color: #495057;
        font-weight: 600;
        margin-bottom: 1rem;
        border-bottom: 1px solid #dee2e6;
        padding-bottom: 0.5rem;
    }

    /* Campos de operador */
    .operator-fields {
        background-color: #fff3cd;
        padding: 1.5rem;
        border-radius: 0.5rem;
        margin-top: 1rem;
        border-left: 4px solid #ffc107;
    }

    .operator-fields h6 {
        color: #856404;
        font-weight: 600;
        margin-bottom: 1rem;
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
        border: 2px solid transparent;
        padding: 0.75rem 1rem;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        background-color: #f8f9fa;
        background-image: linear-gradient(#f8f9fa, #f8f9fa), linear-gradient(135deg, #b0b0b0 0%, #d0d0d0 100%);
        background-origin: border-box;
        background-clip: padding-box, border-box;
        width: 100%;
    }
    
    .form-control:focus, .form-select:focus {
        border: 2px solid transparent;
        background-color: #ffffff;
        background-image: linear-gradient(#ffffff, #ffffff), linear-gradient(135deg, #808080 0%, #b0b0b0 100%);
        background-origin: border-box;
        background-clip: padding-box, border-box;
        box-shadow: none;
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

    /* Input group */
    .input-group-text {
        background-color: #f8f9fa;
        border: none;
        color: #495057;
        font-weight: 600;
        width: auto;
    }

    .form-section .form-control,
    .form-section .form-select,
    .form-section .input-group {
        width: 100%;
    }


    
    /* Alertas */
    .alert {
        border: none;
        border-radius: 8px;
        border-left: 4px solid;
        padding: 1rem 1.25rem;
    }
    
    .alert-info {
        background-color: #ffe8e8;
        border-left-color: #8B0000;
        color: #6B0000;
    }

    .alert-info strong {
        color: #8B0000;
    }
    
    .alert-danger {
        background-color: #ffe7e7;
        border-left-color: #dc3545;
    }
    
    .alert ul {
        margin-bottom: 0;
        padding-left: 1.5rem;
    }

    .alert-sm {
        padding: 0.75rem 1rem;
        font-size: 0.9rem;
    }
    
    /* Radio y Checkboxes */
    .form-check {
        margin: 0.75rem 0;
        padding: 0.75rem 1rem;
        background-color: #f8f9fa;
        border-radius: 8px;
        border: 1px solid #8B0000;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .form-check:hover {
        background-color: #ffe8e8;
        border-color: #8B0000;
        box-shadow: 0 4px 12px rgba(139, 0, 0, 0.1);
    }
    
    .form-check-input {
        width: 1.5em;
        height: 1.5em;
        border-radius: 6px;
        cursor: pointer;
        border: 2px solid #8B0000;
        transition: all 0.3s ease;
        margin-top: 0.25em;
    }
    
    .form-check-input:hover {
        border-color: #8B0000;
        box-shadow: 0 0 0 3px rgba(139, 0, 0, 0.1);
    }
    
    .form-check-input:checked {
        background-color: #8B0000;
        border-color: #8B0000;
        box-shadow: 0 0 0 3px rgba(139, 0, 0, 0.2);
    }
    
    .form-check-label {
        margin-left: 0.75rem;
        cursor: pointer;
        font-size: 1rem;
        font-weight: 500;
        color: #333;
    }

    /* Botones de grupo (radio buttons) */
    .btn-group {
        width: 100%;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        border-radius: 8px;
        overflow: hidden;
    }

    .btn-outline-primary {
        border: 1.5px solid #8B0000;
        color: #8B0000;
        font-weight: 600;
        padding: 0.85rem 1.5rem;
        transition: all 0.3s ease;
    }

    .btn-outline-primary:hover {
        background-color: #8B0000;
        color: white;
        transform: scale(1.02);
    }

    .btn-check:checked + .btn-outline-primary {
        background-color: #8B0000;
        border-color: #8B0000;
        color: white;
        box-shadow: inset 0 2px 4px rgba(0,0,0,0.1);
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
        background: linear-gradient(135deg, #8B0000 0%, #A52A2A 50%, #8B0000 100%);
        color: white;
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(139, 0, 0, 0.3);
        color: white;
    }

    .btn-secondary {
        background: linear-gradient(135deg, #8B0000 0%, #A52A2A 50%, #8B0000 100%);
        color: white;
    }

    .btn-secondary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 16px rgba(139, 0, 0, 0.3);
        color: white;
    }

    /* Input File */
    .form-control[type="file"] {
        padding: 1rem 1.25rem;
        border: 2px dashed transparent;
        background-color: #f8f9fa;
        background-image: linear-gradient(#f8f9fa, #f8f9fa), linear-gradient(135deg, #b0b0b0 0%, #d0d0d0 100%);
        background-origin: border-box;
        background-clip: padding-box, border-box;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s ease;
        font-weight: 500;
        width: 100%;
    }

    .form-control[type="file"]:hover {
        background-color: #f5f5f5;
        background-image: linear-gradient(#f5f5f5, #f5f5f5), linear-gradient(135deg, #808080 0%, #a0a0a0 100%);
        background-origin: border-box;
        background-clip: padding-box, border-box;
        box-shadow: 0 6px 16px rgba(139, 0, 0, 0.15);
    }

    .form-control[type="file"]:focus {
        border-color: transparent;
        background-color: #ffffff;
        background-image: linear-gradient(#ffffff, #ffffff), linear-gradient(135deg, #808080 0%, #b0b0b0 100%);
        background-origin: border-box;
        background-clip: padding-box, border-box;
        box-shadow: 0 0 0 3px rgba(139, 0, 0, 0.1);
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
        background: linear-gradient(135deg, #8B0000 0%, #A52A2A 50%, #8B0000 100%);
        color: white;
        width: 100%;
        font-size: 1rem;
        padding: 0.85rem 1.5rem;
        margin-top: 0.5rem;
    }

    #addImageBtn:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(139, 0, 0, 0.3);
        color: white;
        text-decoration: none;
    }

    #addImageBtn:active {
        transform: translateY(0);
    }

    #addImageBtn i {
        margin-right: 0.5rem;
    }

    .remove-image-btn {
        background: linear-gradient(135deg, #A52A2A 0%, #8B0000 100%);
        color: white;
        padding: 0.5rem 0.75rem;
        border: none;
    }

    .remove-image-btn:hover {
        background: linear-gradient(135deg, #8B0000 0%, #A52A2A 100%);
        transform: scale(1.05);
        box-shadow: 0 6px 12px rgba(139, 0, 0, 0.3);
        color: white;
    }

    /* Contenedor de input file dinámicos */
    .image-input-group {
        background-color: #f8f9fa;
        padding: 1rem;
        border-radius: 8px;
        border: 1px solid #8B0000;
        transition: all 0.3s ease;
        margin-bottom: 0.75rem;
    }

    .image-input-group:hover {
        background-color: #ffe8e8;
        border-color: #A52A2A;
        box-shadow: 0 4px 12px rgba(139, 0, 0, 0.1);
    }
    
    /* Contenedor de botones */
    .d-flex.gap-2 {
        gap: 1rem;
    }
    
    .btn-lg {
        padding: 1rem 2rem;
        font-size: 1.05rem;
    }

    .btn-lg i {
        margin-right: 0.5rem;
    }

    .form-action-buttons {
        display: flex;
        flex-wrap: nowrap;
        gap: 0.5rem;
        align-items: center;
    }

    .form-action-buttons .btn {
        display: inline-block;
        padding: 0.5rem 0.75rem;
        font-size: 0.85rem;
        line-height: 1.2;
    }

    .form-action-buttons .btn i {
        margin-right: 0.25rem;
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

    /* Small text */
    .text-muted {
        color: #6c757d !important;
        font-size: 0.875rem;
    }

    /* Amenities list */
    .amenities-list {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 10px;
        max-height: 300px;
        overflow-y: auto;
        padding: 1rem;
        background-color: #f8f9fa;
        border-radius: 8px;
        border: 1px solid #8B0000;
    }

    .amenities-list .form-check {
        margin: 0;
        padding: 0.5rem;
    }
    
    /* Contenedor del formulario */
    .col-md-10 {
        min-width: 80%;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .form-section {
            width: 100%;
        }

        .form-section,
        .form-section h5 {
            border: none !important;
            border-bottom: none !important;
        }

        .dynamic-fields,
        .section-title,
        .section-title hr,
        .amenities-list,
        .form-check,
        .image-input-group {
            border: none !important;
            border-top: none !important;
            border-bottom: none !important;
            border-left: none !important;
            border-right: none !important;
        }

        #listingForm .row {
            width: 100%;
            margin-left: 0;
            margin-right: 0;
        }

        #listingForm .col-md-6 {
            min-width: 100%;
            max-width: 100%;
            flex-basis: 100%;
        }

        .card-body {
            padding: 0.75rem;
        }
        
        .card-header {
            padding: 1rem;
        }
        
        .card-header h2 {
            font-size: 1.5rem;
        }

        .btn-lg {
            padding: 0.85rem 1.5rem;
            font-size: 1rem;
        }

        .dynamic-fields {
            padding: 1rem;
        }

        #listingForm {
            padding: 0.5rem;
            border: none;
            border-radius: 6px;
        }

    }
</style>
@endsection

@section('content')
<div class="content-box">
<div class="container py-5">
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

                    <!-- Video Opcional -->
                    <div class="mb-3 full-width-field">
                        <label for="service_video" class="form-label fw-bold">{{ __('Video de Presentación (Opcional)') }}</label>
                        <input type="file" name="service_video" id="service_video" class="form-control" accept="video/*">
                        <small class="text-muted">
                            <i class="bi bi-info-circle"></i> {{ __('Puedes subir un video corto de tu servicio (máx. 60MB, idealmente en formato MP4, MOV, AVI, o WebM). El video será convertido a WebM para optimizar la visualización.') }}
                        </small>
                    </div>

                    <!-- Botones -->
                    <div class="d-flex gap-2 mt-4 form-action-buttons">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="bi bi-check-circle"></i> {{ __('Registrar Servicio') }}
                        </button>
                        <button type="button" id="cancelFormBtn" class="btn btn-secondary btn-lg" onclick="clearListingForm()">
                            <i class="bi bi-x-circle"></i> {{ __('Cancelar') }}
                        </button>
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
                    <div class="mb-3 full-width-field">
                        <label for="hotel_description" class="form-label">{{ __('Descripción') }}</label>
                        <textarea name="hotel_description" id="hotel_description" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="mb-3 full-width-field">
                        <label for="hotel_image" class="form-label">{{ __('Imagen Principal') }} *</label>
                        <input type="file" name="hotel_image" id="hotel_image" class="form-control" accept="image/*" required>
                        <small class="text-muted">{{ __('Resolución recomendada: 1200x800px. Se comprimirá automáticamente.') }}</small>
                    </div>
                    
                    <div class="mb-3 full-width-field">
                        <label class="form-label fw-bold">{{ __('Imágenes Adicionales (Hasta 9)') }}</label>
                        <div class="alert alert-info alert-sm" role="alert">
                            <strong>{{ __('Mismos requisitos que la imagen principal.') }}</strong><br>
                            {{ __('Sugerencia: sube fotos de habitaciones, piscina, restaurante, vistas y áreas comunes para mejor presentación.') }}
                        </div>
                        
                        <div id="additionalImagesContainer">
                            <!-- Los inputs se agregan dinámicamente aquí -->
                        </div>
                        
                        <button type="button" id="addImageBtn" class="btn btn-primary mt-2">
                            <i class="fas fa-plus-circle"></i> {{ __('Agregar más imágenes') }}
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
                            <input type="text" name="hotel_website" id="hotel_website" class="form-control" placeholder="https://ejemplo.com o ejemplo.com">
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
                    <div class="mb-3 full-width-field">
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
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="tour_name" class="form-label">{{ __('Nombre del Tour') }} *</label>
                            <input type="text" name="tour_name" id="tour_name" class="form-control" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="tour_min_capacity" class="form-label">{{ __('Capacidad Mínima') }}</label>
                            <input type="number" name="tour_min_capacity" id="tour_min_capacity" class="form-control" min="1">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="tour_capacity" class="form-label">{{ __('Capacidad Máxima') }}</label>
                            <input type="number" name="tour_capacity" id="tour_capacity" class="form-control" min="1">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mb-3 full-width-field">
                        <label for="tour_description" class="form-label">{{ __('Descripción') }}</label>
                        <textarea name="tour_description" id="tour_description" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mb-3 full-width-field">
                            <label for="tour_recommendations" class="form-label">{{ __('Recomendaciones para el Tour') }}</label>
                            <input type="text" name="tour_recommendations" id="tour_recommendations" class="form-control" placeholder="Ejemplo: Ropa y zapatos cómodos, bloqueador solar, agua, etc.">
                            <small class="form-text text-muted">Separa cada recomendación con una coma.</small>
                        </div>
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
                    <div class="row">
                        <div class="col-md-6 mb-3">
                        <label for="tour_commission" class="form-label">{{ __('Comisión (%)') }}</label>
                        <input type="number" name="tour_commission" id="tour_commission" class="form-control" step="0.01" min="0" max="100" placeholder="0.00">
                        </div>
                    </div>

                    <!-- Incluye del tour -->
                    <div class="row">
                        <div class="col-12 mb-3 full-width-field">
                            <label class="form-label fw-bold">{{ __('¿Qué está incluido en el tour?') }}</label>
                            <div id="tourIncludesContainer">
                                <!-- Los campos de incluye se agregan aquí -->
                            </div>
                            <button type="button" class="addTourIncludeBtn btn btn-success mt-2">
                                <i class="fas fa-plus-circle"></i> {{ __('Agregar Items Incluidos') }}
                            </button>
                            <small class="d-block mt-2 text-muted">
                                <i class="bi bi-info-circle"></i> {{ __('Puedes agregar varios elementos, por ejemplo: transporte, guía, comidas, entradas, etc.') }}
                            </small>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 mb-3 full-width-field">
                        <label for="tour_image" class="form-label">{{ __('Imagen Principal') }} *</label>
                        <input type="file" name="tour_image" id="tour_image" class="form-control" accept="image/*" required>
                        <small class="text-muted">{{ __('Resolución recomendada: 1200x800px. Se comprimirá automáticamente.') }}</small>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-12 mb-3 full-width-field">
                        <label class="form-label fw-bold">{{ __('Imágenes Adicionales (Hasta 9)') }}</label>
                        <div class="alert alert-info alert-sm" role="alert">
                            <strong>{{ __('Mismos requisitos que la imagen principal.') }}</strong><br>
                            {{ __('Sugerencia: sube fotos de los paisajes, actividades, paradas y puntos de interés para mejor presentación.') }}
                        </div>
                        
                        <div id="tourAdditionalImagesContainer">
                            <!-- Los inputs se agregan dinámicamente aquí -->
                        </div>
                        
                        <button type="button" class="addTourImageBtn btn btn-primary mt-2">
                            <i class="bi bi-cloud-upload"></i> {{ __('Agregar más imágenes') }}
                        </button>
                        <small class="d-block mt-2 text-muted">
                            <i class="bi bi-info-circle"></i> {{ __('Imágenes agregadas:') }} <strong><span class="tourImageCount">0</span>/9</strong>
                        </small>
                        </div>
                    </div>

                    <!-- ¿Eres operador de tours? -->
                    <div class="row">
                        <div class="col-12 mb-3 full-width-field">
                        <label class="form-label">{{ __('¿Eres operador de tours registrado?') }} *</label>
                        <div class="btn-group w-100" role="group">
                            <input type="radio" class="btn-check" name="is_tour_operator" id="operator_yes" value="yes" required onchange="toggleOperatorFields()">
                            <label class="btn btn-outline-primary" for="operator_yes">{{ __('Sí') }}</label>

                            <input type="radio" class="btn-check" name="is_tour_operator" id="operator_no" value="no" required onchange="toggleOperatorFields()">
                            <label class="btn btn-outline-primary" for="operator_no">{{ __('No') }}</label>
                        </div>
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
                                <input type="text" name="operator_website" id="operator_website" class="form-control" placeholder="https://ejemplo.com o ejemplo.com">
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
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="transport_name" class="form-label">{{ __('Nombre de la Empresa') }} *</label>
                            <input type="text" name="transport_name" id="transport_name" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="transport_capacity" class="form-label">{{ __('Capacidad por Vehículo') }}</label>
                            <input type="number" name="transport_capacity" id="transport_capacity" class="form-control">
                        </div>
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
                    <div class="row">
                        <div class="col-md-6 mb-3">
                        <label for="transport_commission" class="form-label">{{ __('Comisión (%)') }}</label>
                        <input type="number" name="transport_commission" id="transport_commission" class="form-control" step="0.01" min="0" max="100" placeholder="0.00">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 mb-3 full-width-field">
                        <label for="transport_image" class="form-label">{{ __('Imagen Principal') }} *</label>
                        <input type="file" name="transport_image" id="transport_image" class="form-control" accept="image/*" required>
                        <small class="text-muted">{{ __('Resolución recomendada: 1200x800px. Se comprimirá automáticamente.') }}</small>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-12 mb-3 full-width-field">
                        <label class="form-label fw-bold">{{ __('Imágenes Adicionales (Hasta 9)') }}</label>
                        <div class="alert alert-info alert-sm" role="alert">
                            <strong>{{ __('Mismos requisitos que la imagen principal.') }}</strong><br>
                            {{ __('Sugerencia: sube fotos de los vehículos, interiores, servicio y destinos para mejor presentación.') }}
                        </div>
                        
                        <div id="transportAdditionalImagesContainer">
                            <!-- Los inputs se agregan dinámicamente aquí -->
                        </div>
                        
                        <button type="button" class="addTransportImageBtn btn btn-primary mt-2">
                            <i class="bi bi-cloud-upload"></i> {{ __('Agregar más imágenes') }}
                        </button>
                        <small class="d-block mt-2 text-muted">
                            <i class="bi bi-info-circle"></i> {{ __('Imágenes agregadas:') }} <strong><span class="transportImageCount">0</span>/9</strong>
                        </small>
                        </div>
                    </div>
                </div>
            `;
        }

        // Mostrar campos de precios
        priceFields.innerHTML = `
            <div class="alert alert-info mb-3">
                <i class="bi bi-info-circle"></i> <strong>{{ __('Importante:') }}</strong> {{ __('Debe ingresar precios para todas las temporadas. Esto permite ajustar precios según la época del año.') }}
            </div>
            <div class="row">
                ${rateTypes.map(rateType => `
                    <div class="col-md-6 mb-3">
                        <label for="price_${rateType.id}" class="form-label">
                            {{ __('Precio') }} - ${rateType.name || rateType.type} *
                        </label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number" name="prices[${rateType.id}]" id="price_${rateType.id}" 
                                class="form-control" step="0.01" min="0.01" placeholder="Ingrese el valor en dólares" required>
                        </div>
                        <small class="text-muted">{{ __('Precio por persona en USD') }}</small>
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
    let hotelImageCount = 0;
    let tourImageCount = 0;
    let transportImageCount = 0;

    // Delegación de eventos para botones "Agregar Imagen"
    document.addEventListener('click', function(e) {
        // Hotel images
        if (e.target.closest('#addImageBtn')) {
            e.preventDefault();
            e.stopPropagation();
            addImage('hotel', 'hotel', 'hotel_images');
            return false;
        }

        // Tour images
        if (e.target.closest('.addTourImageBtn')) {
            e.preventDefault();
            e.stopPropagation();
            addImage('tour', 'tourAdditionalImagesContainer', 'tour_images');
            return false;
        }

        // Transport images
        if (e.target.closest('.addTransportImageBtn')) {
            e.preventDefault();
            e.stopPropagation();
            addImage('transport', 'transportAdditionalImagesContainer', 'transport_images');
            return false;
        }

        // Delegación para botones de eliminar
        if (e.target.closest('.remove-image-btn')) {
            e.preventDefault();
            e.stopPropagation();
            
            const inputGroup = e.target.closest('.image-input-group');
            const serviceType = inputGroup.dataset.serviceType;
            
            if (inputGroup) {
                inputGroup.remove();
                if (serviceType === 'hotel') hotelImageCount--;
                else if (serviceType === 'tour') tourImageCount--;
                else if (serviceType === 'transport') transportImageCount--;
                updateImageCount(serviceType);
            }
            
            return false;
        }
    });

    function addImage(serviceType, containerId, inputName) {
        const container = document.getElementById(containerId);
        if (!container) {
            console.error('Contenedor de imágenes no encontrado para: ' + serviceType);
            return;
        }

        let currentCount;
        if (serviceType === 'hotel') {
            currentCount = hotelImageCount;
        } else if (serviceType === 'tour') {
            currentCount = tourImageCount;
        } else if (serviceType === 'transport') {
            currentCount = transportImageCount;
        }

        if (currentCount >= 9) {
            alert('{{ __("Máximo 9 imágenes adicionales permitidas") }}');
            return false;
        }

        if (serviceType === 'hotel') hotelImageCount++;
        else if (serviceType === 'tour') tourImageCount++;
        else if (serviceType === 'transport') transportImageCount++;

        const imageId = `${serviceType}_image_${currentCount + 1}`;
        
        const inputGroup = document.createElement('div');
        inputGroup.className = 'input-group mb-2 image-input-group';
        inputGroup.id = `group_${imageId}`;
        inputGroup.dataset.serviceType = serviceType;
        inputGroup.innerHTML = `
            <input type="file" name="${inputName}[]" id="${imageId}" class="form-control" accept="image/*">
            <button type="button" class="btn btn-danger btn-sm remove-image-btn"><i class="fas fa-trash red"></i></button>
        `;

        container.appendChild(inputGroup);
        updateImageCount(serviceType);
        
        return false;
    }

    function updateImageCount(serviceType) {
        let count;
        if (serviceType === 'hotel') {
            count = hotelImageCount;
            const countSpan = document.getElementById('imageCount');
            if (countSpan) countSpan.textContent = count;
        } else if (serviceType === 'tour') {
            count = tourImageCount;
            const countSpans = document.querySelectorAll('.tourImageCount');
            countSpans.forEach(span => span.textContent = count);
        } else if (serviceType === 'transport') {
            count = transportImageCount;
            const countSpans = document.querySelectorAll('.transportImageCount');
            countSpans.forEach(span => span.textContent = count);
        }
    }

    function clearListingForm() {
        const form = document.getElementById('listingForm');
        if (!form) return;

        form.reset();

        form.querySelectorAll('input[type="text"], input[type="email"], input[type="tel"], input[type="number"], input[type="time"], input[type="file"], textarea').forEach(input => {
            input.value = '';
            input.classList.remove('is-invalid');
        });

        form.querySelectorAll('select').forEach(select => {
            select.selectedIndex = 0;
            select.classList.remove('is-invalid');
        });

        form.querySelectorAll('input[type="checkbox"], input[type="radio"]').forEach(input => {
            input.checked = false;
        });

        const fieldsDiv = document.getElementById('serviceFields');
        const priceFields = document.getElementById('priceFields');
        const pricesSection = document.getElementById('pricesSection');

        if (fieldsDiv) fieldsDiv.innerHTML = '';
        if (priceFields) priceFields.innerHTML = '';
        if (pricesSection) pricesSection.style.display = 'none';

        hotelImageCount = 0;
        tourImageCount = 0;
        transportImageCount = 0;
        updateImageCount('hotel');
        updateImageCount('tour');
        updateImageCount('transport');
    }
</script>
    <!-- Delegación para agregar tour_includes -->
    <script>
        document.addEventListener('click', function(e) {
            if (e.target.closest('.addTourIncludeBtn')) {
                e.preventDefault();
                e.stopPropagation();
                addTourInclude();
                return false;
            }
            if (e.target.closest('.remove-tour-include-btn')) {
                e.preventDefault();
                e.stopPropagation();
                const includeGroup = e.target.closest('.tour-include-group');
                if (includeGroup) includeGroup.remove();
                return false;
            }
        });

        function addTourInclude() {
            const container = document.getElementById('tourIncludesContainer');
            if (!container) return;
            const index = container.children.length;
            container.insertAdjacentHTML('beforeend', `
                <div class="tour-include-group d-flex gap-2 mb-2 align-items-center">
                    <input type="text" name="tour_includes[${index}][name]" class="form-control" placeholder="Nombre del elemento (ej. Transporte, Guía, Comidas)" required >
                    <button type="button" class="remove-tour-include-btn btn btn-danger btn-sm remove-image-btn"><i class="fas fa-trash red"></i></button>
                </div>
            `);
        }
    </script>
</div><!-- End Content Box -->
