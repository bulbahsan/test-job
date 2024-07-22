<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\InteractsWithSockets;

class ImportCompleted implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public $row;
    public $message;

    public function __construct($message)
    {
        $this->message = $message;
    }

    public function broadcastOn()
    {
        return [
            new Channel('import')
        ];
    }

    public function broadcastAs()
    {
        return 'ImportCompleted';
    }

    public function broadcastWith()
    {
        return ['message' => $this->message];
    }
}
