<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ForceJsonResponse
{
    public function handle(Request $request, Closure $next): Response
    {
        // Forzar JSON en la solicitud
        $request->headers->set('Accept', 'application/json');

        $response = $next($request);

        // Convertir respuestas no-JSON
        if (!$response instanceof JsonResponse) {
            $response = new JsonResponse(
                ['data' => $response->content()],
                $response->status(),
                $response->headers->all()
            );
        }

        // Cabeceras adicionales
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('X-Content-Type-Options', 'nosniff');

        return $response;
    }
}