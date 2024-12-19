<?php

namespace App\Providers;

use App\Events\UserLoggedInEvent;
use Illuminate\Support\ServiceProvider;
use App\Listeners\UpdateLastLoginListener;
use App\Listeners\UpdateLoginCountListener;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [

        UserLoggedInEvent::class => [
            UpdateLastLoginListener::class,
            UpdateLoginCountListener::class,

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
