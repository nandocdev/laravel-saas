# Use Cases

## 1. Introduction

This document describes the primary use cases for the **Laravel B2B SaaS Starter Kit**. It identifies the main actors and their interactions with the system.

---

## 2. Actors

| Actor | Description |
|---|---|
| **Visitor** | An unauthenticated user browsing the central landing page |
| **Central User** | A registered user on the central (Landlord) domain |
| **Tenant Admin** | The founding user of a workspace; has administrative privileges within their isolated tenant |
| **Tenant Employee** | A user invited to a tenant workspace by a Tenant Admin |
| **System** | Automated processes triggered by user actions (e.g., DB provisioning) |

---

## 3. Use Cases

### UC-01: Register a Central Account

**Actor:** Visitor  
**Preconditions:** User is not authenticated  
**Main Flow:**
1. Visitor navigates to the central registration page.
2. Visitor submits a registration form with name, email, and password.
3. System validates the input and creates a central user account.
4. System redirects the user to the workspace creation page.

**Postconditions:** A central user account is created.

---

### UC-02: Create a Workspace (Provision a Tenant)

**Actor:** Central User  
**Preconditions:** User is authenticated on the central domain  
**Main Flow:**
1. Central User accesses the workspace creation form.
2. Central User enters the desired workspace subdomain and name.
3. System validates the subdomain for uniqueness.
4. System provisions a new PostgreSQL database (`tenant_{id}`).
5. System runs tenant-specific migrations on the new database.
6. System creates a `Domain` record mapping the subdomain to the tenant.
7. System assigns a default starter subscription to the tenant.
8. System clones the Central User into the new tenant database as the initial Administrator.
9. System redirects the Central User to their new tenant subdomain.

**Postconditions:** A fully isolated tenant workspace is available at `{subdomain}.yourdomain.com`.

---

### UC-03: Log In to a Tenant Workspace

**Actor:** Tenant Admin / Tenant Employee  
**Preconditions:** A tenant workspace exists and the user has a tenant account  
**Main Flow:**
1. User navigates to the tenant subdomain (e.g., `acme.yourdomain.com`).
2. System identifies the tenant from the subdomain.
3. User submits login credentials.
4. System authenticates the user against the tenant-specific database.
5. User is redirected to the tenant dashboard.

**Postconditions:** User is authenticated within their isolated workspace.

---

### UC-04: Manage Workspace Settings

**Actor:** Tenant Admin  
**Preconditions:** Tenant Admin is authenticated in the workspace  
**Main Flow:**
1. Tenant Admin navigates to the Settings module.
2. Tenant Admin views and edits workspace configuration (e.g., name, branding).
3. System saves the updated settings to the tenant database.

**Postconditions:** Workspace settings are updated.

---

### UC-05: View Subscription Plans (Central)

**Actor:** Visitor / Central User  
**Preconditions:** None  
**Main Flow:**
1. User navigates to the central landing page.
2. System displays available subscription plans managed at the central level.
3. User can select a plan during or after workspace creation.

**Postconditions:** User is informed of available plans.

---

### UC-06: Log Out

**Actor:** Central User / Tenant Admin / Tenant Employee  
**Preconditions:** User is authenticated  
**Main Flow:**
1. User triggers the logout action.
2. System invalidates the session and redirects to the login page.

**Postconditions:** User session is terminated.
