# Alternativa: Dashboard Bootstrap Optimizado

Si el build de Material-UI tarda demasiado, puedes usar esta alternativa MUCHO más rápida:

## Comparación

| Opción | Tiempo Build | Tamaño | Complejidad |
|--------|-------------|--------|------------|
| Material-UI (actual) | 5+ minutos | ~500 KB | Alta |
| Bootstrap (alternativa) | 30 segundos | ~150 KB | Media |
| Puro CSS (extremo) | 5 segundos | ~50 KB | Baja |

## Instalación Bootstrap

```bash
# En WSL:
npm uninstall @mui/material @mui/icons-material
npm install bootstrap@5.3.0
```

Esto reduce el bundle de dashboard de 500 KB a ~150 KB.

## Reescribir DashboardMUI.jsx con Bootstrap

Ejemplo simple:

```jsx
import React, { useState } from 'react';
import 'bootstrap/dist/css/bootstrap.min.css';

export default function Dashboard() {
    return (
        <div className="container-fluid mt-5">
            <div className="row">
                <aside className="col-md-3 bg-light p-3">
                    <h5>Menu</h5>
                    <ul className="list-unstyled">
                        <li><a href="#" className="text-decoration-none">Inicio</a></li>
                        <li><a href="#" className="text-decoration-none">Tours</a></li>
                        <li><a href="#" className="text-decoration-none">Usuarios</a></li>
                    </ul>
                </aside>
                <main className="col-md-9 p-4">
                    <h1>Dashboard</h1>
                    {/* Contenido aquí */}
                </main>
            </div>
        </div>
    );
}
```

## Decisión

¿Quieres que:

1. **Espere a que Material-UI compile** (puede tomar 5-10 minutos más)
2. **Cambiar a Bootstrap** (compilaría en 30 segundos)
3. **Hacer dashboard puro HTML/CSS** (aún más rápido, ~5 segundos)

Déjame saber qué prefieres.
