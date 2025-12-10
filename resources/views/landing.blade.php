<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Descubre los mejores paquetes turísticos a Costa Rica. Playas, aventura y naturaleza te esperan.">
    <meta name="keywords" content="Costa Rica, turismo, paquetes turísticos, viajes">
    <meta name="author" content="Costa Rica Trip Packages">
    <meta property="og:title" content="Costa Rica Trip Packages | Mejores Paquetes Turísticos">
    <meta property="og:description" content="Explora Costa Rica con nuestros paquetes turísticos personalizados.">
    <meta property="og:type" content="website">
    
    <title>Costa Rica Trip Packages | Paquetes Turísticos y Viajes</title>
    
    @vite('resources/css/app.css')
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        
        header {
            background: linear-gradient(135deg, #2ecc71 0%, #27ae60 100%);
            color: white;
            padding: 1rem 0;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .logo {
            font-size: 1.5rem;
            font-weight: bold;
            text-decoration: none;
            color: white;
        }
        
        nav ul {
            list-style: none;
            display: flex;
            gap: 2rem;
        }
        
        nav a {
            color: white;
            text-decoration: none;
            transition: opacity 0.3s;
        }
        
        nav a:hover {
            opacity: 0.8;
        }
        
        .hero {
            background: linear-gradient(rgba(46, 204, 113, 0.9), rgba(39, 174, 96, 0.9)), 
                        url('https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=1200') center/cover;
            color: white;
            text-align: center;
            padding: 8rem 0;
            margin-top: 0;
        }
        
        .hero h1 {
            font-size: 3.5rem;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }
        
        .hero p {
            font-size: 1.3rem;
            margin-bottom: 2rem;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
        }
        
        .cta-button {
            display: inline-block;
            background: #e74c3c;
            color: white;
            padding: 1rem 2rem;
            text-decoration: none;
            border-radius: 5px;
            transition: background 0.3s;
            font-weight: bold;
            border: none;
            cursor: pointer;
        }
        
        .cta-button:hover {
            background: #c0392b;
        }
        
        .features {
            padding: 4rem 0;
            background: #f8f9fa;
        }
        
        .features h2 {
            text-align: center;
            margin-bottom: 3rem;
            font-size: 2.5rem;
            color: #2ecc71;
        }
        
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
        }
        
        .feature-card {
            background: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            text-align: center;
            transition: transform 0.3s;
        }
        
        .feature-card:hover {
            transform: translateY(-5px);
        }
        
        .feature-card h3 {
            color: #2ecc71;
            margin: 1rem 0;
        }
        
        .packages {
            padding: 4rem 0;
        }
        
        .packages h2 {
            text-align: center;
            margin-bottom: 3rem;
            font-size: 2.5rem;
            color: #2ecc71;
        }
        
        .packages-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }
        
        .package-card {
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0,0,0,0.15);
            transition: transform 0.3s;
        }
        
        .package-card:hover {
            transform: scale(1.05);
        }
        
        .package-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        
        .package-content {
            padding: 1.5rem;
        }
        
        .package-content h3 {
            color: #2ecc71;
            margin-bottom: 0.5rem;
        }
        
        .price {
            font-size: 1.5rem;
            color: #e74c3c;
            font-weight: bold;
            margin: 1rem 0;
        }
        
        footer {
            background: #2c3e50;
            color: white;
            padding: 2rem 0;
            text-align: center;
            margin-top: 4rem;
        }
        
        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2.5rem;
            }
            
            nav ul {
                gap: 1rem;
            }
        }
    </style>
