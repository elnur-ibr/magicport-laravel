<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::get('/test', function (): void {
    $var = '123';
});

require __DIR__ . '/auth.php';
