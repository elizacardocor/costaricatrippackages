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
            border-bottom: 3px solid #00A86B;
            padding-bottom: 20px;
        }
        .header h1 {
            color: #00A86B;
            margin: 0;
            font-size: 28px;
        }
        .content {
            margin: 30px 0;
        }
        .greeting {
            font-size: 18px;
            color: #00A86B;
            font-weight: 600;
            margin-bottom: 15px;
        }
        .message {
            background-color: #f9f9f9;
            padding: 20px;
            border-left: 4px solid #00A86B;
            margin: 20px 0;
            border-radius: 5px;
        }
        .message p {
            margin: 0;
            color: #555;
        }
        .footer {
            text-align: center;
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            color: #999;
            font-size: 12px;
        }
        .social {
            text-align: center;
            margin: 20px 0;
        }
        .social a {
            display: inline-block;
            margin: 0 10px;
            color: #00A86B;
            text-decoration: none;
            font-weight: 500;
        }
        .button {
            display: inline-block;
            background-color: #00A86B;
            color: white;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🌴 Costa Rica Trips</h1>
        </div>

        <div class="content">
            <div class="greeting">¡Hola {{ $name }}!</div>

            <p>Gracias por contactarnos. Hemos recibido tu mensaje y nos complace informarte que está siendo procesado por nuestro equipo.</p>

            <div class="message">
                <p><strong>Tu mensaje:</strong></p>
                <p style="margin-top: 10px; color: #666;">{{ $userMessage }}</p>
            </div>

            <p>Nos responderemos en el menor tiempo posible, generalmente dentro de 24 horas. Si tu consulta es urgente, también puedes contactarnos directamente:</p>

            <p style="margin: 20px 0;">
                📞 <strong>WhatsApp:</strong> <a href="https://wa.me/50612345678" style="color: #00A86B; text-decoration: none;">+506 1234-5678</a><br>
                📧 <strong>Email:</strong> <a href="mailto:info@costaricatrips.com" style="color: #00A86B; text-decoration: none;">info@costaricatrips.com</a>
            </p>

            <p style="margin-top: 30px;">Mientras tanto, te invitamos a explorar nuestros tours:</p>
            <div style="text-align: center;">
                <a href="https://costaricatrips.com/tours" class="button">Ver Nuestros Tours</a>
            </div>
        </div>

        <div class="footer">
            <p style="margin: 0 0 10px 0;">Costa Rica Trip Packages</p>
            <p style="margin: 5px 0;">Avenida Central, San José, Costa Rica</p>
            <div class="social">
                <a href="#">Facebook</a> | 
                <a href="#">Instagram</a> | 
                <a href="#">Twitter</a>
            </div>
            <p style="margin-top: 15px; color: #ccc;">© 2025 Costa Rica Trip Packages. Todos los derechos reservados.</p>
        </div>
    </div>
</body>
</html>
