<?php

namespace App\Central\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureTenantIsSubscribed
{
   /**
    * Handle an incoming request.
    *
    * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
    */
   public function handle(Request $request, Closure $next): Response
   {
      $tenant = tenant();

      if ($tenant && ! $tenant->subscribed()) {
         abort(402, 'Su suscripción no está activa. Por favor, renueve su plan para continuar.');
      }

      return $next($request);
   }
}
