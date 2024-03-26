<?php

namespace App\Domain\Authentication\Features;

use App\Domain\Authentication\Actions\GetVerifyEmailAction;
use App\Domain\Authentication\Actions\UpdateUserTimeVerifyEmailAction;
use App\Domain\Authentication\DTO\VerifyEmailDTO;
use App\Domain\Authentication\Setups\UpdateTimeVerifyEmailSetup;
use App\Services\Users\GetUserServiceInterface;

class VerifyEmailFeature
{
    private VerifyEmailDTO $dto;

    public function __construct(
        protected GetUserServiceInterface         $getUserService,
        protected GetVerifyEmailAction            $getVerifyEmailAction,
        protected UpdateUserTimeVerifyEmailAction $updateUserTimeVerifyEmailAction,
        protected UpdateTimeVerifyEmailSetup      $updateTimeVerifyEmailSetup
    ) {
    }

    public function setDTO(VerifyEmailDTO $dto): void
    {
        $this->dto = $dto;
    }

    public function handle(): void
    {
        $dto                        = $this->dto;
        $user                       = $this->getUserService->byEmail($dto->getEmail());
        $updateTimeVerifyEmailSetup = $this->updateTimeVerifyEmailSetup->handle();
        $this->updateUserTimeVerifyEmailAction->handle($user, $updateTimeVerifyEmailSetup);
    }
}
