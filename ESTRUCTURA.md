# Estructura del Proyecto Laravel + React + Vite
## Costa Rica Trip Packages

## 📁 Estructura de Directorios

```
costaricatrippackages/
├── app/                          # Código de aplicación PHP
│   ├── Http/
│   │   ├── Controllers/         # Controladores (vacío - usando closures)
│   │   └── Middleware/          # Middleware HTTP
│   ├── Models/                  # Modelos Eloquent (User.php)
│   └── Providers/               # Service Providers
│
├── resources/                    # Recursos del frontend
│   ├── css/
│   │   └── app.css             # CSS global (Tailwind)
│   │
│   ├── js/
│   │   ├── app.jsx             # Entry point React (monta Dashboard MUI)
│   │   ├── dashboard-mui.jsx   # Entry point Dashboard Material-UI
│   │   └── components/
│   │       └── DashboardMUI.jsx # Dashboard único (217 KB gzip)
│   │
│   └── views/                   # Plantillas Blade
│       ├── home.blade.php      # Landing optimizado (28 KB)
│       ├── dashboard-mui.blade.php # Dashboard administrativo
│       └── tours/
│           ├── index.blade.php  # Listado de tours (20 KB)
│           └── show.blade.php   # Detalle de tour (24 KB)
│
├── routes/
│   └── web.php                 # Rutas de la aplicación
│
├── public/                      # Archivos estáticos servidos
│   ├── index.php               # Entry point de la aplicación
│   ├── build/                  # Assets compilados por Vite
│   │   └── assets/
│   │       ├── DashboardMUI-*.js  (217 KB gzip)
│   │       └── [otros chunks]
│   └── robots.txt
│
├── database/                    # Base de datos
│   ├── migrations/             # Migraciones de BD
│   └── seeders/                # Seeders de datos
│
├── vite.config.js              # Configuración de Vite
├── package.json                # Dependencias de npm
├── composer.json               # Dependencias de PHP
├── .env                        # Variables de entorno
├── PERFORMANCE_REPORT.md       # Reporte de optimización
└── ESTRUCTURA.md               # Este archivo

```

## 🔄 Flujo de Desarrollo vs Producción

### Desarrollo Local
```bash
# Terminal 1 - Servidor Laravel
php artisan serve

# Terminal 2 - Vite en modo watch (desarrollo) - OPCIONAL
npm run dev
```

Accede a:
- Landing: `http://localhost:8000/`
- Tours: `http://localhost:8000/tours`
- Dashboard: `http://localhost:8000/dashboard`

### Producción (Hostinger Premium)
```bash
# Local: Generar build estático
npm run build

# Subir a Hostinger vía Git:
git add .
git commit -m "Update"
git push origin main

# En servidor (SSH):
cd ~/domains/costaricatrippackages.com/public_html
git pull origin main
composer install --optimize-autoloader --no-dev
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## 📦 Archivos Importantes

### `vite.config.js`
Configura:
- Laravel Vite Plugin (para Blade)
- React Plugin (@vitejs/plugin-react)
- Entradas: 
  - `resources/css/app.css`
  - `resources/js/app.jsx`
  - `resources/js/dashboard-mui.jsx`
- Salida: `public/build/`

### `package.json`
Scripts:
- `npm run dev` - Inicia Vite en modo desarrollo
- `npm run build` - Crea build estático para producción

Dependencias principales:
- React 19.0.0
- @mui/material 6.1.10
- @mui/icons-material 6.1.10
- recharts 2.15.0
- Vite 5.4.21

### `resources/js/app.jsx`
- Entry point de React
- Monta Dashboard MUI en `#dashboard-mui`
- Solo se ejecuta si existe el elemento en el DOM

### `resources/views/dashboard-mui.blade.php`
- Carga los archivos CSS y JS vía `@vite()`
- Contiene el div `#dashboard-mui` donde React se monta

## 🎯 Rutas Activas

```php
// Landing y Tours (Páginas públicas)
Route::get('/', ...)              // Landing page optimizado
Route::get('/tours', ...)         // Listado de todos los tours
Route::get('/tour/{id}', ...)     // Detalle individual de tour
Route::get('/destino/{slug}', ...) // Redirect a /tours

// Dashboard (Área administrativa)
Route::get('/dashboard', ...)     // Dashboard Material-UI
Route::get('/react-app', ...)    // App React
```

## ⚙️ Comandos Útiles

### Desarrollo
```bash
# Iniciar servidor Laravel
php artisan serve

# Iniciar Vite en watch mode (OPCIONAL - solo para desarrollo)
npm run dev

# Limpiar cachés de Laravel
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear
```

### Build para Producción
```bash
# Generar build estático optimizado
npm run build

# El build se genera en public/build/
# Contiene: manifest.json, assets/*.js, assets/*.css

# Verificar tamaños de build
du -h public/build/assets/

# Resultado esperado:
# DashboardMUI-*.js: ~217 KB (gzip)
# Total build: < 1 MB
```

### Mantenimiento
```bash
# Actualizar dependencias de npm
npm update

# Verificar vulnerabilidades
npm audit

# Limpiar caché de Vite
rm -rf node_modules/.vite

# Reinstalar dependencias limpias
rm -rf node_modules package-lock.json
npm install
```

## 🚀 Deploy a Hostinger

### Método 1: Git (Recomendado)
```bash
# 1. Local: Generar build
npm run build

# 2. Commit y push
git add .
git commit -m "Build actualizado"
git push origin main

# 3. SSH al servidor Hostinger
ssh u336394587@costaricatrippackages.com

# 4. En servidor
cd ~/domains/costaricatrippackages.com/public_html
git pull origin main
composer install --optimize-autoloader --no-dev
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Método 2: FTP/SFTP
```bash
# 1. Generar build local
npm run build

