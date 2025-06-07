<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class QuestionsAreSequential implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        for($i = 0; $i < count($value); $i++) {
            $s = $i + 1;
            if($value[$i]['question_number'] !== $s) {
                $fail("Question numbers must be sequential, starting from 1. Expected {$s} for question at field.No {$s}.");
                return;
            }
        }
    }
}
