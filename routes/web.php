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
use App\Http\Controllers\Dashboard\JuraganGudang\JuraganGudangRegistController;
use App\Http\Controllers\Dashboard\ProfileCompany\ProfileCompanyAddressController;
use App\Http\Controllers\Dashboard\ProfileCompany\ProfileCompanyContactController;
use App\Http\Controllers\Dashboard\ProfileCompany\ProfileCompanyController;
use App\Http\Controllers\Dashboard\ProfileUserController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ViewController;
use App\Http\Helper\RouteName;
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
Route::resource('login', AuthUserController::class, RouteName::setName('login'));
Route::get('logout', [AuthUserController::class, 'logout'])->name('logout');
Route::resource('register', RegisterController::class, RouteName::setName('register'));
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
    Route::resource('/home', HomeController::class, RouteName::setName('home'));
    Route::group([
        'prefix' => 'juragan-barang',
        'as' => 'juragan-barang.',
    ], function () {
        Route::resource('/regist', JuraganBarangController::class, RouteName::setName('regist'));
        Route::resource('/list', JuraganBarangController::class, RouteName::setName('list'));
    });

    Route::group([
        'prefix' => 'juragan-gudang',
        'as' => 'juragan-gudang',
    ], function () {
        Route::resource('/juragan-gudang', JuraganGudangController::class, RouteName::setName(''));
        Route::resource('/regist', JuraganGudangRegistController::class, RouteName::setName('.regist'));
    });

    Route::group([
        'prefix' => 'juragan-angkutan',
        'as' => 'juragan-angkutan',
    ], function () {
        Route::resource('/', JuraganAngkutanController::class, RouteName::setName(''));
        Route::resource('/regist', JuraganAngkutanController::class, RouteName::setName('.regist'));
    });

    Route::group([
        'prefix' => 'juragan-alatberat',
        'as' => 'juragan-alatberat',
    ], function () {
        Route::resource('/', JuraganAlatBeratController::class, RouteName::setName(''));
        Route::resource('/regist', JuraganAlatBeratController::class, RouteName::setName('.regist'));
    });
    Route::resource('/profile-user', ProfileUserController::class, RouteName::setName('profile-user'));


    Route::resource('profile-company', ProfileCompanyController::class, RouteName::setName('profile-company'));
    Route::group([
        'prefix' => 'profile-company',
        'as' => 'profile-company',
    ], function () {
        Route::resource('/contact', ProfileCompanyContactController::class, RouteName::setName('.contact'));
        Route::resource('/address', ProfileCompanyAddressController::class, RouteName::setName('.address'));
    });
});


//// SECTION JURAGAN TANAH

Route::group([
    'prefix' => 'juragan_tanah',
    'as' => 'admin.',
], function () {
    Route::resource('login', AuthAdminController::class, RouteName::setName('login'));
    Route::get('logout', [AuthAdminController::class, 'logout'])->name('logout');
    // Route::resource('register', AdminRegisterController::class, RouteName::setName('register'));

    Route::group([
        'middleware' => ['auth:admin'],
    ], function () {
        Route::resource('/home', AdminHomeController::class, RouteName::setName('home'));
        Route::resource('/profile-user', AdminProfileUserController::class, RouteName::setName('profile-user'));
        Route::group([
            'prefix' => 'gudang',
            'as' => 'gudang.',
        ], function () {
            Route::resource('', GudangListController::class, RouteName::setName(''));
            Route::resource('regist', GudangRegistController::class, RouteName::setName('regist'));
        });
        Route::group([
            'prefix' => 'angkutan',
            'as' => 'angkutan.',
        ], function () {
            Route::resource('', AngkutanListController::class, RouteName::setName(''));
            Route::resource('regist', AngkutanRegistController::class, RouteName::setName('regist'));
        });
        Route::group([
            'prefix' => 'alat-berat',
            'as' => 'alat-berat',
        ], function () {
            Route::resource('/', AlatBeratListController::class, RouteName::setName(''));
            Route::resource('regist', AlatBeratRegistController::class, RouteName::setName('regist'));
        });
        // Route::any('/', function () {
        //     return redirect(route('d-home'));
        // });
        // Route::resource('/home', HomeController::class, RouteName::setName('home'));
        // Route::resource('/barang', JuraganBarangController::class, RouteName::setName('juragan-barang'));
        // Route::resource('/gudang', JuraganGudangController::class, RouteName::setName('juragan-gudang'));
        // Route::resource('/angkutan', JuraganAngkutanController::class, RouteName::setName('juragan-angkutan'));
        // Route::resource('/alatberat', JuraganAlatBeratController::class, RouteName::setName('juragan-alatberat'));
        // Route::resource('/profile', ProfileUserController::class, RouteName::setName('profile-user'));


        // Route::group([
        //     'prefix' => 'profile-company',
        //     'as' => 'profile-company.',
        // ], function () {
        //     Route::resource('/', ProfileCompanyContactController::class, RouteName::setName(''));
        //     Route::resource('/contact', ProfileCompanyContactController::class, RouteName::setName('contact'));
        //     Route::resource('/address', ProfileCompanyAddressController::class, RouteName::setName('address'));
        // });
    });
});
