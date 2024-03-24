<?php

namespace App\Common\Enums\Traits;

trait GetValuesTrait
{
    public static function getValues(): array
    {
        return collect((new \ReflectionClass(static::class))->getConstants())->values()->toArray();
    }
}