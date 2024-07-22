<?php

namespace Tests\Unit;

use App\Jobs\ProcessExcelFileJob;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Queue;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\RowsImport;
use Tests\TestCase;

class ProcessExcelFileJobTest extends TestCase
{
    public function test_job_imports_excel_file()
    {
        $filePath = 'test.xlsx';
        $importId = 'test_import_id';

        Redis::shouldReceive('hset')->times(6);
        Excel::shouldReceive('import')->once()->with(\Mockery::type(RowsImport::class), $filePath);

        $job = new ProcessExcelFileJob($filePath, $importId);
        $job->handle();

        Redis::shouldHaveReceived('hset')->with("history:$importId", 'status', 'completed');
    }
}
