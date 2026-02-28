<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Stancl\Tenancy\Middleware\ScopeSessions as BaseScopeSessions;
use Symfony\Component\HttpFoundation\Response;

class ScopeSessions extends BaseScopeSessions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next): Response
    {
        if (function_exists('tenancy') && tenancy()->initialized) {
            return parent::handle($request, $next);
        }

        return $next($request);
    }
}
