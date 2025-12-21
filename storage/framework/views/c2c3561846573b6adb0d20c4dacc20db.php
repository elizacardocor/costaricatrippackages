<?php $__env->startSection('canonical'); ?>
<link rel="canonical" href="<?php echo e(url($canonicalUrl)); ?>">
<meta property="og:type" content="website">
<meta property="og:title" content="<?php echo e($tour->name); ?> - Costa Rica Trip Packages">
<meta property="og:description" content="<?php echo e(substr($tour->description, 0, 160)); ?>">
<meta property="og:image" content="<?php echo e($tour->images->first()?->url ?? asset('images/default-tour.jpg')); ?>">
<meta property="og:url" content="<?php echo e(url($canonicalUrl)); ?>">
<meta property="og:site_name" content="Costa Rica Trip Packages">
<meta property="og:locale" content="<?php echo e(app()->getLocale() === 'es' ? 'es_CR' : 'en_US'); ?>">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="<?php echo e($tour->name); ?>">
<meta name="twitter:description" content="<?php echo e(substr($tour->description, 0, 160)); ?>">
<meta name="twitter:image" content="<?php echo e($tour->images->first()?->url ?? asset('images/default-tour.jpg')); ?>">

<!-- Schema.org JSON-LD for Tour -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "TouristAttraction",
    "@id": "<?php echo e(url($canonicalUrl)); ?>",
    "name": "<?php echo e(addslashes($tour->name)); ?>",
    "description": "<?php echo e(addslashes($tour->description)); ?>",
    "image": "<?php echo e($tour->images->pluck('url')->toJson()); ?>",
    "url": "<?php echo e(url($canonicalUrl)); ?>",
    "offers": {
        "@type": "Offer",
        "priceCurrency": "USD",
        "price": "<?php echo e($tour->price ?? 0); ?>",
        "availability": "InStock"
    },
    "aggregateRating": {
        "@type": "AggregateRating",
        "ratingValue": "<?php echo e($tour->rating ?? 4.5); ?>",
        "reviewCount": "<?php echo e($tour->reviews?->count() ?? 0); ?>"
    }
}
</script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid p-0">
    <!-- Hero Image Section -->
    <div class="position-relative" style="height: 300px; overflow: hidden; margin-top: 80px;">
        <img src="<?php echo e($tour->images->first()?->url ?? 'https://via.placeholder.com/1200x500'); ?>" 
             alt="<?php echo e($tour->name); ?>" 
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
            <h1 class="text-white mb-2"><?php echo e($tour->name); ?></h1>
            <p class="text-light mb-0"><?php echo e($tour->destinations->first()?->name ?? 'Costa Rica'); ?>, <?php echo e($tour->destinations->first()?->province->name ?? 'N/A'); ?></p>
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
                            <?php for($i = 0; $i < floor($tour->rating); $i++): ?>
                                <i class="bi bi-star-fill text-warning"></i>
                            <?php endfor; ?>
                            <?php if($tour->rating % 1 > 0): ?>
                                <i class="bi bi-star-half text-warning"></i>
                            <?php endif; ?>
                        </div>
                        <span class="badge bg-success"><?php echo e($tour->rating); ?></span>
                        <small class="text-muted">(<?php echo e($tour->reviews->count()); ?> reseñas)</small>
                    </div>
                </div>

                <!-- Description -->
                <div class="mb-5">
                    <h3>Descripción</h3>
                    <p class="lead"><?php echo e($tour->description); ?></p>
                </div>

                <!-- Tour Info Grid -->
                <div class="row g-3 mb-5">
                    <div class="col-md-6">
                        <div class="card border-0 bg-light p-3">
                            <small class="text-muted">
                                <i class="bi bi-clock"></i> Duración
                            </small>
                            <h5 class="mb-0"><?php echo e($tour->duration); ?> horas</h5>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card border-0 bg-light p-3">
                            <small class="text-muted">
                                <i class="bi bi-people"></i> Grupo
                            </small>
                            <h5 class="mb-0"><?php echo e($tour->group_size ?? '6-8'); ?> personas</h5>
                        </div>
                    </div>
                </div>

                <!-- Image Gallery -->
                <div class="mb-5">
                    <h3 class="mb-4">Galería</h3>
                    <div class="row g-3">
                        <?php $__currentLoopData = $tour->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-md-6">
                                <img src="<?php echo e($image->url); ?>" alt="<?php echo e($tour->name); ?>" class="img-fluid rounded" style="height: 300px; object-fit: cover; width: 100%;">
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>

                <!-- What's Included -->
                <div class="mb-5">
                    <h3>¿Qué está Incluido?</h3>
                    <div class="row g-3">
                        <?php $__currentLoopData = $tour->includes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-md-6">
                                <div class="d-flex gap-2">
                                    <i class="bi bi-check-circle-fill text-success mt-1"></i>
                                    <span><?php echo e($item->name); ?></span>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                                $<?php echo e(number_format($tour->base_price ?? 199, 0)); ?>

                            </h2>
                            <small class="text-muted"><?php echo e($tour->duration); ?> horas</small>
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
                                <i class="bi bi-geo-alt"></i> <?php echo e($tour->destinations->first()?->name ?? 'Costa Rica'); ?>

                            </small>
                            <small class="text-muted d-block mb-2">
                                <i class="bi bi-clock"></i> <?php echo e($tour->duration); ?> horas
                            </small>
                            <small class="text-muted d-block">
                                <i class="bi bi-people"></i> <?php echo e($tour->group_size ?? '6-8'); ?> personas
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
                        <?php
                            $otherTours = \App\Models\Tour::where('id', '!=', $tour->id)->limit(2)->get();
                        ?>
                        <?php $__empty_1 = true; $__currentLoopData = $otherTours; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $otherTour): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div class="mb-3">
                                <h6><?php echo e($otherTour->name); ?></h6>
                                <small class="text-muted"><?php echo e($otherTour->duration); ?> horas</small>
                                <p class="text-success fw-bold">$<?php echo e(number_format($otherTour->base_price ?? 199, 0)); ?></p>
                                <a href="/<?php echo e(app()->getLocale()); ?>/tour/<?php echo e($otherTour->slug); ?>" class="btn btn-sm btn-outline-primary">Ver Tour</a>
                            </div>
                            <?php if(!$loop->last): ?>
                                <hr>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <p class="text-muted">No hay otros tours disponibles</p>
                        <?php endif; ?>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/elizabeth/costaricatrippackages/resources/views/tours/show.blade.php ENDPATH**/ ?>