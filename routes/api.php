<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\StationController;

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ()
{
    Route::post('/register',            [AuthController::class, 'register']);
    Route::post('/login',               [AuthController::class, 'login']);
    Route::post('/logout',              [AuthController::class, 'logout'])->middleware('auth:api');
    Route::post('/refresh',             [AuthController::class, 'refresh'])->middleware('auth:api');
    Route::post('/profile',             [AuthController::class, 'profile'])->middleware('auth:api');
});

Route::resource('station', StationController::class)->only(['index', 'store', 'update', 'destroy'])->middleware('auth:api');

