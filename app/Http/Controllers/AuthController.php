<?php

namespace App\Http\Controllers;

use App\Events\WelcomeUser;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\CountryResource;
use App\Models\Country;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    // public function register(RegisterRequest $request): \Illuminate\Http\JsonResponse
    // {
    //     $user = [];
    //     try {
    //         $validatedData = $request->validated();
    //         $user = Person::query()->create([
    //             'first_name' => $validatedData['first_name'],
    //             'last_name' => $validatedData['last_name'],
    //             'email' => $validatedData['email'],
    //             'password' => bcrypt($validatedData['password']),
    //             'role' => 'student'
    //         ]);
    //         if(!$user)
    //         {
    //             return response()->json(['success' => false, 'message' => 'Registration failed'], 422);
    //         }
    //         User::query()->create([
    //             'person_id' => $user->id,
    //             'country_id' => $validatedData['country_id'],
    //         ]);
    //         $user['country'] = Country::query()->where('id', $validatedData['country_id'])->value('name');
    //         event(new Registered($user));
    //         $accessToken = $user->createToken('Personal Access Token')->accessToken;
    //         return response()->json(['success' => true, 'message' => 'Registration successful', 'user' => $user, 'access_token' => $accessToken], 201);

    //     }
    //     catch (\Throwable $th) {
    //         Log::error($th->getMessage());
    //         return response()->json(['message' => ['file' => $th->getFile(), 'line' => $th->getLine(), 'error' => $th->getMessage()]], 500);
    //     }
    // }

    // public function login(LoginRequest $request): \Illuminate\Http\JsonResponse
    // {
    //     try {
    //         if (!auth()->attempt($request->validated())) {
    //             return response()->json(['success' => false, 'message' => 'These credentials do not match our records.'], 422);
    //         }

    //         $user = auth()->user();
    //         $accessToken = $user->createToken('Personal Access Token')->accessToken;
    //         return response()->json(['success' => true, 'message' => 'Login successful', 'user' => $user, 'access_token' => $accessToken], 200);
    //     }
    //     catch (\Throwable $th) {
    //         Log::error($th->getMessage());
    //         return response()->json(['message' => ['file' => $th->getFile(), 'line' => $th->getLine(), 'error' => $th->getMessage()]], 500);
    //     }
    // }

    // public function logout(): \Illuminate\Http\JsonResponse
    // {
    //     try {
    //         Auth::user()->token()->revoke();
    //         return response()->json(['success' => true, 'message' => 'Logged out successfully.'], 200);
    //     }
    //     catch (\Throwable $th) {
    //         Log::error($th->getMessage());
    //         return response()->json(['message' => ['file' => $th->getFile(), 'line' => $th->getLine(), 'error' => $th->getMessage()]], 500);
    //     }
    // }
}
