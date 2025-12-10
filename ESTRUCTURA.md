# Estructura del Proyecto Laravel + React + Vite

## 📁 Estructura de Directorios

```
costaricatrippackages/
├── app/                          # Código de aplicación PHP
│   ├── Http/
│   │   └── Controllers/         # Controladores de rutas
│   ├── Models/                  # Modelos Eloquent
│   └── ...
│
├── resources/                    # Recursos del frontend
│   ├── css/
│   │   └── app.css             # CSS global
│   │
│   ├── js/
│   │   ├── app.jsx             # Entry point de React (JSX)
│   │   └── components/
│   │       ├── App.jsx         # Componente principal
│   │       ├── App.css         # Estilos del componente
│   │       └── [otros componentes React]
│   │
│   └── views/
│       ├── landing.blade.php   # Landing page SEO
│       ├── react.blade.php     # Página que monta React
│       └── [otras vistas Blade]
│
├── routes/
│   └── web.php                 # Rutas de la aplicación
│
├── public/                      # Archivos estáticos servidos
│   ├── index.php               # Entry point de la aplicación
│   └── build/                  # Build de Vite (se genera con npm run build)
│
├── vite.config.js              # Configuración de Vite
├── package.json                # Dependencias de npm
├── composer.json               # Dependencias de PHP
└── .env                        # Variables de entorno

```

## 🔄 Flujo de Desarrollo vs Producción

### Desarrollo Local
```bash
# Terminal 1 - Servidor Laravel
php artisan serve

# Terminal 2 - Vite en modo watch (desarrollo)
npm run dev
```

Accede a:
- Landing: `http://localhost:8000/`
- React App: `http://localhost:8000/react-app`

### Producción (Hostinger Premium)
```bash
# Local: Generar build estático
npm run build

# Subir a Hostinger:
# - Carpeta public/ completa (incluye build/)
# - Carpeta app/
# - Carpeta routes/
# - Carpeta config/
# - Carpeta database/
# - Carpeta resources/views/
# - composer.json, composer.lock, .env, artisan, etc.
# - NO subir: node_modules/, .git/
```

## 📦 Archivos Importantes

### `vite.config.js`
Configura:
- Laravel Vite Plugin (para Blade)
- React Plugin (@vitejs/plugin-react)
- Entrada: `resources/js/app.jsx`
- Salida: `public/build/`

### `package.json`
Scripts:
- `npm run dev` - Inicia Vite en modo desarrollo
- `npm run build` - Crea build estático para producción

### `resources/js/app.jsx`
- Entry point de React
- Monta el app en `#react-app`
- Solo se ejecuta si existe el elemento en el DOM

### `resources/views/react.blade.php`
- Carga los archivos CSS y JS vía `@vite()`
- Contiene el div `#react-app` donde React se monta

## 🎯 Rutas

```php
Route::get('/', ...)              // Landing page Blade (SEO)
Route::get('/react-app', ...)    // App React
```

## ⚙️ Comandos Útiles

### Desarrollo
```bash
# Iniciar servidor Laravel
php artisan serve

# Iniciar Vite en watch mode
npm run dev

# Ver estructura del proyecto
tree -L 2
```

### Build para Producción
```bash
# Generar build estático
npm run build

# El build se genera en public/build/
# Contiene: js/, css/, assets/

# Verificar que está listo para subir
ls -la public/build/
```

### Mantenimiento
```bash
# Actualizar dependencias de npm
npm update

# Verificar vulnerabilidades
npm audit

# Limpiar caché de Vite
rm -rf node_modules/.vite
```

## 🚀 Deploy a Hostinger

1. **Generar build local:**
   ```bash
   npm run build
   ```

2. **Subir vía FTP/SFTP:**
   - Carpeta `public/` completa (incluye build/)
   - Carpeta `app/`
   - Carpeta `routes/`
   - Archivos: `artisan`, `.env`, `composer.json`, etc.

3. **En servidor Hostinger:**
   ```bash
   # SSH al servidor
   cd /home/tu_usuario/public_html

   # Instalar dependencias PHP
   composer install --no-dev

   # Generar clave de aplicación
   php artisan key:generate

   # Migrar base de datos (si tienes)
   php artisan migrate --force
   ```

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
