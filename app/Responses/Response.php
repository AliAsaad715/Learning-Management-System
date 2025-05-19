<?php

namespace App\Responses;

use Illuminate\Http\JsonResponse;

class Response
{
    public static function success($data, $message, $code = 200): JsonResponse
    {
        return response()->json([
            'status' => true,
            'data' => $data,
            'message' => $message,
        ], $code);
    }

    public static function error($data, $message, $code = 500): JsonResponse
    {
        return response()->json([
            'status' => false,
            'data' => $data,
            'message' => $message,
        ], $code);
    }

    public static function validation($data, $message, $code = 422): JsonResponse
    {
        return response()->json([
            'status' => false,
            'data' => $data,
            'message' => $message,
        ], $code);
    }
}
