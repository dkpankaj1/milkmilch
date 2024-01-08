<?php

namespace App\Listeners;

use App\Events\LoginEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class LoginEventListener
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
    public function handle(LoginEvent $event): void
    {
        DB::table('login_histories')->insert([
            'email' => $event->user->email,
            'login_time' => now(),
            'ip' => $event->ip,
            'user_agent' => $event->userAgent
        ]);

        $event->user->notify(new \App\Notifications\SendLoginNotification($event->user,$event->ip,$event->userAgent));
    }
}
