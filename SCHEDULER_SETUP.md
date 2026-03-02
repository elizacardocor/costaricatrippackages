# Configuración de Scheduler - Sitemap Automático

## 🔧 Configuración Local (Desarrollo)

El scheduler de Laravel está configurado en `app/Console/Kernel.php` para ejecutar **diariamente a las 00:00 (medianoche)**.

```php
$schedule->command('sitemap:generate')
    ->dailyAt('00:00')
    ->withoutOverlapping()
    ->onSuccess(...)
    ->onFailure(...);
```

### Para probar localmente:

```bash
# Terminal 1: Inicia el scheduler
php artisan schedule:work

# Terminal 2: En otra ventana, verifica los logs
tail -f storage/logs/laravel.log
```

---

## 🚀 Configuración en Servidor (Producción)

El servidor necesita un **cron job** que ejecute el scheduler de Laravel cada minuto.

### Opción 1: Hostinger (Panel de Control)

1. **Accede a tu panel de Hostinger**
2. Ve a **Gestión avanzada → Cron Jobs**
3. Haz clic en **"Crear tarea"**
4. Completa los campos:

```
Descripción:          Laravel Sitemap Generator
Minuto:               *
Hora:                 *
Día del mes:          *
Mes:                  *
Día de la semana:     *
Comando:              cd /home/USERNAME/public_html/costaricatrips && php artisan schedule:run >> /dev/null 2>&1
```

5. Haz clic en **"Crear"**

### Opción 2: VPS / Servidor Dedicado

Edita tu crontab:

```bash
sudo crontab -e
```

Agrega la siguiente línea:

```cron
* * * * * cd /var/www/costaricatrips && php artisan schedule:run >> /dev/null 2>&1
```

### Opción 3: Directamente en SSH (Hostinger)

```bash
# Conecta por SSH
ssh tu_usuario@tu_dominio.com

# Edita crontab
crontab -e

# Agrega la línea
* * * * * cd $HOME/public_html/costaricatrips && php artisan schedule:run >> /dev/null 2>&1

# Guarda con Ctrl+X, luego Y, luego Enter
```

---

## ✅ Verificar que funciona

### En Hostinger:

```bash
# Conecta por SSH
ssh usuario@servidor.com

# Verifica que el cron está configurado
crontab -l
```

**Salida esperada:**
```
* * * * * cd /home/usuario/public_html && php artisan schedule:run >> /dev/null 2>&1
```

### Verificar ejecución:

```bash
# Ver logs de ejecución
tail -100 /var/www/costaricatrips/storage/logs/laravel.log

# Buscar "Sitemap"
grep -i "sitemap" /var/www/costaricatrips/storage/logs/laravel.log
```

**Salida esperada:**
```
[2026-02-29 00:00:15] local.INFO: ✅ Sitemap generated successfully at 2026-02-29 00:00:15
```

---

## 📊 Monitoreo

### Google Search Console

1. Ve a **Configuración → Sitemaps**
2. Ingresa: `https://costaricatrips.com/sitemap.xml`
3. Monitorea:
   - **URLs enviadas:** Deben aumentar cuando agregas tours
   - **URLs indexadas:** Deben estar en su mayoría indexadas
   - **Errores:** Deben ser 0

### Ping Manual a Google

```bash
curl "https://www.google.com/ping?sitemap=https://costaricatrips.com/sitemap.xml"
```

---

## 🔄 Frecuencia

| Evento | Frecuencia |
|--------|-----------|
| Sitemap se genera | **Diariamente a las 00:00** |
| Google rastrea | Cada 24h (varía) |
| Tours aparecen en búsquedas | 3-5 días después |
| Máximo esperar | 7 días |

---

## 📝 Comando Manual (si necesitas)

Si necesitas generar el sitemap manualmente en cualquier momento:

```bash
# En SSH o panel de Hostinger
php artisan sitemap:generate
```

**Salida:**
```
✅ Sitemap generated successfully!
📁 Location: /home/usuario/public_html/public/sitemap.xml
📊 Size: XX.XX KB
```

---

## 🐛 Troubleshooting

### El sitemap no se actualiza

1. **Verifica que el cron existe:**
   ```bash
   crontab -l
   ```

2. **Verifica permisos de carpeta:**
   ```bash
   chmod -R 755 /home/usuario/public_html/storage
   ```

3. **Verifica los logs:**
   ```bash
   tail -f storage/logs/laravel.log | grep -i sitemap
   ```

4. **Prueba manualmente:**
   ```bash
   cd /home/usuario/public_html && php artisan sitemap:generate
   ```

### Error: "Command not found"

- Asegúrate que `php` está en el PATH
- Usa ruta completa: `/usr/bin/php` o `/usr/local/bin/php`

### Error: "No permission"

```bash
# Cambia permisos
chmod 755 artisan
chmod -R 755 storage/ bootstrap/cache/
```

---

## 🎯 Checklist Final

- [ ] Cron job creado en Hostinger
- [ ] Scheduler configurado en Kernel.php
- [ ] Primer sitemap generado manualmente
- [ ] Sitemap enviado a Google Search Console
- [ ] Logs verificados sin errores
- [ ] Google indexando nuevos tours

---

**Una vez configurado:** Tu sitemap se actualiza automáticamente cada medianoche sin intervención manual. 🚀
