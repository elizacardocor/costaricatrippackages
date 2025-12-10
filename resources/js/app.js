import React from 'react';
import ReactDOM from 'react-dom/client';
import App from './components/App';

// Montar la aplicación React en el elemento con id 'react-app'
const rootElement = document.getElementById('react-app');
if (rootElement) {
    const root = ReactDOM.createRoot(rootElement);
    root.render(<App />);
}