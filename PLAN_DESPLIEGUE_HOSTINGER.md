# 📦 Plan de Despliegue a Hostinger

## Estado Actual (28 Feb 2026)

✅ **Optimizaciones Completadas (Localmente)**
- vite.config.js: Refactorizado para separar React
- Archivos muertos: Eliminados (5 archivos)
- Font Awesome: Optimizado local (252 KB)
- .htaccess: Compresión GZIP + cache headers

⏳ **En Compilación**
- npm run build: Creando bundles optimizados en WSL
- Destino: `/public/build/` (archivos estáticos)

---

## 🔄 Flujo de Despliegue

### PASO 1: Esperar Build Local (Ya en Progreso)
```bash
# En WSL (ya está corriendo):
npm run build

# Genera:
public/build/
├── manifest.json
├── assets/
│   ├── layout-xxxxx.css (5.45 KB)
│   ├── dashboard-mui-xxxxx.js (~500 KB)
│   └── ...chunks
```

### PASO 2: Preparar Archivos para Hostinger
Una vez el build termine, tendrás que subir:

```
CARPETA RAÍZ (public_html/)
├── app/
│   ├── Http/
│   ├── Models/
│   ├── Console/
│   └── ...
├── resources/
│   ├── views/
│   ├── css/
│   └── js/
├── routes/
├── public/
│   ├── build/              ← Archivos compilados (NUEVO)
│   │   ├── manifest.json
│   │   └── assets/
│   ├── fonts/              ← Font Awesome custom (NUEVO)
│   │   ├── fontawesome-custom.css
│   │   ├── fontawesome-solid.woff2
│   │   └── fontawesome-brands.woff2
│   ├── images/
│   ├── .htaccess           ← Compresión y cache (ACTUALIZADO)
│   └── index.php
├── storage/
├── bootstrap/
├── config/
├── .env
└── composer.json
```

### PASO 3: Método de Subida a Hostinger

#### Opción A: FTP (Más Simple)
```
1. Abre FileZilla o similar
2. Conecta a Hostinger FTP
3. Sube:
   - /public/build/       ← Nueva carpeta compilada
   - /public/fonts/       ← Nueva carpeta de fuentes
   - /public/.htaccess    ← Actualizado
   - Resto del código normalmente
```

#### Opción B: SSH (Más Rápido)
```bash
# Desde tu máquina local:
scp -r public/build/ usuario@hostinger.com:/home/tudominio/public_html/

scp -r public/fonts/ usuario@hostinger.com:/home/tudominio/public_html/

scp public/.htaccess usuario@hostinger.com:/home/tudominio/public_html/
```

---

## ✅ Verificación Post-Deploy

Una vez todo en Hostinger, verifica:

### 1. Páginas Públicas (Sin React)
```
✅ https://tudominio.com/
  • Solo carga: layout-xxxxx.css (5.45 KB)
  • NO carga: React, Material-UI, recharts
  • Velocidad: Muy rápida

✅ https://tudominio.com/es/tours
✅ https://tudominio.com/es/contacto
  • Mismo comportamiento que home
```

### 2. Dashboard (Con React)
```
✅ https://tudominio.com/dashboard
  • Carga: dashboard-mui-xxxxx.js (~500 KB)
  • Contiene: Material-UI + recharts
  • Solo en admin (no afecta público)
```

### 3. Verificar Compresión .htaccess
```bash
# Desde terminal:
curl -I https://tudominio.com/

# Debería ver:
Content-Encoding: gzip
Cache-Control: max-age=...
```

### 4. Google PageSpeed Insights
```
https://pagespeed.web.dev/

Ingresa tu URL y verifica:
✅ LCP < 2.5s (antes era 4.2s)
✅ FCP < 1.8s (antes era 2.5s)
✅ Core Web Vitals: GOOD
✅ Lighthouse Score: 92+/100
```

---

## 📊 Tamaño Esperado de Bundles

| Bundle | Tamaño | Uso |
|--------|--------|-----|
| layout-xxxxx.css | 5.45 KB | Todas las páginas Blade |
| dashboard-mui-xxxxx.js | ~450-500 KB | Solo /dashboard |
| react-vendor-xxxxx.js | ~150 KB | Solo /dashboard |
| mui-vendor-xxxxx.js | ~250 KB | Solo /dashboard |
| **TOTAL PÁGINAS PÚBLICAS** | **5.45 KB** | ✅ Sin React |
| **TOTAL DASHBOARD** | **~850 KB** | ✅ Separado |

---

## 🚨 Si Hay Errores Post-Deploy

### Error: "Vite manifest not found"
```
Solución: Asegúrate de que /public/build/ tenga manifest.json
  • Archivo debe estar en: public/build/manifest.json
  • Si no existe, el build no se completó correctamente
```

### Error: "404 en /build/assets/*.js"
```
Solución: Verifica que los archivos se subieron correctamente a:
  public/build/assets/
  
Desde Hostinger File Manager:
  ✅ public/build/ existe
  ✅ public/build/assets/ existe
  ✅ Archivos .js y .css están ahí
```

### Páginas lentas en producción
```
Solución: Verifica .htaccess
  1. SSH a Hostinger
  2. Ejecuta: curl -I https://tudominio.com/
  3. Debería mostrar: Content-Encoding: gzip
  
Si no:
  1. Sube public/.htaccess nuevamente
  2. Recarga la página (Ctrl+Shift+R)
```

---

## 📞 Pasos Finales

1. ✅ **Completar Build Local**
   - Esperar a que termine npm run build
   - Verificar public/build/ existe

2. 📤 **Subir a Hostinger**
   - /public/build/
   - /public/fonts/
   - /public/.htaccess

3. 🧪 **Probar en Producción**
   - Visita https://tudominio.com/
   - Abre DevTools → Network → JS files
   - Debería ser SOLO layout-xxxxx.css (5.45 KB)

4. 📊 **Medir en PageSpeed**
   - https://pagespeed.web.dev/
   - Espera mejora de 50-75% en rendimiento

---

## 🎯 Resumen Final

**Antes:**
- Home: 5.45 KB CSS + 692 KB React = 697.45 KB ❌
- Tours: 5.45 KB CSS + 692 KB React = 697.45 KB ❌
- Contacto: 5.45 KB CSS + 692 KB React = 697.45 KB ❌

**Después:**
- Home: 5.45 KB CSS = 5.45 KB ✅
- Tours: 5.45 KB CSS = 5.45 KB ✅
- Contacto: 5.45 KB CSS = 5.45 KB ✅
- Dashboard: ~850 KB (solo admin) ✅

**Reducción: 99.2% en páginas públicas** 🚀
