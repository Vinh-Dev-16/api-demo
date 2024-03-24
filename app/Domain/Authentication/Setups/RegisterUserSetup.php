<?php

namespace App\Domain\Authentication\Setups;

use App\Common\Enums\Status;
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

    /**
     * @return array
     */
    public function getDataCreate(): array
    {
        return $this->dataCreate;
    }

    /**
     * @param array $dataCreate
     */
    public function setDataCreate(array $dataCreate): void
    {
        $this->dataCreate = $dataCreate;
    }

}
