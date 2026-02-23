<?php

declare(strict_types=1);

use App\Central\Http\Middleware\EnsureTenantIsSubscribed;
use App\Tenant\Controllers\Auth\LoginController;
use App\Tenant\Controllers\Auth\RegisterController;
use App\Tenant\Controllers\TenantDashboardController;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| These routes are loaded by the TenancyServiceProvider within a group
| that applies the tenancy initialization middleware. All routes here
| operate within the tenant's isolated database context.
|
*/

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {

    // ─── Public Landing ──────────────────────────────────────────
    Route::get('/', \App\Livewire\Tenant\PublicLanding::class)->name('tenant.home');

    // ─── Guest Auth Routes ───────────────────────────────────────
    Route::middleware('guest')->group(function () {
        Route::get('login', [LoginController::class, 'showLoginForm'])->name('tenant.login');
        Route::post('login', [LoginController::class, 'login']);

        Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('tenant.register');
        Route::post('register', [RegisterController::class, 'register']);
    });

    // ─── Authenticated + Subscribed Routes ───────────────────────
    Route::middleware(['auth', EnsureTenantIsSubscribed::class])->group(function () {

        // Dashboard
        Route::get('dashboard', [TenantDashboardController::class, 'index'])->name('tenant.dashboard');

        // Settings
        Route::get('settings/landing', \App\Livewire\Tenant\Settings\LandingSettings::class)->name('tenant.settings.landing');

        // Logout
        Route::post('logout', [LoginController::class, 'logout'])->name('tenant.logout');
    });
});
