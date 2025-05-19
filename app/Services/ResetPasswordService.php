<?php

namespace App\Services;

use App\Http\Resources\UserResource;
use App\Mail\SendCodeResetPassword;
use App\Models\ResetPassword;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ResetPasswordService
{
    public function forgotPassword($request): array
    {
        ResetPassword::query()->where('email', $request['email'])->delete();
        $request['code'] = mt_rand(100000, 999999);
        $passwordReset = ResetPassword::query()->create($request);
        Mail::to($request['email'])->send(new SendCodeResetPassword($passwordReset['code']));
        return ['data' => $passwordReset, 'message' => 'Successfully sent code to reset password', 'code' => 201];
    }

    public function checkCode($request): array
    {
        $passwordReset = ResetPassword::query()->firstWhere('code', $request['code']);
        if($passwordReset['created_at']->addHour() < now()) {
            $passwordReset->delete();
            $message = 'The code is expired!';
            $code = 422;
        } else {
            $message = 'The code is valid';
            $code = 200;
        }
        return ['data' => $passwordReset, 'message' => $message, 'code' => $code];
    }

    public function resetPassword($request): array
    {
        $passwordReset = ResetPassword::query()->firstWhere('code', $request['code']);
        if($passwordReset['created_at'] > now()->addHour()) {
            $passwordReset->delete();
            $message = 'The code is expired!';
            $code = 422;
        } else {
            $user = User::query()->firstWhere('email', $passwordReset['email']);
            $user->update([
                'password' => Hash::make($request['password'])
            ]);
            $passwordReset->delete();
            $message = 'Password reset successfully';
            $code = 200;
        }
        return ['data' => new UserResource($user), 'message' => $message, 'code' => $code];
    }
}
