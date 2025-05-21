<?php

namespace App\Http\Requests\OTP;

use App\Traits\HandlesFailedValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

class VerifyOTPRequest extends FormRequest
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
            'otp_code' => 'required|numeric|digits:6',
        ];
    }
}
