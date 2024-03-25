<?php

namespace App\Domain\Authentication\Rules;

use App\Models\VerifyEmail;
use Illuminate\Contracts\Validation\Rule;

class CheckOTPIsExpiredRule implements Rule
{

    public function __construct(
        private readonly string $email
    )
    {
        //
    }
    public function passes($attribute, $value): bool
    {
        $now = now()->timestamp;
        $expiredTime = VerifyEmail::query()
            ->where('email', $this->email)
            ->where('otp', $value)
            ->first();
        return $now < $expiredTime->set_up_time;
    }

    public function message(): string
    {
        return 'OTP is expired';
    }
}