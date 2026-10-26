<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class MobileLocale
{
    public function handle(Request $request, Closure $next)
    {
        $locale = $request->getPreferredLanguage(['en', 'ar']) ?? 'en';
        app()->setLocale($locale);
        $response = $next($request);
        $response->headers->set('Content-Language', $locale);
        $response->headers->set('Referrer-Policy', 'no-referrer');
        $response->setVary('Accept-Language', false);

        return $response;
    }
}
