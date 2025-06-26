<?php

namespace App\Http\Resources\Course;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class CourseWithDetailsResource extends JsonResource
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
            'image_url' =>  asset("build/assets/img/courses/{$this->image_url}"),
            'title' => $this->title,
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
            'num_of_hours' => $this->num_of_hours,
            'price' => $this->price . '$',
            'rate' => [
                'course_rating' => $this->rate,
                '5' => $this->calculatePercentageForValueRate(5),
                '4' => $this->calculatePercentageForValueRate(4),
                '3' => $this->calculatePercentageForValueRate(3),
                '2' => $this->calculatePercentageForValueRate(2),
                '1' => $this->calculatePercentageForValueRate(1),
            ],
            'numb_of_episodes' => $this->num_of_episodes,
            'publishing_date' => $this->publishing_date,
            'has_certificate' =>  $this->has_certificate,
            'total_quizzes' =>  $this->total_quizzes,
            'num_of_students_enrolled' => $this->num_of_students_enrolled,
        ];
    }
}
