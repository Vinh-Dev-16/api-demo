<?php

namespace App\Domain\Authentication\Features;

use App\Domain\Authentication\Actions\RegisterUserAction;
use App\Domain\Authentication\DTO\RegisterDTO;
use App\Domain\Authentication\Events\RegisterUserEvent;
use App\Domain\Authentication\Setups\RegisterUserSetup;

class RegisterFeature
{
    private RegisterDTO $dto;

    public function __construct(
        private readonly RegisterUserSetup  $registerUserSetup,
        private readonly RegisterUserAction $registerUserAction
    )
    {

    }

    public function setDto(RegisterDTO $dto): void
    {
        $this->dto = $dto;
    }

    /**
     * @throws \Exception
     */
    public function handle(): void
    {
        $dto = $this->dto;
        try {
            $registerUserSetup = $this->registerUserSetup->handle($dto);
            $user = $this->registerUserAction->handle($registerUserSetup);
            $registerUserSetup->setId($user->getId());
            RegisterUserEvent::dispatch($dto,
                $registerUserSetup);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
