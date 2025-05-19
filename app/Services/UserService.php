<?php

namespace App\Services;

use App\Enums\LevelEnum;
use App\Http\Resources\UserResource;
use App\Models\Language;
use App\Models\LanguageUser;
use App\Models\User;
use App\Traits\manipulateImagesTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserService
{
    use manipulateImagesTrait;
    public function updateProfile($request): array
    {
        $user = Auth::user();
        $moreDetail = $user->moreDetail;
        $user->update([
            'first_name' => $request['first_name'] ?? $user['first_name'],
            'last_name' => $request['last_name'] ?? $user['last_name'],
            'profile_image_url' => $this->update_image($request['profile_image_url'], 'users', $user['profile_image_url']),
        ]);
        $moreDetail->update([
            'country_id' => $request['country_id'] ?? $moreDetail['country_id'],
            'job_title_id' => $request['job_title_id'] ?? $moreDetail['job_title_id'],
            'linked_in_url' => $request['linked_in_url'] ?? $moreDetail['linked_in_url'],
            'education' => $request['education'] ?? $moreDetail['education'],
            'university' => $request['university'] ?? $moreDetail['university'],
            'speciality' => $request['speciality'] ?? $moreDetail['speciality'],
            'work_experience' => $request['work_experience'] ?? $moreDetail['work_experience'],
        ]);
        $syncData = [];
        foreach ($request['languages'] as $languageInfo) {
            $languageId = $languageInfo['language_id'] ?? null;
            $level = $languageInfo['level'] ?? null;
            if ($languageId !== null && $level !== null) {
                $syncData[$languageId] = ['level' => $level];
            }
        }
        $moreDetail->languages()->sync($syncData);
        return ['user' => new UserResource($user), 'message' => 'Profile updated successfully'];
    }

    public function changePassword($request): array
    {
        $user = Auth::user();
        if(!Hash::check($request['old_password'], $user['password'])) {
            $message = 'Your old password is incorrect, please try again!';
            $code = 401;
        } else {
            $user->update([
                'password' => Hash::make($request['new_password']),
            ]);
            $message = 'You have successfully changed your password';
            $code = 200;
        }
        return ['user' => new UserResource($user), 'message' => $message, 'code' => $code];
    }

    public function showProfile($id): array
    {
        $user = User::query()->find($id);
        if(!$user) {
            $message = 'User not found!';
            $code = 404;
        } else {
            $message = 'User retrieved successfully';
            $code = 200;
        }
        return ['user' => new UserResource($user), 'message' => $message, 'code' => $code];
    }

    public function delete(): array
    {
        $user = Auth::user();
        $user->delete();
        return ['user' => $user, 'message' => 'User deleted successfully'];
    }


}
