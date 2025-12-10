import ReactDOM from 'react-dom/client';

const App = () => {
    return (
        <div style={{padding: '20px', fontFamily: 'Arial'}}>
            <h1>¡Hola desde React! 🚀</h1>
            <p>Si ves esto, React funciona correctamente.</p>
        </div>
    );
};

const rootElement = document.getElementById('react-app');
if (rootElement) {
    const root = ReactDOM.createRoot(rootElement);
    root.render(<App />);
}
