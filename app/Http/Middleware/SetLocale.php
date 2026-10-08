<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    public const SUPPORTED_LOCALES = ['fr', 'en'];

    public function handle(Request $request, Closure $next): Response
    {
        if ($request->hasHeader('Accept-Language')) {
            app()->setLocale($request->getPreferredLanguage(self::SUPPORTED_LOCALES));
        }

        $response = $next($request);
        $response->headers->set('Content-Language', app()->getLocale());

        return $response;
    }
}
