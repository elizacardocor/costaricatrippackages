<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Contáctanos para más información sobre tours y paquetes turísticos en Costa Rica">
    <title>Contacto - Costa Rica Trip Packages</title>
    
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
                <li><a href="/">Inicio</a></li>
                <li><a href="/tours">Tours</a></li>
                <li><a href="/#destinos">Destinos</a></li>
                <li><a href="/contacto" style="color: var(--primary-color);">Contacto</a></li>
            </ul>
        </div>
    </nav>

    <!-- Page Header -->
    <div class="page-header">
        <h1>Contáctanos</h1>
        <p>¿Listo para tu próxima aventura? Estamos aquí para ayudarte a planificar el viaje perfecto a Costa Rica</p>
    </div>

    <!-- Contact Section -->
    <section class="contact-section">
        <div class="container">
            <div class="contact-grid">
                <!-- Contact Form -->
                <div class="contact-form">
                    <h2 class="form-title">Envíanos un Mensaje</h2>
                    
                    <div class="success-message" id="successMessage">
                        ¡Gracias por contactarnos! Tu mensaje ha sido enviado. Te responderemos pronto.
                    </div>

                    <form id="contactForm" onsubmit="handleSubmit(event)">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="name">Nombre Completo *</label>
                                <input type="text" id="name" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email *</label>
                                <input type="email" id="email" name="email" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="phone">Teléfono</label>
                                <input type="tel" id="phone" name="phone">
                            </div>
                            <div class="form-group">
                                <label for="subject">Asunto *</label>
                                <select id="subject" name="subject" required>
                                    <option value="">Selecciona un asunto</option>
                                    <option value="tour">Consulta sobre tours</option>
                                    <option value="reservation">Reserva</option>
                                    <option value="price">Información de precios</option>
                                    <option value="custom">Paquete personalizado</option>
                                    <option value="other">Otro</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="message">Mensaje *</label>
                            <textarea id="message" name="message" required placeholder="Cuéntanos sobre tu próxima aventura en Costa Rica..."></textarea>
                        </div>

                        <button type="submit" class="submit-button">Enviar Mensaje</button>
                    </form>
                </div>

                <!-- Contact Info -->
                <div class="contact-info">
                    <div class="info-card">
                        <div class="info-icon">📧</div>
                        <div class="info-content">
                            <h3>Email</h3>
                            <p>Escríbenos en cualquier momento</p>
                            <a href="mailto:info@costaricatrips.com">info@costaricatrips.com</a><br>
                            <a href="mailto:reservas@costaricatrips.com">reservas@costaricatrips.com</a>
                        </div>
                    </div>

                    <div class="info-card">
                        <div class="info-icon">📱</div>
                        <div class="info-content">
                            <h3>Teléfono / WhatsApp</h3>
                            <p>Lunes a Viernes: 8:00 AM - 6:00 PM<br>
                               Sábados: 9:00 AM - 2:00 PM</p>
                            <a href="tel:+50612345678">+506 1234-5678</a><br>
                            <a href="https://wa.me/50612345678" target="_blank">WhatsApp: +506 1234-5678</a>
                        </div>
                    </div>

                    <div class="info-card">
                        <div class="info-icon">📍</div>
                        <div class="info-content">
                            <h3>Oficina Central</h3>
                            <p>Avenida Central, San José<br>
                               Costa Rica, 10101<br>
                               Edificio Costa Rica Trips, Piso 3</p>
                        </div>
                    </div>

                    <div class="info-card">
                        <div class="info-icon">🌐</div>
                        <div class="info-content">
                            <h3>Síguenos en Redes Sociales</h3>
                            <p>Mantente al día con nuestras ofertas y destinos</p>
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
            <h2 class="section-title">Nuestra Ubicación</h2>
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
            <h2 class="section-title">Preguntas Frecuentes</h2>
            <div class="faq-list">
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        ¿Cuál es el mejor momento para visitar Costa Rica?
                    </div>
                    <div class="faq-answer">
                        <div class="faq-answer-content">
                            Costa Rica es un destino de todo el año. La temporada seca (diciembre-abril) es ideal para playas y sol. La temporada verde (mayo-noviembre) ofrece paisajes exuberantes y menos turistas.
                        </div>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        ¿Los tours incluyen transporte?
                    </div>
                    <div class="faq-answer">
                        <div class="faq-answer-content">
                            Sí, todos nuestros tours incluyen transporte con aire acondicionado desde y hacia tu hotel en San José. Si te hospedas en otra ciudad, podemos coordinar el punto de encuentro.
                        </div>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        ¿Necesito vacunas para viajar a Costa Rica?
                    </div>
                    <div class="faq-answer">
                        <div class="faq-answer-content">
                            No hay vacunas obligatorias para ingresar a Costa Rica. Sin embargo, recomendamos consultar con tu médico y considerar vacunas para hepatitis A y B, y tétanos.
                        </div>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        ¿Puedo personalizar un tour?
                    </div>
                    <div class="faq-answer">
                        <div class="faq-answer-content">
                            ¡Absolutamente! Ofrecemos paquetes personalizados adaptados a tus intereses, presupuesto y tiempo disponible. Contáctanos para diseñar tu aventura perfecta.
                        </div>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        ¿Qué métodos de pago aceptan?
                    </div>
                    <div class="faq-answer">
                        <div class="faq-answer-content">
                            Aceptamos tarjetas de crédito/débito (Visa, Mastercard, American Express), transferencias bancarias y PayPal. Se requiere un depósito del 30% para confirmar la reserva.
                        </div>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        ¿Cuál es la política de cancelación?
                    </div>
                    <div class="faq-answer">
                        <div class="faq-answer-content">
                            Cancelaciones con más de 30 días: reembolso del 100%. Entre 15-30 días: 50%. Menos de 15 días: no reembolsable. Recomendamos adquirir seguro de viaje.
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
                <p>Tu mejor aliado para descubrir las maravillas de Costa Rica</p>
            </div>
            <div class="footer-section">
                <h3>Enlaces Rápidos</h3>
                <ul>
                    <li><a href="/tours">Tours</a></li>
                    <li><a href="/#destinos">Destinos</a></li>
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
