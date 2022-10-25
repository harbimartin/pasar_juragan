<?php

namespace App\Models\Warehouse;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WarehouseOpenHour extends Model {
    use HasFactory;
    protected $table = "m_wh_storage_methode_tab";
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'm_warehouse_id',
        'open_day',
        'open_hour',
        'close_hour',
        'status'
    ];
}
