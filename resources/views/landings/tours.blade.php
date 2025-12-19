<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ __('landings.meta_description') }}">
    <meta name="keywords" content="{{ __('landings.meta_keywords') }}">
    <title>{{ __('landings.tours_title') }} - Costa Rica Trip Packages</title>
    
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
        .hero { margin-top: 70px; height: 300px; background: linear-gradient(135deg, #FF6B35 0%, #FF6B35 50%, #00A86B 100%); position: relative; display: flex; align-items: center; justify-content: center; color: white; }
        .hero::before { content: ''; position: absolute; inset: 0; background: url('https://images.unsplash.com/photo-1764788799559-824c59d2104a?w=1920&q=80') center/cover; opacity: 0.3; z-index: 1; }
        .hero-content { position: relative; z-index: 2; text-align: center; max-width: 800px; padding: 2rem; }
        .hero h1 { font-size: clamp(2rem, 5vw, 3.5rem); font-weight: 800; margin-bottom: 1rem; text-shadow: 2px 2px 8px rgba(0,0,0,0.3); }
        .hero p { font-size: 1.2rem; margin-bottom: 2rem; text-shadow: 1px 1px 4px rgba(0,0,0,0.3); }
        .cta-button { display: inline-block; padding: 1rem 2.5rem; background: var(--secondary); color: white; text-decoration: none; border-radius: 50px; font-weight: 700; transition: all 0.3s; box-shadow: 0 4px 15px rgba(255,107,53,0.4); border: none; cursor: pointer; }
        .cta-button:hover { transform: translateY(-3px); box-shadow: 0 6px 25px rgba(255,107,53,0.6); }
        .container { max-width: 1200px; margin: 0 auto; padding: 0 2rem; }
        section { padding: 5rem 2rem; }
        .section-title { text-align: center; font-size: 2.5rem; font-weight: 800; margin-bottom: 1rem; }
        .section-subtitle { text-align: center; font-size: 1.1rem; color: var(--gray); margin-bottom: 3rem; max-width: 600px; margin-left: auto; margin-right: auto; }
        .tours-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem; margin-top: 3rem; }
        .tour-card { background: white; border-radius: 10px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.1); transition: all 0.3s; border: 1px solid #e0e0e0; }
        .tour-card:hover { transform: translateY(-10px); box-shadow: 0 8px 25px rgba(0,0,0,0.15); }
        .tour-image { width: 100%; height: 250px; object-fit: cover; }
        .tour-content { padding: 1.5rem; }
        .tour-name { font-size: 1.3rem; font-weight: 700; margin-bottom: 0.5rem; }
        .tour-duration { color: var(--gray); font-size: 0.9rem; margin-bottom: 1rem; }
        .tour-description { color: var(--gray); font-size: 0.95rem; margin-bottom: 1rem; }
        .tour-price { display: flex; justify-content: space-between; align-items: center; padding-top: 1rem; border-top: 1px solid #e0e0e0; }
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
        .cta-section { background: linear-gradient(135deg, #FF6B35 0%, #FF6B35 60%, #00A86B 100%); color: white; padding: 4rem 2rem; text-align: center; }
        footer { background: var(--dark); color: white; padding: 2rem; text-align: center; }
        @media (max-width: 768px) { .hero { height: 400px; } .hero h1 { font-size: 1.8rem; } }
    </style>

    <link rel="alternate" hreflang="es" href="{{ route('landing.tours.es') }}" />
    <link rel="alternate" hreflang="en" href="{{ route('landing.tours.en') }}" />
</head>
<body>
    <nav>
        <div class="nav-container">
            <a href="/" class="logo">🌴 Costa Rica Trips</a>
            <ul class="nav-menu">
                <li><a href="/#hotels">Hotels</a></li>
                <li><a href="/#contacto">Contact</a></li>
                <li><a href="/" class="cta-button" style="font-size: 0.9rem; padding: 0.6rem 1.5rem;">Home</a></li>
            </ul>
        </div>
    </nav>

    <section class="hero">
        <div class="hero-content">
            <h1>{{ __('landings.tours_title') }}</h1>
            <p>{{ __('landings.tours_description') }}</p>
            <a href="#tours" class="cta-button">{{ __('landings.book_now') }}</a>
        </div>
    </section>

    <section id="tours" class="container">
        <h2 class="section-title">🎒 {{ __('landings.explore_nature') }}</h2>
        <p class="section-subtitle">Vive experiencias únicas en la naturaleza más salvaje de Costa Rica</p>

        <div class="tours-grid">
            <div class="tour-card">
                <img src="https://images.unsplash.com/photo-1651261932254-fd342bc4d999?w=500&q=80" alt="Arenal Volcano Tour" class="tour-image" loading="lazy">
                <div class="tour-content">
                    <h3 class="tour-name">Arenal Volcano Adventure</h3>
                    <p class="tour-duration">⏱️ {{ __('landings.full_day') }}</p>
                    <p class="tour-description">Senderismo al volcán, vistas espectaculares y baños termales naturales incluidos.</p>
                    <div class="tour-price">
                        <div>
                            <div style="color: var(--gray); font-size: 0.85rem;">{{ __('landings.price_from') }}</div>
                            <div class="price-value">$89</div>
                        </div>
                        <a href="#" class="view-btn">View</a>
                    </div>
                </div>
            </div>

            <div class="tour-card">
                <img src="https://images.unsplash.com/photo-1592593210599-492c25d93ef9?w=500&q=80" alt="Rainforest Tour" class="tour-image" loading="lazy">
                <div class="tour-content">
                    <h3 class="tour-name">Rainforest Canopy Tour</h3>
                    <p class="tour-duration">⏱️ {{ __('landings.full_day') }}</p>
                    <p class="tour-description">Tirolesas sobre el dosel del bosque, fauna exótica y vistas panorámicas únícas.</p>
                    <div class="tour-price">
                        <div>
                            <div style="color: var(--gray); font-size: 0.85rem;">{{ __('landings.price_from') }}</div>
                            <div class="price-value">$75</div>
                        </div>
                        <a href="#" class="view-btn">View</a>
                    </div>
                </div>
            </div>

            <div class="tour-card">
                <img src="https://images.unsplash.com/photo-1710383739874-c4384c5f43f2?w=500&q=80" alt="Hot Springs Tour" class="tour-image" loading="lazy">
                <div class="tour-content">
                    <h3 class="tour-name">Hot Springs & Spa</h3>
                    <p class="tour-duration">⏱️ {{ __('landings.half_day') }}</p>
                    <p class="tour-description">Relájate en aguas termales naturales con tratamientos de spa incluidos.</p>
                    <div class="tour-price">
                        <div>
                            <div style="color: var(--gray); font-size: 0.85rem;">{{ __('landings.price_from') }}</div>
                            <div class="price-value">$65</div>
                        </div>
                        <a href="#" class="view-btn">View</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="features">
        <div class="container">
            <h2 class="section-title">✨ Why Our Tours?</h2>
            <div class="features-grid">
                <div class="feature">
                    <div class="feature-icon">👨‍🏫</div>
                    <h3>Expert Guides</h3>
                    <p>Guías locales con amplio conocimiento del territorio y vida silvestre.</p>
                </div>
                <div class="feature">
                    <div class="feature-icon">🛡️</div>
                    <h3>100% Safe</h3>
                    <p>Equipo moderno y protocolos de seguridad internacionales.</p>
                </div>
                <div class="feature">
                    <div class="feature-icon">🌱</div>
                    <h3>Eco-Friendly</h3>
                    <p>Tours sostenibles que protegen la naturaleza.</p>
                </div>
                <div class="feature">
                    <div class="feature-icon">⭐</div>
                    <h3>Unforgettable</h3>
                    <p>Experiencias auténticas que recordarás de por vida.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="testimonials">
        <div class="container">
            <h2 class="section-title">💬 Adventure Stories</h2>
            <div class="testimonials-grid">
                <div class="testimonial">
                    <div class="testimonial-text">"¡El mejor tour de mi vida! Los guías fueron increíbles y las vistas fueron espectaculares."</div>
                    <div class="testimonial-author">Ana Martínez</div>
                </div>
                <div class="testimonial">
                    <div class="testimonial-text">"Amazing experience! The canopy tour was thrilling and the guides were very professional."</div>
                    <div class="testimonial-author">Michael Johnson</div>
                </div>
                <div class="testimonial">
                    <div class="testimonial-text">"Superó todas mis expectativas. Recomendaré estos tours a todos mis amigos."</div>
                    <div class="testimonial-author">Carlos López</div>
                </div>
            </div>
        </div>
    </section>

    <section class="cta-section">
        <div class="container">
            <h2>🌿 Ready for Adventure?</h2>
            <p>Book your tour today and experience the magic of Costa Rica.</p>
            <a href="#tours" class="cta-button">{{ __('landings.book_now') }}</a>
        </div>
    </section>

    <footer>
        <p>&copy; 2025 Costa Rica Trip Packages. All rights reserved.</p>
        <p>WhatsApp: <a href="https://wa.me/506" style="color: var(--primary); text-decoration: none;">+506 1234-5678</a></p>
    </footer>
</body>
</html>
