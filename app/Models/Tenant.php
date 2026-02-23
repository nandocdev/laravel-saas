<?php

namespace App\Models;

use App\Central\Models\Subscription;
use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Stancl\Tenancy\Database\Concerns\HasDomains;
use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;

class Tenant extends BaseTenant implements TenantWithDatabase
{
    use HasDatabase, HasDomains;

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class, 'tenant_id', 'id');
    }

    /**
     * Determine if the tenant holds a valid, active subscription.
     */
    public function subscribed(): bool
    {
        $subscription = $this->subscriptions()->latest('created_at')->first();

        if (! $subscription) {
            return false;
        }

        return $subscription->isActive();
    }
}
