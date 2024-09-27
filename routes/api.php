<?php

declare(strict_types=1);

use App\Http\Controllers\ProjectController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('api')->name('api.')->group(function (): void {
    Route::prefix('v1')->name('v1.')->group(function (): void {
        Route::middleware(['auth:sanctum'])->get('/user', fn (Request $request) => $request->user());

        Route::middleware(['auth:sanctum'])->group(function (): void {
            Route::apiResource('project', ProjectController::class);
            Route::apiResource('task', ProjectController::class);
        });
    });
});
