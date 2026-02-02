# API v1 - Documentación para Reservas

## Información General

**Base URL**: `http://localhost/Proyecto-Laravel-AE3.1/Proyecto_Laravel/public/api/v1`

**Formato de Respuestas**: JSON

**Autenticación**: No requerida para esta versión

---

## Endpoints Disponibles

### 1. Listar todas las Reservas

**Método**: `GET`  
**Ruta**: `/reservas`  
**URL Completa**: `http://localhost/Proyecto-Laravel-AE3.1/Proyecto_Laravel/public/api/v1/reservas`

**Headers**:
```
Accept: application/json
```

**Respuesta Exitosa (200 OK)**:
```json
{
  "data": [
    {
      "id": 1,
      "nombre": "Juan Pérez",
      "email": "juan@example.com",
      "clase": "Yoga",
      "fecha": "2026-02-15",
      "created_at": "2026-02-02T12:00:00.000000Z",
      "updated_at": "2026-02-02T12:00:00.000000Z"
    },
    {
      "id": 2,
      "nombre": "María García",
      "email": "maria@example.com",
      "clase": "Pilates",
      "fecha": "2026-02-20",
      "created_at": "2026-02-02T12:05:00.000000Z",
      "updated_at": "2026-02-02T12:05:00.000000Z"
    }
  ],
  "links": {
    "first": "http://localhost/api/v1/reservas?page=1",
    "last": "http://localhost/api/v1/reservas?page=1",
    "prev": null,
    "next": null
  },
  "meta": {
    "current_page": 1,
    "from": 1,
    "last_page": 1,
    "per_page": 15,
    "to": 2,
    "total": 2
  }
}
```

---

### 2. Obtener una Reserva Específica

**Método**: `GET`  
**Ruta**: `/reservas/{id}`  
**URL Completa**: `http://localhost/Proyecto-Laravel-AE3.1/Proyecto_Laravel/public/api/v1/reservas/1`

**Headers**:
```
Accept: application/json
```

**Respuesta Exitosa (200 OK)**:
```json
{
  "data": {
    "id": 1,
    "nombre": "Juan Pérez",
    "email": "juan@example.com",
    "clase": "Yoga",
    "fecha": "2026-02-15",
    "created_at": "2026-02-02T12:00:00.000000Z",
    "updated_at": "2026-02-02T12:00:00.000000Z"
  }
}
```

**Respuesta Error - No Encontrado (404 Not Found)**:
```json
{
  "message": "No query results for model [App\\Models\\Reserva] 999"
}
```

---

### 3. Crear una Nueva Reserva

**Método**: `POST`  
**Ruta**: `/reservas`  
**URL Completa**: `http://localhost/Proyecto-Laravel-AE3.1/Proyecto_Laravel/public/api/v1/reservas`

**Headers**:
```
Accept: application/json
Content-Type: application/json
```

**Cuerpo de la Petición (JSON)**:
```json
{
  "nombre": "Carlos López",
  "email": "carlos@example.com",
  "clase": "Zumba",
  "fecha": "2026-03-10"
}
```

**Campos Requeridos**:
| Campo | Tipo | Validación | Descripción |
|-------|------|------------|-------------|
| `nombre` | string | Requerido, máx 100 caracteres | Nombre del cliente |
| `email` | string | Requerido, formato email válido, máx 255 caracteres | Email del cliente |
| `clase` | string | Requerido, máx 100 caracteres | Tipo de clase reservada |
| `fecha` | date | Requerido, formato YYYY-MM-DD, hoy o posterior | Fecha de la reserva |

**Respuesta Exitosa (201 Created)**:
```json
{
  "data": {
    "id": 3,
    "nombre": "Carlos López",
    "email": "carlos@example.com",
    "clase": "Zumba",
    "fecha": "2026-03-10",
    "created_at": "2026-02-02T12:10:00.000000Z",
    "updated_at": "2026-02-02T12:10:00.000000Z"
  }
}
```

**Respuesta Error - Validación (422 Unprocessable Entity)**:
```json
{
  "message": "El nombre es obligatorio. (and 2 more errors)",
  "errors": {
    "nombre": [
      "El nombre es obligatorio."
    ],
    "email": [
      "El email debe tener un formato válido."
    ],
    "fecha": [
      "La fecha debe ser hoy o posterior."
    ]
  }
}
```

---

### 4. Actualizar una Reserva Existente

**Método**: `PUT` o `PATCH`  
**Ruta**: `/reservas/{id}`  
**URL Completa**: `http://localhost/Proyecto-Laravel-AE3.1/Proyecto_Laravel/public/api/v1/reservas/1`

**Headers**:
```
Accept: application/json
Content-Type: application/json
```

**Cuerpo de la Petición (JSON)**:
```json
{
  "nombre": "Juan Pérez Actualizado",
  "email": "juan.nuevo@example.com",
  "clase": "Spinning",
  "fecha": "2026-03-15"
}
```

**Campos Requeridos**: Los mismos que para crear (todos los campos son obligatorios)

**Respuesta Exitosa (200 OK)**:
```json
{
  "data": {
    "id": 1,
    "nombre": "Juan Pérez Actualizado",
    "email": "juan.nuevo@example.com",
    "clase": "Spinning",
    "fecha": "2026-03-15",
    "created_at": "2026-02-02T12:00:00.000000Z",
    "updated_at": "2026-02-02T12:15:00.000000Z"
  }
}
```

**Respuesta Error - No Encontrado (404 Not Found)**:
```json
{
  "message": "No query results for model [App\\Models\\Reserva] 999"
}
```

