<?php

namespace App\Http\Resources;

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
        return [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'profile_image_url' => $this->profile_image_url,
            'email' => $this->email,
            'otp_code' => $this->otp_code,
            'role' => $this->role,
            'country' => $this->moreDetail ? $this->moreDetail->country['name'] : null,
            'languages' => $this->moreDetail ?  $this->moreDetail->languages->pluck('name') : [],
            'job_title' => $this->moreDetail ? ($this->moreDetail->jobTitle['title'] ?? null) : null,
            'linked_in_url' => $this->moreDetail ? $this->moreDetail->linked_in_url : null,
            'education' =>  $this->moreDetail ? $this->moreDetail->education : null,
            'university' =>  $this->moreDetail ? $this->moreDetail->university: null,
            'speciality' =>  $this->moreDetail ? $this->moreDetail->speciality: null,
            'work_experience' =>  $this->moreDetail ? $this->moreDetail->work_experience : null,
            'skills' =>  $this->moreDetail ? $this->moreDetail->skills->pluck('title') : []
        ];
    }
}
