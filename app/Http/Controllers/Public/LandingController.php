<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LandingController extends Controller
{
    public function index(Request $request, $tenant_slug = null)
    {
        // 1. Detect tenant by slug or use current tenant from multitenancy middleware
        // Assuming there is a Tenant model. If Spatie is used:
        $tenantMode = class_exists(\Spatie\Multitenancy\Models\Tenant::class);
        $tenant = null;

        if ($tenantMode && \Spatie\Multitenancy\Models\Tenant::checkCurrent()) {
            $tenant = \Spatie\Multitenancy\Models\Tenant::current();
        } else {
            // Alternatively, resolve from DB directly if provided via URL param
            $tenant = \DB::table('tenants')->where('id', $tenant_slug)->first();
            if (! $tenant) {
                abort(404, 'Tenant not found');
            }
        }

        $tenantId = $tenant->id ?? $tenant->tenant_id ?? $tenant_slug;

        // 2. Load landing config
        $settings = \App\Models\TenantLandingSetting::with('template')
            ->where('tenant_id', $tenantId)
            ->first();

        // Safe fallback template if not configured
        $template = $settings?->template?->slug ?? 'corporate';

        // 3. Load active sections ordered
        $sections = \App\Models\LandingSection::where('tenant_id', $tenantId)
            ->where('is_active', true)
            ->orderBy('order')
            ->get();

        // 4. Render selected template
        return view("landing.templates.{$template}", compact('tenant', 'settings', 'sections'));
    }
}
