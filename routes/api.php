<?php

use App\Http\Controllers\API\ApiOrderController;
use App\Http\Controllers\API\FileApiController;
use App\Http\Controllers\API\utils\UtilsApiController;
use App\Http\Controllers\Auth\AuthApiController;
use App\Http\Controllers\Auth\AuthDriverController;
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
Route::get('test', function(){
    return dd("hallo");
});
Route::post('v1/auth/user/login', [AuthApiController::class, "api_login"]);
Route::post('v1/auth/driver/login', [AuthDriverController::class, "api_login"]);


Route::group(['middleware' => ['assign.guard:api','jwt.auth']], function () {
    Route::get('v1/auth/logout', [AuthApiController::class, "api_logout"]);
    Route::get('v1/auth/me', [AuthApiController::class, "api_me"]);
});

Route::group(['middleware' => ['assign.guard:driver','jwt.auth']], function () {
    Route::get('v1/auth/driver/logout', [AuthDriverController::class, "api_logout"]);
    Route::get('v1/auth/driver/me', [AuthDriverController::class, "api_me"]);

    Route::post('driver/show', [ApiOrderController::class, "show"]);
    Route::post('driver/store', [ApiOrderController::class, "store"]);
    Route::post('driver/updateStatus', [ApiOrderController::class, "updateStatus"]);
    Route::post('driver/upload', [ApiOrderController::class, "upload"]);
});

Route::get('status/store', [ApiOrderController::class, "indexStatus"]);
// // Route::group(['middleware' => 'driver'], function () {
// //     Route::post('v1/driver/auth/login', [AuthDriverController::class, "api_login"]);

// //     // Route::group(['middleware' => 'jwt.auth'], function () {
// //         Route::get('v1/driver/auth/logout', [AuthDriverController::class, "api_logout"]);
// //         Route::get('v1/driver/auth/me', [AuthDriverController::class, "api_me"]);
// //     // });
// // });

// Route::post('v1/util/province', [UtilsApiController::class, 'store_province']);
// Route::post('v1/util/city', [UtilsApiController::class, 'store_city']);

// Route::post('v1/download', [FileApiController::class, 'download']);
