<?php

namespace App\Services\Quiz;

use App\Models\Episode;
use App\Models\Quiz;
use Illuminate\Support\Facades\Auth;

class QuizService
{
    public function index(): array
    {
        $courses = auth('api')->user()->published_courses()->with(['episodes.quiz'])->get();
        $episodes = [];
        $all_episodes = [];
        foreach ($courses as $course) {
            $episodes = $course->episodes->all();
            $all_episodes = $episodes;
        }
        $quizzes = [];
        foreach ($all_episodes as $episode) {
            $quizzes[] = $episode->quiz;
        }
        return ['data' => $quizzes, 'message' => 'Quizzes retrieved successfully'];
    }

    public function store($request): array
    {
        $quiz = Quiz::query()->create([
            'episode_id' => $request['episode_id'],
            'num_of_questions' => $request['num_of_questions'],
        ]);
        return ['data' => $quiz, 'message' => 'Quiz created successfully', 'code' => 201];
    }

    public function update($request, $id): array
    {
        $quiz = Quiz::query()->find($id);
        if(is_null($quiz)) {
            return ['message' => 'Quiz not found!', 'code' => 404];
        }
        $quiz->update([
            'episode_id' => $request['episode_id'] ?? $quiz['episode_id'],
            'num_of_questions' => $request['num_of_questions'] ?? $quiz['num_of_questions'],
        ]);
        return ['data' => $quiz, 'message' => 'Quiz updated successfully', 'code' => 200];
    }

    public function show($id): array
    {
        $quiz = Episode::query()->find($id)->quiz;
        return ['data' => $quiz, 'message' => 'Quiz retrieved successfully', 'code' => 200];
    }

    public function destroy($id): array
    {
        $quiz = Quiz::query()->find($id);
        if(is_null($quiz)) {
            return ['message' => 'Quiz not found!', 'code' => 404];
        }
        $quiz->delete();
        return ['message' => 'Quiz deleted successfully', 'code' => 204];
    }
}
