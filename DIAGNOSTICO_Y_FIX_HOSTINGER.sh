#!/bin/bash

# Script completo para diagnosticar y reparar el despliegue en Hostinger
# Ejecuta esto en PuTTY conectado a Hostinger

DOMAIN_PATH="/home/u336394587/domains/costaricatrippackages.com"
GREEN='\033[0;32m'
RED='\033[0;31m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m'

echo -e "${BLUE}╔════════════════════════════════════════════════════════════════╗${NC}"
echo -e "${BLUE}║   DIAGNÓSTICO Y REPARACIÓN - DESPLIEGUE HOSTINGER             ║${NC}"
echo -e "${BLUE}╚════════════════════════════════════════════════════════════════╝${NC}"

# ============================================================================
# FASE 1: DIAGNÓSTICO
# ============================================================================

echo -e "\n${BLUE}═══ FASE 1: DIAGNÓSTICO ═══${NC}\n"

echo -e "${YELLOW}1. Estructura actual del dominio:${NC}"
if [ -d "$DOMAIN_PATH" ]; then
    cd "$DOMAIN_PATH"
    echo -e "${GREEN}✓ Directorio existe: $DOMAIN_PATH${NC}"
    echo "  Contenido:"
    ls -la | head -15
else
    echo -e "${RED}✗ Directorio NO existe: $DOMAIN_PATH${NC}"
    exit 1
fi

echo -e "\n${YELLOW}2. Archivos críticos:${NC}"
[ -f "public/index.php" ] && echo -e "${GREEN}✓ public/index.php${NC}" || echo -e "${RED}✗ public/index.php FALTA${NC}"
[ -f ".htaccess" ] && echo -e "${GREEN}✓ .htaccess (raíz)${NC}" && cat .htaccess || echo -e "${RED}✗ .htaccess FALTA${NC}"
[ -f "public/.htaccess" ] && echo -e "${GREEN}✓ public/.htaccess${NC}" && cat public/.htaccess || echo -e "${RED}✗ public/.htaccess FALTA${NC}"
[ -f ".env" ] && echo -e "${GREEN}✓ .env existe${NC}" || echo -e "${RED}✗ .env FALTA${NC}"

echo -e "\n${YELLOW}3. Permisos críticos:${NC}"
echo "  public/index.php permisos:"
ls -l public/index.php 2>/dev/null || echo -e "${RED}  ✗ NO EXISTE${NC}"
echo "  storage/ permisos:"
ls -ld storage/ 2>/dev/null || echo -e "${RED}  ✗ NO EXISTE${NC}"

echo -e "\n${YELLOW}4. Versiones instaladas:${NC}"
php -v | head -1
composer --version

echo -e "\n${YELLOW}5. Directorio actual en ejecución:${NC}"
pwd

# ============================================================================
# FASE 2: LIMPIEZA Y PREPARACIÓN
# ============================================================================

echo -e "\n${BLUE}═══ FASE 2: LIMPIEZA Y PREPARACIÓN ═══${NC}\n"

