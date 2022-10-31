<?php

namespace App\Models\Transport;

use App\Models\_List;
use App\Models\Provider;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Truck extends _List
{
    use HasFactory;
    protected $table = "m_truck_tab";

    protected $fillable = [
        'm_provider_id',
        'plate_no',
        'm_truck_type_id',
        'stnk_no',
        'kir_no',
        'expired_stnk',
        'gps_imei',
        'gps_url',
        'gps_api_key',
        'status'
    ];

    protected $sortable = [
        'plate_no',
        'status'
    ];

    protected $filterable = [
        'type' => 'm_truck_type_tab',
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
