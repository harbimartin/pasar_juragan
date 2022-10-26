<?php

namespace App\Http\Controllers\User\Dashboard\Juragan;

use App\Http\Controllers\User\Dashboard\Juragan\Provider\ProviderController;
use App\Models\Provider;

class JuraganAngkutanController extends ProviderController {
    protected $providerType = Provider::TRANSPORT;
    protected $providerName = "Angkutan";
    protected $baseRoute = 'dashboard.juragan-angkutan';
}
