---
description: Coding Guidelines
---

# 📘 Coding Guidelines

---

# 1. Arquitectura de Monolito Modular

El sistema se divide en dominios autónomos. No se permite el acoplamiento directo entre módulos.

## 1.1 Estructura de Módulos

* **Ubicación:** Todo el código de negocio debe vivir en:

```
app/Modules/{NombreModulo}
```

* **Estructura Interna:**

```
Actions/
Models/
DTOs/
Events/
Listeners/
Policies/
Observers/
Http/Controllers/
Http/Requests/
Providers/ModuleServiceProvider.php
Routes/web.php
```

---

## 1.2 Contratos entre Módulos

* Cada módulo DEBE exponer sus capacidades mediante interfaces en:

```
app/Contracts/
```

* Los módulos consumidores SOLO pueden depender de contratos.
* Nunca depender de implementaciones concretas.
* Registrar implementaciones en `ModuleServiceProvider` usando:

```php
$this->app->bind(...)
```

---

## 1.3 Comunicación entre Módulos

**Síncrona**

→ mediante contratos inyectados por DI.

**Asíncrona**

→ mediante eventos del sistema.

**Datos Compartidos**

→ solo DTOs inmutables en:

```
app/DTOs/Shared/
```

---

## 1.4 Eventos y Listeners

* Eventos deben ser:

```php
final readonly class
```

* Ubicación:

```
app/Modules/{Modulo}/Events/
```

* Listeners registrados en provider del módulo.
* Usar `ShouldQueue` para operaciones no críticas.
* Eventos externos deben usar:

```
ShouldDispatchAfterCommit
```

---

# 2. Estándares PHP 8.4+ y Laravel 12

## 2.1 Tipado

Siempre:

```php
declare(strict_types=1);
```

* Actions / DTOs / Events → `final readonly class`
* Usar constructor promotion
* Usar enums
* Evitar null cuando sea posible

---

## 2.2 Inyección de Dependencias

* Todas las dependencias por constructor.
* Prohibido usar `new` para lógica de negocio.
* Fachadas solo:

```
Route
Cache
Log
```

* `resolve()` solo en providers.

---

# 3. Patrones de Código

---

## 3.1 Thin Controllers

El controlador:

* captura input
* delega al Action
* retorna respuesta

Máximo:

```
10 líneas por método
```

Prohibido:

* lógica negocio
* queries
* llamadas externas

---

## 3.2 Fat Actions

* Toda lógica ocurre en Actions
* Un único método público:

```
execute()
```

o

```
handle()
```

* Operaciones escritura → dentro de transacción

---

## 3.3 DTOs

* `final readonly`
* propiedades públicas tipadas
* método:

```
fromRequest()
```

* método:

```
toArray()
```

---

## 3.4 Form Requests

* Toda entrada HTTP debe usar FormRequest
* Sanitizar en:

```
prepareForValidation()
```

* textos libres → limpiar HTML según contexto

---

## 3.5 Modelos Eloquent

* `$fillable` o `$guarded` obligatorio
* `$casts` obligatorio
* SoftDeletes en modelos críticos
* No lógica compleja en modelos

---

# 4. Transacciones y Persistencia

---

## 4.1 Transacciones

Toda escritura múltiple:

```php
DB::transaction()
```

* Auditoría dentro de la misma transacción
* Excepciones deben relanzarse

---

## 4.2 Auditoría

Observers deben capturar:

```
created
updated
deleted
restored
```

Auditoría incluye:

* modelo
* id
* usuario
* IP
* cambios

---

# 5. Seguridad

---

## 5.1 CSRF

Nunca deshabilitar middleware.

Todos los forms:

```blade
@csrf
```

AJAX:

usar token meta.

---

## 5.2 Autorización

* Policies dentro del módulo
* usar `$this->authorize()`
* Gates solo si no depende de modelo

---

## 5.3 Sanitización

* Blade escapa con `{{ }}`
* La UI NO realiza escape automático.
* `{!! !!}` solo si contenido sanitizado.

---

## 5.4 Sesiones

