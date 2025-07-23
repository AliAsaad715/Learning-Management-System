<?php

namespace App\Http\Resources\Course\Teacher;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class CourseForTeacherResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'image_url' =>  asset(Storage::url($this->image_url)),
            'title' => $this->title,
            'teacher' => $this->teacher->first_name . ' ' . $this->teacher->last_name,
            'price' => $this->price . '$',
            'rate' => $this->rate,
            'language' => $this->language->name,
            'num_of_students_enrolled' => $this->num_of_students_enrolled,
            'publishing_date' => $this->publishing_date,
            'publishing_request_date' => $this->publishing_request_date,
            'created_at' => $this->created_at
        ];
    }
}
