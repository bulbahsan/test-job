<?php

namespace Tests\Unit;

use App\Imports\RowsImport;
use Maatwebsite\Excel\Events\AfterImport;
use Maatwebsite\Excel\Facades\Excel;
use Tests\TestCase;
use Illuminate\Support\Facades\Redis;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Row;
use Illuminate\Support\Carbon;

class RowsImportTest extends TestCase
{
    use RefreshDatabase;

    public function test_import_saves_data_to_database()
    {
        $importKey = 'test_import_key';
        Redis::shouldReceive('hincrby')->once();

        $import = new RowsImport($importKey);
        $data = [
            ['id' => 1, 'name' => 'Test', 'date' => '1.1.21'],
            ['id' => 2, 'name' => 'Test', 'date' => '15.1.22'],
            ['id' => 3, 'name' => 'Test', 'date' => '1.10.23']
        ];

        $import->array($data);

        $this->assertDatabaseHas('rows', [
            'id'   => 1,
            'name' => 'Test',
            'date' => '2021-01-01'
        ]);
        $this->assertDatabaseHas('rows', [
            'id'   => 2,
            'name' => 'Test',
            'date' => '2022-01-15'
        ]);
        $this->assertDatabaseHas('rows', [
            'id'   => 3,
            'name' => 'Test',
            'date' => '2023-10-01'
        ]);
    }
}
