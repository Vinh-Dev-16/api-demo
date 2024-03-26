<?php

namespace App\Domain\Authentication\Transformers;

use App\Common\Transformers\TransformSingleInterface;
use App\Common\Transformers\UserTransformer;
use App\Models\User;
use Illuminate\Support\Collection;

class LoginTransformer implements TransformSingleInterface
{

    private User $user;
    private string $token;

    public function __construct(
        protected UserTransformer $userTransformer
    )
    {
    }
    public function single(): array
    {
        $user = $this->userTransformer->single($this->user);
        return [
            'token' => $this->token,
            'user'  => $user
        ];
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    public function setToken(string $token): void
    {
        $this->token = $token;
    }



}