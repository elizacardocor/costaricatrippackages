# 📦 Guía de Despliegue en Hostinger

Esta guía te ayudará a desplegar el proyecto Laravel + React + Vite en Hostinger Premium.

## ✅ Requisitos Previos

- Plan **Hostinger Premium** o superior
- Acceso SSH habilitado
- PHP 8.1+ instalado en el servidor
- Composer instalado en el servidor
- **NO necesitas Node.js ni npm en el servidor** (ya tenemos el build compilado en `public/build/`)

## 🚀 Pasos de Despliegue

### 1. Preparar el Proyecto Localmente (YA HECHO)

El build de producción **ya está generado** en:
```
public/build/
  ├── manifest.json
  └── assets/
      ├── app-CEbkmmR2.css    (Estilos compilados)
      ├── app-FDfDlcst.js     (JavaScript compilado)
      └── app-l0sNRNKZ.js     (Dependencias)
```

**Si necesitas regenerar el build:**
```bash
# SOLO en tu máquina local, NO en Hostinger
npm run build
```

### 2. Conectar por SSH a Hostinger

```bash
ssh usuario@tudominio.com
# O usando IP
ssh usuario@xxx.xxx.xxx.xxx
```

### 3. Preparar Directorios en el Servidor

```bash
# Ir a la raíz pública
cd public_html

# Crear estructura de carpetas (si no existen)
mkdir -p app config database routes storage bootstrap
```

### 4. Subir Archivos (Opción A: SFTP Manual)

Usa un cliente SFTP (FileZilla, WinSCP, etc.):
- **Host**: tudominio.com (o IP)
- **Usuario**: Tu usuario Hostinger
- **Contraseña**: Tu contraseña
- **Puerto**: 22 (SFTP)

Sube estos archivos/carpetas:

```
/app                    → /public_html/app
/config                 → /public_html/config
/database               → /public_html/database
/resources              → /public_html/resources
/routes                 → /public_html/routes
/storage                → /public_html/storage
/bootstrap              → /public_html/bootstrap
/public/build           → /public_html/public/build
/public/index.php       → /public_html/public/index.php
/public/.htaccess       → /public_html/public/.htaccess
/composer.json          → /public_html/composer.json
/composer.lock          → /public_html/composer.lock
.env                    → /public_html/.env
```

### 5. Subir Archivos (Opción B: Git Clone)

Desde SSH en Hostinger:

```bash
cd public_html
git clone https://github.com/elizacardocor/costaricatrippackages.git temp
mv temp/* . && mv temp/.* . 2>/dev/null ; rmdir temp
```

### 6. Configurar Variables de Entorno

```bash
# Editar .env en el servidor
nano .env
```

Valores importantes para Hostinger:

```env
APP_NAME=CostaRicaTrip
APP_ENV=production
APP_DEBUG=false
APP_URL=https://tudominio.com

# Base de datos (usar MySQL de Hostinger)
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=tu_base_datos
DB_USERNAME=tu_usuario_db
DB_PASSWORD=tu_contraseña_db

# Mail (opcional - usar SMTP de Hostinger)
MAIL_MAILER=smtp
MAIL_HOST=tu-host-smtp.com
MAIL_PORT=587
MAIL_USERNAME=tu-email@tudominio.com
MAIL_PASSWORD=tu-contraseña-email
```

### 7. Instalar Dependencias PHP

```bash
# Desde SSH en Hostinger
cd public_html

# Instalar Composer (si no está)
curl -sS https://getcomposer.org/installer | php
php composer.phar install --no-dev --optimize-autoloader

# O si Composer está instalado globalmente:
composer install --no-dev --optimize-autoloader
```

### 8. Generar Key de Aplicación

```bash
php artisan key:generate
```

### 9. Ejecutar Migraciones (si las hay)

```bash
php artisan migrate --force
```

### 10. Optimizar para Producción

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### 11. Configurar Permisos

```bash
# Dar permisos de escritura a storage y bootstrap
chmod -R 775 storage/
chmod -R 775 bootstrap/cache/

# O más seguro:
chmod -R 755 storage/
chmod -R 755 bootstrap/cache/
chmod 644 storage/logs/*.log
```

### 12. Configurar Document Root

En el panel de Hostinger:
1. Ve a **Hosting** → **Dominios**
2. Selecciona tu dominio
3. Cambia **Document Root** a: `/public_html/public`
4. Guarda cambios

### 13. Verificar .htaccess

Asegúrate que `/public_html/public/.htaccess` existe:

```apache
<IfModule mod_rewrite.c>
    <IfModule mod_negotiation.c>
        Options -MultiViews -Indexes
    </IfModule>

    RewriteEngine On
    RewriteCond %{HTTP:Authorization} .
    RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [QSA,L]
</IfModule>
```

## 🔍 Verificación Post-Despliegue

```bash
# Verificar que Laravel funciona
curl https://tudominio.com/

# Verificar React app
curl https://tudominio.com/react-app

# Ver logs de error
tail -f storage/logs/laravel.log
```

## 🐛 Solución de Problemas

### Error 500 - Permisos de storage

```bash
chmod -R 777 storage/
chmod -R 777 bootstrap/cache/
```

### Error 500 - Key no generada

```bash
php artisan key:generate
```

### Assets no cargando

```bash
# Verificar que public/build/ existe
ls -la public/build/

# Si no existe, hacer build local y subir:
npm run build
# Luego subir public/build/
```

### Error "CORS"

Verificar que `config/cors.php` está bien configurado para producción.

### Logs de error en Hostinger

```bash
# Ver últimas líneas
tail -100 storage/logs/laravel.log

# O en tiempo real
tail -f storage/logs/laravel.log
```

## 📊 Monitoreo

### Ver uso de recursos

```bash
# Espacio en disco
df -h

# Uso de CPU/Memoria
top
```

### Verificar PHP version

```bash
php --version
```

## 🔄 Actualizar Código en Servidor

Cuando hagas cambios locales:

```bash
# Local
git push origin main

# En servidor (SSH)
cd public_html
git pull origin main

# Si hay cambios en dependencias PHP
composer install --no-dev --optimize-autoloader

# Limpiar caché
php artisan config:cache
php artisan route:cache
```

## 📱 Monitorear en Producción

### Usar Laravel Telescope (Opcional)

```bash
composer require laravel/telescope --dev
php artisan telescope:install
```

### Usar Sentry para error tracking

```bash
composer require sentry/sentry-laravel
php artisan sentry:publish --dsn=tu-sentry-dsn
```

## 🎉 ¡Listo!

Tu aplicación debería estar en:
- **Landing page**: https://tudominio.com/
- **React App**: https://tudominio.com/react-app

---

**Notas Importantes:**

- Siempre hacer deploy en **horas de bajo tráfico**
- Mantener **backups regulares**
- Monitorear **logs de error**
- Usar **HTTPS** en producción (Hostinger lo proporciona)
- Actualizar dependencias regularmente

Para soporte, contacta con **Hostinger Support** o revisa la documentación en: https://support.hostinger.com
