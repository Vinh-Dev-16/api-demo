<?php

namespace App\Services;
use App\Models\User;
use App\Services\GetUserServiceInterface;

class GetUserService implements GetUserServiceInterface
{

    public function byEmail(string $email): User
    {
        return User::where('email', $email)
            ->first() ?? new User();
    }
}
