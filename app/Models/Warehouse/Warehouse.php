<?php

namespace App\Models\Warehouse;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model {
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
}
