# 📐 Layout Master - Documentación de Uso

## 📍 Ubicación del Layout

**Archivo:** `resources/views/layouts/master.blade.php`

Este es el layout maestro que contiene:
- ✅ Navegación completa (navbar)
- ✅ Footer con enlaces y redes sociales
- ✅ Meta tags SEO (Open Graph, Twitter Cards)
- ✅ Estilos base reutilizables
- ✅ Scripts de navegación móvil
- ✅ Soporte multiidioma (ES/EN)

---

## 🎯 Cómo Usar el Layout

### 1. **Estructura Básica**

```blade
@extends('layouts.master')

@section('title', 'Título de la Página')

@section('content')
    <!-- Tu contenido aquí -->
@endsection
```

---

### 2. **Ejemplo Completo con SEO**

```blade
@extends('layouts.master')

@section('title', __('tours.listing_title'))
@section('meta_description', __('tours.listing_meta_description'))
@section('meta_keywords', 'tours, costa rica, paquetes')

@section('og_title', 'Tours en Costa Rica')
@section('og_description', 'Los mejores tours')
@section('og_image', asset('images/tours-og.jpg'))

@section('canonical')
<link rel="canonical" href="{{ url()->current() }}">
<link rel="alternate" hreflang="es" href="{{ route('tours.index.es') }}">
<link rel="alternate" hreflang="en" href="{{ route('tours.index.en') }}">
@endsection

@section('extra_styles')
<style>
    /* Estilos específicos de esta página */
    .mi-seccion {
        padding: 2rem;
    }
</style>
@endsection

@section('content')
<div class="mi-seccion">
    <h1>{{ __('tours.title') }}</h1>
    <p>Contenido de la página</p>
</div>
@endsection

@section('extra_scripts')
<script>
    // Scripts específicos de esta página
    console.log('Página cargada');
</script>
@endsection
```

---

## 📦 Secciones Disponibles

### **Obligatorias:**
- `@section('content')` - Contenido principal de la página

### **Opcionales (SEO):**
- `@section('title')` - Título del navegador
- `@section('meta_description')` - Meta descripción
- `@section('meta_keywords')` - Palabras clave
- `@section('og_title')` - Título Open Graph (Facebook)
- `@section('og_description')` - Descripción OG
- `@section('og_image')` - Imagen OG
- `@section('og_type')` - Tipo OG (default: 'website')
- `@section('twitter_title')` - Twitter Card título
- `@section('twitter_description')` - Twitter Card descripción
- `@section('twitter_image')` - Twitter Card imagen

### **Opcionales (Estructura):**
- `@section('canonical')` - URL canónica y hreflang
- `@section('extra_styles')` - Estilos adicionales
- `@section('extra_scripts')` - Scripts adicionales

### **Stacks (para múltiples adiciones):**
- `@push('styles')` ... `@endpush` - CSS adicional
- `@push('scripts')` ... `@endpush` - JS adicional

---

## 🎨 Estilos Base Incluidos

El layout incluye estas clases CSS globales:

### **Variables CSS:**
```css
--primary-color: #00A86B;   /* Verde Costa Rica */
--secondary-color: #0066CC; /* Azul */
--accent-color: #FF6B35;    /* Naranja */
--dark: #1a1a1a;
--light: #f8f9fa;
--gray: #6c757d;
```

### **Clases Útiles:**
- `.container` - Contenedor max-width 1200px centrado
- `.navbar` - Navegación fija superior
- `.footer` - Pie de página
- `.logo` - Logo de Costa Rica Trips

---

## 🔗 Navegación

La navegación incluye automáticamente:
- Inicio / Home
- Tours
- Hoteles / Hotels
- Transporte / Transport
- Contacto / Contact
- Dashboard
- Selector de idioma (ES/EN)

**Responsive:** Se colapsa en menú hamburguesa en móviles (<768px)

---

## 📱 Footer

El footer incluye 4 columnas:
1. **About** - Descripción de Costa Rica Trips
2. **Enlaces Rápidos** - Tours, Hoteles, Transporte, etc.
3. **Contacto** - Email, teléfono, ubicación
4. **Redes Sociales** - Facebook, Instagram, Twitter

---

## 🔄 Convertir Páginas Existentes

### **Antes (sin layout):**
```blade
<!DOCTYPE html>
<html>
<head>
    <title>Tours</title>
    <!-- 100 líneas de meta tags y estilos duplicados -->
</head>
<body>
    <!-- 50 líneas de navbar duplicado -->
    
    <div>
        <!-- Contenido real -->
    </div>
    
    <!-- 80 líneas de footer duplicado -->
</body>
</html>
```

### **Después (con layout):**
```blade
@extends('layouts.master')

@section('title', 'Tours')

@section('content')
    <div>
        <!-- Contenido real -->
    </div>
@endsection
```

**Reducción:** ~230 líneas → ~10 líneas ✅

---

## 📋 Checklist de Migración

Para migrar una página existente al layout:

1. ✅ Extraer el contenido principal (entre nav y footer)
2. ✅ Copiar meta tags al `@section` correspondiente
3. ✅ Mover estilos específicos a `@section('extra_styles')`
4. ✅ Mover scripts específicos a `@section('extra_scripts')`
5. ✅ Eliminar navbar y footer (ya están en master)
6. ✅ Probar en navegador

---

## 📄 Archivos para Migrar

### **Alta Prioridad:**
- ✅ `tours/index.blade.php` - EJEMPLO CREADO
- ⏳ `tours/show.blade.php`
- ⏳ `hotels/index.blade.php`
- ⏳ `hotels/show.blade.php`
- ⏳ `transports/index.blade.php`
- ⏳ `transports/show.blade.php`
- ⏳ `contacto.blade.php`

### **Media Prioridad:**
- ⏳ `landings/hotels.blade.php`
- ⏳ `landings/tours.blade.php`
- ⏳ `landings/transport.blade.php`
- ⏳ `listings/create.blade.php`

### **Baja Prioridad (casos especiales):**
- ⏳ `home.blade.php` - Tiene estructura única con slider
- ⏳ `dashboard-mui.blade.php` - Es React, no necesita layout

---

## 🎯 Beneficios

1. **Mantenimiento:** Cambiar nav/footer una sola vez afecta todas las páginas
2. **Consistencia:** Mismo diseño en todo el sitio
3. **SEO:** Meta tags centralizados
4. **Performance:** Menos duplicación de código
5. **Productividad:** Nuevas páginas en minutos

---

## 🚀 Próximos Pasos

1. Revisar el archivo `resources/views/tours/index-ejemplo.blade.php`
2. Migrar páginas una por una al nuevo layout
3. Probar cada página después de migrar
4. Eliminar código duplicado de las páginas antiguas

---

**Autor:** GitHub Copilot  
**Fecha:** Febrero 2026  
**Proyecto:** Costa Rica Trip Packages
