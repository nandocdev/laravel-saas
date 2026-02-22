<?php

namespace App\Models;

use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;
use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Stancl\Tenancy\Database\Concerns\HasDomains;

class Tenant extends BaseTenant implements TenantWithDatabase
{
   use HasDatabase, HasDomains;

   /**
    * Determine if the tenant holds a valid, active subscription.
    *
    * @return bool
    */
   public function subscribed(): bool
   {
      // TODO: Replace with real subscription logic using Central database
      // e.g., checking plans/subscriptions relationship.
      return true;
   }
}
