<?php

use App\Http\Controllers\Auth\AuthUserController;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\JuraganAlatBeratController;
use App\Http\Controllers\Dashboard\JuraganAngkutanController;
use App\Http\Controllers\Dashboard\JuraganBarangController;
use App\Http\Controllers\Dashboard\JuraganGudangController;
use App\Http\Controllers\Dashboard\ProfileCompany\ProfileCompanyAddressController;
use App\Http\Controllers\Dashboard\ProfileCompany\ProfileCompanyContactController;
use App\Http\Controllers\Dashboard\ProfileUserController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ViewController;
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
Route::resource('login', AuthUserController::class)->name('index', 'login');
Route::get('logout', [AuthUserController::class, 'logout'])->name('logout');
Route::resource('register', RegisterController::class)->name('index', 'register');
Route::get('aktivasi/email', [AuthUserController::class, 'activation']);
Route::any('/home', function () {
    return view('landpage.home');
})->name('home');

Route::get('/get-storage/{module}', [ViewController::class, 'get_file'])->name('storage');

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


    Route::group([
        'prefix' => 'company-profile',
        'as' => 'company-profile.',
    ], function () {
        Route::resource('/', ProfileCompanyContactController::class)->name('index', '');
        Route::resource('/contact', ProfileCompanyContactController::class)->name('index', 'contact');
        Route::resource('/address', ProfileCompanyAddressController::class)->name('index', 'address');
    });
});
