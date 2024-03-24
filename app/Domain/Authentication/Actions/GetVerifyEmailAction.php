<?php

namespace App\Domain\Authentication\Actions;

use App\Models\VerifyEmail;
use Illuminate\Foundation\Events\Dispatchable;

class GetVerifyEmailAction
{

    public function handle(
        string $email
    ): ?VerifyEmail {
        return VerifyEmail::where('email', $email)
            ->first();
    }
}
