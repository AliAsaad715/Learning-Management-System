<?php

namespace App\Http\Controllers\App;

use App\Http\Requests\User\ChangePasswordRequest;
use App\Http\Requests\User\ProfileImageRequest;
use App\Http\Requests\User\ProfileRequest;
use App\Models\User;
use App\Responses\Response;
use App\Services\User\UserService;
use Illuminate\Http\JsonResponse;
use Kreait\Firebase\Request;
use Throwable;

class UserController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function updateProfile(ProfileRequest $request): JsonResponse
    {
        $data = [];
        try {
            $data = $this->userService->updateProfile($request->validated());
            return Response::success($data['user'], $data['message']);
        } catch (Throwable $th) {
            $message = $th->getMessage();
            return Response::error($message);
        }
    }
    public function updateProfileImage(ProfileImageRequest $request): JsonResponse
    {
        $data = [];
        try {
            $data = $this->userService->updateProfileImage($request->validated());
            return Response::success($data['user'], $data['message']);
        } catch (Throwable $th) {
            $message = $th->getMessage();
            return Response::error($message);
        }
    }
    public function changePassword(ChangePasswordRequest $request): JsonResponse
    {
        $data = [];
        try {
            $data = $this->userService->changePassword($request->validated());
            if($data['code'] == 401) {
                return Response::error($data['message'], $data['code']);
            }
            return Response::success($data['user'], $data['message']);
        } catch (Throwable $th) {
            $message = $th->getMessage();
            return Response::error($message);
        }
    }

    public function showProfile($id): JsonResponse
    {
        $data = [];
        try {
            $data = $this->userService->showProfile($id);
            if($data['code'] == 404) {
                return Response::error($data['message'], $data['code']);
            }
            return Response::success($data['user'], $data['message']);
        } catch (Throwable $th) {
            $message = $th->getMessage();
            return Response::error( $message);
        }
    }

    public function promoteStudentToTeacher(): JsonResponse
    {
        $data = [];
        try {
            $data = $this->userService->promoteStudentToTeacher();
            if($data['code'] == 409)
                return Response::error($data['message'], $data['code']);
            return Response::success([], $data['message']);
        } catch (Throwable $th) {
            $message = $th->getMessage();
            return Response::error($message);
        }
    }

    public function destroy(): JsonResponse
    {
        $data = [];
        try {
            $data = $this->userService->delete();
            return Response::success($data['user'], $data['message']);
        } catch (Throwable $th) {
            $message = $th->getMessage();
            return Response::error($message);
        }
    }

    public function storeFCMToken(Request $request)
    {
        $user = User::find($request->user_id);
        $user->update(['fcm_token' => $request->device_token]);
        return response()->json(['success' => true]);
    }

}
