<?php

namespace App\Providers;

use App\Domain\Authentication\Events\RegisterUserEvent;
use App\Domain\Authentication\Events\SendOtpEmailEvent;
use App\Domain\Authentication\Listeners\RegisterUserListener;
use App\Domain\Authentication\Listeners\SendOtpMailListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class        => [
            SendEmailVerificationNotification::class,
        ],
        SendOtpEmailEvent::class => [
            SendOtpMailListener::class,
        ],
        RegisterUserEvent::class => [
            RegisterUserListener::class,
        ],
    ];


    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
