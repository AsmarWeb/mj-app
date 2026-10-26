<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;

class RequireMobileToken
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->user()?->currentAccessToken();
        abort_unless($request->bearerToken() && $token instanceof PersonalAccessToken, 401);
        abort_unless(in_array('mobile:account', $token->abilities ?? [], true), 403);

        return $next($request);
    }
}
