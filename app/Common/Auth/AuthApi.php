<?php

namespace App\Common\Auth;

use App\Common\Enums\SoftDelete;
use App\Models\User;

class AuthApi
{
    public static function checkAuth(
        array $roles
    ): bool {
        $user = self::getUserById();
        return $user->hasAnyRole($roles);
    }

    private static function getUserById()
    {
        return User::query()
            ->where('id', auth()->id())
            ->whereNotNull('email_verified_at')
            ->first() ?? abort(401, 'Unauthorized');
    }

}