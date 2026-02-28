<?php

namespace App\Livewire\Admin\Tenants;

use App\Central\Models\Subscription;
use App\Models\Tenant;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.admin')]
class Show extends Component
{
    public Tenant $tenant;

    public function mount(Tenant $tenant): void
    {
        $this->tenant = $tenant->load(['domains', 'subscriptions.plan']);
    }

    public function suspendTenant(): void
    {
        Subscription::where('tenant_id', $this->tenant->id)
            ->where('status', 'active')
            ->update(['status' => 'suspended']);

        $this->tenant->refresh();
    }

    public function activateTenant(): void
    {
        Subscription::where('tenant_id', $this->tenant->id)
            ->where('status', 'suspended')
            ->update(['status' => 'active']);

        $this->tenant->refresh();
    }

    public function render()
    {
        return view('livewire.admin.tenants.show', [
            'subscriptions' => $this->tenant->subscriptions()->with('plan')->latest()->get(),
            'domains' => $this->tenant->domains,
        ])->title("Tenant {$this->tenant->id} — Admin Panel");
    }
}
