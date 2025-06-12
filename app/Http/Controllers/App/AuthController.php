<?php

namespace App\Http\Controllers\App;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Responses\Response;
use App\Services\User\AuthService;
use Illuminate\Http\JsonResponse;
use Throwable;

class AuthController extends Controller
{
    private AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

     public function register(RegisterRequest $request): JsonResponse
     {
         $data = [];
         try {
             $data = $this->authService->register($request->validated());
             if($data['code'] == 422) {
                 return Response::error([], $data['message'], $data['code']);
             }
             return Response::success($data['user'], $data['message'], $data['code']);
         } catch (Throwable $th) {
             $message  = $th->getMessage();
             return Response::error($data, $message);
         }
     }

     public function login(LoginRequest $request): JsonResponse
     {
         $data = [];
         try {
             $data = $this->authService->login($request);
             if($data['code'] == 401 || $data['code'] == 404) {
                 return Response::error([], $data['message'], $data['code']);
             }
             return Response::success($data['user'], $data['message'], $data['code']);
         } catch (Throwable $th) {
             $message  = $th->getMessage();
             return Response::error($data, $message);
         }
     }

     public function logout(): JsonResponse
     {
         $data = [];
         try {
             $data = $this->authService->logout();
             if($data['code'] == 404) {
                 return Response::error([], $data['message'], $data['code']);
             }
             return Response::success($data['user'], $data['message'], $data['code']);
         } catch (Throwable $th) {
             $message  = $th->getMessage();
             return Response::error($data, $message);
         }
     }
}
