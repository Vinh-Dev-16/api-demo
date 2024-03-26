<?php

namespace App\Domain\Authentication\Features;

use App\Domain\Authentication\Actions\GetVerifyEmailAction;
use App\Domain\Authentication\Actions\UpsertVerifyEmailAction;
use App\Domain\Authentication\DTO\SendOTPDTO;
use App\Domain\Authentication\Events\SendOtpEmailEvent;
use App\Domain\Authentication\Setups\VerifyEmailSetup;
use App\Domain\Authentication\Transformers\SendOTPTransformer;
use App\Services\Users\GetUserServiceInterface;

class SendOTPFeature
{
    private SendOTPDTO $dto;

    public function __construct(
        protected GetUserServiceInterface $getUserService,
        protected VerifyEmailSetup        $verifyEmailSetup,
        protected GetVerifyEmailAction    $getVerifyEmailAction,
        protected UpsertVerifyEmailAction $upsertVerifyEmailAction,
        protected SendOTPTransformer      $sendOTPTransformer
    )
    {
    }

    public function setDto(SendOTPDTO $dto): void
    {
        $this->dto = $dto;
    }

    /**
     * @throws \Exception
     */
    public function handle(): array
    {
        $dto = $this->dto;
        $user = $this->getUserService->byEmail($dto->getEmail());
        try {
            $otp = rand(100000, 999999);
            $verifyEmail = $this->getVerifyEmailAction->handle(
                $user->getEmail());
            $verifyEmailSetup = $this->verifyEmailSetup->handle($user->getId(), $otp,
                $verifyEmail, $dto->getEmail());
            $this->upsertVerifyEmailAction->handle($verifyEmailSetup, $verifyEmail);
            SendOtpEmailEvent::dispatch($dto->getEmail(), $otp);
            $this->sendOTPTransformer->setUser($user);
            return $this->sendOTPTransformer->single();
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
