<?php

namespace Tests\Feature\Central;

use App\Central\Http\Middleware\EnsureTenantIsSubscribed;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Mockery;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Tests\TestCase;

class EnsureTenantIsSubscribedTest extends TestCase
{
   /**
    * Test that a subscribed tenant can pass through the middleware.
    *
    * @return void
    */
   public function test_subscribed_tenant_passes_middleware()
   {
      // Mock a tenant that is subscribed
      $tenant = Mockery::mock(Tenant::class)->makePartial();
      $tenant->shouldReceive('subscribed')->andReturn(true);

      // Bind the tenant to the tenancy instance manually for this request context
      app(\Stancl\Tenancy\Tenancy::class)->initialize($tenant);

      $request = Request::create('/tenant-route', 'GET');

      $middleware = new EnsureTenantIsSubscribed();

      $response = $middleware->handle($request, function () {
         return response('Passed', 200);
      });

      $this->assertEquals(200, $response->getStatusCode());

      // Clean up tenancy
      app(\Stancl\Tenancy\Tenancy::class)->end();
   }

   /**
    * Test that an unsubscribed tenant is aborted with 402.
    *
    * @return void
    */
   public function test_unsubscribed_tenant_aborts_with_402()
   {
      // Mock a tenant that is NOT subscribed
      $tenant = Mockery::mock(Tenant::class)->makePartial();
      $tenant->shouldReceive('subscribed')->andReturn(false);

      // Bind the tenant to the tenancy instance manually for this request context
      app(\Stancl\Tenancy\Tenancy::class)->initialize($tenant);

      $request = Request::create('/tenant-route', 'GET');

      $middleware = new EnsureTenantIsSubscribed();

      $this->expectException(HttpException::class);
      $this->expectExceptionMessage('Su suscripción no está activa. Por favor, renueve su plan para continuar.');

      try {
         $middleware->handle($request, function () {
            return response('Passed', 200);
         });
      } finally {
         // Guarantee cleanup
         app(\Stancl\Tenancy\Tenancy::class)->end();
      }
   }
}
