<?php

namespace App\Models\Transport;

use App\Models\_List;
use App\Models\Image;
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
        'expired_kir',
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

    public function image() {
        return $this->hasMany(Image::class, 'm_code_id', 'id')->where('image_type', Provider::TRANSPORT);
    }

    public function type(){
        return $this->hasOne(TruckType::class, 'id', 'm_truck_type_id');
    }
}
