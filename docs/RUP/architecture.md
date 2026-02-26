# Software Architecture Document (SAD)

## 1. Introduction

### 1.1 Purpose
This document provides a comprehensive architectural overview of the **Laravel B2B SaaS Starter Kit**. It describes the system's structure, key components, data models, and deployment considerations.

### 1.2 Scope
The architecture covers the central (Landlord) application and the per-tenant workspace application, including their interactions, database strategy, routing, and key technology choices.

### 1.3 References
- [Vision Document](vision.md)
- [Use Cases](use-cases.md)
- [Glossary](glossary.md)

---

## 2. Architectural Goals and Constraints

- **Data Isolation**: Each tenant must have a completely isolated database; cross-tenant data access must be impossible at the application level.
- **Scalability**: New tenants must be provisioned automatically without manual intervention.
- **Separation of Concerns**: Central platform concerns (auth, subscriptions) must be strictly separated from tenant-specific features.
- **Modern Stack**: PHP 8.2+, Laravel 12, Livewire 3, PostgreSQL.

---

## 3. System Overview

The system follows a **Landlord / Tenant** (multi-database multi-tenancy) architecture powered by the `stancl/tenancy` package.

```
Internet
   │
   ├── yourdomain.com          →  Landlord Application (Central DB)
   │       Landing, Auth, Subscriptions
   │
   └── acme.yourdomain.com     →  Tenant Workspace Application (Tenant DB: tenant_acme)
   └── beta.yourdomain.com     →  Tenant Workspace Application (Tenant DB: tenant_beta)
```

---

## 4. Architectural Components

### 4.1 Landlord (Central) Application

| Component | Description |
|---|---|
| **Central Routes** (`routes/web.php`) | Handles the landing page, central auth (register, login), and workspace creation |
| **Central Models** | `User`, `Tenant`, `Domain`, `Plan`, `Subscription` stored in the central PostgreSQL database |
| **Tenant Provisioning** | `CreateTenantAction` orchestrates DB creation, migration, domain assignment, subscription creation, and admin cloning |
| **Auth (Fortify)** | Laravel Fortify handles registration and login on the central domain |
| **Landing Page** | Public-facing Livewire component that presents the product and subscription plans |

### 4.2 Tenant (Workspace) Application

| Component | Description |
|---|---|
| **Tenant Routes** (`routes/tenant.php`) | All routes under a tenant subdomain are handled here |
| **Tenant Models** | `User` and other tenant-specific models stored in the isolated tenant database |
| **Settings Module** | Livewire-powered settings panel for workspace configuration |
| **Tenant Middleware** | `InitializeTenancyByDomain` identifies and bootstraps the correct tenant context on each request |

### 4.3 Database Strategy

| Database | Purpose |
|---|---|
| `saas_central` | Stores central users, tenants, domains, plans, and subscriptions |
| `tenant_{id}` | One database per tenant; stores all tenant-specific data including their user accounts |

Tenant databases are created dynamically at workspace provisioning time using PostgreSQL's `CREATE DATABASE` command.

---

## 5. Key Design Decisions

### 5.1 Multi-Database Tenancy
The system uses **multi-database tenancy** (one database per tenant) rather than single-database tenancy (shared tables with a `tenant_id` column). This provides:
- Stronger data isolation guarantees.
- Simpler per-tenant backup and restore.
- No risk of cross-tenant data leaks through missing query scopes.

### 5.2 Subdomain Identification
Tenants are identified by their subdomain. The `stancl/tenancy` middleware (`InitializeTenancyByDomain`) resolves the subdomain on each HTTP request and bootstraps the correct database connection before the request reaches any controller or Livewire component.

### 5.3 Admin Cloning
When a workspace is created, the founding central user is cloned into the tenant database as the initial Administrator. This prevents the bootstrapping problem where the first login to the tenant workspace has no valid user to authenticate against.

### 5.4 Centralized Subscriptions
Subscription plans and tenant subscription records live in the central database. This allows a single billing system to manage all tenants without requiring access to individual tenant databases.

---

## 6. Technology Stack

| Layer | Technology |
|---|---|
| **Backend Framework** | Laravel 12 |
| **Frontend** | Livewire 3, Alpine.js, Tailwind CSS 4 |
| **UI Libraries** | Preline UI, Flux UI |
| **Multi-Tenancy** | stancl/tenancy v3 |
| **Authentication** | Laravel Fortify |
| **Database** | PostgreSQL |
| **Asset Bundler** | Vite |

---

## 7. Deployment Considerations

- A PostgreSQL server with `CREATE DATABASE` privilege for the application user is required.
- DNS must be configured as a wildcard (e.g., `*.yourdomain.com`) pointing to the application server.
- For local development, use `*.localhost` or configure `/etc/hosts` entries for each test tenant.
- The application key (`APP_KEY`) must be set before running migrations.
