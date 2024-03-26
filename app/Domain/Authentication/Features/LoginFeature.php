<?php

namespace App\Domain\Authentication\Features;

use App\Common\Transformers\TransformSingleInterface;
use App\Domain\Authentication\DTO\LoginDTO;
use App\Domain\Authentication\Transformers\LoginTransformer;
use App\Services\Users\GetUserServiceInterface;
use Illuminate\Support\Facades\Log;

class LoginFeature
{
    private LoginDTO $dto;

    public function __construct(
        public readonly LoginTransformer $transformer,
        public GetUserServiceInterface   $getUserService
    ) {
    }

    /**
     * @param  LoginDTO  $dto
     */
    public function setDto(LoginDTO $dto): void
    {
        $this->dto = $dto;
    }

    public function handle(): array
    {
        $dto         = $this->dto;
        $credentials = [
            'email'    => $dto->getEmail(),
            'password' => $dto->getPassword()
        ];
        $user        = $this->getUserService->byEmail($dto->getEmail());

        $token       = auth()->attempt($credentials);
        $this->transformer->setUser($user);
        $this->transformer->setToken($token);
        return $this->transformer->single();
    }


}
