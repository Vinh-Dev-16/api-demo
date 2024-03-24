<?php

namespace App\Domain\Authentication\Features;

use App\Domain\Authentication\Actions\GetVerifyEmailAction;
use App\Domain\Authentication\Actions\UpsertVerifyEmailAction;
use App\Domain\Authentication\DTO\SendOTPDTO;
use App\Domain\Authentication\Events\SendOtpEmailEvent;
use App\Domain\Authentication\Setups\VerifyEmailSetup;
use App\Services\Users\GetUserServiceInterface;

class SendOTPFeature
{
    private SendOTPDTO $dto;

    public function __construct(
        protected GetUserServiceInterface $getUserService,
        protected VerifyEmailSetup        $verifyEmailSetup,
        protected GetVerifyEmailAction    $getVerifyEmailAction,
        protected UpsertVerifyEmailAction $upsertVerifyEmailAction,
    )
    {
    }

    public function setDto(SendOTPDTO $dto): void
    {
        $this->dto = $dto;
    }

    public function handle(): void
    {
        $dto = $this->dto;
        $user = $this->getUserService->byEmail($dto->getEmail());
        $otp = rand(100000, 999999);
        $verifyEmail = $this->getVerifyEmailAction->handle(
            $user->getEmail());
        $verifyEmailSetup = $this->verifyEmailSetup->handle($user->getId(), $otp, $verifyEmail);
        $this->upsertVerifyEmailAction->handle($verifyEmailSetup, $verifyEmail);
        SendOtpEmailEvent::dispatch($dto->getEmail(), $otp);
    }
}
