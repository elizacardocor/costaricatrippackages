<?php $__env->startSection('canonical'); ?>
<link rel="canonical" href="<?php echo e(url($canonicalUrl)); ?>">
<meta property="og:type" content="website">
<meta property="og:title" content="<?php echo e($hotel->name); ?> - Costa Rica Trip Packages">
<meta property="og:description" content="<?php echo e(substr($hotel->description, 0, 160)); ?>">
<?php
    $ogImg = $hotel->images->first()?->url;
    $ogImg = $ogImg ? (\Illuminate\Support\Str::startsWith($ogImg, ['http://','https://','//']) ? $ogImg : asset('storage/' . ltrim($ogImg,'/'))) : asset('images/default-hotel.jpg');
?>
<meta property="og:image" content="<?php echo e($ogImg); ?>">
<meta property="og:url" content="<?php echo e(url($canonicalUrl)); ?>">
<meta property="og:site_name" content="Costa Rica Trip Packages">
<meta property="og:locale" content="<?php echo e(app()->getLocale() === 'es' ? 'es_CR' : 'en_US'); ?>">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="<?php echo e($hotel->name); ?>">
<meta name="twitter:description" content="<?php echo e(substr($hotel->description, 0, 160)); ?>">
<meta name="twitter:image" content="<?php echo e($ogImg); ?>">

<!-- Schema.org JSON-LD for Hotel -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "Hotel",
    "@id": "<?php echo e(url($canonicalUrl)); ?>",
    "name": "<?php echo e(addslashes($hotel->name)); ?>",
    "description": "<?php echo e(addslashes($hotel->description)); ?>",
    <?php
        $images = $hotel->images->pluck('url')->map(function($u){
            return \Illuminate\Support\Str::startsWith($u, ['http://','https://','//']) ? $u : asset('storage/' . ltrim($u,'/'));
        })->toArray();
    ?>
    "image": <?php echo json_encode($images); ?>,
    "url": "<?php echo e(url($canonicalUrl)); ?>",
    "priceRange": "$$<?php echo e(str_repeat('$', intval($hotel->stars ?? 3))); ?>",
    "starRating": {
        "@type": "Rating",
        "ratingValue": "<?php echo e($hotel->stars ?? 3); ?>"
    },
    "aggregateRating": {
        "@type": "AggregateRating",
        "ratingValue": "<?php echo e($hotel->rating ?? 4.5); ?>",
        "reviewCount": "<?php echo e($hotel->reviews?->count() ?? 0); ?>"
    }
}
</script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<!-- Mensaje de Éxito -->
<?php if(session('success')): ?>
    <div class="container mt-3">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill"></i> <?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
<?php endif; ?>

