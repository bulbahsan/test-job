<?php

// tests/Feature/ConnectionsTest.php

namespace Tests\Feature;

use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\DB;
use Pusher\Pusher;
use Tests\TestCase;

class ConnectionsTest extends TestCase
{
    public function test_redis_connection()
    {
        $response = Redis::connection()->ping();
        $this->assertEquals('PONG', $response);
    }

    public function test_mysql_connection()
    {
        $response = DB::connection()->getPdo();
        $this->assertNotNull($response);
        $this->assertEquals('test', DB::connection()->getDatabaseName());
    }

    public function test_pusher_connection()
    {
        $pusher = new Pusher(
            config('broadcasting.connections.pusher.key'),
            config('broadcasting.connections.pusher.secret'),
            config('broadcasting.connections.pusher.app_id'),
            [
                'cluster' => config('broadcasting.connections.pusher.options.cluster'),
                'useTLS'  => true
            ]
        );

        $response = $pusher->get('/channels');
        $this->assertInstanceOf(\stdClass::class, $response);
        $this->assertTrue(property_exists($response, 'channels'));
    }

    public function test_rabbitmq_connection()
    {
        $connection = @fsockopen(
            config('queue.connections.rabbitmq.host'),
            config('queue.connections.rabbitmq.port')
        );

        $this->assertTrue(is_resource($connection));
        if (is_resource($connection)) {
            fclose($connection);
        }
    }
}
