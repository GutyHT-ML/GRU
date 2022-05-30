<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController as userController;
use App\Http\Controllers\AuthController as authController;

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

Route::post('/auth/login', [authController::class, 'login']);

Route::post('/auth/signup', [authController::class, 'signup']);

Route::resource('/user', 'UserController')->middleware(['auth:sanctum']);