<div class="container-fluid p-0">
    <!-- Hero Image Section -->
    <div class="position-relative" style="height: 300px; overflow: hidden; margin-top: 80px;">
        <?php if($hotel->images->first()): ?>
            <?php $hero = $hotel->images->first()->url; ?>
            <img src="<?php echo e(\Illuminate\Support\Str::startsWith($hero, ['http://','https://','//']) ? $hero : asset('storage/' . ltrim($hero,'/'))); ?>" 
                 alt="<?php echo e($hotel->name); ?>" 
                 class="w-100 h-100 object-fit-cover"
                 style="object-fit: cover;">
        <?php else: ?>
            <img src="https://via.placeholder.com/1200x500" alt="<?php echo e($hotel->name); ?>" class="w-100 h-100 object-fit-cover" style="object-fit: cover;">
        <?php endif; ?>
        <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark" style="opacity: 0.3;"></div>
        
        <!-- Back Button -->
        <div class="position-absolute top-3 start-3">
            <a href="javascript:history.back()" class="btn btn-light rounded-circle" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                <i class="bi bi-arrow-left"></i>
            </a>
        </div>

        <!-- Title on Image -->
        <div class="position-absolute bottom-0 start-0 w-100 p-4" style="background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);">
            <h1 class="text-white mb-2"><?php echo e($hotel->name); ?></h1>
            <p class="text-light mb-0"><?php echo e($hotel->destination_id); ?>, <?php echo e($hotel->province_id); ?></p>
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
                            <?php for($i = 0; $i < floor($hotel->rating); $i++): ?>
                                <i class="bi bi-star-fill text-warning"></i>
                            <?php endfor; ?>
                            <?php if($hotel->rating % 1 > 0): ?>
                                <i class="bi bi-star-half text-warning"></i>
                            <?php endif; ?>
                        </div>
                        <span class="badge bg-success"><?php echo e($hotel->rating); ?></span>
                        <small class="text-muted">(<?php echo e($hotel->reviews->count()); ?> reseñas)</small>
                    </div>
                </div>

                <!-- Description -->
                <div class="mb-5">
                    <h3>Descripción</h3>
                    <p class="lead"><?php echo e($hotel->description); ?></p>
                </div>

                <!-- Image Gallery -->
                <div class="mb-5">
                    <h3 class="mb-4">Galería</h3>
                    
                    <!-- Main Image -->
                    <div class="mb-4">
                        <div style="position: relative; height: 400px; border-radius: 12px; overflow: hidden; box-shadow: 0 8px 24px rgba(0,0,0,0.15);">
                            <?php if($hotel->images->first()): ?>
                                <?php $mainImg = $hotel->images->first()->url; ?>
                                <img src="<?php echo e(\Illuminate\Support\Str::startsWith($mainImg, ['http://','https://','//']) ? $mainImg : asset('storage/' . ltrim($mainImg,'/'))); ?>" 
                                     alt="<?php echo e($hotel->name); ?>" 
                                     class="w-100 h-100" 
                                     style="object-fit: cover;">
                            <?php else: ?>
                                <img src="https://via.placeholder.com/1200x500" alt="<?php echo e($hotel->name); ?>" class="w-100 h-100" style="object-fit: cover;">
                            <?php endif; ?>
                            <div style="position: absolute; top: 10px; left: 10px; background: linear-gradient(135deg, #667eea, #764ba2); color: white; padding: 8px 14px; border-radius: 6px; font-size: 0.85rem; font-weight: 600;">
                                <i class="bi bi-image"></i> Imagen Principal
                            </div>
                        </div>
                    </div>

                    <!-- Additional Images - Carousel Style -->
                    <?php if($hotel->images->count() > 1): ?>
                        <div class="mb-4">
                            <h5 class="mb-3">
                                <i class="bi bi-images"></i> Más Fotos del Hotel (<?php echo e($hotel->images->count() - 1); ?>)
                            </h5>
                            <div id="imageCarousel" class="carousel slide" data-bs-ride="false">
                                <div class="carousel-inner">
                                    <?php $__currentLoopData = $hotel->images->skip(1); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="carousel-item <?php echo e($index === 0 ? 'active' : ''); ?>">
                                                <?php $imgUrl = $image->url; ?>
                                                <img src="<?php echo e(\Illuminate\Support\Str::startsWith($imgUrl, ['http://','https://','//']) ? $imgUrl : asset('storage/' . ltrim($imgUrl,'/'))); ?>" 
                                                    alt="<?php echo e($image->alt_text ?? $hotel->name); ?>" 
                                                    class="d-block w-100 rounded" 
                                                    style="height: 300px; object-fit: cover;">
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                                <?php if($hotel->images->count() > 2): ?>
                                    <button class="carousel-control-prev" type="button" data-bs-target="#imageCarousel" data-bs-slide="prev" style="top: 50%; transform: translateY(-50%); left: 10px; width: auto; background: none; border: none;">
                                        <span style="background: rgba(0,0,0,0.5); padding: 10px 12px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                            <i class="bi bi-chevron-left" style="color: white; font-size: 1.2rem;"></i>
                                        </span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#imageCarousel" data-bs-slide="next" style="top: 50%; transform: translateY(-50%); right: 10px; width: auto; background: none; border: none;">
                                        <span style="background: rgba(0,0,0,0.5); padding: 10px 12px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                            <i class="bi bi-chevron-right" style="color: white; font-size: 1.2rem;"></i>
                                        </span>
                                    </button>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Image Grid Thumbnails -->
                    <?php if($hotel->images->count() > 2): ?>
                        <div class="row g-2 mt-3">
                            <div class="col-12">
                                <h6 style="color: #333; font-weight: 600; margin-bottom: 1rem;">Galería de Fotos</h6>
                            </div>
                            <?php $__currentLoopData = $hotel->images->skip(1)->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-md-4 col-sm-6">
                                    <div style="position: relative; height: 150px; border-radius: 8px; overflow: hidden; cursor: pointer; transition: all 0.3s ease;" 
                                         onmouseover="this.style.transform='scale(1.05)'; this.style.boxShadow='0 8px 16px rgba(0,0,0,0.2)'" 
                                         onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='none'">
                                        <?php $thumb = $image->url; ?>
                                        <img src="<?php echo e(\Illuminate\Support\Str::startsWith($thumb, ['http://','https://','//']) ? $thumb : asset('storage/' . ltrim($thumb,'/'))); ?>" 
                                            alt="<?php echo e($image->alt_text ?? $hotel->name); ?>" 
                                            class="img-fluid" 
                                            style="height: 100%; width: 100%; object-fit: cover;">
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Amenities -->
                <div class="mb-5">
                    <h3 class="mb-4">Amenidades del Hotel</h3>
                    <?php if($hotel->amenities->count() > 0): ?>
                        <div class="row g-3">
                            <?php $__currentLoopData = $hotel->amenities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $amenity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-md-6">
                                    <div style="padding: 1rem; background: linear-gradient(135deg, #f8f9ff, #f0f1ff); border-radius: 10px; border-left: 4px solid #667eea; transition: all 0.3s ease; cursor: pointer;" 
                                         onmouseover="this.style.boxShadow='0 8px 16px rgba(102, 126, 234, 0.15)'; this.style.transform='translateY(-2px)'" 
                                         onmouseout="this.style.boxShadow='none'; this.style.transform='translateY(0)'">
                                        <div class="d-flex align-items-center gap-3">
                                            <div style="background: linear-gradient(135deg, #667eea, #764ba2); color: white; width: 45px; height: 45px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.3rem; flex-shrink: 0;">
                                                <?php
                                                    $icons = [
                                                        'WiFi' => 'bi-wifi',
                                                        'Piscina' => 'bi-water',
                                                        'Estacionamiento' => 'bi-car-front',
                                                        'AC' => 'bi-snow',
                                                        'Desayuno' => 'bi-cup-hot',
                                                        'Recepción 24h' => 'bi-clock',
                                                    ];
                                                    $icon = $icons[$amenity->name] ?? 'bi-check-circle';
                                                ?>
                                                <i class="bi <?php echo e($icon); ?>"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-0" style="color: #333; font-weight: 600;"><?php echo e($amenity->name); ?></h6>
                                                <small style="color: #666;">Disponible en el hotel</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-info">
                            <i class="bi bi-info-circle"></i> No se han especificado amenidades para este hotel.
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Hotel Info -->
                <div class="mb-5">
                    <h3>Información</h3>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="card border-0 bg-light p-3">
                                <small class="text-muted">Número de Habitaciones</small>
                                <h5 class="mb-0"><?php echo e($hotel->rooms_count); ?></h5>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card border-0 bg-light p-3">
                                <small class="text-muted">Ubicación</small>
                                <h5 class="mb-0"><?php echo e($hotel->destinations->first()?->name ?? 'N/A'); ?></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Price Card -->
                <div class="card position-sticky border-0" style="top: 20px; border-radius: 12px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.06); background: #fff;">
                    <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 1.25rem 1rem;">
                        <small style="opacity: 0.9; font-size: 0.75rem;">Desde</small>
                        <?php
                            $minPrice = $hotel->pricing()->min('price') ?? 100;
                        ?>
                        <h3 class="mb-0" style="font-weight: 700; margin-top: 0.25rem; font-size: 1.75rem;">
                            $<?php echo e(number_format($minPrice, 2)); ?>

                            <small style="font-size: 0.4em; opacity: 0.9;">/noche</small>
                        </h3>
                    </div>

                    <div class="card-body" style="padding: 1.25rem;">
                        <!-- Pricing by Season -->
                        <?php if($hotel->pricing()->count() > 0): ?>
                            <div class="mb-3">
                                <h6 class="mb-2" style="color: #333; font-weight: 600; font-size: 0.9rem;">
                                    <i class="bi bi-calendar3"></i> Precios
                                </h6>
                                <div style="background: linear-gradient(135deg, #f8f9ff, #f0f1ff); padding: 0.75rem; border-radius: 8px; font-size: 0.85rem;">
                                    <?php $__currentLoopData = $hotel->pricing()->orderBy('rate_type_id')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $price): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $rateType = \App\Models\RateType::find($price->rate_type_id);
                                        ?>
                                        <div class="d-flex justify-content-between align-items-center mb-1 pb-1" style="border-bottom: 1px solid #e0e0e0;">
                                            <span style="color: #555;">
                                                <?php echo e($rateType?->name ?? 'Tarifa'); ?>

                                            </span>
                                            <strong style="color: #667eea;">$<?php echo e(number_format($price->price, 2)); ?></strong>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- Booking Button -->
                        <button class="btn w-100 mb-2" style="background: linear-gradient(135deg, #1eaa60, #15c25a); color: white; font-weight: 600; padding: 0.65rem; border-radius: 8px; border: none; transition: all 0.3s ease; box-shadow: 0 2px 6px rgba(26, 170, 96, 0.15); font-size: 0.9rem;" 
                                onmouseover="this.style.transform='translateY(-1px)'; this.style.boxShadow='0 4px 12px rgba(26, 170, 96, 0.25)'"
                                onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 6px rgba(26, 170, 96, 0.15)'">
                            <i class="bi bi-calendar-check"></i> Reservar
                        </button>

                        <!-- Contact Info -->
                        <div style="border-top: 1px solid #e0e0e0; padding-top: 0.75rem; font-size: 0.85rem;">
                            <?php if($hotel->phone): ?>
                                <div class="mb-1">
                                    <small style="color: #666; display: block;">Teléfono</small>
                                    <a href="tel:<?php echo e($hotel->phone); ?>" style="color: #667eea; text-decoration: none; font-weight: 600;">
                                        <?php echo e($hotel->phone); ?>

                                    </a>
                                </div>
                            <?php endif; ?>
                            <?php if($hotel->email): ?>
                                <div class="mb-1">
                                    <small style="color: #666; display: block;">Email</small>
                                    <a href="mailto:<?php echo e($hotel->email); ?>" style="color: #667eea; text-decoration: none; font-weight: 600; word-break: break-all; display: block; max-width: 100%;">
                                        <?php echo e(substr($hotel->email, 0, 25)); ?>...
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Hotels Section -->
    <div class="bg-light py-5">
        <div class="container">
            <h3 class="mb-4">Otros Hoteles en <?php echo e($hotel->destinations->first()?->name ?? 'Esta Área'); ?></h3>
            <div class="row g-4">
                <?php
                    $otherHotels = \App\Models\Hotel::where('id', '!=', $hotel->id)->limit(3)->get();
                ?>
                <?php $__empty_1 = true; $__currentLoopData = $otherHotels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $otherHotel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="col-md-4">
                        <div class="card shadow-sm">
                            <img src="<?php echo e($otherHotel->images->first() ? asset('storage/' . $otherHotel->images->first()->url) : 'https://via.placeholder.com/400x250'); ?>" class="card-img-top" alt="<?php echo e($otherHotel->name); ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo e($otherHotel->name); ?></h5>
                                <p class="card-text text-muted"><?php echo e($otherHotel->rating); ?> ★ (<?php echo e($otherHotel->reviews->count()); ?> reseñas)</p>
                                <p class="h5 mb-3">$<?php echo e(number_format($otherHotel->base_price ?? 100, 0)); ?><small>/noche</small></p>
                                <a href="/<?php echo e(app()->getLocale()); ?>/hotel/<?php echo e($otherHotel->slug); ?>" class="btn btn-sm btn-outline-primary">Ver Detalles</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="col-12">
                        <p class="text-muted text-center">No hay otros hoteles disponibles</p>
                    </div>
                <?php endif; ?>
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /mnt/c/Users/Elizabeth/costaricatrippackages/resources/views/hotels/show.blade.php ENDPATH**/ ?>