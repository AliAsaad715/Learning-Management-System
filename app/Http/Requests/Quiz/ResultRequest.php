<?php

namespace App\Http\Requests\Quiz;

use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ResultRequest extends FormRequest
{
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
            '*' => 'required|array',
            '*.question_id' => ['required', 'integer',
                                Rule::exists('questions', 'id')->where(function ($query) {
                                $query->where('quiz_id', $this->route('quiz_id'));})
                                ],
            '*.answer' => 'required|in:a,b,c,d',
        ];
    }

    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            $questions = collect($this->input());
            $duplicates = $questions->duplicates('question_id');
            if ($duplicates->isNotEmpty()) {
                $validator->errors()->add(
                    'questions',
                    'Duplicate questions found: ' . $duplicates->implode(', ')
                );
            }
        });
    }

    public function messages(): array
    {
        return [
            '*.question_id.*' => 'The selected question does not exist in this quiz.',
        ];
    }
}
