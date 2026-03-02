import { useNavigate, useParams } from 'react-router-dom';
import { useLanguage } from '../context/LanguageContext';
import { MessageCircle, CreditCard, Mail } from 'lucide-react';

export default function BookingMethodSelector() {
  const navigate = useNavigate();
  const { lang, tourId } = useParams();
  const { t } = useLanguage();

  const bookingMethods = [
    {
      id: 'whatsapp',
      icon: MessageCircle,
      title: t('consult_whatsapp'),
      description: t('consult_whatsapp_desc'),
      color: 'from-green-500 to-green-600',
      hoverColor: 'hover:from-green-600 hover:to-green-700',
    },
    {
      id: 'pay_now',
      icon: CreditCard,
      title: t('pay_now'),
      description: t('pay_now_desc'),
      color: 'from-blue-500 to-blue-600',
      hoverColor: 'hover:from-blue-600 hover:to-blue-700',
    },
    {
      id: 'reserve_later',
      icon: Mail,
      title: t('reserve_pay_later'),
      description: t('reserve_pay_later_desc'),
      color: 'from-purple-500 to-purple-600',
      hoverColor: 'hover:from-purple-600 hover:to-purple-700',
    },
  ];

  const handleMethodSelect = (methodId) => {
    // Aquí se implementaría la lógica para cada método
    console.log('Selected method:', methodId);
    // navigate(`/${lang}/booking/${tourId}/${methodId}`);
  };

  return (
    <div className="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
      <div className="max-w-6xl mx-auto">
        <div className="text-center mb-12">
          <h1 className="text-4xl font-bold text-gray-900 mb-4">
            {t('select_booking_method')}
          </h1>
          <button
            onClick={() => navigate(`/${lang}`)}
            className="text-red-600 hover:text-red-800 font-semibold"
          >
            ← Volver a tours
          </button>
        </div>

        <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
          {bookingMethods.map((method) => {
            const Icon = method.icon;
            return (
              <div
                key={method.id}
                onClick={() => handleMethodSelect(method.id)}
                className="bg-white rounded-2xl shadow-lg overflow-hidden cursor-pointer transform transition-all duration-300 hover:scale-105 hover:shadow-2xl"
              >
                <div className={`bg-gradient-to-br ${method.color} p-8 text-white`}>
                  <Icon className="w-16 h-16 mx-auto mb-4" />
                  <h3 className="text-2xl font-bold text-center">{method.title}</h3>
                </div>
                <div className="p-6">
                  <p className="text-gray-600 text-center">{method.description}</p>
                  <button
                    className={`mt-6 w-full bg-gradient-to-r ${method.color} ${method.hoverColor} text-white font-bold py-3 px-6 rounded-lg transition-all duration-200`}
                  >
                    Seleccionar
                  </button>
                </div>
              </div>
            );
          })}
        </div>
      </div>
    </div>
  );
}
