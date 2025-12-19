<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Descubre los mejores tours y paquetes turísticos en Costa Rica. Playas paradisíacas, volcanes, bosques nublados y aventuras inolvidables.">
    <meta name="keywords" content="Costa Rica, tours, paquetes turísticos, playas, volcanes, aventuras">
    <title>Costa Rica Trip Packages - Tours y Paquetes Turísticos</title>
    
    <!-- Preconnect para optimización -->
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
                <li><a href="/">Inicio</a></li>
                <li><a href="/tours">Tours</a></li>
                <li><a href="#destinos">Destinos</a></li>
                <li><a href="/contacto">Contacto</a></li>
                <li><a href="/dashboard" style="color: var(--secondary-color);">Dashboard</a></li>
            </ul>
        </div>
    </nav>

    <!-- Hero Slider -->
    <section class="hero-slider" id="heroSlider">
        <div class="slide active">
            <img src="https://images.unsplash.com/photo-1568605117036-5fe5e7bab0b7?w=1920&q=80" alt="Volcán Arenal" class="slide-image" loading="eager">
            <div class="slide-overlay">
                <div class="slide-content">
                    <h1>Descubre Costa Rica</h1>
                    <p>Aventuras inolvidables entre volcanes, playas y naturaleza exuberante</p>
                    <a href="/tours" class="cta-button">Explorar Tours</a>
                </div>
            </div>
        </div>
        <div class="slide">
            <img src="https://images.unsplash.com/photo-1559827260-dc66d52bef19?w=1920&q=80" alt="Playa Manuel Antonio" class="slide-image" loading="lazy">
            <div class="slide-overlay">
                <div class="slide-content">
                    <h1>Playas Paradisíacas</h1>
                    <p>Arena blanca, agua cristalina y vida silvestre única</p>
                    <a href="/tours" class="cta-button">Ver Destinos</a>
                </div>
            </div>
        </div>
        <div class="slide">
            <img src="https://images.unsplash.com/photo-1516026672322-bc52d61a55d5?w=1920&q=80" alt="Bosque Nublado" class="slide-image" loading="lazy">
            <div class="slide-overlay">
                <div class="slide-content">
                    <h1>Bosques Místicos</h1>
                    <p>Explora la biodiversidad más rica del planeta</p>
                    <a href="/tours" class="cta-button">Reservar Ahora</a>
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
            <h2 class="section-title">Destinos Populares</h2>
            <p class="section-subtitle">Explora los lugares más hermosos de Costa Rica</p>
            
            <div class="destinations-grid">
                <a href="/destino/manuel-antonio" class="destination-card">
                    <img src="https://images.unsplash.com/photo-1559827260-dc66d52bef19?w=800&q=80" alt="Manuel Antonio" class="destination-image" loading="lazy">
                    <div class="destination-overlay">
                        <h3 class="destination-name">Manuel Antonio</h3>
                        <p class="destination-description">Playas vírgenes y vida silvestre</p>
                    </div>
                </a>

                <a href="/destino/arenal" class="destination-card">
                    <img src="https://images.unsplash.com/photo-1568605117036-5fe5e7bab0b7?w=800&q=80" alt="Volcán Arenal" class="destination-image" loading="lazy">
                    <div class="destination-overlay">
                        <h3 class="destination-name">Volcán Arenal</h3>
                        <p class="destination-description">Volcán activo y aguas termales</p>
                    </div>
                </a>

                <a href="/destino/monteverde" class="destination-card">
                    <img src="https://images.unsplash.com/photo-1516026672322-bc52d61a55d5?w=800&q=80" alt="Monteverde" class="destination-image" loading="lazy">
                    <div class="destination-overlay">
                        <h3 class="destination-name">Monteverde</h3>
                        <p class="destination-description">Bosque nublado místico</p>
                    </div>
                </a>

                <a href="/destino/tortuguero" class="destination-card">
                    <img src="https://images.unsplash.com/photo-1544551763-46a013bb70d5?w=800&q=80" alt="Tortuguero" class="destination-image" loading="lazy">
                    <div class="destination-overlay">
                        <h3 class="destination-name">Tortuguero</h3>
                        <p class="destination-description">Canales y tortugas marinas</p>
                    </div>
                </a>

                <a href="/destino/tamarindo" class="destination-card">
                    <img src="https://images.unsplash.com/photo-1505142468610-359e7d316be0?w=800&q=80" alt="Tamarindo" class="destination-image" loading="lazy">
                    <div class="destination-overlay">
                        <h3 class="destination-name">Tamarindo</h3>
                        <p class="destination-description">Surf y atardeceres espectaculares</p>
                    </div>
                </a>

                <a href="/destino/corcovado" class="destination-card">
                    <img src="https://images.unsplash.com/photo-1518709268805-4e9042af9f23?w=800&q=80" alt="Corcovado" class="destination-image" loading="lazy">
                    <div class="destination-overlay">
                        <h3 class="destination-name">Corcovado</h3>
                        <p class="destination-description">Jungla prístina y biodiversidad</p>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <!-- Landing Pages Section -->
    <section class="landings-section">
        <div class="container">
            <h2 class="section-title">Paquetes Especializados</h2>
            <p class="section-subtitle">Explora nuestras landing pages con ofertas exclusivas y precios reales</p>
            
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
            <h2 class="section-title">Tours Destacados</h2>
            <p class="section-subtitle">Los mejores paquetes turísticos seleccionados para ti</p>
            
            <div class="tours-grid" id="toursGrid">
                <!-- Tours will be loaded here -->
            </div>

            <div style="text-align: center; margin-top: 3rem;">
                <a href="/tours" class="cta-button">Ver Todos los Tours</a>
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
            <p>&copy; 2025 Costa Rica Trip Packages. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script>
        // Slider functionality
        let currentSlide = 0;
        const slides = document.querySelectorAll('.slide');
        const dots = document.querySelectorAll('.slider-dot');

        function showSlide(index) {
            slides.forEach(slide => slide.classList.remove('active'));
            dots.forEach(dot => dot.classList.remove('active'));
            
            slides[index].classList.add('active');
            dots[index].classList.add('active');
            currentSlide = index;
        }

        function nextSlide() {
            currentSlide = (currentSlide + 1) % slides.length;
            showSlide(currentSlide);
        }

        // Auto advance slider
        setInterval(nextSlide, 5000);

        // Dot controls
        dots.forEach(dot => {
            dot.addEventListener('click', () => {
                showSlide(parseInt(dot.dataset.slide));
            });
        });

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

        // Load featured tours
        const tours = [
            {
                id: 1,
                title: 'Arenal Volcano Adventure',
                price: 299,
                duration: '2 días',
                people: '2-8 personas',
                description: 'Explora el majestuoso Volcán Arenal, disfruta de aguas termales y aventuras en la naturaleza.',
                image: 'https://images.unsplash.com/photo-1568605117036-5fe5e7bab0b7?w=600&q=80'
            },
            {
                id: 2,
                title: 'Manuel Antonio Beach',
                price: 199,
                duration: '1 día',
                people: '2-6 personas',
                description: 'Playas paradisíacas, monos, perezosos y la mejor vida silvestre de Costa Rica.',
                image: 'https://images.unsplash.com/photo-1559827260-dc66d52bef19?w=600&q=80'
            },
            {
                id: 3,
                title: 'Monteverde Cloud Forest',
                price: 249,
                duration: '1 día',
                people: '2-10 personas',
                description: 'Camina entre las nubes en el bosque nublado más famoso del mundo.',
                image: 'https://images.unsplash.com/photo-1516026672322-bc52d61a55d5?w=600&q=80'
            },
            {
                id: 4,
                title: 'Tortuguero National Park',
                price: 399,
                duration: '3 días',
                people: '2-6 personas',
                description: 'Navega los canales y observa tortugas marinas en su hábitat natural.',
                image: 'https://images.unsplash.com/photo-1544551763-46a013bb70d5?w=600&q=80'
            },
            {
                id: 5,
                title: 'Tamarindo Surf Package',
                price: 179,
                duration: '1 día',
                people: '1-4 personas',
                description: 'Aprende a surfear en las mejores olas de Guanacaste con instructores expertos.',
                image: 'https://images.unsplash.com/photo-1505142468610-359e7d316be0?w=600&q=80'
            }
        ];

        const toursGrid = document.getElementById('toursGrid');
        tours.forEach(tour => {
            const tourCard = `
                <div class="tour-card">
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
                        <a href="/tour/${tour.id}" class="tour-button">Ver Detalles</a>
                    </div>
                </div>
            `;
            toursGrid.innerHTML += tourCard;
        });
    </script>
</body>
</html>
<?php /**PATH /home/elizabeth/costaricatrippackages/resources/views/home.blade.php ENDPATH**/ ?>