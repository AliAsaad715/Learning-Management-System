<?php

namespace App\Services\Episode;

use App\Enums\CourseStatusEnum;
use App\Http\Resources\Episode\EpisodeResource;
use App\Http\Resources\Episode\EpisodeWithDetailsResource;
use App\Models\Course;
use App\Models\Episode;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;

class EpisodeService
{
    public function getToTeacher($course_id): array
    {
        $course = Course::query()
            ->where([
                'teacher_id' => auth('api')->id(),
                'id' => $course_id
            ])->first();
        if (is_null($course)) {
            return ['message' => 'Course not found!', 'code' => 404];
        }
        $episodes = $course->episodes;
        return ['data' => EpisodeResource::collection($episodes), 'message' => 'Episodes retrieved successfully', 'code' => 200];
    }

    public function getToStudent($course_id): array
    {
        $user = auth('api')->user();
        $course = $user->followed_courses()->where('course_id', $course_id)->first();
        $episodes['episodes'] = EpisodeResource::collection($course->episodes);
        $episodes['progress_percentage'] = $course->pivot->perc_progress . '%';
        return ['data' => $episodes, 'message' => 'Episodes retrieved successfully', 'code' => 200];
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

        if (!($course->status == 'draft' || $course->status == 'rejected')) {
            return ['message' => 'You can\'t add an episode to the course if it has been ' . $course->status . '!', 'code' => 403];
        }

        $request['course_id'] = $course_id;
        $request['image_url'] = $request['image_url']->store('img/episodes', 'public');
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
                    'teacher_id' => auth('api')->id(),
                    'id' => $episode->course_id,
                ])->exists()) {
            return ['message' => 'Episode not found!', 'code' => 404];
        }

        $course = $episode->course;
        if (!($episode->course->status == 'draft' || $episode->course->stauts == 'rejected')) {
            return ['message' => 'You can\'t update an episode to the course if it has been ' . $episode->course->status . '!', 'code' => 403];
        }

        Storage::disk('public')->delete($episode->image_url);
        Storage::disk('public')->delete($episode->video_url);
        $request['image_url'] = $request['image_url']->store('img/episodes', 'public');
        $request['video_url'] = $request['video_url']->store('videos', 'public');
        $request['duration'] = FFMpeg::fromDisk('public')->open($request['video_url'])->getDurationInSeconds();
        $episode->update($request);
        return ['data' => new EpisodeWithDetailsResource($episode), 'message' => 'Episode updated successfully', 'code' => 200];
    }

    public function showToTeacher($id): array
    {
        $user = auth('api')->user();
        $episode = Episode::query()->find($id);
        if (is_null($episode) ||
            !Course::query()
                ->where([
                    'teacher_id' => $user->id,
                    'id' => $episode->course_id,
                ])->exists()) {
            return ['message' => 'Episode not found!', 'code' => 404];
        }

        return ['data' => new EpisodeWithDetailsResource($episode), 'message' => 'Episode retrieved successfully', 'code' => 200];
    }

    public function showToStudent($id): array
    {
        $user = auth('api')->user();
        $episode = Episode::query()->find($id);
        if (is_null($episode) ||
            !Course::query()
                ->where([
                    'status' => CourseStatusEnum::APPROVED,
                    'id' => $episode->course_id,
                ])->exists()) {
            return ['message' => 'Episode not found!', 'code' => 404];
        }

        if (!($user->followed_courses()->where('course_id', $episode->course->id)->exists() || $episode->episode_number == 1 ||
            $user->published_courses()->where('id', $episode->course->id)->exists())) {
            return ['message' => 'You are not subscribed to this course', 'code' => 403];
        }

        return ['data' => new EpisodeWithDetailsResource($episode), 'message' => 'Episode retrieved successfully', 'code' => 200];
    }

    public function destroy($id): array
    {
        $user = auth('api')->user();
        $episode = Episode::query()->find($id);
        if (is_null($episode) || !$user->published_courses()->where('id', $episode->course->id)->exists()) {
            return ['message' => 'Episode not found!', 'code' => 404];
        }

        $course = $episode->course;
        if (!($course->status == 'draft' || $course->status == 'rejected')) {
            return ['message' => 'You can\'t delete an episode to the course if it has been ' . $course->status . '!', 'code' => 403];
        }

        $min_episode = Episode::query()->withTrashed()->where('course_id', $course->id)->orderBy('episode_number')->first();
        $episode->update([
            'episode_number' => $min_episode->episode_number - 1,
        ]);

        $episode->delete();
        foreach ($course->episodes as $episode) {
            if ($episode->id != $id) {
                $episode->update([
                    'episode_number' => $episode->episode_number - 1
                ]);
            }
        }

        return ['message' => 'Episode deleted successfully', 'code' => 200];
    }

    // Finish an episode when the student has watched it completely.
    public function finish_episode($id): array
    {
        $user = User::query()->find(auth('api')->id());
        $episode = Episode::query()->find($id);
        if($user->episodes()->where('episode_id', $id)->exists()) {
            return ['message' => 'This episode has been watched before!', 'code' => 409];
        }

        // episode has been watched
        $user->episodes()->attach($episode);
        $episode->views++;
        $episode->save();

        // update progress in course
        $course = $user->followed_courses()->wherePivot('course_id', $episode->course->id)->first();
        $progress = ++$course->pivot->progress;
        $course->save();
        $course->pivot->update(['perc_progress' => ($progress * 100) / $episode->course->episodes->count()]);

        // update activity of user
        $user->moreDetail->is_active_today = true;
        $user->moreDetail->save();

        return ['message' => 'User today is active', 'code' => 200];
    }

    // Add Like to specific episode.
    public function addLikeToEpisode($id): array
    {
        $user = auth('api')->user();
        $episode = Episode::query()->find($id);

        if($episode->userLikes()->where('user_id', auth('api')->id())->exists()) {
            return ['message' => 'You\'ve already liked this episode!', 'code' => 409];
        }

        if(!$user->episodes()->where('episode_id', $episode->id)->exists()) {
            return ['message' => 'You must watch the episode before you can like it.', 'code' => 403];
        }
        $episode->userLikes()->attach(auth('api')->id());
        $episode->increment('likes');

        return ['data' => new EpisodeWithDetailsResource($episode), 'message' => 'Episode liked successfully', 'code' => 200];
    }

    // Remove Like from specific episode.
    public function removeLikeFromEpisode($id): array
    {
        $user_id = auth('api')->id();
        $episode = Episode::query()->find($id);
        if(!$episode->userLikes()->where('user_id', $user_id)->exists()) {
            return ['message' => 'You don\'t have a like for this episode!', 'code' => 404];
        }

        $episode->userLikes()->detach($user_id);
        $episode->decrement('likes');
        return ['data' => new EpisodeWithDetailsResource($episode), 'message' => 'Episode unliked successfully', 'code' => 200];
    }
}
