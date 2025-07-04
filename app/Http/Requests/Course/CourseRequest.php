<?php

namespace App\Http\Requests\Course;

use App\Enums\LevelEnum;
use App\Traits\HandlesFailedValidationTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CourseRequest extends FormRequest
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
            'topic_id' => 'required|exists:topics,id',
            'language_id' => 'required|exists:languages,id',
            'title' => 'required|string|max:100',
            'description' => 'required|string',
            'image_url' => 'required|image|mimes:jpeg,png,bmp,jpg,gif,svg|max:2048',
            'difficulty_level' => ['required', Rule::in(LevelEnum::values())],
            'price' => 'required|numeric|min:0',
            'has_certificate' => ['nullable', 'string', 'in:true,false'],
        ];
    }
}
