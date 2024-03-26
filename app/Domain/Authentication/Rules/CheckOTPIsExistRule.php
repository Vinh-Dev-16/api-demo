<?php

namespace App\Domain\Authentication\Rules;

use App\Models\VerifyEmail;
use Illuminate\Contracts\Validation\Rule;

class CheckOTPIsExistRule implements Rule
{
    public function passes($attribute, $value): bool
    {
        $verifyEmail = VerifyEmail::query()
            ->where('email', $value)
            ->first();
        if ($verifyEmail) {
            $now = now()->timestamp;
            $expired = $verifyEmail->set_up_time;
            return $now > $expired;
        }

        return true;
    }

    public function message(): string
    {
       return 'OTP is still valid';
    }


}

