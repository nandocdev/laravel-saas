# Vision Document

## 1. Introduction

### 1.1 Purpose
This document defines the vision for the **Laravel B2B SaaS Starter Kit**. It captures the core goals, stakeholder needs, and high-level requirements that drive the development of the system.

### 1.2 Scope
The Laravel B2B SaaS Starter Kit is a production-ready foundation for building multi-tenant B2B SaaS applications. It provides out-of-the-box multi-tenancy with isolated PostgreSQL databases, subdomain routing, self-serve onboarding, and a centralized subscription model.

### 1.3 References
- [README](../../README.md)
- [Architecture Document](architecture.md)
- [Use Cases](use-cases.md)

---

## 2. Positioning

### 2.1 Problem Statement
Building a B2B SaaS application from scratch requires solving complex, recurring infrastructure concerns such as multi-tenancy, data isolation, subdomain routing, and subscription management. These problems are common across projects but time-consuming to implement correctly.

### 2.2 Product Position Statement
For independent developers and small teams who need to launch a B2B SaaS product quickly, the Laravel B2B SaaS Starter Kit is an opinionated application scaffold that provides all the multi-tenancy, authentication, and subscription scaffolding in one place—unlike starting from a bare Laravel installation or assembling separate packages manually.

---

## 3. Stakeholders and Users

### 3.1 Stakeholders

| Stakeholder | Role | Interest |
|---|---|---|
| Developer / Team | Builder | Rapidly scaffold a SaaS product without reinventing multi-tenancy infrastructure |
| SaaS Business Owner | Product owner | Launch a product with data isolation guarantees and subscription management |
| End User (Tenant Admin) | Primary user | Manage their own isolated workspace and team members |
| End User (Tenant Employee) | Secondary user | Access workspace features specific to their organization |

### 3.2 User Needs

| User | Need | Current Solution | Proposed Solution |
|---|---|---|---|
| Developer | Quick project scaffold with multi-tenancy | Assemble packages manually | Pre-integrated starter kit |
| SaaS Owner | Complete data isolation per customer | Custom implementation | Separate PostgreSQL DB per tenant |
| Tenant Admin | Self-service workspace creation | Manual provisioning | Automated workspace + DB provisioning |
| Tenant Employee | Secure workspace access | N/A | Subdomain-based isolated access |

---

## 4. Product Overview

### 4.1 Product Perspective
The starter kit is a standalone Laravel 12 application that serves as the foundation for any B2B SaaS product. It integrates several established packages (stancl/tenancy, Laravel Fortify, Livewire 3) and provides a working implementation of multi-database multi-tenancy.

### 4.2 Key Features

- **Multi-Database Tenancy**: Complete data isolation—every tenant gets its own PostgreSQL database provisioned automatically on workspace creation.
- **Subdomain Routing**: Dynamic tenant identification via subdomains (e.g., `acme.yourdomain.com`).
- **Landlord & Tenant Architecture**: Clean separation between the central application (Landlord) and the per-tenant workspace.
- **Self-Serve Onboarding**: Users register on the central domain and can instantly provision their own isolated workspace.
- **Admin Cloning**: The founding central user is cloned into the tenant database as the initial Administrator.
- **Centralized Subscriptions**: Plan and subscription models managed at the central database level.
- **Modern TALL Stack**: Laravel 12, Livewire 3, Alpine.js, Tailwind CSS 4, Preline UI, Flux UI.

### 4.3 Assumptions and Dependencies

- PHP 8.2 or higher is available.
- PostgreSQL is used as the database engine (required for dynamic DB provisioning).
- The PostgreSQL user has `CREATE DATABASE` privileges.
- A working DNS or local host configuration is available for subdomain routing.

---

## 5. Constraints

- The system targets PHP 8.2+ environments only.
- Database engine is PostgreSQL; MySQL is not supported due to the multi-database tenancy architecture.
- Frontend requires Node.js and NPM for asset compilation.
