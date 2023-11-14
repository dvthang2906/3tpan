<?php

use App\Http\Controllers\VoiceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/input-json-data', [VoiceController::class, 'inputJsonData'])->name('input-json');
Route::get('/get-json-data', [VoiceController::class, 'getJsonData'])->name('get-json');


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
