<?php

namespace App\Http\Resources\Course\Teacher;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class CourseWithDetailsForTeacherResource extends JsonResource
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
            'image_url' => asset(Storage::url("img/courses/{$this->image_url}")),
            'title' => $this->title,
            'category' => $this->topic->category->title,
            'topic' => $this->topic->title,
            'description' => $this->description,
            'language' => $this->language->name,
            'what_will_you_learn' => $this->episodes->pluck('title'),
            'teacher' => [
                'id' => $this->teacher->id,
                'full_name' => $this->teacher->first_name . ' ' . $this->teacher->last_name,
                'profile_image_url' => $this->teacher->profile_image_url ? asset(Storage::url("img/users/{$this->teacher->profile_image_url}")) : null
            ],
            'difficulty_level' => $this->difficulty_level,
            'num_of_hours' => $this->total_of_time ? floor($this->total_of_time / 3600) : 0,
            'price' => $this->price . '$',
            'rate' => [
                'course_rating' => $this->rate ? $this->rate : 0,
                '5' => $this->calculatePercentageForValueRate(5),
                '4' => $this->calculatePercentageForValueRate(4),
                '3' => $this->calculatePercentageForValueRate(3),
                '2' => $this->calculatePercentageForValueRate(2),
                '1' => $this->calculatePercentageForValueRate(1),
            ],
            'num_of_episodes' => $this->num_of_episodes ? $this->num_of_episodes  : 0,
            'status' => $this->status,
            'publishing_date' => $this->publishing_date,
            'publishing_request_date' => $this->publishing_request_date,
            'has_certificate' =>  $this->has_certificate,
            'total_quizzes' =>  $this->total_quizzes ? $this->total_quizzes : 0,
            'num_of_students_enrolled' => $this->num_of_students_enrolled ? $this->num_of_students_enrolled : 0,
            'created_at' => $this->created_at,
        ];
    }
}
