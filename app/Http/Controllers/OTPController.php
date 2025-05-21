<?php

namespace App\Http\Controllers;

use App\Http\Requests\OTP\VerifyOTPRequest;
use App\Responses\Response;
use App\Services\OTPService;
use Illuminate\Http\JsonResponse;
use Throwable;

class OTPController extends Controller
{
    private OTPService $otpService;

    public function __construct(OTPService $otpService)
    {
        $this->otpService = $otpService;
    }

    public function resendOTP(): JsonResponse
    {
        $data = [];
        try {
            $data = $this->otpService->resendOTP();
            if($data['code'] == 404) {
                return Response::error([], $data['message'], $data['code']);
            }
            return Response::success($data['user'], $data['message']);
        } catch (Throwable $th) {
            $message = $th->getMessage();
            return Response::error($data, $message);
        }
    }

    public function verifyOTP(VerifyOTPRequest $request): JsonResponse
    {
        $data = [];
        try {
            $data = $this->otpService->verifyOTP($request->validated());
            if($data['code'] == 422 || $data['code'] == 404) {
                return Response::error([], $data['message'], $data['code']);
            }
            return Response::success($data['user'], $data['message']);
        } catch (Throwable $th) {
            $message = $th->getMessage();
            return Response::error($data, $message);
        }
    }
}
