<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo e(__('tours.listing_meta_description')); ?>">
    <meta name="keywords" content="tours Costa Rica, paquetes turísticos, aventuras, volcanes, selva tropical">
    <meta name="author" content="Costa Rica Trip Packages">
    <meta name="language" content="<?php echo e(app()->getLocale() === 'es' ? 'Spanish' : 'English'); ?>">
    
    <!-- Open Graph Tags -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?php echo e(__('tours.listing_og_title', ['default' => __('tours.listing_title')])); ?>">
    <meta property="og:description" content="<?php echo e(__('tours.listing_og_description', ['default' => __('tours.listing_meta_description')])); ?>">
    <meta property="og:image" content="<?php echo e(asset('images/og-tours.jpg')); ?>">
    <meta property="og:url" content="<?php echo e(url()->current()); ?>">
    <meta property="og:site_name" content="Costa Rica Trip Packages">
    <meta property="og:locale" content="<?php echo e(app()->getLocale() === 'es' ? 'es_CR' : 'en_US'); ?>">
    
    <!-- Twitter Card Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo e(__('tours.listing_og_title', ['default' => __('tours.listing_title')])); ?>">
    <meta name="twitter:description" content="<?php echo e(__('tours.listing_og_description', ['default' => __('tours.listing_meta_description')])); ?>">
    <meta name="twitter:image" content="<?php echo e(asset('images/og-tours.jpg')); ?>">
    
    <?php if(config('app.env') !== 'production'): ?>
    <meta name="robots" content="noindex, nofollow">
    <?php else: ?>
    <meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
    <?php endif; ?>
    
    <title><?php echo e(__('tours.listing_title')); ?></title>
    
    <!-- Canonical URL -->
    <link rel="canonical" href="<?php echo e(url()->current()); ?>">
    <link rel="alternate" hreflang="es" href="<?php echo e(route('tours.index.es')); ?>">
    <link rel="alternate" hreflang="en" href="<?php echo e(route('tours.index.en')); ?>">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary-color: #00A86B;
            --secondary-color: #0066CC;
            --accent-color: #FF6B35;
            --dark: #1a1a1a;
            --light: #f8f9fa;
            --gray: #6c757d;
        }

        body {
            font-family: 'Poppins', sans-serif;
            line-height: 1.6;
            color: var(--dark);
        }

        /* Navbar */
        .navbar {
            position: fixed;
            top: 0;
            width: 100%;
            background: white;
            box-shadow: 0 2px 20px rgba(0,0,0,0.1);
            z-index: 1000;
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 2rem;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-color);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .nav-menu {
            display: flex;
            list-style: none;
            gap: 2rem;
            align-items: center;
        }

        .nav-menu a {
            text-decoration: none;
            color: var(--dark);
            font-weight: 500;
            transition: color 0.3s;
        }

        .nav-menu a:hover {
            color: var(--primary-color);
        }

        /* Page Header */
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

        .page-header p {
            font-size: 1.2rem;
            max-width: 600px;
            margin: 0 auto;
        }

        /* Filters */
        .filters-section {
            background: white;
            padding: 2rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .filters {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .filter-group label {
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--gray);
        }

        .filter-group select,
        .filter-group input {
            padding: 0.7rem 1rem;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-family: 'Poppins', sans-serif;
            transition: border-color 0.3s;
        }

        .filter-group select:focus,
        .filter-group input:focus {
            outline: none;
            border-color: var(--primary-color);
        }

        .filter-button {
            padding: 0.7rem 2rem;
            background: var(--primary-color);
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 1.5rem;
        }

        .filter-button:hover {
            background: #008f5c;
            transform: translateY(-2px);
        }

        /* Tours Grid */
        .tours-section {
            padding: 3rem 2rem;
            background: var(--light);
        }

        .section-info {
            text-align: center;
            margin-bottom: 2rem;
        }

        .tours-count {
            font-size: 1.1rem;
            color: var(--gray);
        }

        .tours-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }

        .tour-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            transition: all 0.3s;
            display: flex;
            flex-direction: column;
        }

        .tour-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 35px rgba(0,0,0,0.15);
        }

        .tour-image-wrapper {
            position: relative;
            height: 220px;
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

        .tour-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background: var(--accent-color);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .tour-content {
            padding: 1.5rem;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .tour-category {
            color: var(--primary-color);
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
            color: var(--primary-color);
        }

        .tour-price small {
            font-size: 0.7rem;
            font-weight: 400;
            color: var(--gray);
            display: block;
        }

        .tour-button {
            padding: 0.8rem 1.8rem;
            background: var(--secondary-color);
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s;
            display: inline-block;
        }

        .tour-button:hover {
            background: #0052a3;
            transform: translateY(-2px);
        }

        /* Pagination */
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
            transition: all 0.3s;
        }

        .page-link:hover,
        .page-link.active {
            background: var(--primary-color);
            color: white;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .page-header h1 {
                font-size: 2rem;
            }

            .filters {
                flex-direction: column;
                width: 100%;
            }

            .filter-group {
                width: 100%;
            }

            .tours-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
    
    <!-- Schema.org JSON-LD - Tours Collection -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "CollectionPage",
        "name": "<?php echo e(__('tours.listing_title')); ?>",
        "description": "<?php echo e(__('tours.listing_meta_description')); ?>",
        "url": "<?php echo e(url()->current()); ?>",
        "mainEntity": {
            "@type": "ItemList",
            "itemListElement": [
                <?php
                    $toursArray = \App\Models\Tour::get();
                ?>
                <?php $__currentLoopData = $toursArray; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $tour): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                {
                    "@type": "ListItem",
                    "position": <?php echo e($index + 1); ?>,
                    "item": {
                        "@type": "TouristAttraction",
                        "@id": "<?php echo e(url('/es/tour/' . $tour->slug)); ?>",
                        "name": "<?php echo e(addslashes($tour->name)); ?>",
                        "description": "<?php echo e(addslashes(substr($tour->description, 0, 160))); ?>",
                        "image": "<?php echo e($tour->images->first()?->url ?? asset('images/default-tour.jpg')); ?>",
                        "url": "<?php echo e(url('/es/tour/' . $tour->slug)); ?>",
                        "aggregateRating": {
                            "@type": "AggregateRating",
                            "ratingValue": "<?php echo e($tour->rating ?? 4.5); ?>",
                            "reviewCount": "<?php echo e($tour->reviews?->count() ?? 0); ?>"
                        }
                    }
                }<?php echo e($loop->last ? '' : ','); ?>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            ]
        }
    }
    </script>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="nav-container">
            <a href="<?php echo e(app()->getLocale() === 'es' ? '/es/' : '/en/'); ?>" class="logo">
                <span>🌴</span> Costa Rica Trips
            </a>
            <ul class="nav-menu">
                <li><a href="<?php echo e(app()->getLocale() === 'es' ? '/es/' : '/en/'); ?>"><?php echo e(app()->getLocale() === 'es' ? 'Inicio' : 'Home'); ?></a></li>
                <li><a href="<?php echo e(app()->getLocale() === 'es' ? '/es/tours' : '/en/tours'); ?>" style="color: var(--primary-color);">Tours</a></li>
                <li><a href="<?php echo e(app()->getLocale() === 'es' ? '/es/#destinos' : '/en/#destinos'); ?>"><?php echo e(app()->getLocale() === 'es' ? 'Destinos' : 'Destinations'); ?></a></li>
                <li><a href="/contacto"><?php echo e(app()->getLocale() === 'es' ? 'Contacto' : 'Contact'); ?></a></li>
                <li>
                    <a href="<?php echo e(app()->getLocale() === 'es' ? '/en/tours' : '/es/tours'); ?>" style="color: var(--accent-color); font-weight: 600;">
                        <?php echo e(app()->getLocale() === 'es' ? '🇬🇧 EN' : '🇪🇸 ES'); ?>

                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Page Header -->
    <div class="page-header">
        <h1><?php echo e(__('tours.listing_title')); ?></h1>
        <p><?php echo e(__('tours.listing_subtitle')); ?></p>
    </div>

    <!-- Filters -->
    <div class="filters-section">
        <div class="container">
            <div class="filters">
                <div class="filter-group">
                    <label><?php echo e(__('tours.filter_destination')); ?></label>
                    <select id="destinoFilter">
                        <option value=""><?php echo e(__('tours.all_destinations')); ?></option>
                        <option value="arenal">Arenal</option>
                        <option value="manuel-antonio">Manuel Antonio</option>
                        <option value="monteverde">Monteverde</option>
                        <option value="tortuguero">Tortuguero</option>
                        <option value="tamarindo">Tamarindo</option>
                    </select>
                </div>

                <div class="filter-group">
                    <label><?php echo e(__('tours.filter_duration')); ?></label>
                    <select id="durationFilter">
                        <option value=""><?php echo e(app()->getLocale() === 'es' ? 'Todas las duraciones' : 'All durations'); ?></option>
                        <option value="1"><?php echo e(app()->getLocale() === 'es' ? '1 día' : '1 day'); ?></option>
                        <option value="2"><?php echo e(app()->getLocale() === 'es' ? '2-3 días' : '2-3 days'); ?></option>
                        <option value="4"><?php echo e(app()->getLocale() === 'es' ? '4+ días' : '4+ days'); ?></option>
                    </select>
                </div>

                <div class="filter-group">
                    <label><?php echo e(__('tours.filter_price')); ?></label>
                    <input type="number" id="priceFilter" placeholder="$500" min="0">
                </div>

                <button class="filter-button" onclick="applyFilters()"><?php echo e(__('tours.apply_filters')); ?></button>
            </div>
        </div>
    </div>

    <!-- Tours Section -->
    <section class="tours-section">
        <div class="container">
            <div class="section-info">
                <p class="tours-count"><?php echo e(__('tours.showing_results')); ?> <strong id="tourCount">10</strong> <?php echo e(__('tours.results')); ?></p>
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

    <script>
        const allTours = <?php echo json_encode(\App\Models\Tour::get()->map(function($tour) {
            return [
                'id' => $tour->id,
                'title' => $tour->name,
                'slug' => $tour->slug,
                'category' => $tour->category,
                'price' => $tour->price,
                'duration' => $tour->duration,
                'people' => $tour->people,
                'description' => $tour->description,
                'image' => $tour->image ?? 'https://images.unsplash.com/photo-1568605117036-5fe5e7bab0b7?w=600&q=80',
                'destinations' => $tour->destinations->pluck('id')->toArray()
            ];
        })->toArray()); ?>;

        // Get filtered tours from server
        const filteredTours = <?php echo json_encode($tours->map(function($tour) {
            return [
                'id' => $tour->id,
                'title' => $tour->name,
                'slug' => $tour->slug,
                'category' => $tour->category,
                'price' => $tour->price,
                'duration' => $tour->duration,
                'people' => $tour->people,
                'description' => $tour->description,
                'image' => $tour->image ?? 'https://images.unsplash.com/photo-1568605117036-5fe5e7bab0b7?w=600&q=80',
                'destinations' => $tour->destinations->pluck('id')->toArray()
            ];
        })->toArray()); ?>;

        // Check if we're filtering by destination
        const urlParams = new URLSearchParams(window.location.search);
        const destinationId = urlParams.get('destination_id');
        const isFiltered = destinationId !== null;

        function renderTours(tours) {
            const grid = document.getElementById('toursGrid');
            const count = document.getElementById('tourCount');
            
            grid.innerHTML = '';
            count.textContent = tours.length;

            if (tours.length === 0) {
                grid.innerHTML = '<div style="grid-column: 1 / -1; text-align: center; padding: 3rem;"><?php echo e(app()->getLocale() === "es" ? "No hay tours disponibles para este destino" : "No tours available for this destination"); ?></div>';
                return;
            }

            tours.forEach(tour => {
                const card = `
                    <div class="tour-card">
                        <div class="tour-image-wrapper">
                            <img src="${tour.image}" alt="${tour.title}" class="tour-image" loading="lazy">
                            ${tour.badge ? `<div class="tour-badge">${tour.badge}</div>` : ''}
                        </div>
                        <div class="tour-content">
                            <div class="tour-category">${tour.category}</div>
                            <h3 class="tour-title">${tour.title}</h3>
                            <p class="tour-description">${tour.description}</p>
                            <div class="tour-features">
                                <div class="feature">
                                    <span>⏱️</span> ${tour.duration}
                                </div>
                                <div class="feature">
                                    <span>👥</span> ${tour.people}
                                </div>
                            </div>
                            <div class="tour-footer">
                                <div class="tour-price">
                                    $${tour.price}
                                    <small><?php echo e(app()->getLocale() === "es" ? "por persona" : "per person"); ?></small>
                                </div>
                                <a href="/<?php echo e(app()->getLocale()); ?>/provincia/guanacaste/destino/arenal/tour/${tour.slug}" class="tour-button"><?php echo e(app()->getLocale() === "es" ? "Ver Tour" : "View Tour"); ?></a>
                            </div>
                        </div>
                    </div>
                `;
                grid.innerHTML += card;
            });
        }

        function applyFilters() {
            // Placeholder for filtering logic
            alert('<?php echo e(app()->getLocale() === "es" ? "Filtros aplicados (funcionalidad completa en siguiente fase)" : "Filters applied (full functionality in next phase)"); ?>');
        }

        // Initial render
        renderTours(filteredTours.length > 0 ? filteredTours : allTours);
    </script>

    <!-- Footer -->
    <footer style="background: linear-gradient(135deg, var(--accent-color) 0%, var(--primary-color) 100%); color: white; padding: 3rem 2rem 1rem; margin-top: 5rem; text-align: center;">
        <div style="max-width: 1200px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem; margin-bottom: 2rem;">
            <div style="text-align: left;">
                <p>&copy; 2025 Costa Rica Trip Packages. <?php echo e(app()->getLocale() === 'es' ? 'Todos los derechos reservados.' : 'All rights reserved.'); ?></p>
                <p><?php echo e(app()->getLocale() === 'es' ? 'WhatsApp' : 'WhatsApp'); ?>: <a href="https://wa.me/506" style="color: white; text-decoration: none;">+506 1234-5678</a></p>
            </div>
            <div style="display: flex; gap: 1rem;">
                <a href="<?php echo e(app()->getLocale() === 'es' ? '/en/tours' : '/es/tours'); ?>" style="display: inline-block; padding: 0.6rem 1.2rem; background: var(--primary-color); color: white; text-decoration: none; border-radius: 50px; font-weight: 700; transition: all 0.3s;"><?php echo e(app()->getLocale() === 'es' ? '🇬🇧 English' : '🇪🇸 Español'); ?></a>
            </div>
        </div>
    </footer>
</body>
</html>
<?php /**PATH /home/elizabeth/costaricatrippackages/resources/views/tours/index.blade.php ENDPATH**/ ?>