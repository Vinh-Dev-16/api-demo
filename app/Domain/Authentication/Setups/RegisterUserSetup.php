<?php

namespace App\Domain\Authentication\Setups;

use App\Domain\Authentication\DTO\RegisterDTO;

class RegisterUserSetup
{
    private array $dataCreate;

    public function handle(RegisterDTO $dto): self
    {
        $dataCreate = [
            'name' => $dto->getUsername(),
            'email' => $dto->getEmail(),
            'password' => bcrypt($dto->getPassword()),
        ];
        $this->setDataCreate($dataCreate);

        return $this;
    }

    public function getDataCreate(): array
    {
        return $this->dataCreate;
    }

    public function setDataCreate(array $dataCreate): void
    {
        $this->dataCreate = $dataCreate;
    }
}
