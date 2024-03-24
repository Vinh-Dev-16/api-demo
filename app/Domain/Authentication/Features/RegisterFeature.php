<?php

namespace App\Domain\Authentication\Features;
use App\Domain\Authentication\Actions\RegisterUserAction;
use App\Domain\Authentication\DTO\RegisterDTO;
use App\Domain\Authentication\Setups\RegisterUserSetup;
use Illuminate\Support\Facades\Event;
use RegisterEvent;

class RegisterFeature
{
    private RegisterDTO $dto;

    public function __construct(
        private readonly RegisterUserSetup $registerUserSetup,
        private readonly RegisterUserAction $registerUserAction
    )
    {

    }

    public function setDto(RegisterDTO $dto): void
    {
        $this->dto = $dto;
    }

    public function handle(): void
    {
        $dto = $this->dto;
        $registerUserSetup = $this->registerUserSetup->handle($dto);
        $this->registerUserAction->handle($registerUserSetup);
//        RegisterEvent::dispatch($dto, $registerUserSetup->getDataCreate());
    }
}
