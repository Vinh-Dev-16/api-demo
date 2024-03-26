<?php

namespace App\Domain\Admin\Product\DTO;

use App\Common\DTO\IndexPaginateDTOInterface;
use App\Common\DTO\IndexPaginateDTOTrait;

class ListProductDTO implements IndexPaginateDTOInterface
{
    use IndexPaginateDTOTrait;
}