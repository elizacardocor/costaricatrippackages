#!/bin/bash

# Colores
GREEN='\033[0;32m'
BLUE='\033[0;34m'
YELLOW='\033[1;33m'
RED='\033[0;31m'
NC='\033[0m'

cat << 'EOF'

╔════════════════════════════════════════════════════════════════════════════╗
║                   🔧 SOLUCIÓN PASO A PASO - PÁGINA EN BLANCO             ║
╚════════════════════════════════════════════════════════════════════════════╝

PROBLEMA: No logro visualizar nada en http://localhost:8000/react-app

CAUSA MÁS COMÚN: 
  El servidor Vite no está detectando los cambios, o hay un error en la carga

SOLUCIÓN COMPLETA EN 5 PASOS:

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

PASO 1: Detener todos los servidores
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

En TODAS las terminales que tengas abiertas, presiona:
  Ctrl+C

Esto detendrá:
  • php artisan serve
  • npm run dev
  • Cualquier otro proceso

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

PASO 2: Limpiar caché y reinstalar dependencias
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

Abre UNA SOLA TERMINAL y ejecuta:

  cd /home/elizabeth/costaricatrippackages
  rm -rf node_modules/.vite
  npm install

Esto limpiará el caché de Vite y reinstalará las dependencias.

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

PASO 3: Verificar que los archivos clave existen y son correctos
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

Ejecuta estos comandos (uno por uno):

  # Verifica que app.js tiene React
  grep -q "import React" /home/elizabeth/costaricatrippackages/resources/js/app.js && echo "✅ app.js OK" || echo "❌ app.js FALTA React"

  # Verifica que App.jsx existe
  [ -f /home/elizabeth/costaricatrippackages/resources/js/components/App.jsx ] && echo "✅ App.jsx OK" || echo "❌ App.jsx NO EXISTE"

  # Verifica que react.blade.php existe
  [ -f /home/elizabeth/costaricatrippackages/resources/views/react.blade.php ] && echo "✅ react.blade.php OK" || echo "❌ react.blade.php NO EXISTE"

Si ves ❌, hay un problema con los archivos.

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

PASO 4: Iniciar los servidores NUEVAMENTE
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

Abre TERMINAL 1 y ejecuta:

  cd /home/elizabeth/costaricatrippackages
  php artisan serve

Deberías ver:
  Laravel development server started: http://127.0.0.1:8000

Abre TERMINAL 2 y ejecuta:

  cd /home/elizabeth/costaricatrippackages
  npm run dev

Deberías ver:
  VITE v5.4.21 ready in XXX ms
  ➜ Local: http://localhost:5173/

ESPERA 5 SEGUNDOS para que todo se estabilice.

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

PASO 5: Probar en el navegador
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

Abre el navegador y ve a:

  http://localhost:8000/react-app

Si SIGUE VIENDO BLANCO:

  1. Presiona F12 o Ctrl+Shift+I para abrir Developer Tools
  2. Ve a la pestaña "Console"
  3. Busca errores en ROJO
  4. Copia el error COMPLETO y míralo

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

SOLUCIONES SEGÚN EL ERROR QUE VEAS:

┌─────────────────────────────────────────────────────────────┐
│ ERROR: "Cannot find module" o "Module not found"            │
├─────────────────────────────────────────────────────────────┤
│ CAUSA: Falta algún archivo o importación incorrecta        │
│ SOLUCIÓN:                                                   │
│   1. Verifica rutas en los imports                         │
│   2. Verifica que el componente existe                     │
│   3. Reinstala node_modules                                │
└─────────────────────────────────────────────────────────────┘

┌─────────────────────────────────────────────────────────────┐
│ ERROR: "React is not defined"                               │
├─────────────────────────────────────────────────────────────┤
│ CAUSA: React no se importó correctamente                   │
│ SOLUCIÓN:                                                   │
│   Verifica que app.js tiene:                               │
│   import React from 'react';                               │
└─────────────────────────────────────────────────────────────┘

┌─────────────────────────────────────────────────────────────┐
│ ERROR: "Cannot read property 'getElementById' of null"     │
├─────────────────────────────────────────────────────────────┤
│ CAUSA: El elemento #react-app no existe en el HTML        │
│ SOLUCIÓN:                                                   │
│   Verifica react.blade.php tiene:                          │
│   <div id="react-app"></div>                               │
└─────────────────────────────────────────────────────────────┘

┌─────────────────────────────────────────────────────────────┐
│ ERROR: "@vite is not a function" en las rutas              │
├─────────────────────────────────────────────────────────────┤
│ CAUSA: Blade no reconoce la función @vite()               │
│ SOLUCIÓN:                                                   │
│   1. Verifica que vite.config.js existe                    │
│   2. Asegúrate de que npm run dev está corriendo          │
│   3. Recarga la página (Ctrl+Shift+R)                     │
└─────────────────────────────────────────────────────────────┘

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

CHECKLIST FINAL:

□ Presionaste Ctrl+C en todas las terminales
□ Ejecutaste "rm -rf node_modules/.vite"
□ Ejecutaste "npm install"
□ Iniciaste php artisan serve
□ Iniciaste npm run dev
□ Esperaste 5 segundos
□ Recargaste la página en el navegador (Ctrl+Shift+R)
□ Abriste la consola del navegador (F12)
□ NO hay errores en rojo en la consola

Si completaste todo y SIGUE SIN FUNCIONAR:

1. Copia el error EXACTO que ves en la consola
2. Verifica que recursos/js/app.js empieza con:
   import React from 'react';
3. Verifica que recursos/views/react.blade.php tiene:
   <div id="react-app"></div>

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

EOF
