<?php

namespace App\Domain\Authentication\Setups;

use App\Models\VerifyEmail;
use Carbon\Carbon;

class VerifyEmailSetup
{
    private array $dataCreate;
    private array $dataUpdate;

    public function handle(
        int          $userId,
        int          $otp,
        ?VerifyEmail $verifyEmail
    ): self {
        $dataCreate = [];
        $dataUpdate = [];
        if ($verifyEmail) {
            $dataUpdate = [
                'otp'         => $otp,
                'set_up_time' => Carbon::now()->addMinute(2)->timestamp,
            ];
        } else {
            $dataCreate = [
                'user_id'     => $userId,
                'otp'         => $otp,
                'set_up_time' => Carbon::now()->addMinute(2)->timestamp,
            ];
        }
        $this->setDataCreate($dataCreate);
        $this->setDataUpdate($dataUpdate);
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
     * @param  array  $dataCreate
     */
    public function setDataCreate(array $dataCreate): void
    {
        $this->dataCreate = $dataCreate;
    }

    /**
     * @return array
     */
    public function getDataUpdate(): array
    {
        return $this->dataUpdate;
    }

    /**
     * @param  array  $dataUpdate
     */
    public function setDataUpdate(array $dataUpdate): void
    {
        $this->dataUpdate = $dataUpdate;
    }


}
