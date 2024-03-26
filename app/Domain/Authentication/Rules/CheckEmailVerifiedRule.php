<?php

namespace App\Domain\Authentication\Rules;

use App\Models\User;
use Illuminate\Contracts\Validation\Rule;

class CheckEmailVerifiedRule implements Rule
{

    public function passes($attribute, $value): bool
    {
        return User::query()
            ->where('email', $value)
            ->whereNotNull('email_verified_at')
            ->exists();
    }

    public function message(): string
    {
        return 'Email is not verified';
    }
}
