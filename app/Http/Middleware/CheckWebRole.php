<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckWebRole
{

    public function handle(Request $request, Closure $next, ...$roles): Response
    {

        if ($request->user()) {

            foreach ($roles as $role) {
                if ($request->user()->role->name == $role) {
                    return $next($request);
                }
            }
        }

        abort(403, 'Unauthorized');

    }
}
