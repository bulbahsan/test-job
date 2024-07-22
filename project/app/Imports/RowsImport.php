<?php

namespace App\Imports;

use App\Events\FileUploaded;
use App\Events\RowsCreated;
use App\Models\Row;
use Illuminate\Support\Facades\Redis;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class RowsImport implements ToArray,
    WithChunkReading,
    WithCalculatedFormulas,
    WithHeadingRow,
    SkipsEmptyRows
{
    protected string $importKey;

    public function __construct($importKey)
    {
        $this->importKey = $importKey;
    }

    public function chunkSize(): int
    {
        return 1000;
    }

    public function array(array $items): void
    {
        $data = array_map(function ($row) {
            return [
                'id'   => (int)$row['id'],
                'name' => $row['name'],
                'date' => \Carbon\Carbon::createFromFormat('j.n.y', $row['date'])->format('Y-m-d'),
            ];
        }, $items);

        Redis::hincrby($this->importKey, 'processed', count($data));

        Row::upsert($data, ['id'], ['name', 'date']);

        broadcast(new RowsCreated('Created ' . count($data) . ' rows!'));
    }
}
