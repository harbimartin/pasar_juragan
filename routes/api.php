<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\auth\AuthApiController;
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
