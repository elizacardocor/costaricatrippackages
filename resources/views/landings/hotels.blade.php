<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ __('landings.meta_description') }}">
    <meta name="keywords" content="{{ __('landings.meta_keywords') }}">
    <title>{{ __('landings.hotels_title') }} - Costa Rica Trip Packages</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        :root {
            --primary: #00A86B;
            --secondary: #FF6B35;
            --dark: #1a1a1a;
            --light: #f8f9fa;
            --gray: #6c757d;
        }
        body { font-family: 'Poppins', sans-serif; line-height: 1.6; color: var(--dark); background: #fff; }
        
        /* Navigation */
        nav {
            position: fixed;
            top: 0;
            width: 100%;
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            z-index: 1000;
            padding: 1rem 2rem;
        }
        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .logo {
            font-size: 1.3rem;
            font-weight: 800;
            color: var(--primary);
            text-decoration: none;
        }
        .nav-menu { display: flex; gap: 2rem; list-style: none; align-items: center; }
        .nav-menu a { text-decoration: none; color: var(--dark); font-weight: 500; transition: color 0.3s; }
        .nav-menu a:hover { color: var(--primary); }
        
        /* Hero */
        .hero {
            margin-top: 70px;
            height: 300px;
            background: linear-gradient(135deg, #FF6B35 0%, #00A86B 40%, #FF6B35 100%);
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }
        .hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background: url('https://images.unsplash.com/photo-1759687161429-95cb98a7cf32?w=1920&q=80') center/cover;
            opacity: 0.3;
            z-index: 1;
        }
        .hero-content { position: relative; z-index: 2; text-align: center; max-width: 800px; padding: 2rem; }
        .hero h1 { font-size: clamp(2rem, 5vw, 3.5rem); font-weight: 800; margin-bottom: 1rem; text-shadow: 2px 2px 8px rgba(0,0,0,0.3); }
        .hero p { font-size: 1.2rem; margin-bottom: 2rem; text-shadow: 1px 1px 4px rgba(0,0,0,0.3); }
        
        .cta-button {
            display: inline-block;
            padding: 1rem 2.5rem;
            background: var(--secondary);
            color: white;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 700;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(255,107,53,0.4);
            border: none;
            cursor: pointer;
        }
        .cta-button:hover { transform: translateY(-3px); box-shadow: 0 6px 25px rgba(255,107,53,0.6); }
        
        .container { max-width: 1200px; margin: 0 auto; padding: 0 2rem; }
        section { padding: 5rem 2rem; }
        .section-title { text-align: center; font-size: 2.5rem; font-weight: 800; margin-bottom: 1rem; }
        .section-subtitle { text-align: center; font-size: 1.1rem; color: var(--gray); margin-bottom: 3rem; max-width: 600px; margin-left: auto; margin-right: auto; }
        
        /* Hotels Grid */
        .hotels-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }
        .hotel-card {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: all 0.3s;
            border: 1px solid #e0e0e0;
        }
        .hotel-card:hover { transform: translateY(-10px); box-shadow: 0 8px 25px rgba(0,0,0,0.15); }
        .hotel-image { width: 100%; height: 250px; object-fit: cover; }
        .hotel-content { padding: 1.5rem; }
        .hotel-rating { color: #FFB800; font-size: 0.9rem; margin-bottom: 0.5rem; }
        .hotel-name { font-size: 1.3rem; font-weight: 700; margin-bottom: 0.5rem; }
        .hotel-location { color: var(--gray); font-size: 0.9rem; margin-bottom: 1rem; }
        .hotel-description { color: var(--gray); font-size: 0.95rem; margin-bottom: 1rem; }
        .hotel-price { display: flex; justify-content: space-between; align-items: center; padding-top: 1rem; border-top: 1px solid #e0e0e0; }
        .price-value { font-size: 1.5rem; font-weight: 800; color: var(--primary); }
        .view-btn { display: inline-block; margin-top: 1rem; padding: 0.7rem 1.5rem; background: var(--primary); color: white; text-decoration: none; border-radius: 25px; font-weight: 600; }
        
        /* Features */
        .features { background: var(--light); }
        .features-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem; margin-top: 2rem; }
        .feature { text-align: center; padding: 1.5rem; }
        .feature-icon { font-size: 3rem; margin-bottom: 1rem; }
        .feature h3 { font-size: 1.1rem; margin-bottom: 0.5rem; }
        .feature p { color: var(--gray); }
        
        /* Amenities */
        .amenities-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 2rem; margin-top: 2rem; }
        .amenity { display: flex; align-items: center; gap: 1rem; }
        .amenity-check { color: var(--primary); font-size: 1.5rem; font-weight: 700; }
        
        /* Testimonials */
        .testimonials { background: var(--light); }
        .testimonials-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem; margin-top: 2rem; }
        .testimonial { background: white; padding: 2rem; border-radius: 10px; border-left: 4px solid var(--primary); box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
        .testimonial-text { font-style: italic; color: var(--gray); margin-bottom: 1rem; }
        
        /* CTA */
        .cta-section { background: linear-gradient(135deg, #FF6B35 0%, var(--primary) 40%, #FF6B35 100%); color: white; padding: 4rem 2rem; text-align: center; }
        
        /* Footer */
        footer { background: var(--dark); color: white; padding: 2rem; text-align: center; }
        
        @media (max-width: 768px) {
            .hero { height: 400px; }
            .hero h1 { font-size: 1.8rem; }
        }
    </style>

    <!-- SEO: Hreflang -->
    <link rel="alternate" hreflang="es" href="{{ route('landing.hotels.es') }}" />
    <link rel="alternate" hreflang="en" href="{{ route('landing.hotels.en') }}" />
</head>
<body>
    <!-- Navigation -->
    <nav>
        <div class="nav-container">
            <a href="/" class="logo">🌴 Costa Rica Trips</a>
            <ul class="nav-menu">
                <li><a href="/#tours">Tours</a></li>
                <li><a href="/#contacto">Contact</a></li>
                <li><a href="/" class="cta-button" style="font-size: 0.9rem; padding: 0.6rem 1.5rem;">Home</a></li>
            </ul>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1>{{ __('landings.hotels_title') }}</h1>
            <p>{{ __('landings.hotels_description') }}</p>
            <a href="#hotels" class="cta-button">{{ __('landings.book_now') }}</a>
        </div>
    </section>

    <!-- Featured Hotels -->
    <section id="hotels" class="container">
        <h2 class="section-title">✨ {{ __('landings.adventure_title') }}</h2>
        <p class="section-subtitle">{{ __('landings.adventure_description') }}</p>

        <div class="hotels-grid">
            <div class="hotel-card">
                <img src="https://images.unsplash.com/photo-1693476636761-001418a89d5f?w=500&q=80" alt="Luxury Hotel" class="hotel-image" loading="lazy">
                <div class="hotel-content">
                    <div class="hotel-rating">★★★★★ (248 reviews)</div>
                    <h3 class="hotel-name">Arenal Luxury Resort</h3>
                    <p class="hotel-location">📍 La Fortuna, Arenal</p>
                    <p class="hotel-description">Experiencia de lujo con vistas al volcán, piscina infinita y spa de clase mundial.</p>
                    <div class="hotel-price">
                        <div>
                            <div class="price-label">{{ __('landings.price_from') }}</div>
                            <div class="price-value">$189</div>
                        </div>
                        <a href="{{ app()->getLocale() === 'es' ? '/es/provincia/guanacaste/destino/arenal/hotel/la-fortuna-resort' : '/en/province/guanacaste/destination/arenal/hotel/la-fortuna-resort' }}" class="view-btn">{{ app()->getLocale() === 'es' ? 'Ver' : 'View' }}</a>
                    </div>
                </div>
            </div>

            <div class="hotel-card">
                <img src="https://images.unsplash.com/photo-1745208098930-cf0cf811aa07?w=500&q=80" alt="Boutique Hotel" class="hotel-image" loading="lazy">
                <div class="hotel-content">
                    <div class="hotel-rating">★★★★☆ (185 reviews)</div>
                    <h3 class="hotel-name">Arenal Boutique</h3>
                    <p class="hotel-location">📍 La Fortuna, Arenal</p>
                    <p class="hotel-description">Hotel boutique con diseño contemporáneo, ubicación perfecta y atención personalizada.</p>
                    <div class="hotel-price">
                        <div>
                            <div class="price-label">{{ __('landings.price_from') }}</div>
                            <div class="price-value">$129</div>
                        </div>
                        <a href="{{ app()->getLocale() === 'es' ? '/es/provincia/guanacaste/destino/arenal/hotel/arenal-boutique' : '/en/province/guanacaste/destination/arenal/hotel/arenal-boutique' }}" class="view-btn">{{ app()->getLocale() === 'es' ? 'Ver' : 'View' }}</a>
                    </div>
                </div>
            </div>

            <div class="hotel-card">
                <img src="https://images.unsplash.com/photo-1683064772054-d05a05efbed1?w=500&q=80" alt="Adventure Hotel" class="hotel-image" loading="lazy">
                <div class="hotel-content">
                    <div class="hotel-rating">★★★★★ (312 reviews)</div>
                    <h3 class="hotel-name">Arenal Eco Lodge</h3>
                    <p class="hotel-location">📍 Rainforest, Arenal</p>
                    <p class="hotel-description">Alojamiento eco-amigable rodeado de naturaleza virgen con tours de aventura incluidos.</p>
                    <div class="hotel-price">
                        <div>
                            <div class="price-label">{{ __('landings.price_from') }}</div>
                            <div class="price-value">$99</div>
                        </div>
                        <a href="{{ app()->getLocale() === 'es' ? '/es/provincia/guanacaste/destino/arenal/hotel/arenal-eco-lodge' : '/en/province/guanacaste/destination/arenal/hotel/arenal-eco-lodge' }}" class="view-btn">{{ app()->getLocale() === 'es' ? 'Ver' : 'View' }}</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features -->
    <section class="features">
        <div class="container">
            <h2 class="section-title">🎁 Why Choose Our Hotels?</h2>
            <div class="features-grid">
                <div class="feature">
                    <div class="feature-icon">🗺️</div>
                    <h3>Prime Location</h3>
                    <p>Ubicados estratégicamente cerca de todas las atracciones principales.</p>
                </div>
                <div class="feature">
                    <div class="feature-icon">⭐</div>
                    <h3>Premium Service</h3>
                    <p>Atención 24/7 en español e inglés.</p>
                </div>
                <div class="feature">
                    <div class="feature-icon">💰</div>
                    <h3>Best Prices</h3>
                    <p>Garantizamos los mejores precios del mercado.</p>
                </div>
                <div class="feature">
                    <div class="feature-icon">📱</div>
                    <h3>Easy Booking</h3>
                    <p>Reserve en segundos con nuestro sistema seguro.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Amenities -->
    <section class="amenities">
        <div class="container">
            <h2 class="section-title">🏨 {{ __('landings.included') }}</h2>
            <div class="amenities-grid">
                <div class="amenity"><div class="amenity-check">✓</div><div>Desayuno Continental</div></div>
                <div class="amenity"><div class="amenity-check">✓</div><div>WiFi Gratis</div></div>
                <div class="amenity"><div class="amenity-check">✓</div><div>Piscina y Jacuzzi</div></div>
                <div class="amenity"><div class="amenity-check">✓</div><div>Estacionamiento Gratuito</div></div>
                <div class="amenity"><div class="amenity-check">✓</div><div>Tours Organizados</div></div>
                <div class="amenity"><div class="amenity-check">✓</div><div>Restaurante 24/7</div></div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="testimonials">
        <div class="container">
            <h2 class="section-title">💬 Guest Reviews</h2>
            <div class="testimonials-grid">
                <div class="testimonial">
                    <div class="testimonial-text">"¡Experiencia increíble! El hotel superó nuestras expectativas. ¡Volvemos!"</div>
                    <div class="testimonial-author">María González</div>
                </div>
                <div class="testimonial">
                    <div class="testimonial-text">"The volcano views are breathtaking! Perfect location. Highly recommended!"</div>
                    <div class="testimonial-author">John Smith</div>
                </div>
                <div class="testimonial">
                    <div class="testimonial-text">"Precios justos, calidad excelente. Desayuno delicioso. Gracias."</div>
                    <div class="testimonial-author">Carlos Rodríguez</div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="cta-section">
        <div class="container">
            <h2>🌟 Ready for Your Adventure?</h2>
            <p>Reserve your perfect hotel today and start creating unforgettable memories.</p>
            <a href="#hotels" class="cta-button">{{ __('landings.book_now') }}</a>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem; margin-bottom: 2rem;">
            <div>
                <p>&copy; 2025 Costa Rica Trip Packages. All rights reserved.</p>
                <p>WhatsApp: <a href="https://wa.me/506" style="color: var(--primary); text-decoration: none;">+506 1234-5678</a></p>
            </div>
            <div style="display: flex; gap: 1rem;">
                @if(app()->getLocale() === 'es')
                    <a href="{{ route('landing.hotels.en') }}" class="cta-button" style="font-size: 0.9rem; padding: 0.6rem 1.2rem; display: inline-flex; align-items: center; gap: 0.5rem;">🇬🇧 English</a>
                @else
                    <a href="{{ route('landing.hotels.es') }}" class="cta-button" style="font-size: 0.9rem; padding: 0.6rem 1.2rem; display: inline-flex; align-items: center; gap: 0.5rem;">🇪🇸 Español</a>
                @endif
            </div>
        </div>
    </footer>
</body>
</html>
