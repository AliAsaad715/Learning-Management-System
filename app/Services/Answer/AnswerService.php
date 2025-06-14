<?php

namespace App\Services\Answer;

use App\Models\Question;
use App\Models\QuizUser;

class AnswerService
{
    public function store($request): array
    {
        $user = auth('api')->user();
        $quiz_user = QuizUser::query()->where([
            ['user_id', $user['id']],
            ['quiz_id', $request['quiz_id']],
        ])->first();
        if(is_null($quiz_user)) {
            return ['message' => 'Quiz or user not found!', 'code' => 404];
        }
        $question = Question::query()->find($request['question_id']);
        if($question->quiz_id != $request['quiz_id'] || is_null($question)) {
            return ['message' => 'Question not found!', 'code' => 404];
        }
        if($quiz_user->questions()->where('question_id', $question->id)->exists()) {
            return ['message' => 'You have already answered this question!', 'code' => 409];
        }
        $quiz_user->questions()->attach($request['question_id'],
        [
            'student_answer' => $request['answer'],
            'is_correct' => $question->right_answer == $request['answer']
        ]);
        if($question->right_answer == $request['answer']) {
            $message = 'Great job, '. $user['first_name'] .'! That is the right answer!';
        } else {
            $message = 'Oops, '. $user['first_name'] .'! That is not correct. Do not worry, try to focus more!';
        }
        $data['right_answer'] = $question->right_answer;
        $data['explanation'] = $question->explanation;
        return ['data' => $data, 'message' => $message, 'code' => 200];
    }
}
