# 🌴 Costa Rica Trip Packages - Proyecto Laravel + React + Vite

## ✅ Proyecto Completado

¡Tu proyecto Laravel con React y Vite está completamente configurado y listo para producción!

## 🚀 Iniciar en Desarrollo

### Terminal 1 - Servidor Laravel
```bash
php artisan serve
```
Accede a: `http://localhost:8000`

### Terminal 2 - Vite (desarrollo con HMR)
```bash
npm run dev
```

### Páginas disponibles:
- **Landing Page (Blade/SEO):** `http://localhost:8000/`
- **React App (Hello World):** `http://localhost:8000/react-app`

## 📦 Preparar para Producción

### 1. Generar Build Estático
```bash
npm run build
```

Esto crea archivos estáticos en `public/build/` listos para Hostinger Premium.

### 2. Verificar Build
```bash
ls public/build/
# Deberías ver: assets/ y manifest.json
```

### 3. Subir a Hostinger
Los archivos a subir:
- ✅ `public/` (incluye build/)
- ✅ `app/`
- ✅ `routes/`
- ✅ `resources/views/`
- ✅ `config/`
- ✅ `bootstrap/`
- ✅ `composer.json`, `composer.lock`
- ✅ `.env` (con credenciales de producción)
- ✅ `artisan`
- ❌ `node_modules/` (NO subir)
- ❌ `.git/` (opcional)

### 4. En Servidor Hostinger
```bash
# SSH al servidor
composer install --no-dev

# Generar clave (si es necesario)
php artisan key:generate

# Permisos
chmod 755 storage/
chmod 755 bootstrap/cache/
```

## 📁 Estructura del Proyecto

```
costaricatrippackages/
├── resources/
│   ├── views/
│   │   ├── landing.blade.php      ← Landing SEO
│   │   └── react.blade.php        ← App React
│   ├── js/
│   │   ├── app.jsx                ← Entry Point React
│   │   └── components/
│   │       ├── App.jsx            ← Componente Principal
│   │       └── App.css            ← Estilos
│   └── css/
│       └── app.css                ← CSS Global
├── public/
│   └── build/                     ← Build generado (después de npm run build)
├── routes/
│   └── web.php                    ← Rutas
├── vite.config.js                 ← Configuración Vite
├── package.json                   ← Dependencias npm
└── ESTRUCTURA.md                  ← Documentación detallada
```

## 🎯 Lo que está listo

✅ **Laravel** - Framework completo con rutas y vistas  
✅ **Blade** - Landing page SEO optimizada  
✅ **React 19** - Última versión  
✅ **Vite 5** - Bundler moderno y rápido  
✅ **CSS/JavaScript** - Integración completa  
✅ **Hello World** - Componente React interactivo  
✅ **Build estático** - Listo para producción  

## 🔧 Próximos Pasos

### 1. Agregar más componentes React
```bash
# Crear nuevo componente
touch resources/js/components/MiComponente.jsx
```

### 2. Conectar con API
```javascript
// En tus componentes React
fetch('/api/paquetes')
  .then(res => res.json())
  .then(data => console.log(data))
```

### 3. Customizar estilos
- Edita `resources/css/app.css` para estilos globales
- Edita `resources/js/components/App.css` para estilos del componente

### 4. Agregar más páginas Blade
```bash
# Crear nueva vista
touch resources/views/about.blade.php

# Agregar ruta en routes/web.php
Route::get('/about', function () {
    return view('about');
});
```

## 📊 Comparación Local vs Producción

### Desarrollo Local (npm run dev)
- Hot Module Replacement (HMR) activado
- Source maps para debugging
- Cambios en vivo sin refrescar
- Más lento pero más cómodo para desarrollar

### Producción (npm run build)
- Archivos minificados
- Sin source maps (más pequeño)
- Optimizado para velocidad
- 36.35 KB → 14.71 KB (gzip)

## 🌐 URLs de la Aplicación

```
Landing Page:    /              (Blade puro - SEO optimizado)
React App:       /react-app     (Componente React con interacción)
```

## 💡 Tips Importantes

1. **No ejecutes `npm run build` en Hostinger** - Hazlo localmente antes de subir
2. **El directorio `public/build/` se genera automáticamente** - No lo edites manualmente
3. **`node_modules/` ocupa mucho espacio** - Por eso no se sube a producción
4. **Usa `php artisan optimize`** en producción para mejor rendimiento

## 🆘 Troubleshooting

### Vite no encuentra los módulos
```bash
rm -rf node_modules package-lock.json
npm install
```

### Build falla
```bash
# Limpiar caché de Vite
rm -rf node_modules/.vite
npm run build
```

### Permisos en Hostinger
```bash
# SSH al servidor
chmod 755 storage/
chmod 755 bootstrap/cache/
chmod 644 public/build/*
```

## 📚 Documentación

- **ESTRUCTURA.md** - Detalles completos de la estructura
- Laravel Docs: https://laravel.com/docs
- Vite Docs: https://vitejs.dev/
- React Docs: https://react.dev/

## 📧 Soporte

Si necesitas ayuda, revisa:
1. Los archivos de configuración (vite.config.js)
2. Las rutas (routes/web.php)
3. Las vistas (resources/views/)
4. Los componentes (resources/js/components/)

---

**¡Proyecto listo para desarrollo y producción! 🎉**

Generado: Diciembre 2025
Versiones: PHP 8.1, Laravel 11, React 19, Vite 5
