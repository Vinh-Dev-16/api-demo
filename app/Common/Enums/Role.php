<?php

namespace App\Common\Enums;

use App\Common\Enums\Interface\GetValuesInterface;
use App\Common\Enums\Traits\GetValuesTrait;

enum Role: string implements GetValuesInterface
{
    use GetValuesTrait;

    case SUPER_ADMIN = 'super-admin';
    case ADMIN = 'admin';
    case USER = 'user';
}
