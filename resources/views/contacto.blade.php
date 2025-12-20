<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="{{ __('contact.meta_description') }}">
    @if(config('app.env') !== 'production')
    <meta name="robots" content="noindex, nofollow">
    @endif
    <title>{{ __('contact.title') }} - Costa Rica Trip Packages</title>
    
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

        .lang-switch {
            padding: 0.5rem 1rem;
            background: var(--light);
            border-radius: 20px;
            font-size: 0.9rem;
            transition: all 0.3s;
        }

        .lang-switch:hover {
            background: var(--primary-color) !important;
            color: white !important;
        }

        .nav-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
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

        /* Main Content */
        .contact-section {
            padding: 4rem 2rem;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .contact-grid {
            display: flex;
            flex-direction: column;
            gap: 3rem;
            margin-top: 3rem;
        }

        /* Contact Info */
        .contact-info {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 2rem;
            max-width: 100%;
        }

        .info-card {
            background: var(--light);
            padding: 2rem;
            border-radius: 15px;
            display: flex;
            align-items: start;
            gap: 1.5rem;
            transition: all 0.3s;
        }

        .info-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .info-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            flex-shrink: 0;
            box-shadow: 0 4px 15px rgba(0, 168, 107, 0.3);
        }

        .info-content h3 {
            font-size: 1.3rem;
            margin-bottom: 0.5rem;
            color: var(--dark);
        }

        .info-content p {
            color: var(--gray);
            line-height: 1.8;
        }

        .info-content a {
            color: var(--secondary-color);
            text-decoration: none;
            font-weight: 500;
        }

        .info-content a:hover {
            text-decoration: underline;
        }

        .social-links {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
        }

        .social-link {
            width: 45px;
            height: 45px;
            background: white;
            border: 2px solid var(--primary-color);
            color: var(--primary-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            font-size: 1.2rem;
            transition: all 0.3s;
        }

        .social-link:hover {
            background: var(--primary-color);
            color: white;
            transform: translateY(-3px);
        }

        /* Contact Form */
        .contact-form {
            background: white;
            padding: 2.5rem;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
        }

        .form-title {
            font-size: 1.8rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            color: var(--dark);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: var(--dark);
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 0.9rem 1.2rem;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-family: 'Poppins', sans-serif;
            font-size: 1rem;
            transition: all 0.3s;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(0, 168, 107, 0.1);
        }

        .form-group textarea {
            min-height: 150px;
            resize: vertical;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .submit-button {
            width: 100%;
            padding: 1.2rem;
            background: var(--accent-color);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 1.1rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 1rem;
        }

        .submit-button:hover {
            background: #e55a2b;
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(255,107,53,0.4);
        }

        .submit-button:active {
            transform: translateY(-1px);
        }

        /* Map Section */
        .map-section {
            padding: 4rem 2rem;
            background: var(--light);
        }

        .section-title {
            text-align: center;
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 2rem;
            color: var(--dark);
        }

        .map-container {
            max-width: 1200px;
            margin: 0 auto;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
        }

        .map-container iframe {
            width: 100%;
            height: 450px;
            border: 0;
        }

        /* FAQ Section */
        .faq-section {
            padding: 4rem 2rem;
        }

        .faq-list {
            max-width: 800px;
            margin: 0 auto;
        }

        .faq-item {
            background: white;
            border-radius: 10px;
            margin-bottom: 1rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            overflow: hidden;
        }

        .faq-question {
            padding: 1.5rem;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-weight: 600;
            color: var(--dark);
            transition: background 0.3s;
        }

        .faq-question:hover {
            background: var(--light);
        }

        .faq-question::after {
            content: '+';
            font-size: 1.5rem;
            color: var(--primary-color);
        }

        .faq-question.active::after {
            content: '−';
        }

        .faq-answer {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
        }

        .faq-answer.active {
            max-height: 500px;
        }

        .faq-answer-content {
            padding: 0 1.5rem 1.5rem;
            color: var(--gray);
            line-height: 1.8;
        }

        /* Success Message */
        .success-message {
            display: none;
            background: #d4edda;
            color: #155724;
            padding: 1rem;
            border-radius: 10px;
            margin-bottom: 1rem;
            border: 1px solid #c3e6cb;
        }

        .success-message.show {
            display: block;
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
        @media (max-width: 968px) {
            .page-header h1 {
                font-size: 2rem;
            }

            .form-row {
                grid-template-columns: 1fr;
            }

            .contact-info {
                grid-template-columns: 1fr;
            }
        }

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
            <button class="nav-toggle" id="navToggle">☰</button>
            <ul class="nav-menu" id="navMenu">
                <li><a href="/">{{ app()->getLocale() === 'es' ? 'Inicio' : 'Home' }}</a></li>
                <li><a href="{{ app()->getLocale() === 'es' ? '/es/tours' : '/en/tours' }}">{{ app()->getLocale() === 'es' ? 'Tours' : 'Tours' }}</a></li>
                <li><a href="/#destinos">{{ app()->getLocale() === 'es' ? 'Destinos' : 'Destinations' }}</a></li>
                <li>
                    <a href="{{ app()->getLocale() === 'es' ? '/es/contacto' : '/en/contact' }}" style="color: var(--primary-color);">
                        {{ app()->getLocale() === 'es' ? 'Contacto' : 'Contact' }}
                    </a>
                </li>
                <li>
                    @if(app()->getLocale() === 'es')
                        <a href="{{ str_replace('/es/', '/en/', request()->getPathInfo()) }}" class="lang-switch">🇬🇧 EN</a>
                    @else
                        <a href="{{ str_replace('/en/', '/es/', request()->getPathInfo()) }}" class="lang-switch">🇪🇸 ES</a>
                    @endif
                </li>
            </ul>
        </div>
    </nav>

    <!-- Page Header -->
    <div class="page-header">
        <h1>{{ __('contact.header_title') }}</h1>
        <p>{{ __('contact.header_subtitle') }}</p>
    </div>

    <!-- Contact Section -->
    <section class="contact-section">
        <div class="container">
            <div class="contact-grid">
                <!-- Contact Form -->
                <div class="contact-form">
                    <h2 class="form-title">{{ __('contact.form_title') }}</h2>
                    
                    <div class="success-message" id="successMessage">
                        {{ __('contact.form_success') }}
                    </div>

                    <form id="contactForm" onsubmit="handleSubmit(event)">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="name">{{ __('contact.form_name') }} {{ __('contact.form_required') }}</label>
                                <input type="text" id="name" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="email">{{ __('contact.form_email') }} {{ __('contact.form_required') }}</label>
                                <input type="email" id="email" name="email" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="phone">{{ __('contact.form_phone') }}</label>
                                <input type="tel" id="phone" name="phone">
                            </div>
                            <div class="form-group">
                                <label for="subject">{{ __('contact.form_subject') }} {{ __('contact.form_required') }}</label>
                                <select id="subject" name="subject" required>
                                    <option value="">{{ __('contact.subject_select') }}</option>
                                    <option value="tour">{{ __('contact.subject_tour') }}</option>
                                    <option value="reservation">{{ __('contact.subject_reservation') }}</option>
                                    <option value="price">{{ __('contact.subject_price') }}</option>
                                    <option value="custom">{{ __('contact.subject_custom') }}</option>
                                    <option value="other">{{ __('contact.subject_other') }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="message">{{ __('contact.form_message') }} {{ __('contact.form_required') }}</label>
                            <textarea id="message" name="message" required placeholder="{{ __('contact.form_placeholder') }}"></textarea>
                        </div>

                        <button type="submit" class="submit-button">{{ __('contact.form_submit') }}</button>
                    </form>
                </div>

                <!-- Contact Info -->
                <div class="contact-info">
                    <div class="info-card">
                        <div class="info-icon">📧</div>
                        <div class="info-content">
                            <h3>{{ __('contact.contact_email') }}</h3>
                            <p>{{ __('contact.contact_email_text') }}</p>
                            <a href="mailto:info@costaricatrips.com">{{ __('contact.contact_email_info') }}</a><br>
                            <a href="mailto:reservas@costaricatrips.com">{{ __('contact.contact_email_reservations') }}</a>
                        </div>
                    </div>

                    <div class="info-card">
                        <div class="info-icon">📱</div>
                        <div class="info-content">
                            <h3>{{ __('contact.contact_phone') }}</h3>
                            <p>{{ __('contact.contact_phone_hours') }}</p>
                            <a href="tel:+50612345678">{{ __('contact.contact_phone_number') }}</a><br>
                            <a href="https://wa.me/50612345678" target="_blank">{{ __('contact.contact_whatsapp') }}</a>
                        </div>
                    </div>

                    <div class="info-card">
                        <div class="info-icon">📍</div>
                        <div class="info-content">
                            <h3>{{ __('contact.contact_office') }}</h3>
                            <p>{{ __('contact.contact_office_address') }}</p>
                        </div>
                    </div>

                    <div class="info-card">
                        <div class="info-icon">🌐</div>
                        <div class="info-content">
                            <h3>{{ __('contact.contact_social') }}</h3>
                            <p>{{ __('contact.contact_social_text') }}</p>
                            <div class="social-links">
                                <a href="#" class="social-link" title="Facebook">📘</a>
                                <a href="#" class="social-link" title="Instagram">📷</a>
                                <a href="#" class="social-link" title="Twitter">🐦</a>
                                <a href="#" class="social-link" title="YouTube">▶️</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    <section class="map-section">
        <div class="container">
            <h2 class="section-title">{{ __('contact.location_title') }}</h2>
            <div class="map-container">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d251644.5447867131!2d-84.19109841593447!3d9.934739299623824!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8fa0e342c50d15c5%3A0xe6746a6a9f11b882!2sSan%20Jos%C3%A9%2C%20Costa%20Rica!5e0!3m2!1sen!2s!4v1702393200000!5m2!1sen!2s" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="faq-section">
        <div class="container">
            <h2 class="section-title">{{ __('contact.faq_title') }}</h2>
            <div class="faq-list">
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        {{ __('contact.faq_q1') }}
                    </div>
                    <div class="faq-answer">
                        <div class="faq-answer-content">
                            {{ __('contact.faq_a1') }}
                        </div>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        {{ __('contact.faq_q2') }}
                    </div>
                    <div class="faq-answer">
                        <div class="faq-answer-content">
                            {{ __('contact.faq_a2') }}
                        </div>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        {{ __('contact.faq_q3') }}
                    </div>
                    <div class="faq-answer">
                        <div class="faq-answer-content">
                            {{ __('contact.faq_a3') }}
                        </div>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        {{ __('contact.faq_q4') }}
                    </div>
                    <div class="faq-answer">
                        <div class="faq-answer-content">
                            {{ __('contact.faq_a4') }}
                        </div>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        {{ __('contact.faq_q5') }}
                    </div>
                    <div class="faq-answer">
                        <div class="faq-answer-content">
                            {{ __('contact.faq_a5') }}
                        </div>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        {{ __('contact.faq_q6') }}
                    </div>
                    <div class="faq-answer">
                        <div class="faq-answer-content">
                            {{ __('contact.faq_a6') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <div class="footer-section">
                <h3>Costa Rica Trips</h3>
                <p>{{ __('contact.footer_text') }}</p>
            </div>
            <div class="footer-section">
                <h3>{{ __('contact.footer_quick_links') }}</h3>
                <ul>
                    <li><a href="{{ app()->getLocale() === 'es' ? '/es/tours' : '/en/tours' }}">Tours</a></li>
                    <li><a href="/#destinos">{{ app()->getLocale() === 'es' ? 'Destinos' : 'Destinations' }}</a></li>
                    <li><a href="{{ app()->getLocale() === 'es' ? '/es/contacto' : '/en/contact' }}">{{ __('contact.footer_contact') }}</a></li>
                    <li><a href="/dashboard">Dashboard</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>{{ __('contact.footer_contact') }}</h3>
                <ul>
                    <li>📧 info@costaricatrips.com</li>
                    <li>📱 +506 1234-5678</li>
                    <li>📍 San José, Costa Rica</li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>{{ __('contact.footer_copyright') }}</p>
        </div>
    </footer>

    <script>
        // Mobile menu toggle
        const navToggle = document.getElementById('navToggle');
        const navMenu = document.getElementById('navMenu');

        navToggle.addEventListener('click', () => {
            navMenu.classList.toggle('active');
        });

        // FAQ Toggle
        function toggleFAQ(element) {
            const answer = element.nextElementSibling;
            const isActive = element.classList.contains('active');
            
            // Close all FAQs
            document.querySelectorAll('.faq-question').forEach(q => {
                q.classList.remove('active');
                q.nextElementSibling.classList.remove('active');
            });
            
            // Open clicked FAQ if it wasn't active
            if (!isActive) {
                element.classList.add('active');
                answer.classList.add('active');
            }
        }

        // Form submission
        function handleSubmit(event) {
            event.preventDefault();
            
            const form = event.target;
            const successMessage = document.getElementById('successMessage');
            const submitButton = form.querySelector('button[type="submit"]');
            
            // Deshabilitar botón
            submitButton.disabled = true;
            submitButton.textContent = 'Enviando...';
            
            // Recopilar datos del formulario
            const formData = new FormData(form);
            
            // Enviar al backend
            fetch('/contacto', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                    'Accept': 'application/json',
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    successMessage.textContent = data.message;
                    successMessage.classList.add('show');
                    form.reset();
                    submitButton.textContent = 'Enviar Mensaje';
                    submitButton.disabled = false;
                    
                    // Scroll to success message
                    successMessage.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    
                    // Ocultar mensaje después de 5 segundos
                    setTimeout(() => {
                        successMessage.classList.remove('show');
                    }, 5000);
                } else {
                    alert('Error: ' + data.message);
                    submitButton.textContent = 'Enviar Mensaje';
                    submitButton.disabled = false;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Hubo un error al enviar el mensaje. Por favor intenta de nuevo.');
                submitButton.textContent = 'Enviar Mensaje';
                submitButton.disabled = false;
            });
            
            return false;
        }
    </script>
</body>
</html>
