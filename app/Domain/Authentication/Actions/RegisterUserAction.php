<?php

namespace App\Domain\Authentication\Actions;
use App\Domain\Authentication\Setups\RegisterUserSetup;
use App\Models\User;

class RegisterUserAction
{
    public function handle(RegisterUserSetup $registerUserSetup): User{
        return User::create($registerUserSetup->getDataCreate());
    }

}
