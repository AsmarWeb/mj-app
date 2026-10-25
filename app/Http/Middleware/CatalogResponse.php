<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CatalogResponse
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        $response->headers->set('Cache-Control', 'no-store');
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('X-API-Version', '1');
        if (! $request->is('api/v1/*')) {
            $response->headers->set('X-API-Deprecated', 'true');
        }

        return $response;
    }
}
