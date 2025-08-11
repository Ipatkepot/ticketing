<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        // contoh:
        // 'App\Events\NewChatMessage' => [
        //     'App\Listeners\SendChatNotification',
        // ],
    ];

    public function boot(): void
    {
        //
    }
}