Tras login:

```php
$request->session()->regenerate();
```

Tras logout:

```php
invalidate()
regenerateToken()
```

---

## 5.5 Roles

* Roles en BD
* mínimo:

```
Administrador
Usuario
```

---

# 6. Desarrollo UI con Tailwind + Preline

---

## 6.1 Layout

Todas las vistas:

```blade
@extends('layouts.app')
```

Layout debe incluir:

* Tailwind compilado por Vite
* JS global
* CSRF meta

---

## 6.2 Uso de Tailwind

Tailwind es la única fuente de estilos.

Prohibido:

```
style=""
```

---

Si clases > 15 líneas:

→ convertir en componente.

---

## 6.3 Uso de Preline

Siempre usar Preline si existe componente:

* modal
* dropdown
* sidebar
* tabs
* select
* tooltip

Tras render dinámico:

```js
window.HSStaticMethods.autoInit()
```

---

## 6.4 Componentización Blade

Ubicación:

```
resources/views/components/ui/
```

Ejemplos:

```
<x-ui.button>
<x-ui.input>
<x-ui.card>
<x-ui.modal>
<x-ui.table>
```

---

### Regla crítica

Si una vista contiene más de **2 bloques repetibles complejos**

→ debe extraerse a componente.

Duplicación de markup Tailwind está prohibida.

---

## 6.5 Formularios

Siempre:

```blade
@csrf
```

Inputs deben usar componentes Blade.

Errores:

```blade
@error('campo')
```

Inputs con error:

```
border-red-500
```

---

## 6.6 Tablas

Tablas grandes:

```
overflow-x-auto
```

Listados largos:

```
sticky top-0
```

---

## 6.7 Alerts

Usar:

```
<x-ui.alert type="success">
```

Tipos:

```
success
error
warning
info
```

---

## 6.8 Performance UI

* JS global en bundle
* evitar listeners Alpine excesivos
* evitar modales anidados

---

# 7. Testing

---

## 7.1 Ubicación

```
tests/Unit/Modules/
tests/Feature/Modules/
tests/Feature/Api/
```

---

## 7.2 Cobertura

* Actions escritura → 100%
* Controllers → 80%
* Policies → 90%

---

## 7.3 Principios

AAA:

```
Arrange
Act
Assert
```

* tests independientes
* usar factories

---

# 8. Git

---

## 8.1 Commits

Formato:

```
tipo(modulo): descripcion
```

Tipos:

```
feat
fix
refactor
docs
test
chore
perf
style
```

---

## 8.2 Ramas

```
main
develop
feature/*
fix/*
hotfix/*
```

---

# 9. Calidad de Código

---

## 9.1 PHPStan

Nivel 8 obligatorio.

---

## 9.2 Pint

Siempre ejecutar:

```
vendor/bin/pint
```

---

## 9.3 Documentación

Métodos públicos deben tener:

* descripción
* params
* return
* throws

---

# 10. Deployment

---

## 10.1 Variables

Nunca usar `env()` fuera config.

---

## 10.2 Optimización

Ejecutar:

```
config:cache
route:cache
view:cache
event:cache
```

---

## 10.3 Migraciones

Nunca eliminar migraciones productivas.

---

# 11. Logs

---

## 11.1 Logging

Nunca loggear:

* passwords
* tokens
* datos sensibles completos

---

## 11.2 Excepciones

* excepciones negocio → clases personalizadas
* nunca mostrar stack a usuario

---

# 12. Generación de Código

---

## 12.1 Módulo

Debe incluir:

* provider
* rutas
* estructura completa

---

## 12.2 Vistas

* usar componentes Blade del sistema
* usar componentes Preline cuando aplique
* guardar en:

```
resources/views/modules/{modulo}
```

---

## 12.3 Rutas

Formato:

```
{modulo}.{recurso}.{accion}
```

---

## 12.4 Actions

* final readonly class
* un único método público
* escritura → transacción
* retornar DTO o modelo

---

## 12.5 Tests

Cada Action:

* test unitario
* test integración
* caso éxito + error

---