# 2. Subir vía FTP:
# - public/build/ (carpeta completa)
# - resources/views/ (archivos Blade actualizados)
# - routes/web.php (si cambió)
# - app/ (si cambió)

# NO subir:
# - node_modules/
# - .git/
# - storage/logs/
# - .env (ya está en servidor)
```

## 📊 Performance Metrics

### Landing Page Optimizado
- **Tamaño total**: ~72 KB (HTML + CSS inline)
- **Imágenes**: CDN Unsplash (lazy loading)
- **Load time**: < 2 segundos en 3G
- **Lighthouse score**: ~95/100 (estimado)

### Dashboard Material-UI
- **JavaScript**: 217 KB (gzip)
- **Framework**: Material-UI v6
- **Features**: Responsive, mobile menu, charts

### Comparación con Template Anterior
| Métrica | Template Elos | Landing Nuevo | Mejora |
|---------|--------------|---------------|--------|
| Tamaño total | 29.3 MB | < 500 KB | 99.75% ↓ |
| CSS | 788 KB | 15 KB | 98.1% ↓ |
| JavaScript | 1.5 MB | 5 KB | 99.7% ↓ |
| Imágenes | 27 MB | CDN | 99.9% ↓ |

## 🎨 Características del Proyecto

### Landing Page (`/`)
- ✅ Hero slider con 3 slides (auto-advance cada 5s)
- ✅ 6 destinos de Costa Rica con hover effects
- ✅ 5 tours destacados en preview
- ✅ Navegación responsive con menú móvil
- ✅ Sticky navbar con efecto scroll
- ✅ Footer profesional con enlaces
- ✅ SEO optimizado (meta tags, semantic HTML)

### Tours Listing (`/tours`)
- ✅ 10 tours con información detallada
- ✅ Sistema de filtros (destino, duración, precio)
- ✅ Grid responsive
- ✅ Categorías y badges
- ✅ Paginación (placeholder)

### Tour Details (`/tour/{id}`)
- ✅ Hero image con overlay
- ✅ Descripción completa del tour
- ✅ Sección de highlights con iconos
- ✅ Itinerario detallado (6 pasos)
- ✅ Lista de lo que incluye
- ✅ Galería de fotos (4 imágenes)
- ✅ Sidebar de reserva (sticky)
- ✅ Placeholder para reviews (Fase 2)

### Dashboard (`/dashboard`)
- ✅ Material-UI Design System
- ✅ Estadísticas con cards
- ✅ Gráficos con Recharts
- ✅ Tabla de datos responsiva
- ✅ Menú lateral colapsable
- ✅ Mobile responsive con hamburger menu

## 📋 Próximas Fases

### Fase 2: Base de Datos y Backend
- [ ] Crear migraciones para tours y destinos
- [ ] Seeders con datos reales de Costa Rica
- [ ] Controladores para CRUD de tours
- [ ] Sistema de autenticación (Laravel Breeze)
- [ ] API REST para el dashboard

### Fase 3: Ratings y Reviews
- [ ] Tabla de reviews en base de datos
- [ ] Sistema de calificación (1-5 estrellas)
- [ ] Formulario de comentarios
- [ ] Moderación de reviews
- [ ] Cálculo de rating promedio

### Fase 4: Reservas y Pagos
- [ ] Sistema de reservas
- [ ] Calendario de disponibilidad
- [ ] Integración de pagos (PayPal, Stripe)
- [ ] Confirmación por email
- [ ] Panel de administración de reservas

### Fase 5: Optimizaciones Avanzadas
- [ ] Subir imágenes reales optimizadas (WebP)
- [ ] Implementar CDN para assets
- [ ] Service Workers para PWA
- [ ] Server-side rendering (Inertia.js)
- [ ] Caché de queries con Redis

## 🔒 Seguridad

```bash
# Variables de entorno sensibles (.env)
APP_KEY=              # Generada con php artisan key:generate
DB_PASSWORD=          # Contraseña de base de datos
MAIL_PASSWORD=        # Contraseña de correo

# NUNCA subir a Git:
# - .env
# - Credenciales de pago
# - API keys
```

## 📞 Soporte

- **Documentación Laravel**: https://laravel.com/docs
- **Documentación React**: https://react.dev
- **Material-UI**: https://mui.com
- **Vite**: https://vitejs.dev

---

**Última actualización**: 12 de diciembre de 2025

4. **Configurar archivos:**
   - Actualizar `.env` con credenciales de producción
   - Permisos: `chmod 755 storage/` y `chmod 755 bootstrap/cache/`

## 📝 Notas Importantes

- **No subir `node_modules/`** a producción
- **Build estático** (`public/build/`) sí se sube
- **React solo se usa donde sea necesario** (en `react.blade.php`)
- **Landing page usa Blade puro** (sin JavaScript)
- **SEO**: Landing en Blade es mejor para SEO que React

## 🔧 Ejemplo: Agregar Nuevo Componente React

```bash
# 1. Crear componente
touch resources/js/components/PackageCard.jsx

# 2. Importar en App.jsx
import PackageCard from './PackageCard';

# 3. Usar en JSX
<PackageCard title="Playas" price="$1299" />

# 4. El npm run dev se actualiza automáticamente
```

## 📚 Referencias

- Laravel: https://laravel.com/docs
- Vite: https://vitejs.dev/
- React: https://react.dev/
- Laravel Vite Plugin: https://laravel.com/docs/vite
