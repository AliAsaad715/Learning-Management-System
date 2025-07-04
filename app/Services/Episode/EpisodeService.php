<?php

namespace App\Services\Episode;

use App\Http\Resources\Episode\EpisodeResource;
use App\Http\Resources\Episode\EpisodeWithDetailsResource;
use App\Models\Course;
use App\Models\Episode;
use Illuminate\Support\Facades\Storage;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;

class EpisodeService
{
    public function getToTeacher($course_id): array
    {
        $course = Course::query()
            ->where([
                'teacher_id' => auth('api')->id(),
                'course_id' => $course_id
            ])->first();
        if (is_null($course)) {
            return ['message' => 'Course not found', 'code' => 404];
        }
        $episodes = $course->episodes;
        return ['data' => EpisodeResource::collection($episodes), 'message' => 'Episodes retrieved successfully', 'code' => 200];
    }

    public function getToStudent($course_id): array
    {
        $user = auth('api')->user();
//        if (!$user->followed_courses()->where('course_id', $course_id)->exists()) {
//            return ['message' => 'You are not subscribe in this course', 'code' => 403];
//        }

        $course = Course::query()->find($course_id);
        if (is_null($course)) {
            return ['message' => 'Course not found', 'code' => 404];
        }
        $episodes = $course->episodes;
        return ['data' => EpisodeResource::collection($episodes), 'message' => 'Episodes retrieved successfully', 'code' => 200];
    }

    public function store($request, $course_id): array
    {
        $course = Course::query()
            ->where([
                'teacher_id' => auth('api')->id(),
                'id' => $course_id
            ])->first();
        if (is_null($course)) {
            return ['message' => 'Course not found!', 'code' => 404];
        }

        if (!($course->status == 'draft' || $course->stauts == 'rejected')) {
            return ['message' => 'You can\'t add an episode to the course if it has been ' . $course->status . '!', 'code' => 403];
        }

        $request['course_id'] = $course_id;
        $request['image_url'] = basename($request['image_url']->store('img/episodes', 'public'));
        $request['video_url'] = $request['video_url']->store('videos', 'public');

        $request['duration'] = FFMpeg::fromDisk('public')->open($request['video_url'])->getDurationInSeconds();
        $episode = Episode::query()->create($request);
        $course->update([
            'num_of_episodes' => $course->num_of_episodes + 1,
            'total_of_time' => $course['total_of_time'] + $request['duration'],
        ]);
        //  $fullPath = Storage::disk('public')->path($path);
        return ['data' => new EpisodeWithDetailsResource($episode), 'message' => 'Episode created successfully', 'code' => 201];
    }

    public function update($request, $id): array
    {
        $episode = Episode::query()->find($id);
        if (is_null($episode) ||
            !Course::query()
                ->where([
                    'user_id' => auth('api')->id(),
                    'id' => $episode->course_id,
                ])->exists()) {
            return ['message' => 'Episode not found', 'code' => 404];
        }
        $course = $episode->course;
        if (!($episode->course->status == 'draft' || $episode->course->stauts == 'rejected')) {
            return ['message' => 'You can\'t add an episode to the course if it has been ' . $episode->course->status . '!', 'code' => 403];
        }
        // delete and store
        $request['image_url'] = basename($request['image_url']->store('img/episodes', 'public'));
        $request['video_url'] = $request['video_url']->store('videos', 'public');
        //  $fullPath = Storage::disk('public')->path($path);
        $request['duration'] = FFMpeg::fromDisk('public')->open($request['video_url'])->getDurationInSeconds();
        $episode = Episode::query()->create($request);
        $course->update([
            'num_of_episodes' => $course->num_of_episodes + 1,
            'total_of_time' => $course['total_of_time'] + $request['duration'],
        ]);
        return ['data' => new EpisodeWithDetailsResource($episode), 'message' => 'Episode created successfully', 'code' => 201];
    }

    public function show($id): array
    {
        $user = auth('api')->user();
        $episode = Episode::query()->find($id);
        if (is_null($episode)) {
            return ['message' => 'Episode not found', 'code' => 404];
        }
        if (!($user->followed_courses()->where('course_id', $episode->course->id)->exists() || $episode->episode_number == 1 ||
            $user->published_courses()->where('course_id', $episode->course->id)->exists())) {
            return ['message' => 'You are not subscribe this course', 'code' => 403];
        }

        return ['data' => new EpisodeWithDetailsResource($episode), 'message' => 'Episode retrieved successfully', 'code' => 200];
    }

    public function destroy($id): array
    {
        $user = auth('api')->user();
        $episode = Episode::query()->find($id);
        if (is_null($episode) || !$user->published_courses()->where('course_id', $episode->course->id)->exists()) {
            return ['message' => 'Episode not found', 'code' => 404];
        }

        $course = $episode->course;
        if (!($course->status == 'draft' || $course->stauts == 'rejected')) {
            return ['message' => 'You can\'t delete an episode to the course if it has been ' . $course->status . '!', 'code' => 403];
        }

        $episode->delete();

        return ['message' => 'Episode deleted successfully', 'code' => 200];
    }

    // Add Like to specific episode.
    public function addLike($id): array
    {
        $episode = Episode::query()->find($id);
        if(is_null($episode)) {
            return ['message' => 'Episode not found!', 'code' => 404];
        }
        if($episode->userLikes()->where('user_id', auth('api')->id())->exists()) {
            return ['message' => 'You\'ve already liked this comment!', 'code' => 401];
        }
        $episode->userLikes()->attach(auth('api')->id());
        $episode->update([
            'likes' => $episode->likes + 1,
        ]);
        return ['data' => new EpisodeResource($episode), 'message' => 'Comment liked successfully', 'code' => 200];
    }
}
