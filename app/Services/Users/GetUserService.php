<?php

namespace App\Services\Users;
use App\Models\User;
use App\Services\Users\GetUserServiceInterface;

class GetUserService implements GetUserServiceInterface
{

    public function byEmail(string $email): User
    {
        return User::where('email', $email)
            ->first() ?? new User();
    }
}
