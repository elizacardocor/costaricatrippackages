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
    │          │          │            │   │ pricing_model (enum) │
    │          │          │            │   │ price                │
    │          │          │            │   │ min_hours (opt)      │
    │          │          │            │   │ min_km (opt)         │
    │          │          │            │   │ max_km (opt)         │
    │          │          │            │   │ min_persons (opt)    │
    ▼          ▼          ▼            ▼   │ start_date           │
┌──────┐  ┌─────────┐ ┌────────┐  ┌──────┐│ end_date             │
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
Via columnas: service_type + service_id + pricing_model
└─ Una tabla de precios para los 3 tipos de servicios
└─ service_type: enum('hotel', 'tour', 'transport')
└─ service_id: ID del servicio específico
└─ pricing_model: enum('fixed', 'hourly', 'per_km', 'per_day', 'per_person')
   └─ Permite múltiples modelos de cálculo de precio para el mismo servicio
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
| **pricing** | Precios por temporada con múltiples modelos de cálculo | Polimórfica: HOTELS, TOURS, TRANSPORTS, 1:N ← rate_types, Soporta 5 modelos de precio |

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

## 🎁 Sistema de Descuentos Inteligente

### Estrategia: DISCOUNTS TABLE + Descuentos Automáticos

En lugar de complicar BOOKINGS, usamos una tabla separada **DISCOUNTS** que se aplica automáticamente:

```sql
CREATE TABLE discounts (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    
    -- Identificación
    name VARCHAR(100) NOT NULL,                    -- "Descuento Paquete 3+ Servicios"
    code VARCHAR(20) UNIQUE DEFAULT NULL,          -- Código opcional (ej: VERANO2024)
    description TEXT DEFAULT NULL,
    
    -- Tipo de descuento
    discount_type ENUM(
        'percentage',                              -- Porcentaje (20%)
        'fixed_amount',                            -- Cantidad fija ($50)
        'bundle',                                  -- Descuento por paquete
        'tiered'                                   -- Escalonado por cantidad
    ) NOT NULL,
    
    -- Condiciones
    min_items INT DEFAULT 1,                       -- Mínimo de items
    min_services INT DEFAULT 1,                    -- Mínimo de servicios diferentes
    min_total_price DECIMAL(10, 2) DEFAULT 0,      -- Monto mínimo
    
    -- Aplicable a
    applicable_to ENUM(
        'all',                                     -- Todos los servicios
        'specific_services',                       -- Servicios específicos
        'service_type'                             -- Tipo de servicio (hotel/tour/transport)
    ) DEFAULT 'all',
    
    -- Valor del descuento
    discount_value DECIMAL(10, 2) NOT NULL,        -- 20 (%) o 50 ($)
    max_discount DECIMAL(10, 2) DEFAULT NULL,      -- Máximo descuento permitido
    
    -- Validez
    start_date DATE DEFAULT NULL,
    end_date DATE DEFAULT NULL,
    is_active BOOLEAN DEFAULT TRUE,
    
    -- Límites
    usage_limit INT DEFAULT NULL,                  -- Máximo de usos
    usage_count INT DEFAULT 0,                     -- Usos actuales
    per_user_limit INT DEFAULT NULL,               -- Por usuario
    
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    INDEX idx_code (code),
    INDEX idx_active (is_active),
    INDEX idx_dates (start_date, end_date)
);
```

---

## 💡 Ejemplos de Descuentos Reales

### 1️⃣ Descuento por Cantidad de Servicios (Muy Común)

```
Nombre: "Ahorra en Paquetes"
Tipo: percentage
Condición: min_services >= 3 (3+ servicios diferentes)
Valor: 15% descuento

Ejemplo 1:
├─ Hotel: $200 × 5 noches = $1,000
├─ Tour: $299 × 1 = $299
├─ Transport: $100 × 1 = $100
├─ Subtotal: $1,399
├─ Descuento 15%: -$209.85
└─ Total: $1,189.15 ✅

Ejemplo 2 (Sin descuento):
├─ Hotel: $200 × 5 noches = $1,000
├─ Subtotal: $1,000
└─ Total: $1,000 (no cumple min_services >= 3)
```

