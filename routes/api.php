<?php

use App\Http\Controllers\AdminResourceController;
use App\Http\Controllers\AdminServiceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {
    Route::prefix('services')->group(function () {
        Route::get('/', [AdminServiceController::class, 'index']);
        Route::get('/{service}', [AdminServiceController::class, 'show'])->whereNumber('service');
        Route::get('/{service}/resources', [AdminServiceController::class, 'getServiceWithResources'])->whereNumber('service');
        Route::post('/', [AdminServiceController::class, 'store']);
        Route::patch('/{service}', [AdminServiceController::class, 'update']);
        Route::delete('/{service}', [AdminServiceController::class, 'destroy']);
    });

     Route::prefix('resources')->group(function () {
        Route::get('/', [AdminResourceController::class, 'index']);
        Route::get('/{resource}', [AdminResourceController::class, 'show'])->whereNumber('resource');
        Route::post('/', [AdminResourceController::class, 'store']);
        Route::patch('/{resource}', [AdminResourceController::class, 'update']);
        Route::delete('/{resource}', [AdminResourceController::class, 'destroy']);
    });
});


 