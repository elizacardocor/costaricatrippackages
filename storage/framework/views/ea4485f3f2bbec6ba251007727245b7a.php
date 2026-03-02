<?php $__env->startSection('title', app()->getLocale() === 'es' ? 'Registra tu Servicio - Costa Rica Trip Packages' : 'Register Your Service - Costa Rica Trip Packages'); ?>
<?php $__env->startSection('meta_description', app()->getLocale() === 'es' ? 'Registra tu hotel, tour, transporte u otro servicio turístico en nuestra plataforma' : 'Register your hotel, tour, transportation or other tourism service on our platform'); ?>

<?php $__env->startSection('extra_styles'); ?>
<style>
    /* Estilos personalizados para el formulario de registro */
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

    /* Columnas dentro del formulario - ocupar 80% */
    #listingForm .col-md-6 {
        min-width: 40%;
        max-width: 45%;
        flex-basis: 45%;
    }

    #listingForm .row {
        width: 80%;
        margin-left: auto;
        margin-right: auto;
    }

    /* Label e input en la misma línea */
    #listingForm .col-md-6 .mb-3 {
        display: flex;
        flex-direction: column;
    }

    #listingForm .col-md-6 .form-label {
        margin-bottom: 0.5rem;
    }

    #listingForm .col-md-6 .form-control,
    #listingForm .col-md-6 .form-select,
    #listingForm .col-md-6 .input-group {
        width: 100%;
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
        font-weight: 700;
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
        width: 80%;
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
        width: 80%;
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
        width: 80%;
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
        .card-body {
            padding: 1.5rem;
        }
        
        .card-header {
            padding: 1.5rem;
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
            padding: 1.5rem;
            border: 0.5px solid #8B0000;
        }
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="content-box">
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white">
                    <h2 class="mb-0"><?php echo e(__('Registra tu Servicio')); ?></h2>
                    <p class="small mb-0"><?php echo e(app()->getLocale() === 'es' ? 'Hotel, Tour o Transporte' : 'Hotel, Tour or Transport'); ?></p>
                </div>
                <div class="card-body">
                    <?php if($errors->any()): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong><?php echo e(__('Error en el formulario:')); ?></strong>
                            <ul class="mb-0">
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <form action="<?php echo e(app()->getLocale() === 'es' ? route('listings.store.es') : route('listings.store.en')); ?>" method="POST" enctype="multipart/form-data" id="listingForm">
                        <?php echo csrf_field(); ?>

                        <!-- Información de Contacto -->
                        <div class="section-title mb-4">
                            <h4><?php echo e(__('Información de Contacto')); ?></h4>
                            <hr>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="contact_name" class="form-label"><?php echo e(__('Nombre Completo')); ?> *</label>
                                <input type="text" name="contact_name" id="contact_name" class="form-control <?php $__errorArgs = ['contact_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                    value="<?php echo e(old('contact_name')); ?>" required>
                                <?php $__errorArgs = ['contact_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="col-md-6">
                                <label for="contact_email" class="form-label"><?php echo e(__('Email')); ?> *</label>
                                <input type="email" name="contact_email" id="contact_email" class="form-control <?php $__errorArgs = ['contact_email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                    value="<?php echo e(old('contact_email')); ?>" required>
                                <?php $__errorArgs = ['contact_email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="contact_phone" class="form-label"><?php echo e(__('Teléfono')); ?> *</label>
                                <input type="tel" name="contact_phone" id="contact_phone" class="form-control <?php $__errorArgs = ['contact_phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                    value="<?php echo e(old('contact_phone')); ?>" required>
                                <?php $__errorArgs = ['contact_phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="col-md-6">
                                <label for="contact_address" class="form-label"><?php echo e(__('Dirección (Opcional)')); ?></label>
                                <input type="text" name="contact_address" id="contact_address" class="form-control" 
                                    value="<?php echo e(old('contact_address')); ?>">
                            </div>
                        </div>

                        <!-- Información del Servicio -->
                        <div class="section-title mb-4">
                            <h4><?php echo e(__('Información del Servicio')); ?></h4>
                            <hr>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="destination_id" class="form-label"><?php echo e(__('Destino')); ?> *</label>
                                <select name="destination_id" id="destination_id" class="form-select <?php $__errorArgs = ['destination_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                                    <option value=""><?php echo e(__('Selecciona un destino')); ?></option>
                                    <?php $__currentLoopData = $destinations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $destination): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($destination->id); ?>" <?php if(old('destination_id') == $destination->id): echo 'selected'; endif; ?>>
                                            <?php echo e($destination->name ?? __('destinations.' . $destination->slug . '.title')); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php $__errorArgs = ['destination_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="col-md-6">
                                <label for="service_type" class="form-label"><?php echo e(__('Tipo de Servicio')); ?> *</label>
                                <select name="service_type" id="service_type" class="form-select <?php $__errorArgs = ['service_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required onchange="updateServiceFields()">
                                    <option value=""><?php echo e(__('Selecciona un tipo')); ?></option>
                                    <option value="hotel" <?php if(old('service_type') == 'hotel'): echo 'selected'; endif; ?>><?php echo e(__('Hotel')); ?></option>
                                    <option value="tour" <?php if(old('service_type') == 'tour'): echo 'selected'; endif; ?>><?php echo e(__('Tour')); ?></option>
                                    <option value="transport" <?php if(old('service_type') == 'transport'): echo 'selected'; endif; ?>><?php echo e(__('Transporte')); ?></option>
                                </select>
                                <?php $__errorArgs = ['service_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <!-- Campos Dinámicos por Tipo de Servicio -->
                        <div id="serviceFields" class="dynamic-fields">
                            <!-- Se llenan dinámicamente -->
                        </div>

                        <!-- Precios por Temporada -->
                        <div class="section-title mb-4" id="pricesSection" style="display: none;">
                            <h4><?php echo e(__('Precios por Temporada')); ?></h4>
                            <hr>
                        </div>

                        <div id="priceFields" class="mb-3">
                            <!-- Se llenan dinámicamente -->
                        </div>

                        <!-- Botones -->
                        <div class="d-flex gap-2 mt-4">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="bi bi-check-circle"></i> <?php echo e(__('Registrar Servicio')); ?>

                            </button>
                            <a href="<?php echo e(app()->getLocale() === 'es' ? '/es/' : '/en/'); ?>" class="btn btn-secondary btn-lg">
                                <i class="bi bi-x-circle"></i> <?php echo e(__('Cancelar')); ?>

                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Info Box -->
            <div class="alert alert-info mt-4">
                <i class="bi bi-info-circle"></i>
                <strong><?php echo e(__('Información Importante:')); ?></strong>
                <ul class="mb-0 mt-2">
                    <li><?php echo e(__('Todos los campos marcados con * son obligatorios')); ?></li>
                    <li><?php echo e(app()->getLocale() === 'es' ? 'Sin necesidad de registro o login' : 'No registration or login required'); ?></li>
                    <li><?php echo e(app()->getLocale() === 'es' ? 'Guardamos tus datos de contacto para verificar tu servicio' : 'We save your contact info to verify your service'); ?></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
    const rateTypes = <?php echo json_encode($rateTypes, 15, 512) ?>;

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
                    <h5><?php echo e(__('Información del Hotel')); ?></h5>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="hotel_name" class="form-label"><?php echo e(__('Nombre del Hotel')); ?> *</label>
                            <input type="text" name="hotel_name" id="hotel_name" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="hotel_stars" class="form-label"><?php echo e(__('Estrellas (1-5)')); ?></label>
                            <input type="number" name="hotel_stars" id="hotel_stars" class="form-control" min="1" max="5">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="hotel_description" class="form-label"><?php echo e(__('Descripción')); ?></label>
                        <textarea name="hotel_description" id="hotel_description" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="hotel_image" class="form-label"><?php echo e(__('Imagen Principal')); ?> *</label>
                        <input type="file" name="hotel_image" id="hotel_image" class="form-control" accept="image/*" required>
                        <small class="text-muted"><?php echo e(__('Resolución recomendada: 1200x800px. Se comprimirá automáticamente.')); ?></small>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold"><?php echo e(__('Imágenes Adicionales (Hasta 9)')); ?></label>
                        <div class="alert alert-info alert-sm" role="alert">
                            <strong><?php echo e(__('Mismos requisitos que la imagen principal.')); ?></strong><br>
                            <?php echo e(__('Sugerencia: sube fotos de habitaciones, piscina, restaurante, vistas y áreas comunes para mejor presentación.')); ?>

                        </div>
                        
                        <div id="additionalImagesContainer">
                            <!-- Los inputs se agregan dinámicamente aquí -->
                        </div>
                        
                        <button type="button" id="addImageBtn" class="btn btn-primary mt-2">
                            <i class="bi bi-cloud-upload"></i> <?php echo e(__('Agregar más imágenes')); ?>

                        </button>
                        <small class="d-block mt-2 text-muted">
                            <i class="bi bi-info-circle"></i> <?php echo e(__('Imágenes agregadas:')); ?> <strong><span id="imageCount">0</span>/9</strong>
                        </small>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="hotel_address" class="form-label"><?php echo e(__('Dirección')); ?></label>
                            <input type="text" name="hotel_address" id="hotel_address" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="hotel_phone" class="form-label"><?php echo e(__('Teléfono')); ?></label>
                            <input type="tel" name="hotel_phone" id="hotel_phone" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="hotel_website" class="form-label"><?php echo e(__('Sitio Web')); ?></label>
                            <input type="text" name="hotel_website" id="hotel_website" class="form-control" placeholder="https://ejemplo.com o ejemplo.com">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="hotel_rooms" class="form-label"><?php echo e(__('Cantidad de Habitaciones')); ?></label>
                            <input type="number" name="hotel_rooms" id="hotel_rooms" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="hotel_commission" class="form-label"><?php echo e(__('Comisión (%)')); ?></label>
                            <input type="number" name="hotel_commission" id="hotel_commission" class="form-control" step="0.01" min="0" max="100" placeholder="0.00">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="hotel_checkin" class="form-label"><?php echo e(__('Hora de Check-in')); ?></label>
                            <input type="time" name="hotel_checkin" id="hotel_checkin" class="form-control" value="14:00">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="hotel_checkout" class="form-label"><?php echo e(__('Hora de Check-out')); ?></label>
                            <input type="time" name="hotel_checkout" id="hotel_checkout" class="form-control" value="11:00">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><?php echo e(__('Amenidades')); ?></label>
                        <div class="amenities-list" id="amenitiesList" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 10px;">
                            <?php $__empty_1 = true; $__currentLoopData = $amenities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $amenity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="hotel_amenities[]" 
                                        value="<?php echo e($amenity->id); ?>" id="amenity_<?php echo e($amenity->id); ?>">
                                    <label class="form-check-label" for="amenity_<?php echo e($amenity->id); ?>">
                                        <?php echo e($amenity->name ?? $amenity->amenity); ?>

                                    </label>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <p class="text-muted"><?php echo e(__('No hay amenidades disponibles')); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            `;
        } 
        else if (serviceType === 'tour') {
            fieldsDiv.innerHTML = `
                <div class="form-section">
                    <h5><?php echo e(__('Información del Tour')); ?></h5>
                    <div class="mb-3">
                        <label for="tour_name" class="form-label"><?php echo e(__('Nombre del Tour')); ?> *</label>
                        <input type="text" name="tour_name" id="tour_name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="tour_description" class="form-label"><?php echo e(__('Descripción')); ?></label>
                        <textarea name="tour_description" id="tour_description" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="tour_duration" class="form-label"><?php echo e(__('Duración (horas)')); ?></label>
                            <input type="number" name="tour_duration" id="tour_duration" class="form-control" step="0.5">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="tour_difficulty" class="form-label"><?php echo e(__('Dificultad')); ?></label>
                            <select name="tour_difficulty" id="tour_difficulty" class="form-select">
                                <option value="easy"><?php echo e(__('Fácil')); ?></option>
                                <option value="moderate" selected><?php echo e(__('Moderada')); ?></option>
                                <option value="hard"><?php echo e(__('Difícil')); ?></option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="tour_capacity" class="form-label"><?php echo e(__('Capacidad Máxima')); ?></label>
                        <input type="number" name="tour_capacity" id="tour_capacity" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="tour_commission" class="form-label"><?php echo e(__('Comisión (%)')); ?></label>
                        <input type="number" name="tour_commission" id="tour_commission" class="form-control" step="0.01" min="0" max="100" placeholder="0.00">
                    </div>

                    <div class="mb-3">
                        <label for="tour_image" class="form-label"><?php echo e(__('Imagen Principal')); ?> *</label>
                        <input type="file" name="tour_image" id="tour_image" class="form-control" accept="image/*" required>
                        <small class="text-muted"><?php echo e(__('Resolución recomendada: 1200x800px. Se comprimirá automáticamente.')); ?></small>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold"><?php echo e(__('Imágenes Adicionales (Hasta 9)')); ?></label>
                        <div class="alert alert-info alert-sm" role="alert">
                            <strong><?php echo e(__('Mismos requisitos que la imagen principal.')); ?></strong><br>
                            <?php echo e(__('Sugerencia: sube fotos de los paisajes, actividades, paradas y puntos de interés para mejor presentación.')); ?>

                        </div>
                        
                        <div id="tourAdditionalImagesContainer">
                            <!-- Los inputs se agregan dinámicamente aquí -->
                        </div>
                        
                        <button type="button" class="addTourImageBtn btn btn-primary mt-2">
                            <i class="bi bi-cloud-upload"></i> <?php echo e(__('Agregar más imágenes')); ?>

                        </button>
                        <small class="d-block mt-2 text-muted">
                            <i class="bi bi-info-circle"></i> <?php echo e(__('Imágenes agregadas:')); ?> <strong><span class="tourImageCount">0</span>/9</strong>
                        </small>
                    </div>

                    <!-- ¿Eres operador de tours? -->
                    <div class="mb-3">
                        <label class="form-label"><?php echo e(__('¿Eres operador de tours registrado?')); ?> *</label>
                        <div class="btn-group w-100" role="group">
                            <input type="radio" class="btn-check" name="is_tour_operator" id="operator_yes" value="yes" required onchange="toggleOperatorFields()">
                            <label class="btn btn-outline-primary" for="operator_yes"><?php echo e(__('Sí')); ?></label>

                            <input type="radio" class="btn-check" name="is_tour_operator" id="operator_no" value="no" required onchange="toggleOperatorFields()">
                            <label class="btn btn-outline-primary" for="operator_no"><?php echo e(__('No')); ?></label>
                        </div>
                    </div>

                    <!-- Campos de Operador (solo si dice "Sí") -->
                    <div id="operatorFields" class="operator-fields" style="display: none;">
                        <h6 class="mb-3"><?php echo e(__('Información del Operador')); ?></h6>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="operator_name" class="form-label"><?php echo e(__('Nombre de la Empresa')); ?> *</label>
                                <input type="text" name="operator_name" id="operator_name" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="operator_phone" class="form-label"><?php echo e(__('Teléfono')); ?> *</label>
                                <input type="tel" name="operator_phone" id="operator_phone" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="operator_website" class="form-label"><?php echo e(__('Sitio Web')); ?></label>
                                <input type="text" name="operator_website" id="operator_website" class="form-control" placeholder="https://ejemplo.com o ejemplo.com">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="operator_license" class="form-label"><?php echo e(__('Número de Licencia')); ?></label>
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
                    <h5><?php echo e(__('Información del Transporte')); ?></h5>
                    <div class="mb-3">
                        <label for="transport_name" class="form-label"><?php echo e(__('Nombre de la Empresa')); ?> *</label>
                        <input type="text" name="transport_name" id="transport_name" class="form-control" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="transport_type" class="form-label"><?php echo e(__('Tipo de Transporte')); ?></label>
                            <input type="text" name="transport_type" id="transport_type" class="form-control" placeholder="Taxi, Bus, Shuttle, etc.">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="transport_vehicles" class="form-label"><?php echo e(__('Cantidad de Vehículos')); ?></label>
                            <input type="number" name="transport_vehicles" id="transport_vehicles" class="form-control">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="transport_capacity" class="form-label"><?php echo e(__('Capacidad por Vehículo')); ?></label>
                        <input type="number" name="transport_capacity" id="transport_capacity" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="transport_commission" class="form-label"><?php echo e(__('Comisión (%)')); ?></label>
                        <input type="number" name="transport_commission" id="transport_commission" class="form-control" step="0.01" min="0" max="100" placeholder="0.00">
                    </div>

                    <div class="mb-3">
                        <label for="transport_image" class="form-label"><?php echo e(__('Imagen Principal')); ?> *</label>
                        <input type="file" name="transport_image" id="transport_image" class="form-control" accept="image/*" required>
                        <small class="text-muted"><?php echo e(__('Resolución recomendada: 1200x800px. Se comprimirá automáticamente.')); ?></small>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold"><?php echo e(__('Imágenes Adicionales (Hasta 9)')); ?></label>
                        <div class="alert alert-info alert-sm" role="alert">
                            <strong><?php echo e(__('Mismos requisitos que la imagen principal.')); ?></strong><br>
                            <?php echo e(__('Sugerencia: sube fotos de los vehículos, interiores, servicio y destinos para mejor presentación.')); ?>

                        </div>
                        
                        <div id="transportAdditionalImagesContainer">
                            <!-- Los inputs se agregan dinámicamente aquí -->
                        </div>
                        
                        <button type="button" class="addTransportImageBtn btn btn-primary mt-2">
                            <i class="bi bi-cloud-upload"></i> <?php echo e(__('Agregar más imágenes')); ?>

                        </button>
                        <small class="d-block mt-2 text-muted">
                            <i class="bi bi-info-circle"></i> <?php echo e(__('Imágenes agregadas:')); ?> <strong><span class="transportImageCount">0</span>/9</strong>
                        </small>
                    </div>
                </div>
            `;
        }

        // Mostrar campos de precios
        priceFields.innerHTML = `
            <div class="alert alert-info mb-3">
                <i class="bi bi-info-circle"></i> <strong><?php echo e(__('Importante:')); ?></strong> <?php echo e(__('Debe ingresar precios para todas las temporadas. Esto permite ajustar precios según la época del año.')); ?>

            </div>
            <div class="row">
                ${rateTypes.map(rateType => `
                    <div class="col-md-6 mb-3">
                        <label for="price_${rateType.id}" class="form-label">
                            <?php echo e(__('Precio')); ?> - ${rateType.name || rateType.type} *
                        </label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number" name="prices[${rateType.id}]" id="price_${rateType.id}" 
                                class="form-control" step="0.01" min="0.01" placeholder="Ingrese el valor en dólares" required>
                        </div>
                        <small class="text-muted"><?php echo e(__('Precio por persona en USD')); ?></small>
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
            alert('<?php echo e(__("Máximo 9 imágenes adicionales permitidas")); ?>');
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
            <button type="button" class="btn btn-outline-danger btn-sm remove-image-btn">
                <i class="bi bi-trash"></i>
            </button>
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
</script>
        </div><!-- End Content Box -->

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /mnt/c/Users/Elizabeth/costaricatrippackages/resources/views/listings/create.blade.php ENDPATH**/ ?>