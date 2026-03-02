# Sitemap Dinámico - Documentación

## 📋 Descripción

El sitemap dinámico se genera automáticamente basándose en el contenido de la base de datos. Se actualiza cada 24 horas mediante caché HTTP.

## 🚀 Implementación

### Estructura

**Ubicación:** `/app/Http/Controllers/SitemapController.php`
**Ruta:** `GET /sitemap.xml`
**Tipo:** Dinámico (se genera en tiempo real)

### Incluye

- **Home Pages** (ES/EN) - Prioridad 1.0
- **Landing Pages** (Tours, Hotels, Transport, Contact) - Prioridad 0.8-0.9
- **Tours individuales** (ES/EN) - Prioridad 0.8
- **Hotels individuales** (ES/EN) - Prioridad 0.8
- **Destinations** (ES/EN) - Prioridad 0.7

### Campos XML

```xml
<url>
  <loc>URL completa</loc>
  <lastmod>ISO 8601 timestamp</lastmod>
  <changefreq>weekly|monthly</changefreq>
  <priority>0.7 - 1.0</priority>
</url>
```

## 🛠️ Comandos Disponibles

### Generar sitemap manualmente

```bash
php artisan sitemap:generate
```

**Salida:**
```
✅ Sitemap generated successfully!
📁 Location: /path/to/public/sitemap.xml
📊 Size: XX.XX KB
```

## 📊 Optimizaciones SEO

### Caché
- **HTTP Cache:** 24 horas (86400 segundos)
- **Browser Cache:** Máx 1 año (versioned)
- **Header X-Generated:** Timestamp de generación

### Frecuencia de cambio
- **Home:** weekly (cambios frecuentes)
- **Listings:** weekly (actualizaciones regulares)
- **Detail Pages:** monthly (cambios menos frecuentes)
- **Contact:** monthly (estático)

### Prioridades
```
1.0 = Home pages (más importante)
0.9 = Landing pages
0.8 = Listings + Detail pages
0.7 = Destinations
```

## 📡 Bots de Búsqueda

### Google
- URL: https://www.google.com/ping?sitemap=https://costaricatrips.com/sitemap.xml
- Reconoce cambios cada 24h

### Bing
- URL: https://www.bing.com/webmaster/ping.aspx?sitemap=https://costaricatrips.com/sitemap.xml
- Reconoce cambios cada 48h

## 🔄 Actualización Automática

Para ejecutar automáticamente cada 24 horas en servidor:

### Opción 1: Cron Job (Recomendado)
```bash
# /etc/cron.d/laravel-sitemap
0 0 * * * cd /path/to/costaricatrips && php artisan sitemap:generate >> /dev/null 2>&1
```

### Opción 2: Scheduler (Laravel)
```php
// app/Console/Kernel.php
protected function schedule(Schedule $schedule)
{
    $schedule->command('sitemap:generate')
        ->dailyAt('00:00');
}
```

### Opción 3: Webhook (Hostinger)
- Ejecutar comando POST a `/webhook/sitemap`
- Cada vez que se agregue nuevo contenido

## 📈 Monitoreo

### Google Search Console
1. Ir a Google Search Console
2. Sitemaps → Agregar nueva
3. URL: `https://costaricatrips.com/sitemap.xml`
4. Monitorear:
   - Envíos recibidos
   - Errores
   - Cobertura

### Validar Sitemap
```bash
# Verificar sintaxis XML
curl -s https://costaricatrips.com/sitemap.xml | xmllint --format -
```

## 🎯 Mejoras Futuras

- [ ] Sitemap Index para > 50k URLs
- [ ] Imágenes en sitemap
- [ ] Videos en sitemap
- [ ] Noticias en sitemap
- [ ] Mobile alternate

## 📝 Notas Técnicas

- **Sin base de datos adicional** - Dinámico en tiempo real
- **Cacheable** - 24 horas para no sobrecargar servidor
- **Multiidioma** - ES/EN para cada URL
- **Prioridades inteligentes** - Basadas en importancia SEO