</head>
<body>
    <header>
        <nav class="container">
            <a href="/" class="logo">🌴 Costa Rica Trips</a>
            <ul>
                <li><a href="#paquetes">Paquetes</a></li>
                <li><a href="#caracteristicas">Características</a></li>
                <li><a href="#contacto">Contacto</a></li>
            </ul>
        </nav>
    </header>
    
    <section class="hero">
        <div class="container">
            <h1>Descubre el Paraíso</h1>
            <p>Paquetes turísticos increíbles a Costa Rica con todo incluido</p>
            <button class="cta-button" onclick="document.getElementById('paquetes').scrollIntoView({behavior: 'smooth'})">
                Ver Paquetes
            </button>
        </div>
    </section>
    
    <section class="features" id="caracteristicas">
        <div class="container">
            <h2>¿Por Qué Elegirnos?</h2>
            <div class="features-grid">
                <div class="feature-card">
                    <div style="font-size: 3rem;">✈️</div>
                    <h3>Vuelos Incluidos</h3>
                    <p>Todos nuestros paquetes incluyen vuelos de ida y vuelta desde tu ciudad.</p>
                </div>
                <div class="feature-card">
                    <div style="font-size: 3rem;">🏨</div>
                    <h3>Hoteles Premium</h3>
                    <p>Alojamiento en los mejores hoteles de 4 y 5 estrellas de Costa Rica.</p>
                </div>
                <div class="feature-card">
                    <div style="font-size: 3rem;">🎒</div>
                    <h3>Tours Incluidos</h3>
                    <p>Actividades y tours guiados en español incluidos en todos los paquetes.</p>
                </div>
                <div class="feature-card">
                    <div style="font-size: 3rem;">💰</div>
                    <h3>Mejor Precio</h3>
                    <p>Garantizamos los mejores precios del mercado con la mejor calidad.</p>
                </div>
                <div class="feature-card">
                    <div style="font-size: 3rem;">👨‍💼</div>
                    <h3>Atención 24/7</h3>
                    <p>Equipo de soporte disponible 24 horas durante tu viaje.</p>
                </div>
                <div class="feature-card">
                    <div style="font-size: 3rem;">📱</div>
                    <h3>Fácil Reserva</h3>
                    <p>Reserva en línea de forma rápida, segura y sin complicaciones.</p>
                </div>
            </div>
        </div>
    </section>
    
    <section class="packages" id="paquetes">
        <div class="container">
            <h2>Nuestros Paquetes</h2>
            <div class="packages-grid">
                <article class="package-card">
                    <img src="https://images.unsplash.com/photo-1469854523086-cc02fe5d8800?w=400&h=200&fit=crop" alt="Playas de Costa Rica" class="package-image">
                    <div class="package-content">
                        <h3>Paquete Playas</h3>
                        <p>5 días / 4 noches en las mejores playas de Costa Rica</p>
                        <p>Incluye: Vuelo, hotel 5 estrellas, tours de playa y snorkel</p>
                        <div class="price">$1,299</div>
                        <button class="cta-button">Reservar Ahora</button>
                    </div>
                </article>
                
                <article class="package-card">
                    <img src="https://images.unsplash.com/photo-1473496169904-658ba7c44d8a?w=400&h=200&fit=crop" alt="Aventura en la naturaleza" class="package-image">
                    <div class="package-content">
                        <h3>Paquete Aventura</h3>
                        <p>7 días / 6 noches de pura adrenalina y naturaleza</p>
                        <p>Incluye: Vuelo, hotel 4 estrellas, rafting, tirolesa y más</p>
                        <div class="price">$1,799</div>
                        <button class="cta-button">Reservar Ahora</button>
                    </div>
                </article>
                
                <article class="package-card">
                    <img src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=400&h=200&fit=crop" alt="Naturaleza costarricense" class="package-image">
                    <div class="package-content">
                        <h3>Paquete Naturaleza</h3>
                        <p>6 días / 5 noches explorando el verdadero paraíso</p>
                        <p>Incluye: Vuelo, eco-lodge, tours en selva y volcanes</p>
                        <div class="price">$1,499</div>
                        <button class="cta-button">Reservar Ahora</button>
                    </div>
                </article>
            </div>
        </div>
    </section>
    
    <footer id="contacto">
        <div class="container">
            <h3>Costa Rica Trip Packages</h3>
            <p>&copy; 2025 Todos los derechos reservados</p>
            <p>Email: info@costaricatrippackages.com | Teléfono: +506 1234-5678</p>
        </div>
    </footer>
</body>
</html>
