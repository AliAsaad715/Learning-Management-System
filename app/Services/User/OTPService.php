<?php

namespace App\Services\User;

use App\Http\Resources\UserResource;
use App\Mail\SendOTP;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class OTPService
{
    public function sendOTP($user): void
    {
        $user->otp_code = rand(100000, 999999);
        $user->expire_at = now()->addMinutes(10);
        $user->otp_attempts_count = 0;
        $user->otp_locked_until = null;
        $user->save();
        Mail::to($user->email)->send(new SendOTP($user->otp_code));
    }

    public function resendOTP($request): array
    {
        $user = User::query()->where('email', $request['email'])->first();
        if ($user->otp_locked_until && now()->lessThan($user->otp_locked_until)) {
            return ['message' => 'Too many OTP attempts. Please try again after ' . $user->otp_locked_until->diffForHumans() . '.', 'code' => 429];
        }
        $this->sendOTP($user);
        return ['user' => new UserResource($user), 'message' => 'Resend OTP successfully', 'code' => 200];
    }

    public function verifyOTP($request): array
    {
        $user = User::query()->where('email', $request['email'])->first();
        if ($user->otp_locked_until && now()->lessThan($user->otp_locked_until)) {
            return ['message' => 'Too many failed OTP attempts. Please try again after ' . $user->otp_locked_until->diffForHumans() . '.', 'code' => 429];
        } else if (!$user || $user->otp_code !== $request['otp_code'] || now()->greaterThan($user->expire_at)) {
            $user->otp_attempts_count++;
            if ($user->otp_attempts_count >= 5) {
                $user->otp_locked_until = now()->addMinutes(15);
                $user->otp_attempts_count = 0;
                $user->save();
                return ['message' => 'Too many failed OTP attempts. Your account has been locked for 15 minutes.', 'code' => 429];
        }
            $user->save();
            return ['message' => 'Invalid or expired OTP.', 'code' => 422];
        }
        $user->otp_code = null;
        $user->expire_at = null;
        $user->otp_attempts_count = 0;
        $user->otp_locked_until = null;
        $user->markEmailAsVerified();
        $user->save();
        $token['token'] = $user->createToken('Personal Access Token')->accessToken;
        return ['token' => $token, 'message' => 'Email verified successfully', 'code' => 200];
    }
}
