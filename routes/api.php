<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\MqSensorController;
use App\Http\Controllers\Api\Dht11SensorController;
use App\Http\Controllers\Api\RainSensorController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// route group name api
Route::group(['as' => 'api.'], function () {
    // resource route
    Route::resource('users', UserController::class)
        ->except(['create', 'edit']);

    Route::resource('sensors/mq', MqSensorController::class)
        ->names('sensors.mq');

    Route::resource('sensors/dht11', Dht11SensorController::class)
        ->names('sensors.dht11')
        ->only(['index', 'store']);

    Route::resource('sensors/rain', RainSensorController::class) // Sesuaikan nama controller
        ->names('sensors.rain');
});
