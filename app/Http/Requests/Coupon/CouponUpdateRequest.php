<?php

namespace App\Http\Requests\Coupon;

use App\Models\Coupon;
use App\Traits\HandlesFailedValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

class CouponUpdateRequest extends FormRequest
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
            'code' => ['required', 'string', 'max:50',
                function ($attribute, $value, $fail) {
                    if (!Coupon::isCodeUnique($value, request()->route('id'))) {
                        $fail('The ' . $attribute . ' has already been taken.');
                    }
                }],
            'discount_type' => 'required|in:fixed,percentage',
            'discount_value' => 'required|numeric|between:0.00,99999999.99',
            'expires_at' => 'nullable|date|after:now',
            'max_uses' => 'nullable|integer|min:1',
        ];
    }

    public function messages(): array
    {
        return [
            'discount_type.in' => 'The discount type must be one of fixed or percentage.',
        ];
    }
}
