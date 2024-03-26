<?php

namespace App\Domain\Authentication\Events;
use App\Domain\Authentication\DTO\RegisterDTO;
use App\Domain\Authentication\Setups\RegisterUserSetup;
use Illuminate\Broadcasting\Channel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Event;

class RegisterUserEvent extends Event
{
    use Dispatchable;
    use SerializesModels;


    public function __construct(
        public readonly RegisterDTO       $dto,
        public readonly RegisterUserSetup $registerUserSetup
    )
    {
    }

    public function boardCastOn(): Channel
    {
        return new Channel('otp-email');
    }
}
