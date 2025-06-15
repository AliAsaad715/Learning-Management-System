<?php

namespace App\Http\Controllers\App;

use App\Http\Requests\Quiz\AnswerRequest;
use App\Http\Requests\Quiz\QuizRequest;
use App\Http\Requests\Quiz\ResultRequest;
use App\Responses\Response;
use App\Services\Quiz\QuizService;
use Illuminate\Http\JsonResponse;
use Throwable;

class QuizController extends Controller
{
    private QuizService $quizService;

    public function __construct(QuizService $quizService)
    {
        $this->quizService = $quizService;
    }

    //For Teacher
    public function store(QuizRequest $request): JsonResponse
    {
        $data = [];
        try {
            $data = $this->quizService->store($request->validated());
            return Response::success($data['data'], $data['message'], $data['code']);
        } catch (Throwable $th) {
            $message = $th->getMessage();
            return Response::error($data, $message);
        }
    }

    //For Teacher
    public function show($episode_id): JsonResponse
    {
        $data = [];
        try {
            $data = $this->quizService->show($episode_id);
            if($data['code'] == 404) {
                return Response::error([], $data['message'], $data['code']);
            }
            return Response::success($data['data'], $data['message'], $data['code']);
        } catch (Throwable $th) {
            $message = $th->getMessage();
            return Response::error($data, $message);
        }
    }

    //For Student
    public function startQuiz($episode_id): JsonResponse
    {
        $data = [];
        try {
            $data = $this->quizService->startQuiz($episode_id);
            if($data['code'] == 404 || $data['code'] == 409) {
                return Response::error([], $data['message'], $data['code']);
            }
            return Response::success($data['data'], $data['message'], $data['code']);
        } catch (Throwable $th) {
            $message = $th->getMessage();
            return Response::error($data, $message);
        }
    }

    //For Student
    public function processAnswer(AnswerRequest $request): JsonResponse
    {
        $data = [];
        try {
            $data = $this->quizService->processAnswer($request->validated());
            if($data['code'] == 404) {
                return Response::error([], $data['message'], $data['code']);
            }
            return Response::success($data['data'], $data['message'], $data['code']);
        } catch (Throwable $th) {
            $message = $th->getMessage();
            return Response::error($data, $message);
        }
    }

    //For Student
    public function calculateQuizResult($quiz_id, ResultRequest $request): JsonResponse
    {
        $data = [];
        try {
            $data = $this->quizService->calculateQuizResult($quiz_id, $request->validated());
            if($data['code'] == 404 || $data['code'] == 403 || $data['code'] == 409) {
                return Response::error([], $data['message'], $data['code']);
            }
            return Response::success($data['data'], $data['message'], $data['code']);
        } catch (Throwable $th) {
            $message = $th->getMessage();
            return Response::error($data, $message);
        }
    }

    //For Student
    public function getQuizResult($quiz_id): JsonResponse
    {
        $data = [];
        try {
            $data = $this->quizService->getQuizResult($quiz_id);
            if($data['code'] == 404) {
                return Response::error([], $data['message'], $data['code']);
            }
            return Response::success($data['data'], $data['message'], $data['code']);
        } catch (Throwable $th) {
            $message = $th->getMessage();
            return Response::error($data, $message);
        }
    }
}
