<?php

namespace App\Domain\Authentication\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Event;

class SendOtpEmailEvent extends Event
{
    use Dispatchable;
    use SerializesModels;


    public function __construct(
        public readonly string $email,
        public readonly int    $otp
    ) {
    }

    public function boardcastOn(): Channel
    {
        return new Channel('otp-email');
    }
}