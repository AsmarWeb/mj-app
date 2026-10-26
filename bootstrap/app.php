<?php

use App\Http\Middleware\CheckMaintenanceMode;
use App\Http\Middleware\EnsurePhoneIsVerified;
use App\Http\Middleware\SetLocale;
use App\Http\Middleware\SupplierMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Laratrust\Middleware\Ability;
use Laratrust\Middleware\Permission;
use Laratrust\Middleware\Role;
use Spatie\CookieConsent\CookieConsentMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(append: [
            CookieConsentMiddleware::class,
            SetLocale::class,
        ]);

        $middleware->validateCsrfTokens(except: [
            'stripe/webhook',
            'integrations/raslo/events/*',
        ]);

        $middleware->alias([
            'role' => Role::class,
            'permission' => Permission::class,
            'ability' => Ability::class,
            'phone.verified' => EnsurePhoneIsVerified::class,
            'supplier' => SupplierMiddleware::class,
            'maintenance.check' => CheckMaintenanceMode::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->shouldRenderJsonWhen(fn (\Illuminate\Http\Request $request, \Throwable $e) =>
            $request->is('api', 'api/*') || $request->expectsJson());
    })->create();
