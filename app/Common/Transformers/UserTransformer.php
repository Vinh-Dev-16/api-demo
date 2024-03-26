<?php

namespace App\Common\Transformers;

use App\Models\User;
use Illuminate\Support\Collection;

class UserTransformer
{
    public function single(User $user): array
    {
        return [
            'id'          => $user->getId(),
            'name'        => $user->getName(),
            'email'       => $user->getEmail(),
            'roles'       => $this->transformRoles($user->getRoleNames()),
            'permissions' => $this->transformPermissions($user->getAllPermissions())
        ];
    }

    private function transformRoles(Collection $roles): array
    {
        return $roles->map(function ($role) {
            return [
                'name' => $role
            ];
        })->toArray();
    }

    private function transformPermissions(Collection $permissions): array
    {
        return $permissions->map(function ($permission) {
            return [
                'name' => $permission->name
            ];
        })->toArray();
    }

}