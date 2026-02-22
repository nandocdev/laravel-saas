<?php

namespace Tests\Feature\Central;

use App\Central\Models\Plan;
use App\Central\Models\Subscription;
use App\Models\Tenant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TenantSubscriptionTest extends TestCase
{
   use RefreshDatabase;

   public function test_tenant_is_subscribed_when_active_subscription_exists()
   {
      $tenant = Tenant::create(['id' => 'foo']);
      $plan = Plan::create([
         'name' => 'Basic',
         'slug' => 'basic',
         'price' => 10.00,
      ]);

      Subscription::create([
         'tenant_id' => $tenant->id,
         'plan_id' => $plan->id,
         'status' => 'active',
         'starts_at' => now(),
         'ends_at' => now()->addMonth(),
      ]);

      $this->assertTrue($tenant->subscribed());
   }

   public function test_tenant_is_not_subscribed_when_subscription_is_expired()
   {
      $tenant = Tenant::create(['id' => 'bar']);
      $plan = Plan::create([
         'name' => 'Basic',
         'slug' => 'basic',
         'price' => 10.00,
      ]);

      Subscription::create([
         'tenant_id' => $tenant->id,
         'plan_id' => $plan->id,
         'status' => 'active',
         'starts_at' => now()->subMonths(2),
         'ends_at' => now()->subMonth(),
      ]);

      $this->assertFalse($tenant->subscribed());
   }

   public function test_tenant_is_not_subscribed_without_subscription()
   {
      $tenant = Tenant::create(['id' => 'baz']);

      $this->assertFalse($tenant->subscribed());
   }
}
