<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\JsonResponse;

abstract class Controller
{
    protected function jsonResponse(mixed $data, int $httpCode): JsonResponse
    {
        return response()->json($data, $httpCode);
    }
}
