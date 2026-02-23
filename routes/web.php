<?php

use Illuminate\Support\Facades\Route;

foreach (config('tenancy.central_domains', []) as $domain) {
    Route::domain($domain)->group(function () {
        Route::get('/', function () {
            return view('welcome');
        })->name('home');

        Route::get('dashboard', \App\Livewire\Onboarding\CreateWorkspace::class)
            ->middleware(['auth', 'verified'])
            ->name('dashboard');

        require __DIR__ . '/settings.php';
    });
}
