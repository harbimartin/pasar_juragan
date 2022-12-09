<?php

use App\Http\Controllers\Admin\AlatBerat\AlatBeratListController;
use App\Http\Controllers\Admin\AlatBerat\AlatBeratRegistController;
use App\Http\Controllers\Admin\Angkutan\AngkutanListController;
use App\Http\Controllers\Admin\Angkutan\AngkutanRegistController;
use App\Http\Controllers\Admin\Gudang\GudangListController;
use App\Http\Controllers\Admin\Gudang\GudangRegistController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\MasterData\BusinessCategoryController;
use App\Http\Controllers\Admin\MasterData\CityController;
use App\Http\Controllers\Admin\MasterData\ContactTypeController;
use App\Http\Controllers\Admin\MasterData\DestinationController;
use App\Http\Controllers\Admin\MasterData\DocController;
use App\Http\Controllers\Admin\MasterData\HeavyTypeController;
use App\Http\Controllers\Admin\MasterData\OriginController;
use App\Http\Controllers\Admin\MasterData\ProvinceController;
use App\Http\Controllers\Admin\MasterData\TruckTypeController;
use App\Http\Controllers\Admin\MasterData\WarehouseCategoryController;
use App\Http\Controllers\Admin\MasterData\WarehouseFunctionController;
use App\Http\Controllers\Admin\MasterData\WarehouseStorageController;
use App\Http\Controllers\Admin\ProfileUserController as AdminProfileUserController;
use App\Http\Controllers\Auth\AuthAdminController;
use App\Http\Controllers\Auth\AuthUserController;
use App\Http\Controllers\User\Dashboard\Driver\DriverController;
use App\Http\Controllers\User\Dashboard\Heavy\HeavyEquipmentPesananController;
use App\Http\Controllers\User\Dashboard\Heavy\HeavyEquipmentPesananDetailController;
use App\Http\Controllers\User\Dashboard\Heavy\KontrakHeavyEquipmentApprovalController;
use App\Http\Controllers\User\Dashboard\Heavy\KontrakHeavyEquipmentController;
use App\Http\Controllers\User\Dashboard\Heavy\KontrakHeavyEquipmentDetailController;
use App\Http\Controllers\User\Dashboard\Heavy\PesananHeavyEquipmentApprovalController;
use App\Http\Controllers\User\Dashboard\Heavy\PesananHeavyEquipmentController;
use App\Http\Controllers\User\Dashboard\Heavy\PesananHeavyEquipmentDetailController;
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
use App\Http\Controllers\User\Dashboard\PesananAngkutanMonitoringController;
use App\Http\Controllers\User\Dashboard\PesananAngkutanMonitoringDetailController;
use App\Http\Controllers\User\Dashboard\Warehouse\PesananWarehouseController;
use App\Http\Controllers\User\Dashboard\ProfileCompany\ProfileCompanyAddressController;
use App\Http\Controllers\User\Dashboard\ProfileCompany\ProfileCompanyContactController;
use App\Http\Controllers\User\Dashboard\ProfileCompany\ProfileCompanyController;
use App\Http\Controllers\User\Dashboard\ProfileUserController;
use App\Http\Controllers\User\Dashboard\Transport\TransportController;
use App\Http\Controllers\User\Dashboard\Transport\TransportPesananController;
use App\Http\Controllers\User\Dashboard\Transport\TransportPesananDetailController;
use App\Http\Controllers\User\Dashboard\Transport\TransportPesananVoucherController;
use App\Http\Controllers\User\Dashboard\Transport\TransportPesananVoucherDetailController;
use App\Http\Controllers\User\Dashboard\Warehouse\KontrakWarehouseApprovalController;
use App\Http\Controllers\User\Dashboard\Warehouse\KontrakWarehouseController;
use App\Http\Controllers\User\Dashboard\Warehouse\KontrakWarehouseDetailController;
use App\Http\Controllers\User\Dashboard\Warehouse\PesananWarehouseApprovalController;
use App\Http\Controllers\User\Dashboard\Warehouse\PesananWarehouseDetailController;
use App\Http\Controllers\User\Dashboard\Warehouse\WarehouseController;
use App\Http\Controllers\User\Dashboard\Warehouse\WarehousePesananController;
use App\Http\Controllers\User\Dashboard\Warehouse\WarehousePesananDetailController;
use App\Http\Controllers\User\RegisterController;
use App\Http\Controllers\User\ViewController;
use App\Http\Helper\Routing;
use App\Models\BusinessCategory;
use App\Models\ContactType;
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

