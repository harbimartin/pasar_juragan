<?php

use App\Http\Controllers\Admin\AlatBerat\AlatBeratListController;
use App\Http\Controllers\Admin\AlatBerat\AlatBeratRegistController;
use App\Http\Controllers\Admin\Angkutan\AngkutanListController;
use App\Http\Controllers\Admin\Angkutan\AngkutanRegistController;
use App\Http\Controllers\Admin\Gudang\GudangListController;
use App\Http\Controllers\Admin\Gudang\GudangRegistController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\ProfileUserController as AdminProfileUserController;
use App\Http\Controllers\Auth\AuthAdminController;
use App\Http\Controllers\Auth\AuthUserController;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\JuraganAlatBeratController;
use App\Http\Controllers\Dashboard\JuraganAngkutanController;
use App\Http\Controllers\Dashboard\JuraganBarangController;
use App\Http\Controllers\Dashboard\JuraganGudang\JuraganGudangController;
use App\Http\Controllers\Dashboard\JuraganGudang\JuraganGudangListController;
use App\Http\Controllers\Dashboard\JuraganGudang\JuraganGudangRegistController;
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
    'middleware' => ['auth:user'],
    'prefix' => 'dashboard',
    'as' => 'dashboard.',
], function () {
    Route::any('/', function () {
        return redirect(route('d-home'));
    });
    Route::resource('/home', HomeController::class)->name('index', 'home');
    Route::group([
        'prefix' => 'juragan-barang',
        'as' => 'juragan-barang.',
    ], function () {
        Route::resource('/regist', JuraganBarangController::class)->name('index', 'regist');
        Route::resource('/list', JuraganBarangController::class)->name('index', 'list');
    });

    Route::group([
        'prefix' => 'juragan-gudang',
        'as' => 'juragan-gudang.',
    ], function () {
        Route::resource('/regist', JuraganGudangRegistController::class)->name('index', 'regist');
        Route::resource('/list', JuraganGudangListController::class)->name('index', 'list');
    });
    Route::resource('/juragan-gudang', JuraganGudangController::class)->name('index', 'juragan-gudang');

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


//// SECTION JURAGAN TANAH

Route::group([
    'prefix' => 'juragan_tanah',
    'as' => 'admin.',
], function () {
    Route::resource('login', AuthAdminController::class)->name('index', 'login');
    Route::get('logout', [AuthAdminController::class, 'logout'])->name('logout');
    // Route::resource('register', AdminRegisterController::class)->name('index', 'register');

    Route::group([
        'middleware' => ['auth:admin'],
    ], function () {
        Route::resource('/home', AdminHomeController::class)->name('index', 'home');
        Route::resource('/profile', AdminProfileUserController::class)->name('index', 'user-profile');
        Route::group([
            'prefix' => 'gudang',
            'as' => 'gudang.',
        ], function () {
            Route::resource('regist', GudangRegistController::class)->name('index', 'regist');
            Route::resource('list', GudangListController::class)->name('index', 'list');
        });
        Route::group([
            'prefix' => 'angkutan',
            'as' => 'angkutan.',
        ], function () {
            Route::resource('list', AngkutanListController::class)->name('index', 'list');
            Route::resource('regist', AngkutanRegistController::class)->name('index', 'regist');
        });
        Route::group([
            'prefix' => 'alat-berat',
            'as' => 'alat-berat.',
        ], function () {
            Route::resource('list', AlatBeratListController::class)->name('index', 'list');
            Route::resource('regist', AlatBeratRegistController::class)->name('index', 'regist');
        });
        // Route::any('/', function () {
        //     return redirect(route('d-home'));
        // });
        // Route::resource('/home', HomeController::class)->name('index', 'home');
        // Route::resource('/barang', JuraganBarangController::class)->name('index', 'juragan-barang');
        // Route::resource('/gudang', JuraganGudangController::class)->name('index', 'juragan-gudang');
        // Route::resource('/angkutan', JuraganAngkutanController::class)->name('index', 'juragan-angkutan');
        // Route::resource('/alatberat', JuraganAlatBeratController::class)->name('index', 'juragan-alatberat');
        // Route::resource('/profile', ProfileUserController::class)->name('index', 'user-profile');


        // Route::group([
        //     'prefix' => 'company-profile',
        //     'as' => 'company-profile.',
        // ], function () {
        //     Route::resource('/', ProfileCompanyContactController::class)->name('index', '');
        //     Route::resource('/contact', ProfileCompanyContactController::class)->name('index', 'contact');
        //     Route::resource('/address', ProfileCompanyAddressController::class)->name('index', 'address');
        // });
    });
});