### 2️⃣ Descuento por Monto Total

```
Nombre: "Mega Ahorro"
Tipo: tiered (escalonado)
Condiciones:
├─ $500-$999: 5% descuento
├─ $1,000-$1,999: 10% descuento
├─ $2,000+: 15% descuento

Ejemplo:
├─ Subtotal: $1,500
├─ Descuento 10%: -$150
└─ Total: $1,350
```

### 3️⃣ Descuento por Temporada

```
Nombre: "Verano Low Cost"
Tipo: fixed_amount
Valor: $50 descuento fijo
Fechas: 2024-06-01 a 2024-08-31
Condición: applicable_to = 'tours'

Ejemplo:
├─ Tour 1: $299
├─ Tour 2: $199
├─ Subtotal: $498
├─ Descuento: -$50
└─ Total: $448
```

### 4️⃣ Código Promocional

```
Nombre: "Referido Amigo"
Tipo: percentage
Código: REFERIDO20
Valor: 20% descuento
Límite: 50 usos máximo
Válido hasta: 2024-12-31

Ejemplo:
├─ Usuario aplica código "REFERIDO20"
├─ Subtotal: $1,000
├─ Descuento 20%: -$200
└─ Total: $800
```

---

## 🧮 Cómo Calcular Descuentos (Algoritmo)

```php
public function applyDiscounts($bookingItems, $appliedCodes = [])
{
    $subtotal = $bookingItems->sum('subtotal');
    $discountApplied = 0;
    $discountsUsed = [];
    
    // 1. Obtener descuentos elegibles
    $eligibleDiscounts = Discount::where('is_active', true)
                                  ->where('start_date', '<=', now()->date)
                                  ->where('end_date', '>=', now()->date)
                                  ->orWhereNull('end_date')
                                  ->get();
    
    foreach ($eligibleDiscounts as $discount) {
        
        // 2. Verificar condiciones
        if (!$this->meetsConditions($bookingItems, $subtotal, $discount)) {
            continue;
        }
        
        // 3. Calcular descuento
        $discountAmount = match($discount->discount_type) {
            'percentage' => ($subtotal * $discount->discount_value) / 100,
            'fixed_amount' => $discount->discount_value,
            'bundle' => $this->calculateBundleDiscount($bookingItems, $discount),
            'tiered' => $this->calculateTieredDiscount($subtotal, $discount),
        };
        
        // 4. Respetar límite máximo
        if ($discount->max_discount) {
            $discountAmount = min($discountAmount, $discount->max_discount);
        }
        
        // 5. Respetar límite de uso
        if ($discount->usage_limit && $discount->usage_count >= $discount->usage_limit) {
            continue;
        }
        
        // 6. Acumular descuento (si se permiten múltiples)
        $discountApplied += $discountAmount;
        $discountsUsed[] = [
            'id' => $discount->id,
            'name' => $discount->name,
            'amount' => $discountAmount
        ];
    }
    
    // 7. Aplicar códigos promocionales
    foreach ($appliedCodes as $code) {
        $promoDiscount = Discount::where('code', $code)->first();
        if ($promoDiscount && $this->meetsConditions($bookingItems, $subtotal, $promoDiscount)) {
            $discountAmount = $promoDiscount->discount_type === 'percentage'
                ? (($subtotal - $discountApplied) * $promoDiscount->discount_value) / 100
                : $promoDiscount->discount_value;
            
            $discountApplied += $discountAmount;
            $discountsUsed[] = ['code' => $code, 'amount' => $discountAmount];
        }
    }
    
    return [
        'subtotal' => $subtotal,
        'discounts' => $discountsUsed,
        'total_discount' => $discountApplied,
        'final_total' => max(0, $subtotal - $discountApplied)
    ];
}

private function meetsConditions($bookingItems, $subtotal, $discount)
{
    // Verificar cantidad de items
    if ($bookingItems->count() < $discount->min_items) {
        return false;
    }
    
    // Verificar cantidad de servicios diferentes
    $uniqueServices = $bookingItems->groupBy('service_type')->count();
    if ($uniqueServices < $discount->min_services) {
        return false;
    }
    
    // Verificar monto mínimo
    if ($subtotal < $discount->min_total_price) {
        return false;
    }
    
    return true;
}
```

