<?php

namespace App\Domain\Authentication\Actions;

use App\Domain\Authentication\Setups\UpdateTimeVerifyEmailSetup;
use App\Models\User;

class UpdateUserTimeVerifyEmailAction
{

    public function handle(
        User $user,
        UpdateTimeVerifyEmailSetup $updateTimeVerifyEmailSetup,
    ): void {
        $user->update($updateTimeVerifyEmailSetup->getDataUpdate());
    }
}