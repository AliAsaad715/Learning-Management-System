<?php

namespace App\Http\Requests\User;

use App\Enums\EducationEnum;
use App\Enums\LevelEnum;
use App\Traits\HandlesFailedValidationTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class ProfileRequest extends FormRequest
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
            'first_name' => 'required|string|max:50|regex:/^[\pL\s]+$/u',
            'last_name' => 'required|string|max:50|regex:/^[\pL\s]+$/u',
            'country_id' =>  'required|exists:countries,id',
            'languages' =>  'array|required',
            'languages.*.language_id' => 'exists:languages,id|distinct',
            'languages.*.level' => Rule::in(LevelEnum::values()),
            'job_title_id' => 'exists:job_titles,id',
            'linked_in_url' => 'url',
            'education' => Rule::in(EducationEnum::values()),
            'university' => 'string|max:50',
            'speciality' => 'string|max:50',
            'work_experience' => 'string|max:1000',
            'skills' => 'array',
            'skills.*.skill_id' => 'exists:skills,id|distinct',
        ];
    }
}