---

## 📊 Tabla BOOKING_ITEMS Mejorada (Con Descuentos)

```sql
CREATE TABLE booking_items (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    booking_id BIGINT NOT NULL,
    service_type ENUM('hotel', 'tour', 'transport') NOT NULL,
    service_id BIGINT NOT NULL,
    pricing_id BIGINT NOT NULL,
    quantity INT DEFAULT 1,
    unit_price DECIMAL(10, 2) NOT NULL,
    subtotal DECIMAL(12, 2) NOT NULL,
    
    -- ✨ NUEVO: Descuentos a nivel de item
    discount_amount DECIMAL(10, 2) DEFAULT 0,     -- Descuento aplicado
    item_total DECIMAL(12, 2) NOT NULL,           -- subtotal - discount_amount
    
    notes TEXT DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    FOREIGN KEY (booking_id) REFERENCES bookings(id) ON DELETE CASCADE,
    FOREIGN KEY (pricing_id) REFERENCES pricing(id) ON DELETE RESTRICT,
    INDEX idx_booking (booking_id)
);
```

---

## 💰 Ejemplo Completo de Cálculo

```
ESCENARIO: Cliente quiere reservar en Arenal

┌─────────────────────────────────────────────────────────────────┐
│ CARRITO DE COMPRA (Sin Descuentos)                              │
├─────────────────────────────────────────────────────────────────┤
│                                                                  │
│ 1. La Fortuna Resort (Hotel)                                    │
│    5 noches × $200 = $1,000                                     │
│                                                                  │
│ 2. Arenal Adventure Tour                                        │
│    1 día × $299 = $299                                          │
│                                                                  │
│ 3. Transport Arenal (Van)                                       │
│    1 transporte × $100 = $100                                   │
│                                                                  │
│ SUBTOTAL: $1,399                                                │
├─────────────────────────────────────────────────────────────────┤
│ DESCUENTOS APLICADOS:                                           │
├─────────────────────────────────────────────────────────────────┤
│                                                                  │
│ ✓ Descuento Paquete 3+ Servicios: 15%                          │
│   ($1,399 × 15%) = -$209.85                                     │
│                                                                  │
│ ✓ Descuento Verano Low Cost (Tours): $50                        │
│   -$50.00                                                        │
│                                                                  │
│ TOTAL DESCUENTOS: -$259.85                                      │
├─────────────────────────────────────────────────────────────────┤
│                                                                  │
│ TOTAL A PAGAR: $1,399 - $259.85 = $1,139.15                    │
│                                                                  │
│ AHORRAS: $259.85 (18.6%)                                        │
│                                                                  │
└─────────────────────────────────────────────────────────────────┘
```

---

## 📈 Total de Tablas ACTUALIZADO

```
TABLAS PRINCIPALES (originales):    20
├─ provinces, destinations, hotels, tours, transports, pricing, etc.

TABLAS NUEVAS PARA DESCUENTOS:      1
└─ discounts

TABLAS PARA FUTURO (No implementadas): 4
├─ users
├─ roles  
├─ bookings
└─ booking_items

═══════════════════════════════════════════════
TOTAL (Cuando se implemente todo):  25 TABLAS
TOTAL (Ahora - Solo descuentos):    21 TABLAS
═══════════════════════════════════════════════
```

---

## 🎯 Flujo de Descuentos (Resumen)

```
1. CLIENTE agrega items al carrito
   ├─ Hotel $1,000
   ├─ Tour $299
   └─ Transport $100
   
2. SISTEMA calcula descuentos automáticos
   ├─ Verifica: ¿3+ servicios? SÍ → -15%
   ├─ Verifica: ¿Tours en temporada? SÍ → -$50
   
3. CLIENTE VE RESULTADO
   ├─ Subtotal: $1,399
   ├─ Descuentos: -$259.85
   └─ Total: $1,139.15
   
4. CLIENTE CONFIRMA (Aplica también código si tiene)
   ├─ Ingresa código promocional
   ├─ Sistema valida y aplica
   └─ Crea BOOKING con descuentos registrados
```



