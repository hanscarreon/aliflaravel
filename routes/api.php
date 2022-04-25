<?php

use App\Http\Controllers\pcvl\PcvlController;
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

Route::prefix('alif')->group(function () {
    Route::prefix('pcvl')->group(function () {
        Route::post('upload', 'pcvl\PcvlController@uploadFile')->name('uploadFile');
        Route::get('get', 'pcvl\PcvlController@getPcvlApi')->name('getPcvlApi');
    });
});


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('pcvl/create', 'pcvl\PcvlController@pvclCreate')->name('pcvlCreate');
