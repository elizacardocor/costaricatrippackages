<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="@yield('meta_description', 'Costa Rica Trip Packages - Tours y Paquetes Turísticos')">
    <meta name="keywords" content="@yield('meta_keywords', 'tours Costa Rica, paquetes turísticos, aventuras, volcanes')">
    <meta name="author" content="Costa Rica Trip Packages">
    <meta name="language" content="{{ app()->getLocale() === 'es' ? 'Spanish' : 'English' }}">
    
    <!-- Open Graph Tags -->
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:title" content="@yield('og_title', 'Costa Rica Trip Packages')">
    <meta property="og:description" content="@yield('og_description', 'Descubre los mejores tours y paquetes turísticos')">
    <meta property="og:image" content="@yield('og_image', asset('images/og-image.jpg'))">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="Costa Rica Trip Packages">
    <meta property="og:locale" content="{{ app()->getLocale() === 'es' ? 'es_CR' : 'en_US' }}">
    
    <!-- Twitter Card Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('twitter_title', 'Costa Rica Trip Packages')">
    <meta name="twitter:description" content="@yield('twitter_description', 'Descubre los mejores tours')">
    <meta name="twitter:image" content="@yield('twitter_image', asset('images/og-image.jpg'))">
    
    @if(config('app.env') !== 'production')
    <meta name="robots" content="noindex, nofollow">
    @else
    <meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
    @endif
    
    <title>@yield('title', 'Costa Rica Trip Packages')</title>
    
    <!-- Performance: Preload critical resources -->
    <link rel="preload" as="image" href="{{ asset('images/parqManuelAntonio/playa-parque-nacional-manuel-antonio.jpg') }}" media="(min-width: 1024px)">
    <link rel="preload" as="style" href="{{ asset('fonts/fontawesome-custom.css') }}">
    
    <!-- Canonical URL -->
    @yield('canonical')
    
    <!-- Hreflang -->
    @yield('hreflang')
    
    <!-- Preconnect to external resources for performance -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome - Optimized Local Version -->
    <link rel="stylesheet" href="{{ asset('fonts/fontawesome-custom.css') }}">
    
    <!-- Layout CSS -->
    @vite(['resources/css/layout.css'])
    
    <!-- WhatsApp Float Button Styles -->
    <style>
        .whatsapp-float {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 60px;
            height: 60px;
            background: #25D366;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            box-shadow: 0 4px 20px rgba(37, 211, 102, 0.4);
            z-index: 1000;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .whatsapp-float:hover {
            background: #20BA5A;
            transform: scale(1.1);
            box-shadow: 0 6px 30px rgba(37, 211, 102, 0.6);
            color: white;
        }

        .whatsapp-float i {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.1);
            }
        }

        @media (max-width: 768px) {
            .whatsapp-float {
                width: 50px;
                height: 50px;
                font-size: 1.5rem;
                bottom: 20px;
                right: 20px;
            }
        }
    </style>
    
    @stack('styles')
    @yield('extra_styles')
