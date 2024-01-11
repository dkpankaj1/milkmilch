<?php

namespace App\Http\Middleware;

use App\Traits\HttpResponses;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckApiRole
{
    use HttpResponses;
    public function handle(Request $request, Closure $next, ...$roles): Response
    {

        if ($request->user()) {

            foreach ($roles as $role) {
                if ($request->user()->role->name == $role) {
                    return $next($request);
                }
            }
        }

       $this->sendHttpResponseException('Forbidden',['error' => 'Forbidden'], 403);

    }
}