### Tipos de Modelos Soportados (pricing_model)

La tabla `pricing` soporta **5 modelos diferentes** de cálculo de precio, permitiendo máxima flexibilidad:

```
pricing_model ENUM(
    'fixed',      -- Precio fijo único
    'hourly',     -- Precio por hora
    'per_km',     -- Precio por kilómetro
    'per_day',    -- Precio por día completo
    'per_person'  -- Precio por persona
)
```

### Ejemplo Real: Vans Arenal (Transporte)

```
Transporte: Vans Arenal (id=5)

┌─────────────────────────────────────────────────────────────┐
│ MODELOS DE PRECIO - Temporada Alta (Diciembre-Enero)       │
├─────────────────────────────────────────────────────────────┤
│                                                              │
│ 1️⃣ FIXED (Precio Fijo)                                     │
│    - Precio: $50                                            │
│    - Caso: Puerta a puerta San José → Arenal               │
│    - Cálculo: Siempre $50                                   │
│                                                              │
│ 2️⃣ HOURLY (Por Hora)                                       │
│    - Precio: $30/hora                                       │
│    - Min Hours: 1                                           │
│    - Caso: Tour de 4 horas                                  │
│    - Cálculo: max(4, 1) × $30 = $120                       │
│                                                              │
│ 3️⃣ PER_KM (Por Kilómetro)                                  │
│    - Precio: $2.50/km                                       │
│    - Min KM: 10, Max KM: 100                               │
│    - Caso: Viaje de 50km                                    │
│    - Cálculo: max(50, 10) × $2.50 = $125                  │
│                                                              │
│ 4️⃣ PER_DAY (Por Día - 8 horas)                             │
│    - Precio: $200/día                                       │
│    - Caso: Tour completo de un día                          │
│    - Cálculo: 1 día × $200 = $200                          │
│                                                              │
│ 5️⃣ PER_PERSON (Por Persona)                                │
│    - Precio: $15/persona                                    │
│    - Min Persons: 1                                         │
│    - Caso: Grupo de 8 personas                              │
│    - Cálculo: 8 × $15 = $120                               │
│                                                              │
└─────────────────────────────────────────────────────────────┘
```

### Tabla: pricing (Estructura Mejorada)

```sql
CREATE TABLE pricing (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    
    -- Referencia al servicio (polimórfica)
    service_type ENUM('hotel', 'tour', 'transport') NOT NULL,
    service_id BIGINT NOT NULL,
    
    -- Temporada
    rate_type_id BIGINT NOT NULL,
    
    -- ✨ MODELO DE CÁLCULO (Flexible Pricing)
    pricing_model ENUM('fixed', 'hourly', 'per_km', 'per_day', 'per_person') 
                  DEFAULT 'fixed' NOT NULL,
    
    -- Precio (significado depende de pricing_model)
    price DECIMAL(10, 2) NOT NULL,
    
    -- Parámetros opcionales según el modelo
    min_hours INT DEFAULT NULL,          -- Para 'hourly'
    min_km INT DEFAULT NULL,             -- Para 'per_km'
    max_km INT DEFAULT NULL,             -- Para 'per_km'
    min_persons INT DEFAULT NULL,        -- Para 'per_person'
    
    -- Rango de validez
    start_date DATE NOT NULL,
    end_date DATE NOT NULL,
    active BOOLEAN DEFAULT TRUE,
    
    -- Timestamps
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    -- Relaciones
    FOREIGN KEY (rate_type_id) REFERENCES rate_types(id) ON DELETE CASCADE,
    
    -- Índices para búsquedas rápidas
    INDEX idx_service (service_type, service_id),
    INDEX idx_dates (start_date, end_date),
    INDEX idx_pricing_model (pricing_model),
    
    -- Unicidad
    UNIQUE (service_type, service_id, rate_type_id, pricing_model, start_date)
);
```

### Ejemplos de Datos: Vans Arenal

