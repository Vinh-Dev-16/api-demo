<?php

namespace App\Domain\Authentication\Setups;

use App\Domain\Authentication\DTO\RegisterDTO;

class RegisterUserSetup
{
    private array $dataCreate;
    private int $id;

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

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }


}
