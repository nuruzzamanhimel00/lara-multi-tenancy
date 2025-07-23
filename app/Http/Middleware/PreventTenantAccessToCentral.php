<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PreventTenantAccessToCentral
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $centralDomains = config('tenancy.central_domains');
        $host = $request->getHost();
        // dd($host, tenancy()->initialized);

        // If current host is central AND a tenant is identified => block
        if (!in_array($host, $centralDomains)) {
        abort(403, 'Tenant users are not allowed to access the central domain.');
        }
        return $next($request);
    }
}
