# Guía para Agentes de IA en este Proyecto

## Resumen del Proyecto

Este proyecto es una aplicación SaaS multi-tenant basada en Laravel. La arquitectura está dividida en dos contextos principales:

1. **Central (Landlord):** Maneja la administración del sistema, incluyendo tenants, dominios, planes, y logs globales.
2. **Tenant (Cliente):** Cada cliente tiene su propio espacio aislado con base de datos, almacenamiento, caché, sesiones y colas independientes.

Es fundamental mantener estos contextos completamente separados para evitar errores críticos o fugas de datos.

---

## Arquitectura y Patrones Clave

### Contextos Central y Tenant

- **Central:**
    - Modelos: `App\Models\Central\*`
    - Conexión: `landlord`
    - Usos: administración de tenants, dominios, planes, y logs globales.
- **Tenant:**
    - Modelos: `App\Models\Tenant\*`
    - Conexión: específica para cada tenant.
    - Usos: datos específicos de cada cliente.

### Modelos

- Los modelos centrales deben extender `Stancl\Tenancy\Database\Models\Tenant` o usar explícitamente la conexión `landlord`.
- Ejemplo de modelos centrales:
    ```php
    App\Models\Central\Tenant
    App\Models\Central\Domain
    App\Models\Central\Plan
    ```

### Aislamiento de Tenants

Cada tenant tiene:

- Base de datos independiente.
- Almacenamiento independiente.
- Caché independiente.
- Sesiones independientes.
- Contexto de colas independiente.

---

## Flujo de Trabajo para Desarrolladores

### Comandos Clave

- **Ejecutar migraciones:**
    ```bash
    php artisan migrate --path=database/migrations/central
    php artisan tenants:migrate
    ```
- **Ejecutar pruebas:**
    ```bash
    ./vendor/bin/pest
    ```
- **Iniciar servidor local:**
    ```bash
    php artisan serve
    ```

### Pruebas

- Las pruebas están organizadas en `tests/Feature` y `tests/Unit`.
- Usa `Pest` para escribir y ejecutar pruebas.

---

## Dependencias y Herramientas

- **Tenancy:** `stancl/tenancy` para la gestión multi-tenant.
- **Livewire:** Para componentes interactivos en el frontend.
- **Pest:** Framework de pruebas.

---

## Convenciones Específicas del Proyecto

- **Separación de Contextos:** Nunca mezclar queries o datos entre los contextos central y tenant.
- **Rutas:**
    - Rutas centrales: `routes/web.php`.
    - Rutas de tenants: `routes/tenant.php`.
- **Nombres de Clases:** Seguir la estructura `App\Models\[Central|Tenant]\*` según el contexto.

---

## Archivos Clave

- **Configuración de Tenancy:** `config/tenancy.php`
- **Modelos Centrales:** `app/Models/Central`
- **Modelos de Tenants:** `app/Models/Tenant`
- **Migraciones Centrales:** `database/migrations/central`
- **Migraciones de Tenants:** `database/migrations/tenant`

---

## Ejemplo de Código

### Modelo Central

```php
namespace App\Models\Central;

use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;

class Tenant extends BaseTenant
{
    // Lógica específica del modelo central
}
```

### Modelo Tenant

```php
namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    // Lógica específica del modelo tenant
}
```

---

## Notas Finales

- Sigue las reglas descritas en `.github/instructions/gidelines.instructions.md` para mantener la integridad del sistema.
- Consulta `README.md` para más detalles sobre la configuración inicial y las dependencias.
