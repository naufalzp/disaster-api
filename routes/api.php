<?php

use App\Http\Controllers\API\Auth\AuthController;
use App\Http\Controllers\API\DisasterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('login', [AuthController::class, 'login']);
        Route::post('register', [AuthController::class, 'register']);

        Route::middleware('auth:api')->group(function () {
            Route::get('user', [AuthController::class, 'user']);
            Route::post('logout', [AuthController::class, 'logout']);
        });
    });

    Route::middleware('auth:api')->group(function () {
        Route::get('disasters', [DisasterController::class, 'index']);
        Route::post('disasters', [DisasterController::class, 'store']);
        Route::get('disasters/{id}', [DisasterController::class, 'show']);
        Route::put('disasters/{id}', [DisasterController::class, 'update']);
        Route::delete('disasters/{id}', [DisasterController::class, 'destroy']);
    });
});
