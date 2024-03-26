<?php

namespace App\Common\Enums;

use App\Common\Enums\Interface\GetValuesInterface;
use App\Common\Enums\Traits\GetValuesTrait;

enum SoftDelete: int implements GetValuesInterface
{
    use GetValuesTrait;

    case ACTIVE  = 0;
    case DELETED = 1;
}