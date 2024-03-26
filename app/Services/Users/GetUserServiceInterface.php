<?php

namespace App\Services\Users;

use App\Models\User;

interface GetUserServiceInterface
{

    public function byIdNotVerify(int $id): User;
    public function byEmail(string $email): User;
}
