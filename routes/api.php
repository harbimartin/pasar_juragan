<?php

use App\Http\Controllers\AuthController;
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

Route::post('v1/auth/login', [AuthController::class, "api_login"]);
Route::group(['middleware' => 'jwt.auth'], function () {
    Route::get('v1/auth/logout',[AuthController::class, "api_logout"]);
    Route::get('v1/auth/me',[AuthController::class, "api_me"]);
});