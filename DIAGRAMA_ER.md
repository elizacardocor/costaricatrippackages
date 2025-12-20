# 📊 Diagrama Entidad-Relación (ER)
## Costa Rica Trip Packages - Base de Datos

**Fecha:** Diciembre 19, 2025  
**Versión:** 1.0  
**Estado:** Aprobado para Implementación

---

## 🗺️ Estructura General

```
╔════════════════════════════════════════════════════════════════════════════╗
║                    COSTA RICA TRIP PACKAGES - ESTRUCTURA                   ║
╚════════════════════════════════════════════════════════════════════════════╝

                              ┌─────────────────┐
                              │   PROVINCES     │
                              │─────────────────│
                              │ id (PK)         │
                              │ name            │
                              │ slug            │
                              │ description     │
                              │ image_url       │
                              │ latitude        │
                              │ longitude       │
                              └────────┬────────┘
                                       │ 1:N
                                       │
                    ┌──────────────────┴──────────────────┐
                    │                                     │
                    ▼                                     ▼
        ┌──────────────────────┐            ┌──────────────────────┐
        │   DESTINATIONS       │            │      RATE_TYPES      │
        │──────────────────────│            │──────────────────────│
        │ id (PK)              │            │ id (PK)              │
        │ province_id (FK)     │            │ name                 │
        │ name                 │            │ slug                 │
        │ slug                 │            │ color                │
        │ description          │            └──────────┬───────────┘
        │ image_url            │                       │ 1:N
        │ latitude             │                       │
        │ longitude            │                       ▼
        └──────┬───────────────┘            ┌──────────────────────┐
               │ M:N (via pivots)           │     PRICING          │
               │ (4 pivots)                 │──────────────────────│
               │                            │ id (PK)              │
    ┌──────────┼──────────┬────────────┐   │ service_type (enum)  │
    │          │          │            │   │ service_id (FK)      │
    │          │          │            │   │ rate_type_id (FK)    │
    │          │          │            │   │ price                │
    │          │          │            │   │ start_date           │
    ▼          ▼          ▼            ▼   │ end_date             │
┌──────┐  ┌─────────┐ ┌────────┐  ┌──────┐│ min_nights           │
│HOTELS│  │  TOURS  │ │TRANSPORT  │OPERATORS││ active               │
└──────┘  └─────────┘ └────────┘  └──────┘└──────────────────────┘
    │          │          │            │
    │          │          │            │
    │          │          │            │ 1:N
    │          │          │            │
    │ 1:N      │ 1:N      │ 1:N        ▼
    │          │          │      ┌──────────────────────┐
    │          │          │      │TOUR_OPERATORS       │
    │          │          │      │──────────────────────│
    │          │          │      │ id (PK)              │
    │          │          │      │ name                 │
    │          │          │      │ slug                 │
    │          │          │      │ description          │
    │          │          │      │ phone                │
    │          │          │      │ email                │
    │          │          │      │ website              │
    │          │          │      │ rating               │
    │          │          │      │ commission_percentage│
    │          │          │      │ status               │
    │          │          │      └──────────────────────┘
    │          │          │
    │          │ 1:N      │
    │          │          ▼
    │          │      ┌──────────────────────┐
    │          │      │     TOURS            │
    │          │      │──────────────────────│
    │          │      │ id (PK)              │
    │          │      │ tour_operator_id(FK) │
    │          │      │ name                 │
    │          │      │ slug                 │
    │          │      │ description          │
    │          │      │ commission_percentage│
    │          │      │ duration_hours       │
    │          │      │ start_time           │
    │          │      │ max_capacity         │
    │          │      │ difficulty           │
    │          │      │ languages            │
    │          │      │ includes             │
    │          │      │ itinerary            │
    │          │      │ rating               │
    │          │      │ status               │
    │          │      └────┬──────────────────┘
    │          │           │
    │          │           │ 1:N
    │          │           │
    │          │           ▼
    │          │      ┌──────────────────────┐
    │          │      │  TOUR_IMAGES         │
    │          │      │──────────────────────│
    │          │      │ id (PK)              │
    │          │      │ tour_id (FK)         │
    │          │      │ url                  │
    │          │      │ alt_text             │
    │          │      │ order                │
    │          │      └──────────────────────┘
    │          │
    │          │ 1:N
    │          ▼
    │     ┌──────────────────────┐
    │     │  TOUR_INCLUDES       │
    │     │──────────────────────│
    │     │ id (PK)              │
    │     │ tour_id (FK)         │
    │     │ name                 │
    │     │ icon                 │
    │     └──────────────────────┘
    │
    │ 1:N
    │
    ▼
┌──────────────────────┐
│      HOTELS          │
│──────────────────────│
│ id (PK)              │
│ name                 │
│ slug                 │
│ description          │
│ commission_percentage│
│ rating               │
│ stars                │
│ rooms_count          │
│ phone                │
│ email                │
│ website              │
│ checkin_time         │
│ checkout_time        │
│ status               │
└────┬──────────────────┘
     │
     │ 1:N
     │
     ├─────────────────┬──────────────────┐
     │                 │                  │
     ▼                 ▼                  ▼
┌──────────────┐ ┌──────────────┐ ┌──────────────┐
│HOTEL_IMAGES  │ │HOTEL_REVIEWS │ │HOTEL_AMENITI│
│──────────────│ │──────────────│ │──────────────│
│ id (PK)      │ │ id (PK)      │ │ id (PK)      │
│ hotel_id(FK) │ │ hotel_id(FK) │ │ hotel_id(FK) │
│ url          │ │ user_name    │ │ name         │
│ alt_text     │ │ rating       │ │ icon         │
│ order        │ │ comment      │ └──────────────┘
│              │ │ verified     │
└──────────────┘ └──────────────┘

    │
    │ 1:N
    │
    ▼
┌──────────────────────┐
│    TRANSPORTS        │
│──────────────────────│
│ id (PK)              │
│ name                 │
│ slug                 │
│ vehicle_type         │
│ description          │
│ capacity             │
│ year                 │
│ fuel_type            │
│ has_ac               │
│ insurance_included   │
│ driver_included      │
│ commission_percentage│
│ phone                │
│ email                │
│ website              │
│ rating               │
│ status               │
└────┬──────────────────┘
     │
     │ 1:N
     │
     ├─────────────────┬──────────────────┐
     │                 │                  │
     ▼                 ▼                  ▼
┌──────────────┐ ┌──────────────┐
│TRANSPORT_IMAG│ │TRANSPORT_REV │
│──────────────│ │──────────────│
│ id (PK)      │ │ id (PK)      │
│transport_id(F│ │transport_id(F│
│ url          │ │ user_name    │
│ alt_text     │ │ rating       │
│ order        │ │ comment      │
│              │ │ verified     │
└──────────────┘ └──────────────┘

═════════════════════════════════════════════════════════════════════════════

                            TABLAS PIVOT (M:N)

┌────────────────────────────────────────────────────────────────────────┐
│                                                                        │
│  ┌──────────────────┐    ┌──────────────────┐                        │
│  │DESTINATION_HOTEL │    │DESTINATION_TOUR  │                        │
│  │──────────────────│    │──────────────────│                        │
│  │ id (PK)          │    │ id (PK)          │                        │
│  │destination_id(FK)│    │destination_id(FK)│                        │
│  │ hotel_id (FK)    │    │ tour_id (FK)     │                        │
│  └──────────────────┘    └──────────────────┘                        │
│                                                                        │
│  ┌──────────────────┐    ┌──────────────────┐                        │
│  │DESTINATION_TOUR  │    │DESTINATION_      │                        │
│  │     _OPERATOR    │    │   TRANSPORT      │                        │
│  │──────────────────│    │──────────────────│                        │
│  │ id (PK)          │    │ id (PK)          │                        │
│  │destination_id(FK)│    │destination_id(FK)│                        │
│  │tour_operator_id  │    │transport_id (FK) │                        │
│  │ (FK)             │    │                  │                        │
│  └──────────────────┘    └──────────────────┘                        │
│                                                                        │
└────────────────────────────────────────────────────────────────────────┘
```

