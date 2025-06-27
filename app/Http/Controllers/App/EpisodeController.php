<?php

namespace App\Http\Controllers\App;

use App\Models\Course;
use App\Models\Episode;
use App\Models\MoreDetail;
use App\Models\User;
use App\Responses\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EpisodeController extends Controller
{

    public function indexEpisode($courseId){

        $course=Course::find($courseId);
        if(!$course)
            return Response::error([], 'course not found', 404);
        $userId = Auth::id();
        if(!$course->studentSubscribe($userId))
            return Response::error([], 'no access you must subscribe', 403);

        $episodes = Episode::where('course_id',$courseId)->get();
        if($episodes->isEmpty())
            return Response::error([], 'no episodes in this course', 404);

        return Response::success($episodes, 'get episodes successfully');
    }

    public function showEpisode($episodeId){

        $episode=Episode::find($episodeId);
        if(!$episode)
            return Response::error([], 'episode not found', 404);
        $course = $episode->course;
         $userId = Auth::id();
            if(!$course->studentSubscribe($userId))
                return Response::error([], 'no access you must subscribe', 403);
         return Response::success($episode, 'get episode successfully');
    }

    public function finish_episode(Episode $episode)
    {
        $user = auth()->user();
        
        if($user->episodes()->where($episode->id)->first())
            return response()->json([
                'message' => 'This episode has been watched before'
            ]);

        // episode has been watched
        $user->episodes()->attach($episode);
        $episode->views->increment();
        $episode->save();

        // update progress in course
        $course = $user->followed_courses()->where($episode->course->id);
        $progress = $course->pivot->progress->increment();
        $course->save();
        $course->pivot->update(['perc_progress' => ($progress * 100) / $episode->course->episodes->count()]);
        
        // update activity of user
        $user->more_details->is_active_today = true;
        $user->more_details->save();
        
        return response()->json([
            'message' => 'user today is active'
        ], 200);
    }
}
