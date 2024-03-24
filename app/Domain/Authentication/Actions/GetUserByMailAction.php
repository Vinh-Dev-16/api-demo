<?php

namespace App\Domain\Authentication\Actions;

use App\Models\User;

class GetUserByMailAction
{
    public function handle(string $email): User
    {
        return User::where('email', $email)
            ->first() ?? new User();
    }
}
