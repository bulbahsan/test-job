<?php

namespace Tests\Unit\Events;

use App\Events\FileUploaded;
use Tests\TestCase;
use Illuminate\Support\Facades\Event;

class FileUploadedTest extends TestCase
{
    public function test_event_broadcasts_correct_data()
    {
        Event::fake();

        $message = 'File upload successfully';
        $event = new FileUploaded($message);

        $this->assertEquals($message, $event->message);
        $this->assertEquals(['message' => $message], $event->broadcastWith());
    }
}
