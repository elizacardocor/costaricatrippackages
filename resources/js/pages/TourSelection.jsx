import { useState, useEffect } from 'react';
import { useNavigate, useParams } from 'react-router-dom';
import { useLanguage } from '../context/LanguageContext';
import api from '../services/api';
import { MapPin, Clock, DollarSign, Users, Mountain, Waves, Trees, Bird } from 'lucide-react';

export default function TourSelection() {
  const [tours, setTours] = useState([]);
  const [loading, setLoading] = useState(true);
  const navigate = useNavigate();
  const { lang } = useParams();
  const { t, language, switchLanguage } = useLanguage();

  useEffect(() => {
    fetchTours();
  }, []);

  const fetchTours = async () => {
    try {
      const response = await api.get('/tours');
      setTours(Array.isArray(response.data.data) ? response.data.data : []);
    } catch (error) {
      console.error('Error fetching tours:', error);
      setTours([]);
    } finally {
      setLoading(false);
    }
  };

  const handleTourSelect = (tourId) => {
    navigate(`/${lang}/booking/${tourId}`);
  };

  const handleLanguageSwitch = () => {
    const newLang = language === 'es' ? 'en' : 'es';
    switchLanguage(newLang);
    navigate(`/${newLang}`);
  };

  return (
    <div className="min-h-screen bg-gray-50">
      {/* Language Switcher */}
      <div className="absolute top-4 right-4 z-20">
        <button
          onClick={handleLanguageSwitch}
          className="bg-white px-4 py-2 rounded-lg shadow-md hover:shadow-lg transition-shadow font-semibold text-gray-700 hover:text-red-600"
        >
          {language === 'es' ? '🇬🇧 English' : '🇪🇸 Español'}
        </button>
      </div>

      {/* Hero Section - Red Gradient with Costa Rica Imagery */}
      <div className="relative bg-gradient-to-br from-red-600 via-orange-600 to-red-700 text-white overflow-hidden">
        {/* Background Image Overlay */}
        <div 
          className="absolute inset-0 opacity-20 bg-cover bg-center"
          style={{
            backgroundImage: "url('https://images.unsplash.com/photo-1552083974-186346191183?w=1600&h=900&fit=crop')"
          }}
        />
        
        {/* Content */}
        <div className="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 md:py-32">
          <div className="text-center">
            <h1 className="text-5xl md:text-7xl font-bold mb-6 drop-shadow-lg">
              {t('welcome')} 🇨🇷
            </h1>
            <p className="text-xl md:text-2xl mb-4 max-w-3xl mx-auto drop-shadow-md">
              {language === 'es' 
                ? '¡Pura Vida! Descubre Costa Rica'
                : 'Pura Vida! Discover Costa Rica'}
            </p>
            <p className="text-lg md:text-xl mb-12 max-w-2xl mx-auto opacity-90">
              {language === 'es'
                ? 'Vive la aventura en el paraíso tropical. Explora volcanes, playas vírgenes y bosques nubosos.'
                : 'Live the adventure in a tropical paradise. Explore volcanoes, pristine beaches, and cloud forests.'}
            </p>

            {/* Feature Icons */}
            <div className="grid grid-cols-2 md:grid-cols-4 gap-6 max-w-4xl mx-auto mt-12">
              <div className="flex flex-col items-center">
                <Mountain className="w-12 h-12 mb-2" />
                <span className="text-sm font-semibold">
                  {language === 'es' ? 'Volcanes' : 'Volcanoes'}
                </span>
              </div>
              <div className="flex flex-col items-center">
                <Waves className="w-12 h-12 mb-2" />
                <span className="text-sm font-semibold">
                  {language === 'es' ? 'Playas' : 'Beaches'}
                </span>
              </div>
              <div className="flex flex-col items-center">
                <Bird className="w-12 h-12 mb-2" />
                <span className="text-sm font-semibold">
                  {language === 'es' ? 'Vida Silvestre' : 'Wildlife'}
                </span>
              </div>
              <div className="flex flex-col items-center">
                <Trees className="w-12 h-12 mb-2" />
                <span className="text-sm font-semibold">
                  {language === 'es' ? 'Bosques Nubosos' : 'Cloud Forests'}
                </span>
              </div>
            </div>
          </div>
        </div>

        {/* Wave Decoration */}
        <div className="absolute bottom-0 w-full">
          <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 120L60 110C120 100 240 80 360 70C480 60 600 60 720 65C840 70 960 80 1080 85C1200 90 1320 90 1380 90L1440 90V120H1380C1320 120 1200 120 1080 120C960 120 840 120 720 120C600 120 480 120 360 120C240 120 120 120 60 120H0Z" fill="#F9FAFB"/>
          </svg>
        </div>
      </div>

      {/* Tours Section */}
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <h2 className="text-3xl md:text-4xl font-bold text-gray-900 mb-12 text-center">
          {t('available_tours')}
        </h2>

        {loading ? (
          <div className="flex justify-center items-center py-20">
            <div className="animate-spin rounded-full h-16 w-16 border-b-4 border-red-600"></div>
          </div>
        ) : tours.length === 0 ? (
          <div className="text-center py-20">
            <p className="text-xl text-gray-600">
              {language === 'es' ? 'No hay tours disponibles' : 'No tours available'}
            </p>
          </div>
        ) : (
          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            {tours.map((tour) => (
              <div
                key={tour.id}
                className="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition-shadow duration-300"
              >
                {tour.images && tour.images[0] ? (
                  <img
                    src={tour.images[0].image_url}
                    alt={tour.name[language] || tour.name}
                    className="w-full h-56 object-cover"
                  />
                ) : (
                  <div className="w-full h-56 bg-gradient-to-br from-red-400 to-orange-500 flex items-center justify-center">
                    <Mountain className="w-20 h-20 text-white opacity-50" />
                  </div>
                )}

                <div className="p-6">
                  <h3 className="text-2xl font-bold text-gray-900 mb-3">
                    {typeof tour.name === 'object' ? tour.name[language] : tour.name}
                  </h3>
                  
                  <p className="text-gray-600 mb-4 line-clamp-3">
                    {typeof tour.description === 'object' 
                      ? tour.description[language] 
                      : tour.description}
                  </p>

                  <div className="space-y-2 mb-6">
                    <div className="flex items-center text-gray-700">
                      <MapPin className="w-5 h-5 mr-2 text-red-600" />
                      <span>
                        {tour.destination && typeof tour.destination.name === 'object'
                          ? tour.destination.name[language]
                          : tour.destination?.name || 'Costa Rica'}
                      </span>
                    </div>
                    <div className="flex items-center text-gray-700">
                      <Clock className="w-5 h-5 mr-2 text-red-600" />
                      <span>{tour.duration} {language === 'es' ? 'horas' : 'hours'}</span>
                    </div>
                    <div className="flex items-center text-gray-700">
                      <Users className="w-5 h-5 mr-2 text-red-600" />
                      <span>
                        {language === 'es' 
                          ? `Mín. ${tour.min_participants} - Máx. ${tour.max_participants}`
                          : `Min. ${tour.min_participants} - Max. ${tour.max_participants}`}
                      </span>
                    </div>
                    {tour.prices && tour.prices[0] && (
                      <div className="flex items-center text-gray-700">
                        <DollarSign className="w-5 h-5 mr-2 text-red-600" />
                        <span className="font-semibold text-red-600">
                          {language === 'es' ? 'Desde' : 'From'} ${tour.prices[0].price}
                        </span>
                      </div>
                    )}
                  </div>

                  <button
                    onClick={() => handleTourSelect(tour.id)}
                    className="w-full bg-gradient-to-r from-red-600 to-orange-600 hover:from-red-700 hover:to-orange-700 text-white font-bold py-3 px-6 rounded-lg transition-all duration-200 transform hover:scale-105"
                  >
                    {t('book_now')}
                  </button>
                </div>
              </div>
            ))}
          </div>
        )}
      </div>
    </div>
  );
}
