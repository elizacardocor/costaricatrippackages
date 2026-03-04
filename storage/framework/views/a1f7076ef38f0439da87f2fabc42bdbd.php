

<?php $__env->startSection('title', __('home.title') . ' - ' . __('home.subtitle')); ?>
<?php $__env->startSection('meta_description', __('home.meta_description')); ?>
<?php $__env->startSection('meta_keywords', __('home.meta_keywords')); ?>

<?php $__env->startSection('og_title', __('home.og_title', ['default' => __('home.title')])); ?>
<?php $__env->startSection('og_description', __('home.og_description', ['default' => __('home.meta_description')])); ?>
<?php $__env->startSection('og_image', asset('images/og-image.jpg')); ?>

<?php $__env->startSection('twitter_title', __('home.og_title', ['default' => __('home.title')])); ?>
<?php $__env->startSection('twitter_description', __('home.og_description', ['default' => __('home.meta_description')])); ?>
<?php $__env->startSection('twitter_image', asset('images/og-image.jpg')); ?>

<?php $__env->startSection('canonical'); ?>
    <link rel="canonical" href="<?php echo e(url('/')); ?>">
    <link rel="alternate" hreflang="es" href="<?php echo e(url('/es')); ?>">
    <link rel="alternate" hreflang="en" href="<?php echo e(url('/en')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('extra_styles'); ?>
