<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Station\StationController;
use App\Http\Controllers\Api\Train\TrainController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ()
{
    Route::post('/register',            [AuthController::class, 'register']);
    Route::post('/login',               [AuthController::class, 'login']);
    Route::post('/logout',              [AuthController::class, 'logout'])->middleware('auth:api');
    Route::post('/refresh',             [AuthController::class, 'refresh'])->middleware('auth:api');
    Route::post('/profile',             [AuthController::class, 'profile'])->middleware('auth:api');
});

Route::resource('station', StationController::class)->only(['index', 'store', 'update', 'destroy'])->middleware('auth:api');

Route::resource('train', TrainController::class)->only(['index', 'store', 'update', 'destroy'])->middleware('auth:api');

