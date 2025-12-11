# 🚀 GUÍA DE SOLUCIÓN - Problema de Despliegue en Hostinger

**Estado Actual**: La aplicación Laravel + React está completa y en el servidor, pero Hostinger muestra error 404 en lugar de servir la aplicación.

## ⚡ Solución Rápida (3 Opciones)

### Opción 1️⃣: Diagnóstico y Reparación Automática ✅ (RECOMENDADA)

Esta es la opción más segura y te mostrará exactamente qué está mal:

```bash
# En PuTTY (SSH en Hostinger):
cd /home/u336394587/domains/costaricatrippackages.com
bash ./DIAGNOSTICO_Y_FIX_HOSTINGER.sh
```

**Qué hace este script:**
- ✅ Diagnostica la estructura actual
- ✅ Verifica archivos críticos
- ✅ Limpia caché problemático
- ✅ Reconfigura .htaccess correctamente
- ✅ Regenera APP_KEY
- ✅ Configura permisos apropiados
- ✅ Instala dependencias si faltan

**Tiempo estimado**: 3-5 minutos

---

### Opción 2️⃣: Despliegue Limpio desde GitHub (Si lo anterior no funciona)

Si el diagnóstico muestra problemas irrecuperables, ejecuta una clonación limpia:

```bash
# En PuTTY:
cd /home/u336394587/domains/costaricatrippackages.com
bash ./DEPLOY_LIMPIO_HOSTINGER.sh
```

**Qué hace este script:**
- ✅ Respaldas archivos existentes
- ✅ Limpia el directorio completamente
- ✅ Clona el repositorio desde GitHub
- ✅ Instala todas las dependencias
- ✅ Configura todo desde cero
- ✅ Crea .htaccess correctamente

**Tiempo estimado**: 5-8 minutos

---

### Opción 3️⃣: Troubleshooting Manual (Si necesitas ver detalles)

Después de ejecutar Opción 1 o 2, si aún ves error 404:

```bash
# En PuTTY:
cd /home/u336394587/domains/costaricatrippackages.com
bash ./TROUBLESHOOT_HOSTINGER.sh
```

**Qué muestra:**
- ✅ Estado de mod_rewrite en Apache
- ✅ Estructura de archivos
- ✅ Configuración .htaccess
- ✅ Permisos de archivos
- ✅ Contenido de .env
- ✅ Logs de Laravel
- ✅ Comandos curl para probar desde tu PC

**Tiempo estimado**: 2-3 minutos

---

## 🎯 Flujo de Solución Recomendado

### Paso 1: Ejecutar Opción 1 (Diagnóstico)
```bash
bash ./DIAGNOSTICO_Y_FIX_HOSTINGER.sh
```

### Paso 2: Prueba en tu navegador
```
https://costaricatrippackages.com/
```

### Paso 3: Si ves error 404 de Hostinger
Ejecuta Opción 2:
```bash
bash ./DEPLOY_LIMPIO_HOSTINGER.sh
```

### Paso 4: Prueba nuevamente
```
https://costaricatrippackages.com/
```

### Paso 5: Si persiste el error
Ejecuta Opción 3 para diagnóstico detallado:
```bash
bash ./TROUBLESHOOT_HOSTINGER.sh
```

---

## 🔍 ¿Qué Podría Estar Mal?

### 1. **Problema: Sigo viendo error 404 de Hostinger**

**Causa más probable**: Apache no está ejecutando las reglas de rewrite en `.htaccess`

**Soluciones**:

1. **Verifica que mod_rewrite esté habilitado**:
   ```bash
   # En PuTTY
   apache2ctl -M | grep rewrite
   # Debería mostrar: rewrite_module (shared)
   ```

2. **Si mod_rewrite NO está habilitado**:
   - Contacta a soporte Hostinger
   - Solicita que habiliten `mod_rewrite` en tu dominio
   - Esto es necesario para que .htaccess funcione

3. **Alternativa (si Hostinger no puede habilitar mod_rewrite)**:
   - Usando htaccess en documentroot
   - Contactar a Hostinger para otra solución

---

### 2. **Problema: Página en blanco (error 500 o 502)**

**Causa**: Error en la aplicación Laravel

**Solución**:
```bash
# En PuTTY
cd /home/u336394587/domains/costaricatrippackages.com

# Edita .env para ver errores
nano .env
# Asegúrate que: APP_DEBUG=true

# Revisa los logs
tail -50 storage/logs/laravel.log
```

Esto mostrará exactamente cuál es el error.

---

### 3. **Problema: Acceso directo a `/public/index.php` funciona, pero `/` no**

**Causa**: Las reglas de .htaccess no se están aplicando

**Solución**: Ejecuta Opción 1 (Diagnóstico) que reconfigurará .htaccess

---

## 📋 Checklist de Verificación Manual

Si necesitas verificar manualmente sin scripts:

```bash
# En PuTTY
cd /home/u336394587/domains/costaricatrippackages.com

# 1. ¿Existe la estructura correcta?
[ -f "public/index.php" ] && echo "✓ public/index.php" || echo "✗ FALTA"
[ -f "vendor/autoload.php" ] && echo "✓ vendor/" || echo "✗ FALTA"
[ -f ".env" ] && echo "✓ .env" || echo "✗ FALTA"
[ -f ".htaccess" ] && echo "✓ .htaccess raíz" || echo "✗ FALTA"
[ -f "public/.htaccess" ] && echo "✓ public/.htaccess" || echo "✗ FALTA"

# 2. ¿Está PHP bien configurado?
php -v

# 3. ¿Está Composer bien?
composer --version

# 4. ¿Los permisos son correctos?
ls -l public/index.php
ls -ld storage/
ls -ld bootstrap/cache/

# 5. ¿Qué dice .env?
grep "APP_DEBUG" .env
```

---

## 📞 Información de Contacto Hostinger

Si necesitas hablar con soporte:

**Mi credencial en Hostinger**:
- Email: elizacardocor@gmail.com
- Usuario: u336394587
- Dominio: costaricatrippackages.com
- Servidor: Premium

**Qué decirle a Hostinger**:
> "Necesito habilitar `mod_rewrite` en Apache para mi dominio costaricatrippackages.com. 
> Estoy desplegando una aplicación Laravel que requiere que las reglas de .htaccess 
> se ejecuten correctamente."

---

## 🔧 Solución Manual si los Scripts Fallan

Si por alguna razón los scripts no funcionan, aquí está la solución manual paso a paso:

### Paso 1: Configura el entorno
```bash
cd /home/u336394587/domains/costaricatrippackages.com
cp .env.example .env
php artisan key:generate
```

### Paso 2: Instala dependencias
```bash
composer install --no-dev --optimize-autoloader
```

### Paso 3: Configura permisos
```bash
chmod -R 755 storage/
chmod -R 755 bootstrap/cache/
```

### Paso 4: Configura .htaccess en raíz
```bash
cat > .htaccess << 'EOF'
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteRule ^(.*)$ public/$1 [L]
</IfModule>
EOF
```

### Paso 5: Configura .htaccess en public/
```bash
cat > public/.htaccess << 'EOF'
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteRule ^(.*)$ index.php/$1 [QSA,L]
</IfModule>
EOF
```

### Paso 6: Limpia caché
```bash
rm -f bootstrap/cache/config.php
rm -f bootstrap/cache/services.php
```

### Paso 7: Prueba
```bash
curl https://costaricatrippackages.com/
```

---

## 📊 Tabla de Decisión

| Síntoma | Causa Probable | Solución |
|---------|---|---|
| Error 404 de Hostinger | mod_rewrite deshabilitado | Contactar Hostinger |
| Página en blanco | Error Laravel | Ver logs: `tail storage/logs/laravel.log` |
| `/public/index.php` funciona, `/` no | .htaccess no se ejecuta | Ejecutar DIAGNOSTICO_Y_FIX_HOSTINGER.sh |
| vendor/ falta | Dependencias no instaladas | Ejecutar `composer install --no-dev --optimize-autoloader` |
| Permisos denegados | Permisos incorrectos | Ejecutar scripts de diagnóstico |

---

## ✅ Cuándo sabrás que está funcionando

Verás la página de inicio (landing page con info de Costa Rica) en:
```
https://costaricatrippackages.com/
```

Y podrás acceder a la aplicación React en:
```
https://costaricatrippackages.com/react-app
```

---

## 🎓 Información Técnica Importante

### Por qué Hostinger muestra error 404

Hostinger tiene una configuración de directorio raíz por defecto. Laravel espera que su carpeta `public/` sea la raíz del servidor web. La solución es usar `.htaccess` para redirigir todas las solicitudes a `public/`.

### Por qué necesitamos dos archivos .htaccess

1. **`.htaccess` en raíz**: Redirige todo tráfico a `/public/`
2. **`.htaccess` en public/**: Maneja el enrutamiento interno de Laravel

### Por qué mod_rewrite es necesario

Sin mod_rewrite, Apache no puede procesar las reglas en `.htaccess`, por lo que el servidor no sabe que debe redirigir a Laravel.

---

## 📱 Resumen para usar desde PuTTY

**Opción rápida (recomendada)**:
```bash
cd /home/u336394587/domains/costaricatrippackages.com && bash DIAGNOSTICO_Y_FIX_HOSTINGER.sh
```

**Si no funciona, despliegue limpio**:
```bash
cd /home/u336394587/domains/costaricatrippackages.com && bash DEPLOY_LIMPIO_HOSTINGER.sh
```

**Para ver detalles**:
```bash
cd /home/u336394587/domains/costaricatrippackages.com && bash TROUBLESHOOT_HOSTINGER.sh
```

---

## 🚀 Conclusión

Tienes **3 scripts automáticos listos** para usar. El flujo es:
1. Ejecuta el diagnóstico
2. Prueba en tu navegador
3. Si no funciona, usa el despliegue limpio
4. Si persiste, usa el troubleshoot para ver detalles

**¡Debería funcionar en 10-15 minutos máximo!**

---

**Última actualización**: Diciembre 10, 2025
**Estado**: Scripts listos para usar en Hostinger
