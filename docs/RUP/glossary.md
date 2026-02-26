# Glossary

This glossary defines key terms used across the RUP documentation for the **Laravel B2B SaaS Starter Kit**.

---

| Term | Definition |
|---|---|
| **Landlord** | The central application running on the root domain. It manages tenants, subscriptions, and central user accounts. Also referred to as the *Central Application*. |
| **Tenant** | An isolated workspace provisioned for a customer. Each tenant has its own subdomain and its own PostgreSQL database. |
| **Tenant Database** | A PostgreSQL database created automatically for a specific tenant (e.g., `tenant_acme`). Contains all data belonging exclusively to that tenant. |
| **Central Database** | The shared PostgreSQL database (`saas_central`) used by the Landlord application. Stores users, tenants, domains, plans, and subscriptions. |
| **Domain** | A subdomain record that maps a subdomain string (e.g., `acme`) to a specific tenant in the central database. |
| **Multi-Database Tenancy** | A tenancy strategy where each tenant has a completely separate database, ensuring full data isolation. |
| **Tenant Provisioning** | The automated process of creating a new tenant: allocating a database, running migrations, assigning a domain, creating a subscription, and cloning the admin user. |
| **Admin Cloning** | The process of copying the founding central user into the new tenant database as the initial Administrator when a workspace is created. |
| **Workspace** | The tenant's isolated application environment, accessible at their unique subdomain. Synonymous with *Tenant*. |
| **Subdomain Routing** | The mechanism by which the application identifies the active tenant based on the HTTP request's subdomain. |
| **Plan** | A subscription tier defined in the central database (e.g., Free, Pro, Enterprise) that describes the features and limits available to a tenant. |
| **Subscription** | A record in the central database associating a tenant with a specific plan, including status and billing metadata. |
| **RUP** | Rational Unified Process. An iterative software development framework that provides guidelines and templates for producing software documentation and managing the development lifecycle. |
| **SAD** | Software Architecture Document. A RUP artifact that describes the architecture of a system. |
| **UC** | Use Case. A description of a sequence of actions performed by an actor to achieve a goal within the system. |
| **TALL Stack** | An acronym for the frontend technology combination: **T**ailwind CSS, **A**lpine.js, **L**aravel, **L**ivewire. |
| **Fortify** | Laravel Fortify is a frontend-agnostic authentication backend for Laravel. Used in this project to handle registration and login on the central domain. |
| **stancl/tenancy** | A Laravel package that provides multi-tenancy capabilities, including multi-database tenancy with automatic database switching. |
| **Livewire** | A full-stack component framework for Laravel that makes it possible to build dynamic UIs without writing custom JavaScript. |
| **Central User** | A user registered on the Landlord (central) domain. A Central User may own one or more tenant workspaces. |
| **Tenant Admin** | The initial Administrator user within a tenant workspace. Created automatically by cloning the Central User who provisioned the workspace. |
| **Tenant Employee** | A user account within a tenant workspace who is not the Administrator. Added by the Tenant Admin. |