Route::get('/', [ViewController::class, 'base'])->name('base');
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
        Route::group([
            'prefix' => 'monitoring/{voucher}',
            'as' => 'detail.'
        ], function () {
            Route::resource('/detail', PesananAngkutanMonitoringController::class, Routing::setName('monitoring'))->except('create');
            Route::group([
                'prefix' => 'detail/{detail}',
                'as' => 'monitoring.'
            ], function () {
                Route::resource('/truck', PesananAngkutanMonitoringDetailController::class, Routing::setName('truck'))->except('create');
            });
        });
    });
    Route::resource('/pesanan/juragan-angkutan', TransportPesananController::class, Routing::setName('pesanan.juragan-angkutan'))->except('destroy');

    Route::group([
        'prefix' => 'kontrak-gudang/{provider}',
        'as' => 'kontrak-gudang.',
    ], function () {
        Route::resource('/detail', KontrakWarehouseDetailController::class, Routing::setName('detail'))->except('create', 'destroy');
    });
    Route::resource('/kontrak-gudang', KontrakWarehouseController::class, Routing::setName('kontrak-gudang'))->except('destroy');

    Route::group([
        'prefix' => 'pesanan-gudang/{order}',
        'as' => 'pesanan-gudang.',
    ], function () {
        // Route::resource('/voucher', WarehousePesananVoucherController::class, Routing::setName('voucher'))->except('destroy');
        Route::resource('/detail', PesananWarehouseDetailController::class, Routing::setName('detail'));
    });
    Route::resource('/pesanan-gudang', PesananWarehouseController::class, Routing::setName('pesanan-gudang'))->except('destroy');
    Route::group([
        'prefix' => 'pesanan/juragan-gudang/{order}',
        'as' => 'pesanan.juragan-gudang.',
    ], function () {
        Route::resource('/detail', WarehousePesananDetailController::class, Routing::setName('detail'))->except('destroy');
    });
    Route::resource('/pesanan/juragan-gudang', WarehousePesananController::class, Routing::setName('pesanan.juragan-gudang'))->except('destroy');


    Route::group([
        'prefix' => 'kontrak-alatberat/{provider}',
        'as' => 'kontrak-alatberat.',
    ], function () {
        Route::resource('/detail', KontrakHeavyEquipmentDetailController::class, Routing::setName('detail'))->except('create', 'destroy');
    });
    Route::resource('/kontrak-alatberat', KontrakHeavyEquipmentController::class, Routing::setName('kontrak-alatberat'))->except('destroy');

    Route::group([
        'prefix' => 'pesanan-alatberat/{order}',
        'as' => 'pesanan-alatberat.',
    ], function () {
        // Route::resource('/voucher', HeavyEquipmentPesananVoucherController::class, Routing::setName('voucher'))->except('destroy');
        Route::resource('/detail', PesananHeavyEquipmentDetailController::class, Routing::setName('detail'));
    });
    Route::resource('/pesanan-alatberat', PesananHeavyEquipmentController::class, Routing::setName('pesanan-alatberat'))->except('destroy');
    Route::group([
        'prefix' => 'pesanan/juragan-alatberat/{order}',
        'as' => 'pesanan.juragan-alatberat.',
    ], function () {
        Route::resource('/detail', HeavyEquipmentPesananDetailController::class, Routing::setName('detail'))->except('destroy');
    });
    Route::resource('/pesanan/juragan-alatberat', HeavyEquipmentPesananController::class, Routing::setName('pesanan.juragan-alatberat'))->except('destroy');

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

    Route::resource('approval/warehouse-contract', KontrakWarehouseApprovalController::class, Routing::setName('approval.warehouse.contract'))->only('index', 'show', 'update');
    Route::resource('approval/item-contract', KontrakBarangApprovalController::class, Routing::setName('approval.item.contract'))->only('index', 'show', 'update');
    Route::resource('approval/heavy-equipment-contract', KontrakHeavyEquipmentApprovalController::class, Routing::setName('approval.heavy.contract'))->only('index', 'show', 'update');
    Route::resource('approval/transport-order', PesananAngkutanApprovalController::class, Routing::setName('approval.transport.order'))->only('index', 'show', 'update');
    Route::resource('approval/warehouse-order', PesananWarehouseApprovalController::class, Routing::setName('approval.warehouse.order'))->only('index', 'show', 'update');
    Route::resource('approval/heavy-equipment-order', PesananHeavyEquipmentApprovalController::class, Routing::setName('approval.heavy.order'))->only('index', 'show', 'update');

    Route::group([
        'prefix' => 'pesanan-angkutan/{order}',
        'as' => 'pesanan-angkutan.',
    ], function () {
        Route::resource('/detail', PesananAngkutanDetailController::class, Routing::setName('detail'))->except('create');
        Route::group([
            'prefix' => 'monitoring/{voucher}',
            'as' => 'detail.'
        ], function () {
            Route::resource('/detail', PesananAngkutanMonitoringController::class, Routing::setName('monitoring'))->except('create');
            Route::group([
                'prefix' => 'detail/{detail}',
                'as' => 'monitoring.'
            ], function () {
                Route::resource('/truck', PesananAngkutanMonitoringDetailController::class, Routing::setName('truck'))->except('create');
            });
        });
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
        Route::group([
            'prefix' => 'master',
            'as' => 'master.',
        ], function () {
            Route::resource('city', CityController::class, Routing::setName('city'));
            Route::resource('province', ProvinceController::class, Routing::setName('province'));
            Route::resource('contact-type', ContactTypeController::class, Routing::setName('contact-type'));
            Route::resource('business-category', BusinessCategoryController::class, Routing::setName('business-category'));
            Route::resource('destination', DestinationController::class, Routing::setName('destination'));
            Route::resource('doc', DocController::class, Routing::setName('doc'));
            Route::resource('origin', OriginController::class, Routing::setName('origin'));
            Route::resource('province', ProvinceController::class, Routing::setName('province'));
            Route::resource('truck-type', TruckTypeController::class, Routing::setName('truck-type'));
            Route::resource('warehouse-category', WarehouseCategoryController::class, Routing::setName('wh-category'));
            Route::resource('warehouse-function', WarehouseFunctionController::class, Routing::setName('wh-function'));
            Route::resource('warehouse-storage', WarehouseStorageController::class, Routing::setName('wh-storage'));
            Route::resource('heavy-type', HeavyTypeController::class, Routing::setName('heavy-type'));
        });
    });
});
