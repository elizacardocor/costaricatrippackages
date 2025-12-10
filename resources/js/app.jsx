import { useState } from 'react';
import ReactDOM from 'react-dom/client';
import './components/App.css';

function App() {
    const [count, setCount] = useState(0);

    return (
        <div className="app-container">
            <div className="app-content">
                <h1>¡Hola desde React! 🚀</h1>
                <p>Integración exitosa de React + Vite en Laravel</p>
                
                <div className="app-card">
                    <h2>Contador Interactivo</h2>
                    <p className="counter">Contador: <strong>{count}</strong></p>
                    
                    <div className="button-group">
                        <button className="btn btn-primary" onClick={() => setCount(count + 1)}>
                            ➕ Incrementar
                        </button>
                        <button className="btn btn-secondary" onClick={() => setCount(count - 1)}>
                            ➖ Decrementar
                        </button>
                        <button className="btn btn-danger" onClick={() => setCount(0)}>
                            🔄 Reiniciar
                        </button>
                    </div>
                </div>

                <div className="app-card">
                    <h2>¿Por Qué Elegirnos?</h2>
                    <ul className="features">
                        <li>✈️ Vuelos a los mejores precios</li>
                        <li>🏨 Hoteles 4-5 estrellas</li>
                        <li>🏞️ Tours y aventuras exclusivas</li>
                        <li>💰 Precios todo incluido</li>
                        <li>📞 Atención al cliente 24/7</li>
                        <li>📱 Reserva fácil y rápida</li>
                    </ul>
                </div>

                <div className="app-card">
                    <h2>Stack Tecnológico</h2>
                    <div className="tech-stack">
                        <span className="tech-badge">Laravel 11</span>
                        <span className="tech-badge">React 19</span>
                        <span className="tech-badge">Vite 5</span>
                        <span className="tech-badge">PHP 8.1</span>
                        <span className="tech-badge">Node.js 20</span>
                    </div>
                    <p className="tech-info">
                        Este proyecto demuestra una integración perfecta entre Laravel como backend
                        y React como frontend moderno, utilizando Vite para un desarrollo rápido y eficiente.
                    </p>
                </div>
            </div>
        </div>
    );
}

const rootElement = document.getElementById('react-app');
if (rootElement) {
    const root = ReactDOM.createRoot(rootElement);
    root.render(<App />);
}
