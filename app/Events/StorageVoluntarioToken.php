<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;

use App\Voluntario;

class StorageVoluntarioToken
{
    use SerializesModels;

    public $voluntarioUser;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Voluntario $voluntario)
    {
        $this->voluntarioUser = $voluntario;
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
