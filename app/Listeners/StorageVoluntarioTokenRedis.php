<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;

use Illuminate\Queue\InteractsWithQueue;

use Illuminate\Support\Facades\Redis;

use App\Events\StorageVoluntarioToken;

class StorageVoluntarioTokenRedis
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(StorageVoluntarioToken $eventVoluntario)
    {
        Redis::set(
            $eventVoluntario->voluntarioUser->token, 
            json_encode($eventVoluntario->voluntarioUser),
            'EX', 
            '3600'
        );
    }
}
