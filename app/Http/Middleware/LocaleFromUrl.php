<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class LocaleFromUrl
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $segments = $request->segments();

        if (config('app.supported_locales'))
        {
            $supportedLocales = config('app.supported_locales');
            Log::info($supportedLocales);
        }
        else
            $supportedLocales = ['en', 'ru'];

       if (count($segments) > 1)
        {
            $locale = $segments[1];
            
            if (in_array($locale, $supportedLocales))
            {
                App::setLocale($locale);
            }
        }

        return $next($request);
    }
}
