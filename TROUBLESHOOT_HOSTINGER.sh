#!/bin/bash

# Script para diagnosticar problemas de enrutamiento en Hostinger
# Ejecuta esto DESPUÉS de haber ejecutado el script de diagnostico o deploy

DOMAIN_PATH="/home/u336394587/domains/costaricatrippackages.com"
GREEN='\033[0;32m'
RED='\033[0;31m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
PURPLE='\033[0;35m'
NC='\033[0m'

echo -e "${BLUE}╔════════════════════════════════════════════════════════════════╗${NC}"
echo -e "${BLUE}║       TROUBLESHOOTING - PROBLEMAS DE ENRUTAMIENTO              ║${NC}"
echo -e "${BLUE}╚════════════════════════════════════════════════════════════════╝${NC}"

cd "$DOMAIN_PATH" 2>/dev/null || { echo -e "${RED}✗ No se pudo acceder a $DOMAIN_PATH${NC}"; exit 1; }

# ============================================================================
# TEST 1: VERIFICAR MOD_REWRITE
# ============================================================================

echo -e "\n${BLUE}TEST 1: Verificar mod_rewrite en Apache${NC}\n"

echo -e "${YELLOW}Buscando Apache httpd:${NC}"

# Intentar varios métodos para verificar mod_rewrite
if command -v apache2ctl &> /dev/null; then
    echo -e "${YELLOW}Apache2 encontrado${NC}"
    echo "Módulos cargados que contienen 'rewrite':"
    apache2ctl -M 2>/dev/null | grep rewrite && echo -e "${GREEN}✓ mod_rewrite está habilitado${NC}" || echo -e "${RED}✗ mod_rewrite NO está habilitado${NC}"
elif command -v httpd &> /dev/null; then
    echo -e "${YELLOW}Httpd encontrado${NC}"
    echo "Módulos cargados que contienen 'rewrite':"
    httpd -M 2>/dev/null | grep rewrite && echo -e "${GREEN}✓ mod_rewrite está habilitado${NC}" || echo -e "${RED}✗ mod_rewrite NO está habilitado${NC}"
else
    echo -e "${YELLOW}⚠ No se encontró control de Apache${NC}"
    echo "Esto es normal en Hostinger (control simplificado)"
fi

# ============================================================================
# TEST 2: VERIFICAR ESTRUCTURA DE ARCHIVOS
# ============================================================================

echo -e "\n${BLUE}TEST 2: Estructura de archivos${NC}\n"

echo -e "${YELLOW}Archivos en directorio raíz:${NC}"
ls -la | head -15

echo -e "\n${YELLOW}Archivos en public/:${NC}"
ls -la public/ | head -15

echo -e "\n${YELLOW}¿Existe public/index.php?${NC}"
if [ -f "public/index.php" ]; then
    echo -e "${GREEN}✓ SÍ existe${NC}"
    echo "Tamaño: $(stat -f%z public/index.php 2>/dev/null || stat -c%s public/index.php 2>/dev/null)"
    echo "Primeras 15 líneas:"
    head -15 public/index.php
else
    echo -e "${RED}✗ NO existe${NC}"
    exit 1
fi

# ============================================================================
# TEST 3: VERIFICAR .HTACCESS
# ============================================================================

echo -e "\n${BLUE}TEST 3: Configuración .HTACCESS${NC}\n"

echo -e "${YELLOW}.htaccess en raíz:${NC}"
if [ -f ".htaccess" ]; then
    echo -e "${GREEN}✓ Existe${NC}"
    cat .htaccess
else
    echo -e "${RED}✗ NO existe${NC}"
fi

echo -e "\n${YELLOW}.htaccess en public/:${NC}"
if [ -f "public/.htaccess" ]; then
    echo -e "${GREEN}✓ Existe${NC}"
    cat public/.htaccess
else
    echo -e "${RED}✗ NO existe${NC}"
fi

# ============================================================================
# TEST 4: VERIFICAR PERMISOS
# ============================================================================

echo -e "\n${BLUE}TEST 4: Permisos de archivos críticos${NC}\n"

echo -e "${YELLOW}public/:${NC}"
ls -ld public/

echo -e "\n${YELLOW}public/index.php:${NC}"
ls -l public/index.php

echo -e "\n${YELLOW}storage/:${NC}"
ls -ld storage/

echo -e "\n${YELLOW}bootstrap/cache/:${NC}"
ls -ld bootstrap/cache/

# ============================================================================
# TEST 5: VERIFICAR .ENV
# ============================================================================

echo -e "\n${BLUE}TEST 5: Configuración .ENV${NC}\n"

if [ -f ".env" ]; then
    echo -e "${GREEN}✓ .env existe${NC}"
    echo -e "${YELLOW}Valores importantes:${NC}"
    grep "APP_KEY\|APP_DEBUG\|APP_URL\|APP_ENV" .env
else
    echo -e "${RED}✗ .env NO existe${NC}"
fi

# ============================================================================
# TEST 6: INTENTAR ACCESO DIRECTO A PHP
# ============================================================================

echo -e "\n${BLUE}TEST 6: Pruebas con curl${NC}\n"

