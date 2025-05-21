<?php

namespace App\Services;

use App\Http\Resources\UserResource;
use App\Models\User;
use App\Traits\manipulateImagesTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserService
{
    use manipulateImagesTrait;
    public function updateProfile($request): array
    {
        $user = User::query()->find(Auth::id());
        $moreDetail = $user->moreDetail;
        $user->update([
            'first_name' => $request['first_name'] ?? null,
            'last_name' => $request['last_name'] ?? null,
        ]);
        $moreDetail->update([
            'country_id' => $request['country_id'] ?? null,
            'job_title_id' => $request['job_title_id'] ?? null,
            'linked_in_url' => $request['linked_in_url'] ?? null,
            'education' => $request['education'] ?? null,
            'university' => $request['university'] ?? null,
            'speciality' => $request['speciality'] ?? null,
            'work_experience' => $request['work_experience'] ?? null,
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

        $syncSkillData = [];
        if (isset($request['skills']) && is_array($request['skills'])) {
            foreach ($request['skills'] as $skillInfo) {
                $skillId = $skillInfo['skill_id'] ?? null;
                if ($skillId !== null) {
                    $syncSkillData[$skillId] = [];
                }
            }
        }
        $moreDetail->skills()->sync($syncSkillData);
        return ['user' => new UserResource($user), 'message' => 'Profile updated successfully'];
    }

    public function updateProfileImage($request): array
    {
        $user = User::query()->find(Auth::id());
        if(!empty($request['profile_image_url'])) {
            $user->update([
                'profile_image_url' => $this->update_image($request['profile_image_url'], 'users', $user['profile_image_url']),
            ]);
        } else {
            $this->delete_image($user['profile_image_url'], 'users');
            $user->update([
                'profile_image_url' => null,
            ]);
        }
        return ['user' => new UserResource($user), 'message' => 'Profile image updated successfully'];
    }
    public function changePassword($request): array
    {
        $user = User::query()->find(Auth::id());
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
        $user = User::query()->find(Auth::id());
        $user->delete();
        return ['user' => $user, 'message' => 'User deleted successfully'];
    }


}
