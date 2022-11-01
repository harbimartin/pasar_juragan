<?php

namespace App\Http\Controllers\User\Dashboard\Home\Juragan;

use App\Http\Controllers\User\Dashboard\Juragan\Provider\ProviderController;
use App\Models\Provider;

class HomeJuraganAlatBeratController extends ProviderController {
    protected $providerType = Provider::HEAVY_EQUIPMENT;
    protected $providerName = 'Alat Berat';
    protected $baseRoute = 'dashboard.home.juragan-alatberat';
}