<style>
    .hero-section {
        position: relative;
        height: 400px;
        overflow: hidden;
        margin-top: 0;
    }

    .hero-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .hero-section:hover .hero-image {
        transform: scale(1.1);
    }

    .hero-overlay {
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

    .hero-section:hover .hero-overlay {
        opacity: 1;
    }

    .hero-content {
        text-align: center;
        color: white;
        padding: 2rem;
        transform: translateY(20px);
        transition: transform 0.5s ease;
    }

    .hero-section:hover .hero-content {
        transform: translateY(0);
    }

    .hero-content h1 {
        font-size: 3.5rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        text-shadow: 2px 2px 8px rgba(0,0,0,0.5);
    }

    .hero-content p {
        font-size: 1.5rem;
        margin-bottom: 2rem;
        max-width: 800px;
        margin-left: auto;
        margin-right: auto;
        text-shadow: 1px 1px 4px rgba(0,0,0,0.5);
    }

    .hero-buttons {
        display: flex;
        gap: 1rem;
        justify-content: center;
        flex-wrap: wrap;
    }

    .hero-btn {
        padding: 1rem 2.5rem;
        font-size: 1.1rem;
        font-weight: 600;
        border-radius: 50px;
        text-decoration: none;
        transition: all 0.3s;
        display: inline-block;
    }

    .hero-btn-primary {
        background: white;
        color: #00A86B;
    }

    .hero-btn-primary:hover {
        background: #f0f0f0;
        transform: translateY(-3px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.3);
    }

    .hero-btn-secondary {
        background: transparent;
        color: white;
        border: 2px solid white;
    }

    .hero-btn-secondary:hover {
        background: white;
        color: #00A86B;
        transform: translateY(-3px);
    }

    /* Features Section */
    .features-section {
        padding: 4rem 2rem;
        background: #f8f9fa;
    }

    .section-title {
        text-align: center;
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 3rem;
        color: var(--dark);
    }

    .features-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
        max-width: 1200px;
        margin: 0 auto;
    }

    .feature-card {
        background: white;
        padding: 2.5rem;
        border-radius: 15px;
        text-align: center;
        transition: all 0.3s;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }

    .feature-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.15);
    }

    .feature-icon {
        font-size: 3.5rem;
        margin-bottom: 1.5rem;
        color: #00A86B;
    }

    .feature-card h3 {
        font-size: 1.5rem;
        margin-bottom: 1rem;
        color: var(--dark);
    }

    .feature-card p {
        color: var(--gray);
        line-height: 1.8;
    }

    /* Services Section - COMMENTED FOR FUTURE USE
    .services-section {
        padding: 4rem 2rem;
    }

    .services-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 2rem;
        max-width: 1200px;
        margin: 0 auto;
    }

    .service-card {
        position: relative;
        height: 400px;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        cursor: pointer;
        transition: all 0.3s;
    }

    .service-card:hover {
        transform: scale(1.03);
        box-shadow: 0 10px 40px rgba(0,0,0,0.2);
    }

    .service-card img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s;
    }

    .service-card:hover img {
        transform: scale(1.1);
    }

    .service-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(to top, rgba(0,0,0,0.8) 0%, transparent 100%);
        padding: 2rem;
        color: white;
    }

    .service-overlay h3 {
        font-size: 1.8rem;
        margin-bottom: 0.5rem;
    }

    .service-overlay p {
        font-size: 1rem;
        margin-bottom: 1rem;
    }

    .service-link {
        display: inline-block;
        padding: 0.7rem 1.5rem;
        background: #00A86B;
        color: white;
        text-decoration: none;
        border-radius: 25px;
        font-weight: 600;
        transition: all 0.3s;
    }

    .service-link:hover {
        background: #008c5a;
        color: white;
    }
    */

    /* CTA Section */
    .cta-section {
        background: linear-gradient(135deg, #8B0000 0%, #6b0000 100%);
        color: white;
        padding: 4rem 2rem;
        text-align: center;
    }

    .cta-section h2 {
        font-size: 2.5rem;
        margin-bottom: 1.5rem;
    }

    .cta-section p {
        font-size: 1.2rem;
        margin-bottom: 2rem;
        max-width: 700px;
        margin-left: auto;
        margin-right: auto;
    }

    @media (max-width: 768px) {
        .hero-section {
            height: 350px;
        }

        .hero-content h1 {
            font-size: 2.5rem;
        }

        .hero-content p {
            font-size: 1.2rem;
        }

        .features-grid,
        .services-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<!-- Content Box Wrapper -->
<div class="content-box">
    <!-- Hero Section -->
    <section class="hero-section">
        <img src="<?php echo e(asset('images/parqManuelAntonio/playa-parque-nacional-manuel-antonio.jpg')); ?>" alt="Costa Rica Beach" class="hero-image" loading="eager" fetchpriority="high">
        <div class="hero-overlay">
            <div class="hero-content">
                <h1><?php echo e(__('home.hero_title', ['default' => 'Descubre Costa Rica'])); ?></h1>
                <p><?php echo e(__('home.hero_subtitle', ['default' => 'Tours, Hoteles y Transporte - Tu aventura comienza aquí'])); ?></p>
                <div class="hero-buttons">
                    <a href="<?php echo e(app()->getLocale() === 'es' ? '/es/tours' : '/en/tours'); ?>" class="hero-btn hero-btn-primary">
                        <?php echo e(app()->getLocale() === 'es' ? 'Ver Tours' : 'View Tours'); ?>

                    </a>
                    <a href="<?php echo e(app()->getLocale() === 'es' ? '/es/contacto' : '/en/contact'); ?>" class="hero-btn hero-btn-secondary">
                        <?php echo e(app()->getLocale() === 'es' ? 'Contactar' : 'Contact Us'); ?>

                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section">
        <div class="container">
        <h2 class="section-title"><?php echo e(app()->getLocale() === 'es' ? '¿Por qué elegirnos?' : 'Why Choose Us?'); ?></h2>
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">🌴</div>
                <h3><?php echo e(app()->getLocale() === 'es' ? 'Expertos Locales' : 'Local Experts'); ?></h3>
                <p><?php echo e(app()->getLocale() === 'es' ? 'Conocemos cada rincón de Costa Rica y te ofrecemos las mejores experiencias' : 'We know every corner of Costa Rica and offer you the best experiences'); ?></p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">💎</div>
                <h3><?php echo e(app()->getLocale() === 'es' ? 'Calidad Garantizada' : 'Quality Guaranteed'); ?></h3>
                <p><?php echo e(app()->getLocale() === 'es' ? 'Servicios verificados y de la más alta calidad para tu tranquilidad' : 'Verified services of the highest quality for your peace of mind'); ?></p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">⚡</div>
                <h3><?php echo e(app()->getLocale() === 'es' ? 'Reserva Fácil' : 'Easy Booking'); ?></h3>
                <p><?php echo e(app()->getLocale() === 'es' ? 'Proceso simple y rápido, con confirmación inmediata' : 'Simple and fast process with instant confirmation'); ?></p>
            </div>
        </div>
    </div>
</section>

<!-- Services Section - COMMENTED FOR FUTURE USE
<section class="services-section">
    <div class="container">
        <h2 class="section-title"><?php echo e(app()->getLocale() === 'es' ? 'Nuestros Servicios' : 'Our Services'); ?></h2>
        <div class="services-grid">
            <div class="service-card">
                <img src="https://images.unsplash.com/photo-1606040097157-51ea43c33922?w=600&q=80" alt="Tours">
                <div class="service-overlay">
                    <h3>Tours</h3>
                    <p><?php echo e(app()->getLocale() === 'es' ? 'Explora volcanes, playas y selva tropical' : 'Explore volcanoes, beaches and rainforest'); ?></p>
                    <a href="<?php echo e(app()->getLocale() === 'es' ? '/es/tours' : '/en/tours'); ?>" class="service-link">
                        <?php echo e(app()->getLocale() === 'es' ? 'Ver Tours' : 'View Tours'); ?>

                    </a>
                </div>
            </div>
            <div class="service-card">
                <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?w=600&q=80" alt="Hotels">
                <div class="service-overlay">
                    <h3><?php echo e(app()->getLocale() === 'es' ? 'Hoteles' : 'Hotels'); ?></h3>
                    <p><?php echo e(app()->getLocale() === 'es' ? 'Alojamiento de primera clase en los mejores destinos' : 'First class accommodation in the best destinations'); ?></p>
                    <a href="<?php echo e(app()->getLocale() === 'es' ? '/es/hoteles' : '/en/hotels'); ?>" class="service-link">
                        <?php echo e(app()->getLocale() === 'es' ? 'Ver Hoteles' : 'View Hotels'); ?>

                    </a>
                </div>
            </div>
            <div class="service-card">
                <img src="https://images.unsplash.com/photo-1544620347-c4fd4a3d5957?w=600&q=80" alt="Transport">
                <div class="service-overlay">
                    <h3><?php echo e(app()->getLocale() === 'es' ? 'Transporte' : 'Transport'); ?></h3>
                    <p><?php echo e(app()->getLocale() === 'es' ? 'Traslados seguros y cómodos a cualquier destino' : 'Safe and comfortable transfers to any destination'); ?></p>
                    <a href="<?php echo e(app()->getLocale() === 'es' ? '/es/transporte' : '/en/transport'); ?>" class="service-link">
                        <?php echo e(app()->getLocale() === 'es' ? 'Ver Transporte' : 'View Transport'); ?>

                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
-->

<!-- CTA Section for Tourists -->
<section style="background: linear-gradient(135deg, #00A86B 0%, #0066CC 100%); color: white; padding: 4rem 2rem; text-align: center;">
    <div class="container">
        <h2 style="font-size: 2.5rem; font-weight: 700; margin-bottom: 1.5rem;">
            <?php echo e(app()->getLocale() === 'es' ? '¿Listo para tu aventura?' : 'Ready for your adventure?'); ?>

        </h2>
        <p style="font-size: 1.2rem; opacity: 0.95; margin-bottom: 2rem; max-width: 600px; margin-left: auto; margin-right: auto;">
            <?php echo e(app()->getLocale() === 'es' ? 'Contáctanos hoy y comienza a planificar el viaje de tus sueños en Costa Rica' : 'Contact us today and start planning your dream trip to Costa Rica'); ?>

        </p>
        <a href="<?php echo e(app()->getLocale() === 'es' ? '/es/contacto' : '/en/contact'); ?>" 
           style="display: inline-block; background: white; color: #00A86B; padding: 1rem 2.5rem; border-radius: 50px; font-weight: 700; text-decoration: none; transition: all 0.3s;">
            <?php echo e(app()->getLocale() === 'es' ? '📞 Contactar Ahora' : '📞 Contact Now'); ?>

        </a>
    </div>
</section>

<!-- CTA Section for Service Providers -->
<section style="background: linear-gradient(135deg, #FF6B35 0%, #FF9500 100%); color: white; padding: 4rem 2rem; text-align: center;">
    <div class="container">
        <h2 style="font-size: 2.5rem; font-weight: 700; margin-bottom: 1.5rem;">
            <?php echo e(app()->getLocale() === 'es' ? '¿Eres un Proveedor de Servicios Turísticos?' : 'Are you a Tourism Service Provider?'); ?>

        </h2>
        <p style="font-size: 1.2rem; opacity: 0.95; margin-bottom: 2rem; max-width: 600px; margin-left: auto; margin-right: auto;">
            <?php echo e(app()->getLocale() === 'es' ? '¡Únete a nuestra plataforma! Registra tu hotel, tour, servicio de transporte u otro servicio turístico y alcanza a miles de viajeros' : 'Join our platform! Register your hotel, tour, transportation service or other tourism service and reach thousands of travelers'); ?>

        </p>
        <a href="<?php echo e(app()->getLocale() === 'es' ? '/es/registrar_servicio' : '/en/register_service'); ?>" 
           style="display: inline-block; background: white; color: #FF6B35; padding: 1rem 2.5rem; border-radius: 50px; font-weight: 700; text-decoration: none; transition: all 0.3s;">
            <?php echo e(app()->getLocale() === 'es' ? '➕ Registrar Servicio' : '➕ Register Service'); ?>

        </a>
    </div>
</section>
</div><!-- End Content Box -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('extra_scripts'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /mnt/c/Users/Elizabeth/costaricatrippackages/resources/views/home.blade.php ENDPATH**/ ?>