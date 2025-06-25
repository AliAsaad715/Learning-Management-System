<?php

namespace App\Services\User;

use App\Enums\RoleEnum;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserService
{
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
        $user = User::query()->find(auth('api')->id());
        Storage::disk('public')->delete("img/users/{$user->profile_image_url}");
        if (!empty($request['profile_image_url'])) {
            $path = $request['profile_image_url']->store('img/users', 'public');
            $user->update([
                'profile_image_url' => basename($path),
            ]);
        } else {
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

    public function promoteStudentToTeacher(): array
    {
        $user = auth('api')->user();
        if($user['role'] === RoleEnum::TEACHER) {
            return ['message' => 'You are already a Teacher!', 'code' => 409];
        }
        $user->update([
            'role' => 'teacher'
        ]);
        return ['message' => 'Successfully promoted to Teacher. You can now access all teacher features.', 'code' => 200];
    }

    public function delete(): array
    {
        $user = User::query()->find(Auth::id());
        $user->delete();
        return ['user' => $user, 'message' => 'User deleted successfully'];
    }


}
