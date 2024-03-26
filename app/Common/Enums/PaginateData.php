<?php

namespace App\Common\Enums;

use App\Common\Enums\Interface\GetValuesInterface;
use App\Common\Enums\Traits\GetValuesTrait;

enum PaginateData: int implements GetValuesInterface
{
    use GetValuesTrait;

    case LIMIT = 10;
    case PAGE  = 1;
}