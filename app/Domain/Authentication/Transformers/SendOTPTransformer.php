<?php

namespace App\Domain\Authentication\Transformers;

use App\Common\Transformers\TransformSingleInterface;
use App\Common\Transformers\UserTransformer;
use App\Models\User;

class SendOTPTransformer implements TransformSingleInterface
{

    private User $user;
    private string $otp;

    public function __construct(
        private readonly UserTransformer $userTransformer
    )
    {
    }

    public function single(): array
    {
        $user = $this->userTransformer->single($this->user);
        return [
            'user' => $user,
            'otp'  => $this->otp,
        ];
    }

    /**
     * @param  User  $user
     */
    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    /**
     * @param  string  $otp
     */
    public function setOtp(string $otp): void
    {
        $this->otp = $otp;
    }
}