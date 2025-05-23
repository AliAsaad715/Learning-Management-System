<?php

namespace App\Http\Controllers;

use App\Http\Requests\Quiz\QuizRequest;
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

    public function index(): JsonResponse
    {
        $data = [];
        try {
            $data = $this->quizService->index();
            return Response::success($data['data'], $data['message']);
        } catch (Throwable $th) {
            $message = $th->getMessage();
            return Response::error($data, $message);
        }
    }

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

    public function update(QuizRequest $request, $id): JsonResponse
    {
        $data = [];
        try {
            $data = $this->quizService->update($request->validated(), $id);
            return Response::success($data['data'], $data['message']);
        } catch (Throwable $th) {
            $message = $th->getMessage();
            return Response::error($data, $message);
        }
    }

    public function destroy($id): JsonResponse
    {
        $data = [];
        try {
            $data = $this->quizService->destroy($id);
            return Response::success($data['data'], $data['message'], $data['code']);
        } catch (Throwable $th) {
            $message = $th->getMessage();
            return Response::error($data, $message);
        }
    }
}
