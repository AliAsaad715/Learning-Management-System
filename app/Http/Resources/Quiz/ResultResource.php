<?php

namespace App\Http\Resources\Quiz;

use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ResultResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'mark' => $this->mark . '/' . Quiz::query()->find($this->quiz_id)->num_of_questions,
            'percentage_mark' => $this->percentage_mark . '%',
            'success' => $this->success
        ];
    }
}
