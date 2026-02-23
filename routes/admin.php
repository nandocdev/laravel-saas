<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin (Landlord) Routes
|--------------------------------------------------------------------------
|
| Routes for the central administration panel. Protected by the 'admin'
| guard. These routes handle plan management, tenant oversight, and
| subscription administration.
|
*/

foreach (config('tenancy.central_domains', []) as $domain) {
    Route::domain($domain)->group(function () {
        // ─── Guest (Admin Login) ─────────────────────────────────────────────
        Route::middleware('guest:admin')->prefix('admin')->name('admin.')->group(function () {
            Route::get('login', App\Livewire\Admin\Auth\Login::class)->name('login');
        });

        // ─── Authenticated Admin Panel ───────────────────────────────────────
        Route::middleware('auth:admin')->prefix('admin')->name('admin.')->group(function () {

            // Dashboard
            Route::get('/', App\Livewire\Admin\Dashboard::class)->name('dashboard');

            // Plans Management
            Route::get('plans', App\Livewire\Admin\Plans\Index::class)->name('plans.index');
            Route::get('plans/create', App\Livewire\Admin\Plans\Form::class)->name('plans.create');
            Route::get('plans/{plan}/edit', App\Livewire\Admin\Plans\Form::class)->name('plans.edit');

            // Tenants Management
            Route::get('tenants', App\Livewire\Admin\Tenants\Index::class)->name('tenants.index');
            Route::get('tenants/{tenant}', App\Livewire\Admin\Tenants\Show::class)->name('tenants.show');

            // Logout
            Route::post('logout', function () {
                auth('admin')->logout();
                request()->session()->invalidate();
                request()->session()->regenerateToken();

                return redirect()->route('admin.login');
            })->name('logout');
        });
    });
}
