<?php

namespace App\Http\Middleware;

use App\Enums\CourseStatusEnum;
use App\Models\Course;
use App\Responses\Response;
use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CheckStudentSubscribed
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): JsonResponse
    {
        $id = $request->route('id');
        if(!Course::query()->where('status', 'approved')->find($id)) {
            return Response::error([], 'Course not found!', 404);
        } else if(auth('api')->user()->followed_courses->contains($id) || auth('api')->user()->published_courses->contains($id)) {
            return $next($request);
        }

        return Response::error([], 'You are not subscribed to this course!', 403);
    }
}
