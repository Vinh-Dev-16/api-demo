<?php

namespace App\Common\Enums;
use App\Common\Enums\Interface\GetValuesInterface;
use App\Common\Enums\Traits\GetValuesTrait;

enum Status: int implements GetValuesInterface
{
    use GetValuesTrait;
    case ACTIVE = 1;
    case INACTIVE = 0;
}
