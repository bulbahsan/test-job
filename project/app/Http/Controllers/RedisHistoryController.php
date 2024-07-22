<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Row;
use Illuminate\Support\Facades\Redis;

class RedisHistoryController extends Controller
{
    public function history()
    {
        $pattern = 'history:*';
        $keys = $this->scanForKeys($pattern);

        $data = [];

        foreach ($keys as $key) {
            $data[$key] = Redis::hGetAll($key);
        }

        return view('redis-history', [
            'data' => $data
        ]);
    }

    private function scanForKeys($pattern)
    {
        $cursor = '0';
        $keys = [];

        do {
            $result = Redis::scan($cursor, ['match' => $pattern, 'count' => 100]);
            $cursor = $result[0];
            $keys = array_merge($keys, $result[1]);
        } while ($cursor != 0);

        return $keys;
    }
}
