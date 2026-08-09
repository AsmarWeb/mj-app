<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Setting;
use Symfony\Component\HttpFoundation\Response;

class CheckMaintenanceMode
{
    public function handle(Request $request, Closure $next): Response
    {
        $setting = Setting::first();

        if (
            $setting &&
            $setting->maintenance_mode &&
            !auth()->check()
        ) {
            return response()->view('maintenance', [], 503);
        }

        return $next($request);
    }
}