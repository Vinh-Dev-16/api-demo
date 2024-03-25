<?php

namespace App\Domain\Authentication\Rules;

use App\Models\VerifyEmail;
use Illuminate\Contracts\Validation\Rule;

class CheckOTPIsCorrectRule implements Rule
{
    public function __construct(
        private readonly string $email
    )
    {
        //
    }

    public function passes($attribute, $value): bool
    {
        return VerifyEmail::query()
            ->where('email', $this->email)
            ->where('otp', $value)
            ->exists();
    }

    public function message(): string
    {
        return 'OTP is incorrect';
    }
}