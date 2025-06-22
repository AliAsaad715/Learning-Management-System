<?php

namespace App\Services\Quiz;

use App\Http\Resources\Quiz\QuestionStudentResource;
use App\Http\Resources\Quiz\QuestionTeacherResource;
use App\Http\Resources\Quiz\ResultResource;
use App\Models\Episode;
use App\Models\Question;
use App\Models\Quiz;

class QuizService
{
    public function store($request): array
    {
        $quiz = Quiz::query()->create([
            'episode_id' => $request['episode_id'],
            'num_of_questions' => $request['num_of_questions'],
        ]);

        $quiz->questions()->createMany($request['questions']);
        return ['data' => $quiz, 'message' => 'Quiz created successfully', 'code' => 201];
    }

    public function show($episode_id): array
    {
        $episode = Episode::query()->find($episode_id);
        if(is_null($episode)) {
            return ['message' => 'Episode not found!', 'code' => 404];
        }
        $quiz = $episode->quiz;
        $questions = $quiz->questions->all();
        $quiz_q['quiz_id'] = $quiz->id;
        $quiz_q['num_of_questions'] = $quiz->num_of_questions;
        $quiz_q['questions'] = QuestionTeacherResource::collection($questions);
        return ['data' => $quiz_q, 'message' => 'Quiz retrieved successfully', 'code' => 200];
    }

    public function startQuiz($episode_id): array
    {
        $user = auth('api')->user();
        $quiz = Episode::query()->findOrFail($episode_id)->quiz;
        if(is_null($quiz)) {
            return ['message' => 'There is no quiz for this episode.', 'code' => 404];
        }
        if($user->quizzes()->where('quiz_id', $quiz->id)->first()) {
            return ['message' => 'It looks like you have already completed this quiz.Our quizzes are generally set up for a single attempt.', 'code' => 409];
        }
        $user->quizzes()->attach($quiz->id);
        $quiz_q['quiz_id'] = $quiz->id;
        $quiz_q['num_of_questions'] = $quiz->num_of_questions;
        $quiz_q['questions'] = QuestionStudentResource::collection($quiz->questions);
        return ['data' => $quiz_q, 'message' => 'You have just started the quiz! Focus well, read the questions carefully, We are confident in your abilities! Good luck!', 'code' => 200];
    }

    public function processAnswer($request): array
    {
        $user = auth('api')->user();
        $quiz = Quiz::query()->findOrFail($request['quiz_id']);
        $question = $quiz->questions()->where('question_number', $request['question_number'])->first();
        if(is_null($question)) {
            return ['message' => 'Question not found!', 'code' => 404];
        }
        if($question->right_answer == $request['answer']) {
            $data['is_correct'] = true;
            $message = 'Great job, '. $user['first_name'] .'! That is the right answer!';
        } else {
            $data['is_correct'] = false;
            $message = 'Oops, '. $user['first_name'] .'! That is not correct. Do not worry, try to focus more!';
        }
        $data['right_answer'] = $question->right_answer;
        $data['explanation'] = $question->explanation;
        return ['data' => $data, 'message' => $message, 'code' => 200];
    }

    public function calculateQuizResult($quiz_id, $request): array
    {
        $user = auth('api')->user();
        if(is_null($user->quizzes()->wherePivot('quiz_id', $quiz_id)->first())) {
            return ['message' => 'You have not started this quiz yet.', 'code' => 404];
        }
        $quiz_user = $user->quizzes()->wherePivot('quiz_id', $quiz_id)->first()->pivot;
        if(!is_null($quiz_user->success)) {
            return ['message' => 'You have already taken your result', 'code' => 409];
        }

        if(count($request) < Quiz::query()->findOrFail($quiz_id)->num_of_questions) {
            return ['message' => 'You have not answered all the questions yet! Please complete the entire quiz before viewing your result.', 'code' => 403];
        }

        $mark = 0;
        foreach($request as $question) {
            if($question['answer'] == Question::query()->findOrFail($question['question_id'])->right_answer) {
                $mark++;
            }
        }
        $percentage_mark = round($mark / count($request) * 100, 2);
        $quiz_user->update(
        [
            'mark' => $mark,
            'percentage_mark' => $percentage_mark,
            'success' => $percentage_mark >= 60 ? 1 : 0,
        ]);
        $result = new ResultResource($quiz_user);
        if($result['success']) {
            $message = 'Congratulations '. $user['first_name'] .'! You passed the quiz!';
        } else {
            $message = 'You did not pass this time. Keep practicing, and you will get it!';
        }
        return ['data' => $result, 'message' => $message, 'code' => 200];
    }

    public function getQuizResult($quiz_id): array
    {
        $user = auth('api')->user();
        if(is_null($user->quizzes()->wherePivot('quiz_id', $quiz_id)->first())) {
            return ['message' => 'You have not started this quiz yet.', 'code' => 404];
        }
        $quiz_user = $user->quizzes()->wherePivot('quiz_id', $quiz_id)->first()->pivot;
        $result = new ResultResource($quiz_user);
        return ['data' => $result, 'message' => 'Result retrieved successfully', 'code' => 200];
    }

}
