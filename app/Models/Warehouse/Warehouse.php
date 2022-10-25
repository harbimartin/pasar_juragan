<?php

namespace App\Models\Warehouse;

use App\Models\_List;
use App\Models\GeoCity;
use App\Models\GeoProvince;
use App\Models\Provider;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class   Warehouse extends _List {
    use HasFactory;
    protected $table = "m_warehouse_tab";
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'm_provider_id',
        'wh_name',
        'm_city_id',
        'm_province_id',
        'address_detail',
        'longitude',
        'latitude',
        'wh_pic_email',
        'wh_pic_telephone',
        'wh_pic_fax',
        'wh_pic_phone',
        'tdg_no',
        'tdg_date',
        'tdg_expired_date',
        'tdg_attachment',
        'm_wh_function_id',
        'm_wh_category_id',
        'm_wh_storage_methode',
        'status'
    ];
    protected $sortable = [
        'wh_name',
        'status'
    ];
    protected $filterable = [
        'city' => 'm_city_id',
        'province' => 'm_province_id',
        'function' => 'm_wh_function_id',
        'category' => 'm_wh_category_id',
        'storage' => 'm_wh_storage_methode'
    ];

    public function provider() {
        return $this->hasOne(Provider::class, 'id', 'm_provider_id');
    }
    public function province() {
        return $this->hasOne(GeoProvince::class, 'id', 'm_province_id');
    }
    public function city() {
        return $this->hasOne(GeoCity::class, 'id', 'm_city_id');
    }
    public function function() {
        return $this->hasOne(WarehouseFunction::class, 'id', 'm_wh_function_id');
    }
    public function category() {
        return $this->hasOne(WarehouseCategory::class, 'id', 'm_wh_category_id');
    }
    public function storage_method() {
        return $this->hasOne(WarehouseStorageMethod::class, 'id', 'm_wh_storage_methode');
    }
    public function open_hour() {
        return $this->hasMany(WarehouseOpenHour::class, 'm_warehouse_id', 'id');
    }
}
