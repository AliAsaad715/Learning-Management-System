<?php

namespace App\Http\Requests\Quiz;

use App\Rules\QuestionsAreSequential;
use App\Traits\HandlesFailedValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

class QuizRequest extends FormRequest
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
            'episode_id' => 'required|integer|exists:episodes,id|unique:quizzes,episode_id',
            'num_of_questions' => 'required|integer',
            'questions' => ['required', 'array', 'size:' . $this->num_of_questions, new QuestionsAreSequential()],
            'questions.*.question_number' => 'required|integer|min:1',
            'questions.*.content' => 'required|string',
            'questions.*.answer_a' => 'required|string',
            'questions.*.answer_b' => 'required|string',
            'questions.*.answer_c' => 'required|string',
            'questions.*.answer_d' => 'required|string',
            'questions.*.explanation' => 'nullable|string',
            'questions.*.right_answer' => 'required|in:a,b,c,d',
        ];
    }
}