---

## 🔗 Relaciones Detalladas

### Relaciones One-to-Many (1:N)

```
PROVINCES (1) ────→ DESTINATIONS (N)
└─ Una provincia puede tener múltiples destinos turísticos

DESTINATIONS (1) ────→ HOTELS (N)
DESTINATIONS (1) ────→ TOURS (N)
DESTINATIONS (1) ────→ TOUR_OPERATORS (N)
DESTINATIONS (1) ────→ TRANSPORTS (N)
└─ Un destino puede tener múltiples servicios

TOUR_OPERATORS (1) ────→ TOURS (N)
└─ Un operador turístico puede ofrecer múltiples tours

HOTELS (1) ────→ HOTEL_IMAGES (N)
HOTELS (1) ────→ HOTEL_REVIEWS (N)
HOTELS (1) ────→ HOTEL_AMENITIES (N)
└─ Un hotel puede tener múltiples imágenes, reseñas y amenidades

TOURS (1) ────→ TOUR_IMAGES (N)
TOURS (1) ────→ TOUR_REVIEWS (N)
TOURS (1) ────→ TOUR_INCLUDES (N)
└─ Un tour puede tener múltiples imágenes, reseñas e items incluidos

TRANSPORTS (1) ────→ TRANSPORT_IMAGES (N)
TRANSPORTS (1) ────→ TRANSPORT_REVIEWS (N)
└─ Un transporte puede tener múltiples imágenes y reseñas

RATE_TYPES (1) ────→ PRICING (N)
└─ Un tipo de tarifa puede tener múltiples precios por servicio
```

