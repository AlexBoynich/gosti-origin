<?php

use App\Filament\File\FileUploadHandler;
use App\Http\Controllers\UploadFileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('/cp/livewire/upload-file', [FileUploadHandler::class, 'handle'])
    ->name('livewire.upload-file')
    ->middleware(config('livewire.middleware_group', ''));

Route::get('/cp/upload-file', [UploadFileController::class, 'create'])->name('cp.upload-file');
Route::post('/cp/store', [UploadFileController::class, 'store'])->name('cp.store');