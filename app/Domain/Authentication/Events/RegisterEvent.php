<?php

use App\Domain\Authentication\DTO\RegisterDTO;
use Illuminate\Support\Facades\Event;

class RegisterEvent extends Event
{
    public function __construct(
        public readonly RegisterDTO $dto,
        public readonly array       $dataCreate
    )
    {
    }
}