### Relaciones Many-to-Many (M:N)

```
DESTINATIONS (M) ────→ HOTELS (N)
Via tabla: destination_hotel
└─ Un hotel puede estar en múltiples destinos
└─ Un destino puede tener múltiples hoteles

DESTINATIONS (M) ────→ TOUR_OPERATORS (N)
Via tabla: destination_tour_operator
└─ Un operador puede trabajar en múltiples destinos
└─ Un destino puede tener múltiples operadores

DESTINATIONS (M) ────→ TOURS (N)
Via tabla: destination_tour
└─ Un tour puede realizarse en múltiples destinos
└─ Un destino puede ofrecer múltiples tours

DESTINATIONS (M) ────→ TRANSPORTS (N)
Via tabla: destination_transport
└─ Un transporte opera en múltiples destinos
└─ Un destino puede tener múltiples servicios de transporte
```

### Relación Polimórfica

```
PRICING ────→ HOTELS / TOURS / TRANSPORTS
Via columnas: service_type + service_id
└─ Una tabla de precios para los 3 tipos de servicios
└─ service_type: enum('hotel', 'tour', 'transport')
└─ service_id: ID del servicio específico
```

---

## 📋 Listado Completo de Tablas

### Tablas Principales (7)

| Tabla | Descripción | Relaciones |
|-------|-------------|-----------|
| **provinces** | Provincias de Costa Rica | 1:N → destinations |
| **destinations** | Destinos turísticos | 1:N → múltiples servicios, M:N → servicios |
| **hotels** | Hoteles y alojamientos | M:N ← destinations, 1:N → imágenes/reseñas/amenidades |
| **tour_operators** | Operadores turísticos | M:N ← destinations, 1:N → tours |
| **tours** | Tours específicos | 1:N → tour_operators, M:N ← destinations, 1:N → imágenes/reseñas/includes |
| **transports** | Servicios de transporte | M:N ← destinations, 1:N → imágenes/reseñas |
| **rate_types** | Tipos de tarifa | 1:N → pricing |

