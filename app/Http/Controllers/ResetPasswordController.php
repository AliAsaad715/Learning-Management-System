<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResetPassword\CheckCodeRequest;
use App\Http\Requests\ResetPassword\ResetPasswordRequest;
use App\Http\Requests\User\EmailRequest;
use App\Responses\Response;
use App\Services\User\ResetPasswordService;
use Illuminate\Http\JsonResponse;
use Throwable;

class ResetPasswordController extends Controller
{
    private ResetPasswordService $resetPasswordService;

    public function __construct(ResetPasswordService $userService)
    {
        $this->resetPasswordService = $userService;
    }

    public function forgotPassword(EmailRequest $request): JsonResponse
    {
        $data = [];
        try {
            $data = $this->resetPasswordService->forgotPassword($request->validated());
            return Response::success($data['data'], $data['message'], $data['code']);
        } catch (Throwable $th) {
            $message = $th->getMessage();
            return Response::error($data, $message);
        }
    }

    public function checkCode(CheckCodeRequest $request): JsonResponse
    {
        $data = [];
        try {
            $data = $this->resetPasswordService->checkCode($request->validated());
            if($data['code'] == 422) {
                return Response::error([], $data['message'], $data['code']);
            }
            return Response::success($data['data'], $data['message'], $data['code']);
        } catch (Throwable $th) {
            $message = $th->getMessage();
            return Response::error($data, $message);
        }
    }

    public function resetPassword(ResetPasswordRequest $request): JsonResponse
    {
        $data = [];
        try {
            $data = $this->resetPasswordService->resetPassword($request->validated());
            return Response::success($data['data'], $data['message'], $data['code']);
        } catch (Throwable $th) {
            $message = $th->getMessage();
            return Response::error($data, $message);
        }

    }
}
