<?php

namespace App\Domain\Authentication\Rules;

use Illuminate\Contracts\Validation\Rule;

class CheckIsCorrectPasswordRule implements Rule
{

    public function passes($attribute, $value): bool
    {
        $credentials = request()->only('email', 'password');
        return auth()->attempt($credentials);
    }

    public function message(): string
    {
        return 'The password is incorrect.';
    }
}
