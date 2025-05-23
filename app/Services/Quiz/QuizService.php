<?php

namespace App\Services\Quiz;

use App\Models\Quiz;
use Illuminate\Support\Facades\Auth;

class QuizService
{
    public function index(): array
    {
        $quizzes = Quiz::all();
        return ['data' => $quizzes, 'message' => 'Quizzes retrieved successfully'];
    }

    public function store($request): array
    {
        $user = Auth::user();
        $quiz = [];
        if($user['role'] == 'teacher') {
            $quiz = Quiz::query()->create([
                'episode_id' => $request['episode_id'],
                'num_of_questions' => $request['num_of_questions'],
            ]);
            $message = 'Quiz created successfully';
            $code = 201;
        } else {
            $message = 'You do not have permission to create quiz!';
            $code = 401;
        }
        return ['data' => $quiz, 'message' => $message, 'code' => $code];
    }

    public function update($request, $id): array
    {
        $user = Auth::user();
        $quiz = Quiz::query()->find($id);
        if(!is_null($quiz)) {
            if($user['role'] == 'teacher') {
                $quiz->update([
                    'episode_id' => $request['episode_id'] ?? $quiz['episode_id'],
                    'num_of_questions' => $request['num_of_questions'] ?? $quiz['num_of_questions'],
                ]);
                $message = 'Quiz updated successfully';
                $code = 200;
            } else {
                $message = 'You do not have permission to update quiz!';
                $code = 401;
            }
        } else {
            $message = 'Quiz not found!';
            $code = 404;
        }
        return ['data' => $quiz, 'message' => $message, 'code' => $code];
    }

    public function destroy($id): array
    {
        $quiz = Quiz::query()->find($id);
        if(!is_null($quiz)) {
            $quiz->delete();
            $message = 'Quiz deleted successfully';
            $code = 204;
        } else {
            $message = 'Quiz not found!';
            $code = 404;
        }
        return ['data' => [], 'message' => $message, 'code' => $code];
    }
}
