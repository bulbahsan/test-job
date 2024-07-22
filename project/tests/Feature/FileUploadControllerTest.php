<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Queue;
use App\Jobs\ProcessExcelFileJob;
use Tests\TestCase;

class FileUploadControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_file_upload()
    {
        Queue::fake();

        $file = UploadedFile::fake()->create('test.xlsx');

        $response = $this->post('/upload', [
            'file' => $file,
        ]);

        $response->assertStatus(200);
        $response->assertJson(['success' => 'File upload successfully.']);

        Queue::assertPushed(ProcessExcelFileJob::class);
    }
}
