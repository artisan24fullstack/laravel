<?php

namespace App\Providers;

use App\Events\UserLoggedInEvent;
use App\Listeners\UpdateLastLoginListener;
use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [

        UserLoggedInEvent::class => [
            UpdateLastLoginListener::class,
        ],

    ];
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
