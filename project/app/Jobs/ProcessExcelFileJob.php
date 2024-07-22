<?php

namespace App\Jobs;

use App\Events\ImportCompleted;
use App\Events\RowsCreated;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Redis;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\RowsImport;
use Maatwebsite\Excel\Reader;

class ProcessExcelFileJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected string $filePath;
    protected string $importId;

    public function __construct($filePath, $importId)
    {
        $this->filePath = $filePath;
        $this->importId = $importId;
    }

    public function handle()
    {
        $importKey = 'history:' . $this->importId;
        Redis::hset($importKey, 'processed', 0);
        Redis::hset($importKey, 'start_at', date('d-m-Y H:i:s'));
        Redis::hset($importKey, 'end_at', '');
        Redis::hset($importKey, 'status', 'running');

        Excel::import(new RowsImport($importKey), $this->filePath);

        Redis::hset($importKey, 'status', 'completed');
        Redis::hset($importKey, 'end_at', date('d-m-Y H:i:s'));

        broadcast(new ImportCompleted('Import job ' . $this->importId . ' is completed!'));
    }
}

