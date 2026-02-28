<?php

namespace App\Livewire\Admin\Tenants;

use App\Central\Models\Subscription;
use App\Models\Tenant;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.admin')]
class Index extends Component
{
    public string $search = '';

    public string $statusFilter = '';

    public function suspendTenant(string $tenantId): void
    {
        Subscription::where('tenant_id', $tenantId)
            ->where('status', 'active')
            ->update(['status' => 'suspended']);
    }

    public function activateTenant(string $tenantId): void
    {
        Subscription::where('tenant_id', $tenantId)
            ->where('status', 'suspended')
            ->update(['status' => 'active']);
    }

    public function render()
    {
        $tenants = Tenant::with(['domains', 'subscriptions.plan'])
            ->when($this->search, fn ($q) => $q->where('id', 'like', "%{$this->search}%"))
            ->latest()
            ->get()
            ->map(function ($tenant) {
                $tenant->latestSubscription = $tenant->subscriptions->sortByDesc('created_at')->first();

                return $tenant;
            })
            ->when($this->statusFilter, function ($collection) {
                return $collection->filter(function ($tenant) {
                    $status = $tenant->latestSubscription?->status ?? 'none';

                    return $status === $this->statusFilter;
                });
            });

        return view('livewire.admin.tenants.index', [
            'tenants' => $tenants,
        ])->title('Tenants — Admin Panel');
    }
}
