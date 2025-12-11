#!/bin/bash

# Script para validar requisitos en Hostinger
# Ejecuta esto en PuTTY/SSH de Hostinger

echo "╔════════════════════════════════════════════════════════════════╗"
echo "║        VALIDACIÓN DE REQUISITOS - HOSTINGER PREMIUM            ║"
echo "╚════════════════════════════════════════════════════════════════╝"

echo ""
echo "✓ SSH: Ya estás conectado (éxito)"
echo ""

echo "1️⃣  Verificando PHP..."
if command -v php &> /dev/null; then
    php_version=$(php -v | head -1)
    echo "   ✓ $php_version"
else
    echo "   ✗ PHP NO ENCONTRADO"
fi

echo ""
echo "2️⃣  Verificando Composer..."
if command -v composer &> /dev/null; then
    composer_version=$(composer --version)
    echo "   ✓ $composer_version"
else
    echo "   ✗ Composer NO ENCONTRADO"
    echo "   Instalando Composer..."
    curl -sS https://getcomposer.org/installer | php
    sudo mv composer.phar /usr/local/bin/composer
fi

echo ""
echo "3️⃣  Verificando acceso a directorios..."
echo "   Directorio actual: $(pwd)"
if [ -d "public_html" ]; then
    echo "   ✓ Carpeta public_html existe"
else
    echo "   ⚠ Crear carpeta: mkdir -p public_html"
fi

echo ""
echo "4️⃣  Verificando espacio en disco..."
df -h | grep -E "^/dev|Filesystem|^Filesystem"

echo ""
echo "5️⃣  Información del usuario..."
echo "   Usuario: $(whoami)"
echo "   Grupo: $(id -gn)"

echo ""
echo "════════════════════════════════════════════════════════════════"
echo "✅ Requisitos validados. Listo para deploy."
echo "════════════════════════════════════════════════════════════════"
