<?php

namespace App\Http\Middleware;

use App\Enums\RoleEnum;
use App\Responses\Response;
use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CheckTeacher
{
    public function handle(Request $request, Closure $next): JsonResponse
    {
        if(auth('api')->user()->role === RoleEnum::TEACHER) {
            return $next($request);
        }

        return Response::error([], 'Unauthorized. Only teachers are allowed!', 403);
    }

}
