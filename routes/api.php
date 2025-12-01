<?php

use App\Http\Controllers\AdminServiceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {
    Route::prefix('services')->group(function () {
        Route::get('/', [AdminServiceController::class, 'index']);
        Route::get('/{service}', [AdminServiceController::class, 'show'])->whereNumber('service');
        Route::post('/', [AdminServiceController::class, 'store']);
        Route::patch('/{service}', [AdminServiceController::class, 'update']);
        Route::delete('/{service}', [AdminServiceController::class, 'destroy']);
    });
});


 