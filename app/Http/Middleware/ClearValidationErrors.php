<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ClearValidationErrors
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
        // Proceed with the request
        $response = $next($request);

        // Clear validation errors after response is sent
        session()->forget('errors');

        return $response;
    }
}
