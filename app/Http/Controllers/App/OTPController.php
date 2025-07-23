<?php

namespace App\Http\Controllers\App;

use App\Http\Requests\OTP\VerifyOTPRequest;
use App\Http\Requests\User\EmailRequest;
use App\Responses\Response;
use App\Services\User\OTPService;
use Illuminate\Http\JsonResponse;
use Throwable;

class OTPController extends Controller
{
    private OTPService $otpService;

    public function __construct(OTPService $otpService)
    {
        $this->otpService = $otpService;
    }

    public function resendOTP(EmailRequest $request): JsonResponse
    {
        $data = [];
        try {
            $data = $this->otpService->resendOTP($request->validated());
            if($data['code'] == 429) {
                return Response::error($data['message'], $data['code']);
            }
            return Response::success($data['user'], $data['message']);
        } catch (Throwable $th) {
            $message = $th->getMessage();
            return Response::error($message);
        }
    }

    public function verifyOTP(VerifyOTPRequest $request): JsonResponse
    {
        $data = [];
        try {
            $data = $this->otpService->verifyOTP($request->validated());
            if($data['code'] == 422 || $data['code'] == 429) {
                return Response::error($data['message'], $data['code']);
            }
            return Response::success($data['token'], $data['message']);
        } catch (Throwable $th) {
            $message = $th->getMessage();
            return Response::error($message);
        }
    }
}
