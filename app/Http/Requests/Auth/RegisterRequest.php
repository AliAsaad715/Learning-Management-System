<?php

namespace App\Http\Requests\Auth;

use App\Traits\HandlesFailedValidationTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Http;

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
            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email',
//                function ($attribute, $value, $fail) {
//                    $apiKey = env('ZEROBOUNCE_API_KEY');
//                    $response = Http::get('https://api.zerobounce.net/v2/validate', [
//                        'api_key' => $apiKey,
//                        'email' => $value,
//                    ]);
//
//                    $result = $response->json();
//
//                    if (!isset($result['status'])) {
//                        $fail('Email verification service is currently unavailable.');
//                        return;
//                    }
//
//                    if ($result['status'] !== 'valid') {
//                        $fail('The email address is invalid or does not exist.');
//                    }
//                },
            ],
            'password' => ['required', 'confirmed', Password::min(8)
                ->mixedCase()
                ->numbers()
                ->symbols()],
            'country_id' => 'required|exists:countries,id',
            'language_id' => 'required|exists:languages,id',
        ];
    }
}
