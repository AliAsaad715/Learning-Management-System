<?php

namespace App\Services;

use App\Enums\LevelEnum;
use App\Http\Resources\UserResource;
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
            $token = $user->createToken('Personal Access Token')->accessToken;
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
            $user = (new UserResource($user))->toArray(request());
            $user['token'] = $token;
            $message = 'User registered successfully';
            $code = 201;
        }
        return ['user' => $user, 'message' => $message, 'code' => $code];
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
        $user = User::query()->find(Auth::id());
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
