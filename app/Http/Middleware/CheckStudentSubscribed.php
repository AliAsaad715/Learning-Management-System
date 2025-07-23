<?php

namespace App\Http\Middleware;

use App\Enums\CourseStatusEnum;
use App\Models\Course;
use App\Models\Episode;
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
    public function handle(Request $request, Closure $next)
    {
        $id = $request->route('course_id');

        if(is_null($id)) {
            $id = $request->route('id');
            $episode = Episode::query()->find($id);
            if(!$episode || !Course::query()->where('status', CourseStatusEnum::APPROVED)->find($episode->course_id)) {
                return Response::error('Episode not found!', 404);
            }
            $id = $episode->course_id;
        } else {
            if (!Course::query()->where('status', CourseStatusEnum::APPROVED)->find($id)) {
                return Response::error('Course not found!', 404);
            }
        }

        if(auth('api')->user()->followed_courses->contains($id) || auth('api')->user()->published_courses->contains($id)) {
            return $next($request);
        }

        return Response::error('You are not subscribed to this course!', 403);
    }
}
