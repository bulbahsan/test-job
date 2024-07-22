<?php

namespace App\Http\Controllers;

use App\Events\FileUploaded;
use App\Http\Requests\Import\UploadFileRequest;
use App\Jobs\ProcessExcelFileJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class FileUploadController extends Controller
{
    public function index()
    {
        return view('upload');
    }

    public function uploadFile(UploadFileRequest $request)
    {
        $filePath = $request->file('file')->store('uploads');
        $importId = Str::uuid();

        ProcessExcelFileJob::dispatch($filePath, $importId)->onQueue('importExcel');

        $fileSize = round(filesize(storage_path('app/' . $filePath)) / 1024, 2);

        broadcast(new FileUploaded('File size: ' . $fileSize . ' Kb.'));

        return response()->json(['success' => 'File upload successfully.']);

    }
}
