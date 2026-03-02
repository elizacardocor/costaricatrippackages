import { createContext, useContext, useState, useEffect } from 'react';

const LanguageContext = createContext();

export const useLanguage = () => {
  const context = useContext(LanguageContext);
  if (!context) {
    throw new Error('useLanguage must be used within a LanguageProvider');
  }
  return context;
};

export const LanguageProvider = ({ children }) => {
  const [language, setLanguage] = useState('es');

  useEffect(() => {
    const savedLanguage = localStorage.getItem('language') || 'es';
    setLanguage(savedLanguage);
  }, []);

  const switchLanguage = (lang) => {
    setLanguage(lang);
    localStorage.setItem('language', lang);
  };

  const translations = {
    es: {
      welcome: '¡Bienvenido a Costa Rica!',
      available_tours: 'Tours Disponibles',
      book_now: 'Reservar Ahora',
      select_booking_method: 'Selecciona tu método de reserva',
      consult_whatsapp: 'Consultar por WhatsApp',
      consult_whatsapp_desc: 'Chatea con nosotros para personalizar tu experiencia',
      pay_now: 'Reservar y Pagar Ahora',
      pay_now_desc: 'Paga de inmediato y asegura tu lugar',
      reserve_pay_later: 'Reservar y Pagar Después',
      reserve_pay_later_desc: 'Reserva ahora y recibe un enlace de pago por email',
      login: 'Iniciar Sesión',
      email: 'Correo Electrónico',
      password: 'Contraseña',
      dashboard: 'Panel de Control',
      logout: 'Cerrar Sesión',
    },
    en: {
      welcome: 'Welcome to Costa Rica!',
      available_tours: 'Available Tours',
      book_now: 'Book Now',
      select_booking_method: 'Select your booking method',
      consult_whatsapp: 'Consult via WhatsApp',
      consult_whatsapp_desc: 'Chat with us to customize your experience',
      pay_now: 'Book and Pay Now',
      pay_now_desc: 'Pay immediately and secure your spot',
      reserve_pay_later: 'Reserve and Pay Later',
      reserve_pay_later_desc: 'Reserve now and receive a payment link via email',
      login: 'Login',
      email: 'Email',
      password: 'Password',
      dashboard: 'Dashboard',
      logout: 'Logout',
    },
  };

  const t = (key) => {
    return translations[language][key] || key;
  };

  return (
    <LanguageContext.Provider value={{ language, switchLanguage, t }}>
      {children}
    </LanguageContext.Provider>
  );
};
