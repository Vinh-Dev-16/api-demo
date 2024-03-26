<?php

namespace App\Domain\Authentication\Features;

use App\Common\Transformers\TransformSingleInterface;
use App\Domain\Authentication\DTO\LoginDTO;
use App\Services\Users\GetUserServiceInterface;

class LoginFeature
{
    private LoginDTO $dto;
    public function __construct(
//        public readonly LoginTransformer $transformer,
        public readonly GetUserServiceInterface $getUserService
    )
    {
    }

    /**
     * @param LoginDTO $dto
     */
    public function setDto(LoginDTO $dto): void
    {
        $this->dto = $dto;
    }

    public function handle(): void
    {
        $dto = $this->dto;
        $credentials = [
            'email' => $dto->getEmail(),
            'password' => $dto->getPassword()
        ];
        $token = auth()->attempt($credentials);
        dd($token);
        $user = $this->getUserService->byEmail($dto->getEmail());
        $roles = $user->getRoleNames();
        $permissions = $user->getAllPermissions();
        dd($roles);
//        $this->transformer->setUser($user);
//        $this->transformer->setToken($token);
//        $this->transformer->setRoles($roles);
//        $this->transformer->setPermissions($permissions);
//        return $this->transformer->single();
    }


}
