<?php

namespace App\Http\Controllers\App;

use App\Http\Requests\Episode\EpisodeRequest;
use App\Models\Course;
use App\Models\Episode;
use App\Responses\Response;
use App\Services\Episode\EpisodeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Throwable;

class EpisodeController extends Controller
{
    private EpisodeService $episodeService;

    public function __construct(EpisodeService $episodeService)
    {
        $this->episodeService = $episodeService;
    }

    public function indexToStudent($course_id)
    {
        $data = [];
        try {
            $data = $this->episodeService->indexToStudent($course_id);
            if($data['code'] == 403 || $data['code'] == 404) {
                return Response::error([], $data['message'], $data['code']);
            }
            return Response::success($data['data'], $data['message'], $data['code']);
        } catch (Throwable $th) {
            $message = $th->getMessage();
            return Response::error($data, $message);
        }
    }

    public function store(EpisodeRequest $request, $course_id): JsonResponse
    {
        $data = [];
        try {
            $data = $this->episodeService->store($request->validated(), $course_id);
            if($data['code'] == 403 || $data['code'] == 404) {
                return Response::error([], $data['message'], $data['code']);
            }
            return Response::success($data['data'], $data['message'], $data['code']);
        } catch (Throwable $th) {
            $message = $th->getMessage();
            return Response::error($data, $message);
        }
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
