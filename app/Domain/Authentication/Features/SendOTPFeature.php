<?php

namespace App\Domain\Authentication\Features;

use App\Domain\Authentication\Actions\GetUserByMailAction;
use App\Domain\Authentication\DTO\SendOTPDTO;
use App\Domain\Authentication\Transformers\GetOtpTransformer;

class SendOTPFeature
{
    private SendOTPDTO $dto;

    public function __construct(
        protected GetUserByMailAction $getUserByMailAction,
    ) {
    }

    public function setDto(SendOTPDTO $dto): void
    {
        $this->dto = $dto;
    }

    public function handle(): void
    {
        $dto              = $this->dto;
        $user             = $this->getUserByMailAction->handle($dto->getEmail());
        $otp              = rand(1000, 9999);
        $verifyEmailSetup = $this->verifyEmailSetup->handle($dto, $otp);
        $this->verifyEmailAction->handle($verifyEmailSetup);

    }
}