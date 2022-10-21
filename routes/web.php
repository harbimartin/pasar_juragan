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
use App\Http\Controllers\Dashboard\JuraganAlatBerat\JuraganAlatBeratController;
use App\Http\Controllers\Dashboard\JuraganAlatBerat\JuraganAlatBeratRegistController;
use App\Http\Controllers\Dashboard\JuraganAngkutan\JuraganAngkutanRegistController;
use App\Http\Controllers\Dashboard\JuraganBarangController;
use App\Http\Controllers\Dashboard\JuraganGudang\JuraganGudangAddressController;
use App\Http\Controllers\Dashboard\JuraganGudang\JuraganGudangContactController;
use App\Http\Controllers\Dashboard\JuraganGudang\JuraganGudangController;
use App\Http\Controllers\Dashboard\JuraganGudang\JuraganGudangDocumentController;
use App\Http\Controllers\Dashboard\JuraganGudang\JuraganGudangRegistController;
use App\Http\Controllers\Dashboard\JuraganGudang\JuraganGudangServiceController;
use App\Http\Controllers\Dashboard\ProfileCompany\ProfileCompanyAddressController;
use App\Http\Controllers\Dashboard\ProfileCompany\ProfileCompanyContactController;
use App\Http\Controllers\Dashboard\ProfileCompany\ProfileCompanyController;
use App\Http\Controllers\Dashboard\ProfileUserController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ViewController;
use App\Http\Helper\Routing;
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
Route::resource('login', AuthUserController::class, Routing::setName('login'));
Route::get('logout', [AuthUserController::class, 'logout'])->name('logout');
Route::resource('register', RegisterController::class, Routing::setName('register'));
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
    Route::resource('/home', HomeController::class, Routing::setName('home'));
    Route::resource('/profile-user', ProfileUserController::class, Routing::setName('profile-user'));

    Route::group([
        'prefix' => 'juragan-barang',
        'as' => 'juragan-barang',
    ], function () {
        Route::resource('/regist', JuraganGudangRegistController::class, Routing::setName('.regist'));
        Route::resource('/address', JuraganBarangAddressController::class, Routing::setName('.address'));
    });
    Route::resource('/juragan-barang', JuraganBarangController::class, Routing::setName('juragan-barang'));

    Route::group([
        'prefix' => 'juragan-gudang/{gudang}',
        'as' => 'juragan-gudang',
    ], function () {
        // Route::resource('/regist', JuraganGudangRegistController::class, Routing::setName('.regist'));
        Route::resource('/contact', JuraganGudangContactController::class, Routing::setName('.contact'));
        Route::resource('/address', JuraganGudangAddressController::class, Routing::setName('.address'));
        Route::resource('/document', JuraganGudangDocumentController::class, Routing::setName('.document'));
        Route::resource('/service', JuraganGudangServiceController::class, Routing::setName('.service'));
    });
    Route::resource('/juragan-gudang/regist', JuraganGudangRegistController::class, Routing::setName('juragan-gudang.regist'));
    Route::resource('/juragan-gudang', JuraganGudangController::class, Routing::setName('juragan-gudang'));

    Route::group([
        'prefix' => 'juragan-angkutan',
        'as' => 'juragan-angkutan',
    ], function () {
        Route::resource('/regist', JuraganAngkutanRegistController::class, Routing::setName('.regist'));
    });
    Route::resource('/juragan-angkutan', JuraganAlatBeratController::class, Routing::setName('juragan-angkutan'));

    Route::group([
        'prefix' => 'juragan-alatberat',
        'as' => 'juragan-alatberat',
    ], function () {
        Route::resource('/regist', JuraganAlatBeratRegistController::class, Routing::setName('.regist'));
    });
    Route::resource('/juragan-alatberat', JuraganAlatBeratController::class, Routing::setName('juragan-alatberat'));

    Route::group([
        'prefix' => 'profile-company',
        'as' => 'profile-company',
    ], function () {
        Route::resource('/contact', ProfileCompanyContactController::class, Routing::setName('.contact'));
        Route::resource('/address', ProfileCompanyAddressController::class, Routing::setName('.address'));
    });
    Route::resource('profile-company', ProfileCompanyController::class, Routing::setName('profile-company'));
});


//// SECTION JURAGAN TANAH

Route::group([
    'prefix' => 'juragan-tanah',
    'as' => 'admin.',
], function () {
    Route::resource('login', AuthAdminController::class, Routing::setName('login'));
    Route::get('logout', [AuthAdminController::class, 'logout'])->name('logout');
    // Route::resource('register', AdminRegisterController::class, Routing::setName('register'));

    Route::group([
        'middleware' => ['auth:admin'],
    ], function () {
        Route::resource('/home', AdminHomeController::class, Routing::setName('home'));
        Route::resource('/profile-user', AdminProfileUserController::class, Routing::setName('profile-user'));
        Route::group([
            'prefix' => 'gudang',
            'as' => 'gudang.',
        ], function () {
            Route::resource('', GudangListController::class, Routing::setName(''));
            Route::resource('regist', GudangRegistController::class, Routing::setName('regist'));
        });
        Route::group([
            'prefix' => 'angkutan',
            'as' => 'angkutan.',
        ], function () {
            Route::resource('', AngkutanListController::class, Routing::setName(''));
            Route::resource('regist', AngkutanRegistController::class, Routing::setName('regist'));
        });
        Route::group([
            'prefix' => 'alat-berat',
            'as' => 'alat-berat',
        ], function () {
            Route::resource('/', AlatBeratListController::class, Routing::setName(''));
            Route::resource('regist', AlatBeratRegistController::class, Routing::setName('regist'));
        });
        // Route::any('/', function () {
        //     return redirect(route('d-home'));
        // });
        // Route::resource('/home', HomeController::class, Routing::setName('home'));
        // Route::resource('/barang', JuraganBarangController::class, Routing::setName('juragan-barang'));
        // Route::resource('/gudang', JuraganGudangController::class, Routing::setName('juragan-gudang'));
        // Route::resource('/angkutan', JuraganAngkutanController::class, Routing::setName('juragan-angkutan'));
        // Route::resource('/alatberat', JuraganAlatBeratController::class, Routing::setName('juragan-alatberat'));
        // Route::resource('/profile', ProfileUserController::class, Routing::setName('profile-user'));


        // Route::group([
        //     'prefix' => 'profile-company',
        //     'as' => 'profile-company.',
        // ], function () {
        //     Route::resource('/', ProfileCompanyContactController::class, Routing::setName(''));
        //     Route::resource('/contact', ProfileCompanyContactController::class, Routing::setName('contact'));
        //     Route::resource('/address', ProfileCompanyAddressController::class, Routing::setName('address'));
        // });
    });
});
