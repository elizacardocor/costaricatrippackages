<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Costa Rica Trip Packages">
    <?php if(config('app.env') !== 'production'): ?>
    <meta name="robots" content="noindex, nofollow">
    <?php endif; ?>
    <title><?php echo $__env->yieldContent('title', 'Costa Rica Trip Packages'); ?></title>
    
    <!-- Canonical URL for SEO -->
    <?php echo $__env->yieldContent('canonical'); ?>
    
    <!-- Preconnect para optimización -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    
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

        .lang-switcher {
            display: flex;
            gap: 0.5rem;
            align-items: center;
        }

        .lang-btn {
            padding: 0.4rem 0.8rem;
            border: 1px solid #ddd;
            background: white;
            border-radius: 4px;
            cursor: pointer;
            font-size: 0.85rem;
            font-weight: 600;
            transition: all 0.3s;
            text-decoration: none;
            color: var(--dark);
        }

        .lang-btn.active {
            background: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }

        .lang-btn:hover {
            border-color: var(--primary-color);
            color: var(--primary-color);
        }

        .lang-btn.active:hover {
            color: white;
        }

        /* Main content margin to account for fixed navbar */
        main {
            margin-top: 80px;
        }

        /* Footer */
        footer {
            background: var(--dark);
            color: white;
            padding: 3rem 2rem;
            margin-top: 5rem;
        }

        footer h5 {
            color: var(--primary-color);
            margin-bottom: 1.5rem;
            font-weight: 700;
        }

        footer a {
            color: #ccc;
            text-decoration: none;
            transition: color 0.3s;
        }

        footer a:hover {
            color: var(--primary-color);
        }

        footer .footer-bottom {
            border-top: 1px solid rgba(255,255,255,0.1);
            padding-top: 2rem;
            margin-top: 2rem;
            text-align: center;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="nav-container">
            <a href="/<?php echo e(app()->getLocale()); ?>/" class="logo">
                <i class="bi bi-geo-alt"></i> Costa Rica Trips
            </a>
            
            <ul class="nav-menu">
                <li><a href="/<?php echo e(app()->getLocale()); ?>/tours"><?php echo e(app()->getLocale() === 'es' ? 'Tours' : 'Tours'); ?></a></li>
                <li><a href="/<?php echo e(app()->getLocale()); ?>/<?php echo e(app()->getLocale() === 'es' ? 'contacto' : 'contact'); ?>"><?php echo e(app()->getLocale() === 'es' ? 'Contacto' : 'Contact'); ?></a></li>
                
                <!-- Language Switcher -->
                <li class="lang-switcher">
                    <?php if(app()->getLocale() === 'es'): ?>
                        <a href="<?php echo e(\App\Helpers\UrlHelper::translateUrlToEnglish(request()->getPathInfo())); ?>" class="lang-btn">EN</a>
                        <span class="lang-btn active">ES</span>
                    <?php else: ?>
                        <span class="lang-btn active">EN</span>
                        <a href="<?php echo e(\App\Helpers\UrlHelper::translateUrlToSpanish(request()->getPathInfo())); ?>" class="lang-btn">ES</a>
                    <?php endif; ?>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row mb-4">
                <div class="col-md-4">
                    <h5><?php echo e(app()->getLocale() === 'es' ? 'Sobre Nosotros' : 'About Us'); ?></h5>
                    <p><?php echo e(app()->getLocale() === 'es' ? 'Los mejores paquetes turísticos en Costa Rica' : 'The best tourism packages in Costa Rica'); ?></p>
                </div>
                <div class="col-md-4">
                    <h5><?php echo e(app()->getLocale() === 'es' ? 'Enlaces' : 'Links'); ?></h5>
                    <ul style="list-style: none; padding: 0;">
                        <li><a href="/<?php echo e(app()->getLocale()); ?>/"><?php echo e(app()->getLocale() === 'es' ? 'Inicio' : 'Home'); ?></a></li>
                        <li><a href="/<?php echo e(app()->getLocale()); ?>/tours"><?php echo e(app()->getLocale() === 'es' ? 'Tours' : 'Tours'); ?></a></li>
                        <li><a href="/<?php echo e(app()->getLocale()); ?>/contacto<?php echo e(app()->getLocale() === 'es' ? '' : ''); ?>"><?php echo e(app()->getLocale() === 'es' ? 'Contacto' : 'Contact'); ?></a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5><?php echo e(app()->getLocale() === 'es' ? 'Contacto' : 'Contact'); ?></h5>
                    <p><?php echo e(app()->getLocale() === 'es' ? 'Email: info@costaricatrips.com' : 'Email: info@costaricatrips.com'); ?></p>
                    <p><?php echo e(app()->getLocale() === 'es' ? 'Tel: +506 2234-5678' : 'Phone: +506 2234-5678'); ?></p>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2025 Costa Rica Trip Packages. <?php echo e(app()->getLocale() === 'es' ? 'Todos los derechos reservados.' : 'All rights reserved.'); ?></p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Navbar scroll effect -->
    <script>
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    </script>
</body>
</html>
<?php /**PATH /home/elizabeth/costaricatrippackages/resources/views/layouts/app.blade.php ENDPATH**/ ?>