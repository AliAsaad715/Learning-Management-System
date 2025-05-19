<?php

namespace App\Http\Requests\Auth;

use App\Traits\HandlesFailedValidationTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
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
            'email' => 'required|email|max:255|unique:users,email',
            'password' => ['required', 'confirmed', Password::min(8)->mixedCase()->numbers()->symbols()],
            'country_id' =>  'required|exists:countries,id',
            'language_id' =>  'required|exists:languages,id',
        ];
    }

}
