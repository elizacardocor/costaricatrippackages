import { useState } from 'react';
import './App.css';

export default function App() {
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
                        <button 
                            className="btn btn-primary"
                            onClick={() => setCount(count + 1)}
                        >
                            Incrementar
                        </button>
                        <button 
                            className="btn btn-secondary"
                            onClick={() => setCount(count - 1)}
                        >
                            Decrementar
                        </button>
                        <button 
                            className="btn btn-danger"
                            onClick={() => setCount(0)}
                        >
                            Reiniciar
                        </button>
                    </div>
                </div>

                <div className="info-box">
                    <h3>Estructura del Proyecto</h3>
                    <ul>
                        <li>✅ Laravel Framework completo</li>
                        <li>✅ Vite como bundler moderno</li>
                        <li>✅ React integrado</li>
                        <li>✅ Landing Page SEO en Blade</li>
                        <li>✅ Build estático para producción</li>
                    </ul>
                </div>

                <div className="tech-stack">
                    <h3>Stack Tecnológico</h3>
                    <div className="tech-grid">
                        <div className="tech-item">
                            <span className="tech-icon">🐘</span>
                            <span>PHP 8.1</span>
                        </div>
                        <div className="tech-item">
                            <span className="tech-icon">🌱</span>
                            <span>Laravel</span>
                        </div>
                        <div className="tech-item">
                            <span className="tech-icon">⚛️</span>
                            <span>React 19</span>
                        </div>
                        <div className="tech-item">
                            <span className="tech-icon">⚡</span>
                            <span>Vite</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}
