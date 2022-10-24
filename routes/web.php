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
use App\Http\Controllers\User\Dashboard\HomeController;
use App\Http\Controllers\User\Dashboard\Juragan\Provider\ProviderAddressController;
use App\Http\Controllers\User\Dashboard\Juragan\Provider\ProviderContactController;
use App\Http\Controllers\User\Dashboard\Juragan\Provider\ProviderDocumentController;
use App\Http\Controllers\User\Dashboard\Juragan\Provider\ProviderServiceController;
use App\Http\Controllers\User\Dashboard\Juragan\JuraganAlatBeratController;
use App\Http\Controllers\User\Dashboard\Juragan\JuraganAngkutanController;
use App\Http\Controllers\User\Dashboard\Juragan\JuraganGudangController;
use App\Http\Controllers\User\Dashboard\ProfileCompany\ProfileCompanyAddressController;
use App\Http\Controllers\User\Dashboard\ProfileCompany\ProfileCompanyContactController;
use App\Http\Controllers\User\Dashboard\ProfileCompany\ProfileCompanyController;
use App\Http\Controllers\User\Dashboard\ProfileUserController;
use App\Http\Controllers\User\Dashboard\Warehouse\WarehouseController;
use App\Http\Controllers\User\RegisterController;
use App\Http\Controllers\User\ViewController;
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

Route::get('/get-storage/{module}/{filename}/{id}', [ViewController::class, 'get_file'])->name('storage');

Route::group([
    'middleware' => ['auth:user'],
    'prefix' => 'dashboard',
    'as' => 'dashboard.',
], function () {
    Route::any('/', function () {
        return redirect(route('d-home'));
    });
    Route::resource('/home', HomeController::class, Routing::setName('home'))->only('index');
    Route::resource('/profile-user', ProfileUserController::class, Routing::setName('profile-user'))->only('index', 'store', 'update');

    foreach (['barang', 'gudang', 'angkutan', 'alatberat'] as $provider) {
        Route::group([
            'prefix' => 'juragan-' . $provider . '/{provider}',
            'as' => 'juragan-' . $provider . '.',
        ], function () {
            Route::resource('/contact', ProviderContactController::class, Routing::setName('contact'))->except('create', 'show', 'destroy');
            Route::resource('/address', ProviderAddressController::class, Routing::setName('address'))->except('create', 'show', 'destroy');
            Route::resource('/document', ProviderDocumentController::class, Routing::setName('document'))->except('create', 'show', 'destroy');
            Route::resource('/service', ProviderServiceController::class, Routing::setName('service'))->except('create', 'show', 'destroy');
        });
    }
    Route::resource('/juragan-gudang', JuraganGudangController::class, Routing::setName('juragan-gudang'))->except('edit', 'destroy');
    Route::resource('/juragan-angkutan', JuraganAngkutanController::class, Routing::setName('juragan-angkutan'))->except('edit', 'destroy');
    Route::resource('/juragan-alatberat', JuraganAlatBeratController::class, Routing::setName('juragan-alatberat'))->except('edit', 'destroy');

    // Route::group([
    //     'prefix' => 'warehouse',
    //     'as' => 'warehouse.',
    // ], function () {
    //     Route::resource('/add', WarehouseAddController::class, Routing::setName('add'));
    // });
    Route::resource('/warehouse', WarehouseController::class, Routing::setName('warehouse'));

    Route::group([
        'prefix' => 'profile-company',
        'as' => 'profile-company.',
    ], function () {
        Route::resource('/contact', ProfileCompanyContactController::class, Routing::setName('contact'))->except('show', 'create', 'destroy');
        Route::resource('/address', ProfileCompanyAddressController::class, Routing::setName('address'))->except('show', 'create', 'destroy');
    });
    Route::resource('profile-company', ProfileCompanyController::class, Routing::setName('profile-company'))->only('index', 'update');
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
            Route::resource('list', GudangListController::class, Routing::setName('list'));
            Route::resource('regist', GudangRegistController::class, Routing::setName('regist'));
        });
        Route::group([
            'prefix' => 'angkutan',
            'as' => 'angkutan.',
        ], function () {
            Route::resource('list', AngkutanListController::class, Routing::setName('list'));
            Route::resource('regist', AngkutanRegistController::class, Routing::setName('regist'));
        });
        Route::group([
            'prefix' => 'alat-berat',
            'as' => 'alat-berat.',
        ], function () {
            Route::resource('list', AlatBeratListController::class, Routing::setName('list'));
            Route::resource('regist', AlatBeratRegistController::class, Routing::setName('regist'));
        });
    });
});
