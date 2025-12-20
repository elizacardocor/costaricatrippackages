# 📚 Sistema de Idiomas Multilingüe - Documentación Completa

## Tabla de Contenidos
1. [Arquitectura General](#arquitectura-general)
2. [Componentes Principales](#componentes-principales)
3. [Flujo de Funcionamiento](#flujo-de-funcionamiento)
4. [Rutas Multiidioma](#rutas-multiidioma)
5. [Archivos de Traducción](#archivos-de-traducción)
6. [Uso en Vistas](#uso-en-vistas)
7. [Cambio de Idioma](#cambio-de-idioma)
8. [Ejemplos Prácticos](#ejemplos-prácticos)

---

## Arquitectura General

El sistema multiidioma de Costa Rica Trip Packages está basado en **3 pilares principales:**

```
┌─────────────────────────────────────────────────────┐
│          URL CON LOCALE (es/en)                     │
│   /es/provincia/guanacaste/destino/arenal/hotel/... │
│   /en/province/guanacaste/destination/arenal/hotel/ │
└──────────────────┬──────────────────────────────────┘
                   │
                   ▼
┌─────────────────────────────────────────────────────┐
│      MIDDLEWARE: SetLocale.php                      │
│  - Extrae idioma de la URL                         │
│  - Establece app()->setLocale()                     │
│  - Comparte con todas las vistas                    │
└──────────────────┬──────────────────────────────────┘
                   │
                   ▼
┌─────────────────────────────────────────────────────┐
│      ARCHIVOS DE TRADUCCIÓN                         │
│  resources/lang/es/hotels.php                       │
│  resources/lang/en/hotels.php                       │
│  resources/lang/es/tours.php                        │
│  resources/lang/en/tours.php                        │
└──────────────────┬──────────────────────────────────┘
                   │
                   ▼
┌─────────────────────────────────────────────────────┐
│      VISTAS BLADE                                   │
│  {{ __('hotels.amenities') }}                       │
│  Carga automáticamente el idioma correcto           │
└─────────────────────────────────────────────────────┘
```

---

## Componentes Principales

### 1. **SetLocale Middleware** (`app/Http/Middleware/SetLocale.php`)

```php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetLocale
{
    public function handle(Request $request, Closure $next)
    {
        // Extrae el primer segmento de la URL
        $locale = $request->segment(1);  // Obtiene 'es' o 'en'
        
        // Valida que sea un idioma soportado
        if (in_array($locale, ['es', 'en'])) {
            app()->setLocale($locale);  // Establece para toda la app
            $request->attributes->set('locale', $locale);  // Guarda en request
        } else {
            app()->setLocale('es');  // Default: Español
            $request->attributes->set('locale', 'es');
        }

        // Comparte la variable $locale con TODAS las vistas
        view()->share('locale', app()->getLocale());

        return $next($request);
    }
}
```

**¿Qué hace?**

1. **`$request->segment(1)`** → Obtiene el 1er segmento de la URL
   - URL: `/es/provincia/...` → `segment(1)` = `'es'`
   - URL: `/en/province/...` → `segment(1)` = `'en'`

2. **`app()->setLocale($locale)`** → Dice a Laravel qué idioma usar
   - Afecta al helper `__()` (traducción)
   - Afecta a funciones de formateo de fechas/números

3. **`view()->share('locale', ...)`** → Disponible en TODAS las vistas como `$locale`

---

### 2. **Rutas Multiidioma** (`routes/web.php`)

```php
// Landing pages (para todos)
Route::get('/es/hoteles-volcan-arenal', function () {
    return view('landings.hotels');
})->name('landing.hotels.es');

Route::get('/en/hotels-volcano-arenal', function () {
    return view('landings.hotels');
})->name('landing.hotels.en');

// Rutas de detalle con slugs
Route::middleware('locale')->group(function () {
    // ESPAÑOL
    Route::get('/es/provincia/{province_slug}/destino/{destination_slug}/hotel/{hotel_slug}',
        [HotelController::class, 'show'])
        ->name('hotel.show.es');

    // INGLÉS
    Route::get('/en/province/{province_slug}/destination/{destination_slug}/hotel/{hotel_slug}',
        [HotelController::class, 'show'])
        ->name('hotel.show.en');
});
```

**Estructura de URLs:**

| Idioma | Tipo | URL |
|--------|------|-----|
| Español | Destino | `/es/provincia/guanacaste/destino/arenal` |
| Inglés | Destination | `/en/province/guanacaste/destination/arenal` |
| Español | Hotel | `/es/provincia/guanacaste/destino/arenal/hotel/la-fortuna-resort` |
| Inglés | Hotel | `/en/province/guanacaste/destination/arenal/hotel/la-fortuna-resort` |
| Español | Tour | `/es/provincia/guanacaste/destino/arenal/tour/arenal-volcano` |
| Inglés | Tour | `/en/province/guanacaste/destination/arenal/tour/arenal-volcano` |

---

## Flujo de Funcionamiento

### Paso a Paso: ¿Qué ocurre cuando visitas `/es/provincia/guanacaste/destino/arenal/hotel/la-fortuna-resort`?

```
1. USUARIO ACCEDE A URL
   ↓
   /es/provincia/guanacaste/destino/arenal/hotel/la-fortuna-resort
   
2. LARAVEL IDENTIFICA LA RUTA
   ↓
   Coincide con: /es/provincia/{province_slug}/destino/{destination_slug}/hotel/{hotel_slug}
   ↓
   Parámetros:
   - province_slug = "guanacaste"
   - destination_slug = "arenal"
   - hotel_slug = "la-fortuna-resort"

3. EJECUTA MIDDLEWARE SetLocale
   ↓
   $locale = request()->segment(1)  // "es"
   app()->setLocale('es')           // Establece idioma = Español
   view()->share('locale', 'es')    // Comparte con vistas

4. LLAMA AL CONTROLLER
   ↓
   HotelController::show($province_slug, $destination_slug, $hotel_slug)
   ↓
   $locale = request()->segment(1)  // "es" de nuevo (para ser seguro)
   return view('hotels.show', [
       'locale' => 'es',
       'province_slug' => 'guanacaste',
       'destination_slug' => 'arenal',
       'hotel_slug' => 'la-fortuna-resort',
       'hotel' => $hotel
   ]);

5. CARGA LA VISTA: resources/views/hotels/show.blade.php
   ↓
   @extends('layouts.app')
   {{ __('hotels.amenities') }}  // Busca en resources/lang/es/hotels.php

6. LARAVEL BUSCA LA TRADUCCIÓN
   ↓
   Abre: resources/lang/es/hotels.php
   Busca la clave: 'amenities'
   Encuentra: 'amenities' => 'Amenidades'
   ↓
   Retorna: "Amenidades"

7. RENDERIZA LA VISTA AL USUARIO
   ↓
   <h5>Amenidades</h5>
```

---

## Rutas Multiidioma

### URLs en Español (provincia / destino)

```
/es/hoteles-volcan-arenal                                    (Landing)
/es/provincia/guanacaste/destino/arenal                      (Destination)
/es/provincia/guanacaste/destino/arenal/hotel/la-fortuna-resort    (Hotel detail)
/es/provincia/guanacaste/destino/arenal/tour/arenal-volcano        (Tour detail)
/es/provincia/guanacaste/destino/arenal/transport/private-suv      (Transport detail)
```

### URLs en Inglés (province / destination)

```
/en/hotels-volcano-arenal                                    (Landing)
/en/province/guanacaste/destination/arenal                   (Destination)
/en/province/guanacaste/destination/arenal/hotel/la-fortuna-resort    (Hotel detail)
/en/province/guanacaste/destination/arenal/tour/arenal-volcano          (Tour detail)
/en/province/guanacaste/destination/arenal/transport/private-suv        (Transport detail)
```

### Naming: ¿Por qué "provincia" en español y "province" en inglés?

Es una decisión SEO:
- Las URLs en español usan palabras clave en español
- Las URLs en inglés usan palabras clave en inglés
- Ayuda a Google a entender en qué idioma está cada página
- Mejora el posicionamiento en búsquedas locales

---

## Archivos de Traducción

### Estructura

```
resources/lang/
├── es/
│   ├── landings.php      (Para landing pages)
│   ├── hotels.php        (Para vistas de hoteles)
│   ├── tours.php         (Para vistas de tours)
│   └── transports.php    (Para vistas de transporte)
└── en/
    ├── landings.php
    ├── hotels.php
    ├── tours.php
    └── transports.php
```

### Ejemplo: resources/lang/es/hotels.php

```php
<?php

return [
    'title' => 'Hoteles',
    'gallery' => 'Galería de Imágenes',
    'amenities' => 'Amenidades',
    'reviews' => 'Reseñas de Huéspedes',
    'price_from' => 'Desde',
    'per_night' => 'por noche',
    'book_now' => 'Reservar Ahora',
    'check_in' => 'Entrada',
    'check_out' => 'Salida',
    'guests' => 'Huéspedes',
    'contact_info' => 'Información de Contacto',
    'phone' => 'Teléfono',
    'email' => 'Correo Electrónico',
];
```

### Ejemplo: resources/lang/en/hotels.php

```php
<?php

return [
    'title' => 'Hotels',
    'gallery' => 'Image Gallery',
    'amenities' => 'Amenities',
    'reviews' => 'Guest Reviews',
    'price_from' => 'From',
    'per_night' => 'per night',
    'book_now' => 'Book Now',
    'check_in' => 'Check-in',
    'check_out' => 'Check-out',
    'guests' => 'Guests',
    'contact_info' => 'Contact Information',
    'phone' => 'Phone',
    'email' => 'Email',
];
```

**¿Cómo funciona?**

- Es un archivo PHP que retorna un array
- Clave: `'amenities'`
- Valor en español: `'Amenidades'`
- Valor en inglés: `'Amenities'`

---

## Uso en Vistas

### Método 1: Helper `__()` (Recomendado)

```blade
<!-- Carga automáticamente según el idioma actual -->
<h5>{{ __('hotels.amenities') }}</h5>

<!-- Si $locale = 'es' → Muestra: Amenidades -->
<!-- Si $locale = 'en' → Muestra: Amenities -->
```

### Método 2: Variable `$locale`

```blade
<!-- Útil para lógica condicional -->
@if($locale === 'es')
    <h5>Amenidades</h5>
@else
    <h5>Amenities</h5>
@endif

<!-- O usar ternario -->
<label>{{ $locale === 'es' ? 'Entrada' : 'Check-in' }}</label>
```

### Método 3: En los Botones de Cambio de Idioma

```blade
@if($locale === 'es')
    <!-- Mostrar botón de Inglés -->
    <a href="/en/province/{{ $province_slug }}/destination/{{ $destination_slug }}/hotel/{{ $hotel_slug }}">
        🇬🇧 English
    </a>
@else
    <!-- Mostrar botón de Español -->
    <a href="/es/provincia/{{ $province_slug }}/destino/{{ $destination_slug }}/hotel/{{ $hotel_slug }}">
        🇪🇸 Español
    </a>
@endif
```

---

## Cambio de Idioma

### En las Landing Pages

**Footer con botón de idioma:**

```blade
<footer>
    <div style="display: flex; justify-content: space-between; gap: 1rem;">
        <div>
            <p>&copy; 2025 Costa Rica Trip Packages</p>
        </div>
        <div>
            @if(app()->getLocale() === 'es')
                <a href="{{ route('landing.hotels.en') }}" class="btn btn-warning">
                    🇬🇧 English
                </a>
            @else
                <a href="{{ route('landing.hotels.es') }}" class="btn btn-warning">
                    🇪🇸 Español
                </a>
            @endif
        </div>
    </div>
</footer>
```

### En las Vistas de Detalle

**Botón en la esquina superior:**

```blade
<div style="display: flex; justify-content: flex-end; margin-bottom: 1rem;">
    @if($locale === 'es')
        <a href="/en/province/{{ $province_slug }}/destination/{{ $destination_slug }}/hotel/{{ $hotel_slug }}"
           class="btn btn-sm btn-warning">
            🇬🇧 English
        </a>
    @else
        <a href="/es/provincia/{{ $province_slug }}/destino/{{ $destination_slug }}/hotel/{{ $hotel_slug }}"
           class="btn btn-sm btn-warning">
            🇪🇸 Español
        </a>
    @endif
</div>
```

### En la Navbar (Layout App)

```blade
<li class="nav-item">
    @if($locale === 'es')
        <a class="nav-link btn btn-sm btn-warning" href="/en/...">
            🇬🇧 English
        </a>
    @else
        <a class="nav-link btn btn-sm btn-warning" href="/es/...">
            🇪🇸 Español
        </a>
    @endif
</li>
```

---

## Ejemplos Prácticos

### Ejemplo 1: Página de Hotel en Español

**URL:** `/es/provincia/guanacaste/destino/arenal/hotel/la-fortuna-resort`

**Lo que ocurre:**

```
1. SetLocale extrae: 'es'
2. app()->setLocale('es')
3. Vista carga: hotels.show.blade.php
4. {{ __('hotels.amenities') }} → Busca en resources/lang/es/hotels.php
5. Resultado: <h5>Amenidades</h5>
```

**Vista renderizada:**

```html
<h5>Amenidades</h5>
<ul>
    <li>🏊 Piscina</li>
    <li>📡 WiFi Gratis</li>
    <li>🍽️ Restaurante</li>
</ul>
```

---

### Ejemplo 2: Página de Hotel en Inglés

**URL:** `/en/province/guanacaste/destination/arenal/hotel/la-fortuna-resort`

**Lo que ocurre:**

```
1. SetLocale extrae: 'en'
2. app()->setLocale('en')
3. Vista carga: hotels.show.blade.php (MISMA VISTA)
4. {{ __('hotels.amenities') }} → Busca en resources/lang/en/hotels.php
5. Resultado: <h5>Amenities</h5>
```

**Vista renderizada:**

```html
<h5>Amenities</h5>
<ul>
    <li>🏊 Swimming Pool</li>
    <li>📡 Free WiFi</li>
    <li>🍽️ Restaurant</li>
</ul>
```

**¡La MISMA Vista en dos idiomas diferentes!**

---

### Ejemplo 3: Cambiar de Idioma

**Usuario está viendo la página en español:**

```
/es/provincia/guanacaste/destino/arenal/hotel/la-fortuna-resort
↓
Ve un botón: "🇬🇧 English"
↓
Hace clic
↓
Navega a: /en/province/guanacaste/destination/arenal/hotel/la-fortuna-resort
↓
SetLocale extrae 'en'
↓
La página se refresca con textos en inglés
```

---

## Ventajas de esta Arquitectura

### 1. **Reutilización de Vistas**

No necesitas vistas separadas para cada idioma:

```
❌ Evita:
resources/views/es/hotels/show.blade.php
resources/views/en/hotels/show.blade.php

✅ Usa:
resources/views/hotels/show.blade.php  (Una sola vista para ambos idiomas)
```

### 2. **SEO Optimizado**

- URLs contienen palabras clave en el idioma correcto
- Google entiende en qué idioma está cada página
- hreflang tags ayudan a los buscadores

### 3. **Mantenimiento Centralizado**

Todo el texto traducido en un único lugar:

```
resources/lang/es/hotels.php
resources/lang/en/hotels.php
```

### 4. **Escalable**

Para agregar un nuevo idioma (ej: francés):

```
1. Crear: resources/lang/fr/hotels.php
2. Crear: resources/lang/fr/tours.php
3. Crear rutas: /fr/province/{slug}/...
4. ¡Listo! Las vistas funcionan automáticamente
```

---

## Funciones Útiles

### `app()->getLocale()`

Obtiene el idioma actual:

```blade
{{ app()->getLocale() }}  <!-- 'es' o 'en' -->
```

### `__('key')`

Traduce un texto:

```blade
{{ __('hotels.amenities') }}  <!-- 'Amenidades' o 'Amenities' -->
```

### `trans('key')`

Alias de `__()`:

```blade
{{ trans('hotels.amenities') }}  <!-- Mismo que arriba -->
```

### `trans_choice('key', count)`

Para plurales (avanzado):

```php
// resources/lang/es/hotels.php
'reviews_count' => '{0} Sin reseñas|{1} Una reseña|[2,*] :count reseñas'

// Vista
{{ trans_choice('hotels.reviews_count', 5) }}  <!-- "5 reseñas" -->
```

---

## Cheat Sheet Rápido

| Necesidad | Código |
|-----------|--------|
| Obtener idioma actual | `app()->getLocale()` o `$locale` |
| Traducir un texto | `{{ __('hotels.amenities') }}` |
| Cambiar a otra URL | `/en/province/...` o `/es/provincia/...` |
| Verificar idioma | `@if($locale === 'es')` |
| Traducción ternaria | `{{ $locale === 'es' ? 'Sí' : 'Yes' }}` |
| Agregar más idiomas | Crear más carpetas en `resources/lang/` |

---

## Debugging

### Ver el idioma actual

```blade
<!-- En cualquier vista -->
Idioma actual: {{ app()->getLocale() }}
Variable $locale: {{ $locale }}
```

### Ver disponibilidad de traducción

```php
// En el controlador
dd(trans('hotels.amenities'));  // Muestra la traducción
dd(trans_get('hotels.amenities'));  // Alternativa
```

### Verificar archivos de traducción

```bash
# Listar todos los archivos de idiomas
ls -la resources/lang/
ls -la resources/lang/es/
ls -la resources/lang/en/
```

---

## Conclusión

El sistema multiidioma de Costa Rica Trip Packages:

✅ **Automático:** La misma vista funciona en múltiples idiomas  
✅ **SEO-friendly:** URLs optimizadas para cada idioma  
✅ **Escalable:** Fácil agregar nuevos idiomas  
✅ **Centralizado:** Traducciones en un lugar  
✅ **Profesional:** Soporta caracteres especiales y formatos locales  

**Gracias al middleware SetLocale, los archivos de traducción y el helper `__()`, tu aplicación es completamente multilingüe sin duplicar código.**

