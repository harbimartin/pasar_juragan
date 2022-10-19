<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\JuraganAlatBeratController;
use App\Http\Controllers\Dashboard\JuraganAngkutanController;
use App\Http\Controllers\Dashboard\JuraganBarangController;
use App\Http\Controllers\Dashboard\JuraganGudangController;
use App\Http\Controllers\Dashboard\ProfileCompanyController;
use App\Http\Controllers\Dashboard\ProfileUserController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect(route('home'));
});
Route::resource('login', AuthController::class)->name('index', 'login');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::resource('register', RegisterController::class)->name('index', 'register');
Route::get('aktivasi/email', [AuthController::class, 'activation']);
Route::any('/home', function () {
    return view('landpage.home');
})->name('home');

Route::group([
    'middleware' => 'auth',
    'prefix' => 'dashboard',
    'as' => 'dashboard.',
], function () {
    Route::any('/', function () {
        return redirect(route('d-home'));
    });
    Route::resource('/home', HomeController::class)->name('index', 'home');
    Route::resource('/barang', JuraganBarangController::class)->name('index', 'juragan-barang');
    Route::resource('/gudang', JuraganGudangController::class)->name('index', 'juragan-gudang');
    Route::resource('/angkutan', JuraganAngkutanController::class)->name('index', 'juragan-angkutan');
    Route::resource('/alatberat', JuraganAlatBeratController::class)->name('index', 'juragan-alatberat');
    Route::resource('/profile', ProfileUserController::class)->name('index', 'user-profile');
    Route::resource('/company-profile', ProfileCompanyController::class)->name('index', 'company-profile');
});
