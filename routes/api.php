<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\IndicatorController;
use App\Http\Controllers\NefarioMinionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TracingController;
use App\Http\Controllers\UserController;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('auth/login', [AuthController::class, 'login']);

Route::post('auth/signup', [AuthController::class, 'signup']);

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('user', UserController::class)
        ->middleware('role:'.Role::$gru);

    Route::apiResource('role', RoleController::class)
        ->middleware("role:".Role::$gru);

    Route::apiResource('indicator', IndicatorController::class)
        ->middleware(['roleOrSuperior:'.Role::$nefario]);

    Route::apiResource('nefario-minion', NefarioMinionController::class)
        ->middleware(['roleOrSuperior:'.Role::$nefario]);

    Route::apiResource('category', CategoryController::class)
        ->middleware(['roleOrSuperior:'.Role::$nefario]);

    Route::apiResource('tracings', TracingController::class)
        ->middleware(['roleOrSuperior:'.Role::$nefario]);

    Route::apiResource('tracing-history', \App\Http\Controllers\TracingHistoryController::class)
        ->middleware(['roleOrSuperior:'.Role::$nefario]);
});
