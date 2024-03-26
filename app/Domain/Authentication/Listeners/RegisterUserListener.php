<?php

namespace App\Domain\Authentication\Listeners;

use App\Common\Enums\Role;
use App\Domain\Authentication\Events\RegisterUserEvent;
use App\Services\Users\GetUserServiceInterface;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegisterUserListener implements ShouldQueue
{
    public function __construct(
        protected GetUserServiceInterface $getUserService
    )
    {
        //
    }

    public function handle(RegisterUserEvent $event): void
    {
        $userId = $event->registerUserSetup->getId();
        $user = $this->getUserService->byIdNotVerify($userId);
        $user->assignRole(Role::USER->value);
    }
}
