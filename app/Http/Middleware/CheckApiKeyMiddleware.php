<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckApiKeyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->hasHeader('API_KEY')) {
            return response()->json(['message' => 'La clé client "API_KEY" est obligatoire'], Response::HTTP_BAD_REQUEST);
        }

        $response = $next($request);

        $key = $request->header('API_KEY');
        $response->header('API_KEY', $key);

        return $response;
    }
}
