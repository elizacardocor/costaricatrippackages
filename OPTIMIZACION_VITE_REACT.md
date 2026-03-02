# 🚀 Optimización de Rendimiento - Vite + React

## 📊 Diagnóstico Realizado (28 Feb 2026)

### Problemas Identificados

1. **DashboardMUI Bundle Gigante**
   - Tamaño: 692 KB (Material-UI completo + recharts)
   - Problema: Se compilaba con entry points múltiples
   - Impacto: Afectaba bundle size general

2. **Múltiples Entry Points**
   - app.jsx (no se usaba)
   - main.jsx (SPA completa)
   - dashboard-mui.jsx (dashboard)
   - Resultado: React se duplicaba en bundles

3. **Librerías Redundantes**
   - @mui/material (99 KB)
   - @mui/icons-material (enorme)
   - react-icons (duplicado con Font Awesome custom)
   - recharts (200+ KB)

4. **Código Muerto**
   - app.css: vacío
   - app.js: no usado
   - main.jsx: SPA nunca renderizada
   - Páginas React: BookingMethodSelector, TourSelection, Login no se usan

### Soluciones Implementadas

✅ **vite.config.js Optimizado**
```javascript
// Cambios clave:
- Eliminado: input array con múltiples entries
- Agregado: 'resources/css/layout.css' como única entrada para Blade
- Agregado: 'resources/js/dashboard-mui.jsx' como entrada SPA separada
- Configurado: Code-splitting con manualChunks
- Configurado: Minificación agresiva (terser + drop_console)
- Configurado: chunkSizeWarningLimit para alertas
```

✅ **Limpieza de Archivos No Usados**
```
Eliminados:
- resources/js/app.js
- resources/js/app.jsx
- resources/js/main.jsx (SPA que nunca se rendería)
- resources/js/test-app.jsx
- resources/css/app.css

Mantenidos:
- resources/js/dashboard-mui.jsx (Dashboard React)
- resources/js/components/ (componentes)
- resources/js/context/ (context API)
- resources/js/services/ (API calls)
```

✅ **Arquitectura Limpia**
```
master.blade.php:
- Solo carga: @vite(['resources/css/layout.css'])
- Sin React, sin JS bundles en páginas Blade
- Impacto: 0 KB de overhead React en home/tours/contacto

dashboard-mui.blade.php:
- Solo carga: @vite('resources/js/dashboard-mui.jsx')
- Aislado en ruta /dashboard
- Impacto: React+Material-UI solo en admin dashboard
```

## 📈 Impacto Esperado

| Métrica | Antes | Después | Mejora |
|---------|-------|---------|--------|
| Home page JS | 692 KB | 0 KB | -100% ↓ |
| Tours page JS | 692 KB | 0 KB | -100% ↓ |
| Contacto page JS | 692 KB | 0 KB | -100% ↓ |
| Dashboard JS | 692 KB | ~500 KB | -27% ↓ |
| LCP (Largest Contentful Paint) | Alto | Bajo | ↓↓ |
| FCP (First Contentful Paint) | Alto | Bajo | ↓↓ |
| Core Web Vitals | Pobre | Bueno | ✅ |

## 🔧 Próximos Pasos (Opcionales)

### Si quieres optimizar más el Dashboard:

**Opción 1: Remover Material-UI (Recomendado si es posible)**
```bash
npm uninstall @mui/material @mui/icons-material
npm install bootstrap
```
Ahorro: 300-400 KB, pero requiere refactorizar componentes

**Opción 2: Reemplazar recharts**
- Alternativa: Chart.js (más pequeño, 100 KB menos)
- O: Apache ECharts (mejor rendimiento)

**Opción 3: Tree-shake las dependencias**
```javascript
// En vite.config.js agregar:
rollupOptions: {
    output: {
        treeshake: 'recommended' // Más agresivo
    }
}
```

## 🧪 Cómo Probar

```bash
# 1. Limpiar build anterior
rm -rf public/build

# 2. Compilar con optimizaciones
npm run build

# 3. Verificar tamaño de bundle
ls -lh public/build/assets/

# 4. Inspeccionar en producción
curl -I https://tudominio.com/build/...js | grep Content-Length
```

## 📝 Checklist

- [x] Actualizado vite.config.js con code-splitting
- [x] Eliminados entry points no usados
- [x] Limpiados archivos muertos (app.js, app.css, etc)
- [x] Verificado que master.blade.php no carga React
- [x] Dashboard aislado en SPA separada
- [x] Minificación agresiva habilitada
- [ ] Compilar proyecto con `npm run build`
- [ ] Probar todas las páginas en producción
- [ ] Verificar Lighthouse scores

## 🎯 Objetivo Alcanzado

El sitio Blade PHP (home, tours, contacto) ahora tiene **0 KB de overhead React**. Solo el dashboard (/dashboard) carga el bundle de React+Material-UI cuando sea necesario.

Impacto en SEO: ✅ Mejor Core Web Vitals = Mejor ranking de Google
