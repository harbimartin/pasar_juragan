<?php

namespace App\Http\Controllers\User\Dashboard\Juragan;

use App\Http\Controllers\User\Dashboard\Juragan\Provider\ProviderController;
use App\Models\Provider;

class JuraganAlatBeratController extends ProviderController {
    protected $providerType = Provider::HEAVY_EQUIPMENT;
    protected $baseRoute = 'dashboard.juragan-alatberat';
}
