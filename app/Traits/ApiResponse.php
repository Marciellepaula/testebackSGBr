<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponse
{
    public function success($data = null, string $message = 'Success', int $code = 200): JsonResponse
    {
        return response()->json([
            'status'  => 'success',
            'message' => $message,
            'data'    => $data
        ], $code);
    }

    public function error(string $message = 'Error', int $code = 400): JsonResponse
    {
        return response()->json([
            'status'  => 'error',
            'message' => $message,
            'data'    => null
        ], $code);
    }
}
