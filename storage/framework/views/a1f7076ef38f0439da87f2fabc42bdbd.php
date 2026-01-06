<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo e(__('home.meta_description')); ?>">
    <meta name="keywords" content="<?php echo e(__('home.meta_keywords')); ?>">
    <meta name="author" content="Costa Rica Trip Packages">
    <meta name="language" content="<?php echo e(app()->getLocale() === 'es' ? 'Spanish' : 'English'); ?>">
    
    <!-- Open Graph Tags -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?php echo e(__('home.og_title', ['default' => __('home.title')])); ?>">
    <meta property="og:description" content="<?php echo e(__('home.og_description', ['default' => __('home.meta_description')])); ?>">
    <meta property="og:image" content="<?php echo e(asset('images/og-image.jpg')); ?>">
    <meta property="og:url" content="<?php echo e(url()->current()); ?>">
    <meta property="og:site_name" content="Costa Rica Trip Packages">
    <meta property="og:locale" content="<?php echo e(app()->getLocale() === 'es' ? 'es_CR' : 'en_US'); ?>">
    
    <!-- Twitter Card Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo e(__('home.og_title', ['default' => __('home.title')])); ?>">
    <meta name="twitter:description" content="<?php echo e(__('home.og_description', ['default' => __('home.meta_description')])); ?>">
    <meta name="twitter:image" content="<?php echo e(asset('images/og-image.jpg')); ?>">
    
    <?php if(config('app.env') !== 'production'): ?>
    <meta name="robots" content="noindex, nofollow">
    <?php else: ?>
    <meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
    <?php endif; ?>
    
    <title><?php echo e(__('home.title')); ?> - <?php echo e(__('home.subtitle')); ?></title>
    
    <!-- Canonical URL -->
    <link rel="canonical" href="<?php echo e(url('/')); ?>">
    <link rel="alternate" hreflang="es" href="<?php echo e(url('/es')); ?>">
    <link rel="alternate" hreflang="en" href="<?php echo e(url('/en')); ?>">
    
    <!-- Preconnect para optimización -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
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
            overflow-x: hidden;
        }

        /* Header/Navigation */
        .navbar {
            position: fixed;
            top: 0;
            width: 100%;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 20px rgba(0,0,0,0.1);
            z-index: 1000;
            transition: all 0.3s ease;
        }

        .navbar.scrolled {
            background: white;
            box-shadow: 0 2px 30px rgba(0,0,0,0.15);
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

        .nav-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
        }

        /* Hero Slider */
        .hero-slider {
            position: relative;
            height: 300px;
            margin-top: 80px;
            overflow: hidden;
        }

        .slide {
            position: absolute;
            width: 100%;
            height: 100%;
            opacity: 0;
            transition: opacity 1s ease-in-out;
        }

        .slide.active {
            opacity: 1;
        }

        .slide-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .slide-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(0,168,107,0.7) 0%, rgba(0,102,204,0.5) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .slide-content {
            text-align: center;
            color: white;
            max-width: 800px;
            padding: 2rem;
            animation: slideUp 1s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .slide-content h1 {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }

        .slide-content p {
            font-size: 1.3rem;
            margin-bottom: 2rem;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
        }

        .cta-button {
            display: inline-block;
            padding: 1rem 3rem;
            background: var(--accent-color);
            color: white;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(255,107,53,0.4);
        }

        .cta-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 25px rgba(255,107,53,0.6);
        }

        .slider-controls {
            position: absolute;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 15px;
            z-index: 10;
        }

        .slider-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: rgba(255,255,255,0.5);
            cursor: pointer;
            transition: all 0.3s;
            border: 2px solid white;
        }

        .slider-dot.active {
            background: white;
            width: 40px;
            border-radius: 10px;
        }

        /* Destinations Section */
        .section {
            padding: 5rem 2rem;
        }

        .section-title {
            text-align: center;
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: var(--dark);
        }

        .section-subtitle {
            text-align: center;
            font-size: 1.1rem;
            color: var(--gray);
            margin-bottom: 3rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .destinations-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }

        .destination-card {
            position: relative;
            border-radius: 20px;
            overflow: hidden;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            height: 350px;
        }

        .destination-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.2);
        }

        .destination-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s;
        }

        .destination-card:hover .destination-image {
            transform: scale(1.1);
        }

        .destination-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.8) 0%, transparent 100%);
            padding: 2rem;
            color: white;
        }

        .destination-name {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .destination-description {
            font-size: 0.9rem;
            opacity: 0.9;
        }
        .destination-card-wrapper {
            position: relative;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            transition: all 0.3s;
            height: 350px;
            cursor: pointer;
        }

        .destination-card-wrapper:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.2);
        }

        .destination-card {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border-radius: 20px;
            overflow: hidden;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: block;
        }

        .destination-card:hover {
            /* hover effect handled by wrapper */
        }

        .destination-actions {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 0.8rem;
            padding: 1.5rem;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.95) 0%, rgba(0, 0, 0, 0.6) 50%, transparent 100%);
            z-index: 10;
            border-radius: 0 0 20px 20px;
        }

        .action-btn {
            padding: 0.9rem 1.1rem;
            border-radius: 12px;
            font-size: 0.9rem;
            font-weight: 700;
            text-decoration: none;
            text-align: center;
            transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            border: 2px solid rgba(255, 255, 255, 0.4);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            white-space: nowrap;
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        }

        .action-btn::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        .action-btn:hover::before {
            width: 300px;
            height: 300px;
        }

        .action-btn {
            z-index: 1;
        }

        .action-btn span {
            position: relative;
            z-index: 2;
            font-size: 1.1rem;
        }

        .action-btn.hotels {
            background: linear-gradient(135deg, #76BB6A 0%, #558B2F 100%);
            color: white;
            box-shadow: 0 6px 15px rgba(66, 165, 245, 0.35);
            border: 2px solid rgba(255, 255, 255, 0.5);
        }

        .action-btn.hotels:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(102, 187, 106, 0.5);
            border-color: rgba(255, 255, 255, 0.8);
        }

        .action-btn.tours {
            background: linear-gradient(135deg, #42A5F5 0%, #1976D2 100%);
            color: white;
            box-shadow: 0 6px 15px rgba(33, 150, 243, 0.35);
            border: 2px solid rgba(255, 255, 255, 0.5);
        }

        .action-btn.tours:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(66, 165, 245, 0.5);
            border-color: rgba(255, 255, 255, 0.8);
        }

        .action-btn.transport {
            background: linear-gradient(135deg, #FFA726 0%, #F57C00 100%);
            color: white;
            box-shadow: 0 6px 15px rgba(255, 87, 34, 0.35);
            border: 2px solid rgba(255, 255, 255, 0.5);
        }

        .action-btn.transport:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(255, 152, 0, 0.5);
            border-color: rgba(255, 255, 255, 0.8);
        }

        .action-btn.plan {
            background: linear-gradient(135deg, #EF5350 0%, #D32F2F 100%);
            color: white;
            box-shadow: 0 6px 15px rgba(233, 30, 99, 0.35);
            border: 2px solid rgba(255, 255, 255, 0.5);
        }

        .action-btn.plan:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(244, 67, 54, 0.5);
            border-color: rgba(255, 255, 255, 0.8);
        }

        /* Destination Modal Styles */
        .destination-modal-content {
            border: none;
            background: white;
            border-radius: 25px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        }

        .destination-modal-close {
            position: absolute;
            top: 20px;
            right: 20px;
            z-index: 1050;
            background: rgba(0,0,0,0.4) !important;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: all 0.3s;
        }

        .destination-modal-close:hover {
            background: rgba(0,0,0,0.6) !important;
            transform: scale(1.1);
        }

        .destination-modal-image-wrapper {
            position: relative;
            width: 100%;
            height: 400px;
            overflow: hidden;
        }

        .destination-modal-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .destination-modal-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0.4) 50%, transparent 100%);
            padding: 3rem 2rem 2rem;
            color: white;
        }

        .destination-modal-title {
            font-size: 3rem;
            font-weight: 800;
            margin: 0;
            text-shadow: 0 2px 8px rgba(0,0,0,0.3);
        }

        .destination-modal-body {
            padding: 3rem 2rem;
        }

        .destination-modal-description {
            font-size: 1.1rem;
            line-height: 1.8;
            color: #333;
            margin-bottom: 3rem;
            text-align: center;
        }

        .destination-modal-actions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
        }

        .modal-action-btn {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1.5rem;
            border-radius: 15px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            color: white;
            font-weight: 700;
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
            position: relative;
            overflow: hidden;
        }

        .modal-action-btn span {
            font-size: 2rem;
        }

        .modal-action-btn div {
            text-align: left;
        }

        .btn-title {
            font-size: 1.1rem;
            font-weight: 800;
            margin-bottom: 0.3rem;
        }

        .btn-subtitle {
            font-size: 0.85rem;
            opacity: 0.9;
        }

        .modal-action-btn.hotels {
            background: linear-gradient(135deg, #76BB6A 0%, #558B2F 100%);
        }

        .modal-action-btn.hotels:hover {
            transform: translateY(-4px);
            box-shadow: 0 15px 35px rgba(102, 187, 106, 0.4);
        }

        .modal-action-btn.tours {
            background: linear-gradient(135deg, #42A5F5 0%, #1976D2 100%);
        }

        .modal-action-btn.tours:hover {
            transform: translateY(-4px);
            box-shadow: 0 15px 35px rgba(66, 165, 245, 0.4);
        }

        .modal-action-btn.transport {
            background: linear-gradient(135deg, #FFA726 0%, #F57C00 100%);
        }

        .modal-action-btn.transport:hover {
            transform: translateY(-4px);
            box-shadow: 0 15px 35px rgba(255, 152, 0, 0.4);
        }

        .modal-action-btn.plan {
            background: linear-gradient(135deg, #EF5350 0%, #D32F2F 100%);
        }

        .modal-action-btn.plan:hover {
            transform: translateY(-4px);
            box-shadow: 0 15px 35px rgba(244, 67, 54, 0.4);
        }

        /* Related Tours in Modal */
        .related-tour-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 3px 12px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            border: 1px solid #eee;
        }

        .related-tour-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        }

        .related-tour-image {
            width: 100%;
            height: 120px;
            object-fit: cover;
        }

        .related-tour-content {
            padding: 1rem;
        }

        .related-tour-title {
            font-size: 0.95rem;
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 0.5rem;
            line-height: 1.3;
        }

        .related-tour-price {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 0.8rem;
        }

        .related-tour-btn {
            display: block;
            width: 100%;
            padding: 0.6rem;
            background: var(--secondary-color);
            color: white;
            text-align: center;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.85rem;
            transition: all 0.3s;
        }

        .related-tour-btn:hover {
            background: #0052a3;
            transform: translateY(-2px);
        }

        /* Tours Section */
        .tours-section {
            background: var(--light);
        }

        .tours-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
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

        .tour-header {
            display: flex;
            justify-content: space-between;
            align-items: start;
            margin-bottom: 1rem;
        }

        .tour-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 0.5rem;
        }

        .tour-price {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-color);
            white-space: nowrap;
        }

        .tour-price small {
            font-size: 0.8rem;
            font-weight: 400;
            color: var(--gray);
        }

        .tour-description {
            color: var(--gray);
            margin-bottom: 1rem;
            line-height: 1.6;
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

        .tour-button {
            display: block;
            width: 100%;
            padding: 0.8rem;
            background: var(--secondary-color);
            color: white;
            text-align: center;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .tour-button:hover {
            background: #0052a3;
            transform: translateY(-2px);
        }

        /* Landing Pages Section */
        .landings-section {
            background: linear-gradient(135deg, rgba(255,107,53,0.1) 0%, rgba(0,102,204,0.1) 100%);
            padding: 5rem 2rem;
        }

        .landings-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            max-width: 1200px;
            margin: 3rem auto 0;
        }

        .landing-button {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 2.5rem 2rem;
            background: white;
            border-radius: 15px;
            text-decoration: none;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            transition: all 0.3s;
            border: 2px solid transparent;
            min-height: 200px;
        }

        .landing-button:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 35px rgba(0,0,0,0.15);
            border-color: var(--accent-color);
        }

        .landing-button-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .landing-button-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 0.5rem;
            text-align: center;
        }

        .landing-button-lang {
            font-size: 0.85rem;
            color: var(--accent-color);
            font-weight: 600;
        }

        /* Footer */
        .footer {
            background: var(--dark);
            color: white;
            padding: 3rem 2rem 1.5rem;
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .footer-section h3 {
            margin-bottom: 1rem;
            color: var(--primary-color);
        }

        .footer-section ul {
            list-style: none;
        }

        .footer-section ul li {
            margin-bottom: 0.5rem;
        }

        .footer-section a {
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            transition: color 0.3s;
        }

        .footer-section a:hover {
            color: var(--primary-color);
        }

        .footer-bottom {
            text-align: center;
            padding-top: 2rem;
            border-top: 1px solid rgba(255,255,255,0.1);
            color: rgba(255,255,255,0.6);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .nav-menu {
                position: fixed;
                left: -100%;
                top: 80px;
                flex-direction: column;
                background: white;
                width: 100%;
                padding: 2rem;
                box-shadow: 0 10px 30px rgba(0,0,0,0.1);
                transition: left 0.3s;
            }

            .nav-menu.active {
                left: 0;
            }

            .nav-toggle {
                display: block;
            }

            .hero-slider {
                height: 300px;
                margin-top: 70px;
            }

            .slide-content h1 {
                font-size: 2rem;
            }

            .slide-content p {
                font-size: 1rem;
            }

            .section-title {
                font-size: 2rem;
            }

            .destinations-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
    
    <!-- Schema.org JSON-LD Structured Data -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "LocalBusiness",
        "@id": "<?php echo e(url('/')); ?>",
        "name": "Costa Rica Trip Packages",
        "description": "<?php echo e(__('home.meta_description')); ?>",
        "url": "<?php echo e(url('/')); ?>",
        "image": "<?php echo e(asset('images/logo.png')); ?>",
        "telephone": "+506-2234-5678",
        "email": "info@costaricatrippackages.com",
        "areaServed": "CR",
        "priceRange": "$$$",
        "hasMenu": "",
        "address": {
            "@type": "PostalAddress",
            "streetAddress": "San José",
            "addressLocality": "San José",
            "postalCode": "10101",
            "addressCountry": "CR"
        },
        "sameAs": [
            "https://www.facebook.com/costaricatrippackages",
            "https://www.instagram.com/costaricatrippackages"
        ],
        "aggregateRating": {
            "@type": "AggregateRating",
            "ratingValue": "4.8",
            "reviewCount": "248"
        }
    }
    </script>
    
    <!-- Travel Agency Organization Schema -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "TravelAgency",
        "name": "Costa Rica Trip Packages",
        "url": "<?php echo e(url('/')); ?>",
        "logo": "<?php echo e(asset('images/logo.png')); ?>",
        "description": "<?php echo e(__('home.meta_description')); ?>",
        "sameAs": [
            "https://www.facebook.com/costaricatrippackages",
            "https://www.instagram.com/costaricatrippackages"
        ]
    }
    </script>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar" id="navbar">
        <div class="nav-container">
            <a href="/" class="logo">
                <span>🌴</span> Costa Rica Trips
            </a>
            <button class="nav-toggle" id="navToggle">☰</button>
            <ul class="nav-menu" id="navMenu">
                <li><a href="<?php echo e(app()->getLocale() === 'es' ? '/es/' : '/en/'); ?>"><?php echo e(app()->getLocale() === 'es' ? 'Inicio' : 'Home'); ?></a></li>
                <li><a href="<?php echo e(app()->getLocale() === 'es' ? '/es/tours' : '/en/tours'); ?>">Tours</a></li>
                <li><a href="#destinos"><?php echo e(app()->getLocale() === 'es' ? 'Destinos' : 'Destinations'); ?></a></li>
                <li><a href="/contacto"><?php echo e(app()->getLocale() === 'es' ? 'Contacto' : 'Contact'); ?></a></li>
                <li><a href="/dashboard" style="color: var(--secondary-color);">Dashboard</a></li>
                <li>
                    <a href="<?php echo e(app()->getLocale() === 'es' ? '/en/' : '/es/'); ?>" style="color: var(--accent-color); font-weight: 600;">
                        <?php echo e(app()->getLocale() === 'es' ? '🇬🇧 EN' : '🇪🇸 ES'); ?>

                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Hero Slider -->
    <section class="hero-slider" id="heroSlider">
        <div class="slide active">
            <img src="https://images.unsplash.com/photo-1568605117036-5fe5e7bab0b7?w=1920&q=80" alt="Volcán Arenal" class="slide-image" loading="eager">
            <div class="slide-overlay">
                <div class="slide-content">
                    <h1><?php echo e(app()->getLocale() === 'es' ? 'Descubre Costa Rica' : 'Discover Costa Rica'); ?></h1>
                    <p><?php echo e(app()->getLocale() === 'es' ? 'Aventuras inolvidables entre volcanes, playas y naturaleza exuberante' : 'Unforgettable adventures among volcanoes, beaches and lush nature'); ?></p>
                    <a href="<?php echo e(app()->getLocale() === 'es' ? '/es/tours' : '/en/tours'); ?>" class="cta-button"><?php echo e(__('home.cta_explore')); ?></a>
                </div>
            </div>
        </div>
        <div class="slide">
            <img src="https://images.unsplash.com/photo-1559827260-dc66d52bef19?w=1920&q=80" alt="Playa Manuel Antonio" class="slide-image" loading="lazy">
            <div class="slide-overlay">
                <div class="slide-content">
                    <h1><?php echo e(app()->getLocale() === 'es' ? 'Playas Paradisíacas' : 'Paradise Beaches'); ?></h1>
                    <p><?php echo e(app()->getLocale() === 'es' ? 'Arena blanca, agua cristalina y vida silvestre única' : 'White sand, crystal clear water and unique wildlife'); ?></p>
                    <a href="<?php echo e(app()->getLocale() === 'es' ? '/es/tours' : '/en/tours'); ?>" class="cta-button"><?php echo e(app()->getLocale() === 'es' ? 'Ver Destinos' : 'See Destinations'); ?></a>
                </div>
            </div>
        </div>
        <div class="slide">
            <img src="https://images.unsplash.com/photo-1516026672322-bc52d61a55d5?w=1920&q=80" alt="Bosque Nublado" class="slide-image" loading="lazy">
            <div class="slide-overlay">
                <div class="slide-content">
                    <h1><?php echo e(app()->getLocale() === 'es' ? 'Bosques Místicos' : 'Mystical Forests'); ?></h1>
                    <p><?php echo e(app()->getLocale() === 'es' ? 'Explora la biodiversidad más rica del planeta' : 'Explore the richest biodiversity on the planet'); ?></p>
                    <a href="<?php echo e(app()->getLocale() === 'es' ? '/es/tours' : '/en/tours'); ?>" class="cta-button"><?php echo e(app()->getLocale() === 'es' ? 'Reservar Ahora' : 'Book Now'); ?></a>
                </div>
            </div>
        </div>
        <div class="slider-controls">
            <span class="slider-dot active" data-slide="0"></span>
            <span class="slider-dot" data-slide="1"></span>
            <span class="slider-dot" data-slide="2"></span>
        </div>
    </section>

    <!-- Destinations Section -->
    <section class="section" id="destinos">
        <div class="container">
            <h2 class="section-title"><?php echo e(__('home.destinations_title')); ?></h2>
            <p class="section-subtitle"><?php echo e(app()->getLocale() === 'es' ? 'Explora los lugares más hermosos de Costa Rica' : 'Explore the most beautiful places in Costa Rica'); ?></p>
            
            <div class="destinations-grid">
                <?php
                    $destinations = \App\Models\Destination::limit(6)->get();
                ?>
                
                <?php $__currentLoopData = $destinations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $destSlug = $dest->slug;
                        $destTitle = __('destinations.' . $destSlug . '.title') ?? $dest->name;
                        $destDescription = __('destinations.' . $destSlug . '.description') ?? 'Explore this beautiful Costa Rican destination';
                    ?>
                    <div class="destination-card-wrapper" data-dest-slug="<?php echo e($destSlug); ?>">
                        <div class="destination-card">
                            <img src="<?php echo e($dest->image_url ?? 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=800&q=80'); ?>" alt="<?php echo e($destTitle); ?>" class="destination-image" loading="lazy">
                            <div class="destination-overlay">
                                <h3 class="destination-name"><?php echo e($destTitle); ?></h3>
                                <p class="destination-description"><?php echo e(Str::limit($destDescription, 100)); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>

    <!-- SEO: Tours by Destination Schema -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "ItemList",
        "name": "<?php echo e(app()->getLocale() === 'es' ? 'Tours en Costa Rica por Destino' : 'Tours in Costa Rica by Destination'); ?>",
        "itemListElement": [
            <?php
                $index = 1;
                foreach(\App\Models\Tour::get() as $tour) {
                    foreach($tour->destinations as $dest) {
                        if($index > 1) echo ',';
                        echo json_encode([
                            "@type" => "ListItem",
                            "position" => $index,
                            "item" => [
                                "@type" => "Product",
                                "@id" => url('/tour/' . $tour->slug),
                                "name" => $tour->name,
                                "description" => $tour->description,
                                "image" => $tour->images->first()?->url ?? 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=800&q=80',
                                "offers" => [
                                    "@type" => "Offer",
                                    "price" => $tour->base_price ?? 199,
                                    "priceCurrency" => "USD"
                                ]
                            ]
                        ]);
                        $index++;
                    }
                }
            ?>
        ]
    }
    </script>
    <script>
        // Destination translations for modal
        const destinationData = <?php echo json_encode(
            \App\Models\Destination::limit(6)->get()->reduce(function($carry, $dest) {
                $slug = $dest->slug;
                $title = __('destinations.' . $slug . '.title') ?? $dest->name;
                $description = __('destinations.' . $slug . '.description') ?? 'Explore this beautiful Costa Rican destination';
                $carry[$slug] = [
                    'id' => $dest->id,
                    'title' => $title,
                    'description' => $description,
                    'image' => $dest->image_url ?? 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=800&q=80'
                ];
                return $carry;
            }, [])
        ); ?>;

        // Add click handlers to destination cards
        document.querySelectorAll('.destination-card-wrapper').forEach(card => {
            card.addEventListener('click', function() {
                const slug = this.getAttribute('data-dest-slug');
                const data = destinationData[slug];
                if (data) {
                    openDestinationModal(data.title, data.image, data.description, data.id);
                }
            });
        });
    </script>

    <!-- Landing Pages Section -->
    <section class="landings-section">
        <div class="container">
            <h2 class="section-title"><?php echo e(__('home.packages_title')); ?></h2>
            <p class="section-subtitle"><?php echo e(app()->getLocale() === 'es' ? 'Explora nuestras landing pages con ofertas exclusivas y precios reales' : 'Explore our landing pages with exclusive offers and real prices'); ?></p>
            
            <div class="landings-grid">
                <a href="/es/hoteles-volcan-arenal" class="landing-button">
                    <div class="landing-button-icon">🏨</div>
                    <div class="landing-button-title">Hoteles Arenal</div>
                    <div class="landing-button-lang">🇪🇸 Español</div>
                </a>

                <a href="/en/hotels-volcano-arenal" class="landing-button">
                    <div class="landing-button-icon">🏨</div>
                    <div class="landing-button-title">Hotels Arenal</div>
                    <div class="landing-button-lang">🇬🇧 English</div>
                </a>

                <a href="/es/tours-volcan-arenal" class="landing-button">
                    <div class="landing-button-icon">🌴</div>
                    <div class="landing-button-title">Tours Arenal</div>
                    <div class="landing-button-lang">🇪🇸 Español</div>
                </a>

                <a href="/en/tours-volcano-arenal" class="landing-button">
                    <div class="landing-button-icon">🌴</div>
                    <div class="landing-button-title">Tours Arenal</div>
                    <div class="landing-button-lang">🇬🇧 English</div>
                </a>

                <a href="/es/transporte-volcan-arenal" class="landing-button">
                    <div class="landing-button-icon">🚐</div>
                    <div class="landing-button-title">Transporte</div>
                    <div class="landing-button-lang">🇪🇸 Español</div>
                </a>

                <a href="/en/transport-volcano-arenal" class="landing-button">
                    <div class="landing-button-icon">🚐</div>
                    <div class="landing-button-title">Transport</div>
                    <div class="landing-button-lang">🇬🇧 English</div>
                </a>
            </div>
        </div>
    </section>

    <!-- Tours Section -->
    <section class="section tours-section">
        <div class="container">
            <h2 class="section-title"><?php echo e(__('home.featured_tours')); ?></h2>
            <p class="section-subtitle"><?php echo e(app()->getLocale() === 'es' ? 'Los mejores paquetes turísticos seleccionados para ti' : 'The best travel packages selected for you'); ?></p>
            
            <div class="tours-grid" id="toursGrid">
                <!-- Tours will be loaded here -->
            </div>

            <div style="text-align: center; margin-top: 3rem;">
                <a href="<?php echo e(app()->getLocale() === 'es' ? '/es/tours' : '/en/tours'); ?>" class="cta-button"><?php echo e(app()->getLocale() === 'es' ? 'Ver Todos los Tours' : 'View All Tours'); ?></a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer" id="contacto">
        <div class="footer-content">
            <div class="footer-section">
                <h3>Costa Rica Trips</h3>
                <p>Tu mejor aliado para descubrir las maravillas de Costa Rica</p>
            </div>
            <div class="footer-section">
                <h3>Enlaces Rápidos</h3>
                <ul>
                    <li><a href="/tours">Tours</a></li>
                    <li><a href="#destinos">Destinos</a></li>
                    <li><a href="/contacto">Contacto</a></li>
                    <li><a href="/dashboard">Dashboard</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Contacto</h3>
                <ul>
                    <li>📧 info@costaricatrips.com</li>
                    <li>📱 +506 1234-5678</li>
                    <li>📍 San José, Costa Rica</li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2025 Costa Rica Trip Packages. <?php echo e(app()->getLocale() === 'es' ? 'Todos los derechos reservados.' : 'All rights reserved.'); ?></p>
        </div>
    </footer>

    <!-- Destination Detail Modal -->
    <div class="modal fade" id="destinationModal" tabindex="-1" aria-labelledby="destinationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content destination-modal-content">
                <button type="button" class="btn-close btn-close-white destination-modal-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="destination-modal-image-wrapper">
                    <img id="modalDestImage" src="" alt="Destination" class="destination-modal-image">
                    <div class="destination-modal-overlay">
                        <h2 id="modalDestName" class="destination-modal-title"></h2>
                    </div>
                </div>
                <div class="destination-modal-body">
                    <p id="modalDestDescription" class="destination-modal-description"></p>
                    
                    <!-- Related Tours Section - Pre-rendered for SEO -->
                    <div id="relatedToursContainer" style="margin-bottom: 2.5rem;">
                        <h3 style="font-size: 1.3rem; font-weight: 700; margin-bottom: 1.5rem; color: var(--dark);"><?php echo e(app()->getLocale() === 'es' ? 'Tours Destacados en este Destino' : 'Featured Tours in this Destination'); ?></h3>
                        <div id="relatedToursList" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
                            <!-- Related tours will be loaded here by JavaScript -->
                        </div>
                    </div>
                    
                    <!-- SEO: Include all tours in hidden content for search engines -->
                    <div style="display: none;">
                        <?php
                            $allTours = \App\Models\Tour::get();
                        ?>
                        <?php $__currentLoopData = $allTours; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tour): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <article itemscope itemtype="https://schema.org/Product" data-tour-id="<?php echo e($tour->id); ?>">
                                <h4 itemprop="name"><?php echo e($tour->name); ?></h4>
                                <p itemprop="description"><?php echo e($tour->description); ?></p>
                                <span itemprop="price"><?php echo e($tour->base_price ?? 199); ?></span>
                                <meta itemprop="url" content="<?php echo e(url('/tours/' . $tour->slug)); ?>">
                                <?php $__currentLoopData = $tour->destinations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <meta itemprop="destination" content="<?php echo e($dest->id); ?>">
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </article>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    
                    <div class="destination-modal-actions">
                        <a href="" id="modalHotelsBtn" class="modal-action-btn hotels">
                            <span>🏨</span> 
                            <div>
                                <div class="btn-title"><?php echo e(app()->getLocale() === 'es' ? 'Hoteles' : 'Hotels'); ?></div>
                                <div class="btn-subtitle"><?php echo e(app()->getLocale() === 'es' ? 'Hospedaje exclusivo' : 'Exclusive lodging'); ?></div>
                            </div>
                        </a>
                        <a href="" id="modalToursBtn" class="modal-action-btn tours">
                            <span>🌴</span>
                            <div>
                                <div class="btn-title"><?php echo e(app()->getLocale() === 'es' ? 'Tours' : 'Tours'); ?></div>
                                <div class="btn-subtitle"><?php echo e(app()->getLocale() === 'es' ? 'Aventuras increíbles' : 'Amazing adventures'); ?></div>
                            </div>
                        </a>
                        <a href="" id="modalTransportBtn" class="modal-action-btn transport">
                            <span>🚐</span>
                            <div>
                                <div class="btn-title"><?php echo e(app()->getLocale() === 'es' ? 'Transporte' : 'Transport'); ?></div>
                                <div class="btn-subtitle"><?php echo e(app()->getLocale() === 'es' ? 'Viajes cómodos' : 'Comfortable rides'); ?></div>
                            </div>
                        </a>
                        <button type="button" id="modalPlanBtn" class="modal-action-btn plan" data-bs-toggle="modal" data-bs-target="#planModal">
                            <span>📋</span>
                            <div>
                                <div class="btn-title"><?php echo e(app()->getLocale() === 'es' ? 'Arma tu Plan' : 'Build Your Plan'); ?></div>
                                <div class="btn-subtitle"><?php echo e(app()->getLocale() === 'es' ? 'Personalizado' : 'Personalized'); ?></div>
                            </div>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Build Your Plan Modal -->
    <div class="modal fade" id="planModal" tabindex="-1" aria-labelledby="planModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background: var(--primary-color); color: white;">
                    <h5 class="modal-title" id="planModalLabel"><?php echo e(app()->getLocale() === 'es' ? 'Arma tu Plan' : 'Build Your Plan'); ?></h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="destInput" class="form-label"><?php echo e(app()->getLocale() === 'es' ? 'Destino' : 'Destination'); ?></label>
                            <input type="text" class="form-control destination-name-input" id="destInput" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="nameInput" class="form-label"><?php echo e(app()->getLocale() === 'es' ? 'Tu Nombre' : 'Your Name'); ?></label>
                            <input type="text" class="form-control" id="nameInput" placeholder="<?php echo e(app()->getLocale() === 'es' ? 'Juan Pérez' : 'John Doe'); ?>">
                        </div>
                        <div class="mb-3">
                            <label for="emailInput" class="form-label"><?php echo e(app()->getLocale() === 'es' ? 'Correo Electrónico' : 'Email'); ?></label>
                            <input type="email" class="form-control" id="emailInput" placeholder="correo@ejemplo.com">
                        </div>
                        <div class="mb-3">
                            <label for="phoneInput" class="form-label"><?php echo e(app()->getLocale() === 'es' ? 'Teléfono' : 'Phone'); ?></label>
                            <input type="tel" class="form-control" id="phoneInput" placeholder="+506 1234-5678">
                        </div>
                        <div class="mb-3">
                            <label for="datesInput" class="form-label"><?php echo e(app()->getLocale() === 'es' ? 'Fechas Aproximadas' : 'Approximate Dates'); ?></label>
                            <input type="text" class="form-control" id="datesInput" placeholder="<?php echo e(app()->getLocale() === 'es' ? 'Ej: 15-20 Diciembre' : 'Ex: Dec 15-20'); ?>">
                        </div>
                        <div class="mb-3">
                            <label for="detailsInput" class="form-label"><?php echo e(app()->getLocale() === 'es' ? 'Detalles del Plan' : 'Plan Details'); ?></label>
                            <textarea class="form-control" id="detailsInput" rows="3" placeholder="<?php echo e(app()->getLocale() === 'es' ? 'Cuéntanos qué buscas...' : 'Tell us what you\'re looking for...'); ?>"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo e(app()->getLocale() === 'es' ? 'Cancelar' : 'Cancel'); ?></button>
                    <button type="button" class="btn btn-primary" style="background: var(--primary-color); border: none;" onclick="submitPlan()"><?php echo e(app()->getLocale() === 'es' ? 'Enviar Plan' : 'Submit Plan'); ?></button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openDestinationModal(name, image, description, destinationId) {
            // Set modal content
            document.getElementById('modalDestName').textContent = name;
            document.getElementById('modalDestImage').src = image;
            document.getElementById('modalDestDescription').textContent = description;
            
            // Get locale
            const locale = '<?php echo e(app()->getLocale()); ?>';
            const baseUrl = locale === 'es' ? '/es' : '/en';
            
            // Set button links - Tours button now filters by destination
            document.getElementById('modalToursBtn').href = baseUrl + '/tours?destination_id=' + destinationId;
            document.getElementById('modalHotelsBtn').href = baseUrl + (locale === 'es' ? '/hoteles' : '/hotels') + '?destination_id=' + destinationId;
            document.getElementById('modalTransportBtn').href = baseUrl + (locale === 'es' ? '/transporte' : '/transport') + '?destination_id=' + destinationId;
            
            // Load related tours
            loadRelatedTours(destinationId);
            
            // Set plan button destination
            document.getElementById('modalPlanBtn').onclick = function() {
                document.querySelector('.destination-name-input').value = name;
                // The modal will be shown by Bootstrap data attributes
            };
            
            // Show modal
            const modal = new bootstrap.Modal(document.getElementById('destinationModal'));
            modal.show();
        }

        function loadRelatedTours(destinationId) {
            // Get all tours from the page
            const allTours = window.allDestinationTours || [];
            
            // Filter tours that have this destination
            const relatedTours = allTours.filter(tour => 
                tour.destinations && tour.destinations.includes(destinationId)
            ).slice(0, 3); // Show up to 3 tours
            
            const container = document.getElementById('relatedToursContainer');
            const toursList = document.getElementById('relatedToursList');
            
            if (relatedTours.length > 0) {
                toursList.innerHTML = '';
                
                relatedTours.forEach(tour => {
                    const tourCard = document.createElement('div');
                    tourCard.className = 'related-tour-card';
                    tourCard.innerHTML = `
                        <img src="${tour.image}" alt="${tour.title}" class="related-tour-image">
                        <div class="related-tour-content">
                            <div class="related-tour-title">${tour.title}</div>
                            <div class="related-tour-price">$${tour.price}</div>
                            <a href="/${'<?php echo e(app()->getLocale()); ?>'}/tour/${tour.slug}" class="related-tour-btn">
                                ${'<?php echo e(app()->getLocale() === "es" ? "Ver más" : "See more"); ?>'}
                            </a>
                        </div>
                    `;
                    toursList.appendChild(tourCard);
                });
                
                container.style.display = 'block';
            } else {
                container.style.display = 'none';
            }
        }

        function submitPlan() {
            const destination = document.querySelector('.destination-name-input').value;
            const name = document.getElementById('nameInput').value;
            const email = document.getElementById('emailInput').value;
            const phone = document.getElementById('phoneInput').value;
            const dates = document.getElementById('datesInput').value;
            const details = document.getElementById('detailsInput').value;

            if (!name || !email || !phone) {
                alert('<?php echo e(app()->getLocale() === "es" ? "Por favor completa todos los campos requeridos" : "Please fill in all required fields"); ?>');
                return;
            }

            // Send to contact form or email
            const message = `Plan para ${destination}:\n\nNombre: ${name}\nCorreo: ${email}\nTeléfono: ${phone}\nFechas: ${dates}\nDetalles: ${details}`;
            
            // You can send this via AJAX to your contact endpoint
            console.log('Plan submitted:', {destination, name, email, phone, dates, details});
            alert('<?php echo e(app()->getLocale() === "es" ? "¡Plan enviado! Nos pondremos en contacto pronto." : "Plan sent! We\'ll contact you soon."); ?>');
            
            // Close modal
            const modal = bootstrap.Modal.getInstance(document.getElementById('planModal'));
            modal.hide();

            // Reset form
            document.getElementById('nameInput').value = '';
            document.getElementById('emailInput').value = '';
            document.getElementById('phoneInput').value = '';
            document.getElementById('datesInput').value = '';
            document.getElementById('detailsInput').value = '';
        }

        // Slider functionality
        let currentSlide = 0;
        const slides = document.querySelectorAll('.slide');
        const dots = document.querySelectorAll('.slider-dot');

        function showSlide(index) {
            if (slides.length === 0) return;
            slides.forEach(slide => slide.classList.remove('active'));
            dots.forEach(dot => dot.classList.remove('active'));
            
            slides[index].classList.add('active');
            dots[index].classList.add('active');
            currentSlide = index;
        }

        function nextSlide() {
            if (slides.length === 0) return;
            currentSlide = (currentSlide + 1) % slides.length;
            showSlide(currentSlide);
        }

        // Auto advance slider
        if (slides.length > 0) {
            setInterval(nextSlide, 5000);
        }

        // Dot controls
        if (dots.length > 0) {
            dots.forEach(dot => {
                dot.addEventListener('click', () => {
                    showSlide(parseInt(dot.dataset.slide));
                });
            });
        }

        // Mobile menu toggle
        const navToggle = document.getElementById('navToggle');
        const navMenu = document.getElementById('navMenu');

        navToggle.addEventListener('click', () => {
            navMenu.classList.toggle('active');
        });

        // Navbar scroll effect
        window.addEventListener('scroll', () => {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Build your plan modal handler
        function setPlanDestination(destinationName) {
            const modal = document.getElementById('planModal');
            if (modal) {
                modal.querySelector('.destination-name-input').value = destinationName;
            }
        }

        // Load featured tours
        <?php
            $tours = \App\Models\Tour::limit(5)->get();
            $toursJson = [];
            $toursWithDests = [];
            foreach ($tours as $tour) {
                $tourData = [
                    'id' => $tour->id,
                    'title' => $tour->name,
                    'price' => $tour->base_price ?? 199,
                    'duration' => $tour->duration_hours . ' horas',
                    'people' => ($tour->max_capacity ?? '6') . ' personas',
                    'description' => $tour->description ?? 'Tour en Costa Rica',
                    'image' => $tour->images->first()?->url ?? 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=600&q=80',
                    'slug' => $tour->slug,
                    'destinations' => $tour->destinations->pluck('id')->toArray()
                ];
                $toursJson[] = $tourData;
                $toursWithDests[] = $tourData;
            }
        ?>
        const tours = <?php echo json_encode($toursJson); ?>;
        window.allDestinationTours = <?php echo json_encode(\App\Models\Tour::get()->map(function($tour) {
            return [
                'id' => $tour->id,
                'title' => $tour->name,
                'price' => $tour->base_price ?? 199,
                'description' => $tour->description ?? 'Tour en Costa Rica',
                'image' => $tour->images->first()?->url ?? 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=600&q=80',
                'slug' => $tour->slug,
                'destinations' => $tour->destinations->pluck('id')->toArray()
            ];
        })->toArray()); ?>;

        const toursGrid = document.getElementById('toursGrid');
        if (toursGrid) {
            tours.forEach(tour => {
                const tourCard = document.createElement('div');
                tourCard.className = 'tour-card';
                tourCard.innerHTML = `
                    <img src="${tour.image}" alt="${tour.title}" class="tour-image" loading="lazy">
                    <div class="tour-content">
                        <div class="tour-header">
                            <div>
                                <h3 class="tour-title">${tour.title}</h3>
                            </div>
                            <div class="tour-price">
                                $${tour.price}
                                <small>/persona</small>
                            </div>
                        </div>
                        <p class="tour-description">${tour.description}</p>
                        <div class="tour-features">
                            <div class="feature">
                                <span>⏱️</span> ${tour.duration}
                            </div>
                            <div class="feature">
                                <span>👥</span> ${tour.people}
                            </div>
                        </div>
                        <a href="/<?php echo e(app()->getLocale()); ?>/tour/${tour.slug}" class="tour-button">Ver Detalles</a>
                    </div>
                `;
                toursGrid.appendChild(tourCard);
            });
        }
    </script>

    <!-- Publish Your Listing Section -->
    <section class="listing-cta-section" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 60px 20px; text-align: center; color: white; margin-top: 60px;">
        <div class="container">
            <h2 style="font-size: 2.5rem; margin-bottom: 1rem; font-weight: 700;">
                <?php if(app()->getLocale() === 'es'): ?>
                    ¿Tienes un Hotel, Tour o Transporte?
                <?php else: ?>
                    Do you have a Hotel, Tour or Transport Service?
                <?php endif; ?>
            </h2>
            <p style="font-size: 1.1rem; margin-bottom: 2rem; opacity: 0.95;">
                <?php if(app()->getLocale() === 'es'): ?>
                    Registra tu negocio en Costa Rica Trips y conecta con miles de turistas buscando experiencias únicas
                <?php else: ?>
                    Register your business on Costa Rica Trips and connect with thousands of tourists looking for unique experiences
                <?php endif; ?>
            </p>
            <a href="<?php echo e(app()->getLocale() === 'es' ? route('listings.create.es') : route('listings.create.en')); ?>" 
               class="btn btn-light btn-lg" style="font-weight: 600; padding: 12px 40px;">
                <?php if(app()->getLocale() === 'es'): ?>
                    <i class="bi bi-plus-circle"></i> Registrar Servicio
                <?php else: ?>
                    <i class="bi bi-plus-circle"></i> Register Service
                <?php endif; ?>
            </a>
        </div>
    </section>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php /**PATH /mnt/c/Users/Elizabeth/costaricatrippackages/resources/views/home.blade.php ENDPATH**/ ?>