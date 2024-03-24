<?php

namespace App\Domain\Authentication\Listeners;
use App\Domain\Authentication\Events\SendOtpEmailEvent;
use App\Domain\Authentication\Jobs\SendOtpMailJob;
use App\Domain\Authentication\Mail\SendOtpMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendOtpMailListener implements ShouldQueue
{

    public function handle(SendOtpEmailEvent $event): void
    {
        $otp   = $event->otp;
        $email = $event->email;
        Mail::to($email)->send(new SendOtpMail($otp));
//        SendOtpMailJob::dispatch($email, $otp)->delay(now()->addSeconds(5));
    }
}