```
┌────┬─────────────┬──────────┬──────────┬────────────┬───────┬──────────┬────────┬────────────┬────────────┬──────────────┬───────────────────┬───────────────┐
│ id │service_type │service_id│rate_id   │model       │ price │min_hours │min_km  │max_km      │min_persons │start_date    │end_date           │active         │
├────┼─────────────┼──────────┼──────────┼────────────┼───────┼──────────┼────────┼────────────┼────────────┼──────────────┼───────────────────┼───────────────┤
│ 1  │ 'transport' │ 5        │ 1        │ 'fixed'    │ 50    │ NULL     │ NULL   │ NULL       │ NULL       │ 2024-12-01   │ 2025-01-15        │ 1             │
│ 2  │ 'transport' │ 5        │ 1        │ 'hourly'   │ 30    │ 1        │ NULL   │ NULL       │ NULL       │ 2024-12-01   │ 2025-01-15        │ 1             │
│ 3  │ 'transport' │ 5        │ 1        │ 'per_km'   │ 2.50  │ NULL     │ 10     │ 100        │ NULL       │ 2024-12-01   │ 2025-01-15        │ 1             │
│ 4  │ 'transport' │ 5        │ 1        │ 'per_day'  │ 200   │ NULL     │ NULL   │ NULL       │ NULL       │ 2024-12-01   │ 2025-01-15        │ 1             │
│ 5  │ 'transport' │ 5        │ 1        │ 'per_person│ 15    │ NULL     │ NULL   │ NULL       │ 1          │ 2024-12-01   │ 2025-01-15        │ 1             │
│ 6  │ 'transport' │ 5        │ 2        │ 'fixed'    │ 35    │ NULL     │ NULL   │ NULL       │ NULL       │ 2025-01-16   │ 2025-05-31        │ 1             │
│ 7  │ 'transport' │ 5        │ 2        │ 'hourly'   │ 20    │ 1        │ NULL   │ NULL       │ NULL       │ 2025-01-16   │ 2025-05-31        │ 1             │
│ 8  │ 'tour'      │ 12       │ 1        │ 'per_person│ 50    │ NULL     │ NULL   │ NULL       │ 2          │ 2024-12-01   │ 2025-01-15        │ 1             │
│ 9  │ 'hotel'     │ 3        │ 1        │ 'fixed'    │ 120   │ NULL     │ NULL   │ NULL       │ NULL       │ 2024-12-01   │ 2025-01-15        │ 1             │
└────┴─────────────┴──────────┴──────────┴────────────┴───────┴──────────┴────────┴────────────┴────────────┴──────────────┴───────────────────┴───────────────┘
```

### Cómo Calcular el Precio Final en Laravel

```php
public function calculatePrice(Pricing $pricing, $parameters = [])
{
    switch($pricing->pricing_model) {
        
        case 'fixed':
            // Precio fijo - no requiere parámetros adicionales
            return $pricing->price;
            
        case 'hourly':
            // Precio por hora: max(hours, min_hours) * price
            $hours = $parameters['hours'] ?? 1;
            return max($hours, $pricing->min_hours ?? 0) * $pricing->price;
            
        case 'per_km':
            // Precio por km: max(km, min_km) * price (respetando max_km)
            $km = $parameters['km'] ?? $pricing->min_km ?? 0;
            $km = min($km, $pricing->max_km ?? PHP_INT_MAX);
            return max($km, $pricing->min_km ?? 0) * $pricing->price;
            
        case 'per_day':
            // Precio por día: days * price
            $days = $parameters['days'] ?? 1;
            return $days * $pricing->price;
            
        case 'per_person':
            // Precio por persona: persons * price
            $persons = $parameters['persons'] ?? 1;
            return $persons * $pricing->price;
            
        default:
            return null;
    }
}
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
- ✅ Todas las migraciones (20 + 5 archivos)
- ✅ Todos los Models con relaciones
- ✅ Seeders con datos realistas
- ✅ Controllers para consultas

### 📌 Tablas Preparadas Pero NO Implementadas (Para Futuro):
- ⏳ users (Sistema de login simplificado)
- ⏳ roles (Roles: admin, customer, operator)
- ⏳ bookings (Reservas)
- ⏳ booking_items (Detalles de reserva)

**Estado:** Listo para implementación ✅
