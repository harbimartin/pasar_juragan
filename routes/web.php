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
use App\Http\Controllers\User\Dashboard\Driver\DriverController;
use App\Http\Controllers\User\Dashboard\Heavy\HeavyController;
use App\Http\Controllers\User\Dashboard\Home\HomeHeavyController;
use App\Http\Controllers\User\Dashboard\Home\HomeTransportController;
use App\Http\Controllers\User\Dashboard\Home\HomeWarehouseController;
use App\Http\Controllers\User\Dashboard\Home\Juragan\HomeJuraganAlatBeratController;
use App\Http\Controllers\User\Dashboard\Home\Juragan\HomeJuraganAngkutanController;
use App\Http\Controllers\User\Dashboard\Home\Juragan\HomeJuraganGudangController;
use App\Http\Controllers\User\Dashboard\HomeController;
use App\Http\Controllers\User\Dashboard\Juragan\Provider\ProviderAddressController;
use App\Http\Controllers\User\Dashboard\Juragan\Provider\ProviderContactController;
use App\Http\Controllers\User\Dashboard\Juragan\Provider\ProviderDocumentController;
use App\Http\Controllers\User\Dashboard\Juragan\Provider\ProviderServiceController;
use App\Http\Controllers\User\Dashboard\Juragan\JuraganAlatBeratController;
use App\Http\Controllers\User\Dashboard\Juragan\JuraganAngkutanController;
use App\Http\Controllers\User\Dashboard\Juragan\JuraganGudangController;
use App\Http\Controllers\User\Dashboard\Juragan\Provider\ProviderHeavyController;
use App\Http\Controllers\User\Dashboard\Juragan\Provider\ProviderTransportController;
use App\Http\Controllers\User\Dashboard\Juragan\Provider\ProviderWarehouseController;
use App\Http\Controllers\User\Dashboard\JuraganBarangController;
use App\Http\Controllers\User\Dashboard\KontrakBarangApprovalController;
use App\Http\Controllers\User\Dashboard\KontrakBarangController;
use App\Http\Controllers\User\Dashboard\KontrakBarangDetailController;
use App\Http\Controllers\User\Dashboard\PesananAngkutanApprovalController;
use App\Http\Controllers\User\Dashboard\PesananAngkutanController;
use App\Http\Controllers\User\Dashboard\PesananAngkutanDetailController;
use App\Http\Controllers\User\Dashboard\ProfileCompany\ProfileCompanyAddressController;
use App\Http\Controllers\User\Dashboard\ProfileCompany\ProfileCompanyContactController;
use App\Http\Controllers\User\Dashboard\ProfileCompany\ProfileCompanyController;
use App\Http\Controllers\User\Dashboard\ProfileUserController;
use App\Http\Controllers\User\Dashboard\Transport\TransportController;
use App\Http\Controllers\User\Dashboard\Transport\TransportPesananController;
use App\Http\Controllers\User\Dashboard\Transport\TransportPesananDetailController;
use App\Http\Controllers\User\Dashboard\Transport\TransportPesananVoucherController;
use App\Http\Controllers\User\Dashboard\Transport\TransportPesananVoucherDetailController;
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
    Route::group([
        'prefix' => 'home',
        'as' => 'home.',
    ], function () {
        Route::resource('/warehouse', HomeWarehouseController::class, Routing::setName('warehouse'))->only('index', 'show');
        Route::resource('/transport', HomeTransportController::class, Routing::setName('transport'))->only('index', 'show');
        Route::resource('/heavy', HomeHeavyController::class, Routing::setName('heavy'))->only('index', 'show');
        // Angkutan & Alat Berat tambahkan isi disini

        foreach (['barang', 'gudang', 'angkutan', 'alatberat'] as $provider) {
            Route::group([
                'prefix' => 'juragan-' . $provider . '/{provider}',
                'as' => 'juragan-' . $provider . '.',
            ], function () {
                Route::resource('/contact', ProviderContactController::class, Routing::setName('contact'))->except('create', 'destroy');
                Route::resource('/address', ProviderAddressController::class, Routing::setName('address'))->except('create', 'destroy');
                Route::resource('/document', ProviderDocumentController::class, Routing::setName('document'))->except('create', 'destroy');
                Route::resource('/service', ProviderServiceController::class, Routing::setName('service'))->except('create', 'destroy');
                Route::resource('/warehouse', ProviderWarehouseController::class, Routing::setName('warehouse'))->except('create', 'destroy');
                Route::resource('/transport', ProviderTransportController::class, Routing::setName('transport'))->except('create', 'destroy');
                Route::resource('/heavy', ProviderHeavyController::class, Routing::setName('heavy'))->except('create', 'destroy');
            });
        }
        Route::resource('/juragan-gudang', HomeJuraganGudangController::class, Routing::setName('juragan-gudang'))->only('show');
        Route::resource('/juragan-angkutan', HomeJuraganAngkutanController::class, Routing::setName('juragan-angkutan'))->only('show');
        Route::resource('/juragan-alatberat', HomeJuraganAlatBeratController::class, Routing::setName('juragan-alatberat'))->only('show');
    });
    Route::resource('/home', HomeController::class, Routing::setName('home'))->only('index');

    Route::resource('/profile-user', ProfileUserController::class, Routing::setName('profile-user'))->only('index', 'store', 'update');

    foreach (['barang', 'gudang', 'angkutan', 'alatberat'] as $provider) {
        Route::group([
            'prefix' => 'juragan-' . $provider . '/{provider}',
            'as' => 'juragan-' . $provider . '.',
        ], function () {
            Route::resource('/contact', ProviderContactController::class, Routing::setName('contact'))->except('create', 'destroy');
            Route::resource('/address', ProviderAddressController::class, Routing::setName('address'))->except('create', 'destroy');
            Route::resource('/document', ProviderDocumentController::class, Routing::setName('document'))->except('create', 'destroy');
            Route::resource('/service', ProviderServiceController::class, Routing::setName('service'))->except('create', 'destroy');
            Route::resource('/warehouse', ProviderWarehouseController::class, Routing::setName('warehouse'))->except('create', 'destroy');
            Route::resource('/transport', ProviderTransportController::class, Routing::setName('transport'))->except('create', 'destroy');
            Route::resource('/heavy', ProviderHeavyController::class, Routing::setName('heavy'))->except('create', 'destroy');
        });
    }
    Route::resource('/juragan-barang', JuraganBarangController::class, Routing::setName('juragan-barang'))->except('edit', 'destroy');
    Route::resource('/juragan-gudang', JuraganGudangController::class, Routing::setName('juragan-gudang'))->except('edit', 'destroy');
    Route::resource('/juragan-angkutan', JuraganAngkutanController::class, Routing::setName('juragan-angkutan'))->except('edit', 'destroy');
    Route::resource('/juragan-alatberat', JuraganAlatBeratController::class, Routing::setName('juragan-alatberat'))->except('edit', 'destroy');

    Route::group([
        'prefix' => 'kontrak-barang/{provider}',
        'as' => 'kontrak-barang.',
    ], function () {
        Route::resource('/detail', KontrakBarangDetailController::class, Routing::setName('detail'))->except('create', 'destroy');
    });
    Route::resource('/kontrak-barang', KontrakBarangController::class, Routing::setName('kontrak-barang'))->except('destroy');

    Route::group([
        'prefix' => 'pesanan/juragan-angkutan/{order}',
        'as' => 'pesanan.juragan-angkutan.',
    ], function () {
        Route::resource('/voucher', TransportPesananVoucherController::class, Routing::setName('voucher'))->except('destroy');
        Route::resource('/detail', TransportPesananDetailController::class, Routing::setName('detail'))->except('destroy');
        Route::group([
            'prefix' => 'voucher-detail/{voucher}',
            'as' => ''
        ], function () {
            Route::resource('/detail', TransportPesananVoucherDetailController::class, Routing::setName('voucher-detail'));
        });
    });
    Route::resource('/pesanan/juragan-angkutan', TransportPesananController::class, Routing::setName('pesanan.juragan-angkutan'))->except('destroy');

    // Route::group([
    //     'prefix' => 'warehouse',
    //     'as' => 'warehouse.',
    // ], function () {
    //     Route::resource('/add', WarehouseAddController::class, Routing::setName('add'));
    // });
    Route::resource('/warehouse', WarehouseController::class, Routing::setName('warehouse'));
    Route::resource('/driver', DriverController::class, Routing::setName('driver'));
    Route::resource('/transport', TransportController::class, Routing::setName('transport'));
    Route::resource('/heavy', HeavyController::class, Routing::setName('heavy'));

    Route::group([
        'prefix' => 'profile-company',
        'as' => 'profile-company.',
    ], function () {
        Route::resource('/contact', ProfileCompanyContactController::class, Routing::setName('contact'))->except('show', 'create', 'destroy');
        Route::resource('/address', ProfileCompanyAddressController::class, Routing::setName('address'))->except('show', 'create', 'destroy');
    });
    Route::resource('profile-company', ProfileCompanyController::class, Routing::setName('profile-company'))->only('index', 'update');

    Route::resource('approval/item-contract', KontrakBarangApprovalController::class, Routing::setName('approval.item.contract'))->only('index', 'show', 'update');
    Route::resource('approval/transport-order', PesananAngkutanApprovalController::class, Routing::setName('approval.transport.order'))->only('index', 'show', 'update');

    Route::group([
        'prefix' => 'pesanan-angkutan/{order}',
        'as' => 'pesanan-angkutan.',
    ], function () {
        Route::resource('/detail', PesananAngkutanDetailController::class, Routing::setName('detail'))->except('create');
    });
    Route::resource('/pesanan-angkutan', PesananAngkutanController::class, Routing::setName('pesanan-angkutan'))->except('destroy');
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