echo -e "${YELLOW}Nota: Estos comandos deben ejecutarse desde LOCAL (no desde SSH)${NC}"
echo ""
echo -e "${YELLOW}Opción 1 - Acceso a raíz (debería redireccionar a /public/):${NC}"
echo "curl -v https://costaricatrippackages.com/ 2>&1 | head -30"
echo ""
echo -e "${YELLOW}Opción 2 - Acceso directo a public/:${NC}"
echo "curl -v https://costaricatrippackages.com/public/ 2>&1 | head -30"
echo ""
echo -e "${YELLOW}Opción 3 - Acceso directo a index.php:${NC}"
echo "curl -v https://costaricatrippackages.com/public/index.php 2>&1 | head -30"

# ============================================================================
# TEST 7: VERIFICAR LOGS
# ============================================================================

echo -e "\n${BLUE}TEST 7: Logs de Laravel${NC}\n"

if [ -d "storage/logs" ]; then
    echo -e "${GREEN}✓ storage/logs existe${NC}"
    
    if [ -f "storage/logs/laravel.log" ]; then
        echo -e "${YELLOW}Últimas 30 líneas de laravel.log:${NC}"
        tail -30 storage/logs/laravel.log
    else
        echo -e "${YELLOW}⚠ laravel.log aún no existe (se crea en primer error)${NC}"
    fi
else
    echo -e "${RED}✗ storage/logs NO existe${NC}"
fi

# ============================================================================
# TEST 8: ANÁLISIS DETALLADO
# ============================================================================

echo -e "\n${BLUE}TEST 8: Análisis detallado de rutas${NC}\n"

echo -e "${YELLOW}Contenido de routes/web.php:${NC}"
cat routes/web.php

# ============================================================================
# TEST 9: VERIFICAR COMPOSER
# ============================================================================

echo -e "\n${BLUE}TEST 9: Dependencias de Composer${NC}\n"

echo -e "${YELLOW}¿vendor/autoload.php existe?${NC}"
if [ -f "vendor/autoload.php" ]; then
    echo -e "${GREEN}✓ SÍ existe${NC}"
else
    echo -e "${RED}✗ NO existe${NC}"
    echo "Ejecuta: composer install --no-dev --optimize-autoloader"
fi

echo -e "\n${YELLOW}Contador de paquetes instalados:${NC}"
[ -d "vendor" ] && echo "Directorios en vendor: $(ls -1 vendor/ | wc -l)"

# ============================================================================
# TEST 10: RESUMEN Y RECOMENDACIONES
# ============================================================================

echo -e "\n${PURPLE}╔════════════════════════════════════════════════════════════════╗${NC}"
echo -e "${PURPLE}║              RESUMEN Y RECOMENDACIONES                         ║${NC}"
echo -e "${PURPLE}╚════════════════════════════════════════════════════════════════╝${NC}\n"

ISSUES_FOUND=0

[ ! -f "public/index.php" ] && { echo -e "${RED}✗ public/index.php NO existe${NC}"; ((ISSUES_FOUND++)); }
[ ! -f ".htaccess" ] && { echo -e "${RED}✗ .htaccess raíz NO existe${NC}"; ((ISSUES_FOUND++)); }
[ ! -f "public/.htaccess" ] && { echo -e "${RED}✗ public/.htaccess NO existe${NC}"; ((ISSUES_FOUND++)); }
[ ! -f ".env" ] && { echo -e "${RED}✗ .env NO existe${NC}"; ((ISSUES_FOUND++)); }
[ ! -f "vendor/autoload.php" ] && { echo -e "${RED}✗ Dependencias NO instaladas${NC}"; ((ISSUES_FOUND++)); }

if [ $ISSUES_FOUND -eq 0 ]; then
    echo -e "${GREEN}✓ Todos los archivos críticos existen${NC}"
    echo ""
    echo -e "${YELLOW}Próximos pasos:${NC}"
    echo "1. Abre tu navegador y ve a: https://costaricatrippackages.com/"
    echo "2. Si ves error 404 de Hostinger:"
    echo "   - El problema es que Apache no está ejecutando .htaccess"
    echo "   - Contacta a Hostinger para habilitar mod_rewrite en tu plan"
    echo "3. Si ves página en blanco o error Laravel:"
    echo "   - Revisa storage/logs/laravel.log"
    echo "   - Asegúrate de que APP_DEBUG=true en .env"
else
    echo -e "${RED}✗ Se encontraron $ISSUES_FOUND problemas${NC}"
    echo ""
    echo -e "${YELLOW}Soluciones:${NC}"
    [ ! -f "vendor/autoload.php" ] && echo "→ Ejecuta: composer install --no-dev --optimize-autoloader"
    [ ! -f ".env" ] && echo "→ Ejecuta: cp .env.example .env && php artisan key:generate"
    [ ! -f ".htaccess" ] || [ ! -f "public/.htaccess" ] && echo "→ Ejecuta los scripts de configuración nuevamente"
fi

echo ""
echo -e "${BLUE}════════════════════════════════════════════════════════════════${NC}\n"
