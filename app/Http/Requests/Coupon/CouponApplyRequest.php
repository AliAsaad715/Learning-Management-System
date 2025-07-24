<?php

namespace App\Http\Requests\Coupon;

use App\Models\Coupon;
use App\Traits\HandlesFailedValidationTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CouponApplyRequest extends FormRequest
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
            'code' =>
                [
                    'required',
                    'string',
                    'exists:coupons,code',
                    function ($attribute, $value, $fail) {
                        if (Coupon::query()->where('code', $value)->first()->students()->where('student_id', $this->user()->id)->exists()) {
                            $fail('You already applied for this coupon!');
                        }
                    }
                ]
        ];
    }
}
