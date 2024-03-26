<?php

namespace App\Common\Rules;

use Illuminate\Contracts\Validation\Rule;

class PageRule implements Rule
{
    public function passes($attribute, $value): bool
    {
        if (is_string($value) && strlen($value) == 0) {
            return true;
        }
        if (isset($value) && !is_numeric($value)) {
            return false;
        }
        if ((int) $value < 1) {
            return false;
        }

        return true;
    }

    public function message(): string
    {
        return 'The page must be a number greater than 0.';
    }
}