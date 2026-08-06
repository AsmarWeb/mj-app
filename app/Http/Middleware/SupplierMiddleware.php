<?php

namespace App\Http\Middleware;

use Closure;

class SupplierMiddleware
{

    public function handle($request, Closure $next)
    {


        if(
            !auth()->check()
        ){

            return redirect()
                ->route('login');

        }



        if(
            !auth()->user()->supplier
        ){

            abort(403,'Supplier access only');

        }



        return $next($request);


    }

}