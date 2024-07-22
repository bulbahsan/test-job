<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Redis;
use Tests\TestCase;

class RedisHistoryControllerTest extends TestCase
{
    public function test_redis_history()
    {
        $startAt = date('Y-m-d H:i:s');
        $endAt = date('Y-m-d H:i:s');
        Redis::shouldReceive('scan')->andReturn(['0', ['history:test_key']]);
        Redis::shouldReceive('hGetAll')->andReturn([
            'status'    => 'completed',
            'start_at'  => $startAt,
            'end_at'    => $endAt,
            'processed' => 100
        ]);

        $response = $this->get('/redis-history');

        $response->assertStatus(200);
        $response->assertViewHas('data', [
            'history:test_key' => [
                'status'    => 'completed',
                'start_at'  => $startAt,
                'end_at'    => $endAt,
                'processed' => 100
            ]
        ]);
    }
}