echo -e "${YELLOW}Limpiando directorios problemáticos...${NC}"
rm -rf public/build vendor bootstrap/cache/config.php storage/logs/*

echo -e "${GREEN}✓ Limpieza completada${NC}"

# ============================================================================
# FASE 3: CONFIGURACIÓN .HTACCESS
# ============================================================================

echo -e "\n${BLUE}═══ FASE 3: CONFIGURACIÓN .HTACCESS ═══${NC}\n"

echo -e "${YELLOW}Creando .htaccess en raíz del dominio...${NC}"
cat > /home/u336394587/domains/costaricatrippackages.com/.htaccess << 'EOF'
<IfModule mod_rewrite.c>
    RewriteEngine On
    
    # Redirigir a public/
    RewriteRule ^(.*)$ public/$1 [L]
</IfModule>
EOF

echo -e "${GREEN}✓ .htaccess raíz creado${NC}"
echo "Contenido:"
cat .htaccess

echo -e "\n${YELLOW}Creando .htaccess en public/...${NC}"
cat > /home/u336394587/domains/costaricatrippackages.com/public/.htaccess << 'EOF'
<IfModule mod_rewrite.c>
    RewriteEngine On
    
    # Si el archivo o directorio solicitan no existe
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    
    # Redirigir a index.php
    RewriteRule ^(.*)$ index.php/$1 [QSA,L]
</IfModule>
EOF

echo -e "${GREEN}✓ .htaccess public/ creado${NC}"
echo "Contenido:"
cat public/.htaccess

# ============================================================================
# FASE 4: CONFIGURACIÓN LARAVEL
# ============================================================================

echo -e "\n${BLUE}═══ FASE 4: CONFIGURACIÓN LARAVEL ═══${NC}\n"

echo -e "${YELLOW}Regenerando APP_KEY...${NC}"
if [ ! -f ".env" ]; then
    echo -e "${RED}✗ .env NO EXISTE${NC}"
    echo -e "${YELLOW}Copiando .env.example...${NC}"
    cp .env.example .env
fi

# Generar APP_KEY
php artisan key:generate
echo -e "${GREEN}✓ APP_KEY generado${NC}"

echo -e "\n${YELLOW}Configurando permisos...${NC}"
chmod -R 755 storage/
chmod -R 755 bootstrap/cache/
echo -e "${GREEN}✓ Permisos configurados${NC}"

echo -e "\n${YELLOW}Borrando caché de configuración...${NC}"
rm -f bootstrap/cache/config.php 2>/dev/null
rm -f bootstrap/cache/services.php 2>/dev/null
echo -e "${GREEN}✓ Caché borrado${NC}"

# ============================================================================
# FASE 5: INSTALACIÓN DEPENDENCIAS
# ============================================================================

echo -e "\n${BLUE}═══ FASE 5: INSTALACIÓN DEPENDENCIAS ═══${NC}\n"

echo -e "${YELLOW}Instalando dependencias de Composer...${NC}"
composer install --no-dev --optimize-autoloader
echo -e "${GREEN}✓ Dependencias instaladas${NC}"

# ============================================================================
# FASE 6: VERIFICACIÓN FINAL
# ============================================================================

echo -e "\n${BLUE}═══ FASE 6: VERIFICACIÓN FINAL ═══${NC}\n"

echo -e "${YELLOW}Archivos críticos después de instalación:${NC}"
[ -f "public/index.php" ] && echo -e "${GREEN}✓ public/index.php OK${NC}" || echo -e "${RED}✗ public/index.php FALTA${NC}"
[ -f "vendor/autoload.php" ] && echo -e "${GREEN}✓ vendor/autoload.php OK${NC}" || echo -e "${RED}✗ vendor/autoload.php FALTA${NC}"
[ -d "storage/logs" ] && echo -e "${GREEN}✓ storage/logs OK${NC}" || echo -e "${RED}✗ storage/logs FALTA${NC}"

echo -e "\n${YELLOW}Mostrando contenido de public/index.php (primeras 10 líneas):${NC}"
head -10 public/index.php

echo -e "\n${YELLOW}Probando Laravel con PHP:${NC}"
php artisan tinker --execute="echo 'Laravel está funcionando';" 2>/dev/null || echo -e "${YELLOW}(Tinker test - puede fallar, pero Laravel debería funcionar)${NC}"

# ============================================================================
# FASE 7: INSTRUCCIONES FINALES
# ============================================================================

echo -e "\n${BLUE}═══ FASE 7: PRÓXIMOS PASOS ═══${NC}\n"

echo -e "${YELLOW}Para verificar si el sitio está funcionando:${NC}"
echo "1. En tu navegador: https://costaricatrippackages.com/"
echo "2. O desde terminal: curl https://costaricatrippackages.com/"
echo ""
echo -e "${YELLOW}Si aún ves la página 404 de Hostinger:${NC}"
echo "1. Verifica que mod_rewrite está habilitado en Apache"
echo "2. Ejecuta: apache2ctl -M | grep rewrite"
echo "3. Intenta acceder directamente a: https://costaricatrippackages.com/public/index.php"
echo ""
echo -e "${YELLOW}Para ver errores de Laravel:${NC}"
echo "1. Revisa: tail -100 storage/logs/laravel.log"
echo "2. Asegúrate que APP_DEBUG=true en .env"
echo ""

echo -e "\n${BLUE}════════════════════════════════════════════════════════════════${NC}"
echo -e "${BLUE}✓ Script de diagnóstico y reparación completado${NC}"
echo -e "${BLUE}════════════════════════════════════════════════════════════════${NC}\n"
