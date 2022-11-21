<?php

namespace App\Models\OrderWarehouse;

use App\Models\Warehouse\WarehouseContract;
use App\Models\Warehouse\WarehouseContractDetailRpt;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderWarehouse extends Model {
    use HasFactory;
    protected $table = "t_wh_order_tab";

    protected $fillable = [
        'who_no',
        'who_desc',
        'who_date',
        't_wh_contract_id',
        'status'
    ];

    public function detail() {
        return $this->hasMany(OrderWarehouseDetail::class, 't_wh_order_id', 'id');
    }
    public function contract() {
        return $this->hasOne(WarehouseContract::class, 'id', 't_wh_contract_id');
    }
    public function log() {
        return $this->hasMany(OrderWarehouseLog::class, 't_wh_order_id', 'id');
    }
    public function log_proposed() {
        return $this->hasMany(OrderWarehouseLog::class, 't_wh_order_id', 'id')->where('status', 'Proposed')->latest();
    }
    public function log_approved() {
        return $this->hasMany(OrderWarehouseLog::class, 't_wh_order_id', 'id')->where('status', 'Approved')->latest();
    }
}
