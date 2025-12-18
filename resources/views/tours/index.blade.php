<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Todos los tours y paquetes turísticos disponibles en Costa Rica">
    <title>Todos los Tours - Costa Rica Trip Packages</title>
    
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
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="nav-container">
            <a href="/" class="logo">
                <span>🌴</span> Costa Rica Trips
            </a>
            <ul class="nav-menu">
                <li><a href="/">Inicio</a></li>
                <li><a href="/tours" style="color: var(--primary-color);">Tours</a></li>
                <li><a href="/#destinos">Destinos</a></li>
                <li><a href="/#contacto">Contacto</a></li>
            </ul>
        </div>
    </nav>

    <!-- Page Header -->
    <div class="page-header">
        <h1>Todos Nuestros Tours</h1>
        <p>Descubre experiencias únicas en los destinos más hermosos de Costa Rica</p>
    </div>

    <!-- Filters -->
    <div class="filters-section">
        <div class="container">
            <div class="filters">
                <div class="filter-group">
                    <label>Destino</label>
                    <select id="destinoFilter">
                        <option value="">Todos los destinos</option>
                        <option value="arenal">Arenal</option>
                        <option value="manuel-antonio">Manuel Antonio</option>
                        <option value="monteverde">Monteverde</option>
                        <option value="tortuguero">Tortuguero</option>
                        <option value="tamarindo">Tamarindo</option>
                    </select>
                </div>

                <div class="filter-group">
                    <label>Duración</label>
                    <select id="durationFilter">
                        <option value="">Todas las duraciones</option>
                        <option value="1">1 día</option>
                        <option value="2">2-3 días</option>
                        <option value="4">4+ días</option>
                    </select>
                </div>

                <div class="filter-group">
                    <label>Precio Máximo</label>
                    <input type="number" id="priceFilter" placeholder="$500" min="0">
                </div>

                <button class="filter-button" onclick="applyFilters()">Aplicar Filtros</button>
            </div>
        </div>
    </div>

    <!-- Tours Section -->
    <section class="tours-section">
        <div class="container">
            <div class="section-info">
                <p class="tours-count">Mostrando <strong id="tourCount">10</strong> tours disponibles</p>
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
        const allTours = [
            {
                id: 1,
                title: 'Arenal Volcano Adventure',
                category: 'Aventura',
                price: 299,
                duration: '2 días',
                people: '2-8 personas',
                badge: 'Más Popular',
                description: 'Explora el majestuoso Volcán Arenal, disfruta de aguas termales naturales y aventuras extremas en la naturaleza.',
                image: 'https://images.unsplash.com/photo-1568605117036-5fe5e7bab0b7?w=600&q=80'
            },
            {
                id: 2,
                title: 'Manuel Antonio Beach Paradise',
                category: 'Playa',
                price: 199,
                duration: '1 día',
                people: '2-6 personas',
                badge: 'Mejor Valorado',
                description: 'Playas paradisíacas, monos capuchinos, perezosos y la mejor vida silvestre de Costa Rica en un solo lugar.',
                image: 'https://images.unsplash.com/photo-1559827260-dc66d52bef19?w=600&q=80'
            },
            {
                id: 3,
                title: 'Monteverde Cloud Forest Experience',
                category: 'Naturaleza',
                price: 249,
                duration: '1 día',
                people: '2-10 personas',
                description: 'Camina entre las nubes en el bosque nublado más famoso del mundo. Incluye canopy tour y puentes colgantes.',
                image: 'https://images.unsplash.com/photo-1516026672322-bc52d61a55d5?w=600&q=80'
            },
            {
                id: 4,
                title: 'Tortuguero National Park',
                category: 'Naturaleza',
                price: 399,
                duration: '3 días',
                people: '2-6 personas',
                badge: 'Experiencia Única',
                description: 'Navega los canales amazónicos de Costa Rica y observa tortugas marinas en su hábitat natural.',
                image: 'https://images.unsplash.com/photo-1544551763-46a013bb70d5?w=600&q=80'
            },
            {
                id: 5,
                title: 'Tamarindo Surf Package',
                category: 'Deportes',
                price: 179,
                duration: '1 día',
                people: '1-4 personas',
                description: 'Aprende a surfear en las mejores olas de Guanacaste con instructores certificados. Todo el equipo incluido.',
                image: 'https://images.unsplash.com/photo-1505142468610-359e7d316be0?w=600&q=80'
            },
            {
                id: 6,
                title: 'Rio Celeste Waterfall Trek',
                category: 'Aventura',
                price: 149,
                duration: '1 día',
                people: '2-8 personas',
                description: 'Descubre la cascada de agua turquesa más increíble de Costa Rica en el Parque Nacional Tenorio.',
                image: 'https://images.unsplash.com/photo-1433086966358-54859d0ed716?w=600&q=80'
            },
            {
                id: 7,
                title: 'Corcovado Jungle Expedition',
                category: 'Aventura',
                price: 599,
                duration: '4 días',
                people: '2-6 personas',
                badge: 'Premium',
                description: 'La jungla más biodiversa del planeta. National Geographic lo nombró el lugar biológicamente más intenso.',
                image: 'https://images.unsplash.com/photo-1518709268805-4e9042af9f23?w=600&q=80'
            },
            {
                id: 8,
                title: 'La Fortuna Hot Springs',
                category: 'Relax',
                price: 129,
                duration: '1 día',
                people: '2-10 personas',
                description: 'Relájate en las aguas termales naturales rodeadas de la exuberante selva tropical costarricense.',
                image: 'https://images.unsplash.com/photo-1540555700478-4be289fbecef?w=600&q=80'
            },
            {
                id: 9,
                title: 'Caribbean Snorkeling Adventure',
                category: 'Playa',
                price: 169,
                duration: '1 día',
                people: '2-8 personas',
                description: 'Explora los arrecifes de coral del Caribe, nada con tortugas y descubre la vida marina colorida.',
                image: 'https://images.unsplash.com/photo-1544551763-77ef2d0cfc6c?w=600&q=80'
            },
            {
                id: 10,
                title: 'Coffee & Chocolate Tour',
                category: 'Cultural',
                price: 99,
                duration: '4 horas',
                people: '2-12 personas',
                description: 'Aprende el proceso del café y chocolate costarricense. Degustación incluida en plantaciones orgánicas.',
                image: 'https://images.unsplash.com/photo-1447933601403-0c6688de566e?w=600&q=80'
            }
        ];

        function renderTours(tours) {
            const grid = document.getElementById('toursGrid');
            const count = document.getElementById('tourCount');
            
            grid.innerHTML = '';
            count.textContent = tours.length;

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
                                    <small>por persona</small>
                                </div>
                                <a href="/tour/${tour.id}" class="tour-button">Ver Tour</a>
                            </div>
                        </div>
                    </div>
                `;
                grid.innerHTML += card;
            });
        }

        function applyFilters() {
            // Placeholder for filtering logic
            alert('Filtros aplicados (funcionalidad completa en siguiente fase)');
        }

        // Initial render
        renderTours(allTours);
    </script>
</body>
</html>
