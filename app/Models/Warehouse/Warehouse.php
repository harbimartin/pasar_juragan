<?php

namespace App\Models\Warehouse;

use App\Models\GeoCity;
use App\Models\GeoProvince;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class   Warehouse extends Model {
    use HasFactory;
    protected $table = "m_warehouse_tab";
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
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
}