### Tablas Pivot/Relación (4)

| Tabla | Relación | Descripción |
|-------|----------|------------|
| **destination_hotel** | Destinations ↔ Hotels | Un hotel en múltiples destinos |
| **destination_tour_operator** | Destinations ↔ Tour Operators | Un operador en múltiples destinos |
| **destination_tour** | Destinations ↔ Tours | Un tour en múltiples destinos |
| **destination_transport** | Destinations ↔ Transports | Un transporte en múltiples destinos |

### Tablas de Precios (1)

| Tabla | Descripción | Relaciones |
|-------|-------------|-----------|
| **pricing** | Precios por temporada | Polimórfica: HOTELS, TOURS, TRANSPORTS, 1:N ← rate_types |

### Tablas de Imágenes (3)

| Tabla | Descripción | Relación |
|-------|-------------|----------|
| **hotel_images** | Imágenes de hoteles | 1:N ← hotels |
| **tour_images** | Imágenes de tours | 1:N ← tours |
| **transport_images** | Imágenes de transportes | 1:N ← transports |

### Tablas de Reseñas (3)

| Tabla | Descripción | Relación |
|-------|-------------|----------|
| **hotel_reviews** | Reseñas de hoteles | 1:N ← hotels |
| **tour_reviews** | Reseñas de tours | 1:N ← tours |
| **transport_reviews** | Reseñas de transportes | 1:N ← transports |

### Tablas de Características (2)

| Tabla | Descripción | Relación |
|-------|-------------|----------|
| **hotel_amenities** | Amenidades de hoteles (piscina, WiFi, etc.) | 1:N ← hotels |
| **tour_includes** | Items incluidos en tours (almuerzo, equipo, etc.) | 1:N ← tours |

---

## 📊 Conteo Total de Tablas

```
TABLAS PRINCIPALES:              7
├─ provinces
├─ destinations
├─ hotels
├─ tour_operators
├─ tours
├─ transports
└─ rate_types

TABLAS PIVOT (M:N):              4
├─ destination_hotel
├─ destination_tour_operator
├─ destination_tour
└─ destination_transport

TABLAS DE PRECIOS:               1
└─ pricing

TABLAS DE IMÁGENES:              3
├─ hotel_images
├─ tour_images
└─ transport_images

TABLAS DE RESEÑAS:               3
├─ hotel_reviews
├─ tour_reviews
└─ transport_reviews

TABLAS DE CARACTERÍSTICAS:       2
├─ hotel_amenities
└─ tour_includes

═══════════════════════════════════════════════
TOTAL:                          20 TABLAS
═══════════════════════════════════════════════
```

---

## 🎯 Flujo de Datos - Ejemplo de Uso

### Caso: Usuario busca hoteles en Arenal

```
1. Usuario accede a: /es/provincia/guanacaste/destino/arenal/hoteles

2. Sistema ejecuta:
   Query 1: Province::where('slug', 'guanacaste')->first()
   Query 2: Destination::where('slug', 'arenal')->first()
   Query 3: $arenal->hotels()->where('status', 'active')->get()
   
3. Para cada hotel, obtiene:
   └─ Imágenes: $hotel->images()->orderBy('order')->get()
   └─ Amenidades: $hotel->amenities()->get()
   └─ Rating: $hotel->reviews()->avg('rating')
   └─ Precio para fecha: Pricing::where('service_type', 'hotel')
                                 ->where('service_id', $hotel->id)
                                 ->where('start_date', '<=', $date)
                                 ->where('end_date', '>=', $date)
                                 ->first()?->price

4. Usuario ve:
   ├─ Arenal (provincia: Guanacaste)
   │  ├─ La Fortuna Resort
   │  │  ├─ Imágenes: [foto1, foto2, foto3]
   │  │  ├─ Rating: 4.8 ⭐
   │  │  ├─ Amenidades: [🏊 Piscina, 📡 WiFi, 💪 Gym]
   │  │  └─ Precio (diciembre): $200/noche
   │  │
   │  └─ Arenal Vista Hotel
   │     ├─ Imágenes: [foto1, foto2, foto3]
   │     ├─ Rating: 4.6 ⭐
   │     ├─ Amenidades: [🏊 Piscina, 🍽️ Restaurante]
   │     └─ Precio (diciembre): $120/noche
```

