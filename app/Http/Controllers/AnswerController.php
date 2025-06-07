<?php

namespace App\Http\Controllers;

use App\Http\Requests\Answer\AnswerRequest;
use App\Responses\Response;
use App\Services\Answer\AnswerService;
use Illuminate\Http\JsonResponse;
use Throwable;

class AnswerController extends Controller
{
    private AnswerService $answerService;

    public function __construct(AnswerService $answerService)
    {
        $this->answerService = $answerService;
    }

    public function store(AnswerRequest $request): JsonResponse
    {
        $data = [];
        try {
            $data = $this->answerService->store($request->validated());
            if($data['code'] == 404 || $data['code'] == 409) {
                return Response::error([], $data['message'], $data['code']);
            }
            return Response::success($data['data'], $data['message'], $data['code']);
        } catch (Throwable $th) {
            $message = $th->getMessage();
            return Response::error($data, $message);
        }
    }
}
