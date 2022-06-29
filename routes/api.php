<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
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

Route::apiResource('user', UserController::class)
    ->middleware(['auth:sanctum', "abilities:gru:create,gru:read,gru:update,gru:delete"]);

Route::apiResource('role', RoleController::class)
    ->middleware(['auth:sanctum', "abilities:gru:create,gru:read,gru:update,gru:delete"]);

Route::apiResource('indicator', \App\Http\Controllers\IndicatorController::class)
    ->middleware(['auth:sanctum', 'abilities:gru:create,gru:read,gru:update,gru:delete']);
