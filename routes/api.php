<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/artists-popularity', [DashboardController::class, 'artistsByPopularity']);
Route::get('/year-popularity', [DashboardController::class, 'getPopularityByYear']);
Route::get('/decade-popularity', [DashboardController::class, 'getPopularityByDecade']);
Route::get('/correlation', [DashboardController::class, 'getCorrelationData']);
Route::post('/music-stats', [DashboardController::class, 'getMusicStats']);
Route::get('/music-tones', [DashboardController::class, 'getMusicTones']);
