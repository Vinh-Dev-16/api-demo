<?php

namespace App\Domain\Authentication\Actions;

use App\Domain\Authentication\Setups\VerifyEmailSetup;
use App\Models\VerifyEmail;

class UpsertVerifyEmailAction
{
    public function handle(
        VerifyEmailSetup $verifyEmailSetup,
        ?VerifyEmail     $verifyEmail
    ) {
        if ($verifyEmail) {
            $verifyEmail->update($verifyEmailSetup->getDataUpdate());
        } else {
            VerifyEmail::create($verifyEmailSetup->getDataCreate());
        }
    }
}
