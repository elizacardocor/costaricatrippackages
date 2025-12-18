<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Detalles del tour - Costa Rica Trip Packages">
    <title>Detalles del Tour - Costa Rica Trip Packages</title>
    
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
            --yellow: #FFD700;
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

        .back-button {
            padding: 0.6rem 1.5rem;
            background: var(--light);
            color: var(--dark);
            text-decoration: none;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s;
        }

        .back-button:hover {
            background: var(--primary-color);
            color: white;
        }

        /* Hero Section */
        .tour-hero {
            margin-top: 80px;
            height: 500px;
            position: relative;
            overflow: hidden;
        }

        .hero-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .hero-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.8) 0%, transparent 100%);
            padding: 3rem 2rem;
            color: white;
        }

        .hero-content {
            max-width: 1200px;
            margin: 0 auto;
        }

        .tour-category {
            display: inline-block;
            background: var(--accent-color);
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .tour-title {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .tour-rating {
            display: flex;
            align-items: center;
            gap: 1rem;
            font-size: 1.1rem;
        }

        .stars {
            color: var(--yellow);
        }

        /* Main Content */
        .tour-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 3rem 2rem;
        }

        .content-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 3rem;
        }

        /* Left Column */
        .main-content {
            display: flex;
            flex-direction: column;
            gap: 2.5rem;
        }

        .section-title {
            font-size: 1.8rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: var(--dark);
        }

        .description {
            font-size: 1.1rem;
            line-height: 1.8;
            color: var(--gray);
        }

        .highlights {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
        }

        .highlight-card {
            background: var(--light);
            padding: 1.5rem;
            border-radius: 12px;
            display: flex;
            align-items: start;
            gap: 1rem;
        }

        .highlight-icon {
            font-size: 2rem;
            flex-shrink: 0;
        }

        .highlight-text h4 {
            font-size: 1.1rem;
            margin-bottom: 0.3rem;
        }

        .highlight-text p {
            color: var(--gray);
            font-size: 0.95rem;
        }

        .itinerary {
            list-style: none;
        }

        .itinerary-item {
            background: white;
            border-left: 4px solid var(--primary-color);
            padding: 1.5rem;
            margin-bottom: 1rem;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .itinerary-time {
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }

        .included-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            list-style: none;
        }

        .included-list li {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.8rem;
            background: var(--light);
            border-radius: 8px;
        }

        .included-list li::before {
            content: '✓';
            color: var(--primary-color);
            font-weight: bold;
            font-size: 1.2rem;
        }

        /* Image Gallery */
        .gallery {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
        }

        .gallery-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 12px;
            cursor: pointer;
            transition: transform 0.3s;
        }

        .gallery-image:hover {
            transform: scale(1.05);
        }

        /* Reviews Section (Placeholder for Phase 2) */
        .reviews-placeholder {
            background: var(--light);
            padding: 3rem;
            border-radius: 12px;
            text-align: center;
        }

        .reviews-placeholder h3 {
            margin-bottom: 1rem;
            color: var(--gray);
        }

        .reviews-placeholder p {
            color: var(--gray);
        }

        /* Sidebar */
        .sidebar {
            position: sticky;
            top: 100px;
            height: fit-content;
        }

        .booking-card {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
        }

        .price-tag {
            text-align: center;
            margin-bottom: 2rem;
        }

        .price {
            font-size: 3rem;
            font-weight: 700;
            color: var(--primary-color);
        }

        .price-tag small {
            display: block;
            color: var(--gray);
            font-size: 1rem;
            margin-top: 0.5rem;
        }

        .tour-info {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .info-item {
            display: flex;
            justify-content: space-between;
            padding: 1rem;
            background: var(--light);
            border-radius: 8px;
        }

        .info-label {
            font-weight: 600;
            color: var(--gray);
        }

        .info-value {
            font-weight: 600;
            color: var(--dark);
        }

        .book-button {
            display: block;
            width: 100%;
            padding: 1.2rem;
            background: var(--accent-color);
            color: white;
            text-align: center;
            text-decoration: none;
            border-radius: 10px;
            font-weight: 700;
            font-size: 1.1rem;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
            margin-bottom: 1rem;
        }

        .book-button:hover {
            background: #e55a2b;
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(255,107,53,0.4);
        }

        .contact-button {
            display: block;
            width: 100%;
            padding: 1rem;
            background: white;
            color: var(--secondary-color);
            text-align: center;
            text-decoration: none;
            border-radius: 10px;
            font-weight: 600;
            border: 2px solid var(--secondary-color);
            transition: all 0.3s;
        }

        .contact-button:hover {
            background: var(--secondary-color);
            color: white;
        }

        /* Responsive */
        @media (max-width: 968px) {
            .content-grid {
                grid-template-columns: 1fr;
            }

            .sidebar {
                position: static;
            }

            .tour-title {
                font-size: 2rem;
            }

            .tour-hero {
                height: 400px;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="nav-container">
            <a href="/" class="logo">
                <span>🌴</span> Costa Rica Trips
            </a>
            <a href="/tours" class="back-button">← Volver a Tours</a>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="tour-hero">
        <img src="https://images.unsplash.com/photo-1568605117036-5fe5e7bab0b7?w=1920&q=80" alt="Tour" class="hero-image" id="heroImage">
        <div class="hero-overlay">
            <div class="hero-content">
                <span class="tour-category" id="tourCategory">Aventura</span>
                <h1 class="tour-title" id="tourTitle">Arenal Volcano Adventure</h1>
                <div class="tour-rating">
                    <span class="stars">⭐⭐⭐⭐⭐</span>
                    <span>4.9/5 (127 reseñas) - Fase 2</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="tour-content">
        <div class="content-grid">
            <!-- Left Column -->
            <div class="main-content">
                <!-- Description -->
                <section>
                    <h2 class="section-title">Descripción del Tour</h2>
                    <p class="description" id="tourDescription">
                        Embárcate en una aventura inolvidable al majestuoso Volcán Arenal, uno de los volcanes más activos y fotogénicos del mundo. 
                        Este tour de dos días te permitirá explorar la belleza natural de La Fortuna, disfrutar de aguas termales naturales 
                        calentadas por la actividad volcánica, y participar en emocionantes actividades de aventura.
                    </p>
                    <p class="description">
                        Caminarás por senderos en la selva tropical donde podrás observar una increíble variedad de flora y fauna, 
                        incluyendo monos aulladores, perezosos, tucanes y una gran variedad de especies de aves. Las vistas panorámicas 
                        del volcán y el lago Arenal te dejarán sin aliento.
                    </p>
                </section>

                <!-- Highlights -->
                <section>
                    <h2 class="section-title">Lo Más Destacado</h2>
                    <div class="highlights">
                        <div class="highlight-card">
                            <div class="highlight-icon">🌋</div>
                            <div class="highlight-text">
                                <h4>Volcán Arenal</h4>
                                <p>Vista espectacular del volcán activo</p>
                            </div>
                        </div>
                        <div class="highlight-card">
                            <div class="highlight-icon">♨️</div>
                            <div class="highlight-text">
                                <h4>Aguas Termales</h4>
                                <p>Relájate en piscinas naturales</p>
                            </div>
                        </div>
                        <div class="highlight-card">
                            <div class="highlight-icon">🦥</div>
                            <div class="highlight-text">
                                <h4>Vida Silvestre</h4>
                                <p>Observa monos, perezosos y aves</p>
                            </div>
                        </div>
                        <div class="highlight-card">
                            <div class="highlight-icon">🥾</div>
                            <div class="highlight-text">
                                <h4>Caminatas Guiadas</h4>
                                <p>Senderos en la selva tropical</p>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Itinerary -->
                <section>
                    <h2 class="section-title">Itinerario Detallado</h2>
                    <ul class="itinerary">
                        <li class="itinerary-item">
                            <div class="itinerary-time">Día 1 - 8:00 AM</div>
                            <strong>Salida desde San José</strong>
                            <p>Transporte cómodo con A/C hacia La Fortuna. Paradas panorámicas en el camino.</p>
                        </li>
                        <li class="itinerary-item">
                            <div class="itinerary-time">Día 1 - 12:00 PM</div>
                            <strong>Almuerzo Típico</strong>
                            <p>Disfruta de la gastronomía costarricense en un restaurante local.</p>
                        </li>
                        <li class="itinerary-item">
                            <div class="itinerary-time">Día 1 - 2:00 PM</div>
                            <strong>Caminata por el Parque Nacional</strong>
                            <p>Recorrido guiado de 3 horas con vistas del volcán y vida silvestre.</p>
                        </li>
                        <li class="itinerary-item">
                            <div class="itinerary-time">Día 1 - 6:00 PM</div>
                            <strong>Aguas Termales</strong>
                            <p>Relájate en las piscinas termales naturales bajo las estrellas.</p>
                        </li>
                        <li class="itinerary-item">
                            <div class="itinerary-time">Día 2 - 9:00 AM</div>
                            <strong>Actividades de Aventura</strong>
                            <p>Canopy tour, puentes colgantes o kayak en el Lago Arenal (a elegir).</p>
                        </li>
                        <li class="itinerary-item">
                            <div class="itinerary-time">Día 2 - 4:00 PM</div>
                            <strong>Regreso a San José</strong>
                            <p>Llegada aproximada a las 8:00 PM.</p>
                        </li>
                    </ul>
                </section>

                <!-- What's Included -->
                <section>
                    <h2 class="section-title">Qué Incluye</h2>
                    <ul class="included-list">
                        <li>Transporte ida y vuelta</li>
                        <li>Guía profesional bilingüe</li>
                        <li>Todas las entradas a parques</li>
                        <li>2 almuerzos típicos</li>
                        <li>1 desayuno y 1 cena</li>
                        <li>Hospedaje (1 noche)</li>
                        <li>Aguas termales</li>
                        <li>Seguro de viaje</li>
                        <li>Agua embotellada</li>
                        <li>Equipo necesario</li>
                    </ul>
                </section>

                <!-- Photo Gallery -->
                <section>
                    <h2 class="section-title">Galería de Fotos</h2>
                    <div class="gallery">
                        <img src="https://images.unsplash.com/photo-1568605117036-5fe5e7bab0b7?w=400&q=80" alt="Volcán" class="gallery-image" loading="lazy">
                        <img src="https://images.unsplash.com/photo-1540555700478-4be289fbecef?w=400&q=80" alt="Aguas termales" class="gallery-image" loading="lazy">
                        <img src="https://images.unsplash.com/photo-1516026672322-bc52d61a55d5?w=400&q=80" alt="Selva" class="gallery-image" loading="lazy">
                        <img src="https://images.unsplash.com/photo-1544551763-46a013bb70d5?w=400&q=80" alt="Naturaleza" class="gallery-image" loading="lazy">
                    </div>
                </section>

                <!-- Reviews Placeholder -->
                <section>
                    <div class="reviews-placeholder">
                        <h3>⭐ Calificaciones y Comentarios</h3>
                        <p>Esta funcionalidad estará disponible en la Fase 2 del proyecto.</p>
                        <p>Aquí los usuarios podrán dejar sus reseñas y calificaciones del tour.</p>
                    </div>
                </section>
            </div>

            <!-- Sidebar -->
            <aside class="sidebar">
                <div class="booking-card">
                    <div class="price-tag">
                        <div class="price" id="tourPrice">$299</div>
                        <small>por persona</small>
                    </div>

                    <div class="tour-info">
                        <div class="info-item">
                            <span class="info-label">Duración</span>
                            <span class="info-value" id="tourDuration">2 días</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Grupo</span>
                            <span class="info-value">2-8 personas</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Idioma</span>
                            <span class="info-value">Español/Inglés</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Disponibilidad</span>
                            <span class="info-value" style="color: var(--primary-color);">Diaria</span>
                        </div>
                    </div>

                    <button class="book-button" onclick="alert('Funcionalidad de reserva - Próximamente')">
                        Reservar Ahora
                    </button>
                    <a href="mailto:info@costaricatrips.com" class="contact-button">
                        Contactar
                    </a>
                </div>
            </aside>
        </div>
    </div>

    <script>
        // Tour data (en producción vendría de base de datos)
        const tours = {
            1: {
                title: 'Arenal Volcano Adventure',
                category: 'Aventura',
                price: 299,
                duration: '2 días',
                image: 'https://images.unsplash.com/photo-1568605117036-5fe5e7bab0b7?w=1920&q=80',
                description: 'Embárcate en una aventura inolvidable al majestuoso Volcán Arenal...'
            },
            2: {
                title: 'Manuel Antonio Beach Paradise',
                category: 'Playa',
                price: 199,
                duration: '1 día',
                image: 'https://images.unsplash.com/photo-1559827260-dc66d52bef19?w=1920&q=80',
                description: 'Descubre las playas más hermosas de Costa Rica en Manuel Antonio...'
            }
        };

        // Get tour ID from URL (ejemplo: /tour/1)
        const tourId = window.location.pathname.split('/').pop();
        const tour = tours[tourId] || tours[1];

        // Update page content
        document.getElementById('tourTitle').textContent = tour.title;
        document.getElementById('tourCategory').textContent = tour.category;
        document.getElementById('tourPrice').textContent = '$' + tour.price;
        document.getElementById('tourDuration').textContent = tour.duration;
        document.getElementById('heroImage').src = tour.image;
    </script>
</body>
</html>
