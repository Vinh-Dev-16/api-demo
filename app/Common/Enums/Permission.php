<?php

namespace App\Common\Enums;

use App\Common\Enums\Interface\GetValuesInterface;
use App\Common\Enums\Traits\GetValuesTrait;

enum Permission: string implements GetValuesInterface
{
    use GetValuesTrait;

    case DELETE_USER = 'delete-user';

}
