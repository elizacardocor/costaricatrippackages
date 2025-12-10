# Costa Rica Trip Packages - Laravel + React + Vite

Proyecto full-stack moderno que integra **Laravel 11** como backend con **React 19** como frontend, utilizando **Vite 5** como bundler. Perfecto para agencias de viajes o plataformas de turismo.

## 🚀 Características

- ✅ **Landing Page SEO Optimizada** - Página de inicio con metadatos completos
- ✅ **Componente React Interactivo** - Contador con botones (Incrementar, Decrementar, Reiniciar)
- ✅ **Hot Module Reload (HMR)** - Desarrollo rápido con actualización en vivo
- ✅ **Build Production-Ready** - Compilación optimizada para producción
- ✅ **Blade Templates** - Plantillas PHP con integración Vite
- ✅ **Responsive Design** - Diseño adaptable con gradientes modernos

## 📋 Stack Tecnológico

| Componente | Versión |
|-----------|---------|
| Laravel | 11.x |
| React | 19.2.1 |
| Vite | 5.x |
| PHP | 8.1+ |
| Node.js | 20.x |
| npm | 10.x |

## 🛠️ Instalación y Setup

### Requisitos Previos

- PHP 8.1 o superior
- Node.js 20.x
- npm 10.x
- Composer
- SQLite o MySQL (opcional para desarrollo)

### Pasos de Instalación

```bash
# 1. Clonar el repositorio
git clone https://github.com/TU_USUARIO/costaricatrippackages.git
cd costaricatrippackages

# 2. Instalar dependencias PHP
composer install

# 3. Configurar archivo .env
cp .env.example .env
php artisan key:generate

# 4. Instalar dependencias Node
npm install

# 5. Iniciar servidor Laravel
php artisan serve  # Puerto 8000 (o 8001 si está en uso)

# 6. En otra terminal, iniciar Vite dev server
npm run dev        # Puerto 5177
```

## 🎯 Rutas Disponibles

| Ruta | Descripción |
|------|-------------|
| `/` | Landing page SEO optimizada |
| `/react-app` | Aplicación React interactiva |
| `/test` | Página de prueba Blade |

## 💻 Desarrollo

### Servidor Vite (HMR Activo)
```bash
npm run dev
```
Accede a http://localhost:8001/react-app

### Build para Producción
```bash
npm run build
```
Genera assets optimizados en `public/build/`

## 📁 Estructura del Proyecto

```
costaricatrippackages/
├── app/                          # Código PHP/Laravel
├── resources/
│   ├── views/
│   │   ├── landing.blade.php     # Landing page SEO
│   │   ├── react.blade.php       # Template React
│   │   └── test.blade.php        # Página test
│   ├── css/
│   │   └── app.css               # Estilos globales
│   └── js/
│       ├── app.jsx               # Entry point React
│       ├── components/
│       │   ├── App.jsx           # Componente principal
│       │   └── App.css           # Estilos del componente
│       └── test-app.jsx          # App de prueba
├── public/
│   └── build/                    # Assets compilados (generado)
├── routes/
│   └── web.php                   # Rutas de la aplicación
├── vite.config.js                # Configuración Vite
├── package.json                  # Dependencias npm
└── composer.json                 # Dependencias PHP
```

## 🔧 Configuración Vite

El archivo `vite.config.js` está configurado para:
- Servir desde `localhost:5177`
- HMR habilitado para actualizaciones en vivo
- Plugin React con JSX support
- Plugin Laravel para integración con Blade

```javascript
server: {
    host: '0.0.0.0',
    port: 5177,
    hmr: {
        host: 'localhost',
        port: 5177,
    }
}
```

## 🎨 Componente React

### App.jsx - Features
- **Contador**: Gestión de estado con `useState`
- **3 Botones**: Incrementar, Decrementar, Reiniciar
- **Sección Features**: 6 características del servicio
- **Stack Info**: Muestra tecnologías utilizadas
- **Estilos Modernos**: Gradientes CSS con diseño responsive

```jsx
const [count, setCount] = useState(0);

<button onClick={() => setCount(count + 1)}>
    ➕ Incrementar
</button>
```

## 📦 Despliegue en Hostinger

### Requisitos Hostinger
- Plan Premium o superior
- Acceso SSH
- PHP 8.1+
- Node.js 20+ (para build)

### Pasos de Despliegue

1. **Build local**
   ```bash
   npm run build
   ```

2. **Subir archivos** (vía SFTP o SSH)
   - `app/` → `public_html/app/`
   - `resources/` → `public_html/resources/`
   - `routes/` → `public_html/routes/`
   - `public/` → `public_html/public/` (incluyendo `build/`)
   - `config/`, `database/`, `storage/`, `bootstrap/` → raíz

3. **Configurar .env en servidor**
   ```bash
   APP_ENV=production
   APP_DEBUG=false
   APP_URL=https://tudominio.com
   ```

4. **Instalar dependencias**
   ```bash
   composer install --no-dev
   php artisan config:cache
   php artisan route:cache
   ```

## 🚨 Solución de Problemas

### Página en blanco en React
- Verificar que `npm run dev` está corriendo
- Revisar consola del navegador (F12)
- Asegurar que puerto 5177 está disponible

### Error "manifest not found"
- Ejecutar: `npm run build`
- Verificar archivos en `public/build/`

### Puerto en uso
- Cambiar puerto en `vite.config.js`
- O matar proceso: `pkill -f "npm run dev"`

## 📝 Variables de Entorno

Crear `.env` basado en `.env.example`:

```env
APP_NAME=CostaRicaTrip
APP_ENV=local
APP_KEY=base64:...
APP_DEBUG=true
APP_URL=http://localhost:8001

DB_CONNECTION=sqlite
# O usar MySQL:
# DB_CONNECTION=mysql
# DB_HOST=localhost
# DB_DATABASE=costarica_trip
# DB_USERNAME=root
# DB_PASSWORD=
```

## 🔗 URLs Importantes

- **Desarrollo**: http://localhost:8001
- **Vite HMR**: http://localhost:5177
- **Landing**: http://localhost:8001/
- **React App**: http://localhost:8001/react-app

## 📚 Documentación Adicional

- [Laravel Documentation](https://laravel.com/docs)
- [React Documentation](https://react.dev)
- [Vite Guide](https://vitejs.dev/guide/)
- [Tailwind CSS](https://tailwindcss.com) (opcional para estilos)

## 👨‍💻 Desarrollo Futuro

- [ ] API REST con Laravel
- [ ] Autenticación de usuarios
- [ ] Base de datos de paquetes
- [ ] Sistema de pagos (Stripe/PayPal)
- [ ] Email notifications
- [ ] Dashboard administrativo

## 📄 Licencia

MIT License - Libre para usar en proyectos comerciales

## 🤝 Contribuciones

Las contribuciones son bienvenidas. Por favor:
1. Fork el proyecto
2. Crea una rama (`git checkout -b feature/AmazingFeature`)
3. Commit cambios (`git commit -m 'Add AmazingFeature'`)
4. Push a la rama (`git push origin feature/AmazingFeature`)
5. Abre un Pull Request

## 📧 Soporte

Para reportar bugs o solicitar features, abre un issue en GitHub.

---

**Hecho con ❤️ para agencias de viajes modernas**
