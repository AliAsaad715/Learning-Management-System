<?php

namespace App\Http\Requests\Quiz;

use App\Traits\HandlesFailedValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

class AnswerRequest extends FormRequest
{
    use HandlesFailedValidationTrait;
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'quiz_id' => 'required|exists:quizzes,id',
            'question_number' => 'required|integer',
            'answer' => 'required|in:a,b,c,d'
        ];
    }
}
