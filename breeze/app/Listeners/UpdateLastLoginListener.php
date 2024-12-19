<?php

namespace App\Listeners;

use Carbon\Carbon;
use App\Events\UserLoggedInEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateLastLoginListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserLoggedInEvent $event): void
    {
        //
        $user = $event->user;
        $user->last_login = Carbon::now();
        $user->save();
    }
}
