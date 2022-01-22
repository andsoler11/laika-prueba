<?php

namespace App\Http\Middleware;


use Closure;
use Illuminate\Http\Request;

class ApiMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $header = $request->header('token');
        if (!$header || $header != 'api-key-laika') {
            abort(403, "not authorized!");
        }

        return $next($request);
    }
}