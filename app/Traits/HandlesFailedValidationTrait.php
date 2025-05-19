<?php

namespace App\Traits;

use App\Responses\Response;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

trait HandlesFailedValidationTrait
{
    /**
     * @throws ValidationException
     */
    public function failedValidation(Validator $validator)
    {
        throw new ValidationException($validator, Response::validation([], $validator->errors()));
    }
}