---

### 5. Eliminar una Reserva

**Método**: `DELETE`  
**Ruta**: `/reservas/{id}`  
**URL Completa**: `http://localhost/Proyecto-Laravel-AE3.1/Proyecto_Laravel/public/api/v1/reservas/1`

**Headers**:
```
Accept: application/json
```

**Respuesta Exitosa (204 No Content)**:
- Sin cuerpo de respuesta
- Código de estado HTTP: 204

**Respuesta Error - No Encontrado (404 Not Found)**:
```json
{
  "message": "No query results for model [App\\Models\\Reserva] 999"
}
```

---

## Guía de Pruebas con Thunder Client / Postman

### Configuración Inicial

1. **Asegúrate de que el servidor esté corriendo**:
   ```bash
   php artisan serve
   ```
   O utiliza XAMPP/WAMP y accede vía localhost

2. **Importar en Thunder Client/Postman**:
   - Crea una nueva colección llamada "API Reservas v1"
   - Configura la variable de entorno `base_url` con: `http://localhost/Proyecto-Laravel-AE3.1/Proyecto_Laravel/public/api/v1`

### Secuencia de Pruebas Recomendada

#### Prueba 1: Listar Reservas Vacías o Existentes
```
GET {{base_url}}/reservas
```

#### Prueba 2: Crear Primera Reserva (Caso Exitoso)
```
POST {{base_url}}/reservas
Body (JSON):
{
  "nombre": "Test Usuario",
  "email": "test@test.com",
  "clase": "Yoga",
  "fecha": "2026-03-15"
}
```
**Esperado**: Código 201, devuelve la reserva creada con ID

#### Prueba 3: Crear Reserva con Errores de Validación
```
POST {{base_url}}/reservas
Body (JSON):
{
  "nombre": "",
  "email": "email-invalido",
  "clase": "",
  "fecha": "2020-01-01"
}
```
**Esperado**: Código 422, devuelve errores de validación en español

#### Prueba 4: Obtener Reserva por ID
```
GET {{base_url}}/reservas/1
```
**Esperado**: Código 200, devuelve los datos de la reserva

#### Prueba 5: Obtener Reserva Inexistente
```
GET {{base_url}}/reservas/99999
```
**Esperado**: Código 404, mensaje de error

#### Prueba 6: Actualizar Reserva
```
PUT {{base_url}}/reservas/1
Body (JSON):
{
  "nombre": "Usuario Actualizado",
  "email": "actualizado@test.com",
  "clase": "Pilates",
  "fecha": "2026-04-20"
}
```
**Esperado**: Código 200, devuelve la reserva actualizada

#### Prueba 7: Eliminar Reserva
```
DELETE {{base_url}}/reservas/1
```
**Esperado**: Código 204, sin contenido en la respuesta

#### Prueba 8: Verificar que la Reserva fue Eliminada
```
GET {{base_url}}/reservas/1
```
**Esperado**: Código 404

---

## Reglas de Validación

### Campo: nombre
- ✅ Requerido
- ✅ Tipo: string
- ✅ Longitud máxima: 100 caracteres

### Campo: email
- ✅ Requerido
- ✅ Formato: email válido
- ✅ Longitud máxima: 255 caracteres

### Campo: clase
- ✅ Requerido
- ✅ Tipo: string
- ✅ Longitud máxima: 100 caracteres

### Campo: fecha
- ✅ Requerido
- ✅ Formato: YYYY-MM-DD (date)
- ✅ Regla: Debe ser hoy o una fecha futura

---

## Códigos de Estado HTTP Utilizados

| Código | Significado | Uso en la API |
|--------|-------------|---------------|
| 200 | OK | Operación exitosa (GET, PUT/PATCH) |
| 201 | Created | Recurso creado exitosamente (POST) |
| 204 | No Content | Recurso eliminado exitosamente (DELETE) |
| 404 | Not Found | Recurso no encontrado |
| 422 | Unprocessable Entity | Error de validación |

---

## Notas para Otros Grupos (Cross-Testing)

1. **Servidor Local**: Esta API está configurada para ejecutarse en un entorno local XAMPP. Ajusta la base URL según tu configuración.

2. **Base de Datos**: Asegúrate de ejecutar las migraciones:
   ```bash
   php artisan migrate
   ```

3. **Datos de Prueba**: Puedes crear datos de prueba manualmente mediante la API o usando `php artisan tinker`.

4. **Paginación**: La respuesta del endpoint `GET /reservas` está paginada (15 items por página por defecto).

5. **Formato de Fecha**: Todas las fechas deben enviarse en formato ISO 8601 (YYYY-MM-DD).

6. **Mensajes de Error**: Los mensajes de validación están en español para mejor UX.

---

## Estructura de Archivos Creados

```
app/
├── Http/
│   ├── Controllers/
│   │   └── Api/
│   │       └── V1/
│   │           └── ReservaController.php  (Controlador API)
│   ├── Requests/
│   │   ├── StoreReservaRequest.php        (Validación creación)
│   │   └── UpdateReservaRequest.php       (Validación actualización)
│   └── Resources/
│       └── ReservaResource.php            (Transformación JSON)
routes/
└── api.php                                (Rutas API v1)
```

---

## Contacto para Soporte

Si encuentran algún error o comportamiento inesperado durante las pruebas cruzadas, por favor documenten:
- El endpoint utilizado
- El método HTTP
- El cuerpo de la petición (si aplica)
- El código de estado recibido
- El cuerpo de la respuesta
- El comportamiento esperado vs. el obtenido
