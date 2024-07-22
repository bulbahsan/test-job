<?php

namespace App\Events;

use App\Models\Row;
use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\InteractsWithSockets;
use function PHPUnit\Framework\isInstanceOf;

class RowsCreated implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public $row;
    public $message;

    public function __construct($message)
    {
        if ($message instanceof Row) {
            $this->message = 'Add row id => ' . $message->id;
        } else {
            $this->message = $message;
        }
    }

    public function broadcastOn()
    {
        return [
            new Channel('rows')
        ];
    }

    public function broadcastAs()
    {
        return 'RowsCreated';
    }

    public function broadcastWith()
    {
        return ['message' => $this->message];
    }
}
