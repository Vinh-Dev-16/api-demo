<?php

namespace App\Domain\Authentication\Setups;

class UpdateTimeVerifyEmailSetup
{

    private array $dataUpdate;
    public function handle(): self
    {
        $dataUpdate = [
            'email_verified_at' => now(),
        ];
        $this->setDataUpdate($dataUpdate);

        return $this;
    }

    public function getDataUpdate(): array
    {
        return $this->dataUpdate;
    }
    public function setDataUpdate(array $dataUpdate): void
    {
        $this->dataUpdate = $dataUpdate;
    }
}