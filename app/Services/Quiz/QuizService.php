<?php

namespace App\Services\Quiz;

use App\Http\Resources\Quiz\QuestionStudentResource;
use App\Http\Resources\Quiz\QuestionTeacherResource;
use App\Models\Episode;
use App\Models\Quiz;
use App\Models\QuizUser;

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
        return ['data' => $quiz_q, 'message' => 'You have just started the quiz! We wish you the best of luck. Focus well, read the questions carefully, and take your time to answer. We are confident in your abilities! Good luck!', 'code' => 200];
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

    public function getQuizResult($quiz_id): array
    {
        $user = auth('api')->user();
        $quiz_user = QuizUser::query()->where([
            ['user_id', $user['id']],
            ['quiz_id', $quiz_id],
        ])->first();
        if(is_null($quiz_user)) {
            return ['message' => 'Quiz or user not found!', 'code' => 404];
        }
        if($quiz_user->questions()->count() < Quiz::query()->findOrFail($quiz_id)->num_of_questions) {
            return ['message' => 'You have not answered all the questions yet! Please complete the entire quiz before viewing your result.', 'code' => 403];
        }
        if(is_null($quiz_user['success'])) {
            $data = $quiz_user->calculateQuizResult();
            $quiz_user->update(
                [
                    'mark' => $data['mark'],
                    'percentage_mark' => $data['percentage_mark'],
                    'success' => $data['success'],
                ]);
        }
        $data['mark'] = $quiz_user['mark']. '/' .$quiz_user->questions()->count();
        $data['percentage_mark'] = $quiz_user['percentage_mark'].'%';
        $data['success'] = $quiz_user['success'];
        if($data['success']) {
            $message = 'Congratulations '. $user['first_name'] .'! You passed the quiz!';
        } else {
            $message = 'You did not pass this time. Keep practicing, and you will get it!';
        }
        return ['data' => $data, 'message' => $message, 'code' => 200];
    }

}
