<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;

use App\Ong;

class StorageOngToken
{
    use SerializesModels;

    public $ongUser;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Ong $ong)
    {
        $this->ongUser = $ong;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    // public function broadcastOn()
    // {
    //     return new PrivateChannel('channel-name');
    // }
}
