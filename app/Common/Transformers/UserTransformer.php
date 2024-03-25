<?php

namespace App\Common\Transformers;

use App\Models\User;

class UserTransformer
{
    public function single(User $user): array
    {
        return [
            'id'    => $user->getId(),
            'name'  => $user->getName(),
            'email' => $user->getEmail(),
        ];
    }

}