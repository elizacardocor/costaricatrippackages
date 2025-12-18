<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 3px solid #FF6B35;
            padding-bottom: 20px;
        }
        .header h1 {
            color: #FF6B35;
            margin: 0;
            font-size: 28px;
        }
        .alert {
            background-color: #fff3cd;
            border: 1px solid #ffc107;
            color: #856404;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 30px;
        }
        .info-box {
            background-color: #f0f7ff;
            border-left: 4px solid #0066CC;
            padding: 20px;
            margin: 20px 0;
            border-radius: 5px;
        }
        .info-box p {
            margin: 10px 0;
        }
        .info-label {
            font-weight: 600;
            color: #0066CC;
        }
        .message-content {
            background-color: #f9f9f9;
            padding: 20px;
            border-left: 4px solid #00A86B;
            margin: 20px 0;
            border-radius: 5px;
            white-space: pre-wrap;
            word-wrap: break-word;
        }
        .footer {
            text-align: center;
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            color: #999;
            font-size: 12px;
        }
        .button {
            display: inline-block;
            background-color: #FF6B35;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin: 10px 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>📧 Nuevo Mensaje de Contacto</h1>
        </div>

        <div class="alert">
            <strong>⚠️ Nuevo mensaje recibido en el formulario de contacto</strong>
        </div>

        <div class="info-box">
            <p><span class="info-label">Nombre:</span><br>{{ $name }}</p>
            <p><span class="info-label">Email:</span><br><a href="mailto:{{ $email }}" style="color: #0066CC; text-decoration: none;">{{ $email }}</a></p>
            @if($phone)
            <p><span class="info-label">Teléfono:</span><br>{{ $phone }}</p>
            @endif
            <p><span class="info-label">Asunto:</span><br>{{ $subject }}</p>
        </div>

        <h3 style="color: #333; margin-top: 30px;">Mensaje:</h3>
        <div class="message-content">{{ $message }}</div>

        <div style="text-align: center; margin-top: 30px;">
            <a href="mailto:{{ $email }}" class="button">Responder</a>
            <a href="https://costaricatrips.com/dashboard" class="button">Ir al Dashboard</a>
        </div>

        <div class="footer">
            <p style="margin: 0 0 10px 0;">Costa Rica Trip Packages</p>
            <p style="margin: 5px 0;">Sistema Automático de Contacto</p>
            <p style="margin-top: 15px; color: #ccc;">Este es un email automático. Por favor no responder a este mensaje.</p>
        </div>
    </div>
</body>
</html>
