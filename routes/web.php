<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MusicController;
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
    return view('home');
});
Route::get('/upload-json', [MusicController::class, 'showUploadForm'])->name('upload.json.form');
Route::post('/upload-json', [MusicController::class, 'processUpload'])->name('upload.json.process');