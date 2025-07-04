<?php

namespace App\Http\Resources\Course\Student;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class CourseForStudentResource extends JsonResource
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
            'image_url' =>  asset(Storage::url("img/courses/{$this->image_url}")),
            'title' => $this->title,
            'teacher' => $this->teacher->first_name . ' ' . $this->teacher->last_name,
            'price' => $this->price . '$',
            'rate' => $this->rate,
            'language' => $this->language->name,
            'num_of_students_enrolled' => $this->num_of_students_enrolled
        ];
    }
}
