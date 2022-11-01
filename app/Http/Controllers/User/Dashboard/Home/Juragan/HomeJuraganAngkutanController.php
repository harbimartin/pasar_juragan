<?php

namespace App\Http\Controllers\User\Dashboard\Home\Juragan;

use App\Http\Controllers\User\Dashboard\Juragan\Provider\ProviderController;
use App\Models\Provider;

class HomeJuraganAngkutanController extends ProviderController {
    protected $providerType = Provider::TRANSPORT;
    protected $providerName = "Angkutan";
    protected $baseRoute = 'dashboard.home.juragan-angkutan';
}
