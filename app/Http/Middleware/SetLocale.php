<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    public function handle($request, Closure $next)
    {
        // Check if the user has a preferred locale stored in the session
        $preferredLocale = Session::get('locale');

        // If not, use the default locale from the config
        $locale = $preferredLocale ?? config('app.locale');

        // Set the application locale
        app()->setLocale($locale);

        // Continue with the request
        return $next($request);
    }
}
