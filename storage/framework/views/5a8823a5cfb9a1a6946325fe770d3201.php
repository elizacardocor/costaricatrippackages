<?php $__env->startSection('content'); ?>
<div style="margin-top: 80px;">
    <!-- Header Section -->
    <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 3rem 2rem; text-align: center;">
        <div class="container">
            <h1 style="font-size: 2.5rem; font-weight: 700; margin-bottom: 1rem;">
                🏨 <?php echo e(app()->getLocale() === 'es' ? 'Hoteles en Costa Rica' : 'Hotels in Costa Rica'); ?>

            </h1>
            <?php if($destination): ?>
                <p style="font-size: 1.2rem; opacity: 0.9;">
                    <?php echo e(app()->getLocale() === 'es' ? 'Hospedaje en' : 'Accommodation in'); ?> <strong><?php echo e($destination->name); ?></strong>
                </p>
            <?php endif; ?>
            <p style="opacity: 0.9;">
                <?php echo e($hotels->total()); ?> <?php echo e(app()->getLocale() === 'es' ? 'hoteles disponibles' : 'available hotels'); ?>

            </p>
        </div>
    </div>

    <!-- Hotels Grid -->
    <div class="container py-5">
        <?php if($hotels->count() > 0): ?>
            <div class="row g-4">
                <?php $__currentLoopData = $hotels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hotel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="card shadow-sm border-0" style="border-radius: 12px; overflow: hidden; transition: all 0.3s ease; height: 100%;"
                             onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 12px 24px rgba(0,0,0,0.15)'"
                             onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 8px rgba(0,0,0,0.1)'">
                            
                            <!-- Image -->
                            <div style="height: 220px; overflow: hidden; background: #f0f0f0;">
                                <?php if($hotel->images->first()): ?>
                                    <img src="<?php echo e(asset('storage/' . $hotel->images->first()->url)); ?>" 
                                         alt="<?php echo e($hotel->name); ?>" 
                                         style="width: 100%; height: 100%; object-fit: cover;">
                                <?php else: ?>
                                    <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; color: #999;">
                                        <i class="bi bi-image" style="font-size: 3rem;"></i>
                                    </div>
                                <?php endif; ?>
                                <div style="position: absolute; top: 10px; right: 10px; background: rgba(102, 126, 234, 0.95); color: white; padding: 6px 12px; border-radius: 20px; font-size: 0.85rem; font-weight: 600;">
                                    ⭐ <?php echo e($hotel->stars ?? 3); ?>/5
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="card-body" style="padding: 1.5rem;">
                                <h5 class="card-title" style="font-weight: 700; color: #333; margin-bottom: 0.5rem;">
                                    <?php echo e($hotel->name); ?>

                                </h5>
                                
                                <p style="color: #666; font-size: 0.9rem; margin-bottom: 1rem;">
                                    <i class="bi bi-geo-alt"></i> 
                                    <?php echo e($hotel->destinations->first()?->name ?? 'Costa Rica'); ?>

                                </p>

                                <!-- Price -->
                                <?php
                                    $minPrice = $hotel->pricing()->min('price') ?? 100;
                                ?>
                                <div style="background: linear-gradient(135deg, #f8f9ff, #f0f1ff); padding: 1rem; border-radius: 8px; margin-bottom: 1rem; border-left: 4px solid #667eea;">
                                    <small style="color: #666;"><?php echo e(app()->getLocale() === 'es' ? 'Desde' : 'From'); ?></small>
                                    <h6 style="color: #667eea; font-weight: 700; margin: 0;">
                                        ₡<?php echo e(number_format($minPrice, 0)); ?> <small style="font-size: 0.7rem; opacity: 0.8;">/<?php echo e(app()->getLocale() === 'es' ? 'noche' : 'night'); ?></small>
                                    </h6>
                                </div>

                                <!-- Amenities -->
                                <?php if($hotel->amenities->count() > 0): ?>
                                    <div style="margin-bottom: 1rem;">
                                        <small style="color: #666; display: block; margin-bottom: 0.5rem;"><?php echo e(app()->getLocale() === 'es' ? 'Amenidades' : 'Amenities'); ?></small>
                                        <div style="display: flex; flex-wrap: wrap; gap: 0.5rem;">
                                            <?php $__currentLoopData = $hotel->amenities->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $amenity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <span style="background: #e8f0fe; color: #667eea; padding: 4px 10px; border-radius: 20px; font-size: 0.75rem; font-weight: 600;">
                                                    <?php echo e($amenity->name); ?>

                                                </span>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($hotel->amenities->count() > 3): ?>
                                                <span style="background: #e8f0fe; color: #667eea; padding: 4px 10px; border-radius: 20px; font-size: 0.75rem; font-weight: 600;">
                                                    +<?php echo e($hotel->amenities->count() - 3); ?>

                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <!-- View Details Button -->
                                <?php
                                    $dest = $hotel->destinations->first();
                                    $detailUrl = route('hotel.show.complex.' . app()->getLocale(), [
                                        'province' => $dest?->province?->slug ?? 'costa-rica',
                                        'destination' => $dest?->slug ?? 'general',
                                        'hotel' => $hotel->slug,
                                    ]);
                                ?>
                                <a href="<?php echo e($detailUrl); ?>" 
                                   class="btn w-100" 
                                   style="background: linear-gradient(135deg, #667eea, #764ba2); color: white; font-weight: 600; border-radius: 8px; border: none;">
                                    <?php echo e(app()->getLocale() === 'es' ? 'Ver Detalles' : 'View Details'); ?>

                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <!-- Pagination -->
            <?php if($hotels->hasPages()): ?>
                <div style="margin-top: 3rem; display: flex; justify-content: center;">
                    <?php echo e($hotels->links()); ?>

                </div>
            <?php endif; ?>
        <?php else: ?>
            <div class="alert alert-info text-center" style="padding: 3rem; border-radius: 12px;">
                <i class="bi bi-info-circle" style="font-size: 2rem;"></i>
                <h4 style="margin-top: 1rem; margin-bottom: 0.5rem;">
                    <?php echo e(app()->getLocale() === 'es' ? 'No hay hoteles disponibles' : 'No hotels available'); ?>

                </h4>
                <p style="margin: 0; color: #666;">
                    <?php echo e(app()->getLocale() === 'es' ? 'Intenta otra búsqueda' : 'Try another search'); ?>

                </p>
            </div>
        <?php endif; ?>
    </div>

    <!-- CTA Section -->
    <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 4rem 2rem; text-align: center; margin-top: 4rem;">
        <div class="container">
            <h2 style="font-size: 2rem; font-weight: 700; margin-bottom: 1.5rem;">
                <?php echo e(app()->getLocale() === 'es' ? '¿No encontraste lo que buscas?' : "Didn't find what you're looking for?"); ?>

            </h2>
            <p style="font-size: 1.1rem; opacity: 0.9; margin-bottom: 2rem;">
                <?php echo e(app()->getLocale() === 'es' ? 'Registra tu hotel y únete a nuestra plataforma' : 'Register your hotel and join our platform'); ?>

            </p>
            <a href="<?php echo e(app()->getLocale() === 'es' ? '/es/registrar_servicio' : '/en/register_service'); ?>" 
               class="btn btn-light" 
               style="font-weight: 700; padding: 0.85rem 2rem; border-radius: 8px;">
                <?php echo e(app()->getLocale() === 'es' ? '➕ Agregar un Hotel' : '➕ Add a Hotel'); ?>

            </a>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /mnt/c/Users/Elizabeth/costaricatrippackages/resources/views/hotels/index.blade.php ENDPATH**/ ?>