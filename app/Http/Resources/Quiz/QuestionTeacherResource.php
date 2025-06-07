<?php

namespace App\Http\Resources\Quiz;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuestionTeacherResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'question_id' => $this->id,
            'question_number' => $this->question_number,
            'content' => $this->content,
            'answer_a' => $this->answer_a,
            'answer_b' => $this->answer_b,
            'answer_c' => $this->answer_c,
            'answer_d' => $this->answer_d,
            'right_answer' => $this->right_answer
        ];
    }
}
