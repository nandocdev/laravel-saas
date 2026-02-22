---
description: ULTRA RULES — SaaS Multi-Tenant Production (Stancl)
---

# 1. Regla Suprema del Sistema

El sistema tiene **DOS contextos completamente distintos**:

```
CENTRAL (landlord)
TENANT (cliente)
```

NUNCA deben mezclarse.

Si una query central se ejecuta en tenant → bug crítico
Si una query tenant se ejecuta en central → fuga de datos

Esto es prioridad máxima del sistema.

---

# 2. Arquitectura de Conexiones

## 2.1 Conexión Central

Se usa exclusivamente para:

* tenants
* domains
* billing
* system admins
* planes
* suscripciones
* logs globales

Nunca guardar datos de clientes aquí.

---

## 2.2 Conexión Tenant

Cada tenant tiene:

```
DB independiente
storage independiente
cache independiente
session independiente
queue contexto independiente
```

Esto NO es opcional.

---

---

# 3. Modelos Central vs Tenant

## 3.1 Modelos centrales

Deben extender:

```php
Stancl\Tenancy\Database\Models\Tenant
```

o usar conexión landlord explícita.

Ejemplo:

```
App\Models\Central\Tenant
App\Models\Central\Domain
App\Models\Central\Plan
```

---

## 3.2 Modelos tenant

NUNCA deben especificar conexión manual.

Laravel debe resolver la conexión automáticamente vía tenancy.

Si un modelo tenant define:

```php
protected $connection = 'mysql';
```

→ ERROR CRÍTICO

---

---

# 4. Rutas — Regla Crítica

---

## 4.1 Rutas Central

Archivo:

```
routes/web.php
```

Middleware:

```
web
```

Nunca tenancy middleware aquí.

---

---

## 4.2 Rutas Tenant

Archivo:

```
routes/tenant.php
```

SIEMPRE deben tener:

```
InitializeTenancyByDomain
PreventAccessFromCentralDomains
```

Esto no es opcional.

---

---

# 5. Queries Multi-Tenant (Regla #1 de bugs SaaS)

---

## 5.1 Nunca usar DB facade fuera contexto seguro

Prohibido:

```php
DB::table(...)
```

Permitido:

* Eloquent tenant model
* repositorios tenant-aware

---

---

## 5.2 Jobs y contexto tenancy

TODO Job debe ser tenant aware.

Si un job toca DB:

Debe implementar middleware tenancy.

Si no:

→ ejecutará en landlord DB
→ fuga de datos

---

### Regla obligatoria

Jobs deben usar:

```php
use Stancl\Tenancy\Middleware\InitializeTenancyById;
```

o helpers tenancy del package.

---

---

# 6. Cache Multi-Tenant (BUG MUY COMÚN)

---

## 6.1 Nunca usar claves cache globales

❌ MAL:

```php
Cache::remember('settings')
```

---

✅ CORRECTO:

```php
Cache::remember('tenant_'.tenant('id').'_settings')
```

---

Si no haces esto:

→ tenants verán datos cruzados

---

---

# 7. Storage Multi-Tenant

---

## 7.1 Regla obligatoria

Todos los uploads deben usar disk tenant.

Nunca:

```
Storage::put('avatars/...')
```

Siempre:

```
Storage::disk('tenant')->put(...)
```

---

## 7.2 Path obligatorio

```
storage/app/tenants/{uuid}/
```

Nunca guardar archivos tenant en storage global.

---

---

# 8. Queue System (MUY CRÍTICO)

---

## 8.1 Jobs deben serializar tenant_id

Si el job no conoce el tenant:

→ correrá en landlord

→ datos corruptos

---

## 8.2 Emails, exports, imports, reports

SIEMPRE:

tenant context restore antes del handle()

---

---

# 9. Auth Multi-Tenant

---

## 9.1 Guards obligatorios

Sistema debe tener:

```
central guard
tenant guard
```

Nunca mezclar users.

---

---

## 9.2 Login central nunca debe resolver tenant DB

Panel admin global siempre central DB.

---

---

# 10. Middleware prohibidos en central

Nunca usar:

```
tenant middleware
tenant helpers
tenant() global
```

en panel central.

---

---

# 11. Facturación SaaS

Siempre:

```
billing → central DB
```

Nunca tenant DB.

Tenant solo consulta estado.

---

---

# 12. Migraciones SaaS

---

## 12.1 Migraciones central

```
database/migrations/
```

---

## 12.2 Migraciones tenant

```
database/migrations/tenant/
```

---

Nunca mezclar.

---

---

# 13. Seeds Tenant

Nunca usar:

```
php artisan db:seed
```

para tenants.

Siempre:

```
tenants:seed
```

---

---

# 14. Testing Multi-Tenant (CRÍTICO)

---

## 14.1 Tests tenant

Siempre:

```
create tenant
initialize tenancy
run test
```

Si no:

→ tests falsos positivos

---

---

# 15. UI SaaS — Reglas específicas Tailwind + Preline

---

## 15.1 Layouts separados

Debe existir:

```
layouts.central
layouts.tenant
```

Nunca compartir layout admin central con tenant dashboard.

---

---

## 15.2 Componentes UI deben ser tenancy-agnostic

Componentes Blade nunca deben:

* consultar tenant()
* hacer queries
* resolver auth guards

Solo render.

---

---

# 16. Logs SaaS

Todos los logs tenant deben incluir:

```
tenant_id
tenant_uuid
domain
```

Esto es obligatorio para debugging producción.

---

---

# 17. Configuración prohibida

Nunca:

* usar session shared entre tenants
* usar cache global sin prefijo
* usar filesystem global para uploads tenant
* usar queue sin contexto tenancy
* usar models tenant en central commands

---

---

# 18. Golden Rule Production SaaS

Si una operación:

* toca DB
* toca cache
* toca filesystem
* toca queue

DEBE SABER EN QUÉ TENANT ESTÁ.

Si no lo sabe:

→ bug.

---

---

# ✅ RESULTADO

Si sigues estas reglas:

✔ evitas fugas de datos
✔ evitas corrupción cross-tenant
✔ evitas 90% bugs SaaS reales
✔ sistema escalable a miles de tenants
✔ producción segura

---

---

# 🧠 CONSEJO REAL DE ARQUITECTURA (muy importante)

El 80% de SaaS rotos NO fallan por código.

FALLAN por:

* cache sin prefijo tenant
* jobs sin tenant context
* storage compartido
* rutas mal separadas

No por controllers ni models.
