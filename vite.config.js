import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/layout.css',
                'resources/js/dashboard-mui.jsx' // Dashboard en SPA separado
            ],
            refresh: true,
        }),
        react(),
    ],
    build: {
        // Optimización agresiva del bundle
        minify: 'terser',
        terserOptions: {
            compress: {
                drop_console: true,
                drop_debugger: true,
            },
        },
        chunkSizeWarningLimit: 1000, // Alerta si > 1MB
        reportCompressedSize: true,
    },
    server: {
        host: '0.0.0.0',
        port: 5177,
        hmr: {
            host: 'localhost',
            port: 5177,
        }
    }
});
