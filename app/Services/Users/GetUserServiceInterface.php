<?php

namespace App\Services\Users;

use App\Models\User;

interface GetUserServiceInterface
{
    public function byEmail(string $email): User;
}