---

## 💰 Comisiones - Flujo de Cálculo

```
1. Usuario reserva hotel por $200/noche × 5 noches = $1,000

2. Sistema obtiene comisión del hotel:
   commission_percentage: 10%

3. Cálculo:
   $1,000 × 10% = $100 (tú ganas)
   $900 (hotel recibe)

4. Registro en BD:
   hotels.commission_percentage = 10.00
   (se guarda en BD, no se recalcula)
```

---

## 🌡️ Temporadas - Flujo de Precios

```
1. RateTypes (Tipos de tarifa):
   ├─ Temporada Alta (high-season): Diciembre-Enero, Julio-Agosto
   ├─ Temporada Media (mid-season): Enero-Mayo, Septiembre-Noviembre
   └─ Temporada Baja (low-season): Junio-Julio

2. Pricing (Precios específicos):
   Hotel La Fortuna:
   ├─ High Season: $200/noche (dic 1 - ene 15)
   ├─ Mid Season: $120/noche (ene 16 - may 31)
   └─ Low Season: $60/noche (jun 1 - nov 30)

3. Sistema obtiene precio:
   $hotel->getPriceForDate('2024-12-25')
   └─ Busca en pricing donde:
      ├─ service_type = 'hotel'
      ├─ service_id = 1
      ├─ start_date <= '2024-12-25'
      └─ end_date >= '2024-12-25'
   └─ Retorna: $200.00
```

---

## ✅ Características Principales

### ✨ Multiidioma Integrado
- URLs: `/es/provincia/{slug}/destino/{slug}` y `/en/province/{slug}/destination/{slug}`
- Slugs en todas las tablas principales para URLs amigables con SEO

### ✨ Relaciones Flexibles
- Hoteles en múltiples destinos (M:N)
- Tours en múltiples destinos (M:N)
- Transportes en múltiples destinos (M:N)
- Operadores en múltiples destinos (M:N)

### ✨ Precios Dinámicos
- Tabla separada de pricing por temporada
- Válido para hoteles, tours y transporte
- Rango de fechas personalizado

### ✨ Reseñas y Calificaciones
- Sistema de reviews independiente para cada servicio
- Cálculo automático de rating promedio

### ✨ Comisiones Configurables
- Comisión % por hotel
- Comisión % por operador
- Comisión % por tour
- Comisión % por transporte

### ✨ Escalabilidad
- Estructura modular y preparada para crecer
- Fácil agregar nuevos servicios
- Fácil expandir a nuevas provincias/destinos

---

## 📝 Notas de Implementación

1. **Slugs únicos:** Todos los slugs deben ser UNIQUE para evitar duplicados
2. **Soft Deletes:** Se recomienda agregar soft deletes a las tablas principales
3. **Índices:** Agregar índices en FK y campos de búsqueda frecuente
4. **Timestamps:** Todas las tablas incluyen created_at y updated_at
5. **Enums:** Los enums son respaldados por constraint en BD
6. **Cascading:** ON DELETE CASCADE para mantener integridad referencial

---

## 🚀 Siguiente Paso

Proceder con la creación de:
- ✅ Todas las migraciones (20 archivos)
- ✅ Todos los Models con relaciones
- ✅ Seeders con datos realistas
- ✅ Controllers para consultas

**Estado:** Listo para implementación ✅
