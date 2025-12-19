<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ __('landings.meta_description') }}">
    <meta name="keywords" content="{{ __('landings.meta_keywords') }}">
    <title>{{ __('landings.transport_title') }} - Costa Rica Trip Packages</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        :root { --primary: #00A86B; --secondary: #FF6B35; --dark: #1a1a1a; --light: #f8f9fa; --gray: #6c757d; }
        body { font-family: 'Poppins', sans-serif; line-height: 1.6; color: var(--dark); background: #fff; }
        nav { position: fixed; top: 0; width: 100%; background: rgba(255, 255, 255, 0.98); backdrop-filter: blur(10px); box-shadow: 0 2px 10px rgba(0,0,0,0.1); z-index: 1000; padding: 1rem 2rem; }
        .nav-container { max-width: 1200px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center; }
        .logo { font-size: 1.3rem; font-weight: 800; color: var(--primary); text-decoration: none; }
        .nav-menu { display: flex; gap: 2rem; list-style: none; align-items: center; }
        .nav-menu a { text-decoration: none; color: var(--dark); font-weight: 500; transition: color 0.3s; }
        .nav-menu a:hover { color: var(--primary); }
        .hero { margin-top: 70px; height: 300px; background: linear-gradient(135deg, #FF6B35 0%, #FF6B35 60%, #0066CC 100%); position: relative; display: flex; align-items: center; justify-content: center; color: white; }
        .hero::before { content: ''; position: absolute; inset: 0; background: url('https://images.unsplash.com/photo-1691242559983-db4cb8415ee8?w=1920&q=80') center/cover; opacity: 0.3; z-index: 1; }
        .hero-content { position: relative; z-index: 2; text-align: center; max-width: 800px; padding: 2rem; }
        .hero h1 { font-size: clamp(2rem, 5vw, 3.5rem); font-weight: 800; margin-bottom: 1rem; text-shadow: 2px 2px 8px rgba(0,0,0,0.3); }
        .hero p { font-size: 1.2rem; margin-bottom: 2rem; text-shadow: 1px 1px 4px rgba(0,0,0,0.3); }
        .cta-button { display: inline-block; padding: 1rem 2.5rem; background: var(--secondary); color: white; text-decoration: none; border-radius: 50px; font-weight: 700; transition: all 0.3s; box-shadow: 0 4px 15px rgba(255,107,53,0.4); border: none; cursor: pointer; }
        .cta-button:hover { transform: translateY(-3px); box-shadow: 0 6px 25px rgba(255,107,53,0.6); }
        .container { max-width: 1200px; margin: 0 auto; padding: 0 2rem; }
        section { padding: 5rem 2rem; }
        .section-title { text-align: center; font-size: 2.5rem; font-weight: 800; margin-bottom: 1rem; }
        .section-subtitle { text-align: center; font-size: 1.1rem; color: var(--gray); margin-bottom: 3rem; max-width: 600px; margin-left: auto; margin-right: auto; }
        .transport-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem; margin-top: 3rem; }
        .transport-card { background: white; border-radius: 10px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.1); transition: all 0.3s; border: 1px solid #e0e0e0; }
        .transport-card:hover { transform: translateY(-10px); box-shadow: 0 8px 25px rgba(0,0,0,0.15); }
        .transport-image { width: 100%; height: 250px; object-fit: cover; }
        .transport-content { padding: 1.5rem; }
        .transport-name { font-size: 1.3rem; font-weight: 700; margin-bottom: 0.5rem; }
        .transport-capacity { color: var(--gray); font-size: 0.9rem; margin-bottom: 1rem; }
        .transport-description { color: var(--gray); font-size: 0.95rem; margin-bottom: 1rem; }
        .transport-price { display: flex; justify-content: space-between; align-items: center; padding-top: 1rem; border-top: 1px solid #e0e0e0; }
        .price-value { font-size: 1.5rem; font-weight: 800; color: var(--primary); }
        .view-btn { display: inline-block; margin-top: 1rem; padding: 0.7rem 1.5rem; background: var(--primary); color: white; text-decoration: none; border-radius: 25px; font-weight: 600; }
        .features { background: var(--light); }
        .features-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem; margin-top: 2rem; }
        .feature { text-align: center; padding: 1.5rem; }
        .feature-icon { font-size: 3rem; margin-bottom: 1rem; }
        .feature h3 { font-size: 1.1rem; margin-bottom: 0.5rem; }
        .feature p { color: var(--gray); }
        .testimonials { background: var(--light); }
        .testimonials-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem; margin-top: 2rem; }
        .testimonial { background: white; padding: 2rem; border-radius: 10px; border-left: 4px solid var(--primary); box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
        .testimonial-text { font-style: italic; color: var(--gray); margin-bottom: 1rem; }
        .cta-section { background: linear-gradient(135deg, #FF6B35 0%, var(--primary) 40%, #FF6B35 100%); color: white; padding: 4rem 2rem; text-align: center; }
        footer { background: var(--dark); color: white; padding: 2rem; text-align: center; }
        @media (max-width: 768px) { .hero { height: 400px; } .hero h1 { font-size: 1.8rem; } }
    </style>

    <link rel="alternate" hreflang="es" href="{{ route('landing.transport.es') }}" />
    <link rel="alternate" hreflang="en" href="{{ route('landing.transport.en') }}" />
</head>
<body>
    <nav>
        <div class="nav-container">
            <a href="/" class="logo">🌴 Costa Rica Trips</a>
            <ul class="nav-menu">
                <li><a href="/#hotels">Hotels</a></li>
                <li><a href="/#tours">Tours</a></li>
                <li><a href="/" class="cta-button" style="font-size: 0.9rem; padding: 0.6rem 1.5rem;">Home</a></li>
            </ul>
        </div>
    </nav>

    <section class="hero">
        <div class="hero-content">
            <h1>{{ __('landings.transport_title') }}</h1>
            <p>{{ __('landings.transport_description') }}</p>
            <a href="#transport" class="cta-button">{{ __('landings.book_now') }}</a>
        </div>
    </section>

    <section id="transport" class="container">
        <h2 class="section-title">🚗 {{ __('landings.safe_reliable') }}</h2>
        <p class="section-subtitle">Servicios de transporte seguros y cómodos para tus viajes en Costa Rica</p>

        <div class="transport-grid">
            <div class="transport-card">
                <img src="https://images.unsplash.com/photo-1728755291202-2a3d8fe71ac2?w=500&q=80" alt="Private Transport" class="transport-image" loading="lazy">
                <div class="transport-content">
                    <h3 class="transport-name">Private Transport</h3>
                    <p class="transport-capacity">👥 1-4 pasajeros</p>
                    <p class="transport-description">Transporte privado exclusivo con conductor profesional y vehículo de última generación.</p>
                    <div class="transport-price">
                        <div>
                            <div style="color: var(--gray); font-size: 0.85rem;">{{ __('landings.price_from') }}</div>
                            <div class="price-value">$120</div>
                        </div>
                        <a href="#" class="view-btn">View</a>
                    </div>
                </div>
            </div>

            <div class="transport-card">
                <img src="https://images.unsplash.com/photo-1621295095201-e4496abe5a0f?w=500&q=80" alt="Shared Shuttle" class="transport-image" loading="lazy">
                <div class="transport-content">
                    <h3 class="transport-name">Shared Shuttle</h3>
                    <p class="transport-capacity">👥 5-12 pasajeros</p>
                    <p class="transport-description">Compartir viaje con otros turistas, económico y social. ¡Conoce nuevas amistades!</p>
                    <div class="transport-price">
                        <div>
                            <div style="color: var(--gray); font-size: 0.85rem;">{{ __('landings.price_from') }}</div>
                            <div class="price-value">$35</div>
                        </div>
                        <a href="#" class="view-btn">View</a>
                    </div>
                </div>
            </div>

            <div class="transport-card">
                <img src="https://images.unsplash.com/photo-1713357021650-3a458fcec762?w=500&q=80" alt="Group Transport" class="transport-image" loading="lazy">
                <div class="transport-content">
                    <h3 class="transport-name">Group Transport</h3>
                    <p class="transport-capacity">👥 15+ pasajeros</p>
                    <p class="transport-description">Autobús privado para grupos, perfecto para tours y eventos especiales.</p>
                    <div class="transport-price">
                        <div>
                            <div style="color: var(--gray); font-size: 0.85rem;">{{ __('landings.price_from') }}</div>
                            <div class="price-value">$450</div>
                        </div>
                        <a href="#" class="view-btn">View</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="features">
        <div class="container">
            <h2 class="section-title">✨ Why Choose Us?</h2>
            <div class="features-grid">
                <div class="feature">
                    <div class="feature-icon">🛡️</div>
                    <h3>100% Safe</h3>
                    <p>Vehículos revisados y conductores certificados con experiencia.</p>
                </div>
                <div class="feature">
                    <div class="feature-icon">⏰</div>
                    <h3>On Time</h3>
                    <p>Puntualidad garantizada, llegamos a la hora exacta.</p>
                </div>
                <div class="feature">
                    <div class="feature-icon">🎧</div>
                    <h3>Comfortable</h3>
                    <p>Aire acondicionado, WiFi gratis y conductores amables.</p>
                </div>
                <div class="feature">
                    <div class="feature-icon">💰</div>
                    <h3>Best Prices</h3>
                    <p>Transparencia total, sin cargos ocultos.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="testimonials">
        <div class="container">
            <h2 class="section-title">💬 Passenger Reviews</h2>
            <div class="testimonials-grid">
                <div class="testimonial">
                    <div class="testimonial-text">"¡Excelente servicio! El conductor fue muy amable y el coche estaba impecable."</div>
                    <div class="testimonial-author">Rosa García</div>
                </div>
                <div class="testimonial">
                    <div class="testimonial-text">"Great experience! The driver was professional and we arrived on time."</div>
                    <div class="testimonial-author">David Wilson</div>
                </div>
                <div class="testimonial">
                    <div class="testimonial-text">"El mejor transporte de Costa Rica. Recomendado 100%."</div>
                    <div class="testimonial-author">José Ramírez</div>
                </div>
            </div>
        </div>
    </section>

    <section class="cta-section">
        <div class="container">
            <h2>🚗 Ready to Travel?</h2>
            <p>Book your transport today and travel comfortably through Costa Rica.</p>
            <a href="#transport" class="cta-button">{{ __('landings.book_now') }}</a>
        </div>
    </section>

    <footer>
        <p>&copy; 2025 Costa Rica Trip Packages. All rights reserved.</p>
        <p>WhatsApp: <a href="https://wa.me/506" style="color: var(--primary); text-decoration: none;">+506 1234-5678</a></p>
    </footer>
</body>
</html>
