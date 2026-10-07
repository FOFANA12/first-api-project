<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class EditTaskDoneException extends Exception
{
    public function render(): JsonResponse {
        return response()->json(
                [
                    'message' => $this->message,
                    'is_error' => true,
                    'code_status' => Response::HTTP_BAD_REQUEST
                ],
                Response::HTTP_BAD_REQUEST
            );
    }
}
