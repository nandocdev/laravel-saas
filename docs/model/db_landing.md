# Esquema de Base de Datos: Landing Builder

**Estructura completa de tablas y campos JSON**
`Laravel + Livewire` · `2 tablas` · `JSON flexible`

---

## 📊 Resumen de Estructura

* **2** Tablas en BD
* **5** Columnas directas principales
* **7** Claves en `global_settings`
* **13** Tipos de bloques soportados

---

## 🗺️ Diagrama Relacional

### **tenant_landings**

* `id` (PK)
* `template_key`
* `status`
* `primary_color`
* `font_family`
* `global_settings` (JSON)

**Relación:** `1 → N` (hasMany) hacia `landing_blocks`

### **landing_blocks**

* `id` (PK)
* `tenant_landing_id` (FK)
* `block_type`
* `order` (IDX)
* `is_active`
* `settings` (JSON)

> **Notas de implementación:**
> * Scope de tenant aplicado por middleware.
> * `cascadeOnDelete` activo en la FK.
> * Índices compuestos sugeridos: `[tenant_landing_id, order]` y `[tenant_landing_id, is_active]`.
> 
> 

---

## 🗄️ Detalle de Tablas

### 1. Tabla: `tenant_landings`

*Una fila por tenant. Almacena la configuración global y de identidad.*

| Campo | Tipo / Atributos | Descripción |
| --- | --- | --- |
| **id** | `bigint` (PK) | Auto-increment. |
| **template_key** | `varchar(30)` | Plantilla base: `corporate`, `visual`, `conversion`, `storytelling`, `catalog`, `minimal`. |
| **status** | `varchar(10)` | Visibilidad: `draft`, `published`. |
| **primary_color** | `varchar(7)` | Color hex principal (columna directa para renderizado rápido). |
| **font_family** | `varchar(20)` | Tipografía: `instrument`, `slab`, `sans`, `mono`. |
| **global_settings** | `json` | Ver detalle en sección JSON. |

### 2. Tabla: `landing_blocks`

*N filas por tenant. Define las secciones verticales de la landing.*

| Campo | Tipo / Atributos | Descripción |
| --- | --- | --- |
| **id** | `bigint` (PK) | Auto-increment. |
| **tenant_landing_id** | `bigint` (FK) | Relación con `tenant_landings.id`. |
| **block_type** | `varchar(30)` | Tipo de componente: `hero`, `services`, `gallery`, `testimonials`, `pricing`, `faq`, `cta`, etc. |
| **order** | `smallint` | Posición vertical (Sortable). |
| **is_active** | `boolean` | Toggle de visibilidad pública. |
| **settings** | `json` | Contenido dinámico según el `block_type`. |

---

## 📦 Detalle de Campos JSON

### `tenant_landings.global_settings`

Configuración de estilo y sitio que no requiere filtrado por columna.

* **site_name** (`string`): Nombre del negocio (Navbar/Footer).
* **color_neutral** (`string hex`): Fondo de secciones y bordes.
* **color_accent** (`string hex`): Badges y highlights.
* **bg_mode** (`enum`): `light`, `soft`, `dark`.
* **logo_url** (`string|null`): URL del logo (fallback a texto si es null).
* **favicon_url** (`string|null`): URL del favicon.
* **custom_css** (`string|null`): CSS inyectado para planes avanzados.

---

### `landing_blocks.settings` (Estructura por tipo)

Cada bloque renderiza un componente Blade específico según estos datos:

* 🏠 **hero**: `headline`, `subheadline`, `badge`, `cta_text`, `cta_url`, `layout` (centered/split/fullscreen), `image_url`.
* ⭐ **services**: `title`, `layout` (cards/bullets), `items[]` (icon, title, description).
* 🖼️ **gallery**: `title`, `layout` (masonry/grid), `images[]` (url, alt).
* 💬 **testimonials**: `title`, `layout`, `items[]` (text, author, role, rating).
* 💰 **pricing**: `title`, `currency`, `plans[]` (name, price, period, featured, features[]).
* ❓ **faq**: `title`, `items[]` (question, answer).
* ⚡ **cta**: `title`, `subtitle`, `cta_text`, `cta_url`, `style`.
* ✉️ **contact**: `title`, `email`, `phone`, `address`, `show_map`.
* 📖 **story**: `title`, `milestones[]` (year, event).
* 🗂️ **catalog**: `title`, `show_price`, `categories[]`, `items[]` (name, price, image_url).

---

## 💡 Racional de Arquitectura

* **Rendimiento:** Se usan **columnas directas** solo para datos que el renderer necesita filtrar o leer masivamente sin parsear JSON (`status`, `primary_color`).
* **Escalabilidad:** El uso de JSON permite añadir nuevos tipos de bloques o configuraciones globales sin necesidad de ejecutar migraciones de base de datos.
* **Mantenibilidad:** En Laravel, se recomienda usar `$casts` en los modelos para manejar estos campos automáticamente como arrays:
```php
protected $casts = [
    'global_settings' => 'array',
    'settings' => 'array',
];

```