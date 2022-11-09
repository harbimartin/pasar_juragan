<?php

namespace App\Models\Transport;

use App\Models\_List;
use App\Models\Provider;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Driver extends _List {
    use HasFactory;
    protected $table = "m_driver_tab";

    protected $fillable = [
        'm_provider_id',
        'driver_name',
        'license_no',
        'expired_license',
        'phone',
        'email',
        'status'
    ];

    protected $sortable = [
        'driver_name',
        'license_no',
        'expired_license',
        'phone',
        'email'
    ];

    protected $searchable = [
        'plate_no' => 0,
        'stnk_no' => 1,
        'kir_no' => 1,
        'gps_imei' => 1
    ];

    public function provider() {
        return $this->hasOne(Provider::class, 'id', 'm_provider_id');
    }
}
