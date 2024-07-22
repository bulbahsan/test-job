<?php

use App\Http\Controllers\RedisHistoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\RowsController;

Route::get('/', function (){
    return redirect('upload');
});
Route::get('/upload', [FileUploadController::class, 'index'])->name('upload.index');
Route::post('/upload', [FileUploadController::class, 'uploadFile'])->name('upload.file');
Route::get('/rows', [RowsController::class, 'index'])->name('rows.index');
Route::get('/redis-history', [RedisHistoryController::class, 'history'])->name('redis.history');