</head>
<body>
    <!-- Top Header Bar -->
    <div class="top-header">
        <div class="top-header-container">
            <div class="top-header-left">
                <a href="tel:+50670579814" class="top-header-item">
                    <i class="fas fa-phone"></i>
                    <span>+506 7057-9814</span>
                </a>
                <a href="mailto:info@costaricatrippackages.com" class="top-header-item">
                    <i class="fas fa-envelope"></i>
                    <span>Email Us</span>
                </a>
            </div>
            <div class="top-header-right">
                <div class="top-header-item">
                    <i class="fas fa-dollar-sign"></i>
                    <span>Exchange Rate: ₡497.72</span>
                </div>
                {{--
                <a href="/dashboard" class="top-header-item agency-login">
                    <i class="fas fa-user-lock"></i>
                    <span>AGENCY LOGIN</span>
                </a>
                --}}
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="navbar" id="navbar">
        <div class="nav-container">
            <a href="{{ app()->getLocale() === 'es' ? '/es/' : '/en/' }}" class="logo">
                <img src="{{ asset('images/tripsCostaRicaColombiaViajes.jpg') }}" alt="Costa Rica Trips Tours" class="logo-image">
            </a>
            <button class="nav-toggle" id="navToggle">☰</button>
            <ul class="nav-menu" id="navMenu">
                <li><a href="{{ app()->getLocale() === 'es' ? '/es/' : '/en/' }}">{{ app()->getLocale() === 'es' ? 'Inicio' : 'Home' }}</a></li>
                <li><a href="{{ app()->getLocale() === 'es' ? '/es/tours' : '/en/tours' }}">Tours</a></li>
                <!-- <li><a href="{{ app()->getLocale() === 'es' ? '/es/hoteles' : '/en/hotels' }}">{{ app()->getLocale() === 'es' ? 'Hoteles' : 'Hotels' }}</a></li> -->
                <!-- <li><a href="{{ app()->getLocale() === 'es' ? '/es/transporte' : '/en/transport' }}">{{ app()->getLocale() === 'es' ? 'Transporte' : 'Transport' }}</a></li> -->
                <li><a href="{{ app()->getLocale() === 'es' ? '/es/contacto' : '/en/contact' }}">{{ app()->getLocale() === 'es' ? 'Contacto' : 'Contact' }}</a></li>
                <!-- <li><a href="/dashboard" style="color: #8B0000;">Dashboard</a></li> -->
                <li>
                    @php
                        $currentPath = trim(request()->path(), '/');

                        // Home routes
                        if ($currentPath === '' || $currentPath === 'es' || $currentPath === 'en') {
                            $newPath = app()->getLocale() === 'es' ? 'en/' : 'es/';
                        }

                        // Mapeo de rutas ES <-> EN
                        $routeMap = [
                            'es/contacto' => 'en/contact',
                            'en/contact' => 'es/contacto',
                            // 'es/hoteles' => 'en/hotels',       // Comentado para usar en futuro
                            // 'en/hotels' => 'es/hoteles',       // Comentado para usar en futuro
                            // 'es/transporte' => 'en/transport', // Comentado para usar en futuro
                            // 'en/transport' => 'es/transporte', // Comentado para usar en futuro
                        ];

                        if (!isset($newPath) && isset($routeMap[$currentPath])) {
                            $newPath = $routeMap[$currentPath];
                        }

                        // Para otras rutas, cambiar prefijo de idioma
                        if (!isset($newPath)) {
                            if (app()->getLocale() === 'es') {
                                if ($currentPath === 'es') {
                                    $newPath = 'en/';
                                } elseif (str_starts_with($currentPath, 'es/')) {
                                    $newPath = 'en/' . substr($currentPath, 3);
                                } else {
                                    $newPath = 'en/' . ltrim($currentPath, '/');
                                }
                            } else {
                                if ($currentPath === 'en') {
                                    $newPath = 'es/';
                                } elseif (str_starts_with($currentPath, 'en/')) {
                                    $newPath = 'es/' . substr($currentPath, 3);
                                } else {
                                    $newPath = 'es/' . ltrim($currentPath, '/');
                                }
                            }
                        }
                    @endphp
                    @if(app()->getLocale() === 'en')
                        {{-- <a href="{{ '/' . $newPath }}" style="color: #8B0000; font-weight: 600;">
                            {{ '🇪🇸 ES' }}
                        </a> --}}
                    @else
                        <a href="{{ '/' . $newPath }}" style="color: #8B0000; font-weight: 600;">
                            {{ '🇬🇧 EN' }}
                        </a>
                    @endif
                </li>
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <div class="footer-section">
                <h3>{{ app()->getLocale() === 'es' ? 'Síguenos' : 'Follow Us' }}</h3>
                <div class="social-links">
                    <a href="https://www.facebook.com/share/188Va9sso4/" target="_blank" class="social-icon facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="https://www.instagram.com/costarica_.trip/" target="_blank" class="social-icon instagram">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="1em" height="1em" fill="currentColor"><path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9 114.9-51.3 114.9-114.9S287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"/></svg>
                    </a>
                    <a href="https://tiktok.com/@costa.rica.trip4" target="_blank" class="social-icon tiktok">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="1em" height="1em" fill="currentColor"><path d="M448 209.9v99.7c-35.3 0-69.7-11.7-97.9-33.1v104.3c0 66.2-53.7 120-120 120s-120-53.8-120-120 53.7-120 120-120c7.9 0 15.7.8 23.3 2.3v66.1c-7.6-2.5-15.7-3.9-23.3-3.9-39.7 0-72 32.3-72 72s32.3 72 72 72 72-32.3 72-72V96h48c0 62.7 51.3 113.9 113.9 113.9z"/></svg>
                    </a>
                </div>
            </div>
            <div class="footer-section">
                <h3>{{ app()->getLocale() === 'es' ? 'Contáctanos' : 'Contact Us' }}</h3>
                <div class="contact-icons">
                    <a href="https://wa.me/50670579814?text=Hello%2C%20I%20would%20like%20more%20information%20about%20your%20personalized%20tours%20in%20Costa%20Rica" target="_blank" class="contact-icon whatsapp" title="WhatsApp">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                    <a href="tel:+50670579814" class="contact-icon phone" title="{{ app()->getLocale() === 'es' ? 'Llamar' : 'Call' }}">
                        <i class="fas fa-phone"></i>
                    </a>
                    <a href="mailto:info@costaricatrippackages.com" class="contact-icon email" title="Email">
                        <i class="fas fa-envelope"></i>
                    </a>
                </div>
            </div>
            <div class="footer-section">
                <h3>{{ app()->getLocale() === 'es' ? 'Métodos de Pago Seguros' : 'Secure Payment Methods' }}</h3>
                <div class="payment-icons">
                    <i class="fab fa-cc-paypal"></i>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} Costa Rica Trip Packages. {{ app()->getLocale() === 'es' ? 'Todos los derechos reservados.' : 'All rights reserved.' }}</p>
            <p class="footer-security">
                {{ app()->getLocale() === 'es' ? 'Este sitio está protegido por reCAPTCHA y se aplican la' : 'This site is protected by reCAPTCHA and the Google' }} 
                <a href="https://policies.google.com/privacy" target="_blank">{{ app()->getLocale() === 'es' ? 'Política de Privacidad' : 'Privacy Policy' }}</a> 
                {{ app()->getLocale() === 'es' ? 'y los' : 'and' }} 
                <a href="https://policies.google.com/terms" target="_blank">{{ app()->getLocale() === 'es' ? 'Términos de Servicio' : 'Terms of Service' }}</a> 
                {{ app()->getLocale() === 'es' ? 'de Google.' : 'apply.' }}
            </p>
        </div>
    </footer>

    <!-- WhatsApp Floating Button -->
    <a href="https://wa.me/50670579814?text=Hello%2C%20I%20would%20like%20more%20information%20about%20your%20personalized%20tours%20in%20Costa%20Rica" target="_blank" class="whatsapp-float" title="WhatsApp">
        <i class="fab fa-whatsapp"></i>
    </a>

    <!-- Scripts -->
    <script defer>
        // Mobile menu toggle
        const navToggle = document.getElementById('navToggle');
        const navMenu = document.getElementById('navMenu');

        if (navToggle && navMenu) {
            navToggle.addEventListener('click', () => {
                navMenu.classList.toggle('active');
            });

            // Close menu when clicking outside
            document.addEventListener('click', (e) => {
                if (!navToggle.contains(e.target) && !navMenu.contains(e.target)) {
                    navMenu.classList.remove('active');
                }
            });
        }

        // Navbar scroll effect
        window.addEventListener('scroll', () => {
            const navbar = document.getElementById('navbar');
            if (navbar) {
                if (window.scrollY > 50) {
                    navbar.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                }
            }
        });
    </script>
    
    @stack('scripts')
    @yield('extra_scripts')
</body>
</html>
