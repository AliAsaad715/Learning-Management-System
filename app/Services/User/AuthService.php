<?php

namespace App\Services\User;

use App\Enums\LevelEnum;
use App\Http\Resources\User\UserResource;
use App\Models\Language;
use App\Models\MoreDetail;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    private OTPService $otpService;

    public function __construct(OTPService $otpService)
    {
        $this->otpService = $otpService;
    }
    public function register($request): array
    {
        $user = User::query()->create([
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'role' => 'student'
        ]);
        if(!$user) {
            $message = 'User registration failed!';
            $code = 422;
        } else {
            $this->otpService->sendOTP($user);
            $moreDetail = MoreDetail::query()->create([
                'user_id' => $user->id,
                'country_id' => $request['country_id'],
            ]);
            $moreDetail->languages()->attach(Language::query()->findOrfail($request['language_id']),
                [
                    'language_id' => $request['language_id'],
                    'more_detail_id' => $moreDetail->id,
                    'level' => LevelEnum::MOTHER_TONGUE
                ]);

            $message = "Registration successful! An OTP has been sent to your email. Please check your inbox to verify your account.";
            $code = 202;
        }
        return ['user' => new UserResource($user), 'message' => $message, 'code' => $code];
    }

    public function login($request): array
    {
        $user = User::query()->where('email', $request['email'])->first();
        if(!is_null($user)) {
            if(!Auth::attempt($request->only(['email', 'password']))) {
                $message = 'User email & password does not match our records!';
                $code = 401;
            } else {
                $token = $user->createToken('Personal Access Token')->accessToken;
                $user = (new UserResource($user))->toArray(request());
                $user['token'] = $token;
                $message = 'User logged in successfully';
                $code = 200;
            }
        } else {
            $message = 'User not found!';
            $code = 404;
        }
        return ['user' => $user, 'message' => $message, 'code' => $code];
    }

    public function logout(): array
    {
        $user = auth('api')->user();
        if(!is_null($user)) {
            $user->token()->revoke();
            $message = 'User logged out successfully';
            $code = 200;
        } else {
            $message = 'Invalid user token!';
            $code = 404;
        }
        return ['user' => [], 'message' => $message, 'code' => $code];
    }
}
