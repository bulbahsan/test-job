<?php

namespace Tests\Unit\Events;

use App\Events\ImportCompleted;
use Tests\TestCase;
use Illuminate\Support\Facades\Event;

class ImportCompletedTest extends TestCase
{
    public function test_event_broadcasts_correct_data()
    {
        Event::fake();

        $message = 'Import completed successfully';
        $event = new ImportCompleted($message);

        $this->assertEquals($message, $event->message);
        $this->assertEquals(['message' => $message], $event->broadcastWith());
    }
}
