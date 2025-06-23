<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $languages = [];
        if($this->moreDetail) {
            foreach ($this->moreDetail->languages as $language) {
                $languages[] = [
                    'id' => $language->id,
                    'name' => $language->name,
                    'level' => $language->pivot->level,
                ];
            }
        }

        $skills = [];
        if($this->moreDetail) {
            foreach ($this->moreDetail->skills as $skill) {
                $skills[] = [
                    'id' => $skill->id,
                    'title' => $skill->title,
                ];
            }
        }

        return [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'profile_image_url' => $this->profile_image_url ? $this->get_image($this->profile_image_url, 'users') : null,
            'email' => $this->email,
            'otp_code' => $this->otp_code,
            'role' => $this->role,
            'country' => $this->moreDetail ? $this->moreDetail->country['name'] : null,
            'languages' => $languages,
            'job_title' => $this->moreDetail ? ($this->moreDetail->jobTitle['title'] ?? null) : null,
            'linked_in_url' => $this->moreDetail ? $this->moreDetail->linked_in_url : null,
            'education' =>  $this->moreDetail ? $this->moreDetail->education : null,
            'university' =>  $this->moreDetail ? $this->moreDetail->university: null,
            'speciality' =>  $this->moreDetail ? $this->moreDetail->speciality: null,
            'work_experience' =>  $this->moreDetail ? $this->moreDetail->work_experience : null,
            'skills' =>  $skills,
        ];
    }
}
