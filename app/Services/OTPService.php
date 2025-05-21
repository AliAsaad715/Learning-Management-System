<?php

namespace App\Services;

use App\Http\Resources\UserResource;
use App\Mail\SendOTP;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class OTPService
{
    public function sendOTP($user): void
    {
        $user->otp_code = rand(100000, 999999);
        $user->expire_at = now()->addMinutes(1);
        $user->save();
        Mail::to($user->email)->send(new SendOTP($user->otp_code));
    }

    public function resendOTP(): array
    {
        $user = Auth::user();
        if(!$user) {
            $message = 'Invalid user token!';
            $code = 404;
        } else {
            $this->sendOTP($user);
            $message = 'Resend OTP successfully';
            $code = 200;
        }
        return ['user' => new UserResource($user), 'message' => $message, 'code' => $code];
    }

    public function verifyOTP($request): array
    {
        $user = User::query()->find(Auth::id());
        if(!$user) {
            $message = 'Invalid user token!';
            $code = 404;
        } else if($request['otp_code'] != $user->otp_code) {
            $message = 'Invalid OTP';
            $code = 422;
        } else if(now()->greaterThan($user->expire_at)) {
            $message = 'Expired OTP';
            $code = 422;
        } else {
            $user->otp_code = null;
            $user->expire_at = null;
            $user->save();
            $message = 'OTP verified successfully';
            $code = 200;
        }
        return ['user' => new UserResource($user), 'message' => $message, 'code' => $code];
    }

}
