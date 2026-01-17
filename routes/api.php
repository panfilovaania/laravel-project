<?php

use App\Http\Controllers\AdminResourceController;
use App\Http\Controllers\AdminServiceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RBACController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
        Route::post('/login', [AuthController::class, 'login']);
});

Route::prefix('rbac')->group(function () {
        Route::get('/can', [RBACController::class, 'hasPermission']);
});

Route::prefix('admin')->middleware('auth:sanctum')->group(function () {
    Route::prefix('services')->group(function () {
        Route::get('/', [AdminServiceController::class, 'index'])
            ->middleware('can:viewAny,App\Models\Service');
        Route::get('/{service}', [AdminServiceController::class, 'show'])->whereNumber('service')
            ->middleware('can:view,service');
        Route::post('/', [AdminServiceController::class, 'store'])
            ->middleware('can:create,App\Models\Service');
        Route::patch('/{service}', [AdminServiceController::class, 'update'])->whereNumber('service')
            ->middleware('can:update,service');
        Route::delete('/{service}', [AdminServiceController::class, 'destroy'])->whereNumber('service')
            ->middleware('can:delete,service');
    });

    Route::prefix('resources')->group(function () {
        Route::get('/', [AdminResourceController::class, 'index']);
        Route::get('/{resource}', [AdminResourceController::class, 'show'])->whereNumber('resource');
        Route::post('/', [AdminResourceController::class, 'store']);
        Route::patch('/{resource}', [AdminResourceController::class, 'update']);
        Route::delete('/{resource}', [AdminResourceController::class, 'destroy']);
    });
});

Route::prefix('users')->middleware('auth:sanctum')->group(function () {
        Route::get('/{user}', [UserController::class, 'show'])->whereNumber('user')
            ->middleware('can:view,user');
        Route::patch('/{user}', [UserController::class, 'update'])->whereNumber('user')
            ->middleware('can:update,user');
});