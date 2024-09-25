<?php

use App\Http\Controllers\ProjectController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('api')->name('api.')->group(function () {
    Route::prefix('v1')->name('v1.')->group(function () {
        Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
            return $request->user();
        });

        Route::middleware(['auth:sanctum'])->group(function () {
            Route::apiResource('project', ProjectController::class);
        });
    });
});




