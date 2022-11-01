<?php

namespace App\Http\Controllers\User\Dashboard\Home\Juragan;

use App\Http\Controllers\User\Dashboard\Juragan\Provider\ProviderController;
use App\Models\Provider;

class HomeJuraganGudangController extends ProviderController {
    protected $providerType = Provider::WAREHOUSE;
    protected $providerName = "Gudang";
    protected $baseRoute = 'dashboard.home.juragan-gudang';
}
