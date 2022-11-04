<?php

use App\Http\Controllers\API\FileApiController;
use App\Http\Controllers\API\utils\UtilsApiController;
use App\Http\Controllers\Auth\AuthApiController;
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

Route::post('v1/auth/login', [AuthApiController::class, "api_login"]);
Route::group(['middleware' => 'jwt.auth'], function () {
    Route::get('v1/auth/logout', [AuthApiController::class, "api_logout"]);
    Route::get('v1/auth/me', [AuthApiController::class, "api_me"]);
});

Route::post('v1/util/province', [UtilsApiController::class, 'store_province']);
Route::post('v1/util/city', [UtilsApiController::class, 'store_city']);

Route::post('v1/download', [FileApiController::class, 'download']);
