<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VetController;
use App\Http\Controllers\PetController;
use App\Http\Middleware\ApiMiddleware;
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

Route::group(['middleware' => 'api-key'], function () {
    Route::group(['prefix' => 'vets'], function () {
        Route::get('', [VetController::class,'index']);
        Route::post('', [VetController::class,'store']);
        Route::put('/{id}', [VetController::class,'update']);
        Route::delete('/{id}', [VetController::class,'destroy']);
    });

    Route::group(['prefix' => 'pets'], function () {
        Route::get('', [PetController::class,'index']);
        Route::post('', [PetController::class,'store']);
        Route::put('/{id}', [PetController::class,'update']);
        Route::delete('/{id}', [PetController::class,'destroy']);
    });
});
