<?php

namespace App\Http\Controllers\User\Dashboard\Juragan;

use App\Http\Controllers\User\Dashboard\Juragan\Provider\ProviderController;
use App\Models\Provider;

class JuraganGudangController extends ProviderController {
    protected $providerType = Provider::WAREHOUSE;
    protected $baseRoute = 'dashboard.juragan-gudang';
}
