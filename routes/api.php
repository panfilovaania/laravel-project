<?php

use App\Http\Controllers\AdminResourceController;
use App\Http\Controllers\AdminServiceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RBACController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\LocaleFromUrl;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::prefix('auth')->group(function () {
        Route::post('/login', [AuthController::class, 'login']);
});

Route::prefix('rbac')->group(function () {
        Route::get('/can', [RBACController::class, 'hasPermission']);
});

Route::prefix('{locale}/admin')->where(['locale' => 'en|ru'])
    ->middleware(['auth:sanctum','locale'])->group(function () {
    Route::prefix('services')->name('admin.services.')->group(function () {
        Route::get('/', [AdminServiceController::class, 'index'])
            ->middleware('can:viewAny,App\Models\Service')
            ->name('index');
        Route::get('/{service}', [AdminServiceController::class, 'show'])->whereNumber('service')
            ->middleware('can:view,service')
            ->name('show');
        Route::post('/', [AdminServiceController::class, 'store'])
            ->middleware('can:create,App\Models\Service')
            ->name('store');
        Route::patch('/{service}', [AdminServiceController::class, 'update'])->whereNumber('service')
            ->middleware('can:update,service')
            ->name('update');
        Route::delete('/{service}', [AdminServiceController::class, 'destroy'])->whereNumber('service')
            ->middleware('can:delete,service')
            ->name('destroy');
    });

    Route::prefix('resources')->name('admin.resources.')->group(function () {
        Route::get('/', [AdminResourceController::class, 'index'])
            ->middleware('can:viewAny,App\Models\Resource')
            ->name('index');
        Route::get('/{resource}', [AdminResourceController::class, 'show'])->whereNumber('resource')
            ->middleware('can:view,resource')
            ->name('show');
        Route::post('/', [AdminResourceController::class, 'store'])
            ->middleware('can:create,App\Models\Resource')
            ->name('store');
        Route::patch('/{resource}', [AdminResourceController::class, 'update'])->whereNumber('resource')
            ->middleware('can:update,resource')
            ->name('update');
        Route::delete('/{resource}', [AdminResourceController::class, 'destroy'])->whereNumber('resource')
            ->middleware('can:delete,resource')
            ->name('destroy');
    });
});

Route::prefix('users')->middleware('auth:sanctum')->group(function () {
        Route::get('/{user}', [UserController::class, 'show'])->whereNumber('user')
            ->middleware('can:view,user');
        Route::patch('/{user}', [UserController::class, 'update'])->whereNumber('user')
            ->middleware('can:update,user');
});
