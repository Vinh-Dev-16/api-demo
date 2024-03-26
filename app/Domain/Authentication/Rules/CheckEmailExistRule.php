<?php

namespace App\Domain\Authentication\Rules;

use App\Models\User;
use Illuminate\Contracts\Validation\Rule;

class CheckEmailExistRule implements Rule
{
    public function passes($attribute, $value): bool
    {
        return User::query()
            ->where('email', $value)
            ->exists();
    }

    public function message(): string
    {
        return 'Email does not exist';
    }
}

{

}
