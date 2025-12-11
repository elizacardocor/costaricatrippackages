#!/bin/bash

# Script para despliegue LIMPIO desde cero en Hostinger
# Opción alternativa si el diagnóstico no resuelve el problema
# Ejecuta esto en PuTTY conectado a Hostinger

DOMAIN_PATH="/home/u336394587/domains/costaricatrippackages.com"
GREEN='\033[0;32m'
RED='\033[0;31m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m'

echo -e "${BLUE}╔════════════════════════════════════════════════════════════════╗${NC}"
echo -e "${BLUE}║          DESPLIEGUE LIMPIO - CLONACIÓN DESDE GITHUB            ║${NC}"
echo -e "${BLUE}╚════════════════════════════════════════════════════════════════╝${NC}"

# ============================================================================
# PASO 1: RESPALDO Y LIMPIEZA
# ============================================================================

echo -e "\n${BLUE}PASO 1: Respaldo y limpieza${NC}\n"

cd "$DOMAIN_PATH"

echo -e "${YELLOW}Creando respaldo de archivos existentes...${NC}"
if [ -d ".git" ]; then
    echo "  → Respaldando .git"
    cp -r .git /tmp/.git_backup_$(date +%s) 2>/dev/null
fi

echo -e "${YELLOW}Limpiando directorio...${NC}"
find . -maxdepth 1 -not -name '.' -not -name '..' -exec rm -rf {} \; 2>/dev/null || true
echo -e "${GREEN}✓ Directorio limpio${NC}"

# ============================================================================
# PASO 2: CLONACIÓN DESDE GITHUB
# ============================================================================

echo -e "\n${BLUE}PASO 2: Clonación desde GitHub${NC}\n"

echo -e "${YELLOW}Clonando repositorio...${NC}"
git clone https://github.com/elizacardocor/costaricatrippackages.git .

if [ $? -eq 0 ]; then
    echo -e "${GREEN}✓ Repositorio clonado correctamente${NC}"
else
    echo -e "${RED}✗ Error clonando repositorio${NC}"
    exit 1
fi

# ============================================================================
# PASO 3: CONFIGURACIÓN INICIAL
# ============================================================================

echo -e "\n${BLUE}PASO 3: Configuración inicial${NC}\n"

echo -e "${YELLOW}Copiando .env.example a .env...${NC}"
cp .env.example .env
echo -e "${GREEN}✓ .env creado${NC}"

echo -e "\n${YELLOW}Instalando dependencias de Composer...${NC}"
composer install --no-dev --optimize-autoloader
if [ $? -eq 0 ]; then
    echo -e "${GREEN}✓ Dependencias instaladas${NC}"
else
    echo -e "${RED}✗ Error instalando dependencias${NC}"
    exit 1
fi

# ============================================================================
# PASO 4: GENERACIÓN DE APP_KEY
# ============================================================================

echo -e "\n${BLUE}PASO 4: Generación de APP_KEY${NC}\n"

echo -e "${YELLOW}Generando clave de aplicación...${NC}"
php artisan key:generate
echo -e "${GREEN}✓ APP_KEY generado${NC}"

# ============================================================================
# PASO 5: PERMISOS Y DIRECTORIOS
# ============================================================================

echo -e "\n${BLUE}PASO 5: Configuración de permisos${NC}\n"

echo -e "${YELLOW}Configurando permisos de directorios críticos...${NC}"
chmod -R 755 storage/
chmod -R 755 bootstrap/cache/
echo -e "${GREEN}✓ Permisos configurados${NC}"

echo -e "${YELLOW}Limpiando caché...${NC}"
rm -f bootstrap/cache/config.php
rm -f bootstrap/cache/services.php
echo -e "${GREEN}✓ Caché limpio${NC}"

# ============================================================================
# PASO 6: CONFIGURACIÓN .HTACCESS
# ============================================================================

echo -e "\n${BLUE}PASO 6: Configuración .HTACCESS${NC}\n"

