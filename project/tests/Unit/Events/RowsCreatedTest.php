<?php

namespace Tests\Unit\Events;

use App\Events\RowsCreated;
use Tests\TestCase;
use Illuminate\Support\Facades\Event;

class RowsCreatedTest extends TestCase
{
    public function test_event_broadcasts_correct_data()
    {
        Event::fake();

        $message = 'Rows created successfully';
        $event = new RowsCreated($message);

        $this->assertEquals($message, $event->message);
        $this->assertEquals(['message' => $message], $event->broadcastWith());
    }
}
