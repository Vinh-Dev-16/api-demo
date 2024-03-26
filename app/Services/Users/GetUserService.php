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

    public function byIdNotVerify(int $id): User
    {
        return User::where('id', $id)
            ->where('email_verified_at', null)
            ->first() ?? new User();
    }
}
