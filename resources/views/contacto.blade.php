@extends('layouts.master')

@section('title', __('contact.title') . ' - Costa Rica Trip Packages')
@section('meta_description', __('contact.meta_description'))

@section('extra_styles')
<style>
    :root {
        --primary-color: #00A86B;
        --secondary-color: #0066CC;
        --accent-color: #FF6B35;
        --dark: #1a1a1a;
        --light: #f8f9fa;
        --gray: #6c757d;
    }

    /* Page Header */
    .page-header {
        background: linear-gradient(135deg, #8B0000 0%, #6b0000 100%);
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
    

    .contact-grid {
        display: flex;
        flex-direction: column;
        gap: 3rem;
        margin-top: 3rem;
    }

    /* Contact Info */
    .contact-info {
        display: grid;
        grid-template-columns: 1fr 1.5fr 1fr;
        gap: 1.5rem;
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
        color: white;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        flex-shrink: 0;
    }

    .info-icon.email {
        background: #666;
        box-shadow: 0 4px 15px rgba(102, 102, 102, 0.3);
    }

    .info-icon.phone {
        background: #8B0000;
        box-shadow: 0 4px 15px rgba(139, 0, 0, 0.3);
    }

    .info-icon.whatsapp {
        background: #25D366;
        box-shadow: 0 4px 15px rgba(37, 211, 102, 0.3);
    }

    .info-icon.messenger {
        background: linear-gradient(135deg, #0078FF 0%, #0063D1 100%);
        box-shadow: 0 4px 15px rgba(0, 120, 255, 0.3);
    }

    .info-icon.location {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
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

    .social-links {
        display: flex;
        gap: 1rem;
        margin-top: 1rem;
    }

    .social-link {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        font-size: 1.2rem;
        transition: all 0.3s;
        color: white;
    }

    .social-link.facebook {
        background: #1877F2;
    }

    .social-link.instagram {
        background: linear-gradient(135deg, #833AB4 0%, #FD1D1D 50%, #FCAF45 100%);
    }

    .social-link.youtube {
        background: #FF0000;
    }

    .social-link.twitter {
        background: #1DA1F2;
    }

    .social-link:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
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
        background: linear-gradient(135deg, #8B0000 0%, #6b0000 100%);
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
        background: linear-gradient(135deg, #a00000 0%, #800000 100%);
        transform: translateY(-3px);
        box-shadow: 0 6px 20px rgba(139, 0, 0, 0.4);
    }

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
</style>
@endsection

@section('content')
<div class="content-box">
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
                    <div class="info-icon email">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="info-content">
                        <h3>{{ __('contact.contact_email') }}</h3>
                        <p>{{ __('contact.contact_email_text') }}</p>
                        <a href="mailto:info@costaricatrips.com">{{ __('contact.contact_email_info') }}</a><br>
                        <a href="mailto:reservas@costaricatrips.com">{{ __('contact.contact_email_reservations') }}</a>
                    </div>
                </div>

                <div class="info-card">
                    <div class="info-icon phone">
                        <i class="fas fa-phone"></i>
                    </div>
                    <div class="info-content">
                        <h3>{{ __('contact.contact_phone') }}</h3>
                        <p>{{ __('contact.contact_phone_hours') }}</p>
                        <a href="tel:+50624790020">+506 2479-0020</a>
                    </div>
                </div>

                <div class="info-card">
                    <div class="info-icon whatsapp">
                        <i class="fab fa-whatsapp"></i>
                    </div>
                    <div class="info-content">
                        <h3>WhatsApp</h3>
                        <p>{{ app()->getLocale() === 'es' ? 'Chatea con nosotros' : 'Chat with us' }}</p>
                        <a href="https://wa.me/50624790020" target="_blank">+506 2479-0020</a>
                    </div>
                </div>

                <div class="info-card">
                    <div class="info-icon messenger">
                        <i class="fab fa-facebook-messenger"></i>
                    </div>
                    <div class="info-content">
                        <h3>Messenger</h3>
                        <p>{{ app()->getLocale() === 'es' ? 'Escríbenos por Facebook' : 'Message us on Facebook' }}</p>
                        <a href="https://m.me/costaricatrips" target="_blank">{{ app()->getLocale() === 'es' ? 'Enviar mensaje' : 'Send message' }}</a>
                    </div>
                </div>

                <div class="info-card">
                    <div class="info-icon location">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div class="info-content">
                        <h3>{{ __('contact.contact_office') }}</h3>
                        <p>{{ __('contact.contact_office_address') }}</p>
                    </div>
                </div>

                <div class="info-card">
                    <div class="info-icon location">
                        <i class="fas fa-share-alt"></i>
                    </div>
                    <div class="info-content">
                        <h3>{{ __('contact.contact_social') }}</h3>
                        <p>{{ __('contact.contact_social_text') }}</p>
                        <div class="social-links">
                            <a href="https://facebook.com/costaricatrips" target="_blank" class="social-link facebook" title="Facebook">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="https://instagram.com/costaricatrips" target="_blank" class="social-link instagram" title="Instagram">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="https://youtube.com/@costaricatrips" target="_blank" class="social-link youtube" title="YouTube">
                                <i class="fab fa-youtube"></i>
                            </a>
                            <a href="https://twitter.com/costaricatrips" target="_blank" class="social-link twitter" title="Twitter">
                                <i class="fab fa-twitter"></i>
                            </a>
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

<!-- Page Header -->
<div class="page-header">
    <h1>{{ __('contact.header_title') }}</h1>
    <p>{{ __('contact.header_subtitle') }}</p>
</div>

</div><!-- End Content Box -->
@endsection

@section('extra_scripts')
<script>
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
@endsection