echo -e "${YELLOW}Creando .htaccess en raíz...${NC}"
cat > "$DOMAIN_PATH/.htaccess" << 'HTACCESS_ROOT'
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteRule ^(.*)$ public/$1 [L]
</IfModule>
HTACCESS_ROOT
echo -e "${GREEN}✓ .htaccess raíz creado${NC}"

echo -e "\n${YELLOW}Creando .htaccess en public/...${NC}"
cat > "$DOMAIN_PATH/public/.htaccess" << 'HTACCESS_PUBLIC'
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteRule ^(.*)$ index.php/$1 [QSA,L]
</IfModule>
HTACCESS_PUBLIC
echo -e "${GREEN}✓ .htaccess public/ creado${NC}"

# ============================================================================
# PASO 7: VERIFICACIÓN
# ============================================================================

echo -e "\n${BLUE}PASO 7: Verificación${NC}\n"

echo -e "${YELLOW}Verificando archivos críticos:${NC}"
[ -f "public/index.php" ] && echo -e "${GREEN}✓ public/index.php${NC}" || echo -e "${RED}✗ public/index.php FALTA${NC}"
[ -f "vendor/autoload.php" ] && echo -e "${GREEN}✓ vendor/autoload.php${NC}" || echo -e "${RED}✗ vendor/autoload.php FALTA${NC}"
[ -f ".env" ] && echo -e "${GREEN}✓ .env${NC}" || echo -e "${RED}✗ .env FALTA${NC}"
[ -f ".htaccess" ] && echo -e "${GREEN}✓ .htaccess (raíz)${NC}" || echo -e "${RED}✗ .htaccess (raíz) FALTA${NC}"
[ -f "public/.htaccess" ] && echo -e "${GREEN}✓ public/.htaccess${NC}" || echo -e "${RED}✗ public/.htaccess FALTA${NC}"

echo -e "\n${YELLOW}Estructura de directorios:${NC}"
ls -la | grep -E "^d" | head -10

# ============================================================================
# PASO 8: PRUEBA INICIAL
# ============================================================================

echo -e "\n${BLUE}PASO 8: Prueba inicial${NC}\n"

echo -e "${YELLOW}Mostrando contenido de .env (sin valores sensibles):${NC}"
grep "APP_KEY\|APP_DEBUG\|APP_URL" .env

echo -e "\n${YELLOW}Información del servidor:${NC}"
echo "PHP: $(php -v | head -1)"
echo "Composer: $(composer --version)"
echo "Directorio: $(pwd)"
echo "Usuario: $(whoami)"

# ============================================================================
# PASO 9: INSTRUCCIONES FINALES
# ============================================================================

echo -e "\n${BLUE}╔════════════════════════════════════════════════════════════════╗${NC}"
echo -e "${BLUE}║             DESPLIEGUE COMPLETADO - PRÓXIMOS PASOS             ║${NC}"
echo -e "${BLUE}╚════════════════════════════════════════════════════════════════╝${NC}\n"

echo -e "${YELLOW}1. Verifica en tu navegador:${NC}"
echo "   https://costaricatrippackages.com/"
echo ""

echo -e "${YELLOW}2. Si ves error 404 de Hostinger:${NC}"
echo "   - Ejecuta: curl -v https://costaricatrippackages.com/ 2>&1 | head -30"
echo "   - Verifica: tail -50 storage/logs/laravel.log"
echo ""

echo -e "${YELLOW}3. Si ves página en blanco o error Laravel:${NC}"
echo "   - Ejecuta: tail -100 storage/logs/laravel.log"
echo "   - Edita .env: APP_DEBUG=true"
echo ""

echo -e "${YELLOW}4. Para validar estructura:${NC}"
echo "   - Ejecuta: find . -name 'index.php' -type f"
echo "   - Debe mostrar: ./public/index.php"
echo ""

echo -e "${GREEN}✓ Script completado exitosamente${NC}\n"
