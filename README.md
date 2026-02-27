# Laravel B2B SaaS Starter Kit 🚀

A powerful, production-ready B2B SaaS starter kit built on top of Laravel 12, Livewire 3, and Tailwind CSS 4. It features a complete multi-tenancy implementation using `stancl/tenancy` with isolated PostgreSQL databases, dynamic subdomains, and automated workspace provisioning.

## ✨ Features

- **Multi-Database Tenancy**: Complete data isolation. Every tenant gets their own PostgreSQL database automatically provisioned upon workspace creation.
- **Subdomain Routing**: Dynamic tenant identification via subdomains (e.g., `acme.yourdomain.com`).
- **Landlord & Tenant Architecture**: Separation between the central application (Landlord) and the tenant application (Workspace).
- **Self-Serve Onboarding**: Streamlined workspace creation flow. Central users can register and instantly provision their own isolated workspace.
- **Admin Cloning**: The founding central user is seamlessly cloned into the isolated tenant database as the initial Administrator.
- **Modern TALL Stack**: Built with Laravel 12, Livewire 3, Alpine.js, and Tailwind CSS 4.
- **Beautiful UI Components**: Styled with Preline UI and Flux UI for a premium, accessible, and responsive interface.
- **Visual Landing Builder**: High-performance drag-and-drop builder for tenant landing pages, featuring real-time previews, multiple templates, and custom styling.
- **Authentication**: Powered by Laravel Fortify with a custom Blade integration.
- **Centralized Subscriptions**: Ready-to-go plan and subscription models handled at the central database level.

## 🛠️ Tech Stack

- **Framework:** Laravel 12
- **Frontend:** Livewire 3, Alpine.js, Tailwind CSS 4
- **UI Libraries:** Preline UI, Flux UI
- **Tenancy:** Stancl Tenancy v3
- **Database:** PostgreSQL
- **Auth:** Laravel Fortify

## 🚀 Getting Started

### Prerequisites

- PHP 8.2+
- Composer
- Node.js & NPM
- PostgreSQL

### Installation

1. **Clone the repository:**

   ```bash
   git clone https://github.com/nandocdev/laravel-saas.git
   cd laravel-saas
   ```

2. **Install PHP dependencies:**

   ```bash
   composer install
   ```

3. **Install NPM dependencies:**

   ```bash
   npm install
   npm run build
   ```

4. **Environment Setup:**
   Copy the example environment file and generate the application key.

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Database Configuration:**
   Create a central PostgreSQL database (e.g., `saas_central`). Ensure your PostgreSQL user has the privilege to **create databases** dynamically for tenants (this is required for DB provisioning). Update your `.env` with the central DB credentials:

   ```env
   DB_CONNECTION=pgsql
   
   DB_CENTRAL_HOST=127.0.0.1
   DB_CENTRAL_PORT=5432
   DB_CENTRAL_DATABASE=saas_central
   DB_CENTRAL_USERNAME=postgres
   DB_CENTRAL_PASSWORD=secret
   ```

6. **Run Central Migrations:**

   ```bash
   php artisan migrate
   ```

8. **Link Storage:**
   Required for image uploads in the Landing Builder.

   ```bash
   php artisan storage:link
   ```

9. **Local Host Routing:**
   To test multi-tenancy locally, you'll need to use `localhost` or a `.test` domain instead of the raw IP `127.0.0.1` so your browser correctly resolves subdomains (e.g. `acme.localhost`).
   Start the Laravel local server:

   ```bash
   php artisan serve --port=8081
   # Access via: http://localhost:8081
   ```

## 🌐 Architecture Overview

### Central Platform (Landlord)

- Exists on the root domain (e.g., `domain.com` or `localhost`).
- Holds generic SaaS information (Landing Page, Central Auth, Subscription Plans).
- Stores the central `users`, `tenants`, `domains`, and `subscriptions` tables.

### Tenant Workspaces

- Exists on subdomains (e.g., `acme.domain.com` or `acme.localhost`).
- Each tenant maps to a completely separate PostgreSQL database (e.g., `tenant_acme`).
- Has its own isolated `users` table for employees of that specific company.

### The Flow

1. User visits landing page on root domain.
2. User registers a central account.
3. User is prompted to create a workspace (Tenant).
4. System automatically provisions a `tenant_{id}` PostgreSQL database, runs tenant migrations, assigns a domain, creates a default starter subscription, and securely clones the creator as the first isolated admin user.
5. User is magically redirected to `{subdomain}.localhost` and logs into their isolated workspace.

## 📄 License

This project is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).
