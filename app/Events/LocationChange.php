<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class LocationChange implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $kendaraan_id,$lat,$lng;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($arrayLocation)
    {
        $this->kendaraan_id=$arrayLocation['kendaraan_id'];
        $this->lat=$arrayLocation['lat'];
        $this->lng=$arrayLocation['lng'];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('my-channel');
    }
    public function broadcastAs()
    {
        return 'location-change';
    }
}
