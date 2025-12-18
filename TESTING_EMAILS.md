# 📧 Testing de Emails en Local

## 🚀 Configuración Rápida

### Opción 1: Usar Mailtrap (RECOMENDADO - Gratuito)

#### Paso 1: Crear cuenta en Mailtrap
1. Ve a https://mailtrap.io
2. Click en "Sign Up" (gratis)
3. Verifica tu email
4. Elige plan **Free**

#### Paso 2: Obtener credenciales SMTP
1. En el dashboard, ve a **Inboxes** → **Demo Inbox**
2. Click en **Integrations**
3. Busca **SMTP Settings**
4. Copia los datos (verás algo como esto):

```
Host: live.smtp.mailtrap.io
Port: 587
Username: [número grande]
Password: [token]
Encryption: STARTTLS
```

#### Paso 3: Actualizar .env
Abre `/home/elizabeth/costaricatrippackages/.env` y reemplaza:

```env
MAIL_MAILER=smtp
MAIL_HOST=live.smtp.mailtrap.io
MAIL_PORT=587
MAIL_USERNAME=12345  # Reemplazar con tu username de Mailtrap
MAIL_PASSWORD=abc123xyz  # Reemplazar con tu password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="info@costaricatrips.com"
MAIL_FROM_NAME="Costa Rica Trips"
MAIL_CONTACT_EMAIL="info@costaricatrips.com"
```

#### Paso 4: Refrescar configuración Laravel
```bash
php artisan config:cache
php artisan config:clear
```

#### Paso 5: Probar envío
```bash
# Terminal 1: Iniciar servidor
php artisan serve

# Terminal 2: Ir a http://localhost:8000/contacto
# Llenar el formulario y enviar

# Ir a https://mailtrap.io → Dashboard → Demo Inbox
# Verás los 2 emails allí (usuario + admin)
```

---

## 🧪 Verificación

### Emails deberían verse en Mailtrap:

**Email 1: Confirmación al usuario**
- De: info@costaricatrips.com
- Para: tu_email_del_formulario@...
- Asunto: "Confirmación de recepción - Costa Rica Trips"

**Email 2: Notificación al equipo**
- De: info@costaricatrips.com
- Para: info@costaricatrips.com (MAIL_CONTACT_EMAIL)
- Asunto: "Nuevo mensaje de contacto - [Nombre Usuario]"

---

## 🐛 Solucionar Problemas

### Error: "Connection refused"
```
❌ Significa que los datos de Mailtrap son incorrectos
✅ Solución: 
- Revisar que copiaste correctamente USERNAME y PASSWORD
- Verificar MAIL_PORT = 587
- Verificar MAIL_ENCRYPTION = tls
```

### Error: "Authentication failed"
```
❌ Username o Password incorrectos
✅ Solución:
- Ir nuevamente a Mailtrap → Integrations → SMTP Settings
- Copiar exactamente tal como aparece
- Correr: php artisan config:cache
```

### Formulario se envía pero no llegan emails
```
❌ El backend no está recibiendo datos correctamente
✅ Solución:
- Abrir DevTools (F12)
- Ir a pestaña "Network"
- Enviar formulario
- Verificar que la petición POST a /contacto retorna 200
- Si hay error, ver la respuesta JSON
```

### Ver logs detallados
```bash
# En otra terminal
tail -f storage/logs/laravel.log

# Luego enviar formulario
# Verás los errores de mail si los hay
```

---

## 📝 Verificar desde PHP

### Probar conexión SMTP:
```bash
php artisan tinker

# Probar con Mailtrap
Mail::to('test@example.com')->send(new \Illuminate\Mail\Mailable);

# O más simple
Mail::raw('Test Message', function($message) {
    $message->to('test@example.com')
            ->subject('Test from Costa Rica Trips');
});
```

---

## ✅ Checklist de Testing

- [ ] Cuenta creada en Mailtrap.io
- [ ] Demo Inbox configurado
- [ ] Datos SMTP copiados
- [ ] .env actualizado con USERNAME y PASSWORD
- [ ] `php artisan config:cache` ejecutado
- [ ] `php artisan serve` corriendo
- [ ] Formulario en http://localhost:8000/contacto llenado correctamente
- [ ] Email enviado
- [ ] 2 emails visibles en Mailtrap Dashboard
- [ ] Email de usuario contiene el mensaje enviado
- [ ] Email de admin contiene nombre, email, teléfono, asunto

---

## 💡 Alternativa: Usar Log (Sin Mailtrap)

Si no quieres crear cuenta en Mailtrap, puedes usar driver "log":

```env
MAIL_MAILER=log
```

Los emails se guardarán en `storage/logs/laravel.log`:

```bash
# Ver en tiempo real
tail -f storage/logs/laravel.log

# Buscar específicamente correos
tail -f storage/logs/laravel.log | grep -i "message"
```

Pero Mailtrap es mejor porque ves emails formateados con HTML y todo.

---

## 🎉 Próximo paso

Una vez que todo funcione en local con Mailtrap:
1. Commit a GitHub
2. Deploy a Hostinger
3. Cambiar credenciales en .env a Gmail o SendGrid
4. Probar en producción

**¡Listo!** 🚀
