<?php
namespace App\Services;
use App\Models\User;

interface GetUserServiceInterface
{
    public function byEmail(string $email): User;
}
