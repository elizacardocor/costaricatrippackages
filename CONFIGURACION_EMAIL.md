# Configuración de Email - Costa Rica Trip Packages

## 🚀 Configuración Actual (Desarrollo)

En desarrollo estamos usando `MAIL_MAILER=log`, lo que significa que los emails se guardan en los logs en lugar de enviarse. Esto es útil para testing.

**Verificar emails de prueba:**
```bash
tail -f storage/logs/laravel.log
```

---

## 📧 Configuración para Producción (Hostinger)

### Opción 1: Gmail (Recomendado)

1. **Habilitar autenticación de dos factores en tu cuenta Google**

2. **Generar contraseña de aplicación:**
   - Ve a https://myaccount.google.com/apppasswords
   - Selecciona "Mail" y "Windows Computer"
   - Google te dará una contraseña de 16 caracteres

3. **Actualizar `.env` en Hostinger:**
   ```
   MAIL_MAILER=smtp
   MAIL_HOST=smtp.gmail.com
   MAIL_PORT=587
   MAIL_USERNAME=tu_email@gmail.com
   MAIL_PASSWORD=tu_contraseña_app
   MAIL_ENCRYPTION=tls
   MAIL_FROM_ADDRESS=tu_email@gmail.com
   MAIL_FROM_NAME="Costa Rica Trips"
   MAIL_CONTACT_EMAIL="info@costaricatrips.com"
   ```

---

### Opción 2: Mailtrap (Testing)

Mailtrap es excelente para testing de emails en producción sin enviarlos realmente.

1. **Registrarse en:** https://mailtrap.io

2. **Obtener credenciales SMTP de Mailtrap**

3. **Actualizar `.env`:**
   ```
   MAIL_MAILER=smtp
   MAIL_HOST=live.smtp.mailtrap.io
   MAIL_PORT=587
   MAIL_USERNAME=tu_username
   MAIL_PASSWORD=tu_password
   MAIL_ENCRYPTION=tls
   MAIL_FROM_ADDRESS=noreply@costaricatrips.com
   MAIL_FROM_NAME="Costa Rica Trips"
   MAIL_CONTACT_EMAIL="info@costaricatrips.com"
   ```

---

### Opción 3: SendGrid (Mejor para producción)

1. **Registrarse en:** https://sendgrid.com

2. **Crear API Key**

3. **Actualizar `.env`:**
   ```
   MAIL_MAILER=sendgrid
   SENDGRID_API_KEY=tu_api_key
   MAIL_FROM_ADDRESS=noreply@costaricatrips.com
   MAIL_FROM_NAME="Costa Rica Trips"
   MAIL_CONTACT_EMAIL="info@costaricatrips.com"
   ```

---

### Opción 4: SMTP de Hostinger

1. **Acceder al panel de Hostinger**

2. **Crear una cuenta de email profesional**

3. **En Hostinger, buscar SMTP/Credenciales del servidor**

4. **Actualizar `.env`:**
   ```
   MAIL_MAILER=smtp
   MAIL_HOST=smtp.hostinger.com
   MAIL_PORT=465
   MAIL_USERNAME=tu_email@costaricatrips.com
   MAIL_PASSWORD=tu_contraseña
   MAIL_ENCRYPTION=ssl
   MAIL_FROM_ADDRESS=tu_email@costaricatrips.com
   MAIL_FROM_NAME="Costa Rica Trips"
   MAIL_CONTACT_EMAIL=info@costaricatrips.com
   ```

---

## 🧪 Probar Email Localmente

### Con driver "log" (actual):
```bash
# Ver logs en tiempo real
tail -f storage/logs/laravel.log

# Luego enviar un formulario desde http://localhost:8000/contacto
# Verás los emails en el log
```

### Cambiar a SMTP para testing:
```bash
# Editar .env y cambiar a:
MAIL_MAILER=smtp
MAIL_HOST=...
MAIL_PORT=...
MAIL_USERNAME=...
MAIL_PASSWORD=...
MAIL_ENCRYPTION=tls

# Luego probar
php artisan tinker
Mail::to('test@example.com')->send(new \App\Mail\ContactConfirmation('Test User', 'This is a test message'));
```

---

## 📝 Templates de Email

Los templates se encuentran en:
- `resources/views/emails/contact-confirmation.blade.php` - Email para usuario
- `resources/views/emails/contact-admin.blade.php` - Email para admin

Puedes editarlos directamente, cambiar colores, logo, etc.

---

## 🔍 Verificar Configuración

### En Hostinger (vía SSH):
```bash
cd ~/domains/costaricatrips.com/public_html

# Ver configuración actual
cat .env | grep MAIL_

# Probar envío
php artisan tinker
Mail::to('tu_email@gmail.com')->send(new \App\Mail\TestEmail());
```

### Ver logs:
```bash
tail -f storage/logs/laravel.log | grep -i mail
```

---

## 🚨 Troubleshooting

### Error: "Connection could not be established with host smtp.mailtrap.io"
- Verificar que MAIL_HOST, MAIL_PORT y MAIL_ENCRYPTION sean correctos
- Verificar MAIL_USERNAME y MAIL_PASSWORD
- Firewall podría estar bloqueando puerto 587/465

### Error: "Swift_TransportException"
- Revisar logs: `tail -f storage/logs/laravel.log`
- Verificar que .env tiene valores correctos
- Correr: `php artisan config:cache` para refrescar config

### Emails se envían pero no llegan
- Revisar carpeta SPAM/Basura del destinatario
- Verificar que MAIL_FROM_ADDRESS es un email válido
- Algunos servidores SMTP requieren verificación de dominio

---

## 💡 Recomendación para Hostinger

**Usar Gmail (Opción 1) es lo más simple:**
1. Rápido de configurar
2. Gratis
3. Confiable
4. Sin límite de emails (para tu volumen)
5. Funciona con 2FA

**O usar SendGrid (Opción 3) si esperas alto volumen:**
1. Plan gratuito: 100 emails/día
2. Mejor entregabilidad
3. Webhooks y estadísticas
4. Escalable a producción

---

## 📋 Checklist de Deploy

- [ ] Elegir proveedor de email (Gmail recomendado)
- [ ] Obtener credenciales SMTP
- [ ] Actualizar `.env` en Hostinger
- [ ] Correr `php artisan config:cache`
- [ ] Probar enviando formulario desde `/contacto`
- [ ] Verificar que llegaron los 2 emails (usuario + admin)
- [ ] Revisar logs si hay errores

---

**Última actualización:** 17 de diciembre de 2025
